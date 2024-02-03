<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

/**
 * Class ActivityProgress
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
 * @property ProjectActivity[] $projectActivities
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ActivityProgress extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use SoftDeletes, Userstamps;

    protected $table = 'activity_progress';
    
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
    public function projectActivities()
    {
        return $this->hasMany('App\Models\ProjectActivity', 'activity_progress_id', 'id');
    }
}
