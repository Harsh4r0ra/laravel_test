<?php
// database/factories/CompanyFactory.php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'company_name' => fake()->company(),
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now(),
            'is_deleted' => false
        ];
    }
}

// database/factories/UserFactory.php
namespace Database\Factories;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'email_id' => fake()->unique()->safeEmail(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'mobile_number' => fake()->unique()->phoneNumber(),
            'user_name' => fake()->userName(),
            'password' => Hash::make('password'),
            'zone_id' => fake()->numberBetween(1, 5),
            'visibility_group_id' => fake()->numberBetween(1, 3),
            'userset_id' => fake()->numberBetween(1, 3),
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ];
    }
}

// database/factories/ContactFactory.php
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
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'source' => fake()->randomElement(['Web', 'Referral', 'Direct']),
            'occupation' => fake()->jobTitle(),
            'dob' => fake()->date(),
            'gender' => fake()->randomElement(['Male', 'Female', 'Other']),
            'description' => fake()->text(),
            'organization_id' => Organization::factory(),
            'company_id' => Company::factory(),
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ];
    }
}

// Additional factories following same pattern...