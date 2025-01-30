<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'location_id' => ['nullable', 'exists:locations,id'],
            'name' => ['required', 'string', 'max:255'],
            'father_name' => ['nullable', 'string', 'max:100'],
            'cnic' => ['nullable', 'string', 'max:15', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults(), 'confirmed'],
            'mobile' => ['nullable', 'string', 'max:15'],
            'telephone' => ['nullable', 'string', 'max:15', 'regex:/^[0-9\-\+\(\)\s]*$/'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('telephone')) {
            $this->merge([
                'telephone' => substr(preg_replace('/[^0-9\-\+\(\)\s]/', '', $this->telephone), 0, 15)
            ]);
        }
    }
}