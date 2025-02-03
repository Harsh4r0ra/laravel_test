<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Phone extends Model
{
    use LogsActivity, SoftDeletes, HasFactory;

    protected $table = 'phone';
    protected $primaryKey = 'phone_id';
    public $timestamps = false;

    protected $fillable = [
        'country_code',
        'std_code',
        'phone_no',
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
        return $this->belongsToMany(Contact::class, 'contact_phone', 'phone_id', 'contact_id')
            ->withPivot('contact_phone_type', 'is_primary_phone');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['country_code', 'std_code', 'phone_no'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}