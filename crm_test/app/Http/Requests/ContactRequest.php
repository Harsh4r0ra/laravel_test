<?php
// app/Http/Requests/ContactRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'contactId' => 'sometimes|integer',
            'contactName' => 'sometimes|string|max:255',
            'firstName' => 'required|string|max:16',
            'lastName' => 'nullable|string|max:16',
            'source' => 'nullable|string|max:32',
            'occupation' => 'nullable|string|max:32',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:16',
            'description' => 'nullable|string',
            'organizationId' => 'nullable|integer|exists:organization,organization_id'
        ];
    }
}