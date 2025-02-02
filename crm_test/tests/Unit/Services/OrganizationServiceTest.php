<?php
// tests/Unit/Services/OrganizationServiceTest.php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Organization;
use App\Models\Company;
use App\Services\OrganizationService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrganizationServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $organizationService;
    protected $company;

    public function setUp(): void
    {
        parent::setUp();
        $this->organizationService = app(OrganizationService::class);
        $this->company = Company::factory()->create();
    }

    public function test_can_search_organizations()
    {
        Organization::factory()->create([
            'name' => 'Test Company',
            'company_id' => $this->company->company_id
        ]);

        $results = $this->organizationService->searchOrganizations('Test');
        
        $this->assertCount(1, $results);
        $this->assertEquals('Test Company', $results->first()->name);
    }

    public function test_can_get_organization_by_id()
    {
        $organization = Organization::factory()->create([
            'company_id' => $this->company->company_id
        ]);

        $result = $this->organizationService->getOrganizationById($organization->organization_id);
        
        $this->assertEquals($organization->organization_id, $result->organization_id);
    }
}