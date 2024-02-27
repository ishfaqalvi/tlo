<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ProjectDisaggregationField
 *
 * @property $id
 * @property $disaggregation_id
 * @property $name
 * @property $created_at
 * @property $updated_at
 *
 * @property ProjectDisaggregation $projectDisaggregation
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProjectDisaggregationField extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['disaggregation_id','name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function projectDisaggregation()
    {
        return $this->hasOne('App\Models\ProjectDisaggregation', 'id', 'disaggregation_id');
    }
}
