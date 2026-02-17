@extends('layouts.public')

@section('title', 'AutoHaven')
@section('description', 'Curated collection of premium pre-owned vehicles. Every car tells a story.')

@section('content')

{{-- Hero --}}
<section class="relative min-h-screen flex items-center overflow-hidden">
    {{-- Background --}}
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=1920&q=80" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-zinc-950 via-zinc-950/80 to-zinc-950/40"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-transparent to-zinc-950/30"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20">
        <div class="max-w-2xl">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-amber-500/10 border border-amber-500/20 rounded-full mb-8">
                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                <span class="text-xs font-medium text-amber-500 tracking-wide uppercase">{{ $stats['total'] }} Vehicles Available</span>
            </div>

            <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl font-bold text-white leading-[1.1] tracking-tight">
                Where Exceptional
                <span class="block text-amber-500">Cars Find Home</span>
            </h1>

            <p class="mt-6 text-lg text-zinc-400 leading-relaxed max-w-lg">
                Hand-selected from {{ $stats['makes'] }} premium marques. Every vehicle inspected, every history verified, every detail accounted for.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('inventory') }}" class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold bg-amber-500 text-zinc-950 rounded-lg hover:bg-amber-400 transition-all hover:shadow-lg hover:shadow-amber-500/25 hover:-translate-y-0.5">
                    Explore Collection
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                </a>
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold border border-zinc-700 text-zinc-300 rounded-lg hover:bg-zinc-800/50 hover:border-zinc-600 transition-all">
                    Schedule a Visit
                </a>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-zinc-600">
        <span class="text-[10px] uppercase tracking-[0.3em]">Scroll</span>
        <div class="w-px h-8 bg-gradient-to-b from-zinc-600 to-transparent animate-pulse"></div>
    </div>
</section>

{{-- Featured Vehicles --}}
<section class="py-24 bg-zinc-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-12">
            <div>
                <span class="text-xs font-medium text-amber-500 uppercase tracking-[0.2em]">Handpicked</span>
                <h2 class="font-display text-3xl sm:text-4xl font-bold text-white mt-2">Featured Vehicles</h2>
            </div>
            <a href="{{ route('inventory') }}" class="hidden sm:inline-flex items-center gap-2 text-sm text-zinc-400 hover:text-amber-500 transition-colors">
                View All
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featured as $vehicle)
                <a href="{{ route('vehicle.show', $vehicle) }}" class="group relative bg-zinc-900 rounded-xl overflow-hidden border border-zinc-800/50 hover:border-zinc-700/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-amber-500/5">
                    {{-- Image --}}
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ $vehicle->hero_image }}" alt="{{ $vehicle->full_name }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                             loading="lazy">
                        <div class="absolute top-4 left-4 flex gap-2">
                            @if($vehicle->condition === 'certified')
                                <span class="px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider bg-emerald-500/90 text-white rounded-md">Certified</span>
                            @endif
                            @if($vehicle->fuel_type === 'electric')
                                <span class="px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider bg-blue-500/90 text-white rounded-md">Electric</span>
                            @elseif($vehicle->fuel_type === 'hybrid')
                                <span class="px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wider bg-teal-500/90 text-white rounded-md">Hybrid</span>
                            @endif
                        </div>
                    </div>

                    {{-- Details --}}
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="font-display text-lg font-semibold text-white group-hover:text-amber-500 transition-colors">{{ $vehicle->full_name }}</h3>
                                <p class="text-sm text-zinc-500 mt-0.5">{{ $vehicle->exterior_color }}</p>
                            </div>
                            <span class="text-lg font-bold text-amber-500 whitespace-nowrap">{{ $vehicle->formatted_price }}</span>
                        </div>
                        <div class="mt-4 pt-4 border-t border-zinc-800/50 flex items-center gap-4 text-xs text-zinc-500">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $vehicle->formatted_mileage }}
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $vehicle->transmission }}
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
                                {{ $vehicle->horsepower }} hp
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-10 text-center sm:hidden">
            <a href="{{ route('inventory') }}" class="inline-flex items-center gap-2 px-6 py-3 text-sm font-medium border border-zinc-700 text-zinc-300 rounded-lg hover:bg-zinc-800/50 transition-colors">
                View Full Inventory
            </a>
        </div>
    </div>
</section>

{{-- Why Choose Us --}}
<section class="py-24 bg-zinc-900/50 border-y border-zinc-800/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-xs font-medium text-amber-500 uppercase tracking-[0.2em]">The AutoHaven Difference</span>
            <h2 class="font-display text-3xl sm:text-4xl font-bold text-white mt-2">Not Just Cars. Confidence.</h2>
            <p class="mt-4 text-zinc-400">Every vehicle passes our 150-point inspection. Every history is transparent. Every transaction, straightforward.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-8 rounded-xl bg-zinc-900 border border-zinc-800/50">
                <div class="w-14 h-14 mx-auto bg-amber-500/10 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                </div>
                <h3 class="font-display text-lg font-semibold text-white">150-Point Inspection</h3>
                <p class="mt-3 text-sm text-zinc-500 leading-relaxed">Mechanical, electrical, cosmetic — nothing hidden. Full report provided with every vehicle.</p>
            </div>
            <div class="text-center p-8 rounded-xl bg-zinc-900 border border-zinc-800/50">
                <div class="w-14 h-14 mx-auto bg-amber-500/10 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                </div>
                <h3 class="font-display text-lg font-semibold text-white">Transparent History</h3>
                <p class="mt-3 text-sm text-zinc-500 leading-relaxed">Full vehicle history, service records, and ownership documentation. Know everything before you buy.</p>
            </div>
            <div class="text-center p-8 rounded-xl bg-zinc-900 border border-zinc-800/50">
                <div class="w-14 h-14 mx-auto bg-amber-500/10 rounded-xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                </div>
                <h3 class="font-display text-lg font-semibold text-white">Personal Service</h3>
                <p class="mt-3 text-sm text-zinc-500 leading-relaxed">Dedicated advisor from first inquiry to handover. No pressure, no gimmicks. Just people who know cars.</p>
            </div>
        </div>
    </div>
</section>

{{-- Browse by Brand --}}
<section class="py-24 bg-zinc-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-xs font-medium text-amber-500 uppercase tracking-[0.2em]">Our Collection</span>
            <h2 class="font-display text-3xl sm:text-4xl font-bold text-white mt-2">Browse by Marque</h2>
        </div>

        <div class="flex flex-wrap justify-center gap-3">
            @foreach($makes as $make)
                <a href="{{ route('inventory', ['make' => $make]) }}"
                   class="px-6 py-3 text-sm font-medium bg-zinc-900 border border-zinc-800/50 text-zinc-400 rounded-lg hover:border-amber-500/50 hover:text-amber-500 hover:bg-amber-500/5 transition-all">
                    {{ $make }}
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-24 bg-zinc-900/50 border-t border-zinc-800/30">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-display text-3xl sm:text-4xl font-bold text-white">Ready to Find Your Next Car?</h2>
        <p class="mt-4 text-lg text-zinc-400">Visit our showroom or browse online. We're here when you are.</p>
        <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('inventory') }}" class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold bg-amber-500 text-zinc-950 rounded-lg hover:bg-amber-400 transition-all hover:shadow-lg hover:shadow-amber-500/25">
                Browse Inventory
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 text-sm font-semibold border border-zinc-700 text-zinc-300 rounded-lg hover:bg-zinc-800/50 transition-all">
                Get in Touch
            </a>
        </div>
    </div>
</section>

@endsection
