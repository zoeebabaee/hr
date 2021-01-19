<?php

namespace HR\Console\Commands;

use \HR\Job;
use \HR\Jobs\SendJobExpirationAlert;
use HR\Mail\JobExpirationAlert;
use HR\Mail\NewJobExpirationAlert;
use HR\User;
use HR\UserProfile;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;



class job_expiration_alert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:expiration_alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send alert when a job will expire soon.';

    /**
     * send alert when X day remaining to expire job.
     *
     * @var $days_to_expire
     */
    protected $days_to_expire;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->days_to_expire = 1;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    /*public function handle()
    {
        #a day we send alert for

        $goal_day = Carbon::now()->timezone('Asia/Tehran')->addDay($this->days_to_expire)->toDateString();
        $this->info("Checking jobs will expire in: ".$goal_day." ...");
        $jobs = Job::where('expire_date','>=',$goal_day.' 00:00:00')
            ->where('expire_date','<=', $goal_day.' 23:59:59')
            ->where('status',1)->get();

        if($jobs->count() == 0)
        {
            $this->info("There is no jobs will expire in: ".$goal_day);
            return 0;
        }else{
            $this->info($jobs->count()." jobs find!");
            foreach ($jobs as $job){
                $this->info("Email send for job ".$job->id);
                $email = new JobExpirationAlert($job);

                if(strtolower($job->creator->email) != strtolower('Eyvazi.Farzaneh@Golrang.com'))
                    Mail::to($job->creator->email)->cc(['Eyvazi.Farzaneh@Golrang.com'])->send($email);
                else
                    Mail::to($job->creator->email)->send($email);

            }
        }

    }*/

    public function handle()
    {
        #a day we send alert for

        $goal_day = Carbon::now()->timezone('Asia/Tehran')->addDay($this->days_to_expire)->toDateString();
        $this->info("Checking jobs will expire in: ".$goal_day." ...");
         $jobs = Job::where('expire_date','>=',$goal_day.' 00:00:00')
            ->where('expire_date','<=', $goal_day.' 23:59:59')
            ->where('status',1)->get();

        if($jobs->count() == 0)
        {
            $this->info("There is no jobs will expire in: ".$goal_day);
            return 0;
        }else{
            $this->info($jobs->count()." jobs find!");
            foreach ($jobs as $job){
                $jobid = $job->id;
                $this->info("Email send for job ".$job->id);
                //it is just for golrang system
                if($job->company()->first()->id == 1)
                {
                    $admin_detail = User::where('id',34)->first(); //hard code
                    $email = new NewJobExpirationAlert($job,$admin_detail);

                   // Mail::to('Eyvazi.Farzaneh@Golrang.com')->send($email);
                    Mail::to(['Taheri.Amir@Golrang.com'])->cc(['Eyvazi.Farzaneh@Golrang.com'])->send($email);

                    // todo 
                    Storage::append('mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> admin => eyvazi for job '.$jobid );
                }

                else{



                  /*  $all_admins = $job->company()->first()->users()
                        ->join('model_has_roles','model_has_roles.model_id','users.id')
                        ->whereIn('model_has_roles.role_id', [15, 16]) // admin , admine mashaghel

                        ->pluck('user_id')->toArray();*/
                        
                        $company_id = $job->company()->first()->id;
                        
                       $all_admins = DB::table('user_has_companies')
                     // ->leftjoin('BI_user_status','user_has_companies.user_id','BI_user_status.user_id')
                      ->join('model_has_roles','user_has_companies.user_id','model_has_roles.model_id')
                      ->where('user_has_companies.company_id',$company_id)->wherein('role_id',[15,16])
                      ->pluck('user_has_companies.user_id')->toArray();
                      foreach($all_admins as $admin)
                      {
                       $this->info($admin);
                      }

                    if(!empty($all_admins))
                    {

                        $admins = [];
                        foreach ($all_admins as $admin)
                        {
                            $national_code = UserProfile::where('user_id',$admin)->first()->national_code;
                            $check_status  = json_decode(file_get_contents('http://172.31.2.18/PersonnelStatus/GetState?MeliCode='.$national_code))->Status;
                            if($check_status == 'فعال')
                                $admins[] = $admin;
                            else
                                continue;

                        }

                        $creator = $job->creator()->first()->id;
                        if(in_array($creator, $admins)){
                            $creator_detail = User::where('id',$creator)->first();
                            if(strlen($creator_detail->email) > 3)
                            {
                                $email = new NewJobExpirationAlert($job,$creator_detail);

                                Mail::to($creator_detail->email)->send($email);
                                //todo  
                                Storage::append('mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> creator => '.$creator_detail->email.' for job '.$jobid );
                            }
                            else
                                Storage::append('not_exist_mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> creator1 => '.$creator.' for job '.$jobid );


                        }

                        else
                        {
                            if(count($admins) > 1)
                            {
                                foreach ($admins as $admin)
                                {
                                    $admin_detail = User::where('id',$admin)->first();
                                    if(strlen($admin_detail->email) > 3)
                                    {
                                        $email = new NewJobExpirationAlert($job,$admin_detail);

                                        Mail::to($admin_detail->email)->send($email);
                                        //todo
                                        Storage::append('mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> admin => '.$admin_detail->email.' for job '.$jobid );

                                    }
                                    else
                                        Storage::append('not_exist_mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> admin2 => '.$admin_detail->email.' for job '.$jobid );






                                }
                            }
                            else if(count($admins) == 1){
                                $admin_detail = User::where('id',$admins)->first();
                                if(strlen($admin_detail->email) > 3)
                                {
                                    $email = new NewJobExpirationAlert($job,$admin_detail);

                                     Mail::to($admin_detail->email)->send($email);
                                    //todo
                                    Storage::append('mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> admin => '.$admin_detail->email.' for job '.$jobid );
                                }
                                else
                                {
                                    Storage::append('not_exist_mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> admin3 => '.json_encode($admins).' for job '.$jobid );

                                }




                            }
                            else   {

                                /*$admin_detail = User::where('id',34)->first(); //hard code
                                $email = new NewJobExpirationAlert($job,$admin_detail);

                                Mail::to('Eyvazi.Farzaneh@Golrang.com')->send($email);
                                // todo 
                                Mail::to('zoeejoon@gmail.com')->send($email);*/
                                Storage::append('mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> admin => this job has not admin '.$jobid );

                            }



                        }
                    }
                    else
                    {

                        /*$admin_detail = User::where('id',34)->first(); //hard code
                        $email = new NewJobExpirationAlert($job,$admin_detail);

                        Mail::to('Eyvazi.Farzaneh@Golrang.com')->send($email);
                        // todo 
                        Mail::to('zoeejoon@gmail.com')->send($email);*/
                        Storage::append('mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> admin => this job has not admin '.$jobid );

                    }

                }
            }
        }

    }

}