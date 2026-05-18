<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Tour;
use App\Services\GoogleSheetsService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $about = About::first();

        $tourDetails = null;
        if ($request->filled('tour')) {
            $tour = Tour::find($request->tour);
            if ($tour) {
                $categories = $tour->categories->pluck('name')->join(', ');
                $parts = [
                    "Tour: {$tour->name}",
                    "Price: \${$tour->price} per person",
                    "Duration: {$tour->duration} days",
                    "Group size: up to {$tour->capacity_of_people} people",
                ];
                if ($tour->season) {
                    $parts[] = "Season: {$tour->season}";
                }
                if ($categories) {
                    $parts[] = "Categories: {$categories}";
                }
                $tourDetails = implode(' | ', $parts);
            }
        }

        return view('pages.booking', compact('about', 'tourDetails'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string',
            'email'       => 'required|email',
            'destination' => 'required|string',
            'tour_details' => 'nullable|string',
            'message'     => 'required|string',
        ]);

        app(GoogleSheetsService::class)->appendRow(
            [
                now()->format('d.m.Y H:i'),
                $validated['name'],
                $validated['email'],
                $validated['destination'],
                $validated['tour_details'] ?? '',
                $validated['message'],
            ]
        );

        return back()->with('success', 'Заявка отправлена!');
    }
}
