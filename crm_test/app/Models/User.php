<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, LogsActivity;

    public $timestamps = false; // This disables the automatic timestamps

    protected $fillable = [
        'company_id',
        'email_id',
        'first_name',
        'last_name',
        'mobile_number',
        'user_name',
        'password',
        'zone_id',
        'visibility_group_id',
        'userset_id',
        'created_by',
        'modified_by',
        'created_at',
        'modified_at',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'is_deleted' => 'boolean',
        'is_account_expired' => 'boolean',
        'is_account_locked' => 'boolean',
        'is_credentials_expired' => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'first_name',
                'last_name',
                'email_id',
                'is_active'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}