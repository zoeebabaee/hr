<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Industry extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];

    public function jobs()
    {
        return $this->hasMany('HR\Job');
    }

    public function resumes()
    {
        return $this->belongsToMany('HR\Resume',
            'resume_has_industries',
            'industry_id','resume_id')
            ->withTimestamps();
    }

    protected $dates = ['deleted_at'];
}
