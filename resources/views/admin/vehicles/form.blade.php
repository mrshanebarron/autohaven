<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($vehicle) ? 'Edit: ' . $vehicle->full_name : 'Add Vehicle' }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form method="POST"
                  action="{{ isset($vehicle) ? route('admin.vehicles.update', $vehicle) : route('admin.vehicles.store') }}"
                  class="bg-white rounded-lg shadow-sm border p-8 space-y-6">
                @csrf
                @if(isset($vehicle)) @method('PUT') @endif

                {{-- Basic Info --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Make</label>
                        <input type="text" name="make" value="{{ old('make', $vehicle->make ?? '') }}" required
                               class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                        @error('make') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Model</label>
                        <input type="text" name="model" value="{{ old('model', $vehicle->model ?? '') }}" required
                               class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                        <input type="number" name="year" value="{{ old('year', $vehicle->year ?? date('Y')) }}" required
                               class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>
                </div>

                {{-- Pricing & Mileage --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
                        <input type="number" name="price" value="{{ old('price', $vehicle->price ?? '') }}" required step="0.01"
                               class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mileage</label>
                        <input type="number" name="mileage" value="{{ old('mileage', $vehicle->mileage ?? 0) }}" required
                               class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">VIN</label>
                        <input type="text" name="vin" value="{{ old('vin', $vehicle->vin ?? '') }}" required maxlength="17"
                               class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500 font-mono">
                    </div>
                </div>

                {{-- Colors --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Exterior Color</label>
                        <input type="text" name="exterior_color" value="{{ old('exterior_color', $vehicle->exterior_color ?? '') }}" required
                               class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Interior Color</label>
                        <input type="text" name="interior_color" value="{{ old('interior_color', $vehicle->interior_color ?? '') }}"
                               class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>
                </div>

                {{-- Specs --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Body Type</label>
                        <select name="body_type" required class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                            @foreach(['sedan','suv','coupe','truck','convertible','van'] as $t)
                                <option value="{{ $t }}" {{ old('body_type', $vehicle->body_type ?? '') === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Transmission</label>
                        <select name="transmission" required class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                            <option value="automatic" {{ old('transmission', $vehicle->transmission ?? '') === 'automatic' ? 'selected' : '' }}>Automatic</option>
                            <option value="manual" {{ old('transmission', $vehicle->transmission ?? '') === 'manual' ? 'selected' : '' }}>Manual</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fuel Type</label>
                        <select name="fuel_type" required class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                            @foreach(['gasoline','diesel','electric','hybrid'] as $f)
                                <option value="{{ $f }}" {{ old('fuel_type', $vehicle->fuel_type ?? '') === $f ? 'selected' : '' }}>{{ ucfirst($f) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Drivetrain</label>
                        <select name="drivetrain" required class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                            @foreach(['fwd','rwd','awd','4wd'] as $d)
                                <option value="{{ $d }}" {{ old('drivetrain', $vehicle->drivetrain ?? '') === $d ? 'selected' : '' }}>{{ strtoupper($d) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Engine --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Engine</label>
                        <input type="text" name="engine" value="{{ old('engine', $vehicle->engine ?? '') }}"
                               class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Horsepower</label>
                        <input type="number" name="horsepower" value="{{ old('horsepower', $vehicle->horsepower ?? '') }}"
                               class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>
                </div>

                {{-- Status & Condition --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Condition</label>
                        <select name="condition" required class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                            @foreach(['new','used','certified'] as $c)
                                <option value="{{ $c }}" {{ old('condition', $vehicle->condition ?? 'used') === $c ? 'selected' : '' }}>{{ ucfirst($c) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" required class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">
                            @foreach(['available','pending','sold'] as $s)
                                <option value="{{ $s }}" {{ old('status', $vehicle->status ?? 'available') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <label class="flex items-center gap-2">
                            <input type="hidden" name="featured" value="0">
                            <input type="checkbox" name="featured" value="1"
                                   {{ old('featured', $vehicle->featured ?? false) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                            <span class="text-sm font-medium text-gray-700">Featured Vehicle</span>
                        </label>
                    </div>
                </div>

                {{-- Hero Image --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hero Image URL</label>
                    <input type="url" name="hero_image" value="{{ old('hero_image', $vehicle->hero_image ?? '') }}"
                           class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500"
                           placeholder="https://images.unsplash.com/...">
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="4"
                              class="w-full rounded-lg border-gray-300 text-sm focus:border-amber-500 focus:ring-amber-500">{{ old('description', $vehicle->description ?? '') }}</textarea>
                </div>

                {{-- Stock Number (hidden for auto-gen on create) --}}
                @if(isset($vehicle))
                    <input type="hidden" name="stock_number" value="{{ $vehicle->stock_number }}">
                @endif

                {{-- Submit --}}
                <div class="flex items-center gap-3 pt-4 border-t">
                    <button type="submit" class="px-6 py-2.5 bg-amber-500 text-white text-sm font-medium rounded-lg hover:bg-amber-600 transition-colors">
                        {{ isset($vehicle) ? 'Update Vehicle' : 'Add Vehicle' }}
                    </button>
                    <a href="{{ route('admin.vehicles.index') }}" class="px-6 py-2.5 text-sm text-gray-500 hover:text-gray-700">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
