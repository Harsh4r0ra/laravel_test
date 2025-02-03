<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Phone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class PhoneTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_phone_belongs_to_contacts()
    {
        $phone = Phone::factory()
            ->hasContacts(2)
            ->create();

        $this->assertEquals(2, $phone->contacts->count());
        $this->assertDatabaseCount('contact_phone', 2);
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
        $this->assertEquals('+1', $phone->country_code);
        $this->assertEquals('123', $phone->std_code);
        $this->assertEquals('4567890', $phone->phone_no);
    }

    public function test_phone_attributes_are_strings()
    {
        $phone = Phone::factory()->create();

        $this->assertIsString($phone->country_code);
        $this->assertIsString($phone->std_code);
        $this->assertIsString($phone->phone_no);
    }
}