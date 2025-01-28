<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            Vehicles
        </h2>

        <div class="flex justify-center items-center float-right">
            <button id="toggle" class="inline-flex items-center ml-2 px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-950 focus:bg-green-800 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Search
            </button>
            <a href="{{ route('vehicles.create') }}" class="inline-flex items-center ml-2 px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-950 focus:bg-green-800 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="hidden md:inline-block">Add Vehicle</span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg" id="filters" style="display: none">
            <div class="p-6">
                <form method="GET" action="{{ route('vehicles.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                  
                        
                        <div>
                            <x-label for="vehicle_no" value="{{ __('Vehicle Number') }}"/>
                            <x-input id="vehicle_no" type="text" name="filter[vehicle_no]" :value="request('filter.vehicle_no')" class="mt-1 block w-full" />
                        </div>
                        <div>
                            <x-label for="user_id" value="{{ __('User') }}"/>
                            <select id="user_id" name="filter[user_id]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Users</option>
                                @foreach(\App\Models\User::active()->get() as $user)
                                    <option value="{{ $user->id }}" {{ request('filter.user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-label for="make" value="{{ __('Make') }}"/>
                            <x-input id="make" type="text" name="filter[make]" :value="request('filter.make')" class="mt-1 block w-full" />
                        </div>
                        <div>
                            <x-label for="model" value="{{ __('Model') }}"/>
                            <x-input id="model" type="text" name="filter[model]" :value="request('filter.model')" class="mt-1 block w-full" />
                        </div>
                     
                        <div>
                            <x-label for="color" value="{{ __('Color') }}"/>
                            <x-input id="color" type="text" name="filter[color]" :value="request('filter.color')" class="mt-1 block w-full" />
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
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <x-status-message/>
                @if($vehicles->count() > 0)
                    <div class="relative overflow-x-auto rounded-lg">
                        <table class="min-w-max w-full table-auto text-sm">
                            <thead>
                            <tr class="bg-blue-800 text-white uppercase text-sm">
                          
                                <th class="py-2 px-2 text-center">Vehicle No</th>
                                <th class="py-2 px-2 text-center">User</th>
                                <th class="py-2 px-2 text-center">Make</th>
                                <th class="py-2 px-2 text-center">Model</th>
                                <th class="py-2 px-2 text-center">Year</th>
                                <th class="py-2 px-2 text-center">Color</th>
                                <th class="py-2 px-2 text-center print:hidden">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="text-black text-md leading-normal font-extrabold">
                            @foreach($vehicles as $vehicle)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                             
                                    <td class="py-1 px-2 text-center">{{ $vehicle->vehicle_no }}</td>
                                    <td class="px-6 py-2 text-center">{{ $vehicle->user->name }}</td>
                                    <td class="py-1 px-2 text-center">{{ $vehicle->make }}</td>
                                    <td class="py-1 px-2 text-center">{{ $vehicle->model }}</td>
                                    <td class="py-1 px-2 text-center">{{ $vehicle->manufacture_year }}</td>
                                    <td class="py-1 px-2 text-center">{{ $vehicle->color }}</td>
                                    <td class="py-1 px-2 text-center">
                                        <a href="{{ route('vehicles.edit', $vehicle) }}" class="inline-flex items-center px-4 py-2 bg-green-800 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                            Edit
                                        </a>
                                        <form class="inline-block" method="POST" action="{{ route('vehicles.destroy', $vehicle) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 delete-button">
        Delete
    </button>
</form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-2 py-2">
                        {{ $vehicles->links() }}
                    </div>
                @else
                    <p class="text-gray-700 dark:text-gray-300 text-center py-4">
                        No vehicles found.
                        <a href="{{ route('vehicles.create') }}" class="text-blue-600 hover:underline">
                            Add a new vehicle
                        </a>
                    </p>
                @endif
            </div>
        </div>
    </div>

    @push('modals')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function (e) {
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
    @endpush
</x-app-layout>