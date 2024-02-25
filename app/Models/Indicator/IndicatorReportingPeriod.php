<?php

namespace App\Models\Indicator;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class IndicatorReportingPeriod
 *
 * @property $id
 * @property $indicator_id
 * @property $reporting_period_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Indicator $indicator
 * @property ProjectReportingPeriod $projectReportingPeriod
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class IndicatorReportingPeriod extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['indicator_id','reporting_period_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function indicator()
    {
        return $this->hasOne('App\Models\Indicator', 'id', 'indicator_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function projectReportingPeriod()
    {
        return $this->hasOne('App\Models\Project\ProjectReportingPeriod', 'id', 'reporting_period_id');
    }
    
}
