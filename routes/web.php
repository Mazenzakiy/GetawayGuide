<?php

use App\Http\Controllers\Cart\CartController;
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

    // Countries
    Route::get('/all-countries', [App\Http\Controllers\Admins\AdminsController::class, 'allCountries'])->name('all.countries');
    Route::get('/create-countries', [App\Http\Controllers\Admins\AdminsController::class, 'createCountries'])->name('create.countries');
    Route::post('/create-countries', [App\Http\Controllers\Admins\AdminsController::class, 'storeCountries'])->name('store.countries');
    Route::get('/delete-countries/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteCountries'])->name('delete.countries');

    // Cities
    Route::get('/all-cities', [App\Http\Controllers\Admins\AdminsController::class, 'allCities'])->name('all.cities');
    Route::get('/create-cities', [App\Http\Controllers\Admins\AdminsController::class, 'createCities'])->name('create.cities');
    Route::post('/create-cities', [App\Http\Controllers\Admins\AdminsController::class, 'storeCities'])->name('store.cities');
    Route::get('/delete-cities/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteCities'])->name('delete.cities');

    // Booking
    Route::get('/all-bookings', [App\Http\Controllers\Admins\AdminsController::class, 'allBookings'])->name('all.bookings');
    Route::get('/edit-booking/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editBookings'])->name('edit.bookings');
    Route::post('/update-booking/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateBookings'])->name('update.bookings');
    Route::post('/update-booking/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateBookings'])->name('update.bookings');
    Route::get('/delete-booking/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteBookings'])->name('delete.bookings');

});

});
Route::get('lang/change/{lang?}',[LangController::class,'chang'])->name('lang.change');

