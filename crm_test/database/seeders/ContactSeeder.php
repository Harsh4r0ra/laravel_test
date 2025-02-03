<?php

// database/seeders/ContactSeeder.php
namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Email;
use App\Models\Phone;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Contact::factory()
            ->count(10)
            ->has(Email::factory()->count(2))
            ->has(Phone::factory()->count(2))
            ->create();
    }
}