<?php
// app/Services/ContactService.php

namespace App\Services;

use App\Models\Contact;
use App\Models\Email;
use App\Models\Phone;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class ContactService
{
    public function getContactById($contactId)
    {
        return Contact::with([
            'phones',
            'emails',
            'organization',
            'organization.contacts' => function ($query) {
                $query->where('is_primary_contact', true);
            }
        ])->findOrFail($contactId);
    }

    public function searchContacts($searchTerm)
    {
        return Contact::with([
            'phones',
            'emails',
            'organization',
            'organization.contacts' => function ($query) {
                $query->where('is_primary_contact', true);
            }
        ])
        ->where(function (Builder $query) use ($searchTerm) {
            $query->where('first_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('last_name', 'LIKE', "%{$searchTerm}%");
        })
        ->active()
        ->get();
    }

    public function createContact($data)
    {
        DB::beginTransaction();
        try {
            // Create contact
            $contact = Contact::create([
                'first_name' => $data['firstName'],
                'last_name' => $data['lastName'],
                'source' => $data['source'] ?? null,
                'occupation' => $data['occupation'] ?? null,
                'dob' => $data['dob'] ?? null,
                'gender' => $data['gender'] ?? null,
                'description' => $data['description'] ?? null,
                'organization_id' => $data['organizationId'] ?? null,
                'company_id' => request()->header('Company-Id'),
                'created_by' => auth()->id(),
                'modified_by' => auth()->id(),
                'created_at' => now(),
                'modified_at' => now()
            ]);

            // Handle emails
            if (!empty($data['emails'])) {
                foreach ($data['emails'] as $emailData) {
                    $email = Email::firstOrCreate(
                        ['email' => $emailData['email']],
                        [
                            'company_id' => request()->header('Company-Id'),
                            'created_by' => auth()->id(),
                            'modified_by' => auth()->id(),
                            'created_at' => now(),
                            'modified_at' => now()
                        ]
                    );

                    $contact->emails()->attach($email->email_id, [
                        'contact_email_type' => $emailData['type'] ?? null,
                        'is_primary_email' => $emailData['isPrimary'] ?? false,
                        'company_id' => request()->header('Company-Id'),
                        'created_by' => auth()->id(),
                        'modified_by' => auth()->id(),
                        'created_at' => now(),
                        'modified_at' => now()
                    ]);
                }
            }

            // Handle phones
            if (!empty($data['phones'])) {
                foreach ($data['phones'] as $phoneData) {
                    $phone = Phone::create([
                        'country_code' => $phoneData['countryCode'] ?? null,
                        'std_code' => $phoneData['stdCode'] ?? null,
                        'phone_no' => $phoneData['phoneNo'],
                        'company_id' => request()->header('Company-Id'),
                        'created_by' => auth()->id(),
                        'modified_by' => auth()->id(),
                        'created_at' => now(),
                        'modified_at' => now()
                    ]);

                    $contact->phones()->attach($phone->phone_id, [
                        'contact_phone_type' => $phoneData['type'] ?? 'Mobile',
                        'is_primary_phone' => $phoneData['isPrimary'] ?? false,
                        'company_id' => request()->header('Company-Id'),
                        'created_by' => auth()->id(),
                        'modified_by' => auth()->id(),
                        'created_at' => now(),
                        'modified_at' => now()
                    ]);
                }
            }

            DB::commit();
            return $contact->fresh(['phones', 'emails', 'organization']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}