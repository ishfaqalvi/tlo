<?php

namespace App\Models\Activity;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ActivityStakeholder
 *
 * @property $id
 * @property $activity_id
 * @property $stakeholder_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Activity $activity
 * @property Stakeholder $stakeholder
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ActivityStakeholder extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['activity_id','stakeholder_id'];


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
    public function stakeholder()
    {
        return $this->hasOne('App\Models\Stakeholder', 'id', 'stakeholder_id');
    }
    
}
