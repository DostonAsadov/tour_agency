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
Route::get('/about', [HomeController::class, 'about'])->name('about'); // About Page Route
Route::get('/category', [CategoryController::class, 'index'])->name('category'); // Category Page Route
Route::get('/tour', [TourController::class, 'index'])->name('tour'); // Tour Page Route  
Route::get('/booking', [BookingController::class, 'index'])->name('booking'); // Booking page Route 
