<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FlightSearchController;
use App\Http\Controllers\YemeniaController;
use App\Http\Controllers\FlightScheduleController;
use App\Http\Controllers\FlightComparisonController;
use App\Http\Controllers\DesiredFlightController;
use App\Http\Controllers\GoogleFlightController;
use App\Http\Controllers\BookingController;



// Default landing page route
Route::get('/', function () {
    return view('welcome');
});

// Desired flights route
Route::post('/desired_flights', [DesiredFlightController::class, 'store'])->name('desired_flights.store');

// Flight comparison route
Route::get('/compare-flights', [FlightComparisonController::class, 'compareFlights'])->name('flights.compare');

// Google API flights routes
Route::get('/googleflight', [GoogleFlightController::class, 'showFlights']);
Route::get('/googleflight/search', [GoogleFlightController::class, 'index'])->name('googleflight.index');
Route::get('/googleflight/results', [GoogleFlightController::class, 'search'])->name('googleflight.search');

// Booking routes
Route::get('/booking/show', [BookingController::class, 'show'])->name('booking.show');
Route::post('/booking/{flight_id}', [BookingController::class, 'book'])->name('booking.book');
Route::post('/booking/token/{token}', [BookingController::class, 'bookWithToken'])->name('booking.book.token');
Route::post('/booking/book', [BookingController::class, 'book'])->name('booking.book');


// Route to show booking details using a token
Route::get('/booking/{token}', [BookingController::class, 'show'])->name('booking.token');

// Yemenia routes
Route::prefix('yemenia')->name('yemenia.')->group(function () {
    Route::get('/', [FlightScheduleController::class, 'index'])->name('index');
    Route::get('/search', [FlightScheduleController::class, 'search'])->name('search');
    Route::get('/results', [FlightScheduleController::class, 'results'])->name('results');
    Route::get('/all-flights', [YemeniaController::class, 'allFlights'])->name('all_flights');
});

// Flight search routes
Route::prefix('flights')->name('flights.')->group(function () {
    Route::get('/search-form', [FlightSearchController::class, 'showSearchForm'])->name('search.form');
    Route::get('/search', [FlightSearchController::class, 'search'])->name('search');
});

// Authentication routes
Auth::routes();

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Add other admin-specific routes here
});


// Authenticated routes group
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::resource('flights', FlightController::class);
    Route::resource('clients', ClientController::class);
});

// Home route
Route::get('/home', [HomeController::class, 'index'])->name('home');
