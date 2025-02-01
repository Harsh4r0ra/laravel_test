<?php

// app/Models/ContactPhone.php
namespace App\Models;

class ContactPhone extends Model
{
    use LogsActivity;

    protected $table = 'contact_phone';
    protected $primaryKey = 'contact_phone_id';
    public $timestamps = false;

    protected $fillable = [
        'contact_id',
        'phone_id',
        'contact_phone_type',
        'is_primary_phone',
        'company_id',
        'created_by',
        'modified_by'
    ];

    protected $dates = [
        'created_at',
        'modified_at',
        'deleted_at'
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function phone()
    {
        return $this->belongsTo(Phone::class, 'phone_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty();
    }
}