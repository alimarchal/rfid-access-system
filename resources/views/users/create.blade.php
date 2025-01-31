{{-- resources/views/users/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            Create User
        </h2>
        <div class="flex justify-center items-center float-right">
            <a href="{{ route('users.index') }}"
                class="inline-flex items-center ml-2 px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 focus:bg-green-800 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
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
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="name" value="Name" :required="true" />
                                <x-input id="name" type="text" name="name" class="mt-1 block w-full"
                                    :value="old('name')" required maxlength="255" />
                            </div>

                            <div>
                                <x-label for="father_name" value="Father Name" />
                                <x-input id="father_name" type="text" name="father_name" class="mt-1 block w-full"
                                    :value="old('father_name')" maxlength="100" />
                            </div>

                            <div>
                                <x-label for="cnic" value="CNIC" />
                                <x-input id="cnic" type="text" name="cnic" class="mt-1 block w-full"
                                    :value="old('cnic')" maxlength="15" />
                            </div>

                            <div>
                                <x-label for="mobile" value="Mobile" />
                                <x-input id="mobile" type="text" name="mobile" class="mt-1 block w-full"
                                    :value="old('mobile')" maxlength="15" />
                            </div>

                            <div>
                                <x-label for="telephone" value="Telephone" />
                                <x-input id="telephone" type="text" name="telephone" class="mt-1 block w-full"
                                    :value="old('telephone')" maxlength="15" />
                            </div>


                            <div>
                                <x-label for="location_id" value="Location" />
                                <select id="location_id" name="location_id"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}"
                                            {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                            {{ $location->city }} - {{ $location->district }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-label for="profile_photo_path" value="Profile Photo" />
                                <input id="profile_photo_path" type="file" name="profile_photo_path"
                                    class="mt-1 block w-full" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                Create User
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
