<?php
// database/seeders/CompanySeeder.php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
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

        // Create additional test companies
        Company::factory()->count(3)->create();
    }
}