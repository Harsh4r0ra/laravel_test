<?php

// app/Models/OrganizationContact.php
namespace App\Models;

class OrganizationContact extends Model
{
    use LogsActivity;

    protected $table = 'organization_contact';
    protected $primaryKey = 'organization_contact_id';
    public $timestamps = false;

    protected $fillable = [
        'organization_id',
        'contact_id',
        'is_primary_contact',
        'company_id',
        'created_by',
        'modified_by'
    ];

    protected $dates = [
        'created_at',
        'modified_at',
        'deleted_at'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty();
    }
}