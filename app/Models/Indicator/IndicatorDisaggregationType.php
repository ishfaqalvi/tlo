<?php

namespace App\Models\Indicator;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class IndicatorDisaggregationType
 *
 * @property $id
 * @property $indicator_id
 * @property $project_disaggregation_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Indicator $indicator
 * @property ProjectDisaggregation $projectDisaggregation
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class IndicatorDisaggregationType extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['indicator_id','project_disaggregation_id'];


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
    public function projectDisaggregation()
    {
        return $this->hasOne('App\Models\Project\ProjectDisaggregation', 'id', 'project_disaggregation_id');
    }
    
}
