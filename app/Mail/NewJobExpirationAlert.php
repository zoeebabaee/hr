<?php

namespace HR\Mail;

use HR\Job;
use HR\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewJobExpirationAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $job;
    public $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Job $job,User $admin)
    {
        $this->job   = $job;
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $admin = $this->admin;
        return $this->subject('اطلاعیه انقضای آگهی')
            ->view('emails.jobs.expiration_alert',compact(['admin']));
    }
}