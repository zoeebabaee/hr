<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class Introducer extends Model
{
    public function resume()
    {
        return $this->belongsTo('HR\Resume','introducer_id');
    }

    public function resumes()
    {
        return $this->belongsTo('HR\Resume',
            'resume_has_introducers',
            'introducer_id','resume_id')
            ->withTimestamps();
    }
}