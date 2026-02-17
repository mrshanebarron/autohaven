@extends('layouts.public')

@section('title', 'About')

@section('content')

<section class="pt-28 pb-24 bg-zinc-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="max-w-3xl">
            <span class="text-xs font-medium text-amber-500 uppercase tracking-[0.2em]">Our Story</span>
            <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mt-2 leading-tight">Built on the Belief That<br>Buying a Car Should Feel <span class="text-amber-500">Right</span></h1>
            <p class="mt-6 text-lg text-zinc-400 leading-relaxed">
                AutoHaven started with a simple frustration: the experience of buying a pre-owned luxury vehicle was broken. Pressure tactics, hidden histories, and showrooms that felt more like interrogation rooms than places you'd want to spend your Saturday.
            </p>
        </div>

        {{-- Image --}}
        <div class="mt-12 aspect-[21/9] rounded-xl overflow-hidden border border-zinc-800/50">
            <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=1920&q=80" alt="AutoHaven showroom" class="w-full h-full object-cover">
        </div>

        {{-- Values --}}
        <div class="mt-20 grid grid-cols-1 md:grid-cols-2 gap-16">
            <div>
                <h2 class="font-display text-2xl font-bold text-white">What We Believe</h2>
                <div class="mt-8 space-y-8">
                    <div>
                        <h3 class="font-display text-lg font-semibold text-amber-500">Transparency First</h3>
                        <p class="mt-2 text-zinc-400 leading-relaxed">Every vehicle comes with a complete history report, 150-point inspection results, and honest assessment of condition. No surprises after the sale.</p>
                    </div>
                    <div>
                        <h3 class="font-display text-lg font-semibold text-amber-500">Quality Over Quantity</h3>
                        <p class="mt-2 text-zinc-400 leading-relaxed">We turn away more cars than we accept. Our buyers hand-select every vehicle, and if it doesn't meet our standards, it doesn't make the floor.</p>
                    </div>
                    <div>
                        <h3 class="font-display text-lg font-semibold text-amber-500">Relationships, Not Transactions</h3>
                        <p class="mt-2 text-zinc-400 leading-relaxed">Most of our clients come back. Many send friends. We're building something that lasts longer than a single purchase.</p>
                    </div>
                </div>
            </div>
            <div>
                <h2 class="font-display text-2xl font-bold text-white">By the Numbers</h2>
                <div class="mt-8 grid grid-cols-2 gap-6">
                    <div class="p-6 bg-zinc-900 rounded-xl border border-zinc-800/50 text-center">
                        <span class="font-display text-3xl font-bold text-amber-500">12</span>
                        <p class="mt-1 text-sm text-zinc-500">Years in Business</p>
                    </div>
                    <div class="p-6 bg-zinc-900 rounded-xl border border-zinc-800/50 text-center">
                        <span class="font-display text-3xl font-bold text-amber-500">2,400+</span>
                        <p class="mt-1 text-sm text-zinc-500">Vehicles Sold</p>
                    </div>
                    <div class="p-6 bg-zinc-900 rounded-xl border border-zinc-800/50 text-center">
                        <span class="font-display text-3xl font-bold text-amber-500">98%</span>
                        <p class="mt-1 text-sm text-zinc-500">Client Satisfaction</p>
                    </div>
                    <div class="p-6 bg-zinc-900 rounded-xl border border-zinc-800/50 text-center">
                        <span class="font-display text-3xl font-bold text-amber-500">150</span>
                        <p class="mt-1 text-sm text-zinc-500">Point Inspection</p>
                    </div>
                </div>

                <div class="mt-8 p-6 bg-zinc-900 rounded-xl border border-zinc-800/50">
                    <h3 class="font-display text-lg font-semibold text-white mb-4">Visit Our Showroom</h3>
                    <ul class="space-y-2 text-sm text-zinc-400">
                        <li>123 Motor Row, Beverly Hills, CA 90210</li>
                        <li>Mon–Sat: 9AM–7PM</li>
                        <li>Sunday: 11AM–5PM</li>
                        <li class="pt-2"><a href="tel:+13105551234" class="text-amber-500 hover:underline">(310) 555-1234</a></li>
                        <li><a href="mailto:hello@autohaven.com" class="text-amber-500 hover:underline">hello@autohaven.com</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
