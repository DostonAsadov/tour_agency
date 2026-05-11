<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    //
    public function index()
    {
        $tours = Tour::all();
        return view('pages.tours', compact('tours'));
    }

    public function show($id)
    {
        $tour = Tour::findOrFail($id);
        return view('pages.tour', compact('tour'));
    }
}
