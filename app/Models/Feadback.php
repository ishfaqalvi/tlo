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
    protected $fillable = [
        'channel',
        'other_channel',
        'name',
        'contact_number',
        'address',
        'complainer_type',
        'complaint_type_id',
        'attachment',
        'status'
    ];

    /**
     * The set attributes.
     *
     * @var array
     */
    public function setAttachmentAttribute($image)
    {
        if ($image instanceof \Illuminate\Http\UploadedFile) {
            $name = $image->getClientOriginalName();
            $image->move('images/feadback', $name);
            $this->attributes['attachment'] = 'images/feadback/'.$name;
        } else {
            unset($this->attributes['attachment']);
        }
    }

    /**
     * The get attributes.
     *
     * @var array
     */
    public function getAttachmentAttribute($image)
    {
        if($image){ return asset($image); }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function complaintType()
    {
        return $this->hasOne('App\Models\Catalog\ComplaintType', 'id', 'complaint_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function responces()
    {
        return $this->hasMany('App\Models\FeadbackResponce', 'feadback_id', 'id');
    }
}