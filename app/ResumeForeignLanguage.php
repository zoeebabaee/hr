<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class ResumeForeignLanguage extends Model
{
    public function resume()
    {
        return $this->belongsTo('HR\Resume', 'resume_id');
    }
}
