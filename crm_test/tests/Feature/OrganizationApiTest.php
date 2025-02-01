<?php

// tests/Feature/OrganizationApiTest.php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Organization;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class OrganizationApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $company;

    public function setUp(): void
    {
        parent::setUp();
        
        // Create a test company
        $this->company = Company::factory()->create();
    }

    public function test_can_get_organization_by_id()
    {
        // Create a test organization
        $organization = Organization::factory()->create([
            'company_id' => $this->company->company_id
        ]);

        $response = $this->postJson('/api/organization/view', [
            'organizationId' => $organization->organization_id
        ], [
            'Company-Id' => $this->company->company_id
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'message' => 'Organizations retrieved successfully',
                    'statusCode' => '200'
                ]);

        $responseData = json_decode($response->json('data'), true);
        $this->assertEquals($organization->organization_id, $responseData['organization_id']);
    }

    public function test_can_search_organizations_by_name()
    {
        // Create test organizations
        $org1 = Organization::factory()->create([
            'name' => 'Test Company One',
            'company_id' => $this->company->company_id
        ]);

        $org2 = Organization::factory()->create([
            'name' => 'Test Company Two',
            'company_id' => $this->company->company_id
        ]);

        $response = $this->postJson('/api/organization/view', [
            'organizationName' => 'Test Company'
        ], [
            'Company-Id' => $this->company->company_id
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'message' => 'Organizations retrieved successfully',
                    'statusCode' => '200'
                ]);

        $responseData = json_decode($response->json('data'), true);
        $this->assertCount(2, $responseData);
    }
}