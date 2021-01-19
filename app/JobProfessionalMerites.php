<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobProfessionalMerites extends Model
{
    use SoftDeletes;

    public function jobs()
    {
        return $this->belongsToMany('HR\Job',
            'job_has_professional_merites',
            'professional_merites_id','job_id')
            ->withPivot('value')
            ->withTimestamps();
    }

    public function resume_professional_training_records()
    {
        return $this->belongsToMany('HR\Resume',
            'resume_has_p_t_r',
            'professional_merites_id','resume_id')
            ->withPivot('duration','has_certificate','finish_year','institute_name')
            ->withTimestamps();
    }

    public function resume_experimental_expertises()
    {
        return $this->belongsToMany('HR\Resume',
            'resume_has_exp_expertises',
            'professional_merites_id','resume_id')
            ->withPivot('proficiency','description')
            ->withTimestamps();
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = str_replace(['"', '\'',';'],['','',''],$value)  ;
    }
    public function resume_computer_skills()
    {
        return $this->belongsToMany('HR\Resume',
            'resume_has_com_skills',
            'professional_merites_id','resume_id')
            ->withPivot('proficiency','has_certificate','description')
            ->withTimestamps();
    }

    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
}
