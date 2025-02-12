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



    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 mb-4 gap-6">
                <a href="{{ route('reports.family.access') }}"
                    class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white block">
                    <div class="p-5 flex justify-between">
                        <div>
                            {{--  <div class="text-3xl font-bold leading-8">{{ \App\Models\User::count() }}</div>  --}}
                            <div class="mt-1 text-base font-extrabold text-black">Family Report</div>
                        </div>
                        <img src="{{ url('icons-images/user.png') }}" alt="Users" class="h-14 w-14">
                    </div>
                </a>
                <a href="{{ route('rfid.report') }}"
                    class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white block">
                    <div class="p-5 flex justify-between">
                        <div>
                            {{--  <div class="text-3xl font-bold leading-8">{{ \App\Models\User::count() }}</div>  --}}
                            <div class="mt-1 text-base font-extrabold text-black">Rfid Reports</div>
                        </div>
                        <img src="{{ url('icons-images/user.png') }}" alt="Users" class="h-14 w-14">
                    </div>
                </a>

                <a href="{{ route('reports.access-activity') }}"
                    class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white block">
                    <div class="p-5 flex justify-between">
                        <div>
                            {{--  <div class="text-3xl font-bold leading-8">{{ \App\Models\User::count() }}</div>  --}}
                            <div class="mt-1 text-base font-extrabold text-black">Access Activity Reports</div>
                        </div>
                        <img src="{{ url('icons-images/user.png') }}" alt="Users" class="h-14 w-14">
                    </div>
                </a>
                <a href="{{ route('reports.guard.activity') }}"
                    class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white block">
                    <div class="p-5 flex justify-between">
                        <div>
                            {{--  <div class="text-3xl font-bold leading-8">{{ \App\Models\User::count() }}</div>  --}}
                            <div class="mt-1 text-base font-extrabold text-black">Guard Activity Reports</div>
                        </div>
                        <img src="{{ url('icons-images/user.png') }}" alt="Users" class="h-14 w-14">
                    </div>
                </a>
                <a href="{{ route('reports.aggregate.report') }}"
                    class="transform hover:scale-110 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white block">
                    <div class="p-5 flex justify-between">
                        <div>
                            {{--  <div class="text-3xl font-bold leading-8">{{ \App\Models\User::count() }}</div>  --}}
                            <div class="mt-1 text-base font-extrabold text-black">Aggregate Reports</div>
                        </div>
                        <img src="{{ url('icons-images/user.png') }}" alt="Users" class="h-14 w-14">
                    </div>
                </a>


            </div>
        </div>
    </div>


    </div>
    </div>
    </div>



</x-app-layout>
