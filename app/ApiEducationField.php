<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class ApiEducationField extends Model
{

    protected $table = 'api_education_fields';
    protected $primaryKey = 'id';



    public function resume_educations()
    {
        return $this->hasMany('HR\ResumeEducationalDetail','api_education_field_id' );
    }
}
