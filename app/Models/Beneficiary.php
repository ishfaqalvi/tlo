<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Beneficiary
 *
 * @property $id
 * @property $nid
 * @property $name
 * @property $father_name
 * @property $gender
 * @property $marital_status
 * @property $province
 * @property $district
 * @property $village
 * @property $contact
 * @property $project_id
 * @property $type_of_assistance
 * @property $residential_type
 * @property $remarks
 * @property $created_at
 * @property $updated_at
 *
 * @property Project $project
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Beneficiary extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'father_name',
        'gender',
        'marital_status',
        'province',
        'district',
        'village',
        'contact',
        'project_id',
        'type_of_assistance',
        'residential_type',
        'remarks'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'project_id');
    }
}
