<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRfidCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Add your authorization logic here
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'card_number' => 'required|string|max:20|unique:rfid_cards,card_number,' . $this->rfid_card->id,
            'status' => 'required|in:active,inactive,expired',
            'expiry_date' => 'required|date|after:today',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'Please select a user.',
            'user_id.exists' => 'The selected user is invalid.',
            'card_number.required' => 'Please enter a card number.',
            'card_number.unique' => 'This card number is already in use.',
            'expiry_date.after' => 'The expiry date must be a future date.',
        ];
    }
}
