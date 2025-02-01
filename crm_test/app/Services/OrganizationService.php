<?php

namespace App\Services;

use App\Models\Organization;

class OrganizationService
{
    public function getOrganizationById($organizationId)
    {
        return Organization::with([
            'contacts',
            'contacts.phones',
            'contacts.emails'
        ])->findOrFail($organizationId);
    }

    public function searchOrganizations($searchTerm)
    {
        return Organization::with([
            'contacts',
            'contacts.phones',
            'contacts.emails'
        ])
        ->where('name', 'LIKE', "%{$searchTerm}%")
        ->get();
    }
}