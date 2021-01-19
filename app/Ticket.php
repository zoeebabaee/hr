<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'status', 'priority', 'subject', 'body',
        'user_id', 'company_id','created_by'
    ];

    public function user(){
        return $this->belongsTo('HR\User', 'user_id');
    }

    public function company(){
        return $this->belongsTo('HR\Company', 'company_id');
    }

    public function creator(){
        return $this->belongsTo('HR\User', 'created_by');
    }

    public function replies()
    {
        return $this->hasMany('HR\TicketReply','ticket_id');
    }
}
