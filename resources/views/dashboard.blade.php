
<x-app-layout>
    @if(auth()->user()->role == "Admin")
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">

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
            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                  <div class="grid grid-cols-12 mb-4 gap-6 pb-6">

                        <a href="#" class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white block">
                            <div class="p-5 flex justify-between">
                                <div>
                                    <div class="text-1xl font-medium leading-8">Total Users</div>
                                    <div class="mt-1 text-base font-semibold  text-black">43</div>
                                </div>
                                <img src="{{url('icons-images/users.png') }}" alt="Users" class="h-16 w-16">
                            </div>
                        </a>

                        <a href="#" class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white block">
                            <div class="p-5 flex justify-between">
                                <div>
                                    <div class="text-1xl font-medium leading-8">Total Enteries</div>
                                    <div class="mt-1 text-base font-semibold  text-black">12</div>
                                </div>
                                <img src="{{url('icons-images/enteries.png') }}" alt="Enteries" class="h-16 w-16">
                            </div>
                        </a>
                        <a href="#" class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white block">
                            <div class="p-5 flex justify-between">
                                <div>
                                    <div class="text-1xl font-medium leading-8">Active RFID Cards</div>
                                    <div class="mt-1 text-base font-semibold  text-black">4</div>
                                </div>
                                <img src="{{url('icons-images/active.png') }}" alt="Active" class="h-16 w-16">
                            </div>
                        </a>

                        <a href="#" class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white block">
                            <div class="p-5 flex justify-between">
                                <div>
                                    <div class="text-1xl font-medium leading-8">Inactive Cards</div>
                                    <div class="mt-1 text-base font-semibold  text-black">20</div>
                                </div>
                                <img src="{{ url('icons-images/inactive.png') }}" alt="Inactive" class="h-16 w-16">
                            </div>
                        </a>

                        <a href="#" class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white block">
                            <div class="p-5 flex justify-between">
                                <div>
                                    <div class="text-1xl font-medium leading-8">Registered Vehicles</div>
                                    <div class="mt-1 text-base font-semibold  text-black">29</div>
                                </div>
                                <img src="{{url('icons-images/vehicles.png') }}" alt="Vehicles" class="h-16 w-16">
                            </div>
                        </a>
                        <a href="#" class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white block">
                            <div class="p-5 flex justify-between">
                                <div>
                                    <div class="text-1xl font-medium leading-8">Access Granted</div>
                                    <div class="mt-1 text-base font-semibold  text-black">23</div>
                                </div>
                                <img src="{{url('icons-images/granted.png') }}" alt="Access" class="h-16 w-16">
                            </div>
                        </a>
                        </a>
                        <a href="#" class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white block">
                            <div class="p-5 flex justify-between">
                                <div>
                                    <div class="text-1xl font-medium leading-8">Access Denied</div>
                                    <div class="mt-1 text-base font-semibold  text-black">21</div>
                                </div>
                                <img src="{{url('icons-images/denied.png') }}" alt="Denied" class="h-16 w-16">
                            </div>
                        </a>
                        </a>
                        <a href="#" class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white block">
                            <div class="p-5 flex justify-between">
                                <div>
                                    <div class="text-1xl font-medium leading-8">Expired Cards</div>
                                    <div class="mt-1 text-base font-semibold  text-black">33</div>
                                </div>
                                <img src="{{ url('icons-images/expired1.png') }}" alt="Expired" class="h-16 w-16">
                            </div>
                        </a>
                    </div>

                
                    <!DOCTYPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.41.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            position: relative;
            height: 350px;
            width: 100%;
        }
    </style>
</head>
<body class="bg-gray-100 p-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 transform transition duration-300 hover:scale-105 active:scale-95 cursor-pointer">
            <h2 class="text-xl font-semibold mb-4">Today's Traffic Pattern</h2>
            <div class="chart-container">
                <div id="trafficChart"></div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6 transform transition duration-300 hover:scale-105 active:scale-95 cursor-pointer">
            <h2 class="text-xl font-semibold mb-4">Weekly Vehicle Traffic</h2>
            <div class="chart-container">
                <div id="vehicleChart"></div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6 transform transition duration-300 hover:scale-105 active:scale-95 cursor-pointer">
            <h2 class="text-xl font-semibold mb-4">RFID Card Status Distribution</h2>
            <div class="chart-container">
                <div id="cardStatusChart"></div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 transform transition duration-300 hover:scale-105 active:scale-95 cursor-pointer">
            <h2 class="text-xl font-semibold mb-4">Unauthorized Access Attempts</h2>
            <div class="chart-container">
                <canvas id="unauthorizedAttemptsChart"></canvas>
            </div>
        </div>
    </div>
</body>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var trafficOptions = {
    chart: { 
        type: 'line',
        toolbar: { show: false }  // This hides the zoom and other controls
    },
    series: [
        { name: 'Entries', data: [12, 5, 45, 28, 52, 20] },
        { name: 'Exits', data: [8, 3, 30, 25, 48, 25] }
    ],
    xaxis: { categories: ['00:00', '04:00', '08:00', '12:00', '16:00', '20:00'] }
};
new ApexCharts(document.querySelector("#trafficChart"), trafficOptions).render();


            var vehicleOptions = {
                chart: { type: 'bar' },
                series: [{ name: 'Vehicle Count', data: [150, 180, 165, 190, 210, 140, 120] }],
                xaxis: { categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] }
            };
            var vehicleOptions = {
    chart: { 
        type: 'bar',
        height: "100%",  // Ensures it fits inside the container
        width: "100%" 
    },
    series: [{ name: 'Vehicle Count', data: [150, 180, 165, 190, 210, 140, 120] }],
    xaxis: { categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] }
};
new ApexCharts(document.querySelector("#vehicleChart"), vehicleOptions).render();

var cardStatusOptions = {
    chart: { 
        type: 'donut',
        height: "100%",  // Ensures it fits inside the container
        width: "100%" 
    },
    series: [750, 120, 30],
    labels: ['Active', 'Expired', 'Inactive']
};
new ApexCharts(document.querySelector("#cardStatusChart"), cardStatusOptions).render();

       const unauthorizedAttemptsData = {
                labels: ['Gate 1', 'Gate 2', 'Gate 3'],
                datasets: [{
                    label: 'Attempts',
                    data: [3, 5, 2],
                    backgroundColor: ['#EF4444', '#F59E0B', '#6366F1']
                }]
            };

            new Chart(document.getElementById('unauthorizedAttemptsChart'), {
                type: 'bar',
                data: unauthorizedAttemptsData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } }
                }
            });
        });
    </script>

</body>
</html>

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
