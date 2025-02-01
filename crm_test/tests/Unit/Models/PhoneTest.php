<?php

// tests/Unit/Models/PhoneTest.php
namespace Tests\Unit\Models;

class PhoneTest extends TestCase
{
    use RefreshDatabase;

    public function test_phone_belongs_to_contacts()
    {
        $phone = Phone::factory()
            ->hasContacts(2)
            ->create();

        $this->assertEquals(2, $phone->contacts->count());
    }

    public function test_phone_formatting()
    {
        $phone = Phone::factory()->create([
            'country_code' => '+1',
            'std_code' => '123',
            'phone_no' => '4567890'
        ]);

        $this->assertNotNull($phone->phone_no);
        $this->assertIsString($phone->country_code);
    }
}
