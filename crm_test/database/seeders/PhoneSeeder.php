<?php

// database/seeders/PhoneSeeder.php
namespace Database\Seeders;

use App\Models\Phone;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{
    public function run(): void
    {
        Phone::factory()->count(20)->create();
    }
}