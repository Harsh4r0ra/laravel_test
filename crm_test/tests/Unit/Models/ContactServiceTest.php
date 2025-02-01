<?php

// tests/Unit/Services/ContactServiceTest.php
namespace Tests\Unit\Services;

class ContactServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $contactService;

    public function setUp(): void
    {
        parent::setUp();
        $this->contactService = app(ContactService::class);
    }

    public function test_can_search_contacts()
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
