{{-- resources/views/rfid-cards/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            RFID Card Details
        </h2>
        <div class="flex justify-center items-center float-right">
            <a href="{{ route('rfid-cards.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-800 dark:bg-blue-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-blue-800 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-white focus:bg-blue-700 dark:focus:bg-white active:bg-blue-900 dark:active:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-blue-800 transition ease-in-out duration-150">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <div>
                                <span class="font-bold text-gray-700 dark:text-gray-300">Card Number:</span>
                                <span class="ml-2 text-gray-600 dark:text-gray-400">{{ $rfidCard->card_number }}</span>
                            </div>

                            <div>
                                <span class="font-bold text-gray-700 dark:text-gray-300">User:</span>
                                <span class="ml-2 text-gray-600 dark:text-gray-400">{{ $rfidCard->user->name }}</span>
                            </div>

                            <div>
                                <span class="font-bold text-gray-700 dark:text-gray-300">Status:</span>
                                <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $rfidCard->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $rfidCard->status === 'inactive' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $rfidCard->status === 'expired' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($rfidCard->status) }}
                                </span>
                            </div>

                            <div>
                                <span class="font-bold text-gray-700 dark:text-gray-300">Expiry Date:</span>
                                <span class="ml-2 text-gray-600 dark:text-gray-400">{{ $rfidCard->expiry_date->format('Y-m-d') }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div>
                                <span class="font-bold text-gray-700 dark:text-gray-300">Created At:</span>
                                <span class="ml-2 text-gray-600 dark:text-gray-400">{{ $rfidCard->created_at->format('Y-m-d H:i:s') }}</span>
                            </div>

                            <div>
                                <span class="font-bold text-gray-700 dark:text-gray-300">Last Updated:</span>
                                <span class="ml-2 text-gray-600 dark:text-gray-400">{{ $rfidCard->updated_at->format('Y-m-d H:i:s') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-4">
                        <a href="{{ route('rfid-cards.edit', $rfidCard) }}"
                           class="inline-flex items-center px-4 py-2 bg-green-800 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            Edit RFID Card
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
