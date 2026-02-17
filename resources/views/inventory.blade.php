@extends('layouts.public')

@section('title', 'Inventory')
@section('description', 'Browse our curated collection of premium pre-owned vehicles.')

@section('content')

<section class="pt-28 pb-24 bg-zinc-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10">
            <span class="text-xs font-medium text-amber-500 uppercase tracking-[0.2em]">Our Collection</span>
            <h1 class="font-display text-3xl sm:text-4xl font-bold text-white mt-2">Vehicle Inventory</h1>
            <p class="mt-2 text-zinc-500">{{ $vehicles->total() }} vehicles available</p>
        </div>

        {{-- Filters --}}
        <form method="GET" action="{{ route('inventory') }}" x-data="{ open: false }"
              class="mb-10 p-5 bg-zinc-900 rounded-xl border border-zinc-800/50">

            {{-- Search --}}
            <div class="flex gap-3">
                <div class="flex-1 relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search make, model, or keyword..."
                           class="w-full pl-10 pr-4 py-3 bg-zinc-800 border border-zinc-700/50 rounded-lg text-sm text-white placeholder-zinc-500 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/30">
                </div>
                <button type="button" @click="open = !open"
                        class="px-4 py-3 bg-zinc-800 border border-zinc-700/50 rounded-lg text-sm text-zinc-400 hover:text-white hover:border-zinc-600 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75"/></svg>
                    Filters
                </button>
                <button type="submit" class="px-6 py-3 bg-amber-500 text-zinc-950 text-sm font-semibold rounded-lg hover:bg-amber-400 transition-colors">
                    Search
                </button>
            </div>

            {{-- Advanced Filters --}}
            <div x-show="open" x-cloak x-transition class="mt-4 pt-4 border-t border-zinc-800/50 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                <select name="make" class="bg-zinc-800 border border-zinc-700/50 rounded-lg text-sm text-zinc-300 py-2.5 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/30">
                    <option value="">All Makes</option>
                    @foreach($makes as $make)
                        <option value="{{ $make }}" {{ request('make') == $make ? 'selected' : '' }}>{{ $make }}</option>
                    @endforeach
                </select>
                <select name="body_type" class="bg-zinc-800 border border-zinc-700/50 rounded-lg text-sm text-zinc-300 py-2.5 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/30">
                    <option value="">All Types</option>
                    @foreach($bodyTypes as $type)
                        <option value="{{ $type }}" {{ request('body_type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
                <select name="fuel_type" class="bg-zinc-800 border border-zinc-700/50 rounded-lg text-sm text-zinc-300 py-2.5 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/30">
                    <option value="">All Fuel</option>
                    @foreach($fuelTypes as $fuel)
                        <option value="{{ $fuel }}" {{ request('fuel_type') == $fuel ? 'selected' : '' }}>{{ ucfirst($fuel) }}</option>
                    @endforeach
                </select>
                <select name="min_price" class="bg-zinc-800 border border-zinc-700/50 rounded-lg text-sm text-zinc-300 py-2.5 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/30">
                    <option value="">Min Price</option>
                    @foreach([25000, 50000, 75000, 100000, 150000] as $p)
                        <option value="{{ $p }}" {{ request('min_price') == $p ? 'selected' : '' }}>${{ number_format($p, 0) }}</option>
                    @endforeach
                </select>
                <select name="max_price" class="bg-zinc-800 border border-zinc-700/50 rounded-lg text-sm text-zinc-300 py-2.5 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/30">
                    <option value="">Max Price</option>
                    @foreach([50000, 75000, 100000, 150000, 200000] as $p)
                        <option value="{{ $p }}" {{ request('max_price') == $p ? 'selected' : '' }}>${{ number_format($p, 0) }}</option>
                    @endforeach
                </select>
                <a href="{{ route('inventory') }}" class="flex items-center justify-center text-sm text-zinc-500 hover:text-amber-500 transition-colors">
                    Clear All
                </a>
            </div>
        </form>

        {{-- Vehicle Grid --}}
        @if($vehicles->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($vehicles as $vehicle)
                    <a href="{{ route('vehicle.show', $vehicle) }}" class="group relative bg-zinc-900 rounded-xl overflow-hidden border border-zinc-800/50 hover:border-zinc-700/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-amber-500/5">
                        <div class="aspect-[16/10] overflow-hidden">
                            <img src="{{ $vehicle->hero_image }}" alt="{{ $vehicle->full_name }}"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                            <div class="absolute top-4 left-4 flex gap-2">
                                @if($vehicle->fuel_type === 'electric')
                                    <span class="px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider bg-blue-500/90 text-white rounded-md">Electric</span>
                                @elseif($vehicle->fuel_type === 'hybrid')
                                    <span class="px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider bg-teal-500/90 text-white rounded-md">Hybrid</span>
                                @endif
                                @if($vehicle->featured)
                                    <span class="px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider bg-amber-500/90 text-zinc-950 rounded-md">Featured</span>
                                @endif
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="font-display text-lg font-semibold text-white group-hover:text-amber-500 transition-colors">{{ $vehicle->full_name }}</h3>
                                    <p class="text-sm text-zinc-500 mt-0.5">{{ $vehicle->exterior_color }}</p>
                                </div>
                                <span class="text-lg font-bold text-amber-500 whitespace-nowrap">{{ $vehicle->formatted_price }}</span>
                            </div>
                            <div class="mt-4 pt-4 border-t border-zinc-800/50 flex items-center gap-4 text-xs text-zinc-500">
                                <span>{{ $vehicle->formatted_mileage }}</span>
                                <span>{{ ucfirst($vehicle->transmission) }}</span>
                                <span>{{ $vehicle->horsepower }} hp</span>
                                <span>{{ strtoupper($vehicle->drivetrain) }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $vehicles->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <svg class="w-16 h-16 mx-auto text-zinc-700" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                <h3 class="mt-4 font-display text-xl font-semibold text-white">No vehicles found</h3>
                <p class="mt-2 text-zinc-500">Try adjusting your filters or <a href="{{ route('inventory') }}" class="text-amber-500 hover:underline">view all vehicles</a>.</p>
            </div>
        @endif

    </div>
</section>

@endsection
