<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($user) ? __('Edit User') : __('Create New User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if(isset($user)) @method('PUT') @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Info -->
                        <div class="space-y-6">
                            <div>
                                <x-label for="name" :value="__('Full Name')" />
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name ?? '')" required autofocus />
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <x-label for="father_name" :value="__('Father Name')" />
                                <x-input id="father_name" class="block mt-1 w-full" type="text" name="father_name" :value="old('father_name', $user->father_name ?? '')" required />
                                @error('father_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <x-label for="cnic" :value="__('CNIC')" />
                                <x-input id="cnic" class="block mt-1 w-full" type="text" name="cnic" :value="old('cnic', $user->cnic ?? '')" placeholder="XXXXX-XXXXXXX-X" required />
                                @error('cnic')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="space-y-6">
                            <div>
                                <x-label for="email" :value="__('Email')" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email ?? '')" required />
                                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <x-label for="mobile" :value="__('Mobile Number')" />
                                <x-input id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile', $user->mobile ?? '')" />
                                @error('mobile')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <x-label for="location_id" :value="__('Location')" />
                                <select id="location_id" name="location_id" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Select Location</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ old('location_id', $user->location_id ?? '') == $location->id ? 'selected' : '' }}>
                                            {{ $location->city }}, {{ $location->district }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-button type="submit">
                            {{ isset($user) ? __('Update User') : __('Create User') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
