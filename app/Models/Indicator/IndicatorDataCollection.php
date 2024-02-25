<?php

namespace App\Models\Indicator;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class IndicatorDataCollection
 *
 * @property $id
 * @property $indicator_id
 * @property $collected_value
 * @property $date
 * @property $identifier
 * @property $site_id
 * @property $evidence
 * @property $notes
 * @property $created_at
 * @property $updated_at
 *
 * @property Indicator $indicator
 * @property Site $site
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class IndicatorDataCollection extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['indicator_id','collected_value','date','identifier','site_id','evidence','notes'];

    /**
     * Interact with the date.
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = strtotime($value);
    }

    /**
     * Set the attachment's.
     * @param  string  $value
     * @return void
     */
    public function setEvidenceAttribute($values) {
        if($values) {
            foreach($values as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move('images/indicator/data-collection', $name);
                $attachment[] = $name;
                $this->attributes['evidence'] = json_encode($attachment);
            }
        }else{
            unset($this->attributes['evidence']);
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function indicator()
    {
        return $this->hasOne('App\Models\Indicator', 'id', 'indicator_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function site()
    {
        return $this->hasOne('App\Models\Site', 'id', 'site_id');
    }
}
