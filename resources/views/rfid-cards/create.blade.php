{{-- resources/views/rfid-cards/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            Create RFID Card
        </h2>
        <div class="flex justify-center items-center float-right">
            <a href="{{ route('rfid-cards.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-800 dark:bg-blue-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-blue-800 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-white focus:bg-blue-700 dark:focus:bg-white active:bg-blue-900 dark:active:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-blue-800 transition ease-in-out duration-150">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-status-message />
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6">
                   <x-errors-message />

                    <form method="POST" action="{{ route('rfid-cards.store') }}" id="createRfidForm">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="card_number" value="Card Number" />
                                <x-input id="card_number" type="text" name="card_number"
                                         class="mt-1 block w-full"
                                         :value="old('card_number')"
                                         required
                                         maxlength="20"
                                         placeholder="Enter card number"/>
                            </div>

                            <div>
                                <x-label for="user_id" value="User" />
                                <select id="user_id" name="user_id"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                        required>
                                    <option value="">Select a user</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <x-label for="status" value="Status" />
                                <select id="status" name="status"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                        required>
                                    <option value="">Select status</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                </select>
                            </div>

                            <div>
                                <x-label for="expiry_date" value="Expiry Date" />
                                <x-input id="expiry_date"
                                         type="date"
                                         name="expiry_date"
                                         class="mt-1 block w-full"
                                         :value="old('expiry_date', date('Y-m-d', strtotime('+1 year')))"
                                         required/>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button type="submit" class="ml-4">
                                Create RFID Card
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('createRfidForm').addEventListener('submit', function(e) {
                const form = this;
                const submitButton = form.querySelector('button[type="submit"]');

                // Disable the submit button to prevent double submission
                submitButton.disabled = true;

                // Add loading state to button
                submitButton.innerHTML = '<span class="inline-flex items-center">Creating... <svg class="animate-spin ml-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg></span>';

                // Continue with form submission
                return true;
            });
        </script>
    @endpush
</x-app-layout>
