<?php

namespace App\Http\Controllers\Admins;

use App\Models\Category;
use App\Models\City\City;
use App\Models\TourGuide;
use App\Models\Preference;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Models\Country\Country;
use App\Models\PreferenceOption;

use App\Models\Landmark\Landmark;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\Reservation\Reservation;
use App\Models\Landmark\LandmarksImages;

class AdminsController extends Controller
{

        public function viewLogin() {

            return view('admins.login');

        }

        public function checkLogin(Request $request) {

            $remember_me = $request->has('remember_me') ? true : false;

            if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

                return redirect() -> route('admins.dashboard');
            }
            return redirect()->back()->with(['error' => 'error logging in']);

        }

        public function index() {

            $countriesCount = Country::select()->count();
            $citiesCount = City::select()->count();
            $adminsCount = Admin::select()->count();
            $landmarksCount = Landmark::select()->count();
            $tourGuidesCount = TourGuide::select()->count();



            return view('admins.index', compact('countriesCount','citiesCount','adminsCount','landmarksCount','tourGuidesCount'));

        }

        public function allAdmins() {

            $allAdmins = Admin::select()->orderBy('id', 'asc')->get();

            return view('admins.alladmins', compact('allAdmins'));

        }

        public function createAdmins() {

            return view('admins.createadmins');

        }

        public function storeAdmins(Request $request) {

            $storeAdmins = Admin::create([

                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),

            ]);

            if ($storeAdmins) {

                return redirect()->route('admins.all.admins')->with(['success' => 'Admin Created Successfully']);

            }

        }
        public function editAdmins($id) {
            $admin = Admin::findOrFail($id);  // Find the admin by id
            return view('admins.editadmins', compact('admin'));  // Pass the admin data to the view
        }

        public function updateAdmins(Request $request, $id) {
            $admin = Admin::findOrFail($id);

            $admin->update([
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password ? Hash::make($request->password) : $admin->password,
            ]);

            return redirect()->route('admins.all.admins')->with(['success' => 'Admin Updated Successfully']);
        }

        public function deleteAdmins($id) {
            $admin = Admin::findOrFail($id);
            $admin->delete();

            return redirect()->route('admins.all.admins')->with(['success' => 'Admin Deleted Successfully']);
        }

            // عرض جميع المرشدين السياحيين
            public function allTourGuides()
            {
                $allTourGuides = TourGuide::with('city')->orderBy('id', 'asc')->get();
                return view('admins.alltourguides', compact('allTourGuides'));
            }


        // عرض صفحة إنشاء مرشد سياحي
        public function createTourGuides()
        {
            $cities = City::all(); // افتراضياً أن لديك نموذج City لجلب المدن

            return view('admins.createtourguide', compact('cities'));
        }

        // تخزين المرشد السياحي الجديد
        public function storeTourGuide(Request $request)
    {
        // التحقق من البيانات المدخلة
        $request->validate([
            "name" => "required|max:40",
            "email" => "required|email|max:40",
            "phone" => "required|max:40",
            "identification" => "required|numeric",
            "identification_image" => "required|image|max:2048",
            "age" => "required|integer",
            "gender" => "required|in:male,female",
            "city_id" => "required|exists:cities,id",
            "image" => "required|image|max:2048",
        ]);

        // التعامل مع رفع الصورة
        $destinationPath = 'assets/images';
        $myImage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myImage);

        // التعامل مع رفع صورة الهوية
        $identificationImage = $request->identification_image->getClientOriginalName();
        $request->identification_image->move(public_path($destinationPath), $identificationImage);

        // إنشاء المرشد السياحي
        $storeTourGuide = TourGuide::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "identification" => $request->identification,
            "identification_image" => $identificationImage,
            "age" => $request->age,
            "gender" => $request->gender,
            "city_id" => $request->city_id,
            "image" => $myImage,
        ]);

        if ($storeTourGuide) {
            return redirect()->route('all.tourguides')->with(['success' => 'Tour Guide Created Successfully']);
        }
    }

        // عرض صفحة تعديل مرشد سياحي
        public function editTourGuide($id)
        {
            $tourGuide = TourGuide::find($id);
            $cities = City::all(); // جلب المدن

            if (!$tourGuide) {
                return redirect()->route('all.tourguides')->with(['error' => 'Tour Guide Not Found']);
            }

            return view('admins.edittourguide', compact('tourGuide','cities'));
        }

        // تحديث بيانات المرشد السياحي
        public function updateTourGuide(Request $request, $id)
        {
            $request->validate([
                "name" => "required|max:40",
                "email" => "required|email|max:40",
                "phone" => "required|max:40",
                "identification" => "required|numeric",
                "identification_image" => "nullable|image|max:2048",
                "age" => "required|integer",
                "gender" => "required|in:male,female",
                "city_id" => "required|exists:cities,id",
                "image" => "nullable|image|max:2048",
            ]);

            $tourGuide = TourGuide::find($id);

            if (!$tourGuide) {
                return redirect()->route('all.tourguides')->with(['error' => 'Tour Guide Not Found']);
            }

            // تحديث صورة الهوية إذا تم رفعها
            if ($request->hasFile('identification_image')) {
                if (File::exists(public_path('assets/images' . $tourGuide->identification_image))) {
                    File::delete(public_path('assets/images' . $tourGuide->identification_image));
                }

                $destinationPath = 'assets/images';
                $identificationImage = $request->identification_image->getClientOriginalName();
                $request->identification_image->move(public_path($destinationPath), $identificationImage);
                $tourGuide->identification_image = $identificationImage;
            }

            // تحديث الصورة إذا تم رفعها
            if ($request->hasFile('image')) {
                if (File::exists(public_path('assets/images' . $tourGuide->image))) {
                    File::delete(public_path('assets/images' . $tourGuide->image));
                }

                $destinationPath = 'assets/images';
                $myImage = $request->image->getClientOriginalName();
                $request->image->move(public_path($destinationPath), $myImage);
                $tourGuide->image = $myImage;
            }

            // تحديث البيانات
            $tourGuide->update([
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "identification" => $request->identification,
                "age" => $request->age,
                "gendre" => $request->gender,
                "city_id" => $request->city_id,
            ]);

            return redirect()->route('all.tourguides')->with(['success' => 'Tour Guide Updated Successfully']);
        }

        // حذف المرشد السياحي
        public function deleteTourGuide($id)
        {
            $deleteTourGuide = TourGuide::find($id);

            if (!$deleteTourGuide) {
                return redirect()->route('all.tourguides')->with(['error' => 'Tour Guide Not Found']);
            }

            // حذف الصورة من الخادم إذا كانت موجودة
            if (File::exists(public_path('assets/images' . $deleteTourGuide->image))) {
                File::delete(public_path('assets/images' . $deleteTourGuide->image));
            }

            $deleteTourGuide->delete();

            return redirect()->route('all.tourguides')->with(['delete' => 'Tour Guide Deleted Successfully']);
        }

        public function allCountries() {

            $allCountries = Country::select()->orderBy('id','asc')->get();

            return view('admins.allcountries', compact('allCountries'));

        }

        public function createCountries() {

            return view('admins.createcountries');

        }

        public function storeCountries(Request $request) {

            Request()->validate([

                "name" => "required|max:40",
                "population" => "required|max:40",
                "territory" => "required|max:40",
                "avg_price" => "required|max:40",
                "description" => "required|max:40",
                "image" => "required|max:40",
                "continent" => "required|max:40",
                "video" => "nullable|mimes:mp4,mov,avi|max:100000", // دعم الفيديو


            ]);

            $destinationPath = 'assets/images';
            $myimage = $request->image->getClientOriginalName();
            $request->image->move(public_path($destinationPath), $myimage);

                $myvideo = null;
                if ($request->hasFile('video')) {
                    $destinationVideoPath = 'assets/videos';
                    $myvideo = $request->video->getClientOriginalName();
                    $request->video->move(public_path($destinationVideoPath), $myvideo);
                }
            $storeCountries = Country::create([

                "name" => $request->name,
                "population" => $request->population,
                "territory" => $request->territory,
                "avg_price" => $request->avg_price,
                "description" => $request->description,
                "image" => $myimage,
                "continent" => $request->continent,
                "video" => $myvideo, // إضافة الفيديو


            ]);

            if ($storeCountries) {

                return redirect()->route('all.countries')->with(['success' => 'Country Created Successfully']);

            }

        }
        public function editCountries($id) {
            $country = Country::find($id);

            if (!$country) {
                return redirect()->route('all.countries')->with(['error' => 'Country Not Found']);
            }

            return view('admins.editcountries', compact('country'));
        }

        public function updateCountries(Request $request, $id) {
            $request->validate([
                "name" => "required|max:40",
                "population" => "required|max:40",
                "territory" => "required|max:40",
                "avg_price" => "required|max:40",
                "description" => "required|max:40",
                "image" => "nullable|image|max:2048",
                "continent" => "required|max:40",
                "video" => "nullable|mimes:mp4,mov,avi|max:100000",
            ]);

            $country = Country::find($id);
            if (!$country) {
                return redirect()->route('all.countries')->with(['error' => 'Country Not Found']);
            }

            if ($request->hasFile('image')) {
                if (File::exists(public_path('assets/images/' . $country->image))) {
                    File::delete(public_path('assets/images/' . $country->image));
                }
                $destinationPath = 'assets/images';
                $myimage = $request->image->getClientOriginalName();
                $request->image->move(public_path($destinationPath), $myimage);
                $country->image = $myimage;
            }

            if ($request->hasFile('video')) {
                if (File::exists(public_path('assets/videos/' . $country->video))) {
                    File::delete(public_path('assets/videos/' . $country->video));
                }
                $destinationVideoPath = 'assets/videos';
                $myvideo = $request->video->getClientOriginalName();
                $request->video->move(public_path($destinationVideoPath), $myvideo);
                $country->video = $myvideo;
            }

            $country->update([
                "name" => $request->name,
                "population" => $request->population,
                "territory" => $request->territory,
                "avg_price" => $request->avg_price,
                "description" => $request->description,
                "continent" => $request->continent,
            ]);

            return redirect()->route('all.countries')->with(['success' => 'Country Updated Successfully']);

        }


        public function deleteCountries($id) {

            $deleteCountry = Country::find($id);

            if(File::exists(public_path('assets/images' . $deleteCountry->image))){
                File::delete(public_path('assets/images' . $deleteCountry->image));
            }else{
                //dd('File does not exists.');
            }

            $deleteCountry->delete();

            if ($deleteCountry) {

                return redirect()->route('all.countries')->with(['delete' => 'Country Deleted Successfully']);

            }

        }

        public function allCities() {

            $cities = City::select()->orderBy('id', 'asc')->get();

            return view('admins.allcities', compact('cities'));

        }

        public function createCities() {

            $countries = Country::all();

            return view('admins.createcities', compact('countries'));

        }

        public function storeCities(Request $request) {

            $request->validate([


                "name" => "required|max:40",
                "price" => "required|max:40",
                "image" => "required|max:1000",
                "num_days" => "required|max:40",
                "country_id" => "required|max:40",


            ]);



            $destinationPath = 'assets/images/';
            $myimage = $request->image->getClientOriginalName();
            $request->image->move(public_path($destinationPath), $myimage);

            if ($request->hasFile('video')) {
                $videoPath = 'assets/videos/';
                $myVideo = $request->file('video')->getClientOriginalName();
                $request->file('video')->move(public_path($videoPath), $myVideo);
            } else {
                $myVideo = null;
            }
            $storeCities = City::create([

                "name" => $request->name,
                "price" => $request->price,
                "image" => $myimage,
                "video" => $myVideo,
                "num_days" => $request->num_days,
                "country_id" => $request->country_id,

            ]);

            if ($storeCities) {

                return redirect()->route('all.cities')->with(['success' => 'City Created Successfully']);

            }

        }

        public function editCities($id) {
            $city = City::find($id);

            $countries = Country::all();

            return view('admins.editcities', compact('city', 'countries'));
        }


        public function updateCities(Request $request, $id) {
            $request->validate([
                "name" => "required|max:40",
                "price" => "required|max:40",
                "num_days" => "required|max:40",
                "country_id" => "required|max:40",
            ]);

            $city = City::find($id);

            if ($request->hasFile('image')) {
                $destinationPath = 'assets/images';
                $myimage = $request->image->getClientOriginalName();
                $request->image->move(public_path($destinationPath), $myimage);

                if (File::exists(public_path('assets/images' . $city->image))) {
                    File::delete(public_path('assets/images' . $city->image));
                }

                $city->image = $myimage;
            }

            if ($request->hasFile('video')) {
                $videoPath = 'assets/videos/';
                $myVideo = $request->file('video')->getClientOriginalName();
                $request->file('video')->move(public_path($videoPath), $myVideo);

                if ($city->video && File::exists(public_path('assets/videos/' . $city->video))) {
                    File::delete(public_path('assets/videos/' . $city->video));
                }

                $city->video = $myVideo;
            }

            $city->name = $request->name;
            $city->price = $request->price;
            $city->num_days = $request->num_days;
            $city->country_id = $request->country_id;

            $city->save();

            return redirect()->route('all.cities')->with(['success' => 'City Updated Successfully']);
        }

        public function deleteCities($id) {
            $deleteCity = City::find($id);

            if (File::exists(public_path('assets/images' . $deleteCity->image))) {
                File::delete(public_path('assets/images' . $deleteCity->image));
            }

            if ($deleteCity->video && File::exists(public_path('assets/videos/' . $deleteCity->video))) {
                File::delete(public_path('assets/videos/' . $deleteCity->video));
            }

            $deleteCity->delete();

            return redirect()->route('all.cities')->with(['delete' => 'City Deleted Successfully']);
        }


        public function allBookings() {

            $bookings = Reservation::select()->orderBy('id','asc')->get();

            return view('admins.allbookings', compact('bookings'));

        }

        public function editBookings($id) {

            $booking = Reservation::find($id);

            return view('admins.editbooking', compact('booking'));

        }

        public function updateBookings(Request $request, $id) {

            $editBooking = Reservation::find($id);

            $editBooking->update($request->all());

            if ($editBooking) {

                return redirect()->route('all.bookings')->with(['update' => 'Booking Status Updated Successfully']);

            }

        }

        public function deleteBookings($id) {

            $deleteBooking = Reservation::find($id);

            $deleteBooking->delete();

            if ($deleteBooking) {

                return redirect()->route('all.bookings')->with(['delete' => 'Booking Deleted Successfully']);

            }

        }
        public function allLandmarks() {
            $landmarks = Landmark::with(['images', 'categories'])->orderBy('id', 'asc')->get();
            return view('admins.alllandmarks', compact('landmarks'));
        }

        public function createLandmarks() {
            $categories = Category::all();
            $cities = City::all();
            return view('admins.createlandmarks', compact('categories', 'cities'));
        }

        public function storeLandmarks(Request $request) {
            $request->validate([
                'name' => 'required|string|max:255',
                'city_id' => 'required|exists:cities,id',
                'desc' => 'required|string',
                'address' => 'required|string',
                'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
                'mainImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $landmark = Landmark::create($request->except(['images', 'mainImage', 'video', 'categories']));

            if ($request->category_ids) {
                $landmark->categories()->sync($request->category_ids);
            }

            if ($request->hasFile('video') && $request->file('video')->isValid()) {
                $videoName = time() . '_' . $request->file('video')->getClientOriginalName();
                $request->file('video')->move(public_path('assets/videos'), $videoName);
                $landmark->update(['video' => $videoName]);
            }

            if ($request->hasFile('images')) {
                $firstImageName = null; // متغير لتخزين اسم أول صورة
                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        $imageName = time() . '_' . $image->getClientOriginalName();
                        $image->move(public_path('assets/images'), $imageName);
                        LandmarksImages::create([
                            'landmark_id' => $landmark->id,
                            'name' => $imageName,
                        ]);

                        if (!$firstImageName) {
                            $firstImageName = $imageName;
                        }
                    }
                }

                if (!$landmark->mainImage && $firstImageName) {
                    $landmark->update(['mainImage' => $firstImageName]);
                }
            }
            return redirect()->route('all.landmarks')->with('success', 'Landmark Created Successfully');
        }




        public function editLandmark($id) {
            $landmark = Landmark::with(['images', 'categories'])->findOrFail($id);
            $categories = Category::all();
            $cities = City::all();
            return view('admins.editlandmarks', compact('landmark', 'categories', 'cities'));
        }

        public function updateLandmark(Request $request, $id) {
            $request->validate([
                'name' => 'required|string|max:255',
                'city_id' => 'required|exists:cities,id',
                'desc' => 'required|string',
                'address' => 'required|string',
                'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
                'mainImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $landmark = Landmark::findOrFail($id);
            $landmark->update($request->except(['images', 'mainImage', 'video', 'categories']));

            if ($request->has('category_ids')) {
                $landmark->categories()->sync($request->category_ids);
            }

            if ($request->hasFile('mainImage') && $request->file('mainImage')->isValid()) {
                $imageName = time() . '_' . $request->file('mainImage')->getClientOriginalName();
                $request->file('mainImage')->move(public_path('assets/images'), $imageName);
                $landmark->update(['mainImage' => $imageName]);
            }

            if ($request->hasFile('video') && $request->file('video')->isValid()) {
                $videoName = time() . '_' . $request->file('video')->getClientOriginalName();
                $request->file('video')->move(public_path('assets/videos'), $videoName);
                $landmark->update(['video' => $videoName]);
            }

            if ($request->hasFile('images')) {
                $oldImages = LandmarksImages::where('landmark_id', $landmark->id)->get();
                foreach ($oldImages as $image) {
                    if (File::exists(public_path('assets/images/' . $image->name))) {
                        File::delete(public_path('assets/images/' . $image->name));
                    }
                    $image->delete();
                }
                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        $imageName = time() . '_' . $image->getClientOriginalName();
                        $image->move(public_path('assets/images'), $imageName);
                        LandmarksImages::create([
                            'landmark_id' => $landmark->id,
                            'name' => $imageName,
                        ]);
                    }
                }
            }

            return redirect()->route('all.landmarks')->with('success', 'Landmark Updated Successfully');
        }

        public function deleteLandmark($id) {
            $landmark = Landmark::findOrFail($id);

            if ($landmark->mainImage && File::exists(public_path('assets/images/' . $landmark->mainImage))) {
                File::delete(public_path('assets/images/' . $landmark->mainImage));
            }

            if ($landmark->video && File::exists(public_path('assets/videos/' . $landmark->video))) {
                File::delete(public_path('assets/videos/' . $landmark->video));
            }

            $images = LandmarksImages::where('landmark_id', $landmark->id)->get();
            foreach ($images as $image) {
                if (File::exists(public_path('assets/images/' . $image->name))) {
                    File::delete(public_path('assets/images/' . $image->name));
                }
                $image->delete();
            }

            $landmark->delete();

            return redirect()->route('all.landmarks')->with('success', 'Landmark Deleted Successfully');
        }


        public function allPreferences() {
            $preferences = Preference::with(['options.category'])->orderBy('id', 'asc')->get();
            return view('admins.allPreferences', compact('preferences'));
        }

        // عرض صفحة إنشاء تفضيل جديد
        public function createPreference() {
            $categories = Category::all();
            return view('admins.createPreference', compact('categories'));
        }

        // تخزين تفضيل جديد مع الخيارات المرتبطة
        public function storePreference(Request $request) {
            $request->validate([
                'question' => 'required|string|max:255',
                'type' => 'required|in:single,multiple',
                'options.*' => 'required|string|max:255',
                'category_ids.*' => 'required|exists:categories,id',
            ]);

            if (count($request->options) !== count($request->category_ids)) {
                return redirect()->back()->withErrors(['error' => 'The number of options must match the number of categories.']);
            }


            // حفظ التفضيل
            $preference = Preference::create($request->only('question', 'type'));

            // حفظ الخيارات المرتبطة
            foreach ($request->options as $index => $option) {
                PreferenceOption::create([
                    'preference_id' => $preference->id,
                    'category_id' => $request->category_ids[$index],
                    'option' => $option,
                ]);
            }

            return redirect()->route('all.preferences')->with('success', 'Preference Created Successfully');
        }

        // تعديل تفضيل
        public function editPreference($id) {
            $preference = Preference::with('options')->findOrFail($id);
            $categories = Category::all();
            return view('admins.editPreference', compact('preference', 'categories'));
        }

        // تحديث تفضيل
        public function updatePreference(Request $request, $id) {
            $request->validate([
                'question' => 'required|string|max:255',
                'type' => 'required|in:single,multiple',
                'options.*' => 'required|string|max:255',
                'category_ids.*' => 'required|exists:categories,id',
            ]);

            $preference = Preference::findOrFail($id);
            $preference->update($request->only('question', 'type'));

            // تحديث الخيارات المرتبطة
            $preference->options()->delete();  // حذف الخيارات القديمة
            foreach ($request->options as $index => $option) {
                PreferenceOption::create([
                    'preference_id' => $preference->id,
                    'category_id' => $request->category_ids[$index],
                    'option' => $option,
                ]);
            }

            return redirect()->route('all.preferences')->with('success', 'Preference Updated Successfully');
        }

        // حذف تفضيل
        public function deletePreference($id) {
            $preference = Preference::findOrFail($id);
            $preference->options()->delete(); // حذف الخيارات المرتبطة
            $preference->delete(); // حذف التفضيل
            return redirect()->route('all.preferences')->with('success', 'Preference Deleted Successfully');
        }

    }
