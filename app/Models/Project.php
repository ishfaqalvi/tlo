<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

/**
 * Class Project
 *
 * @property $id
 * @property $code
 * @property $name
 * @property $start_date
 * @property $end_date
 * @property $funding
 * @property $location
 * @property $donnor
 * @property $partner
 * @property $description
 * @property $assigned_to
 * @property $category_id
 * @property $status
 * @property $created_by
 * @property $updated_by
 * @property $deleted_by
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Category $category
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Project extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use SoftDeletes, Userstamps;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'stage',
        'start_date',
        'end_date',
        'province_id',
        'assigned_to',
        'category_id',
        'funding',
        'donnor',
        'partner',
        'status',
        'description'
    ];

    /**
     * Attributes that should auto genereted.
     *
     * @var array
     */
    public static function boot()
    {
        parent::boot();
        self::created(function ($model) { 
            $model->code = 'PR-' . str_pad($model->id, 6, "0", STR_PAD_LEFT);
            $model->save();
        });
    }

    /**
     * Interact with the date.
     */
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = strtotime($value);
    }

    /**
     * Interact with the date.
     */
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = strtotime($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function province()
    {
        return $this->hasOne('App\Models\Catlog\Province', 'id', 'province_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne('App\Models\Catlog\Category', 'id', 'category_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'assigned_to');
    }




    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sites()
    {
        return $this->hasMany('App\Models\Project\ProjectSite', 'project_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phases()
    {
        return $this->hasMany('App\Models\Project\ProjectPhase', 'project_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stakeholders()
    {
        return $this->hasMany('App\Models\Project\ProjectStakeholder', 'project_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany('App\Models\Project\ProjectFile', 'project_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function disaggregations()
    {
        return $this->hasMany('App\Models\Project\ProjectDisaggregation', 'project_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teamMembers()
    {
        return $this->hasMany('App\Models\Project\ProjectTeamMember', 'project_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reportingPeriods()
    {
        return $this->hasMany('App\Models\Project\ProjectReportingPeriod', 'project_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany('App\Models\Activity', 'project_id', 'id');
    }   
}
