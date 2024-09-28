<?php

namespace App\Http\Controllers\Traveling;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City\City;
use App\Models\Country\Country;
use App\Models\Landmark\Landmark;
use App\Models\Preference;
use App\Models\Reservation\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TravelingController extends Controller
{

    public function about($id) {

        $cities = City::select()->orderBy('id', 'desc')->take(5)
        ->where('country_id', $id)->get();

        $country = Country::find($id);

        $citiesCount = City::select()->where('country_id', $id)->count();

        return view('traveling.about', compact('cities', 'country', 'citiesCount'));

    }



    public function makeReservations(Request $request,$city_id) {

        $city = City::findOrFail($request->city_id);

        return view('traveling.reservation', compact('city'));

    }

    public function storeReservations(Request $request, $id) {

        $city = City::find($id);

        if ($request->check_in_date > date("Y-m-d")) {

            $totalPrice = (int)$city->price * (int)$request->num_guests;

            $storeReservations = Reservation::create([

                "name" => $request->name,
                "phone_number" => $request->phone_number,
                "num_guests" => $request->num_guests,
                "check_in_date" => $request->check_in_date,
                "destination" => $request->destination,
                "price" => $totalPrice,
                "user_id" => $request->user_id,
                "days"=>$request->days,
                "tourGuied_name"=>$request->tourGuide,
                "tourGuied_id"=>$request->tourGuide_id,
                "tourGuied_status"=>$request->guide_type,

            ]);


            if ($storeReservations) {

                $price = Session::put('price', $city->price * $request->num_guests);

                $newPrice = Session::get($price);


                return Redirect::route('traveling.pay',$totalPrice);

            }

        } else {

            echo "Invalid Date, You Need To Choose A Date In The Future";

        }

    }

    public function payWithPaypal($Price) {
        $totalPrice=$Price;
        return view('traveling.pay',compact('totalPrice'));

    }

    public function success() {

        Session::forget('cart');
        Session::forget('price');

        return view('traveling.success');

    }

    public function deals() {

        $cities = City::select()->orderBy('id', 'desc')->take(4)->get();

        $countries = Country::all();

        return view('traveling.deals', compact('cities', 'countries'));

    }

    public function searchDeals(Request $request) {

        $country_id = $request->get('country_id');
        $price = $request->get('price');

        $searches = City::where('country_id', $country_id)
        ->where('price', '<=', $price)->orderBy('id','desc')
        ->take(4)
        ->get();

        $countries = Country::all();

        return view('traveling.searchdeals', compact('searches', 'countries'));

    }

    public function show($id){
        $city = City::findOrFail($id);
        $landmarks = $city->landmarks()->with('categories')->get();
        $categories = Category::all();
        $preferences = Preference::with('options.category')->get();

        //    dd($landmarks);
        return view('traveling.show',compact('city','landmarks','preferences'));
    }

    public function getRecommendedLandmarks(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'preferences' => 'array',
            'preferences.*' => 'integer|exists:preference_options,id',
        ]);

        // Find the city by ID, or fail if not found
        $city = City::findOrFail($id);

        // Get selected preference option IDs (if any)
        $selectedOptionIds = $validated['preferences'] ?? [];

        // If no preferences are selected, return an appropriate message
        if (empty($selectedOptionIds)) {
            return response()->json([
                'landmarks' => '<p>No landmarks found based on your preferences.</p>',
            ]);
        }

        // Get the associated category IDs based on the selected preferences
        $categoryIds = \App\Models\PreferenceOption::whereIn('id', $selectedOptionIds)
            ->pluck('category_id')
            ->unique();

        // Fetch landmarks in the city that belong to the selected categories
        $recommendedLandmarks = Landmark::where('city_id', $city->id)
            ->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            })
            ->with('categories') // Load the categories relationship
            ->get();

            

        // If no landmarks are found, return an appropriate message
        if ($recommendedLandmarks->isEmpty()) {
            return response()->json([
                'landmarks' => '<p>No landmarks found based on your preferences.</p>',
            ]);
        }

        // Return the landmarks as a rendered HTML view for the AJAX response
        return response()->json([
            'landmarks' => view('traveling.partial', ['landmarks' => $recommendedLandmarks])->render(),
        ]);
    }

    public function showLandmark($id){
        $landmark=Landmark::findOrFail($id);
        $landmarkImages=$landmark->landmarkImages;
        $categories=$landmark->categories;

        return view('traveling.landmark',compact('landmark','landmarkImages','categories'));
    }


}
