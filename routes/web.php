<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::resource('flights', FlightController::class);
    Route::resource('hotels', HotelController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('reviews', ReviewController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
