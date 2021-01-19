<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class ApiInstitutePlaces extends Model
{
    public function api_education_institute_place()
    {
        return $this->hasMany('HR\ResumeEducationalDetail','api_institute_place_id' );
    }
}
