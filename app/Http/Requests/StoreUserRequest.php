<?php

namespace App\Http\Requests;

class StoreUserRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:100',
            'cnic' => 'required|regex:/^[0-9]{5}-[0-9]{7}-[0-9]$/|unique:users',
            'email' => 'required|email|unique:users',
            'mobile' => 'nullable|regex:/^\+92[0-9]{10}$/',
            'location_id' => 'nullable|exists:locations,id',
            'profile_photo' => 'nullable|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'cnic.regex' => 'CNIC must be in the format XXXXX-XXXXXXX-X',
            'mobile.regex' => 'Mobile must be in format +92XXXXXXXXXX',
        ];
    }
}
