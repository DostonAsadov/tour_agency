<?php

namespace App\Http\Controllers;

use App\Services\GoogleSheetsService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('pages.booking'); // resources/views/pages/booking.blade.php
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string',
            'email'         => 'required|email',
            'destination'     => 'required|string',
            'message'      => 'required|string',
        ]);

        app(GoogleSheetsService::class)->appendRow(
            [
                now()->format('d.m.Y H:i'),
                $validated['name'],
                $validated['email'],
                $validated['destination'],
                $validated['message'],
            ]
        );

        return back()->with('success', 'Заявка отправлена!');
    }
}
