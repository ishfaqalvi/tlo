<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Activity
 *
 * @property $id
 * @property $project_id
 * @property $phase_id
 * @property $assign_to
 * @property $name
 * @property $milestone
 * @property $start_date
 * @property $end_date
 * @property $progress
 * @property $status
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property ProjectPhase $projectPhase
 * @property Project $project
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Activity extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id','phase_id','assign_to','name','milestone','start_date','end_date','progress','status','description'];

     /**
     * Interact with the date.
     */
    public function setStartDateAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['start_date'] = strtotime($value);
        } else {
            $this->attributes['start_date'] = null;
        }
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
    public function projectPhase()
    {
        return $this->hasOne('App\Models\ProjectPhase', 'id', 'phase_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'assign_to');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function budgets()
    {
        return $this->hasMany('App\Models\Activity\ActivityBudget', 'activity_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany('App\Models\Project\ProjectFile', 'activity_id', 'id');
    } 

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sites()
    {
        return $this->hasMany('App\Models\Activity\ActivitySite', 'activity_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stakeholders()
    {
        return $this->hasMany('App\Models\Activity\ActivityStakeholder', 'activity_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function indicators()
    {
        return $this->hasMany('App\Models\Activity\ActivityIndicator', 'activity_id', 'id');
    } 
}
