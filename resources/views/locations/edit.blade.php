<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl uppercase text-gray-800 dark:text-gray-200 leading-tight inline-block">
            Edit Location
        </h2>
        <div class="flex justify-center items-center float-right">
            <a href="{{ route('locations.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-800 dark:bg-blue-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-blue-800 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-white focus:bg-blue-700 dark:focus:bg-white active:bg-blue-900 dark:active:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-blue-800 transition ease-in-out duration-150">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-status-message class="mb-4 mt-4" />
                <div class="p-6">
                    <form method="POST" action="{{ route('locations.update', $location) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="city" value="City" :required="true" />
                                <x-input id="city" type="text" name="city" class="mt-1 block w-full" :value="old('city', $location->city)" required maxlength="50" />
                            </div>

                            <div>
                                <x-label for="district" value="District" :required="true" />
                                <x-input id="district" type="text" name="district" class="mt-1 block w-full" :value="old('district', $location->district)" required maxlength="50" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                Update Location
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
