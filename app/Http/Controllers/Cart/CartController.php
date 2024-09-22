<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\City\City;
use App\Models\Landmark\Landmark;
use App\Models\TourGuide;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Add a landmark to the cart
    public function addToCart(Request $request, $id)
    {
        // Fetch the landmark
        $landmark = Landmark::findOrFail($id);

        // Get the cart from session, or create an empty one if it doesn't exist
        $cart = session()->get('cart', []);

        // Add the landmark to the cart if not already in it
        if (!array_key_exists($id, $cart)) {
            $cart[$id] = $landmark;
            session()->put('cart', $cart);
        }


        // Redirect to the landmarks page with a success message
        return redirect(route('traveling.show', $landmark->city))->with('success', 'Landmark added to cart!');
    }

    public function processCart(Request $request)
    {

        // Validate input
        $validated = $request->validate([
            'days' => 'required|integer|min:1',
            'agree' => 'required_if:days,>1', // Require agreement if days are more than 1
        ]);

        // Filter by gender based on the group selected
        if ($request->group === 'boys') {
            $gender = 'male';
        } elseif ($request->group === 'girls') {
            $gender = 'female';
        } else {
            $gender = null; // Family can have both male and female guides
        }

        $tourGuides = TourGuide::where('city_id', $request->city_id)
            ->when($gender, function ($query, $gender) {
                return $query->where('gendre', $gender);
            })
            ->get();

            $days=$request->days;
            $city=$request->city_id;


        // Process booking or redirect with errors
        // ...

        return view('traveling.cart.tour_guide', compact('days','city','tourGuides'));
    }


    public function chooseTourGuied(Request $request)
    {
        $days=$request->days;
        $guide_type=$request->guide_type;
        $tourGuide_id=$request->tourGuide_id;
        $tourGuide = TourGuide::findOrFail($tourGuide_id);
        $city=$tourGuide->city;


        return view('traveling.reservation',compact('days','guide_type','tourGuide','city'));
    }

    public function getTourGuides(Request $request, $city)
    {

        dd($request);
        // Filter by gender based on the group selected
        if ($request->group === 'boys') {
            $gender = 'male';
        } elseif ($request->group === 'girls') {
            $gender = 'female';
        } else {
            $gender = null; // Family can have both male and female guides
        }

        $tourGuides = TourGuide::where('city_id', $request->$city)
            ->when($gender, function ($query, $gender) {
                return $query->where('gendre', $gender);
            })
            ->get();

            $days=$request->days;
            dd($days);
            $city=$request->city;

        return view('traveling.cart.tour_guide',compact('tourGuides','days','city'));
    }


    // Show the cart
    public function showCart()
    {
        $city = 0;
        // Get the cart from session
        $cart = session()->get('cart', []);
        if (!empty($cart)) {
            foreach ($cart as $landmark) {
                global $city;
                $city = $landmark->city_id;
                if ($city >= 1) {
                    break;
                }
            }
        }

        $city_id=$city;
        return view('traveling.cart.index', compact('cart', 'city_id'));
    }

    // Remove a landmark from the cart
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        // Remove the landmark from the cart if it exists
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('traveling.cart.show')->with('success', 'Landmark removed from cart');
    }
}
