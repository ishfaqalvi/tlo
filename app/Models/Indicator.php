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
    protected $fillable = [
        'project_id',
        'name',
        'format',
        'direction',
        'target',
        'baseline',
        'baseline_date',
        'unit_of_measure',
        'aggregated',
        'aggregation_formula',
        'indicator_number',
        'result_framework_id',
        'frequency',
        'key_performance',
        'status',
        'total_vs_actual_formula',
        'description'
    ];

    /**
     * Interact with the date.
     */
    public function setBaselineDateAttribute($value)
    {
        $this->attributes['baseline_date'] = strtotime($value);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function projectReportingPeriod()
    {
        return $this->hasOne('App\Models\Project\ProjectReportingPeriod', 'id', 'frequency');
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
    public function resultFramework()
    {
        return $this->hasOne('App\Models\ResultFramework', 'id', 'result_framework_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dataCollections()
    {
        return $this->hasMany('App\Models\Indicator\IndicatorDataCollection', 'indicator_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contributers()
    {
        return $this->hasMany('App\Models\Indicator\IndicatorContribution', 'indicator_id', 'id');
    }
}
