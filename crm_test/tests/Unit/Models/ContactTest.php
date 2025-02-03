<?php
// tests/Unit/Models/ContactTest.php
namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Phone;
use App\Models\Organization;
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