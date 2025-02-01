<?php

// database/seeders/ContactSeeder.php
namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run()
    {
        Contact::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'source' => 'Direct',
            'occupation' => 'Manager',
            'gender' => 'Male',
            'company_id' => 1,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);
    }
}
