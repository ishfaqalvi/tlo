<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Lesson
 *
 * @property $id
 * @property $project_id
 * @property $date_identified
 * @property $entered_by
 * @property $subject
 * @property $situation
 * @property $comments
 * @property $neded
 * @property $created_at
 * @property $updated_at
 *
 * @property Project $project
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Lesson extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'date_identified',
        'entered_by',
        'subject',
        'situation',
        'comments',
        'neded'
    ];

    /**
     * Interact with the date.
     */
    public function setDateIdentifiedAttribute($value)
    {
        $this->attributes['date_identified'] = strtotime($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }
}
