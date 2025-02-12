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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">


                <!-- Filters -->
                <div class="bg-gray-100 p-4 rounded-md mb-6">
                    <form method="GET" action="{{ route('reports.access-activity') }}"
                        class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
                            <input type="date" name="date" class="w-full border rounded-lg p-2"
                                value="{{ request('date') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Access Type</label>
                            <select name="type" class="w-full border rounded-lg p-2">
                                <option value="" {{ request('type') == '' ? 'selected' : '' }}>All</option>
                                <option value="entry" {{ request('type') == 'entry' ? 'selected' : '' }}>Entry</option>
                                <option value="exit" {{ request('type') == 'exit' ? 'selected' : '' }}>Exit</option>
                                <option value="denied" {{ request('type') == 'denied' ? 'selected' : '' }}>Denied
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gate</label>
                            <input type="text" name="gate" class="w-full border rounded-lg p-2"
                                value="{{ request('gate') }}">
                        </div>
                        <div class="md:col-span-3 flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Apply Filters
                            </button>
                        </div>
                    </form>
                </div>


                <!-- Summary Cards -->
                <div class="grid grid-cols-12 gap-6 mb-6">
                    <a href="#"
                        class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 bg-white block">
                        <div class="p-5 flex justify-between">
                            <div>
                                <div class="text-gray-500 text-sm">Total Entries</div>
                                <div class="mt-1 text-3xl font-bold text-black">1,234</div>
                            </div>
                            <div class="rounded-full p-3 bg-green-100 text-green-600">
                                <i class="fas fa-door-open text-2xl"></i>
                            </div>
                        </div>
                    </a>

                    <a href="#"
                        class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 bg-white block">
                        <div class="p-5 flex justify-between">
                            <div>
                                <div class="text-gray-500 text-sm">Total Exits</div>
                                <div class="mt-1 text-3xl font-bold text-black">1,156</div>
                            </div>
                            <div class="rounded-full p-3 bg-blue-100 text-blue-600">
                                <i class="fas fa-door-closed text-2xl"></i>
                            </div>
                        </div>
                    </a>

                    <a href="#"
                        class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 bg-white block">
                        <div class="p-5 flex justify-between">
                            <div>
                                <div class="text-gray-500 text-sm">Access Denied</div>
                                <div class="mt-1 text-3xl font-bold text-black">23</div>
                            </div>
                            <div class="rounded-full p-3 bg-red-100 text-red-600">
                                <i class="fas fa-ban text-2xl"></i>
                            </div>
                        </div>
                    </a>

                    <a href="#"
                        class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 bg-white block">
                        <div class="p-5 flex justify-between">
                            <div>
                                <div class="text-gray-500 text-sm">Avg. Processing Time</div>
                                <div class="mt-1 text-3xl font-bold text-black">2.3s</div>
                            </div>
                            <div class="rounded-full p-3 bg-yellow-100 text-yellow-600">
                                <i class="fas fa-clock text-2xl"></i>
                            </div>
                        </div>
                    </a>
                </div>


                <!-- Data Table -->
                <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-blue-800 text-white uppercase text-sm">
                                <th class="py-2 px-2 text-center">
                                    Timestamp
                                </th>
                                <th class="py-2 px-2 text-center">User
                                </th>
                                <th class="class="py-2 px-2 text-center">RFID
                                    Card
                                </th>
                                <th class="class="py-2 px-2 text-center">Type
                                </th>
                                <th class="class="py-2 px-2 text-center">Gate
                                </th>
                                <th class="class="py-2 px-2 text-center">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($entries as $entry)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $entry->created_at }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $entry->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $entry->rfid_card }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ ucfirst($entry->type) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $entry->gate }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 inline-flex text-xs font-semibold rounded-full bg-{{ $entry->status == 'granted' ? 'green' : 'red' }}-100 text-{{ $entry->status == 'granted' ? 'green' : 'red' }}-800">
                                            {{ ucfirst($entry->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4">{{ $entries->links() }}</div>
            </div>
        </div>
    </div>

</x-app-layout>
