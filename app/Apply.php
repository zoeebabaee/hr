<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


class Apply extends Model
{
    use SoftDeletes;

    public function job(){
        return $this->belongsTo('HR\Job','job_id');
    }

    public function user(){
        return $this->belongsTo('HR\User','user_id');
    }

    public function answers(){
        return $this->hasMany('HR\JobQuestionAnswer', 'apply_id');
    }

    public function reason(){
        return $this->belongsTo('HR\RejectReasons','reject_reason');
    }

    public function ticket_reply_from_admin(){
        $ticket_id = Ticket::where('user_id',$this->user_id)
            ->where('job_id',$this->job->id)
            ->where('status','answered')
            ->first()->id;
        return ($ticket_id)?$ticket_id:0;
    }
    public function user_ticket(){
        $ticket_id = Ticket::where('user_id',$this->user_id)
            ->where('job_id',$this->job->id)
            ->first()->id;

        return ($ticket_id)?$ticket_id:0;
    }
    public function ticket_reply_from_user(){
        $ticket_id = Ticket::where('user_id',$this->user->id)
            ->where('job_id',$this->job->id)
            ->where('status','user_reply')
            ->first()->id;
        return ($ticket_id)?$ticket_id:0;
    }

    public static function totalcount()
    {
        $result = 0;
        foreach(Auth::user()->applies as $apply)
            if($apply->job)
                $result++;
        return $result;
    }

    public function cities()
    {
        return $this->belongsToMany('HR\City',
            'apply_has_cities',
            'apply_id', 'city_id')
            ->withTimestamps();
    }

    protected $dates = ['deleted_at'];
}
