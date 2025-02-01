<?php

// database/seeders/OrganizationSeeder.php
namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run()
    {
        Organization::create([
            'name' => 'Test Organization',
            'annual_revenue' => 1000000.00,
            'legal_structure' => 'Corporation',
            'type_of_business' => 'Technology',
            'employee_count' => 100,
            'company_id' => 1,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);
    }
}