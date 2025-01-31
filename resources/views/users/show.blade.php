{{-- resources/views/users/show.blade.php --}}
<x-app-layout>

    @if (auth()->user()->role == 'Admin')
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
                User Profile
            </h2>
            <div class="flex justify-center items-center float-right">
                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-800 dark:bg-blue-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-blue-800 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-white focus:bg-blue-700 dark:focus:bg-white active:bg-blue-900 dark:active:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-blue-800 transition ease-in-out duration-150">
                    Back
                </a>
            </div>
        </x-slot>
    @endif

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-status-message class="mb-4" />

            <!-- Profile Header -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="bg-gradient-to-r from-blue-800 to-blue-600 h-32"></div>
                <div class="px-6 py-4 relative">
                    <div class="flex items-center">
                        <div class="absolute -top-16">
                            <div
                                class="w-32 h-32 rounded-lg shadow-xl overflow-hidden border-4 border-white dark:border-gray-700 bg-white dark:bg-gray-900 transform group-hover:scale-105 transition-transform duration-200">
                                @if ($user->profile_photo_path)
                                    <img src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900 dark:to-blue-800">
                                        <span class="text-4xl font-bold text-blue-600 dark:text-blue-400">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                        </div>
                        <div class="ml-40">
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $user->name }}</h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                            <div class="mt-2">
                                <span
                                    class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @if (request()->has('rfid_card_id'))
                @if (auth()->user()->role == 'Guard')
                    <!-- Entry Form -->
                    <div
                        class="grid grid-cols-1 md:grid-cols-1 gap-2 bg-white rounded-md pb-5 pt-2 px-5 shadow-xl sm:rounded-lg mb-6">
                        <form action="{{ route('entries.store') }}" method="POST" class="">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="rfid_card_id" value="{{ request('rfid_card_id') }}">
                            <input type="hidden" name="vehicle_id" value="{{ request('vehicle_id') }}">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">


                                <!-- Access Status Dropdown -->
                                <div>
                                    <label for="access_status"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Access Status
                                    </label>
                                    <select name="access_status" id="access_status"
                                        class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        <option value="1" selected>Access Granted</option>
                                        <option value="0">Access Denied</option>
                                    </select>
                                </div>

                                <!-- Gate ID Dropdown -->
                                <div>
                                    <label for="gate_id"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Gate ID
                                    </label>
                                    <select name="gate_id" id="gate_id"
                                        class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        <option value="1" selected>Gate 1</option>
                                        <option value="2">Gate 2</option>
                                        <option value="3">Gate 3</option>
                                    </select>
                                </div>

                                <!-- Entry Type Dropdown -->
                                <div>
                                    <label for="entry_type"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Entry Type
                                    </label>
                                    <select name="entry_type" id="entry_type"
                                        class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        <option value="time_in" selected>Time In</option>
                                        <option value="time_out">Time Out</option>
                                    </select>
                                </div>


                                <div>
                                    <label for="vehicle_id"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Vehicle
                                    </label>
                                    <select name="vehicle_id" id="vehicle_id"
                                        class="block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        <option value="NULL">None</option>
                                        @foreach ($user->vehicles as $vehicle)
                                            @if ($user->vehicles->count() == 1)
                                                <option value="{{ $vehicle->id }}" selected>
                                                    {{ $vehicle->vehicle_no }}</option>
                                            @else
                                                <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_no }}
                                                </option>
                                            @endif
                                        @endforeach

                                    </select>
                                </div>


                                <!-- Submit Button -->
                                <div class="flex items-end">
                                    <button type="submit"
                                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        Add Entry
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                @endif

            @endif


            <!-- Information Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <!-- Personal Information Card -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-xl transform transition-all duration-300 hover:-translate-y-2">
                    <div class="p-6 sm:p-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Personal Information
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $user->name }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Father's Name</p>
                                <p class="text-lg text-gray-900 dark:text-white mt-1">
                                    {{ $user->father_name ?? 'Not Provided' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">CNIC</p>
                                <p class="text-lg text-gray-900 dark:text-white mt-1">
                                    {{ $user->cnic ?? 'Not Provided' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</p>
                                <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $user->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Mobile</p>
                                <p class="text-lg text-gray-900 dark:text-white mt-1">
                                    {{ $user->mobile ?? 'Not Provided' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Telephone</p>
                                <p class="text-lg text-gray-900 dark:text-white mt-1">
                                    {{ $user->telephone ?? 'Not Provided' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Location</p>
                                <p class="text-lg text-gray-900 dark:text-white mt-1">
                                    {{ $user->location ? $user->location->city . ' - ' . $user->location->district : 'Not Assigned' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Family Members Card -->


                <div
                    class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-xl transform transition-all duration-300 hover:-translate-y-2">
                    <div class="p-6 sm:p-8">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>

                            Family Members


                        </h3>


                        <div class="bg-white rounded-lg shadow-lg p-4 mb-6">
                            <div class="animate-pulse flex space-x-4">
                                <div class="rounded-full bg-purple-400 h-12 w-12"></div>
                                <div class="flex-1 space-y-4 py-1">
                                    <div class="h-4 bg-purple-400 rounded w-3/4"></div>
                                    <div class="space-y-2">
                                        <div class="h-4 bg-purple-400 rounded"></div>
                                        <div class="h-4 bg-purple-400 rounded w-5/6"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 text-white text-center text-3xl font-bold">
                                {{ $user->familyMembers->count() }}
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            @foreach (['wife', 'son', 'daughter', 'other'] as $relation)
                                <div class="bg-white bg-opacity-20 rounded-lg p-4 text-white">
                                    <p class="text-lg font-semibold capitalize">{{ $relation }}</p>
                                    <p class="text-3xl font-bold mt-2">
                                        {{ $user->familyMembers->where('relationship', $relation)->count() }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6 flex justify-center">
                            <a href="{{ route('family-members.rfid_card_create_via_user', $user->id) }}"
                                class="bg-white text-purple-600 font-bold text-sm py-2 px-4 rounded-lg shadow-md hover:bg-purple-700 hover:text-white transition duration-300">
                                + Add Member
                            </a>
                        </div>

                    </div>
                </div>


                <!-- Quick Stats Card -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-xl transform transition-all duration-300 hover:-translate-y-2">
                    <div class="p-6 sm:p-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Quick Stats
                        </h3>
                        <div class="grid grid-cols-2 gap-6">
                            <div
                                class="bg-blue-500 rounded-lg shadow-lg p-4 text-white text-center transform transition-all duration-300 hover:scale-105">
                                <p class="text-lg font-semibold">RFID Cards</p>
                                <p class="text-3xl font-bold mt-2 animate-pulse">{{ $user->rfidCards->count() }}</p>
                            </div>
                            <div
                                class="bg-green-500 rounded-lg shadow-lg p-4 text-white text-center transform transition-all duration-300 hover:scale-105">
                                <p class="text-lg font-semibold">Vehicles</p>
                                <p class="text-3xl font-bold mt-2 animate-pulse">{{ $user->vehicles->count() }}</p>
                            </div>
                            <div
                                class="bg-yellow-500 rounded-lg shadow-lg p-4 text-white text-center transform transition-all duration-300 hover:scale-105">
                                <p class="text-lg font-semibold">Total Entries</p>
                                <p class="text-3xl font-bold mt-2 animate-pulse">{{ $user->accessLogs?->count() }}0
                                </p>
                            </div>
                            <div
                                class="bg-green-500 rounded-lg shadow-lg p-4 text-white text-center transform transition-all duration-300 hover:scale-105">
                                <p class="text-lg font-semibold">Access Granted</p>
                                <p class="text-3xl font-bold mt-2 animate-pulse">
                                    {{ $user->accessLogs?->where('status', 'granted')->count() }}0</p>
                            </div>
                            <div
                                class="col-span-2 bg-red-500 rounded-lg shadow-lg p-4 text-white text-center transform transition-all duration-300 hover:scale-105">
                                <p class="text-lg font-semibold">Access Denied</p>
                                <p class="text-3xl font-bold mt-2 animate-pulse">
                                    {{ $user->accessLogs?->where('status', 'denied')->count() }} 0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- RFID Cards Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-4">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <div class="p-4 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-600 animate-pulse" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            RFID Cards
                        </h3>
                        <a href="{{ route('rfid-card.rfid_card_create_via_user', $user->id) }}"
                            class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                            <svg class="w-3 h-3 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Add Card
                        </a>
                    </div>
                </div>
                <div class="p-1">
                    @if ($user->rfidCards->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 animate-cards">
                            @foreach ($user->rfidCards as $card)
                                <div class="group relative bg-white rounded-lg border border-gray-200 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md animate-cardEntrance"
                                    style="animation-delay: {{ $loop->index * 100 }}ms">
                                    <div
                                        class="absolute top-0 left-0 w-full h-0.5 bg-gradient-to-r transition-colors duration-300
                            {{ $card->status === 'active'
                                ? 'from-green-400 to-green-600'
                                : ($card->status === 'inactive'
                                    ? 'from-red-400 to-red-600'
                                    : 'from-yellow-400 to-yellow-600') }}">
                                    </div>

                                    <div class="p-3 space-y-2">
                                        <div class="flex items-center justify-between">
                                            <div class="space-y-0.5">
                                                <p
                                                    class="text-xs font-medium text-gray-500 group-hover:text-gray-700 transition-colors duration-300">
                                                    Card Number</p>
                                                <p
                                                    class="font-mono text-sm font-bold text-gray-900 tracking-wider group-hover:text-blue-600 transition-colors duration-300">
                                                    {{ $card->card_number }}
                                                </p>
                                            </div>
                                            <div class="flex space-x-2 items-center">
                                                <button
                                                    onclick="Livewire.emit('openModal', 'edit-rfid-card', {{ json_encode(['cardId' => $card->id]) }})"
                                                    class="p-1 text-gray-400 hover:text-blue-600 rounded-full hover:bg-blue-50 transition-all duration-300 transform hover:scale-110 active:scale-95">
                                                    <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <div
                                                    class="h-2.5 w-2.5 rounded-full {{ $card->status === 'active' ? 'bg-green-500' : ($card->status === 'inactive' ? 'bg-red-500' : 'bg-yellow-500') }} animate-pulse">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-0.5">
                                            <p
                                                class="text-xs font-medium text-gray-500 group-hover:text-gray-700 transition-colors duration-300">
                                                Status</p>
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold transition-colors duration-300
                                    {{ $card->status === 'active'
                                        ? 'bg-green-100 text-green-800'
                                        : ($card->status === 'inactive'
                                            ? 'bg-red-100 text-red-800'
                                            : 'bg-yellow-100 text-yellow-800') }}">
                                                <div
                                                    class="w-1.5 h-1.5 rounded-full mr-1
                                        {{ $card->status === 'active'
                                            ? 'bg-green-500'
                                            : ($card->status === 'inactive'
                                                ? 'bg-red-500'
                                                : 'bg-yellow-500') }}">
                                                </div>
                                                {{ ucfirst($card->status) }}
                                            </span>
                                        </div>

                                        <div class="space-y-0.5">
                                            <p
                                                class="text-xs font-medium text-gray-500 group-hover:text-gray-700 transition-colors duration-300">
                                                Expiry Date</p>
                                            <p
                                                class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">
                                                {{ $card->expiry_date->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-lg p-6 text-center space-y-3 animate-fadeIn">
                            <div class="relative w-14 h-14 mx-auto">
                                <svg class="w-full h-full text-gray-400 animate-pulse"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div
                                    class="absolute -right-1 -bottom-1 w-5 h-5 bg-blue-600 rounded-full flex items-center justify-center animate-bounce">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-base font-bold text-gray-900">No RFID Cards</h3>
                            <p class="text-sm text-gray-500">Get started by adding a new RFID card.</p>
                        </div>
                    @endif
                </div>
            </div>


            <!-- Family Members Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-4">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <div class="p-4 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-600 animate-pulse" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Family Members
                        </h3>
                        <a href="{{ route('family-members.rfid_card_create_via_user', $user->id) }}"
                            class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                            <svg class="w-3 h-3 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Add Family Member
                        </a>
                    </div>
                </div>

                <div class="p-1">
                    @if ($user->familyMembers->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 animate-cards">
                            @foreach ($user->familyMembers as $member)
                                <div class="group relative bg-white rounded-lg border border-gray-200 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md animate-cardEntrance"
                                    style="animation-delay: {{ $loop->index * 100 }}ms">

                                    <div class="p-3 space-y-2">
                                        <div class="space-y-0.5">
                                            <p class="text-xs font-medium text-gray-500">Name</p>
                                            <p class="text-sm font-bold text-gray-900">{{ $member->name }}</p>
                                        </div>

                                        <div class="space-y-0.5">
                                            <p class="text-xs font-medium text-gray-500">Relationship</p>
                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ ucfirst($member->relationship) }}</p>
                                        </div>

                                        <div class="space-y-0.5">
                                            <p class="text-xs font-medium text-gray-500">Gender</p>
                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ ucfirst($member->gender) }}</p>
                                        </div>

                                        <div class="space-y-0.5">
                                            <p class="text-xs font-medium text-gray-500">Date of Birth</p>
                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ $member->date_of_birth ? \Carbon\Carbon::parse($member->date_of_birth)->format('M d, Y') : 'Not provided' }}
                                            </p>
                                        </div>

                                        <div class="space-y-0.5">
                                            <p class="text-xs font-medium text-gray-500">CNIC</p>
                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ $member->cnic ?? 'Not provided' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-lg p-6 text-center space-y-3 animate-fadeIn">
                            <h3 class="text-base font-bold text-gray-900">No Family Members</h3>
                            <p class="text-sm text-gray-500">Get started by adding a new family member.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Vehicles Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <div class="p-6 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Vehicles
                        </h3>

                        <a href="{{ route('vehicles.vehicles_create_via_user', $user->id) }}"
                            class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                            <svg class="w-3 h-3 mr-1.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Add Vehicle
                        </a>
                    </div>
                </div>

                <div class="p-1">
                    @if ($user->vehicles->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 animate-cards">
                            @foreach ($user->vehicles as $vehicle)
                                <div class="group relative bg-white rounded-lg border border-gray-200 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-md animate-cardEntrance"
                                    style="animation-delay: {{ $loop->index * 100 }}ms">

                                    <div class="p-3 space-y-2">
                                        <div class="space-y-0.5">
                                            <p class="text-xs font-medium text-gray-500">Vehicle Number</p>
                                            <p class="text-sm font-bold text-gray-900">{{ $vehicle->vehicle_no }}</p>
                                        </div>

                                        <div class="space-y-0.5">
                                            <p class="text-xs font-medium text-gray-500">Make</p>
                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ ucfirst($vehicle->make) }}
                                            </p>
                                        </div>

                                        <div class="space-y-0.5">
                                            <p class="text-xs font-medium text-gray-500">Model</p>
                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ ucfirst($vehicle->model) }}
                                            </p>
                                        </div>

                                        <div class="space-y-0.5">
                                            <p class="text-xs font-medium text-gray-500">Manufacture Year</p>
                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ $vehicle->manufacture_year }}
                                            </p>
                                        </div>

                                        <div class="space-y-0.5">
                                            <p class="text-xs font-medium text-gray-500">Color</p>
                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ ucfirst($vehicle->color) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-lg p-6 text-center space-y-3 animate-fadeIn">
                            <h3 class="text-base font-bold text-gray-900">No Vehicles</h3>
                            <p class="text-sm text-gray-500">Get started by adding a new vehicle.</p>
                        </div>
                    @endif
                </div>
            </div>



            <!-- Time In/Time Out Entries Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Time In / Time Out Entries
                    </h3>


                    <!-- Entries List -->
                    @if ($user->entries->count() > 0)
                        <div class="flow-root">
                            <ul role="list" class="-mb-8">
                                @foreach ($user->entries()->latest()->get() as $entry)
                                    <li>
                                        <div class="relative pb-8">
                                            @if (!$loop->last)
                                                <span
                                                    class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700"
                                                    aria-hidden="true"></span>
                                            @endif
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span
                                                        class="h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center ring-8 ring-white dark:ring-gray-800">
                                                        <svg class="h-4 w-4 text-blue-600 dark:text-blue-400"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                    <div>
                                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                                            {{ ucfirst($entry->entry_type) }} at
                                                            <span class="font-medium text-gray-900 dark:text-gray-100">
                                                                {{ $entry->created_at->format('h:i A') }}
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="text-right text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                        {{ $entry->created_at->format('M d, Y') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No Entries Found</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Start tracking time by adding an
                                entry.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
