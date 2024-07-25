<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Default landing page route
Route::get('/', function () {
    return view('welcome');
});


Route::get('/search-flights', [FlightController::class, 'search'])->name('flights.search');
Route::post('/flights', [FlightController::class, 'store'])->name('flights.store');

// Authentication routes
Auth::routes();

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    // أضف Routes أخرى خاصة بالإدارة هنا
});

// Authenticated routes group
Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::resource('flights', FlightController::class);
    Route::resource('clients', ClientController::class);
});

// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
