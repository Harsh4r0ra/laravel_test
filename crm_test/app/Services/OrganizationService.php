<?php

namespace App\Services;

use App\Models\Organization;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrganizationService
{
    public function getOrganizationById($organizationId)
    {
        $organization = Organization::with([
            'contacts' => function($query) {
                $query->with(['phones', 'emails']);
            }
        ])
        ->where('organization_id', $organizationId)
        ->where('company_id', request()->header('Company-Id'))
        ->first();

        if (!$organization) {
            throw new ModelNotFoundException('Organization not found');
        }

        return $this->attachPrimaryContactInfo($organization);
    }

    public function searchOrganizations($searchTerm)
    {
        $organizations = Organization::with([
            'contacts' => function($query) {
                $query->with(['phones', 'emails']);
            }
        ])
        ->where('company_id', request()->header('Company-Id'))
        ->where('name', 'like', "%{$searchTerm}%") // Changed from ILIKE to like for SQLite compatibility
        ->get()
        ->map(function ($organization) {
            return $this->attachPrimaryContactInfo($organization);
        });

        if ($organizations->isEmpty()) {
            throw new ModelNotFoundException('No organizations found');
        }

        return $organizations;
    }

    private function attachPrimaryContactInfo($organization)
    {
        $primaryContact = $organization->contacts()
            ->wherePivot('is_primary_contact', true)
            ->first();

        if ($primaryContact) {
            $primaryPhone = $primaryContact->phones()
                ->wherePivot('is_primary_phone', true)
                ->first();
            $primaryEmail = $primaryContact->emails()
                ->wherePivot('is_primary_email', true)
                ->first();

            $organization->primaryContact = $primaryContact->contact_id;
            $organization->primaryFirstName = $primaryContact->first_name;
            $organization->primaryLastName = $primaryContact->last_name;
            $organization->primaryEmail = $primaryEmail?->email ?? '';
            $organization->primaryEmailId = $primaryEmail?->email_id ?? 0;
            $organization->primaryPhone = $primaryPhone ? "{$primaryPhone->country_code} {$primaryPhone->phone_no}" : '';
            $organization->primaryPhoneId = $primaryPhone?->phone_id ?? 0;
        }

        return $organization;
    }
}