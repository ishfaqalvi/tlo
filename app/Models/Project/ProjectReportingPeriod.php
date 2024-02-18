<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ProjectReportingPeriod
 *
 * @property $id
 * @property $project_id
 * @property $title
 * @property $created_at
 * @property $updated_at
 *
 * @property ProjectReportingPeriodRange[] $projectReportingPeriodRanges
 * @property Project $project
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProjectReportingPeriod extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id','title'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ranges()
    {
        return $this->hasMany('App\Models\Project\ProjectReportingPeriodRange', 'period_id', 'id');
    }  
}
