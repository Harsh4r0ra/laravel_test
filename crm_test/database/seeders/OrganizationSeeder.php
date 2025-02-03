<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default organization
        Organization::create([
            'name' => 'Default Organization',
            'annual_revenue' => 1000000.00,
            'estd_date' => now(),
            'legal_structure' => 'Corporation',
            'type_of_business' => 'Technology',
            'occupation' => 'IT Services',
            'employee_count' => 100,
            'description' => 'Default organization for testing',
            'company_id' => 1,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);

        // Create additional test organizations
        Organization::create([
            'name' => 'Test Organization',
            'annual_revenue' => 500000.00,
            'estd_date' => now(),
            'legal_structure' => 'LLC',
            'type_of_business' => 'Retail',
            'occupation' => 'Retail Services',
            'employee_count' => 50,
            'description' => 'Test organization',
            'company_id' => 1,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);
    }
}