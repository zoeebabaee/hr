<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class ResumeFamilyDetail extends Model
{
    public function resume()
    {
        return $this->belongsTo('HR\Resume', 'resume_id');
    }
}
