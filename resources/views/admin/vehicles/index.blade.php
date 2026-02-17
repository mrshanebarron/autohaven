<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Vehicles</h2>
            <a href="{{ route('admin.vehicles.create') }}" class="px-4 py-2 bg-amber-500 text-white text-sm font-medium rounded-lg hover:bg-amber-600 transition-colors">
                + Add Vehicle
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium text-gray-500">Vehicle</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500">Price</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500">Mileage</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500">Status</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500">Featured</th>
                            <th class="px-6 py-3 text-right font-medium text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($vehicles as $vehicle)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $vehicle->hero_image }}" alt="" class="w-20 h-14 object-cover rounded">
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $vehicle->full_name }}</p>
                                            <p class="text-xs text-gray-500">{{ $vehicle->exterior_color }} &middot; {{ $vehicle->stock_number }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-medium">{{ $vehicle->formatted_price }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $vehicle->formatted_mileage }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full {{ $vehicle->status === 'available' ? 'bg-green-100 text-green-700' : ($vehicle->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600') }}">
                                        {{ ucfirst($vehicle->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($vehicle->featured)
                                        <span class="text-amber-500">&#9733;</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <a href="{{ route('vehicle.show', $vehicle) }}" class="text-gray-400 hover:underline" target="_blank">View</a>
                                    <form method="POST" action="{{ route('admin.vehicles.destroy', $vehicle) }}" class="inline" onsubmit="return confirm('Delete this vehicle?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-500 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $vehicles->links() }}</div>
        </div>
    </div>
</x-app-layout>
