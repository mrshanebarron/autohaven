<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Stats --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <p class="text-sm text-gray-500">Available</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['available'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <p class="text-sm text-gray-500">Sold</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $stats['sold'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <p class="text-sm text-gray-500">Total Value</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">${{ number_format($stats['total_value'], 0) }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border">
                    <p class="text-sm text-gray-500">New Inquiries</p>
                    <p class="text-3xl font-bold text-amber-600 mt-1">{{ $stats['new_inquiries'] }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Recent Inquiries --}}
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="px-6 py-4 border-b flex items-center justify-between">
                        <h3 class="font-semibold text-gray-900">Recent Inquiries</h3>
                        <a href="{{ route('admin.inquiries.index') }}" class="text-sm text-amber-600 hover:underline">View All</a>
                    </div>
                    <div class="divide-y">
                        @forelse($recentInquiries as $inquiry)
                            <div class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $inquiry->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $inquiry->email }}</p>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $inquiry->status === 'new' ? 'bg-amber-100 text-amber-700' : ($inquiry->status === 'contacted' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600') }}">
                                        {{ ucfirst($inquiry->status) }}
                                    </span>
                                </div>
                                @if($inquiry->vehicle)
                                    <p class="text-sm text-gray-400 mt-1">Re: {{ $inquiry->vehicle->full_name }}</p>
                                @endif
                            </div>
                        @empty
                            <p class="px-6 py-8 text-sm text-gray-400 text-center">No inquiries yet.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Recent Vehicles --}}
                <div class="bg-white rounded-lg shadow-sm border">
                    <div class="px-6 py-4 border-b flex items-center justify-between">
                        <h3 class="font-semibold text-gray-900">Recent Vehicles</h3>
                        <a href="{{ route('admin.vehicles.index') }}" class="text-sm text-amber-600 hover:underline">Manage</a>
                    </div>
                    <div class="divide-y">
                        @foreach($recentVehicles as $vehicle)
                            <div class="px-6 py-4 flex items-center gap-4">
                                <img src="{{ $vehicle->hero_image }}" alt="" class="w-16 h-12 object-cover rounded">
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate">{{ $vehicle->full_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $vehicle->formatted_price }} &middot; {{ $vehicle->formatted_mileage }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $vehicle->status === 'available' ? 'bg-green-100 text-green-700' : ($vehicle->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600') }}">
                                    {{ ucfirst($vehicle->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="flex gap-3">
                <a href="{{ route('admin.vehicles.create') }}" class="px-4 py-2.5 bg-amber-500 text-white text-sm font-medium rounded-lg hover:bg-amber-600 transition-colors">
                    + Add Vehicle
                </a>
                <a href="{{ route('admin.inquiries.index') }}" class="px-4 py-2.5 bg-white border text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    View Inquiries
                </a>
                <a href="{{ route('home') }}" class="px-4 py-2.5 bg-white border text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors" target="_blank">
                    View Site
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
