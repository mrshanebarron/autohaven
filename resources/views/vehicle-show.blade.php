@extends('layouts.public')

@section('title', $vehicle->full_name)
@section('description', Str::limit($vehicle->description, 155))

@section('content')

<section class="pt-24 pb-24 bg-zinc-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-zinc-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            <a href="{{ route('inventory') }}" class="hover:text-white transition-colors">Inventory</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
            <span class="text-zinc-400">{{ $vehicle->full_name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">

            {{-- Main Image --}}
            <div class="lg:col-span-3">
                <div class="aspect-[16/10] rounded-xl overflow-hidden border border-zinc-800/50">
                    <img src="{{ $vehicle->hero_image }}" alt="{{ $vehicle->full_name }}" class="w-full h-full object-cover">
                </div>

                {{-- Description --}}
                <div class="mt-8">
                    <h2 class="font-display text-xl font-semibold text-white mb-4">About This Vehicle</h2>
                    <p class="text-zinc-400 leading-relaxed">{{ $vehicle->description }}</p>
                </div>

                {{-- Features --}}
                @if($vehicle->features)
                    <div class="mt-8">
                        <h2 class="font-display text-xl font-semibold text-white mb-4">Key Features</h2>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($vehicle->features as $feature)
                                <div class="flex items-center gap-2 py-2 px-3 bg-zinc-900 rounded-lg border border-zinc-800/30">
                                    <svg class="w-4 h-4 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                    <span class="text-sm text-zinc-300">{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Price & Title Card --}}
                <div class="p-6 bg-zinc-900 rounded-xl border border-zinc-800/50">
                    <div class="flex items-center gap-2 mb-3">
                        @if($vehicle->fuel_type === 'electric')
                            <span class="px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-md">Electric</span>
                        @elseif($vehicle->fuel_type === 'hybrid')
                            <span class="px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider bg-teal-500/20 text-teal-400 border border-teal-500/30 rounded-md">Hybrid</span>
                        @endif
                        <span class="px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider bg-zinc-800 text-zinc-400 border border-zinc-700/50 rounded-md">{{ ucfirst($vehicle->condition) }}</span>
                    </div>

                    <h1 class="font-display text-2xl sm:text-3xl font-bold text-white">{{ $vehicle->full_name }}</h1>
                    <p class="text-sm text-zinc-500 mt-1">{{ $vehicle->exterior_color }} / {{ $vehicle->interior_color }}</p>

                    <div class="mt-4 pt-4 border-t border-zinc-800/50">
                        <span class="font-display text-3xl font-bold text-amber-500">{{ $vehicle->formatted_price }}</span>
                    </div>
                </div>

                {{-- Specs --}}
                <div class="p-6 bg-zinc-900 rounded-xl border border-zinc-800/50">
                    <h3 class="font-display text-lg font-semibold text-white mb-4">Specifications</h3>
                    <dl class="space-y-3">
                        <div class="flex justify-between py-2 border-b border-zinc-800/30">
                            <dt class="text-sm text-zinc-500">Mileage</dt>
                            <dd class="text-sm font-medium text-white">{{ $vehicle->formatted_mileage }}</dd>
                        </div>
                        <div class="flex justify-between py-2 border-b border-zinc-800/30">
                            <dt class="text-sm text-zinc-500">Engine</dt>
                            <dd class="text-sm font-medium text-white">{{ $vehicle->engine }}</dd>
                        </div>
                        <div class="flex justify-between py-2 border-b border-zinc-800/30">
                            <dt class="text-sm text-zinc-500">Horsepower</dt>
                            <dd class="text-sm font-medium text-white">{{ $vehicle->horsepower }} hp</dd>
                        </div>
                        <div class="flex justify-between py-2 border-b border-zinc-800/30">
                            <dt class="text-sm text-zinc-500">Transmission</dt>
                            <dd class="text-sm font-medium text-white">{{ ucfirst($vehicle->transmission) }}</dd>
                        </div>
                        <div class="flex justify-between py-2 border-b border-zinc-800/30">
                            <dt class="text-sm text-zinc-500">Drivetrain</dt>
                            <dd class="text-sm font-medium text-white">{{ strtoupper($vehicle->drivetrain) }}</dd>
                        </div>
                        <div class="flex justify-between py-2 border-b border-zinc-800/30">
                            <dt class="text-sm text-zinc-500">Fuel Type</dt>
                            <dd class="text-sm font-medium text-white">{{ ucfirst($vehicle->fuel_type) }}</dd>
                        </div>
                        <div class="flex justify-between py-2 border-b border-zinc-800/30">
                            <dt class="text-sm text-zinc-500">Body Type</dt>
                            <dd class="text-sm font-medium text-white">{{ ucfirst($vehicle->body_type) }}</dd>
                        </div>
                        <div class="flex justify-between py-2 border-b border-zinc-800/30">
                            <dt class="text-sm text-zinc-500">VIN</dt>
                            <dd class="text-xs font-mono font-medium text-zinc-400">{{ $vehicle->vin }}</dd>
                        </div>
                        <div class="flex justify-between py-2">
                            <dt class="text-sm text-zinc-500">Stock #</dt>
                            <dd class="text-sm font-medium text-white">{{ $vehicle->stock_number }}</dd>
                        </div>
                    </dl>
                </div>

                {{-- Inquiry Form --}}
                <div class="p-6 bg-zinc-900 rounded-xl border border-zinc-800/50">
                    <h3 class="font-display text-lg font-semibold text-white mb-4">Interested? Get in Touch</h3>

                    <form method="POST" action="{{ route('inquiries.store') }}" class="space-y-3">
                        @csrf
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                        <input type="text" name="name" placeholder="Your Name" required
                               class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700/50 rounded-lg text-sm text-white placeholder-zinc-500 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/30"
                               value="{{ old('name') }}">
                        @error('name') <p class="text-xs text-red-400">{{ $message }}</p> @enderror

                        <input type="email" name="email" placeholder="Email Address" required
                               class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700/50 rounded-lg text-sm text-white placeholder-zinc-500 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/30"
                               value="{{ old('email') }}">
                        @error('email') <p class="text-xs text-red-400">{{ $message }}</p> @enderror

                        <input type="tel" name="phone" placeholder="Phone (optional)"
                               class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700/50 rounded-lg text-sm text-white placeholder-zinc-500 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/30"
                               value="{{ old('phone') }}">

                        <textarea name="message" rows="3" placeholder="I'm interested in this {{ $vehicle->full_name }}..." required
                                  class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700/50 rounded-lg text-sm text-white placeholder-zinc-500 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/30 resize-none">{{ old('message') }}</textarea>
                        @error('message') <p class="text-xs text-red-400">{{ $message }}</p> @enderror

                        <button type="submit" class="w-full py-3 bg-amber-500 text-zinc-950 text-sm font-semibold rounded-lg hover:bg-amber-400 transition-all hover:shadow-lg hover:shadow-amber-500/25">
                            Send Inquiry
                        </button>
                    </form>

                    <p class="mt-3 text-xs text-zinc-600 text-center">Or call us at <a href="tel:+13105551234" class="text-amber-500 hover:underline">(310) 555-1234</a></p>
                </div>
            </div>
        </div>

        {{-- Similar Vehicles --}}
        @if($similar->count())
            <div class="mt-20">
                <h2 class="font-display text-2xl font-bold text-white mb-8">You May Also Like</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($similar as $car)
                        <a href="{{ route('vehicle.show', $car) }}" class="group bg-zinc-900 rounded-xl overflow-hidden border border-zinc-800/50 hover:border-zinc-700/50 transition-all duration-300 hover:-translate-y-1">
                            <div class="aspect-[16/10] overflow-hidden">
                                <img src="{{ $car->hero_image }}" alt="{{ $car->full_name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy">
                            </div>
                            <div class="p-5">
                                <h3 class="font-display font-semibold text-white group-hover:text-amber-500 transition-colors">{{ $car->full_name }}</h3>
                                <div class="mt-2 flex items-center justify-between text-sm">
                                    <span class="text-zinc-500">{{ $car->formatted_mileage }}</span>
                                    <span class="font-bold text-amber-500">{{ $car->formatted_price }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</section>

@endsection
