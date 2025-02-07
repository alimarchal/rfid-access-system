<x-app-layout>
    @push('header')
        <link rel="stylesheet" href="{{ url('jsandcss/daterangepicker.min.css') }}">
        <script src="{{ url('jsandcss/moment.min.js') }}"></script>
        <script src="{{ url('jsandcss/knockout-3.5.1.js') }}" defer></script>
        <script src="{{ url('jsandcss/daterangepicker.min.js') }}" defer></script>
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            RFID Card Status Report
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

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form method="GET" action="{{ route('rfid.report') }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <x-label for="card_id" value="{{ __('Card ID') }}" />
                        <x-input id="card_id" type="text" name="filter[card_id]" :value="request('filter.card_id')"
                            class="mt-1 block w-full" />
                    </div>
                    <div>
                        <x-label for="status" value="{{ __('Status') }}" />
                        <select id="status" name="filter[status]" class="mt-1 block w-full rounded-md shadow-sm">
                            <option value="">Select Status</option>
                            <option value="active" {{ request('filter.status') == 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="inactive" {{ request('filter.status') == 'inactive' ? 'selected' : '' }}>
                                Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <x-button class="bg-blue-800 text-white hover:bg-green-800">
                        {{ __('Apply Filters') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                {{--  @if ($reports->count() > 0)  --}}
                <div class="relative overflow-x-auto rounded-lg">
                    <table class="min-w-max w-full table-auto text-sm">
                        <thead>
                            <tr class="bg-blue-800 text-white uppercase text-sm">
                                <th class="py-2 px-2 text-center">Card ID</th>
                                <th class="py-2 px-2 text-center">Status</th>
                                <th class="py-2 px-2 text-center">Issued Date</th>
                            </tr>
                        </thead>
                        <tbody class="text-black text-md leading-normal font-extrabold">
                            {{--  @foreach ($reports as $report)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-1 px-2 text-center">{{ $report->card_id }}</td>
                                        <td class="py-1 px-2 text-center">{{ ucfirst($report->status) }}</td>
                                        <td class="py-1 px-2 text-center">{{ $report->issued_at }}</td>
                                    </tr>
                                @endforeach  --}}
                        </tbody>
                    </table>
                </div>
                {{--  <div class="px-2 py-2">
                    {{ $reports->links() }}
                </div>
            @else
                <p class="text-gray-700 dark:text-gray-300 text-center py-4">
                    No records found.
                </p>
                @endif
            </div>  --}}
            </div>
        </div>
</x-app-layout>
