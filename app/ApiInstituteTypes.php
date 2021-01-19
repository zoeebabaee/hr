<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class ApiInstituteTypes extends Model
{
    public function api_education_institute_type()
    {
        return $this->hasMany('HR\ResumeEducationalDetail','institute_type');
    }
}
