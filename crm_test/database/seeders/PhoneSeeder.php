<?php

namespace Database\Seeders;

use App\Models\Phone;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    public function run(): void
    {
        // Create a default phone
        Phone::create([
            'country_code' => '+1',
            'std_code' => '123',
            'phone_no' => '1234567890',
            'company_id' => 1,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);

        // Create additional test phone
        Phone::create([
            'country_code' => '+1',
            'std_code' => '456',
            'phone_no' => '9876543210',
            'company_id' => 1,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);
    }
}