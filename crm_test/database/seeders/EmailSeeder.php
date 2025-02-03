<?php

// database/seeders/EmailSeeder.php
namespace Database\Seeders;

use App\Models\Email;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    public function run(): void
    {
        Email::factory()->count(20)->create();
    }
}