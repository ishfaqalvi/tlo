<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

/**
 * Class Category
 *
 * @property $id
 * @property $title
 * @property $created_by
 * @property $updated_by
 * @property $deleted_by
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Category extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use SoftDeletes, Userstamps;


    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany('App\Models\Project', 'category_id', 'id');
    }
}
