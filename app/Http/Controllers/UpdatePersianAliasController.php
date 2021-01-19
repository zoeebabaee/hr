<?php


namespace HR\Http\Controllers;


use HR\Company;
use HR\Job;
use HR\User;
use Illuminate\Support\Facades\DB;

class UpdatePersianAliasController extends Controller
{
    public function index()
    {
        $jobs =  DB::table('jobs')->where('id','>=',1090)->get();

        foreach ($jobs as $job)
        {

            $company_info = Company::where('id',$job->company_id)->first();
            //$company_status = $company_info->flag;
            $company_name =  str_replace(array(' ', '/'), array('-', '-'), $company_info->name);
            $post_title = str_replace(array(' ', '/'), array('-', '-'),$job->title);



            $persian_alias = $company_name.'_'.$post_title.'_'.explode(' ',$job->created_at)[0];



            $affected = DB::table('jobs')
                ->where('id', $job->id)
                ->update(array('persian_alias' => $persian_alias));
            if($affected == 0)
                die($job->id.'***');

        }

    }
}