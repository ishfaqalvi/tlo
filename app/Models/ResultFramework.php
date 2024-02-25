<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ResultFramework
 *
 * @property $id
 * @property $project_id
 * @property $parent_id
 * @property $title
 * @property $color
 * @property $order
 * @property $created_at
 * @property $updated_at
 *
 * @property Project $project
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ResultFramework extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id','parent_id','title','color','order'];


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
    public function parent()
    {
        return $this->belongsTo(ResultFramework::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function children()
    {
        return $this->hasMany(ResultFramework::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function indicators()
    {
        return $this->hasMany('App\Models\Indicator', 'result_framework_id', 'id');
    }
}
