<?php


namespace HR\Http\Controllers\personnelapi;


use HR\ApiModel\Login;
use HR\City;
use HR\Http\Controllers\Controller;
use HR\Province;
use HR\Resume;
use HR\ResumeWorkExperience;

class update_work_experienceController extends Controller
{

    public function __construct()
    {

    }
   public function update_years()
   {
       $resumes = Resume::where('work_experience_years',0)->get();
       foreach ($resumes as $resume)
       {
           $experiences = ResumeWorkExperience::where('resume_id',$resume->id)->get();
           $total=0;
           foreach($experiences as $experience)
           {
               if(is_null($experience->end_date))
                   $enddate = $experience->updated_at ;
               else
                   $enddate = $experience->georgian_end_date;

               if(is_null($experience->start_date))
                   continue;
               else
                   $startdate = $experience->georgian_start_date;
               $date1=date_create($startdate);
               $date2=date_create($enddate);
               $diff=date_diff($date1,$date2);
               $diff_date = $diff->format("%R%a");
               if (strpos($diff_date, '-') !== false)
                   continue;
               else
                   $total +=$diff->format("%a");
           }
           $total = $total/365;
           \DB::table('resumes')
               ->where('id', $resume->id)
               ->update(array('work_experience_years' => $total));

       }

   }
}