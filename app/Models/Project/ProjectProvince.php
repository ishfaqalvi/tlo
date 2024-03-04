<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ProjectProvince
 *
 * @property $id
 * @property $project_id
 * @property $province_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Project $project
 * @property Province $province
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProjectProvince extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id','province_id'];


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
    public function province()
    {
        return $this->hasOne('App\Models\Province', 'id', 'province_id');
    }
}
