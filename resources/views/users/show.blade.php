{{-- resources/views/users/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            User Profile
        </h2>
        <div class="flex justify-center items-center float-right">
            <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-800 dark:bg-blue-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-blue-800 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-white focus:bg-blue-700 dark:focus:bg-white active:bg-blue-900 dark:active:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-blue-800 transition ease-in-out duration-150">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-status-message class="mb-4"/>

            <!-- Profile Header -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="bg-gradient-to-r from-blue-800 to-blue-600 h-32"></div>
                <div class="px-6 py-4 relative">
                    <div class="flex items-center">
                        <div class="absolute -top-16">
                            <div class="w-32 h-32 rounded-lg shadow-xl overflow-hidden border-4 border-white dark:border-gray-700 bg-white dark:bg-gray-900 transform group-hover:scale-105 transition-transform duration-200">
                                @if($user->profile_photo_path)
                                    <img src="{{ Storage::url($user->profile_photo_path) }}"
                                         alt="{{ $user->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-50 dark:from-blue-900 dark:to-blue-800">
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
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <!-- Personal Information Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-xl transform transition-all duration-300 hover:-translate-y-2">
                    <div class="p-6 sm:p-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Personal Information
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $user->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Father's Name</p>
                                <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $user->father_name ?? 'Not Provided' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">CNIC</p>
                                <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $user->cnic ?? 'Not Provided' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</p>
                                <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $user->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Mobile</p>
                                <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $user->mobile ?? 'Not Provided' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Telephone</p>
                                <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $user->telephone ?? 'Not Provided' }}</p>
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
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-xl transform transition-all duration-300 hover:-translate-y-2">
                    <div class="p-6 sm:p-8">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
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
                            @foreach(['wife', 'son', 'daughter', 'other'] as $relation)
                                <div class="bg-white bg-opacity-20 rounded-lg p-4 text-white">
                                    <p class="text-lg font-semibold capitalize">{{ $relation }}</p>
                                    <p class="text-3xl font-bold mt-2">
                                        {{ $user->familyMembers->where('relationship', $relation)->count() }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-xl transform transition-all duration-300 hover:-translate-y-2">
                    <div class="p-6 sm:p-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Quick Stats
                        </h3>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="bg-blue-500 rounded-lg shadow-lg p-4 text-white text-center transform transition-all duration-300 hover:scale-105">
                                <p class="text-lg font-semibold">RFID Cards</p>
                                <p class="text-3xl font-bold mt-2 animate-pulse">{{ $user->rfidCards->count() }}</p>
                            </div>
                            <div class="bg-green-500 rounded-lg shadow-lg p-4 text-white text-center transform transition-all duration-300 hover:scale-105">
                                <p class="text-lg font-semibold">Vehicles</p>
                                <p class="text-3xl font-bold mt-2 animate-pulse">{{ $user->vehicles->count() }}</p>
                            </div>
                            <div class="bg-yellow-500 rounded-lg shadow-lg p-4 text-white text-center transform transition-all duration-300 hover:scale-105">
                                <p class="text-lg font-semibold">Total Entries</p>
                                <p class="text-3xl font-bold mt-2 animate-pulse">{{ $user->accessLogs?->count() }}0</p>
                            </div>
                            <div class="bg-green-500 rounded-lg shadow-lg p-4 text-white text-center transform transition-all duration-300 hover:scale-105">
                                <p class="text-lg font-semibold">Access Granted</p>
                                <p class="text-3xl font-bold mt-2 animate-pulse">{{ $user->accessLogs?->where('status', 'granted')->count() }}0</p>
                            </div>
                            <div class="col-span-2 bg-red-500 rounded-lg shadow-lg p-4 text-white text-center transform transition-all duration-300 hover:scale-105">
                                <p class="text-lg font-semibold">Access Denied</p>
                                <p class="text-3xl font-bold mt-2 animate-pulse">{{ $user->accessLogs?->where('status', 'denied')->count() }} 0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- RFID Cards Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <div class="p-6 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600 animate-pulse" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            RFID Cards
                        </h3>
                        <button onclick="Livewire.emit('openModal', 'add-rfid-card', {{ json_encode(['userId' => $user->id]) }})"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                            <svg class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:rotate-90" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add RFID Card
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    @if($user->rfidCards->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($user->rfidCards as $card)
                                <div class="group relative bg-white rounded-2xl border border-gray-200 shadow-lg transition-all duration-300 transform hover:-translate-y-2 overflow-hidden">
                                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r
          {{ $card->status === 'active' ? 'from-green-400 to-green-600' :
             ($card->status === 'inactive' ? 'from-red-400 to-red-600' :
             'from-yellow-400 to-yellow-600') }}">
                                    </div>

                                    <div class="p-6 space-y-6">
                                        <div class="flex items-center justify-between">
                                            <div class="space-y-1.5">
                                                <p class="text-sm font-medium text-gray-500">Card Number</p>
                                                <p class="font-mono text-xl font-bold text-gray-900 tracking-wider">
                                                    {{ $card->card_number }}
                                                </p>
                                            </div>
                                            <div class="h-4 w-4 rounded-full {{ $card->status === 'active' ? 'bg-green-500' : ($card->status === 'inactive' ? 'bg-red-500' : 'bg-yellow-500') }} animate-pulse"></div>
                                        </div>

                                        <div class="space-y-1.5">
                                            <p class="text-sm font-medium text-gray-500">Status</p>
                                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-semibold
              {{ $card->status === 'active' ? 'bg-green-100 text-green-800' :
                 ($card->status === 'inactive' ? 'bg-red-100 text-red-800' :
                 'bg-yellow-100 text-yellow-800') }}">
              <div class="w-2 h-2 rounded-full mr-2
                {{ $card->status === 'active' ? 'bg-green-500' :
                   ($card->status === 'inactive' ? 'bg-red-500' :
                   'bg-yellow-500') }}">
              </div>
              {{ ucfirst($card->status) }}
            </span>
                                        </div>

                                        <div class="space-y-1.5">
                                            <p class="text-sm font-medium text-gray-500">Expiry Date</p>
                                            <p class="text-lg font-semibold text-gray-900">
                                                {{ $card->expiry_date->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-2xl p-12 text-center space-y-6">
                            <div class="relative w-24 h-24 mx-auto">
                                <svg class="w-full h-full text-gray-400 animate-pulse" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div class="absolute -right-2 -bottom-2 w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center animate-bounce">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">No RFID Cards</h3>
                            <p class="text-gray-500">Get started by adding a new RFID card.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Vehicles Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <div class="p-6 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Vehicles
                        </h3>
                        <button onclick="Livewire.emit('openModal', 'add-vehicle', {{ json_encode(['userId' => $user->id]) }})"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add Vehicle
                        </button>
                    </div>
                </div>
                <div class="p-6">
                    @if($user->vehicles->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($user->vehicles as $vehicle)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 relative group">
                                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button onclick="Livewire.emit('openModal', 'edit-vehicle', {{ json_encode(['vehicleId' => $vehicle->id]) }})"
                                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-3">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <div class="h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $vehicle->make }} {{ $vehicle->model }}</h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $vehicle->registration_number }}</p>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Color</span>
                                            <span class="text-sm text-gray-900 dark:text-gray-100">{{ $vehicle->color }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Year</span>
                                            <span class="text-sm text-gray-900 dark:text-gray-100">{{ $vehicle->year }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No Vehicles</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by adding a new vehicle.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Recent Activity
                    </h3>
                    @if($user->entries->count() > 0)
                        <div class="flow-root">
                            <ul role="list" class="-mb-8">
                                @foreach($user->entries()->latest()->take(5)->get() as $entry)
                                    <li>
                                        <div class="relative pb-8">
                                            @if(!$loop->last)
                                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700" aria-hidden="true"></span>
                                            @endif
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center ring-8 ring-white dark:ring-gray-800">
                                                        <svg class="h-4 w-4 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                    <div>
                                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                                            Access {{ $entry->type }} using card
                                                            <span class="font-medium text-gray-900 dark:text-gray-100">{{ $entry->rfid_card->card_number }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="text-right text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                                        {{ $entry->created_at->diffForHumans() }}
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
                            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No Recent Activity</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">This user has no recent activity.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


                @push('modals')
        <script>
            function confirmCardDeletion(cardId) {
                if (confirm('Are you sure you want to delete this RFID card?')) {
                    Livewire.emit('deleteRfidCard', cardId);
                }
            }
        </script>
    @endpush
</x-app-layout>
