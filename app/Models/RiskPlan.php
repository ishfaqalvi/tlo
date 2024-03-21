<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class RiskPlan
 *
 * @property $id
 * @property $project_id
 * @property $description
 * @property $consequence
 * @property $probability
 * @property $impact
 * @property $priority
 * @property $level
 * @property $strategy
 * @property $status
 * @property $responce
 * @property $date_identified
 * @property $created_at
 * @property $updated_at
 *
 * @property Project $project
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RiskPlan extends Model implements Auditable
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
        'description',
        'consequence',
        'probability',
        'impact',
        'priority',
        'level',
        'strategy',
        'responce',
        'action_date',
        'owner',
        'status'
    ];

    /**
     * Interact with the date.
     */
    public function setActionDateAttribute($value)
    {
        $this->attributes['action_date'] = strtotime($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }
}
