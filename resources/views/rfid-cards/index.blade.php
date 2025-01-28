{{-- resources/views/rfid-cards/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            RFID Cards Management
        </h2>

        <div class="flex justify-center items-center float-right">
            <button id="toggle" class="inline-flex items-center ml-2 px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-950 focus:bg-green-800 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Search
            </button>
            <a href="{{ route('rfid-cards.create') }}" class="inline-flex items-center ml-2 px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-950 focus:bg-green-800 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add RFID Card
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg" id="filters" style="display: none">
            <div class="p-6">
                <form method="GET" action="{{ route('rfid-cards.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <x-label for="card_number" value="{{ __('Card Number') }}"/>
                            <x-input id="card_number" type="text" name="filter[card_number]" :value="request('filter.card_number')" class="mt-1 block w-full"/>
                        </div>
                        <div>
                            <x-label for="status" value="{{ __('Status') }}"/>
                            <select id="status" name="filter[status]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All</option>
                                <option value="active" {{ request('filter.status') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('filter.status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="expired" {{ request('filter.status') === 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                        </div>
                        <div>
                            <x-label for="user_id" value="{{ __('User') }}"/>
                            <select id="user_id" name="filter[user_id]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Users</option>
                                @foreach(\App\Models\User::active()->get() as $user)
                                    <option value="{{ $user->id }}" {{ request('filter.user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-button class="bg-blue-800 text-white hover:bg-green-800">
                            {{ __('Apply Filters') }}
                        </x-button>
                        <a href="{{ route('rfid-cards.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            {{ __('Clear Filters') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-status-message/>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                @if($rfidCards->count() > 0)
                    <div class="relative overflow-x-auto rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                            <thead>
                            <tr class="bg-blue-800 text-white">
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Card Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Expiry Date</th>
                                <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach($rfidCards as $card)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $card->card_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $card->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $card->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $card->status === 'inactive' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $card->status === 'expired' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($card->status) }}
                                            </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $card->expiry_date->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('rfid-cards.edit', $card) }}" class="inline-flex items-center px-4 py-2 bg-green-800 text-white rounded-md hover:bg-green-700">
                                            Edit
                                        </a>
                                        <button type="button" class="reassign-button inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                                                data-card-id="{{ $card->id }}">
                                            Reassign
                                        </button>
                                        <form class="inline-block" method="POST" action="{{ route('rfid-cards.destroy', $card) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 delete-button">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4">
                        {{ $rfidCards->links() }}
                    </div>
                @else
                    <p class="text-gray-700 dark:text-gray-300 text-center py-4">
                        No RFID cards found.
                        <a href="{{ route('rfid-cards.create') }}" class="text-blue-600 hover:underline">
                            Add a new RFID card
                        </a>
                    </p>
                @endif
            </div>
        </div>
    </div>

    {{-- Reassign Modal --}}
    <div id="reassignModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="reassignForm" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Reassign RFID Card
                                </h3>
                                <div class="mt-4">
                                    <x-label for="modal_user_id" value="Select User"/>
                                    <select id="modal_user_id" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                        <option value="">Select a user</option>
                                        @foreach(\App\Models\User::active()->get() as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <x-label for="expiry_date" value="Expiry Date"/>
                                    <x-input id="expiry_date" type="date" name="expiry_date" class="mt-1 block w-full"
                                             :value="old('expiry_date', now()->addYear()->format('Y-m-d'))" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Reassign
                        </button>
                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm close-modal">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('modals')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // DOM Elements
            const modal = document.getElementById('reassignModal');
            const reassignButtons = document.querySelectorAll('.reassign-button');
            const closeButtons = document.querySelectorAll('.close-modal');
            const reassignForm = document.getElementById('reassignForm');
            const targetDiv = document.getElementById("filters");
            const toggleButton = document.getElementById("toggle");

            // Reassign Modal Functionality
            reassignButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const cardId = button.dataset.cardId;
                    reassignForm.action = `/rfid-cards/${cardId}/reassign`;
                    modal.classList.remove('hidden');
                });
            });

            // Close Modal Functionality
            closeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    modal.classList.add('hidden');
                    resetReassignForm();
                });
            });

            // Close modal when clicking outside
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    resetReassignForm();
                }
            });

            // Reset reassign form
            function resetReassignForm() {
                reassignForm.reset();
                const userSelect = document.getElementById('modal_user_id');
                if (userSelect) {
                    userSelect.selectedIndex = 0;
                }
            }

            // Delete Confirmation
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Filter Functionality
            function showFilters() {
                targetDiv.style.display = 'block';
                targetDiv.style.opacity = '0';
                targetDiv.style.transform = 'translateY(-20px)';
                targetDiv.style.transition = 'opacity 300ms, transform 300ms';

                // Force reflow
                targetDiv.offsetHeight;

                targetDiv.style.opacity = '1';
                targetDiv.style.transform = 'translateY(0)';
            }

            function hideFilters() {
                targetDiv.style.opacity = '0';
                targetDiv.style.transform = 'translateY(-20px)';

                setTimeout(() => {
                    targetDiv.style.display = 'none';
                }, 300);
            }

            // Toggle filter visibility
            toggleButton.addEventListener('click', function(event) {
                event.stopPropagation();
                if (targetDiv.style.display === "none") {
                    showFilters();
                } else {
                    hideFilters();
                }
            });

            // Hide filters when clicking outside
            document.addEventListener('click', function(event) {
                if (targetDiv.style.display === 'block' &&
                    !targetDiv.contains(event.target) &&
                    event.target !== toggleButton) {
                    hideFilters();
                }
            });

            // Prevent filter panel clicks from closing
            targetDiv.addEventListener('click', function(event) {
                event.stopPropagation();
            });

            // Form submission handling
            reassignForm.addEventListener('submit', function(e) {
                const submitButton = this.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<span class="inline-flex items-center">Processing... <svg class="animate-spin ml-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg></span>';
                }
            });

            // Initialize filter display
            targetDiv.style.display = 'none';
        </script>
    @endpush
</x-app-layout>
