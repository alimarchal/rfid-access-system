<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl uppercase text-gray-800 dark:text-gray-200 leading-tight inline-block">
            Edit Vehicle
        </h2>
        <div class="flex justify-center items-center float-right">
            <a href="{{ route('vehicles.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-800 dark:bg-blue-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-blue-800 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-white focus:bg-blue-700 dark:focus:bg-white active:bg-blue-900 dark:active:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-blue-800 transition ease-in-out duration-150">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-status-message class="mb-4 mt-4" />
                <div class="p-6">
                    <form method="POST" action="{{ route('vehicles.update', $vehicle) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                                <x-label for="user_id" value="User" :required="true"/>
                                <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
    <option value="">Select a user</option>
    @foreach($users as $user)
        <option value="{{ $user->id }}" {{ old('user_id', $vehicle->user_id) == $user->id ? 'selected' : '' }}>
            {{ $user->name }}
        </option>
    @endforeach
</select>

                            </div>

                            <div>
                                <x-label for="vehicle_no" value="Vehicle Number" :required="true" />
                                <x-input id="vehicle_no" type="text" name="vehicle_no" class="mt-1 block w-full" :value="old('vehicle_no', $vehicle->vehicle_no)" required maxlength="50" placeholder="ABC-123"/>
                            </div>

                            <div>
                                <x-label for="make" value="Make" />
                                <x-input id="make" type="text" name="make" class="mt-1 block w-full" :value="old('make', $vehicle->make)" maxlength="50" />
                            </div>

                            <div>
                                <x-label for="model" value="Model" />
                                <x-input id="model" type="text" name="model" class="mt-1 block w-full" :value="old('model', $vehicle->model)" maxlength="50" />
                            </div>

                            <div>
                                <x-label for="manufacture_year" value="Manufacture Year" />
                                <x-input id="manufacture_year" type="number" name="manufacture_year" class="mt-1 block w-full" :value="old('manufacture_year', $vehicle->manufacture_year)" min="1900" max="{{ date('Y') }}" />
                            </div>

                            <div>
                                <x-label for="color" value="Color" />
                                <x-input id="color" type="text" name="color" class="mt-1 block w-full" :value="old('color', $vehicle->color)" maxlength="50" />
                            </div>

                            <div>
                                <x-label for="additional_details" value="Additional Details" />
                                <textarea id="additional_details" name="additional_details" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('additional_details', $vehicle->additional_details) }}</textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                Update Vehicle
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>