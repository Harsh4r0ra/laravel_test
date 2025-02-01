<?php

// database/seeders/PhoneSeeder.php
namespace Database\Seeders;

use App\Models\Phone;
use App\Models\ContactPhone;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    public function run()
    {
        $phone = Phone::create([
            'country_code' => '+1',
            'phone_no' => '1234567890',
            'company_id' => 1,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);

        ContactPhone::create([
            'contact_id' => 1,
            'phone_id' => $phone->phone_id,
            'contact_phone_type' => 'Mobile',
            'is_primary_phone' => true,
            'company_id' => 1,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);
    }
}