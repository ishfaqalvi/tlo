<?php

namespace App\Models\Indicator;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class IndicatorDataDisaggregation
 *
 * @property $id
 * @property $collection_id
 * @property $disaggregation_id
 * @property $created_at
 * @property $updated_at
 *
 * @property IndicatorDataCollection $indicatorDataCollection
 * @property IndicatorDataDisaggregationField[] $indicatorDataDisaggregationFields
 * @property ProjectDisaggregation $projectDisaggregation
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class IndicatorDataDisaggregation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['collection_id','disaggregation_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dataCollection()
    {
        return $this->hasOne('App\Models\Indicator\IndicatorDataCollection', 'id', 'collection_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function projectDisaggregation()
    {
        return $this->hasOne('App\Models\Project\ProjectDisaggregation', 'id', 'disaggregation_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dataDisaggregationFields()
    {
        return $this->hasMany('App\Models\Indicator\IndicatorDataDisaggregationField', 'disaggregation_id', 'id');
    }
}
