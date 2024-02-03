<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ProjectActivity
 *
 * @property $id
 * @property $project_id
 * @property $site_id
 * @property $project_phase_id
 * @property $assign_to
 * @property $activity_progress_id
 * @property $milestone
 * @property $start_date
 * @property $end_date
 * @property $due_date
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property ActivityProgress $activityProgress
 * @property ProjectPhase $projectPhase
 * @property Project $project
 * @property Site $site
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProjectActivity extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'site_id',
        'project_phase_id',
        'assign_to',
        'activity_progress_id',
        'milestone',
        'start_date',
        'end_date',
        'status'
    ];

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
    public function activityProgress()
    {
        return $this->hasOne('App\Models\Catalog\ActivityProgress', 'id', 'activity_progress_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function projectPhase()
    {
        return $this->hasOne('App\Models\Project\ProjectPhase', 'id', 'project_phase_id');
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
    public function site()
    {
        return $this->hasOne('App\Models\Site', 'id', 'site_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'assign_to');
    }  
}
