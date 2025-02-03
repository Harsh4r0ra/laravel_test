<?php
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