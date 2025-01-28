<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            Create Vehicle
        </h2>
        <div class="flex justify-center items-center float-right">
            <a href="{{ route('vehicles.index') }}" class="inline-flex items-center ml-2 px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 focus:bg-green-800 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-status-message class="mb-4 mt-4" />
                <div class="p-6">
                    <x-validation-errors class="mb-4 mt-4" />
                    <form method="POST" action="{{ route('vehicles.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="vehicle_no" value="Vehicle Number" :required="true" />
                                <x-input id="vehicle_no" type="text" name="vehicle_no" class="mt-1 block w-full" :value="old('vehicle_no')" required maxlength="50" placeholder="ABC-123"/>
                            </div>
                            
                            <div>
    <x-label for="user_id" value="{{ __('User') }}" />
    <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="">Select User</option>
        @foreach(\App\Models\User::active()->get() as $user)
            <option value="{{ $user->id }}" {{ (isset($vehicle) && $vehicle->user_id == $user->id) || old('user_id') == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>

  
                            <div>
                                <x-label for="make" value="Make" />
                                <x-input id="make" type="text" name="make" class="mt-1 block w-full" :value="old('make')" maxlength="50" />
                            </div>

                            <div>
                                <x-label for="model" value="Model" />
                                <x-input id="model" type="text" name="model" class="mt-1 block w-full" :value="old('model')" maxlength="50" />
                            </div>

                            <div>
                                <x-label for="manufacture_year" value="Manufacture Year" />
                                <x-input id="manufacture_year" type="number" name="manufacture_year" class="mt-1 block w-full" :value="old('manufacture_year')" min="1900" max="{{ date('Y') }}" />
                            </div>

                            <div>
                                <x-label for="color" value="Color" />
                                <x-input id="color" type="text" name="color" class="mt-1 block w-full" :value="old('color')" maxlength="50" />
                            </div>

                            
                            <div>
                                <x-label for="additional_details" value="Additional Details" />
                                <textarea id="additional_details" name="additional_details" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('additional_details') }}</textarea>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                Create Vehicle
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>