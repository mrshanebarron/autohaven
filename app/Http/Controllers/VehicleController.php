<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function show(Vehicle $vehicle)
    {
        $vehicle->load('images');
        $similar = Vehicle::available()
            ->where('id', '!=', $vehicle->id)
            ->where(function ($q) use ($vehicle) {
                $q->where('make', $vehicle->make)
                  ->orWhere('body_type', $vehicle->body_type);
            })
            ->take(3)
            ->get();

        return view('vehicle-show', compact('vehicle', 'similar'));
    }
}
