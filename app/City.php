<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function province()
    {
        return $this->belongsTo('HR\Province','province_id');
    }

    public function resume()
    {
        return $this->hasMany('HR\Resume','city_id');
    }

    public function jobs()
    {
        return $this->belongsToMany('HR\Job',
            'job_has_cities',
            'city_id','job_id')
            ->withTimestamps();
    }

    public function applies()
    {
        return $this->belongsToMany('HR\Apply',
            'apply_has_cities',
            'city_id','apply_id')
            ->withTimestamps();
    }

    public function profile()
    {
        return $this->hasMany('HR\UserProfile','city_id');
    }
}
