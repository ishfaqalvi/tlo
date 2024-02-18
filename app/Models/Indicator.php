<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Indicator
 *
 * @property $id
 * @property $project_id
 * @property $name
 * @property $format
 * @property $direction
 * @property $target
 * @property $baseline
 * @property $aggregated
 * @property $frequency
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property ActivityIndicator[] $activityIndicators
 * @property ProjectReportingPeriod $projectReportingPeriod
 * @property Project $project
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Indicator extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id','name','format','direction','target','baseline','aggregated','frequency','description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activityIndicators()
    {
        return $this->hasMany('App\Models\ActivityIndicator', 'indicator_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function projectReportingPeriod()
    {
        return $this->hasOne('App\Models\ProjectReportingPeriod', 'id', 'frequency');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }
    
}
