<?php

// tests/Unit/Services/OrganizationServiceTest.php
namespace Tests\Unit\Services;

class OrganizationServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $organizationService;

    public function setUp(): void
    {
        parent::setUp();
        $this->organizationService = app(OrganizationService::class);
    }

    public function test_can_search_organizations()
    {
        Organization::factory()->create([
            'name' => 'Test Company'
        ]);

        $results = $this->organizationService->searchOrganizations('Test');
        
        $this->assertCount(1, $results);
        $this->assertEquals('Test Company', $results->first()->name);
    }
}