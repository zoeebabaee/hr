<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class ApiEducationFieldTypes extends Model
{

    public function resume_education_type()
    {
        return $this->hasMany('HR\ResumeEducationalDetail','api_education_field_type_id' );
    }

}
