<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Organization;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Phone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

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
        // Create a primary contact with phone and email
        $contact = Contact::factory()->create([
            'first_name' => 'Testing45',
            'last_name' => 'N',
            'company_id' => $this->company->company_id
        ]);

        $phone = Phone::factory()->create([
            'country_code' => '+91',
            'std_code' => '44',
            'phone_no' => '7894561230',
            'company_id' => $this->company->company_id
        ]);

        $email = Email::factory()->create([
            'email' => 'testing45@mindzen.com',
            'company_id' => $this->company->company_id
        ]);

        // Create organization with relationships
        $organization = Organization::factory()->create([
            'name' => 'Fire cracks',
            'annual_revenue' => '10 Lakhs to 20 Lakhs',
            'legal_structure' => 'Partnership',
            'type_of_business' => 'Retailer',
            'company_id' => $this->company->company_id
        ]);

        // Attach relationships
        $contact->phones()->attach($phone->phone_id, [
            'contact_phone_type' => 'Mobile',
            'is_primary_phone' => true,
            'company_id' => $this->company->company_id
        ]);
        
        $contact->emails()->attach($email->email_id, [
            'is_primary_email' => true,
            'company_id' => $this->company->company_id
        ]);

        $organization->contacts()->attach($contact->contact_id, [
            'is_primary_contact' => true,
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
        
        // Verify organization details
        $this->assertEquals($organization->organization_id, $responseData['organizationId']);
        $this->assertEquals('Fire cracks', $responseData['name']);
        $this->assertEquals('10 Lakhs to 20 Lakhs', $responseData['annualRevenue']);
        $this->assertEquals('Partnership', $responseData['legalStructure']);
        $this->assertEquals('Retailer', $responseData['typeOfBusiness']);

        // Verify primary contact details
        $this->assertEquals($contact->contact_id, $responseData['primaryContact']);
        $this->assertEquals('Testing45', $responseData['primaryFirstName']);
        $this->assertEquals('N', $responseData['primaryLastName']);
        $this->assertEquals('testing45@mindzen.com', $responseData['primaryEmail']);
    }

    public function test_can_search_organizations_by_name()
    {
        $organization = Organization::factory()->create([
            'name' => 'Mindblow',
            'annual_revenue' => '1 Lakh to 10 Lakhs',
            'legal_structure' => 'Corporate',
            'type_of_business' => 'Retailer',
            'employee_count' => 103,
            'company_id' => $this->company->company_id
        ]);

        $response = $this->postJson('/api/organization/view', [
            'organizationName' => 'Mind'
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
        $this->assertIsArray($responseData);
        
        // Verify first organization in search results
        $firstOrg = $responseData[0];
        $this->assertEquals($organization->organization_id, $firstOrg['organizationId']);
        $this->assertEquals('Mindblow', $firstOrg['name']);
        $this->assertEquals('1 Lakh to 10 Lakhs', $firstOrg['annualRevenue']);
        $this->assertEquals('Corporate', $firstOrg['legalStructure']);
        $this->assertEquals('Retailer', $firstOrg['typeOfBusiness']);
        $this->assertEquals(103, $firstOrg['employeeCount']);
    }

    public function test_requires_company_id_header()
    {
        $response = $this->postJson('/api/organization/view', [
            'organizationName' => 'Test'
        ]);

        $response->assertStatus(403);
    }

    public function test_returns_empty_result_for_non_existent_organization()
    {
        $response = $this->postJson('/api/organization/view', [
            'organizationId' => 99999
        ], [
            'Company-Id' => $this->company->company_id
        ]);

        $response->assertStatus(404)
                ->assertJson([
                    'success' => false,
                    'message' => 'Organization not found'
                ]);
    }
}