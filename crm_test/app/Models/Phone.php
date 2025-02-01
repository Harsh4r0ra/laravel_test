<?php

// app/Models/Phone.php
namespace App\Models;

class Phone extends Model
{
    use LogsActivity, SoftDeletes;

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
        return $this->belongsToMany(Contact::class, 'contact_phone')
            ->withPivot('contact_phone_type', 'is_primary_phone');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty();
    }
}