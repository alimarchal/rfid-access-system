<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($familyMember) ? __('Edit Family Member') : __('Add Family Member') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST"
                      action="{{ isset($familyMember)
                        ? route('family-members.update', $familyMember)
                        : route('users.family-members.store', $user) }}">
                    @csrf
                    @if(isset($familyMember)) @method('PUT') @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-label for="name" :value="__('Name')" />
                            <x-input id="name" class="block mt-1 w-full"
                                     type="text" name="name"
                                     :value="old('name', $familyMember->name ?? '')" required />
                        </div>

                        <div>
                            <x-label for="relationship" :value="__('Relationship')" />
                            <select id="relationship" name="relationship"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm">
                                @foreach(['wife', 'son', 'daughter', 'other'] as $relation)
                                    <option value="{{ $relation }}"
                                        {{ old('relationship', $familyMember->relationship ?? '') == $relation ? 'selected' : '' }}>
                                        {{ ucfirst($relation) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-label for="cnic" :value="__('CNIC')" />
                            <x-input id="cnic" class="block mt-1 w-full"
                                     type="text" name="cnic"
                                     :value="old('cnic', $familyMember->cnic ?? '')"
                                     placeholder="XXXXX-XXXXXXX-X" />
                        </div>

                        <div>
                            <x-label for="date_of_birth" :value="__('Date of Birth')" />
                            <x-input id="date_of_birth" class="block mt-1 w-full"
                                     type="date" name="date_of_birth"
                                     :value="old('date_of_birth', $familyMember->date_of_birth ?? '')" />
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-button type="submit">
                            {{ isset($familyMember) ? __('Update') : __('Create') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
