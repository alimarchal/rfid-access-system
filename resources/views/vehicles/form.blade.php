<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($vehicle) ? __('Edit Vehicle') : __('Register New Vehicle') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ isset($vehicle) ? route('vehicles.update', $vehicle) : route('vehicles.store') }}">
                    @csrf
                    @if(isset($vehicle)) @method('PUT') @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-label for="vehicle_no" :value="__('Vehicle Number')" />
                            <x-input id="vehicle_no" class="block mt-1 w-full" type="text" name="vehicle_no"
                                     :value="old('vehicle_no', $vehicle->vehicle_no ?? '')" required />
                            @error('vehicle_no')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <x-label for="user_id" :value="__('Owner')" />
                            <select id="user_id" name="user_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $vehicle->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->cnic }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <x-label for="make" :value="__('Make')" />
                            <x-input id="make" class="block mt-1 w-full" type="text" name="make"
                                     :value="old('make', $vehicle->make ?? '')" required />
                            @error('make')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <x-label for="model" :value="__('Model')" />
                            <x-input id="model" class="block mt-1 w-full" type="text" name="model"
                                     :value="old('model', $vehicle->model ?? '')" required />
                            @error('model')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-button type="submit">
                            {{ isset($vehicle) ? __('Update Vehicle') : __('Register Vehicle') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
