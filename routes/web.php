<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
});


Tour page Route
Category Page Route
Booking page Route 
 */

Route::get('/', [HomeController::class, 'index'])->name('home'); //Home page Route 
// About Page Route    
