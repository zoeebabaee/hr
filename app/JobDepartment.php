<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobDepartment extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'parent_id','data_id','company_id','data_serial_number'];

    public function jobs()
    {
        return $this->hasMany('HR\Job','department_id');
    }

    public function resumes()
    {
        return $this->belongsToMany('HR\Resume',
            'resume_has_departments',
            'department_id','resume_id')
            ->withTimestamps();
    }

    protected $dates = ['deleted_at'];
}
