<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    protected $fillable = [
        'from', 'to', 'msg', 'type'
    ];

    public function sender(){
        return $this->belongsTo('HR\User', 'from');
    }

    public function reciever(){
        return $this->belongsTo('HR\User', 'to');
    }

    public static function send($from, $to, $msg, $type){
        return Talk::create([
            'from'  =>  $from,
            'to'    =>  $to,
            'msg'   =>  $msg,
            'type'  =>  $type,
        ]);
    }
}
