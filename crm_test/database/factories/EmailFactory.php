<?php
// database/factories/EmailFactory.php
namespace Database\Factories;

use App\Models\Email;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    protected $model = Email::class;

    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'company_id' => Company::factory(),
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ];
    }
}
