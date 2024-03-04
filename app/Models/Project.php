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
        'project_contract_number',
        'name',
        'stage',
        'start_date',
        'end_date',
        'assigned_to',
        'category_id',
        'funding',
        'donnor',
        'partner',
        'status',
        'description'
    ];

    /**
     * Scope a query to filter product.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $request)
    {
        if (isset($request['category_id'])) {
            $query->whereCategoryId($request['category_id']);
        }
        if (isset($request['assigned_to'])) {
            $query->whereAssignedTo($request['assigned_to']);
        }
        if (isset($request['stage'])) {
            $query->whereStage($request['stage']);
        }
        if (isset($request['status'])) {
            $query->whereStatus($request['status']);
        }
        if (isset($request['donnor'])) {
            $query->whereDonnor($request['donnor']);
        }
        if (isset($request['partner'])) {
            $query->wherePartner($request['partner']);
        }
        if (isset($request['search'])) {
            $query->where('name', 'like', '%'.$request['search'].'%')
            ->orWhere('description', 'like', '%'.$request['search'].'%');
        }
        return $query;
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
     * Interact with the date.
     */
    public function setProvinceIdAttribute($value)
    {
        $this->attributes['province_id'] = implode(',',$value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne('App\Models\Catalog\Category', 'id', 'category_id');
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
    public function provinces()
    {
        return $this->hasMany('App\Models\Project\ProjectProvince', 'project_id', 'id');
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resultFrameworks()
    {
        return $this->hasMany('App\Models\ResultFramework', 'project_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function indicators()
    {
        return $this->hasMany('App\Models\Indicator', 'project_id', 'id');
    }   
}
