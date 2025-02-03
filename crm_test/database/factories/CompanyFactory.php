<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'is_deleted' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}