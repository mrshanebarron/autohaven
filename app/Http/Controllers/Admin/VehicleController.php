<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $vehicles = Vehicle::when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->when($request->search, fn ($q, $s) => $q->where('make', 'like', "%{$s}%")->orWhere('model', 'like', "%{$s}%"))
            ->latest()
            ->paginate(15);

        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('admin.vehicles.form');
    }

    public function store(Request $request)
    {
        $validated = $this->validateVehicle($request);
        Vehicle::create($validated);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle added successfully.');
    }

    public function show(Vehicle $vehicle)
    {
        return redirect()->route('vehicle.show', $vehicle);
    }

    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.form', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $this->validateVehicle($request);
        $vehicle->update($validated);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle deleted.');
    }

    private function validateVehicle(Request $request): array
    {
        return $request->validate([
            'make' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'mileage' => 'required|integer|min:0',
            'exterior_color' => 'required|string|max:100',
            'interior_color' => 'nullable|string|max:100',
            'vin' => 'required|string|size:17',
            'stock_number' => 'nullable|string|max:20',
            'body_type' => 'required|string',
            'transmission' => 'required|string',
            'fuel_type' => 'required|string',
            'drivetrain' => 'required|string',
            'engine' => 'nullable|string|max:100',
            'horsepower' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'condition' => 'required|string',
            'status' => 'required|string',
            'featured' => 'boolean',
            'hero_image' => 'nullable|string|max:500',
        ]);
    }
}
