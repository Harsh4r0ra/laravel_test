<?php

// tests/Unit/Models/OrganizationTest.php
namespace Tests\Unit\Models;

class OrganizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_organization_has_contacts()
    {
        $organization = Organization::factory()
            ->hasContacts(3)
            ->create();

        $this->assertEquals(3, $organization->contacts->count());
    }

    public function test_can_get_primary_contact()
    {
        $organization = Organization::factory()->create();
        $primaryContact = Contact::factory()->create();
        
        $organization->contacts()->attach($primaryContact, [
            'is_primary_contact' => true
        ]);

        $this->assertEquals($primaryContact->id, $organization->primaryContact->id);
    }
}