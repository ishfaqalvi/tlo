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

    public function getProbabilityColorAttribute()
    {
        switch ($this->probability) {
            case 'High 3':
                return 'text-danger';
            case 'Medium 2':
                return 'text-warning';
            case 'Low 1':
                return 'text-success';
            default:
                return '';
        }
    }
    public function getImpactColorAttribute()
    {
        switch ($this->impact) {
            case 'High 3':
                return 'text-danger';
            case 'Medium 2':
                return 'text-warning';
            case 'Low 1':
                return 'text-success';
            default:
                return '';
        }
    }
    public function getLevelColorAttribute()
    {
        switch ($this->level) {
            case '9':
                return 'text-danger';
            case '6':
                return 'text-danger';
            case '3':
                return 'text-warning';
            case '2':
                return 'text-success';
            default:
                return '';
        }
    }
    public function getStrategyColorAttribute()
    {
        switch ($this->strategy) {
            case 'Avoid':
                return 'text-danger';
            case 'Mitigate':
                return 'text-danger';
            case 'Transfer':
                return 'text-warning';
            case 'Accepted':
                return 'text-success';
            default:
                return '';
        }
    }

    /**
     * Scope a query to filter.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $category
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $request)
    {
        if (isset($request['project'])) {
            $query->whereProjectId($request['project']);
        }
        if (isset($request['probability'])) {
            $query->whereProbability($request['probability']);
        }
        if (isset($request['impact'])) {
            $query->whereImpact($request['impact']);
        }
        if (isset($request['priority'])) {
            $query->wherePriority($request['priority']);
        }
        if (isset($request['level'])) {
            $query->whereLevel($request['level']);
        }
        if (isset($request['strategy'])) {
            $query->whereStrategy($request['strategy']);
        }
        if (isset($request['status'])) {
            $query->whereStatus($request['status']);
        }
        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }
}
