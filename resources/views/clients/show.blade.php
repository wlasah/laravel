<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Client Details') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{ route('clients.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-white uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                        ← Back to Clients
                    </a>
                </div>

                <div class="space-y-4">
                    <div>
                        <strong class="text-gray-700 dark:text-gray-300">Name:</strong>
                        <p class="text-lg text-gray-900 dark:text-white">{{ $client->name }}</p>
                    </div>

                    <div>
                        <strong class="text-gray-700 dark:text-gray-300">Address:</strong>
                        <p class="text-gray-900 dark:text-white">{{ $client->address }}</p>
                    </div>

                    <div>
                        <strong class="text-gray-700 dark:text-gray-300">Gender:</strong>
                        <p class="text-gray-900 dark:text-white">{{ $client->gender }}</p>
                    </div>

                    <div>
                        <strong class="text-gray-700 dark:text-gray-300">Date of Birth:</strong>
                        <p class="text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($client->dob)->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
