<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        return view('pages.home');
    }

    public function about()
    {
        $about = About::query()->findOrFail(1);
        return view('pages.about', [
            'about' => $about
        ]);
    }
}
