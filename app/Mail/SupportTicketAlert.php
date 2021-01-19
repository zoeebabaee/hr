<?php

namespace HR\Mail;

use HR\SupportTicket;
use HR\Job;
use HR\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupportTicketAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $user;
  

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SupportTicket $ticket,User $user)
    {
        $this->ticket = $ticket;
        $this->user = $user;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
            $ticket = $this->ticket;
            if($this->user->hasRole('سوپرادمین'))
            
            return $this->subject('تیکت جدید')
            ->view('emails.support_ticket.ticket_alert_superadmin',compact(['ticket']));
            
            else
            
            return $this->subject('کاربر تیکت جدید')
            ->view('emails.support_ticket.ticket_alert_user',compact(['ticket']));
        
    }
}

