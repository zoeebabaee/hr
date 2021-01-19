<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class ApiEducationOrientations extends Model
{
    public function resume_education_orientation()
    {
        return $this->hasMany('HR\ResumeEducationalDetail','api_education_orientation_id' );
    }
}
