<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Inquiries</h2>
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
                            <th class="px-6 py-3 text-left font-medium text-gray-500">Contact</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500">Vehicle</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500">Message</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500">Status</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500">Date</th>
                            <th class="px-6 py-3 text-right font-medium text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($inquiries as $inquiry)
                            <tr class="hover:bg-gray-50 {{ $inquiry->status === 'new' ? 'bg-amber-50/30' : '' }}">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-900">{{ $inquiry->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $inquiry->email }}</p>
                                    @if($inquiry->phone)
                                        <p class="text-xs text-gray-400">{{ $inquiry->phone }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-500">
                                    @if($inquiry->vehicle)
                                        <a href="{{ route('vehicle.show', $inquiry->vehicle) }}" class="text-blue-600 hover:underline" target="_blank">
                                            {{ $inquiry->vehicle->full_name }}
                                        </a>
                                    @else
                                        <span class="text-gray-400">General</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-500 max-w-xs truncate">{{ $inquiry->message }}</td>
                                <td class="px-6 py-4">
                                    <form method="POST" action="{{ route('admin.inquiries.update', $inquiry) }}">
                                        @csrf @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                                class="text-xs rounded-lg border-gray-300 {{ $inquiry->status === 'new' ? 'text-amber-700 bg-amber-50' : ($inquiry->status === 'contacted' ? 'text-blue-700 bg-blue-50' : 'text-gray-600 bg-gray-50') }}">
                                            <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>New</option>
                                            <option value="contacted" {{ $inquiry->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                            <option value="closed" {{ $inquiry->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-400">{{ $inquiry->created_at->diffForHumans() }}</td>
                                <td class="px-6 py-4 text-right">
                                    <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" class="inline" onsubmit="return confirm('Delete this inquiry?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-500 hover:underline text-xs">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400">No inquiries yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $inquiries->links() }}</div>
        </div>
    </div>
</x-app-layout>
