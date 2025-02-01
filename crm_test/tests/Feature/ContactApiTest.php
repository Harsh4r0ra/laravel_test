<?php
// tests/Feature/ContactApiTest.php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Contact;
use App\Models\Company;
use App\Models\Email;
use App\Models\Phone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ContactApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $company;

    public function setUp(): void
    {
        parent::setUp();
        $this->company = Company::factory()->create();
    }

    public function test_can_get_contact_by_id()
    {
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
                    'message' => 'Contacts retrieved successfully'
                ]);

        $responseData = json_decode($response->json('data'), true);
        $this->assertEquals($contact->contact_id, $responseData['contact_id']);
    }

    public function test_can_search_contacts_by_name()
    {
        Contact::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'company_id' => $this->company->company_id
        ]);

        $response = $this->postJson('/api/contact/view', [
            'contactName' => 'John'
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

    public function test_requires_company_id_header()
    {
        $response = $this->postJson('/api/contact/view', [
            'contactName' => 'John'
        ]);

        $response->assertStatus(403);
    }
}