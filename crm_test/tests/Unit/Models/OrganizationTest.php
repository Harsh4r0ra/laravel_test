<?php

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
            'company_id' => $organization->company_id,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);

        $primaryContact = $organization->contacts()
            ->wherePivot('is_primary_contact', true)
            ->first();

        $this->assertNotNull($primaryContact);
        $this->assertEquals($contact->contact_id, $primaryContact->contact_id);
    }

    public function test_organization_belongs_to_company()
    {
        $organization = Organization::factory()->create();
        
        $this->assertNotNull($organization->company);
        $this->assertEquals($organization->company_id, $organization->company->company_id);
    }

    public function test_organization_can_update_primary_contact()
    {
        $organization = Organization::factory()->create();
        $contact1 = Contact::factory()->create();
        $contact2 = Contact::factory()->create();

        // Set first contact as primary
        $organization->contacts()->attach($contact1->contact_id, [
            'is_primary_contact' => true,
            'company_id' => $organization->company_id,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);

        // Set second contact as primary
        $organization->contacts()->attach($contact2->contact_id, [
            'is_primary_contact' => true,
            'company_id' => $organization->company_id,
            'created_by' => 1,
            'modified_by' => 1,
            'created_at' => now(),
            'modified_at' => now()
        ]);

        // Update first contact to not be primary
        $organization->contacts()->updateExistingPivot($contact1->contact_id, [
            'is_primary_contact' => false,
            'modified_by' => 1,
            'modified_at' => now()
        ]);

        $primaryContact = $organization->contacts()
            ->wherePivot('is_primary_contact', true)
            ->first();

        $this->assertEquals($contact2->contact_id, $primaryContact->contact_id);
    }

    public function test_organization_soft_deletes()
    {
        $organization = Organization::factory()->create();
        
        $organization->delete();
        
        $this->assertSoftDeleted($organization);
        $this->assertNotNull($organization->deleted_at);
    }

    public function test_organization_has_required_fields()
    {
        $organization = Organization::factory()->create([
            'name' => 'Test Organization'
        ]);

        $this->assertNotNull($organization->name);
        $this->assertDatabaseHas('organization', [
            'organization_id' => $organization->organization_id,
            'name' => 'Test Organization'
        ]);
    }

    public function test_organization_can_have_multiple_contacts()
    {
        $organization = Organization::factory()
            ->has(Contact::factory()->count(5))
            ->create();

        $this->assertCount(5, $organization->contacts);
        $this->assertInstanceOf(Contact::class, $organization->contacts->first());
    }
}