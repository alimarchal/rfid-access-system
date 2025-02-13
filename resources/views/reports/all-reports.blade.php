<x-app-layout>

    @push('header')
        <link rel="stylesheet" href="{{ url('jsandcss/daterangepicker.min.css') }}">
        <script src="{{ url('jsandcss/moment.min.js') }}"></script>
        <script src="{{ url('jsandcss/knockout-3.5.1.js') }}" defer></script>
        <script src="{{ url('jsandcss/daterangepicker.min.js') }}" defer></script>
    @endpush

    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight inline-block">
            Reports
        </h2>

        <div class="flex justify-center items-center float-right">
            <a href="{{ route('reports.all-reports') }}"
                class="inline-flex items-center ml-2 px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 focus:bg-green-800 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-6 mb-4">
                <a href="{{ route('reports.family.access') }}"
                    class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-1 intro-y bg-white block">
                    <div class="p-5 flex justify-between">
                        <div>
                            <div class="mt-1 text-lg font-medium text-black">Family Report</div>
                        </div>
                        <img src="{{ url('icons-images/familyreports.png') }}" alt="Family" class="h-14 w-14">
                    </div>
                </a>
                <a href="{{ route('rfid.report') }}"
                    class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-1 intro-y bg-white block">
                    <div class="p-5 flex justify-between">
                        <div>
                            <div class="mt-1 text-lg font-medium text-black">RFID Reports</div>
                        </div>
                        <img src="{{ url('icons-images/rfid.png') }}" alt="Rfid" class="h-14 w-14">
                    </div>
                </a>
                <a href="{{ route('reports.access-activity') }}"
                    class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-1 intro-y bg-white block">
                    <div class="p-5 flex justify-between">
                        <div>
                            <div class="mt-1 text-lg font-medium text-black">Access Activity Reports</div>
                        </div>
                        <img src="{{ url('icons-images/access1.png') }}" alt="Access" class="h-14 w-14">
                    </div>
                </a>
                <a href="{{ route('reports.guard.activity') }}"
                    class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-1 intro-y bg-white block">
                    <div class="p-5 flex justify-between">
                        <div>
                            <div class="mt-1 text-lg font-medium text-black">Guard Activity Reports</div>
                        </div>
                        <img src="{{ url('icons-images/guardreports.png') }}" alt="Guard" class="h-14 w-14">
                    </div>
                </a>
                <a href="{{ route('reports.aggregate.report') }}"
                    class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-1 intro-y bg-white block">
                    <div class="p-5 flex justify-between">
                        <div>
                            <div class="mt-1 text-lg font-medium text-black">Aggregate Reports</div>
                        </div>
                        <img src="{{ url('icons-images/aggregate.png') }}" alt="Aggregate" class="h-14 w-14">
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>