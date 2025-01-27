<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            Branch Targets
        </h2>

        <div class="flex justify-center items-center float-right">
            <a href="{{ route('branch-targets.index') }}"
               class="inline-flex items-center ml-2 px-4 py-2 bg-blue-950 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 focus:bg-green-800 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <!-- Arrow Left Icon SVG -->
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg" id="filters" style="display: none">
            <div class="p-6">
            </div>
        </div>
    </div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                <!-- Display session message -->
               <x-status-message class="mb-4 mt-4" />



                <div class="p-6">
                    <x-validation-errors class="mb-4 mt-4" />
                    <form method="POST" action="{{ route('branch-targets.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="branch_id" value="Branch" :required="true" />
                                <select name="branch_id" id="branch_id" class="select2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" required>
                                    <option value="">Select Branch</option>

                                    @foreach($branches as $id => $name)
                                        <option value="{{ $id }}" {{ old('branch_id') == $id ? 'selected' : '' }}>
                                            {{ $id }} - {{ $name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <div>
                                <x-label for="fiscal_year" value="Fiscal Year" :required="true" />
                                <select name="fiscal_year" id="fiscal_year" class="select2 mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Select Fiscal Year</option>
                                    @for ($year = 2025; $year <= 2099; $year++)
                                        <option value="{{ $year }}" {{ old('fiscal_year', 2025) == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>


                            <div>
                                <x-label for="annual_target_amount" value="Annual Target Amount" :required="true" />
                                <x-input id="annual_target_amount" type="number" step="0.001" name="annual_target_amount" class="mt-1 block w-full" :value="old('annual_target_amount')" required />
                            </div>

                            <div>
                                <x-label for="target_start_date" value="Target Start Date" :required="true" />
                                <x-input id="target_start_date" type="date" name="target_start_date" class="mt-1 block w-full" :value="old('target_start_date')" required />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                Create Target
                            </x-button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
