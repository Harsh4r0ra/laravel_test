<?php

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
           EmailSeeder::class,
           PhoneSeeder::class,
           ContactSeeder::class,
       ]);
   }
}

class CompanySeeder extends Seeder
{
   public function run(): void
   {
       \App\Models\Company::create([
           'name' => 'Default Company',
       ]);
   }
}

class UserSeeder extends Seeder 
{
   public function run(): void
   {
       \App\Models\User::create([
           'company_id' => 1,
           'email_id' => 'admin@example.com',
           'first_name' => 'Admin',
           'last_name' => 'User',
           'mobile_number' => '1234567890',
           'user_name' => 'admin',
           'password' => \Hash::make('password'),
           'zone_id' => 1,
           'visibility_group_id' => 1,
           'userset_id' => 1,
           'created_by' => 1,
           'modified_by' => 1,
           'created_at' => now(),
           'modified_at' => now(),
           'is_active' => true
       ]);
   }
}