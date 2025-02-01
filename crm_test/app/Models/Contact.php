<?php
// app/Models/Contact.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Contact extends Model
{
    use LogsActivity, SoftDeletes;

    protected $table = 'contact';
    protected $primaryKey = 'contact_id';
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'source',
        'occupation',
        'dob',
        'gender',
        'description',
        'organization_id',
        'company_id',
        'created_by',
        'modified_by'
    ];

    protected $dates = [
        'created_at',
        'modified_at',
        'deleted_at',
        'dob'
    ];

    protected $casts = [
        'dob' => 'date',
        'created_at' => 'datetime',
        'modified_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function phones()
    {
        return $this->belongsToMany(Phone::class, 'contact_phone', 'contact_id', 'phone_id')
            ->withPivot('contact_phone_type', 'is_primary_phone')
            ->using(ContactPhone::class);
    }

    public function emails()
    {
        return $this->belongsToMany(Email::class, 'contact_email', 'contact_id', 'email_id')
            ->withPivot('contact_email_type', 'is_primary_email')
            ->using(ContactEmail::class);
    }

    public function primaryPhone()
    {
        return $this->phones()->wherePivot('is_primary_phone', true)->first();
    }

    public function primaryEmail()
    {
        return $this->emails()->wherePivot('is_primary_email', true)->first();
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // Scope for active contacts
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}