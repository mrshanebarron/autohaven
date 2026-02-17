@extends('layouts.public')

@section('title', 'Contact')

@section('content')

<section class="pt-28 pb-24 bg-zinc-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">

            {{-- Info --}}
            <div>
                <span class="text-xs font-medium text-amber-500 uppercase tracking-[0.2em]">Get in Touch</span>
                <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mt-2">We'd Love to<br>Hear From You</h1>
                <p class="mt-6 text-lg text-zinc-400 leading-relaxed">
                    Whether you're looking for a specific vehicle, want to schedule a test drive, or just want to talk cars — we're here.
                </p>

                <div class="mt-10 space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-amber-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display font-semibold text-white">Showroom</h3>
                            <p class="text-sm text-zinc-500 mt-1">123 Motor Row<br>Beverly Hills, CA 90210</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-amber-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display font-semibold text-white">Phone</h3>
                            <p class="text-sm text-zinc-500 mt-1"><a href="tel:+13105551234" class="hover:text-amber-500 transition-colors">(310) 555-1234</a></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-amber-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display font-semibold text-white">Email</h3>
                            <p class="text-sm text-zinc-500 mt-1"><a href="mailto:hello@autohaven.com" class="hover:text-amber-500 transition-colors">hello@autohaven.com</a></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-amber-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-display font-semibold text-white">Hours</h3>
                            <p class="text-sm text-zinc-500 mt-1">Mon–Sat: 9AM–7PM<br>Sunday: 11AM–5PM</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <div class="p-8 bg-zinc-900 rounded-xl border border-zinc-800/50">
                <h2 class="font-display text-xl font-semibold text-white mb-6">Send Us a Message</h2>

                <form method="POST" action="{{ route('inquiries.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-zinc-400 mb-1.5">Full Name</label>
                        <input type="text" name="name" required value="{{ old('name') }}"
                               class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700/50 rounded-lg text-sm text-white placeholder-zinc-500 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/30">
                        @error('name') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-zinc-400 mb-1.5">Email</label>
                            <input type="email" name="email" required value="{{ old('email') }}"
                                   class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700/50 rounded-lg text-sm text-white placeholder-zinc-500 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/30">
                            @error('email') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zinc-400 mb-1.5">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700/50 rounded-lg text-sm text-white placeholder-zinc-500 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/30">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-zinc-400 mb-1.5">Message</label>
                        <textarea name="message" rows="5" required
                                  class="w-full px-4 py-3 bg-zinc-800 border border-zinc-700/50 rounded-lg text-sm text-white placeholder-zinc-500 focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/30 resize-none">{{ old('message') }}</textarea>
                        @error('message') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-amber-500 text-zinc-950 text-sm font-semibold rounded-lg hover:bg-amber-400 transition-all hover:shadow-lg hover:shadow-amber-500/25">
                        Send Message
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>

@endsection
