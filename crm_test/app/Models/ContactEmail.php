<?php

// app/Models/ContactEmail.php
namespace App\Models;

class ContactEmail extends Model
{
    use LogsActivity;

    protected $table = 'contact_email';
    protected $primaryKey = 'contact_email_id';
    public $timestamps = false;

    protected $fillable = [
        'contact_id',
        'email_id',
        'contact_email_type',
        'is_primary_email',
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

    public function email()
    {
        return $this->belongsTo(Email::class, 'email_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty();
    }
}
