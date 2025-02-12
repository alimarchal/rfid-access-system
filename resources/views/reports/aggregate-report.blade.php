<x-app-layout>

    @push('header')
        <link rel="stylesheet" href="{{ url('jsandcss/daterangepicker.min.css') }}">
        <script src="{{ url('jsandcss/moment.min.js') }}"></script>
        <script src="{{ url('jsandcss/knockout-3.5.1.js') }}" defer></script>
        <script src="{{ url('jsandcss/daterangepicker.min.js') }}" defer></script>
    @endpush


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            Settings
        </h2>

        <div class="flex justify-center items-center float-right">

            <a href="{{ route('reports.all-reports') }}"
                class="inline-flex items-center ml-2 px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 focus:bg-green-800 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <!-- Arrow Left Icon SVG -->
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        </div>

    </x-slot>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aggregate Analysis Report</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <body class="bg-gray-50">
        <div class="p-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Aggregate Analysis Report</h1>

                <!-- Time Period Selector -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Time Period</label>
                            <select class="w-full border rounded-lg p-2">
                                <option>Last 7 Days</option>
                                <option>Last 30 Days</option>
                                <option>Last 90 Days</option>
                                <option>Custom Range</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                            <select class="w-full border rounded-lg p-2">
                                <option>All Locations</option>
                                <option>Gate 1</option>
                                <option>Gate 2</option>
                                <option>Gate 3</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Overall Traffic Summary -->
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="p-4 border-b">
                        <h2 class="text-xl font-semibold">Overall Traffic Summary</h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <canvas id="dailyTrafficChart" height="200"></canvas>
                            </div>
                            <div>
                                <canvas id="hourlyDistributionChart" height="200"></canvas>
                            </div>
                            <div>
                                <canvas id="accessTypeChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aggregate Tables -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Daily Aggregates -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b">
                            <h2 class="text-xl font-semibold">Daily Aggregates</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total Entries
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Vehicles
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Peak Hour
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            2025-02-06
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            1,234
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            456
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            09:00-10:00
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Access Type Distribution -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b">
                            <h2 class="text-xl font-semibold">Access Type Distribution</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Type
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Count
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Percentage
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Trend
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            Residents
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            2,345
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            45%
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="text-green-600">↑ 5%</span>
                                        </td>
                                    </tr>
                                    <!-- Add more rows -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Trend Analysis -->
                <div class="bg-white rounded-lg shadow mt-6">
                    <div class="p-4 border-b">
                        <h2 class="text-xl font-semibold">Trend Analysis</h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-semibold mb-2">Peak Hours</h3>
                                <table class="w-full">
                                    <tr>
                                        <td class="text-sm text-gray-600">Morning Peak</td>
                                        <td class="text-sm font-medium">08:00-10:00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm text-gray-600">Evening Peak</td>
                                        <td class="text-sm font-medium">17:00-19:00</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-semibold mb-2">Vehicle Distribution</h3>
                                <table class="w-full">
                                    <tr>
                                        <td class="text-sm text-gray-600">Cars</td>
                                        <td class="text-sm font-medium">75%</td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm text-gray-600">Motorcycles</td>
                                        <td class="text-sm font-medium">15%</td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm text-gray-600">Others</td>
                                        <td class="text-sm font-medium">10%</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="font-semibold mb-2">Access Patterns</h3>
                                <table class="w-full">
                                    <tr>
                                        <td class="text-sm text-gray-600">Weekday Avg</td>
                                        <td class="text-sm font-medium">1,200</td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm text-gray-600">Weekend Avg</td>
                                        <td class="text-sm font-medium">800</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Initialize charts with sample data
            function initializeCharts() {
                // Daily Traffic Chart
                const dailyTrafficCtx = document.getElementById('dailyTrafficChart').getContext('2d');
                new Chart(dailyTrafficCtx, {
                    type: 'line',
                    data: {
                        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                        datasets: [{
                            label: 'Daily Traffic',
                            data: [1200, 1150, 1300, 1250, 1400, 900, 800],
                            borderColor: 'rgb(59, 130, 246)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Daily Traffic Pattern'
                            }
                        }
                    }
                });

                // Hourly Distribution Chart
                const hourlyDistributionCtx = document.getElementById('hourlyDistributionChart').getContext('2d');
                new Chart(hourlyDistributionCtx, {
                    type: 'bar',
                    data: {
                        labels: ['6-9', '9-12', '12-15', '15-18', '18-21', '21-24'],
                        datasets: [{
                            label: 'Hourly Distribution',
                            data: [300, 450, 320, 380, 420, 280],
                            backgroundColor: 'rgba(16, 185, 129, 0.5)'
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Hourly Distribution'
                            }
                        }
                    }
                });

                // Access Type Chart
                const accessTypeCtx = document.getElementById('accessTypeChart').getContext('2d');
                new Chart(accessTypeCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Residents', 'Visitors', 'Staff'],
                        datasets: [{
                            data: [45, 35, 20],
                            backgroundColor: [
                                'rgba(59, 130, 246, 0.5)',
                                'rgba(16, 185, 129, 0.5)',
                                'rgba(245, 158, 11, 0.5)'
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Access Type Distribution'
                            }
                        }
                    }
                });
            }

            // Initialize charts when page loads
            document.addEventListener('DOMContentLoaded', initializeCharts);
        </script>
    </body>

    </html>
</x-app-layout>
