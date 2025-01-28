<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRfidCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'card_number' => ['required', 'string', 'max:20', 'unique:rfid_cards,card_number'],
            'status' => ['required', 'in:active,inactive,expired'],
            'expiry_date' => ['required', 'date', 'after:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Please select a user.',
            'user_id.exists' => 'The selected user is invalid.',
            'card_number.required' => 'Please enter a card number.',
            'card_number.unique' => 'This card number is already in use.',
            'status.required' => 'Please select a status.',
            'status.in' => 'The selected status is invalid.',
            'expiry_date.required' => 'Please select an expiry date.',
            'expiry_date.after' => 'The expiry date must be a future date.',
        ];
    }
}
