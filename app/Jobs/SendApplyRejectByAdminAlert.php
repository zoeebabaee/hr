<?php

namespace HR\Jobs;

use HR\Apply;
use HR\Mail\ApplyRejectByAdminAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendApplyRejectByAdminAlert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $apply;
    public $timeout = 60;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Apply $apply)
    {
        $this->apply = $apply;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new ApplyRejectByAdminAlert($this->apply);
        Mail::to($this->apply->user->email)->send($email);
    }
}
