<?php

namespace HR\Mail;

use HR\Apply;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplyRejectByAdminAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $apply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Apply $apply)
    {
        $this->apply = $apply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('سامانه منابع انسانی گلرنگ‌ :: رد درخواست')
            ->view('emails.applies.reject');
    }
}
