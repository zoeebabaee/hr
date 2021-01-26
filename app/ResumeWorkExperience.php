<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ResumeWorkExperience extends Model
{

    public $appends = ['georgian_start_date','georgian_end_date'];
    public function getGeorgianStartDateAttribute()
    {
        return $this->attributes['start_date'];
    }
    public function getGeorgianEndDateAttribute()
    {
        return $this->attributes['end_date'];
    }

    public function resume()
    {
        return $this->belongsTo('HR\Resume', 'resume_id');
    }
    
    public function setStartDateAttribute($value)
    {
        if($value != '' && $value != null)
            $this->attributes['start_date'] = myDate::createFromFormat('Y/m/d', $value)->carbon->toDateString();
        else
            $this->attributes['start_date'] = $value;
    }
    public function getStartDateAttribute($value)
    {
        if($value != '' && $value != null)
            return myDate::createFromCarbon(Carbon::parse($value))->format('Y/m/d');
        else
            return $value;

    }
    public function setEndDateAttribute($value)
    {
        if($value != '' && $value != null)
            $this->attributes['end_date'] = myDate::createFromFormat('Y/m/d', $value)->carbon->toDateString();
        else
            $this->attributes['end_date'] = $value;
    }
    public function getEndDateAttribute($value)
    {
        if($value != '' && $value != null)
            return myDate::createFromCarbon(Carbon::parse($value))->format('Y/m/d');
        else
            return $value;
    }
}
