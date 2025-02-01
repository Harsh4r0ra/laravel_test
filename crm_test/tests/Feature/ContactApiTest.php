<?php
// tests/Feature/ContactApiTest.php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Contact;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ContactApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $company;

    public function setUp(): void
    {
        parent::setUp();
        
        // Create a test company
        $this->company = Company::factory()->create();
    }

    public function test_can_get_contact_by_id()
    {
        // Create a test contact
        $contact = Contact::factory()->create([
            'company_id' => $this->company->company_id
        ]);

        $response = $this->postJson('/api/contact/view', [
            'contactId' => $contact->contact_id
        ], [
            'Company-Id' => $this->company->company_id
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'message' => 'Contacts retrieved successfully',
                    'statusCode' => '200'
                ]);

        $responseData = json_decode($response->json('data'), true);
        $this->assertEquals($contact->contact_id, $responseData['contact_id']);
    }

    public function test_can_search_contacts_by_name()
    {
        // Create test contacts
        $contact1 = Contact::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'company_id' => $this->company->company_id
        ]);

        $contact2 = Contact::factory()->create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'company_id' => $this->company->company_id
        ]);

        $response = $this->postJson('/api/contact/view', [
            'contactName' => 'Doe'
        ], [
            'Company-Id' => $this->company->company_id
        ]);

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'message' => 'Contacts retrieved successfully',
                    'statusCode' => '200'
                ]);

        $responseData = json_decode($response->json('data'), true);
        $this->assertCount(2, $responseData);
    }
}
