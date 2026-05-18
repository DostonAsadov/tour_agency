<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Tour;

class TourController extends Controller
{
    //
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $about = About::first();

        $query = Tour::with('categories');

        // Filter by category slug
        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search by name or description
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $tours = $query->latest()->paginate(9);

        return view('pages.tours', compact('tours', 'categories', 'about'));
    }

    public function show(int $id)
    {
        $tour = Tour::findOrFail($id);
        return view('pages.tour', compact('tour'));
    }
}
