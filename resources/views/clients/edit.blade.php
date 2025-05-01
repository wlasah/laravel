<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Client
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form action="{{ route('clients.update', $client->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200">Name</label>
                        <input type="text" name="name" class="w-full mt-1 p-2 border rounded dark:bg-gray-700 dark:text-white" value="{{ old('name', $client->name) }}">
                        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200">Address</label>
                        <textarea name="address" class="w-full mt-1 p-2 border rounded dark:bg-gray-700 dark:text-white">{{ old('address', $client->address) }}</textarea>
                        @error('address') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200">Gender</label>
                        <select name="gender" class="w-full mt-1 p-2 border rounded dark:bg-gray-700 dark:text-white">
                            <option value="Male" {{ $client->gender === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $client->gender === 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200">Date of Birth</label>
                        <input type="date" name="dob" class="w-full mt-1 p-2 border rounded dark:bg-gray-700 dark:text-white" value="{{ old('dob', $client->dob) }}">
                        @error('dob') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('clients.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">Cancel</a>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
