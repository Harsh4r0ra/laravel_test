<?php
// database/seeders/CompanySeeder.php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    public function run()
    {
        DB::table('company')->insert([
            [
                'company_id' => 1,
                'company_name' => 'Default Company',
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => now(),
                'modified_at' => now(),
                'is_deleted' => false
            ],
            [
                'company_id' => 2,
                'company_name' => 'Test Company',
                'created_by' => 1,
                'modified_by' => 1,
                'created_at' => now(),
                'modified_at' => now(),
                'is_deleted' => false
            ]
        ]);

        // Create additional test companies
        Company::factory()->count(3)->create();
    }
}