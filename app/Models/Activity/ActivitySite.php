<?php

namespace App\Models\Activity;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ActivitySite
 *
 * @property $id
 * @property $activity_id
 * @property $site_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Activity $activity
 * @property Site $site
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ActivitySite extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['activity_id','site_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function activity()
    {
        return $this->hasOne('App\Models\Activity', 'id', 'activity_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function site()
    {
        return $this->hasOne('App\Models\Site', 'id', 'site_id');
    }
    
}
