<?php

namespace HR\Http\Controllers;

use Carbon\Carbon;
use HR\Apply;
use HR\Company;
use HR\ContactUS;
use HR\Content;
use HR\Gallery;
use HR\Job;
use HR\Ticket;
use HR\TicketReply;
use HR\User;
use HR\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class adminHomeController extends Controller
{
    public function __construct() {
        /**
         * Only Admins Can See
         *
         */
        $this->middleware(['auth', 'isAdmin']);
    }

    public function index()
    {
        $now = Carbon::now()->timezone('Asia/Tehran')->toDateTimeString();
        $users_count = User::myUsers()->count();

        $users_count_today = User::myUsers()->where('created_at','>=',Carbon::today()->timezone('Asia/Tehran')->toDateTimeString())->count();
        $jobs_count = Job::myJobs()->where('approved', 1)->where('status', 1)
            ->where('expire_date', '>=', $now)->count();
        $all_jobs_count = Job::myJobs()->whereIn('company_id', Company::myCompanies()->pluck('id')->toArray())->count()-1;
        $applies_count = Apply::all()->whereIn('job_id',Job::myJobs()->pluck('id')->toArray())->count();

        $applies_accept_count = Apply::all()
            ->where('status','2')
            ->whereIn('job_id',Job::myJobs()->pluck('id')->toArray())
            ->count();

        $resumes_count = User::myUsers()->WhereHas('resume',function ($q){
            $q->where('id','>=',1);
        })->count();
        $contents_not_accept_count = Content::myContents()->where('approved',0)->count();
        $images_not_accept_count = Gallery::myGallery()->where('approved','!=',1)->count();
        $Jobs_not_accept_count = Job::myJobs()->where('approved','!=',1)->count();
        $contact_us_count = ContactUS::where('read',0)->count();

        $three_month_ago = Carbon::now()->timezone('Asia/Tehran')->subMonth(3)->toDateTimeString();

        $chart_user_in_week_days = DB::select("SELECT WEEKDAY(created_at) as wd, COUNT(*) as user_count FROM users WHERE created_at > '$three_month_ago' GROUP by wd");
        $chart_Company_jobs = DB::table('jobs')
            ->leftJoin('companies','jobs.company_id', '=', 'companies.id')
            ->select(DB::raw('count(jobs.id) as job_count'), 'companies.name')
            ->where('jobs.approved', 1)->where('jobs.status', 1)
            ->where('jobs.expire_date', '>=',Carbon::now('Asia/Tehran')->toDateString().' 00:00:00')->where('jobs.deleted_at',null)
            ->groupBy('companies.id')->orderByDesc('job_count')->get();
//        dd($chart_Company_jobs);



        $company_applies = DB::table('companies')
            ->rightJoin('jobs', function ($join){
                $join->on('jobs.company_id', '=', 'companies.id');
            })
            ->rightJoin('applies', function ($join){
                $join->on('applies.job_id', '=', 'jobs.id');
            })
            ->select(
                'companies.name',
                DB::raw("COUNT('applies.id') as applies_count")
            )->where('jobs.status', 1)
            ->where('jobs.approved', 1)
            ->where('jobs.expire_date', '>=', $now)
            ->where('jobs.deleted_at',null)
            ->where('applies.deleted_at',null)
            ->where('companies.id','!=', null)
            ->groupBy('companies.id')->get();

        $company_applies_no_answer = DB::table('companies')
            ->rightJoin('jobs', function ($join) {
                $join->on('jobs.company_id', '=', 'companies.id');
            })
            ->rightJoin('applies', function ($join){
                $join->on('applies.job_id', '=', 'jobs.id');
            })
            ->select(
                'companies.name',
                DB::raw("COUNT('applies.id') as applies_count")
            )->where('companies.id','!=', null)
            ->where('applies.status','<=',1)->where('jobs.approved', 1)
            ->where('jobs.status', 1)
            ->where('jobs.expire_date', '>=', $now)
            ->where('jobs.deleted_at',null)
            ->where('applies.deleted_at',null)
            ->groupBy('companies.id')->get()->pluck('applies_count','name')->toArray();

        foreach ($company_applies as $company_apply){
            $company_apply->answered_percent = ($company_apply->applies_count - $company_applies_no_answer[$company_apply->name])/$company_apply->applies_count*100;
        }
        $company_applies = $company_applies->sortByDesc('answered_percent');

        $tickets_state = [
            'user_reply'=>Ticket::where('status','user_reply')->count(),
            'on_hold'=>Ticket::where('status','on_hold')->count(),
            'answered'=>Ticket::where('status','answered')->count(),
            'in_progress'=>Ticket::where('status','in_progress')->count(),
            'closed'=>Ticket::where('status','closed')->count(),
        ];
        $all_tickets = Ticket::all()->count();

        $applies_state = [
            'درخواست بررسی نشده' => [Apply::where('status', 1)->count(),'rgba(248, 172, 89, 1)'],
            'لیست برگزیده' =>[Apply::where('status', 4)->count(),'rgba(26, 179, 148, 1)'],
            'لیست نامتناسب' =>[Apply::where('status', 3)->count(),'rgba(237, 85, 101, 1)'],
            'لیست تایید نهایی' =>[Apply::where('status', 2)->count(),'rgba(0, 204, 0, 1)'],

        ];
        $all_applies = Apply::all()->count();

        $a_week_ago = Carbon::now()->timezone('Asia/Tehran')->subDay(7)->toDateTimeString();
        $all_users_this_week = User::where('created_at', '>', $a_week_ago)->count();

        $users_companies = DB::table('users')->rightJoin('companies',function ($join){
            $join->on('companies.id','=','users.referrer_company_id');
        })->select('companies.name as company_name' , DB::raw('Count("users.id") as user_count'))
            ->where('users.created_at', '>', $a_week_ago)->groupBy('companies.id')->get();

        $users_companies = $users_companies->sortByDesc('user_count');

        $best_companies_in_apply_answered = $company_applies->sortByDesc('answered_percent')->slice(0,3);

        $tickets_company = DB::table('tickets')
            ->rightJoin('companies',function ($join){
                $join->on('companies.id','=','tickets.company_id');
            })
            ->select(
                'companies.id',
                'companies.name as company_name',
                'tickets.status',
                DB::raw('COUNT(tickets.id) as t_count')
            )->where('tickets.status','!=',null)->groupby('companies.id')->groupBy('tickets.status')->get();

        $tmp = array();
        foreach ($tickets_company as $item){
            $tmp[$item->id][$item->status] = $item->t_count;
            $tmp[$item->id]['name'] = $item->company_name;
            $tmp[$item->id]['company_id'] = $item->id;
            $tmp[$item->id]['all_tickets'] = isset($tmp[$item->id]['all_tickets'])? $tmp[$item->id]['all_tickets'] +  $item->t_count : $item->t_count ;
        }

        $tmp = array_values($tmp);

        foreach ($tmp as $item){
            $item['average'] = (intval($item['all_tickets'] ) - intval($item['user_reply'])) / $item['all_tickets'] * 100;
            $tmp[] = $item;
        }

        $tickets_company = collect($tmp)->sortByDesc('average')->slice(0,3);

        $today = Carbon::now()->timezone('Asia/Tehran')->toDateString();

        $users_inputs_companies = DB::table('users')->rightJoin('companies',function ($join){
            $join->on('companies.id','=','users.referrer_company_id');
        })->select('companies.name as company_name' , DB::raw('Count("users.id") as user_count'))
            ->where(DB::raw('DATE(users.created_at)'), '=', $today)->groupBy('companies.id')->get();

        $users_referer = DB::table('resumes')->select(
            'referer',
            DB::raw('Count(id) as user_count')
        )->where('referer',">=",'1')->where('referer',"<=",'9')->groupBy('referer')->orderByDesc('user_count')->get();
        $total_users_have_referer = 0;
        foreach ($users_referer as $item)
            $total_users_have_referer+=$item->user_count;

        $resume_industries = DB::table('resume_has_industries')->leftJoin('industries', 'resume_has_industries.industry_id', '=', 'industries.id')
            ->select('industries.name', DB::raw('COUNT("resume_has_industries.id") as count'))->where('industries.deleted_at',null)->groupBy('industries.id')->orderByDesc('count')->get();

        $user_forms = [
            'فرم اول' => User::where('complete_percent',15)->orWhere('complete_percent',31)->count(),
            'فرم تکمیلی' => User::where('form_2',1)->count()
        ];

        $unread_messages = DB::table('talks')
            ->select('id', 'from', 'to', 'seen', DB::raw('count(id) as message_count'))
            ->where(function ($w){
                $w->where('to', auth()->user()->id)->orWhere('to', null);
            })
            ->where('seen', 0)
            ->count();

        return view('admin.home',compact([
            'users_count','jobs_count','applies_count','applies_accept_count','resumes_count','contents_not_accept_count','tickets_state', 'all_tickets', 'all_applies', 'applies_state',
            'Jobs_not_accept_count', 'contact_us_count','images_not_accept_count', 'users_count_today', 'chart_user_in_week_days','chart_Company_jobs','company_applies',
            'all_users_this_week', 'users_companies','best_companies_in_apply_answered','tickets_company','users_inputs_companies','users_referer','total_users_have_referer'
            ,'resume_industries', 'user_forms','company_applies_no_answer','unread_messages','all_jobs_count'
        ]));
    }

}