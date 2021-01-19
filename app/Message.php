<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    public function sender_user()
    {
        return $this->belongsTo('HR\User','sender','id');
    }

    public function receiver_user()
    {
        return $this->belongsTo('HR\User','receiver');
    }

    protected $fillable=[
        'sender','receiver','title','subject','body','attachment'
        ];

    protected $dates = ['deleted_at'];
}
