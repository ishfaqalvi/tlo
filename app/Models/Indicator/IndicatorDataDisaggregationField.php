<?php

namespace App\Models\Indicator;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class IndicatorDataDisaggregationField
 *
 * @property $id
 * @property $disaggregation_id
 * @property $field_id
 * @property $value
 * @property $created_at
 * @property $updated_at
 *
 * @property IndicatorDataDisaggregation $indicatorDataDisaggregation
 * @property ProjectDisaggregationField $projectDisaggregationField
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class IndicatorDataDisaggregationField extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['disaggregation_id','field_id','value'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dataDisaggregation()
    {
        return $this->hasOne('App\Models\Indicator\IndicatorDataDisaggregation', 'id', 'disaggregation_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function projectDisaggregationField()
    {
        return $this->hasOne('App\Models\Project\ProjectDisaggregationField', 'id', 'field_id');
    }
}
