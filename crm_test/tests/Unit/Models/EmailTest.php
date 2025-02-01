<?php
// tests/Unit/Models/EmailTest.php

namespace Tests\Unit\Models;

class EmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_belongs_to_contacts()
    {
        $email = Email::factory()
            ->hasContacts(2)
            ->create();

        $this->assertEquals(2, $email->contacts->count());
    }

    public function test_email_validation()
    {
        $email = Email::factory()->create([
            'email' => 'test@example.com'
        ]);

        $this->assertTrue(filter_var($email->email, FILTER_VALIDATE_EMAIL) !== false);
    }
}