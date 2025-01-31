{{-- resources/views/users/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl uppercase text-gray-800 dark:text-gray-200 leading-tight inline-block">
            Edit User
        </h2>
        <div class="flex justify-center items-center float-right">
            <a href="{{ route('users.index') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-800 dark:bg-blue-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-blue-800 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-white focus:bg-blue-700 dark:focus:bg-white active:bg-blue-900 dark:active:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-blue-800 transition ease-in-out duration-150">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-status-message class="mb-4 mt-4" />
                <div class="p-6">
                    <x-validation-errors class="mb-4 mt-4" />
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="name" value="Name" :required="true" />
                                <x-input id="name" type="text" name="name" class="mt-1 block w-full"
                                    :value="old('name', $user->name)" required maxlength="255" />
                            </div>

                            <div>
                                <x-label for="father_name" value="Father Name" />
                                <x-input id="father_name" type="text" name="father_name" class="mt-1 block w-full"
                                    :value="old('father_name', $user->father_name)" maxlength="100" />
                            </div>

                            <div>
                                <x-label for="cnic" value="CNIC" />
                                <x-input id="cnic" type="text" name="cnic" class="mt-1 block w-full"
                                    :value="old('cnic', $user->cnic)" maxlength="15" />
                            </div>

                            <div>
                                <x-label for="mobile" value="Mobile" />
                                <x-input id="mobile" type="text" name="mobile" class="mt-1 block w-full"
                                    :value="old('mobile', $user->mobile)" maxlength="15" />
                            </div>

                            <div>
                                <x-label for="telephone" value="Telephone" />
                                <x-input id="telephone" type="text" name="telephone" class="mt-1 block w-full"
                                    :value="old('telephone', $user->telephone)" maxlength="15" />
                            </div>

                            <div>
                                <x-label for="location_id" value="Location" />
                                <select id="location_id" name="location_id"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">Select Location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}"
                                            {{ old('location_id', $user->location_id) == $location->id ? 'selected' : '' }}>
                                            {{ $location->city }} - {{ $location->district }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-label for="profile_photo_path" value="Profile Photo" />

                                <!-- If there's an existing profile photo, display it -->
                                @if ($user->profile_photo_path)
                                    <div class="mt-2">
                                        <p>Current Profile Photo:</p>
                                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                            alt="Profile Photo" width="100" height="100" />
                                        <p><a href="{{ route('your.route.deletePhoto', $user->id) }}"
                                                class="text-red-600">Remove Photo</a></p>
                                    </div>
                                @endif

                                <!-- File input for uploading new profile photo -->
                                <x-input id="profile_photo_path" type="file" name="profile_photo"
                                    class="mt-1 block w-full" />
                            </div>


                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-4">
                                    Update User
                                </x-button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
