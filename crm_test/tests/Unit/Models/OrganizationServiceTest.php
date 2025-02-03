<?php

// tests/Unit/Models/OrganizationServiceTest.php
namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Organization;
use App\Services\OrganizationService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrganizationServiceTest extends TestCase
{
    use RefreshDatabase;

    private OrganizationService $organizationService;

    public function setUp(): void
    {
        parent::setUp();
        $this->organizationService = new OrganizationService();
    }

    public function test_can_search_organizations_by_name()
    {
        Organization::factory()->create([
            'name' => 'Test Corp'
        ]);

        $results = $this->organizationService->searchOrganizations('Test');
        
        $this->assertCount(1, $results);
        $this->assertEquals('Test Corp', $results->first()->name);
    }
}