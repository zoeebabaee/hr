<?php

namespace HR\Console\Commands;

use HR\Jobs\SendRelatedJobsAlert;
use HR\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;


class users_related_jobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:related_jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send related jobs to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::where('email','!=',null)
            ->where('is_email_verified', null)->get();
        foreach ($users as $user) {
                Storage::append('users_related_job.txt', "\n   ".$user);

                if(User::related_jobs($user)->count())
                SendRelatedJobsAlert::dispatch($user)->onQueue('send_related_jobs');
        }
    }
}
