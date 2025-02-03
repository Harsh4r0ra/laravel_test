<?php
// tests/Unit/Models/CompanyTest.php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Company;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_has_users()
    {
        $company = Company::factory()
            ->has(User::factory()->count(3))
            ->create();

        $this->assertCount(3, $company->users);
    }

    public function test_company_soft_deletes()
    {
        $company = Company::factory()->create();
        $company->delete();

        $this->assertTrue($company->is_deleted);
        $this->assertDatabaseHas('company', [
            'company_id' => $company->company_id,
            'is_deleted' => true
        ]);
    }
}