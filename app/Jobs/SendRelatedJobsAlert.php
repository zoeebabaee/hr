<?php

namespace HR\Jobs;

use HR\Mail\RelatedJobsAlert;
use HR\myFuncs;
use HR\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;


class SendRelatedJobsAlert implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user;
    public $timeout = 60;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->user->profile && myFuncs::check_worker_state($this->user->profile->national_code ) != 'فعال') {
            $email = new RelatedJobsAlert($this->user);
            Mail::to($this->user->email)->send($email);
        }
    }
}
