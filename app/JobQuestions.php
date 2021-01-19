<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class JobQuestions extends Model
{
    protected $fillable=[
        'question', 'job_id'
    ];

    public function job()
    {
        return $this->belongsTo('HR\Job', 'job_id');
    }

    public function question()
    {
        return $this->hasOne('HR\JobQuestionAnswer', 'question_id');
    }
}
