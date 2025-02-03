<?php
// tests/Unit/Models/EmailTest.php
namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Email;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_belongs_to_contacts()
    {
        $email = Email::factory()
            ->has(Contact::factory()->count(2), 'contacts')
            ->create();

        $this->assertCount(2, $email->contacts);
    }

    public function test_email_must_be_unique()
    {
        $email = Email::factory()->create();

        $this->expectException(\Illuminate\Database\QueryException::class);
        Email::factory()->create([
            'email' => $email->email
        ]);
    }
}