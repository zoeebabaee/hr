<?php


namespace HR;


use Illuminate\Database\Eloquent\Model;

class SupportTicketReply extends Model
{
      protected $fillable = [
        'ticket_id', 'body', 'user_id'
    ];

    public function ticket(){
        return $this->belongsTo('HR\SupportTicket', 'ticket_id');
    }

    public function user(){
        return $this->belongsTo('HR\User', 'user_id');
    }
}