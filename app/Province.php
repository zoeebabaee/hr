<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name','data_id'];

    public function cities()
    {
        return $this->hasMany('HR\City');
    }

    public function resume()
    {
        return $this->hasMany('HR\Resume','province_id');
    }

    public function profile()
    {
        return $this->hasMany('HR\UserProfile','province_id');
    }

    public function jobs()
    {
        return $this->hasMany('HR\Job','province_id');
    }
}
