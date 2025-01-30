<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight inline-block">
            Add Family Member
        </h2>
        <div class="float-right">
            <a href="{{ route('family-members.index') }}"
                class="bg-blue-900 text-white px-4 py-2 rounded-md hover:bg-blue-800">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('family-members.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- User Selection -->
                            <div>
                                <x-label for="user_id" value="User" :required="true" />
                                <select id="user_id" name="user_id"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">

                                    @if (request()->routeIs('family-members.create'))
                                        <option value="">Select a user</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <!-- Name -->
                            <div>
                                <x-label for="name" value="Name" :required="true" />
                                <x-input id="name" type="text" name="name" class="w-full" required />
                            </div>

                            <!-- Relationship -->
                            <div>
                                <x-label for="relationship" value="Relationship" :required="true" />
                                <select id="relationship" name="relationship"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                    <option value="wife">Wife</option>
                                    <option value="husband">Husband</option>
                                    <option value="son">Son</option>
                                    <option value="daughter">Daughter</option>
                                    <option value="father">Father</option>
                                    <option value="mother">Mother</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Gender -->
                            <div>
                                <x-label for="gender" value="Gender" :required="true" />
                                <select id="gender" name="gender"
                                    class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- CNIC -->
                            <div>
                                <x-label for="cnic" value="CNIC" />
                                <x-input id="cnic" type="text" name="cnic" class="w-full" maxlength="15" />
                            </div>

                            <!-- Date of Birth -->
                            <div>
                                <x-label for="date_of_birth" value="Date of Birth" />
                                <x-input id="date_of_birth" type="date" name="date_of_birth" class="w-full" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-button>Create Family Member</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
