<?php

use App\Http\Controllers\Admins\AdminsController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\LandmarkController;
use App\Http\Controllers\Lang\LangController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware('lang')->group(function(){



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth:web');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::group(['prefix' => 'traveling', 'as' => 'traveling.'], function() {

    Route::get('/about/{id}', [App\Http\Controllers\Traveling\TravelingController::class, 'about'])->name('about'); //cities
    Route::get('/show/{id}', [App\Http\Controllers\Traveling\TravelingController::class, 'show'])->name('show');  // city
    Route::post('/cities/{id?}/preferences', [App\Http\Controllers\Traveling\TravelingController::class, 'getRecommendedLandmarks'])->name('cities.preferences');
    Route::get('/show/{id}/landmark', [App\Http\Controllers\Traveling\TravelingController::class, 'showLandmark'])->name('showLandmark');  // landmark

   // Cart routes
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/process', [CartController::class, 'processCart'])->name('cart.process');
    Route::post('/cart/process/tour_guide/{city}', [CartController::class, 'getTourGuides'])->name('cart.choose.tourGuide');
    Route::post('/cart/process/send/reservation', [CartController::class, 'chooseTourGuied'])->name('cart.send.tourGuide');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');




    // Booking
    Route::post('/reservation/view/{city_id}', [App\Http\Controllers\Traveling\TravelingController::class, 'makeReservations'])->name('reservation');
    Route::post('/reservation/{id}', [App\Http\Controllers\Traveling\TravelingController::class, 'storeReservations'])->name('reservation.store');

    // Paying
    Route::get('/pay/{price}', [App\Http\Controllers\Traveling\TravelingController::class, 'payWithPaypal'])->name('pay')->middleware('check.for.price');
    Route::get('/success', [App\Http\Controllers\Traveling\TravelingController::class, 'success'])->name('success')->middleware('check.for.price');

    // Deals
    Route::get('/deals', [App\Http\Controllers\Traveling\TravelingController::class, 'deals'])->name('deals');
    Route::any('/search-deals', [App\Http\Controllers\Traveling\TravelingController::class, 'searchDeals'])->name('deals.search');

});


// Users Pages
Route::get('users/my-bookings', [App\Http\Controllers\Users\UsersController::class, 'bookings'])->name('users.bookings')->middleware('auth:web');

// Admins Panel
Route::get('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name('view.login')->middleware('check.for.auth');
Route::post('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {

    Route::get('/index', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admins.dashboard');

    // Admins
    Route::get('/all-admins', [App\Http\Controllers\Admins\AdminsController::class, 'allAdmins'])->name('admins.all.admins');
    Route::get('/create-admins', [App\Http\Controllers\Admins\AdminsController::class, 'createAdmins'])->name('admins.create');
    Route::post('/create-admins', [App\Http\Controllers\Admins\AdminsController::class, 'storeAdmins'])->name('admins.store');
    Route::get('/admins/edit/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editAdmins'])->name('admins.edit.admins');
    Route::put('/admins/update/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateAdmins'])->name('admins.update.admins');
    Route::delete('/admins/delete/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteAdmins'])->name('admins.delete.admins');

        //Tourguide

        Route::get('tourguides', [App\Http\Controllers\Admins\AdminsController::class, 'allTourGuides'])->name('all.tourguides');
        Route::get('tourguides/create', [App\Http\Controllers\Admins\AdminsController::class, 'createTourGuides'])->name('create.tourguides');
        Route::post('tourguides/store', [App\Http\Controllers\Admins\AdminsController::class, 'storeTourGuide'])->name('store.tourguides');
        Route::get('tourguides/edit/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editTourGuide'])->name('edit.tourguides');
        Route::put('tourguides/update/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateTourGuide'])->name('update.tourguides');
        Route::delete('tourguides/delete/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteTourGuide'])->name('delete.tourguides');
        // Countries
    Route::get('/all-countries', [App\Http\Controllers\Admins\AdminsController::class, 'allCountries'])->name('all.countries');
    Route::get('/create-countries', [App\Http\Controllers\Admins\AdminsController::class, 'createCountries'])->name('create.countries');
    Route::post('/create-countries', [App\Http\Controllers\Admins\AdminsController::class, 'storeCountries'])->name('store.countries');
    Route::get('/delete-countries/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteCountries'])->name('delete.countries');
    Route::get('/countries/{id}/edit', [App\Http\Controllers\Admins\AdminsController::class, 'editCountries'])->name('edit.countries');
    Route::put('/countries/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateCountries'])->name('update.countries');

    // Cities
    Route::get('/all-cities', [App\Http\Controllers\Admins\AdminsController::class, 'allCities'])->name('all.cities');
    Route::get('/create-cities', [App\Http\Controllers\Admins\AdminsController::class, 'createCities'])->name('create.cities');
    Route::post('/create-cities', [App\Http\Controllers\Admins\AdminsController::class, 'storeCities'])->name('store.cities');
    Route::get('/delete-cities/{id}', action: [App\Http\Controllers\Admins\AdminsController::class, 'deleteCities'])->name('delete.cities');
    Route::get('cities/edit/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editCities'])->name('edit.cities');
    Route::post('cities/update/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateCities'])->name('update.cities');

    // Booking
    Route::get('/all-bookings', [App\Http\Controllers\Admins\AdminsController::class, 'allBookings'])->name('all.bookings');
    Route::get('/edit-booking/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editBookings'])->name('edit.bookings');
    Route::post('/update-booking/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateBookings'])->name('update.bookings');
    Route::post('/update-booking/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateBookings'])->name('update.bookings');
    Route::get('/delete-booking/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteBookings'])->name('delete.bookings');

    //landmarks

    Route::get('/landmarks', [App\Http\Controllers\Admins\AdminsController::class, 'allLandmarks'])->name('all.landmarks');
    Route::get('/create-landmarks', [App\Http\Controllers\Admins\AdminsController::class, 'createLandmarks'])->name('create.landmarks');
    Route::post('/create-landmarks', [App\Http\Controllers\Admins\AdminsController::class, 'storeLandmarks'])->name('store.landmarks');
    Route::get('/edit-landmarks/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editLandmark'])->name('edit.landmarks');
    Route::put('/update-landmarks/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateLandmark'])->name('update.landmarks');
     Route::delete('/delete-landmarks/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteLandmark'])->name('destroy.landmarks');




     Route::get('/preferences', [App\Http\Controllers\Admins\AdminsController::class, 'allPreferences'])->name('all.preferences');
    Route::get('/preferences/create', [App\Http\Controllers\Admins\AdminsController::class, 'createPreference'])->name('create.preference');
    Route::post('/preferences/store', [App\Http\Controllers\Admins\AdminsController::class, 'storePreference'])->name('store.preference');
    Route::get('/preferences/{id}/edit', [App\Http\Controllers\Admins\AdminsController::class, 'editPreference'])->name('edit.preference');
    Route::post('/preferences/{id}/update', [App\Http\Controllers\Admins\AdminsController::class, 'updatePreference'])->name('update.preference');
    Route::delete('/preferences/{id}/delete', [App\Http\Controllers\Admins\AdminsController::class, 'deletePreference'])->name('delete.preference');



});

});
Route::get('lang/change/{lang?}',[LangController::class,'chang'])->name('lang.change');

