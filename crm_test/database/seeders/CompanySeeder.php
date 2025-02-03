<?php
// database/seeders/CompanySeeder.php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
        Company::create([
            'name' => 'Default Company',
            'is_deleted' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}