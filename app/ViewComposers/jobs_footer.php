<?php
namespace HR\ViewComposers;

use Carbon\Carbon;
use HR\Content;
use HR\ContentCategory;
use HR\Job;

class jobs_footer{
    public static function index()
    {
        #check Approved
        $job=Job::where('approved',1);
        #check status
        $job->where('approved',1);
        #check expire date
        $job->where('expire_date','>=',Carbon::now()->toDateTimeString());
        #order by id
        $job->orderBy('pin_status', 'desc')
            ->orderBy('sort_order','desc')
            ->orderBy('id', 'desc');
        #limit 10
        $job->limit(4);

        return $job;
    }
}
