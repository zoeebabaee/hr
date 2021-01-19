<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    public function user()
    {
        return $this->belongsTo('HR\User','user_id');
    }

    public function province()
    {
        return $this->belongsTo('HR\Province','province_id');
    }

    public function contractTypes()
    {
        return $this->belongsToMany('HR\ResumeContractType',
            'resume_has_contract_type',
            'resume_id','contract_type_id')
            ->withTimestamps();
    }

    public function departments()
    {
        return $this->belongsToMany('HR\JobDepartment',
            'resume_has_departments',
            'resume_id','department_id')
            ->withTimestamps();
    }

    public function industries()
    {
        return $this->belongsToMany('HR\Industry',
            'resume_has_industries',
            'resume_id','industry_id')
            ->withTimestamps();
    }

    public function site()
    {
        return $this->belongsToMany('HR\Site',
            'resume_has_sites',
            'resume_id','site_id')
            ->withTimestamps();
    }

    public function introducers()
    {
        return $this->belongsToMany('HR\Introducer',
            'resume_has_introducers',
            'resume_id','introducer_id')
            ->withTimestamps();
    }

    public function introducer()
    {
        return $this->belongsTo('HR\Introducer');
    }

    public function educational_details()
    {
        return $this->hasMany('HR\ResumeEducationalDetails' , 'resume_id');
    }


    public function work_experience()
    {
        return $this->hasMany('HR\ResumeWorkExperience','resume_id');
    }

    public function professional_training_records()
    {
        return $this->belongsToMany('HR\JobProfessionalMerites',
            'resume_has_p_t_r',
            'resume_id','professional_merites_id')
            ->withPivot('duration','has_certificate','finish_year','institute_name')
            ->withTimestamps();
    }

    public function experimental_expertises()
    {
        return $this->belongsToMany('HR\JobProfessionalMerites',
            'resume_has_exp_expertises',
            'resume_id','professional_merites_id')
            ->withPivot('proficiency','description')
            ->withTimestamps();
    }

    public function computer_skills()
    {
        return $this->belongsToMany('HR\JobProfessionalMerites',
            'resume_has_com_skills',
            'resume_id','professional_merites_id')
            ->withPivot('proficiency','has_certificate','description')
            ->withTimestamps();
    }

    public function foreign_languages()
    {
        return $this->hasMany('HR\ResumeForeignLanguage' , 'resume_id');
    }

    public function work_experiences()
    {
        return $this->hasMany('HR\ResumeWorkExperience' , 'resume_id');
    }

    public function questions()
    {
        return $this->hasOne('HR\ResumeQuestion' , 'resume_id');
    }

    public function family()
    {
        return $this->hasMany('HR\ResumeFamilyDetail' , 'resume_id');
    }
}
