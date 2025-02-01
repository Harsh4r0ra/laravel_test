<?php
// app/Models/Company.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Company extends Model
{
    use LogsActivity, SoftDeletes;

    protected $table = 'company';
    protected $primaryKey = 'company_id';
    public $timestamps = false;

    protected $fillable = [
        'company_name',
        'created_by',
        'modified_by'
    ];

    protected $dates = [
        'created_at',
        'modified_at',
        'deleted_at'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty();
    }
}

// app/Models/Contact.php
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

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function phones()
    {
        return $this->belongsToMany(Phone::class, 'contact_phone')
            ->withPivot('contact_phone_type', 'is_primary_phone');
    }

    public function emails()
    {
        return $this->belongsToMany(Email::class, 'contact_email')
            ->withPivot('contact_email_type', 'is_primary_email');
    }
}

// Additional models follow same pattern...