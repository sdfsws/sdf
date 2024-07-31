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

// Default landing page route
Route::get('/', function () {
    return view('welcome');
});

// Yemenia routes

Route::get('/yemenia', [YemeniaController::class, 'index'])->name('yemenia.index');
Route::get('/yemenia/search', [FlightScheduleController::class, 'scrapeFlightSchedules'])->name('yemenia.search');
Route::get('/yemenia/all-flights', [FlightScheduleController::class, 'index'])->name('yemenia.all_flights');

// Flight management routes
Route::resource('flights', FlightController::class);

// Client management routes
Route::resource('clients', ClientController::class);

// Flight search routes
Route::get('/flights/search-form', [FlightSearchController::class, 'showSearchForm'])->name('flights.search.form');
Route::get('/flights/search', [FlightSearchController::class, 'search'])->name('flights.search');

// Authentication routes
Auth::routes();

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // Add other admin-specific routes here
});

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}', [UserController::class, 'update'])->name('users.update');
});

// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
