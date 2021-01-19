<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserProfile extends Model
{
    public $appends = ['user_born_date'];
    public function getUserBornDateAttribute()
    {
        return $this->attributes['born_date'];
    }
    public function city()
    {
        return $this->belongsTo('HR\City','city_id');
    }

    public function user(){
        return $this->belongsTo('HR\User','user_id');
    }

    public function age()
    {
        return myDate::createFromFormat('Y/m/d', $this->born_date)->carbon->diffInYears(\Carbon::now());
    }

    public function province()
    {
        return $this->belongsTo('HR\Province','province_id');
    }
    public function setBornDateAttribute($value)
    {
        if($value != '' && $value != null)
            $this->attributes['born_date'] = myDate::createFromFormat('Y/m/d', $value)->carbon->toDateString();
        else
            $this->attributes['born_date'] = $value;
    }
    public function getBornDateAttribute($value)
    {
        if($value != '' && $value != null)
            return myDate::createFromCarbon(Carbon::parse($value))->format('Y/m/d');
        else
            return $value;

    }

    public function setMarriageDateAttribute($value)
    {
        if($value != '' && $value != null)
            $this->attributes['marriage_date'] = myDate::createFromFormat('Y/m/d', $value)->carbon->toDateString();
        else
            $this->attributes['marriage_date'] = $value;
    }
    public function getMarriageDateAttribute($value)
    {
        if($value != '' && $value != null)
            return myDate::createFromCarbon(Carbon::parse($value))->format('Y/m/d');
        else
            return $value;

    }


    public function setMilitaryEndDateAttribute($value)
    {
        if($value != '' && $value != null)
            $this->attributes['military_end_date'] = myDate::createFromFormat('Y/m/d', $value)->carbon->toDateString();
        else
            $this->attributes['military_end_date'] = $value;
    }
    public function getMilitaryEndDateAttribute($value)
    {
        if($value != '' && $value != null)
            return myDate::createFromCarbon(Carbon::parse($value))->format('Y/m/d');
        else
            return $value;
    }

    public function is_newsletter_member(){

        if(is_null($this->user->email) || empty($this->user->email)) {
            return false;
        }
        return boolval(newsletter_mails::where('email',$this->user->email)->count());
    }

}
