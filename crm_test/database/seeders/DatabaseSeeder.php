<?php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CompanySeeder::class,
            UserSeeder::class,
            ContactSeeder::class,
            OrganizationSeeder::class,
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
    public function run()
    {
        Company::create([
            'company_name' => 'Default Company',
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);
    }
}

// Additional seeders follow same pattern...