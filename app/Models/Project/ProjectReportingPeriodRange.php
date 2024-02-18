<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ProjectReportingPeriodRange
 *
 * @property $id
 * @property $period_id
 * @property $title
 * @property $start_date
 * @property $end_date
 * @property $created_at
 * @property $updated_at
 *
 * @property ProjectReportingPeriod $projectReportingPeriod
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProjectReportingPeriodRange extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['period_id','title','start_date','end_date'];

    /**
     * Interact with the date.
     */
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = strtotime($value);
    }

    /**
     * Interact with the date.
     */
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = strtotime($value);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function projectReportingPeriod()
    {
        return $this->hasOne('App\Models\ProjectReportingPeriod', 'id', 'period_id');
    }
    
}
