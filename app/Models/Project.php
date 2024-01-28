<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Wildside\Userstamps\Userstamps;
/**
 * Class Project
 *
 * @property $id
 * @property $code
 * @property $name
 * @property $start_date
 * @property $end_date
 * @property $funding
 * @property $location
 * @property $donnor
 * @property $partner
 * @property $description
 * @property $assigned_to
 * @property $category_id
 * @property $status
 * @property $created_by
 * @property $updated_by
 * @property $deleted_by
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Category $category
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Project extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use SoftDeletes, Userstamps;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'start_date',
        'end_date',
        'funding',
        'location',
        'donnor',
        'partner',
        'description',
        'assigned_to',
        'category_id',
        'status'
    ];

    /**
     * Attributes that should auto genereted.
     *
     * @var array
     */
    public static function boot()
    {
        parent::boot();
        self::created(function ($model) { 
            $model->code = 'PR-' . str_pad($model->id, 6, "0", STR_PAD_LEFT);
            $model->save();
        });
    }

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
    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'assigned_to');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stakeholders()
    {
        return $this->hasMany('App\Models\ProjectStakeholder', 'project_id', 'id');
    }   
}
