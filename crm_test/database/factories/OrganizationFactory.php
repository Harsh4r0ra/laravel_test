<?php

// database/factories/OrganizationFactory.php
namespace Database\Factories;

use App\Models\Organization;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'annual_revenue' => $this->faker->randomFloat(2, 10000, 1000000),
            'estd_date' => $this->faker->date(),
            'legal_structure' => $this->faker->randomElement(['Corporation', 'LLC', 'Partnership']),
            'type_of_business' => $this->faker->randomElement(['Retail', 'Manufacturing', 'Service']),
            'occupation' => $this->faker->jobTitle,
            'employee_count' => $this->faker->numberBetween(5, 1000),
            'description' => $this->faker->text(),
            'company_id' => Company::factory(),
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ];
    }
}