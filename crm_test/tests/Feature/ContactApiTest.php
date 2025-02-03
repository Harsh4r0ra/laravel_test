<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Contact;
use App\Models\Company;
use App\Models\Email;
use App\Models\Phone;
use App\Models\Organization;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ContactApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $company;

    /**
     * Set up test environment
     */
    public function setUp(): void
    {
        parent::setUp();

        // Run migrations & seed database before each test
        $this->artisan('migrate:fresh --seed');

        // Create a company to associate contacts with
        $this->company = Company::factory()->create();
    }

    /**
     * Test fetching a contact by ID
     */
    public function test_can_get_contact_by_id()
    {
        // Create related data
        $phone = Phone::factory()->create([
            'country_code' => '+91',
            'std_code' => '44',
            'phone_no' => '7894561230'
        ]);

        $email = Email::factory()->create([
            'email' => 'testing45@mindzen.com'
        ]);

        $organization = Organization::factory()->create([
            'name' => 'test122',
            'annual_revenue' => '1 Lakh to 10 Lakhs',
            'legal_structure' => 'Corporate',
            'type_of_business' => 'Retailer',
            'employee_count' => 103,
            'company_id' => $this->company->id
        ]);

        // Create main contact
        $contact = Contact::factory()->create([
            'first_name' => 'testing45',
            'last_name' => 'N',
            'company_id' => $this->company->id
        ]);

        // Attach relationships
        $contact->phones()->attach($phone->id, ['contact_phone_type' => 'Mobile']);
        $contact->emails()->attach($email->id);
        $contact->organizations()->attach($organization->id, ['is_primary_contact' => true]);

        // API Call
        $response = $this->postJson('/api/contact/view', [
            'contactId' => $contact->id
        ], [
            'Company-Id' => $this->company->id
        ]);

        // Debugging Response
        $response->dump();

        // Assertions
        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Contacts retrieved successfully',
                     'statusCode' => '200'
                 ]);

        $responseData = $response->json('data');
        
        // Validate response structure
        $this->assertEquals($contact->id, $responseData['contactId']);
        $this->assertEquals('testing45', $responseData['firstName']);
        $this->assertEquals('N', $responseData['lastName']);

        // Validate phone structure
        $this->assertArrayHasKey('phones', $responseData);
        $this->assertCount(1, $responseData['phones']);
        $this->assertEquals('+91', $responseData['phones'][0]['countryCode']);
        $this->assertEquals('44', $responseData['phones'][0]['stdCode']);
        $this->assertEquals('7894561230', $responseData['phones'][0]['phoneNo']);

        // Validate email structure
        $this->assertArrayHasKey('emails', $responseData);
        $this->assertCount(1, $responseData['emails']);
        $this->assertEquals('testing45@mindzen.com', $responseData['emails'][0]['email']);

        // Validate organization structure
        $this->assertArrayHasKey('organizations', $responseData);
        $this->assertCount(1, $responseData['organizations']);
        $this->assertEquals('test122', $responseData['organizations'][0]['name']);
        $this->assertEquals('1 Lakh to 10 Lakhs', $responseData['organizations'][0]['annualRevenue']);
    }

    /**
     * Test searching contacts by name
     */
    public function test_can_search_contacts_by_name()
    {
        // Create multiple contacts
        for ($i = 0; $i < 3; $i++) {
            $contact = Contact::factory()->create([
                'first_name' => "testing{$i}",
                'last_name' => 'N',
                'company_id' => $this->company->id
            ]);

            $phone = Phone::factory()->create([
                'country_code' => '+91',
                'phone_no' => '7894561230'
            ]);

            $email = Email::factory()->create([
                'email' => "testing{$i}@mindzen.com"
            ]);

            $contact->phones()->attach($phone->id, ['contact_phone_type' => 'Mobile']);
            $contact->emails()->attach($email->id);
        }

        // API Call
        $response = $this->postJson('/api/contact/view', [
            'contactName' => 'testing'
        ], [
            'Company-Id' => $this->company->id
        ]);

        // Debugging Response
        $response->dump();

        // Assertions
        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Contacts retrieved successfully',
                     'statusCode' => '200'
                 ]);

        $responseData = $response->json('data');

        $this->assertIsArray($responseData);
        $this->assertCount(3, $responseData);
    }

    /**
     * Test missing Company-Id header
     */
    public function test_requires_company_id_header()
    {
        $response = $this->postJson('/api/contact/view', [
            'contactName' => 'John'
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test response when searching for a non-existent contact
     */
    public function test_returns_empty_result_for_non_existent_contact()
    {
        $response = $this->postJson('/api/contact/view', [
            'contactId' => 99999
        ], [
            'Company-Id' => $this->company->id
        ]);

        $response->assertStatus(404)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Contact not found'
                 ]);
    }

    /**
     * Test invalid search input handling
     */
    public function test_handles_invalid_search_input()
    {
        $response = $this->postJson('/api/contact/view', [
            'contactName' => ''
        ], [
            'Company-Id' => $this->company->id
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['contactName']);
    }
}
