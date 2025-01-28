<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
            'cnic' => [
                'nullable',
                'string',
                'max:15',
                Rule::unique('users')->ignore($this->route('user')),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->route('user')),
            ],
            'password' => [
                'nullable',
                Password::defaults(),
                'confirmed',
            ],
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

    protected function passedValidation(): void
    {
        if (empty($this->input('password'))) {
            $this->request->remove('password');
        }
    }
}
