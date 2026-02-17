<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Vehicle;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_vehicles' => Vehicle::count(),
            'available' => Vehicle::available()->count(),
            'sold' => Vehicle::where('status', 'sold')->count(),
            'pending' => Vehicle::where('status', 'pending')->count(),
            'total_value' => Vehicle::available()->sum('price'),
            'new_inquiries' => Inquiry::new()->count(),
            'total_inquiries' => Inquiry::count(),
        ];

        $recentInquiries = Inquiry::with('vehicle')->latest()->take(5)->get();
        $recentVehicles = Vehicle::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentInquiries', 'recentVehicles'));
    }
}
