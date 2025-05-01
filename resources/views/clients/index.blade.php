<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Clients List
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filters -->
            <div class="mb-4 flex flex-wrap items-center space-x-4">
                <!-- General Search Bar -->
                <form method="GET" action="{{ route('clients.index') }}" class="inline">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Name or Address..." class="border rounded px-3 py-1 text-sm">
                    
                    <!-- Gender Filter -->
                    <select name="gender" class="border rounded px-3 py-1 text-sm">
                        <option value="">All Genders</option>
                        <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>

                    <!-- Date of Birth Filter -->
                    <input type="date" name="dob" value="{{ request('dob') }}" class="border rounded px-3 py-1 text-sm">

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">Search</button>
                </form>

                <!-- Dedicated ID Search Bar -->
                <form method="GET" action="{{ route('clients.index') }}" class="inline">
                    <input type="text" name="id" value="{{ request('id') }}" placeholder="Search by ID..." class="border rounded px-3 py-1 text-sm">
                    <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-1 px-3 rounded text-sm">Search ID</button>
                </form>

                <!-- Download PDF Button -->
                @if($clients->isEmpty())
                    <span class="text-red-500 text-sm">No data to export</span>
                @else
                    <a href="{{ route('clients.pdf', request()->only('search', 'gender', 'dob', 'id')) }}" class="ml-2 bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-sm">
                        Download PDF
                    </a>
                @endif
            </div>

            <!-- Clients Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 text-green-600 dark:text-green-400">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($clients->isEmpty())
                        <p class="text-gray-600 dark:text-gray-300">No clients found.</p>
                    @else
                        <table class="w-full text-left table-auto">
                            <thead>
                                <tr class="border-b">
                                    <th class="px-4 py-2 text-gray-700 dark:text-gray-200">ID</th>
                                    <th class="px-4 py-2 text-gray-700 dark:text-gray-200">Name</th>
                                    <th class="px-4 py-2 text-gray-700 dark:text-gray-200">Address</th>
                                    <th class="px-4 py-2 text-gray-700 dark:text-gray-200">Gender</th>
                                    <th class="px-4 py-2 text-gray-700 dark:text-gray-200">Date of Birth</th>
                                    <th class="px-4 py-2 text-gray-700 dark:text-gray-200">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                    <tr class="border-b hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $client->id }}</td>
                                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $client->name }}</td>
                                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $client->address }}</td>
                                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $client->gender }}</td>
                                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100">{{ $client->dob }}</td>
                                        <td class="px-4 py-2 text-gray-800 dark:text-gray-100 space-x-2">
                                            <a href="{{ route('clients.show', $client->id) }}" class="text-blue-500 hover:underline">Show</a>
                                            <a href="{{ route('clients.edit', $client->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $clients->withQueryString()->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
