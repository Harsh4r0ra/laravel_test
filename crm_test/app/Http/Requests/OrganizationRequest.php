<?php
// app/Http/Requests/OrganizationRequest.php
namespace App\Http\Requests;

class OrganizationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'organizationId' => 'sometimes|integer',
            'organizationName' => 'sometimes|string|max:50',
            'name' => 'required|string|max:50',
            'annualRevenue' => 'nullable|numeric',
            'estdDate' => 'nullable|date',
            'legalStructure' => 'nullable|string|max:30',
            'typeOfBusiness' => 'nullable|string|max:30',
            'occupation' => 'nullable|string|max:50',
            'employeeCount' => 'nullable|integer',
            'description' => 'nullable|string'
        ];
    }
}
