<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Vehicle::available()->featured()->with('images')->latest()->take(6)->get();
        $makes = Vehicle::available()->distinct()->pluck('make')->sort()->values();
        $stats = [
            'total' => Vehicle::available()->count(),
            'makes' => Vehicle::available()->distinct('make')->count('make'),
            'newest' => Vehicle::available()->max('year'),
        ];

        return view('home', compact('featured', 'makes', 'stats'));
    }
}
