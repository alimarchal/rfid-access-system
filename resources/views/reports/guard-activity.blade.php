<x-app-layout>

    @push('header')
        <link rel="stylesheet" href="{{ url('jsandcss/daterangepicker.min.css') }}">
        <script src="{{ url('jsandcss/moment.min.js') }}"></script>
        <script src="{{ url('jsandcss/knockout-3.5.1.js') }}" defer></script>
        <script src="{{ url('jsandcss/daterangepicker.min.js') }}" defer></script>
    @endpush


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            Guard Activity Report </h2>

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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Filters -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h2 class="text-lg font-semibold mb-4">Filters</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Guard Name</label>
                            <select class="w-full border rounded-lg p-2">
                                <option>All Guards</option>
                                <option>John Doe</option>
                                <option>Jane Smith</option>
                                <option>Mike Johnson</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Shift</label>
                            <select class="w-full border rounded-lg p-2">
                                <option>All Shifts</option>
                                <option>Morning (6AM-2PM)</option>
                                <option>Evening (2PM-10PM)</option>
                                <option>Night (10PM-6AM)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
                            <select class="w-full border rounded-lg p-2">
                                <option>Today</option>
                                <option>Last 7 Days</option>
                                <option>This Month</option>
                                <option>Custom Range</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Apply Filters
                        </button>
                    </div>
                </div>

                <!-- Performance Metrics -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex items-center">
                            <div class="rounded-full p-3 bg-blue-100 text-blue-600">
                                <i class="fas fa-user-check text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Total Verifications</p>
                                <p class="text-xl font-bold">256</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex items-center">
                            <div class="rounded-full p-3 bg-green-100 text-green-600">
                                <i class="fas fa-clock text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Avg Response Time</p>
                                <p class="text-xl font-bold">45s</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex items-center">
                            <div class="rounded-full p-3 bg-yellow-100 text-yellow-600">
                                <i class="fas fa-exclamation-triangle text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Incidents Handled</p>
                                <p class="text-xl font-bold">12</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-4">
                        <div class="flex items-center">
                            <div class="rounded-full p-3 bg-purple-100 text-purple-600">
                                <i class="fas fa-tasks text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-500 text-sm">Hours on Duty</p>
                                <p class="text-xl font-bold">8.5</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Table -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-4 border-b flex justify-between items-center">
                        <h2 class="text-xl font-semibold">Guard Activity Log</h2>
                        <button class="flex items-center px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200">
                            <i class="fas fa-download mr-2"></i>
                            Export
                        </button>
                    </div>
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                                <div class="relative overflow-x-auto rounded-lg">
                                    <table class="min-w-max w-full table-auto text-sm">
                                        <thead class="bg-gray-50">
                                            <tr class="bg-blue-800 text-white uppercase text-sm">
                                                <th class="py-2 px-2 text-center">
                                                    Time
                                                </th>
                                                <th class="py-2 px-2 text-center">
                                                    Guard Name
                                                </th>
                                                <th class="py-2 px-2 text-center">
                                                    Activity Type
                                                </th>
                                                <th class="py-2 px-2 text-center">
                                                    Location
                                                </th>
                                                <th class="py-2 px-2 text-center">
                                                    Details
                                                </th>
                                                <th class="py-2 px-2 text-center">
                                                    Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">


                                            </tr>
                                            <!-- Add more sample rows -->
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Pagination -->
                                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1 flex justify-between sm:hidden">
                                            <a href="#"
                                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                                Previous
                                            </a>
                                            <a href="#"
                                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                                Next
                                            </a>
                                        </div>
                                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                            <div>
                                                <p class="text-sm text-gray-700">
                                                    Showing <span class="font-medium">1</span> to <span
                                                        class="font-medium">10</span> of
                                                    <span class="font-medium">45</span> results
                                                </p>
                                            </div>
                                            <div>
                                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                                    aria-label="Pagination">
                                                    <a href="#"
                                                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                        <i class="fas fa-chevron-left"></i>
                                                    </a>
                                                    <a href="#"
                                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</a>
                                                    <a href="#"
                                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</a>
                                                    <a href="#"
                                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</a>
                                                    <a href="#"
                                                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </a>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

</x-app-layout>
