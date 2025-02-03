<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Email extends Model
{
    use LogsActivity, SoftDeletes, HasFactory;

    protected $table = 'email';
    protected $primaryKey = 'email_id';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'company_id',
        'created_by',
        'modified_by'
    ];

    protected $dates = [
        'created_at',
        'modified_at',
        'deleted_at'
    ];

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'contact_email', 'email_id', 'contact_id')
            ->withPivot('contact_email_type', 'is_primary_email');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['email'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}