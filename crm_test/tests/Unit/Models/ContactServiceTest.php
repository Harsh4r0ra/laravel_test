<?php

// tests/Unit/Models/ContactServiceTest.php
namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactServiceTest extends TestCase
{
    use RefreshDatabase;

    private ContactService $contactService;

    public function setUp(): void
    {
        parent::setUp();
        $this->contactService = new ContactService();
    }

    public function test_can_search_contacts_by_name()
    {
        Contact::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe'
        ]);

        $results = $this->contactService->searchContacts('John');
        
        $this->assertCount(1, $results);
        $this->assertEquals('John', $results->first()->first_name);
    }
}