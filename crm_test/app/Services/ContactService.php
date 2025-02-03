<?php
// app/Services/ContactService.php

namespace App\Services;

use App\Models\Contact;
use App\Models\Email;
use App\Models\Phone;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContactService
{
    public function getContactById($contactId)
    {
        $contact = Contact::with([
            'phones',
            'emails',
            'organizations' => function($query) {
                $query->withPivot('is_primary_contact');
            }
        ])
        ->where('company_id', request()->header('Company-Id'))
        ->find($contactId);

        if (!$contact) {
            throw new ModelNotFoundException('Contact not found');
        }

        return $contact;
    }

    public function searchContacts($searchTerm)
    {
        return Contact::with([
            'phones',
            'emails',
            'organizations' => function($query) {
                $query->withPivot('is_primary_contact');
            }
        ])
        ->where('company_id', request()->header('Company-Id'))
        ->where(function ($query) use ($searchTerm) {
            $query->where('first_name', 'like', "%{$searchTerm}%")
                  ->orWhere('last_name', 'like', "%{$searchTerm}%");
        })
        ->get();
    }

    public function createContact($data)
    {
        return DB::transaction(function () use ($data) {
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
                'modified_by' => auth()->id()
            ]);

            if (!empty($data['emails'])) {
                foreach ($data['emails'] as $emailData) {
                    $email = Email::firstOrCreate(
                        ['email' => $emailData['email']],
                        ['company_id' => request()->header('Company-Id')]
                    );

                    $contact->emails()->attach($email->email_id, [
                        'contact_email_type' => $emailData['type'] ?? null,
                        'is_primary_email' => $emailData['isPrimary'] ?? false,
                        'company_id' => request()->header('Company-Id')
                    ]);
                }
            }

            if (!empty($data['phones'])) {
                foreach ($data['phones'] as $phoneData) {
                    $phone = Phone::create([
                        'country_code' => $phoneData['countryCode'] ?? null,
                        'std_code' => (string)($phoneData['stdCode'] ?? ''), // Ensure string type
                        'phone_no' => $phoneData['phoneNo']
                    ]);

                    $contact->phones()->attach($phone->phone_id, [
                        'contact_phone_type' => $phoneData['type'] ?? 'Mobile',
                        'is_primary_phone' => $phoneData['isPrimary'] ?? false,
                        'company_id' => request()->header('Company-Id')
                    ]);
                }
            }

            return $contact->fresh(['phones', 'emails', 'organizations']);
        });
    }
}