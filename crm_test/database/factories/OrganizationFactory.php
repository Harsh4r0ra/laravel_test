<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'annual_revenue' => fake()->randomFloat(2, 10000, 1000000),
            'estd_date' => fake()->date(),
            'legal_structure' => fake()->randomElement(['Corporation', 'LLC', 'Partnership']),
            'type_of_business' => fake()->randomElement(['Retail', 'Manufacturing', 'Service']),
            'occupation' => fake()->jobTitle(),
            'employee_count' => fake()->numberBetween(5, 1000),
            'description' => fake()->text(),
            'company_id' => Company::factory(),
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ];
    }
}