<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class JobQuestionAnswer extends Model
{

    public function question()
    {
        return $this->belongsTo('HR\JobQuestions', 'question_id');
    }

    public function apply(){
        return $this->belongsTo('HR\Apply', 'apply_id');
    }

}
