<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $fillable = [
        'ticket_id', 'body', 'user_id'
    ];

    public function ticket(){
        return $this->belongsTo('HR\Ticket', 'ticket_id');
    }

    public function user(){
        return $this->belongsTo('HR\User', 'user_id');
    }
}
