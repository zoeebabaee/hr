<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class UserComment extends Model
{
    protected $fillable = [
        'comment', 'user_id', 'admin_id', 'job_id'
    ];

    public function user(){
        return $this->belongsTo('HR\User','user_id','id');
    }

    public function admin(){
        return $this->belongsTo('HR\User','admin_id','id');
    }

    public function job(){
        return $this->belongsTo('HR\Job','job_id','id');
    }

}
