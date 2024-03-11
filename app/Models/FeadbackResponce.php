<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class FeadbackResponce
 *
 * @property $id
 * @property $feadback_id
 * @property $status
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property Feadback $feadback
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class FeadbackResponce extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['feadback_id','status','description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function feadback()
    {
        return $this->hasOne('App\Models\Feadback', 'id', 'feadback_id');
    }
}
