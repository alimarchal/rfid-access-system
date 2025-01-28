@if ($errors->any())
    <div class="mb-4 bg-red-50 border border-red-200 text-red-800 rounded-md p-4">
        <div class="font-medium">Please correct the following errors:</div>
        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
