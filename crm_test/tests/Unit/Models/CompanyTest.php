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
        $company = Company::factory()->create();
        User::factory()->count(3)->create(['company_id' => $company->company_id]);

        $this->assertEquals(3, $company->users->count());
    }

    public function test_company_has_contacts()
    {
        $company = Company::factory()->create();
        Contact::factory()->count(3)->create(['company_id' => $company->company_id]);

        $this->assertEquals(3, $company->contacts->count());
    }
}