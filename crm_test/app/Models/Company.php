<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Company extends Model
{
    use LogsActivity, HasFactory;

    protected $table = 'company';
    protected $primaryKey = 'company_id';
    public $timestamps = false;

    protected $fillable = [
        'company_name',
        'created_by',
        'modified_by',
        'is_deleted'
    ];

    protected $dates = [
        'created_at',
        'modified_at'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'company_id');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'company_id');
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class, 'company_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['company_name', 'is_deleted'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}