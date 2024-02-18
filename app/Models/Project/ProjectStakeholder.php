<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ProjectStakeholder
 *
 * @property $id
 * @property $project_id
 * @property $stakeholder_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Project $project
 * @property Stakeholder $stakeholder
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProjectStakeholder extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id','stakeholder_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stakeholder()
    {
        return $this->hasOne('App\Models\Stakeholder', 'id', 'stakeholder_id');
    }
}
