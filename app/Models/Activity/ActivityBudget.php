<?php

namespace App\Models\Activity;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ActivityBudget
 *
 * @property $id
 * @property $activity_id
 * @property $description
 * @property $budget_amount
 * @property $actual_spent
 * @property $created_at
 * @property $updated_at
 *
 * @property Activity $activity
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ActivityBudget extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['activity_id','description','budget_amount','actual_spent'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function activity()
    {
        return $this->hasOne('App\Models\Activity', 'id', 'activity_id');
    }
    
}
