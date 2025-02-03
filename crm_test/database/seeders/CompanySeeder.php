<?php
// database/seeders/CompanySeeder.php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default company
        Company::create([
            'company_name' => 'Default Company',
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now(),
            'is_deleted' => false
        ]);

        // Create additional companies manually first
        Company::create([
            'company_name' => 'Test Company 1',
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now(),
            'is_deleted' => false
        ]);

        Company::create([
            'company_name' => 'Test Company 2',
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now(),
            'is_deleted' => false
        ]);
    }
}