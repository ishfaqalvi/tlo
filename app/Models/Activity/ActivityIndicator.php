<?php

namespace App\Models\Activity;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ActivityIndicator
 *
 * @property $id
 * @property $activity_id
 * @property $indicator_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Activity $activity
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ActivityIndicator extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['activity_id','indicator_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function activity()
    {
        return $this->hasOne('App\Models\Activity', 'id', 'activity_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function indicator()
    {
        return $this->hasOne('App\Models\indicator', 'id', 'indicator_id');
    } 
}
