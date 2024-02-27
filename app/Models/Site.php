<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Site
 *
 * @property $id
 * @property $site_type_id
 * @property $province_id
 * @property $name
 * @property $office
 * @property $contact_name
 * @property $contact_number
 * @property $latitude
 * @property $longitude
 * @property $note
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property ProjectActivity[] $projectActivities
 * @property Province $province
 * @property SiteType $siteType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Site extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'thematic_area_id',
        'province_id',
        'name',
        'office',
        'contact_name',
        'contact_number',
        'latitude',
        'longitude',
        'note',
        'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectActivities()
    {
        return $this->hasMany('App\Models\ProjectActivity', 'site_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function province()
    {
        return $this->hasOne('App\Models\Catalog\Province', 'id', 'province_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function thematicArea()
    {
        return $this->hasOne('App\Models\Catalog\ThematicArea', 'id', 'thematic_area_id');
    }
}
