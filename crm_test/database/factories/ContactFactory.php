<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Company;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'source' => $this->faker->randomElement(['Web', 'Referral', 'Direct']),
            'occupation' => $this->faker->jobTitle(),
            'dob' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'description' => $this->faker->text(),
            'organization_id' => Organization::factory(),
            'company_id' => Company::factory(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}