<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
/**
 * Class ProjectFile
 *
 * @property $id
 * @property $project_id
 * @property $activity_id
 * @property $type
 * @property $name
 * @property $path
 * @property $created_at
 * @property $updated_at
 *
 * @property Project $project
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProjectFile extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id','activity_id','type','name','path'];

    /**
     * The get attributes.
     *
     * @var array
     */
    public function getPathAttribute($file)
    {
        return $this->type == 'Upload' ? asset($file) : $file;
    }

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
    public function activity()
    {
        return $this->hasOne('App\Models\Activity', 'id', 'activity_id');
    }
}
