<?php

namespace Database\Factories;

use App\Models\Phone;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    protected $model = Phone::class;

    public function definition()
    {
        return [
            'company_id' => Company::factory(),
            'country_code' => '+' . $this->faker->numberBetween(1, 99),
            'std_code' => $this->faker->numberBetween(100, 999),
            'phone_no' => $this->faker->numerify('##########'),
            'created_by' => 1,
            'created_at' => now(),
            'modified_by' => 1,
            'modified_at' => now()
        ];
    }
}