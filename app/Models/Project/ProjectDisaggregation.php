<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ProjectDisaggregation
 *
 * @property $id
 * @property $project_id
 * @property $type
 * @property $fields
 * @property $created_at
 * @property $updated_at
 *
 * @property Project $project
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProjectDisaggregation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id','type','fields'];

    /**
     * The set attributes.
     *
     * @var array
     */
    public function setFieldsAttribute($value)
    {
        $this->attributes['fields'] = implode(',', $value);
    }

    /**
     * The get attributes.
     *
     * @var array
     */
    public function getFieldsAttribute($value)
    {
        return explode(',', $value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }
}
