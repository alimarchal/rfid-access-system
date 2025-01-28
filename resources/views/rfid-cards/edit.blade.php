{{-- resources/views/rfid-cards/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            Edit RFID Card
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
                    <x-validation-errors class="mb-4"/>
                    <form method="POST" action="{{ route('rfid-cards.update', $rfidCard) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="card_number" value="Card Number" :required="true"/>
                                <x-input id="card_number" type="text" name="card_number"
                                         class="mt-1 block w-full"
                                         :value="old('card_number', $rfidCard->card_number)"
                                         required maxlength="20"/>
                            </div>

                            <div>
                                <x-label for="user_id" value="User" :required="true"/>
                                <select id="user_id" name="user_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                    <option value="">Select a user</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id', $rfidCard->user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-label for="status" value="Status" :required="true"/>
                                <select id="status" name="status"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                    <option value="active" {{ old('status', $rfidCard->status) == 'active' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="inactive" {{ old('status', $rfidCard->status) == 'inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                    <option value="expired" {{ old('status', $rfidCard->status) == 'expired' ? 'selected' : '' }}>
                                        Expired
                                    </option>
                                </select>
                            </div>

                            <div>
                                <x-label for="expiry_date" value="Expiry Date" :required="true"/>
                                <x-input id="expiry_date" type="date" name="expiry_date"
                                         class="mt-1 block w-full"
                                         :value="old('expiry_date', $rfidCard->expiry_date->format('Y-m-d'))"
                                         required/>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                Update RFID Card
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
