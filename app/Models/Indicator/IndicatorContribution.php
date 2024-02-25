<?php

namespace App\Models\Indicator;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class IndicatorContribution
 *
 * @property $id
 * @property $indicator_id
 * @property $contributer_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Indicator $indicator
 * @property Indicator $indicator
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class IndicatorContribution extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['indicator_id','contributer_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contributer()
    {
        return $this->hasOne('App\Models\Indicator', 'id', 'contributer_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function indicator()
    {
        return $this->hasOne('App\Models\Indicator', 'id', 'indicator_id');
    }
}
