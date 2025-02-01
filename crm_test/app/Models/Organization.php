<?php
// app/Models/Organization.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Organization extends Model
{
    use LogsActivity, SoftDeletes;

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

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'organization_contact')
            ->withPivot('is_primary_contact');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty();
    }
}