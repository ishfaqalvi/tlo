<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Feadback
 *
 * @property $id
 * @property $channel
 * @property $other_channel
 * @property $name
 * @property $contact_number
 * @property $address
 * @property $complainer_type
 * @property $complaint_type_id
 * @property $committee
 * @property $responce_share
 * @property $agree
 * @property $description
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property ComplaintType $complaintType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Feadback extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['channel','other_channel','name','contact_number','address','complainer_type','complaint_type_id','committee','responce_share','agree','description','status'];

    // public function getChannelAttribute($value)
    // {
    //     if ($value == 'Other Bright Ideas') {
    //         return $this->attributes['other_channel'];
    //     }
    //     return $value;
    // }

    public function setResponceShareAttribute($value){
        if (isset($value)) {
            $this->attributes['responce_share'] = 'Yes';
        }else{
            $this->attributes['responce_share'] = Null;
            $this->attributes['agree'] = Null;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function complaintType()
    {
        return $this->hasOne('App\Models\Catalog\ComplaintType', 'id', 'complaint_type_id');
    }
}
