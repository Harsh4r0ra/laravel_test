<?php

// database/seeders/OrganizationSeeder.php
namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Contact;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        Organization::factory()
            ->count(5)
            ->has(Contact::factory()->count(3))
            ->create();
    }
}