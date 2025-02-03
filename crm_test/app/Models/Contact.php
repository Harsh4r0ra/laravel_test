<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\ContactFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Contact extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

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

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return ContactFactory::new();
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function phones()
    {
        return $this->belongsToMany(Phone::class, 'contact_phone', 'contact_id', 'phone_id')
            ->withPivot('contact_phone_type', 'is_primary_phone')
            ->withTimestamps();
    }

    public function emails()
    {
        return $this->belongsToMany(Email::class, 'contact_email', 'contact_id', 'email_id')
            ->withPivot('contact_email_type', 'is_primary_email')
            ->withTimestamps();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'first_name',
                'last_name',
                'source',
                'occupation',
                'organization_id'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}