<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\OrganizationFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Organization extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $table = 'organization';
    protected $primaryKey = 'organization_id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'annual_revenue',
        'estd_date',
        'legal_structure',
        'type_of_business',
        'occupation',
        'employee_count',
        'description',
        'company_id',
        'created_by',
        'modified_by'
    ];

    protected $dates = [
        'created_at',
        'modified_at',
        'deleted_at',
        'estd_date'
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory()
    {
        return OrganizationFactory::new();
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'organization_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'annual_revenue',
                'legal_structure',
                'type_of_business'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}