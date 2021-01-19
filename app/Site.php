<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public function resumes()
    {
        return $this->belongsToMany('HR\Resume',
            'resume_has_sites',
            'site_id','resume_id')
            ->withTimestamps();
    }
}
