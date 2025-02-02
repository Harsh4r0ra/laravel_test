<?php
// tests/Unit/Services/ContactServiceTest.php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Contact;
use App\Models\Company;
use App\Services\ContactService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $contactService;
    protected $company;

    public function setUp(): void
    {
        parent::setUp();
        $this->contactService = app(ContactService::class);
        $this->company = Company::factory()->create();
    }

    public function test_can_search_contacts()
    {
        Contact::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'company_id' => $this->company->company_id
        ]);

        $results = $this->contactService->searchContacts('John');
        
        $this->assertCount(1, $results);
        $this->assertEquals('John', $results->first()->first_name);
    }

    public function test_can_get_contact_by_id()
    {
        $contact = Contact::factory()->create([
            'company_id' => $this->company->company_id
        ]);

        $result = $this->contactService->getContactById($contact->contact_id);
        
        $this->assertEquals($contact->contact_id, $result->contact_id);
    }
}