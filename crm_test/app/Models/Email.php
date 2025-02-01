<?php

namespace App\Models;

class Email extends Model
{
    use LogsActivity, SoftDeletes;

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
        return $this->belongsToMany(Contact::class, 'contact_email')
            ->withPivot('contact_email_type', 'is_primary_email');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty();
    }
}