<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">My Trips</h2>
                    <a href="{{ route('trips.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Plan New Trip</a>
                    @if (session('success'))
                        <div class="bg-green-100 text-green-700 p-4 mt-4">{{ session('success') }}</div>
                    @endif
                    <table class="min-w-full mt-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Start Date</th>
                                <th class="px-4 py-2">End Date</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trips as $trip)
                                <tr>
                                    <td class="border px-4 py-2"><a href="{{ route('trips.show', $trip) }}" class="text-blue-500">{{ $trip->name }}</a></td>
                                    <td class="border px-4 py-2">{{ $trip->start_date }}</td>
                                    <td class="border px-4 py-2">{{ $trip->end_date }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('trips.edit', $trip) }}" class="text-blue-500">Edit</a>
                                        <form action="{{ route('trips.destroy', $trip) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>