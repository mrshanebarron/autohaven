<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = Vehicle::available()
            ->filter($request->only(['make', 'body_type', 'min_price', 'max_price', 'min_year', 'max_year', 'condition', 'fuel_type', 'search']))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $makes = Vehicle::available()->distinct()->pluck('make')->sort()->values();
        $bodyTypes = Vehicle::available()->distinct()->pluck('body_type')->sort()->values();
        $fuelTypes = Vehicle::available()->distinct()->pluck('fuel_type')->sort()->values();

        return view('inventory', compact('vehicles', 'makes', 'bodyTypes', 'fuelTypes'));
    }
}
