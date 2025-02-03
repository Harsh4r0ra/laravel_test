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

// database/seeders/CompanySeeder.php
namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::create([
            'company_name' => 'Default Company',
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now(),
            'is_deleted' => false
        ]);

        // Create some additional test companies
        Company::factory()->count(2)->create();
    }
}

// database/seeders/UserSeeder.php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'company_id' => 1,
            'email_id' => 'admin@example.com',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'mobile_number' => '1234567890',
            'user_name' => 'admin',
            'password' => Hash::make('password'),
            'zone_id' => 1,
            'visibility_group_id' => 1,
            'userset_id' => 1,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);

        // Create additional test users
        User::factory()->count(5)->create();
    }
}