<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


/* Route::get('/', function () {
    return view('welcome');
});
 */

Route::get('/', [HomeController::class, 'index'])->name('home'); //Home page Route 
Route::get('/category', [CategoryController::class, 'index'])->name('category'); // Category Page Route
Route::get('/tour/{id}', [TourController::class, 'show'])->name('tour'); // Tour Page Route  
Route::get('/tours', [TourController::class, 'index'])->name('tours'); // Tours page Route

Route::get('/about', [HomeController::class, 'about'])->name('about'); // About Page Route


Route::get('/booking', [BookingController::class, 'index'])->name('booking.index'); // Booking page Route 
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');// Booking form submission Route
