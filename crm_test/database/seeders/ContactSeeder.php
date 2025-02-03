<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Email;
use App\Models\Phone;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        // Create a default contact
        Contact::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'source' => 'Direct',
            'occupation' => 'Manager',
            'dob' => now(),
            'gender' => 'Male',
            'description' => 'Test contact',
            'organization_id' => 1,
            'company_id' => 1,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);

        // Create additional test contact
        Contact::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'source' => 'Web',
            'occupation' => 'Developer',
            'dob' => now(),
            'gender' => 'Female',
            'description' => 'Another test contact',
            'organization_id' => 1,
            'company_id' => 1,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);
    }
}