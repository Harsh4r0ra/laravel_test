<?php
// tests/Unit/Models/ContactTest.php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\Email;
use App\Models\Phone;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_belongs_to_organization()
    {
        $organization = Organization::factory()->create();
        $contact = Contact::factory()->create([
            'organization_id' => $organization->organization_id
        ]);

        $this->assertEquals($organization->organization_id, $contact->organization->organization_id);
    }

    public function test_contact_has_emails()
    {
        $contact = Contact::factory()
            ->has(Email::factory()->count(2), 'emails')
            ->create();

        $this->assertCount(2, $contact->emails);
    }

    public function test_contact_has_phones()
    {
        $contact = Contact::factory()
            ->has(Phone::factory()->count(2), 'phones')
            ->create();

        $this->assertCount(2, $contact->phones);
    }
}

// tests/Unit/Models/OrganizationTest.php
namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Organization;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrganizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_organization_has_contacts()
    {
        $organization = Organization::factory()
            ->has(Contact::factory()->count(3))
            ->create();

        $this->assertCount(3, $organization->contacts);
    }

    public function test_can_get_primary_contact()
    {
        $organization = Organization::factory()->create();
        $contact = Contact::factory()->create();

        $organization->contacts()->attach($contact->contact_id, [
            'is_primary_contact' => true,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now(),
            'company_id' => $organization->company_id
        ]);

        $primaryContact = $organization->contacts()
            ->wherePivot('is_primary_contact', true)
            ->first();

        $this->assertNotNull($primaryContact);
        $this->assertEquals($contact->contact_id, $primaryContact->contact_id);
    }
}