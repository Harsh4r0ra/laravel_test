<?php

// tests/Feature/OrganizationApiTest.php
namespace Tests\Feature;

class OrganizationApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $company;

    public function setUp(): void
    {
        parent::setUp();
        $this->company = Company::factory()->create();
    }

    public function test_can_get_organization_by_id()
    {
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
                    'message' => 'Organizations retrieved successfully'
                ]);
    }

    public function test_can_search_organizations_by_name()
    {
        Organization::factory()->create([
            'name' => 'Test Corp',
            'company_id' => $this->company->company_id
        ]);

        $response = $this->postJson('/api/organization/view', [
            'organizationName' => 'Test'
        ], [
            'Company-Id' => $this->company->company_id
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'data',
                    'message',
                    'statusCode'
                ]);
    }
}