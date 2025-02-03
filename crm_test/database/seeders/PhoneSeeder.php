<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('phone')->insert([
            'country_code' => '+1',
            'std_code' => '123',
            'phone_no' => '1234567890',
            'company_id' => 1,
            'created_by' => 1,
            'modified_by' => 1, // This is now nullable
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'modified_at' => Carbon::now(), // Fix: Ensure modified_at is set
        ]);
    }
}
