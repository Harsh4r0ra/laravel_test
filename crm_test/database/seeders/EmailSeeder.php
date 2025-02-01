<?php

// database/seeders/EmailSeeder.php
namespace Database\Seeders;

use App\Models\Email;
use App\Models\ContactEmail;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    public function run()
    {
        $email = Email::create([
            'email' => 'john.doe@example.com',
            'company_id' => 1,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);

        ContactEmail::create([
            'contact_id' => 1,
            'email_id' => $email->email_id,
            'contact_email_type' => 'Work',
            'is_primary_email' => true,
            'company_id' => 1,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);
    }
}