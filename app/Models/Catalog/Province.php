<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use App\Models\Project;

/**
 * Class Province
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
class Province extends Model implements Auditable
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

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_provinces');
    }
}
