<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFamilyMemberRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'relationship' => 'required|in:wife,husband,son,daughter,father,mother,other',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'cnic' => 'nullable|string|max:15|unique:family_members,cnic',
        ];
    }
}