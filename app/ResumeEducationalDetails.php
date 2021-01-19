<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ResumeEducationalDetails extends Model
{
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
    
    
    public function api_educations()
    {
        return $this->belongsTo('HR\ApiEducationField','api_education_field_id');
    }

    public function api_education_type()
    {
        return $this->belongsTo('HR\ApiEducationFieldTypes','api_education_field_type_id');
    }

    public function api_education_orientation()
    {
        return $this->belongsTo('HR\ApiEducationOrientations','api_education_orientation_id');
    }

    public function api_education_institute_place()
    {
        return $this->belongsTo('HR\ApiInstitutePlaces','api_institute_place_id');
    }
    public function api_education_institute_type()
    {
        return $this->belongsTo('HR\ApiInstitutePlaces','institute_type');
    }
}
