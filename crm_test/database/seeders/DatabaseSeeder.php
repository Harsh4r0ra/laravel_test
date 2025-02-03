<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CompanySeeder::class,
            UserSeeder::class,
            OrganizationSeeder::class,
            ContactSeeder::class,
            EmailSeeder::class,
            PhoneSeeder::class,
        ]);
    }
}