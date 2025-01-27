<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($rfidCard) ? __('Edit RFID Card') : __('Register New RFID Card') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST"
                      action="{{ isset($rfidCard) ? route('rfid-cards.update', $rfidCard) : route('rfid-cards.store') }}">
                    @csrf
                    @if(isset($rfidCard)) @method('PUT') @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Card Information -->
                        <div class="space-y-6">
                            <div>
                                <x-label for="card_number" :value="__('Card Number')" />
                                <x-input id="card_number"
                                         class="block mt-1 w-full"
                                         type="text"
                                         name="card_number"
                                         :value="old('card_number', $rfidCard->card_number ?? '')"
                                         required
                                         autofocus />
                                @error('card_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <x-label for="user_id" :value="__('Assign to User')" />
                                <select id="user_id"
                                        name="user_id"
                                        class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id', $rfidCard->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->cnic }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Status & Expiry -->
                        <div class="space-y-6">
                            <div>
                                <x-label for="status" :value="__('Card Status')" />
                                <select id="status"
                                        name="status"
                                        class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @foreach(['active', 'inactive', 'expired'] as $state)
                                        <option value="{{ $state }}"
                                            {{ old('status', $rfidCard->status ?? 'active') == $state ? 'selected' : '' }}>
                                            {{ ucfirst($state) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <x-label for="expiry_date" :value="__('Expiry Date')" />
                                <x-input id="expiry_date"
                                         class="block mt-1 w-full"
                                         type="date"
                                         name="expiry_date"
                                         min="{{ now()->format('Y-m-d') }}"
                                         :value="old('expiry_date', isset($rfidCard) ? $rfidCard->expiry_date->format('Y-m-d') : now()->addYear()->format('Y-m-d'))"
                                         required />
                                @error('expiry_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('rfid-cards.index') }}"
                           class="text-gray-600 hover:text-gray-800 mr-4">
                            Cancel
                        </a>
                        <x-button type="submit">
                            {{ isset($rfidCard) ? __('Update Card') : __('Register Card') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
