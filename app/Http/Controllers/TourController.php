<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    //
    public function index()
    {
        $tours = Tour::query()->with(['categories'])->get();
        $categories = Category::all();
        $about = About::first();
        return view('pages.tours', compact('tours', 'categories', 'about'));
    }

    public function show($id)
    {
        $tour = Tour::findOrFail($id);
        return view('pages.tour', compact('tour'));
    }
}
