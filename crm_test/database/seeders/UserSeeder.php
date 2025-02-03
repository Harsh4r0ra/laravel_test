<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
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
            'modified_at' => now(),
            'is_active' => true
        ]);

        // Create additional users manually for now
        User::create([
            'company_id' => 1,
            'email_id' => 'user1@example.com',
            'first_name' => 'Test',
            'last_name' => 'User',
            'mobile_number' => '1234567891',
            'user_name' => 'testuser',
            'password' => Hash::make('password'),
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