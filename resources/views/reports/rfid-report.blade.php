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
            <button id="toggle"
                class="inline-flex items-center ml-2 px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-950 focus:bg-green-800 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Search
            </button>

            <a href="javascript:window.location.reload();"
                class="inline-flex items-center ml-2 px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-950 focus:bg-green-800 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
            </a>
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
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg" id="filters"
            style="display: none">
            <div class="p-6">
                <form method="GET" action="{{ route('rfid.report') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <x-label for="card_id" value="{{ __('Card ID') }}" />
                            <x-input id="card_id" type="text" name="filter[card_id]" :value="request('filter.card_id')"
                                class="mt-1 block w-full" />
                        </div>
                        <div>
                            <x-label for="status" value="{{ __('Status') }}" />
                            <select id="status" name="filter[status]"
                                class="select2 mt-1 block w-full rounded-md shadow-sm">
                                <option value="">Select Status</option>
                                <option value="active" {{ request('filter.status') == 'active' ? 'selected' : '' }}>
                                    Active
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
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-green-100 text-green-600">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm">Active Cards</p>
                            <p class="text-xl font-bold">568</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-red-100 text-red-600">
                            <i class="fas fa-times-circle text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm">Inactive Cards</p>
                            <p class="text-xl font-bold">42</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-yellow-100 text-yellow-600">
                            <i class="fas fa-exclamation-circle text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm">Expiring Soon</p>
                            <p class="text-xl font-bold">23</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center">
                        <div class="rounded-full p-3 bg-blue-100 text-blue-600">
                            <i class="fas fa-sync text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-gray-500 text-sm">Renewed This Month</p>
                            <p class="text-xl font-bold">15</p>
                        </div>
                    </div>
                </div>
            </div>


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
            @push('modals')
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    document.querySelectorAll('.delete-button').forEach(button => {
                        button.addEventListener('click', function(e) {
                            e.preventDefault();
                            const form = this.closest('form');
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.submit();
                                }
                            });
                        });
                    });
                </script>
                <script>
                    const targetDiv = document.getElementById("filters");
                    const btn = document.getElementById("toggle");

                    function showFilters() {
                        targetDiv.style.display = 'block';
                        targetDiv.style.opacity = '0';
                        targetDiv.style.transform = 'translateY(-20px)';
                        setTimeout(() => {
                            targetDiv.style.opacity = '1';
                            targetDiv.style.transform = 'translateY(0)';
                        }, 10);
                    }

                    function hideFilters() {
                        targetDiv.style.opacity = '0';
                        targetDiv.style.transform = 'translateY(-20px)';
                        setTimeout(() => {
                            targetDiv.style.display = 'none';
                        }, 300);
                    }

                    btn.onclick = function(event) {
                        event.stopPropagation();
                        if (targetDiv.style.display === "none") {
                            showFilters();
                        } else {
                            hideFilters();
                        }
                    };

                    // Hide filters when clicking outside
                    document.addEventListener('click', function(event) {
                        if (targetDiv.style.display === 'block' && !targetDiv.contains(event.target) && event.target !== btn) {
                            hideFilters();
                        }
                    });

                    // Prevent clicks inside the filter from closing it
                    targetDiv.addEventListener('click', function(event) {
                        event.stopPropagation();
                    });

                    // Add CSS for smooth transitions
                    const style = document.createElement('style');
                    style.textContent = `#filters {transition: opacity 0.3s ease, transform 0.3s ease;}`;
                    document.head.appendChild(style);
                </script>
                <script>
                    $(document).ready(function() {
                        $('.select2').select2();
                    });
                </script>
            @endpush
</x-app-layout>
