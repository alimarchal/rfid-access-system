<x-app-layout>
    @if(auth()->user()->role == "Admin")
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>
    @endif

    @if(auth()->user()->role == "Guard")
        <div class="min-h-screen py-4 sm:py-6 lg:py-10 bg-gradient-to-br from-blue-50 to-indigo-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative transform transition-all duration-300 hover:scale-[1.01]">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl opacity-10 blur-xl"></div>
                    <div class="relative bg-white backdrop-blur-lg shadow-xl rounded-2xl overflow-hidden border border-gray-100">
                        <div class="p-4 sm:p-6 lg:p-8 space-y-6">
                            <x-status-custom-message />
                            <div class="w-full max-w-xl mx-auto">
                                <div class="text-center mb-6">
                                    <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">Card Verification</h2>
                                    <p class="mt-2 text-gray-600">Please scan or enter the card number below</p>
                                </div>

                                <x-validation-errors class="mb-6 transform transition-all duration-300" style="direction: rtl; text-align: right;" />

                                <form method="POST" action="{{ route('search_by_rfid_card') }}" class="space-y-6">
                                    @csrf
                                    <div class="space-y-4">
                                        <div class="relative group">
                                            <x-label for="card_number" value="Card No"
                                                class="text-sm font-medium text-gray-700 mb-1 transition-colors duration-200" />
                                            <div class="relative w-full">
                                                <x-input
                                                    id="card_number"
                                                    type="text"
                                                    name="card_number"
                                                    class="block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-700 shadow-sm transition duration-200 ease-in-out focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 hover:border-blue-400"
                                                    :value="old('card_number')"
                                                    required
                                                    maxlength="255"
                                                    placeholder="Enter card number here..."
                                                    autofocus
                                                />
                                            </div>
                                        </div>

                                        <div class="pt-6 flex justify-center w-full">
                                            <x-button class="w-full max-w-md transform transition-all duration-300 hover:scale-[1.02] bg-gradient-to-r from-blue-600 to-purple-600 hover:from-purple-600 hover:to-blue-600 text-white py-4 rounded-xl shadow-lg hover:shadow-2xl focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 font-semibold text-lg flex justify-center items-center space-x-3">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                </svg>
                                                <span>Verify Card</span>
                                            </x-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(auth()->user()->role == "Admin")
        <div class="py-12">
            {{-- Admin content commented section remains unchanged --}}
        </div>
    @elseif(auth()->user()->role == "Citizen")
        <div class="py-12">
        </div>
    @endif

    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        /* Add these styles to force full width */
        #card_number {
            width: 100% !important;
            min-width: 100% !important;
            max-width: 100% !important;
        }

        .relative.w-full {
            display: block;
            width: 100%;
        }

        /* Remove any max-width constraints from parent containers */
        .max-w-xl {
            max-width: none !important;
        }
    </style>
</x-app-layout>
