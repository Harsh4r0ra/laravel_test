<?php

// tests/Unit/Models/CompanyTest.php
namespace Tests\Unit\Models;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_has_users()
    {
        $company = Company::factory()
            ->hasUsers(3)
            ->create();

        $this->assertEquals(3, $company->users->count());
    }

    public function test_company_has_contacts()
    {
        $company = Company::factory()
            ->hasContacts(3)
            ->create();

        $this->assertEquals(3, $company->contacts->count());
    }
}