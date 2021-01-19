<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobGeneralMerites extends Model
{
    use SoftDeletes;

    public function jobs()
    {
        return $this->belongsToMany('HR\Job',
            'job_has_general_merites',
            'general_merites_id','job_id')
            ->withPivot('value')
            ->withTimestamps();
    }
    
    
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = str_replace(['"', '\'',';'],['','',''],$value)  ;
    }

    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
    
    
}
