<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AutoHaven') — Premium Pre-Owned Vehicles</title>
    <meta name="description" content="@yield('description', 'Curated collection of premium pre-owned vehicles. Every car tells a story.')">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,500,600,700,800,900|inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-100 font-sans antialiased">

    {{-- Navigation --}}
    <nav class="fixed top-0 w-full z-50 transition-all duration-500" x-data="{ scrolled: false, mobileOpen: false }"
         x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
         :class="scrolled ? 'bg-zinc-950/95 backdrop-blur-md border-b border-zinc-800/50 shadow-2xl' : 'bg-transparent'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-amber-500 rounded flex items-center justify-center transform group-hover:rotate-3 transition-transform">
                        <svg class="w-6 h-6 text-zinc-950" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0H21m-3-4.5V8.625c0-.621-.504-1.125-1.125-1.125H12m0 0V3.375c0-.621-.504-1.125-1.125-1.125H5.625c-.621 0-1.125.504-1.125 1.125v3.75M12 7.5H5.625c-.621 0-1.125.504-1.125 1.125v4.5"/></svg>
                    </div>
                    <div>
                        <span class="font-display text-xl font-bold tracking-tight text-white">Auto<span class="text-amber-500">Haven</span></span>
                        <span class="block text-[10px] uppercase tracking-[0.25em] text-zinc-500 -mt-0.5">Premium Vehicles</span>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('home') ? 'text-amber-500' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }}">Home</a>
                    <a href="{{ route('inventory') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('inventory') ? 'text-amber-500' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }}">Inventory</a>
                    <a href="{{ route('about') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('about') ? 'text-amber-500' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }}">About</a>
                    <a href="{{ route('contact') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('contact') ? 'text-amber-500' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }}">Contact</a>
                    <span class="w-px h-6 bg-zinc-800 mx-2"></span>
                    <a href="{{ route('inventory') }}" class="px-5 py-2.5 text-sm font-semibold bg-amber-500 text-zinc-950 rounded-lg hover:bg-amber-400 transition-colors">
                        Browse Collection
                    </a>
                </div>

                {{-- Mobile toggle --}}
                <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 text-zinc-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        <path x-show="mobileOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Mobile menu --}}
            <div x-show="mobileOpen" x-cloak x-transition class="md:hidden pb-4 border-t border-zinc-800">
                <a href="{{ route('home') }}" class="block px-4 py-3 text-sm text-zinc-300 hover:text-white hover:bg-zinc-800/50 rounded-lg">Home</a>
                <a href="{{ route('inventory') }}" class="block px-4 py-3 text-sm text-zinc-300 hover:text-white hover:bg-zinc-800/50 rounded-lg">Inventory</a>
                <a href="{{ route('about') }}" class="block px-4 py-3 text-sm text-zinc-300 hover:text-white hover:bg-zinc-800/50 rounded-lg">About</a>
                <a href="{{ route('contact') }}" class="block px-4 py-3 text-sm text-zinc-300 hover:text-white hover:bg-zinc-800/50 rounded-lg">Contact</a>
            </div>
        </div>
    </nav>

    {{-- Flash messages --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" x-transition
             class="fixed top-24 right-4 z-50 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-6 py-3 rounded-lg backdrop-blur-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-zinc-950 border-t border-zinc-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div class="md:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-amber-500 rounded flex items-center justify-center">
                            <svg class="w-6 h-6 text-zinc-950" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0H21m-3-4.5V8.625c0-.621-.504-1.125-1.125-1.125H12m0 0V3.375c0-.621-.504-1.125-1.125-1.125H5.625c-.621 0-1.125.504-1.125 1.125v3.75M12 7.5H5.625c-.621 0-1.125.504-1.125 1.125v4.5"/></svg>
                        </div>
                        <span class="font-display text-xl font-bold text-white">Auto<span class="text-amber-500">Haven</span></span>
                    </a>
                    <p class="mt-4 text-sm text-zinc-500 leading-relaxed">Curated collection of premium pre-owned vehicles. Every car we sell has been inspected, verified, and handpicked.</p>
                </div>
                <div>
                    <h4 class="font-display font-semibold text-white mb-4">Browse</h4>
                    <ul class="space-y-2 text-sm text-zinc-500">
                        <li><a href="{{ route('inventory', ['body_type' => 'sedan']) }}" class="hover:text-amber-500 transition-colors">Sedans</a></li>
                        <li><a href="{{ route('inventory', ['body_type' => 'suv']) }}" class="hover:text-amber-500 transition-colors">SUVs</a></li>
                        <li><a href="{{ route('inventory', ['body_type' => 'coupe']) }}" class="hover:text-amber-500 transition-colors">Coupes</a></li>
                        <li><a href="{{ route('inventory', ['body_type' => 'truck']) }}" class="hover:text-amber-500 transition-colors">Trucks</a></li>
                        <li><a href="{{ route('inventory', ['fuel_type' => 'electric']) }}" class="hover:text-amber-500 transition-colors">Electric</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-display font-semibold text-white mb-4">Company</h4>
                    <ul class="space-y-2 text-sm text-zinc-500">
                        <li><a href="{{ route('about') }}" class="hover:text-amber-500 transition-colors">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-amber-500 transition-colors">Contact</a></li>
                        <li><a href="{{ route('inventory') }}" class="hover:text-amber-500 transition-colors">Full Inventory</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-display font-semibold text-white mb-4">Visit Us</h4>
                    <ul class="space-y-2 text-sm text-zinc-500">
                        <li>123 Motor Row</li>
                        <li>Beverly Hills, CA 90210</li>
                        <li class="pt-2"><a href="tel:+13105551234" class="hover:text-amber-500 transition-colors">(310) 555-1234</a></li>
                        <li><a href="mailto:hello@autohaven.com" class="hover:text-amber-500 transition-colors">hello@autohaven.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-zinc-800/50 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-zinc-600">&copy; {{ date('Y') }} AutoHaven. All rights reserved.</p>
                <p class="text-xs text-zinc-700">Mon–Sat 9AM–7PM &middot; Sun 11AM–5PM</p>
            </div>
        </div>
    </footer>

</body>
</html>
