<?php
// tests/Unit/Models/ContactTest.php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Phone;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_has_phones()
    {
        $contact = Contact::factory()
            ->hasPhones(2)
            ->create();

        $this->assertEquals(2, $contact->phones->count());
    }

    public function test_contact_has_emails()
    {
        $contact = Contact::factory()
            ->hasEmails(2)
            ->create();

        $this->assertEquals(2, $contact->emails->count());
    }

    public function test_can_get_primary_email()
    {
        $contact = Contact::factory()->create();
        $primaryEmail = Email::factory()->create();
        $secondaryEmail = Email::factory()->create();

        $contact->emails()->attach($primaryEmail, [
            'is_primary_email' => true,
            'contact_email_type' => 'Work'
        ]);
        $contact->emails()->attach($secondaryEmail, [
            'is_primary_email' => false,
            'contact_email_type' => 'Personal'
        ]);

        $this->assertEquals($primaryEmail->id, $contact->primaryEmail->id);
    }
}
