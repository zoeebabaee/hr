<?php

namespace HR\Http\Controllers;

use HR\Company;
use HR\Content;
use HR\ContentCategory;
use HR\Job;
use HR\Industry;
use HR\ResumeContractType;
use HR\JobDepartment;
use HR\OthersSay;
use HR\Province;
use HR\Setting\FirstContent;
use HR\Setting\FirstPageFooter;
use HR\Setting\FirstPageSlider;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function __construct()
    {
        ini_set('memory_limit', '-1');
    }
    public function index()
    {
        
        $first_content = FirstContent::all()->first();
        $sliders = FirstPageSlider::where('status',1)->get();
        $footer = FirstPageFooter::all()->first();
        $job_sql = Job::where('status',1)
            ->where('approved',1)
            ->where('expire_date','>=',Carbon::now()->toDateTimeString());

        $jobs = $job_sql->get();

        $jobs_ids = $jobs->pluck('id')->toArray();
        $job_provinces =  DB::table('jobs')
            ->select('provinces.name')
            ->leftjoin('job_has_cities','jobs.id', '=', 'job_has_cities.job_id')
            ->leftjoin('cities','job_has_cities.city_id', '=', 'cities.id')
            ->leftjoin('provinces','provinces.id', '=', 'cities.province_id')
            ->where('provinces.name','!=',null)
            ->wherein('jobs.id',$jobs_ids)
            ->groupBy('provinces.name')->pluck('provinces.name')->toArray();

        $job_companies = DB::table('jobs')
            ->select('companies.name')
            ->leftjoin('companies','jobs.company_id', '=', 'companies.id')
            ->wherein('jobs.id',$jobs_ids)
            ->groupBy('companies.name')->pluck('companies.name')->toArray();

        $job_departments = DB::table('jobs')
            ->select('job_departments.name')
            ->leftjoin('job_departments','jobs.department_id', '=', 'job_departments.id')
            ->wherein('jobs.id',$jobs_ids)
            ->groupBy('job_departments.name')->pluck('job_departments.name')->toArray();
            
            $job_industries = DB::table('jobs')
            ->select('industries.name')
            ->leftjoin('industries','jobs.industry_id', '=', 'industries.id')
            ->wherein('jobs.id',$jobs_ids)
            ->groupBy('industries.name')->pluck('industries.name')->toArray();
            
        $active_cooperation_sql = DB::table('jobs')
                        ->select('resume_contract_types.name', DB::raw('count(*) as total'))

            ->leftjoin('resume_contract_types','jobs.cooperation_type', '=', 'resume_contract_types.id')
            ->wherein('jobs.id',$jobs_ids);
            
/*            ->pluck('resume_contract_types.name','resume_contract_types.id')->toArray();   
*/            //die(json_encode($active_cooperation));
            
        if(ContentCategory::where('title','رویدادها')->first()->status == 2)
            return null;
    
        if(\Request::route()->getName() == 'site.events.educational.index') {
            $CategoryId = array(14);
            $edu = 1;
        }
        else {
            $CategoryId = array(9, 10, 11, 14);
            $edu = 0;
        }
        
        $contents = Content::whereIn('cat_id',$CategoryId)
        ->orderByDesc('created_at')
        ->where(function($q) {
            $q->where('start_publish','<=',Carbon::now()->toDateTimeString())
                ->orWhere('start_publish', null);
        })
        ->where(function($q) {
            $q->where('end_publish','>=',Carbon::now()->toDateTimeString())
                ->orWhere('end_publish', null);
        })
        ->where('approved','1')
        ->where('status','1')
        ->where('pin_status','0')
        ->orderBy('created_at','desc')
        ->limit(10)
        ->get();;
        

        if(Auth::user()->id == 108738)  
        {
             $cooperation_type = json_decode(strip_tags(json_encode($request['cooperation_type'])));
        $province = json_decode(strip_tags(json_encode($request['province'])));
        $department = json_decode(strip_tags(json_encode($request['department'])));
        $industry = json_decode(strip_tags(json_encode($request['industry'])));
        $gender = json_decode(strip_tags(json_encode($request['gender'])));
        $company = json_decode(strip_tags(json_encode($request['company'])));
        $title = strip_tags(json_encode($request['s']));

        if (!$request['cooperation_type'][0]) $request['cooperation_type'] = null;
        if (!$request['province'][0]) $request['province'] = null;
        if (!$request['department'][0]) $request['department'] = null;
        if (!$request['industry'][0]) $request['industry'] = null;
        if (!$request['gender'][0]) $request['gender'] = null;
        if (!$request['company'][0]) $request['company'] = null;

        #GET all active jobs
        $jobs = $job_sql;
	
        //******************************************************************************************
        #Make All filters
        $all_filters = [
            'province' => $job_provinces,
            'department' => $job_departments,
            'industry' => $job_industries,
            'gender' => [1, 2],
            'company' => $job_companies,
        ];

        //******************************************************************************************
        $all_filters['cooperation_type'] = $active_cooperation_sql->pluck('name')->toArray();

        $filter_count = array();
        $cooperations = $active_cooperation_sql->pluck('name')->toArray();


        if (isset($cooperation_type) && !empty($cooperation_type) && is_array($cooperation_type)) {
            $items = array();
            array_filter($cooperation_type);
            foreach ($cooperation_type as $item) {
                if ($item)
                    $items[] = $cooperations[$item];
            }
            $jobs = $jobs->whereIn('cooperation_type', $items);
        }

        if (isset($province) && !empty($province) && is_array($province)) {
            $items = array();
            array_filter($province);
            foreach ($province as $item) {
                if ($item) {
                   /* if(count(Province::where('name', str_replace('&', '', urldecode($item)))
                        ->first()) > 0)*/
                    $items = array_merge($items, Province::where('name', str_replace('&', '', urldecode($item)))
                        ->first()
                        ->cities()
                        ->pluck('id')->toArray());

                }
            }

            $jobs = $jobs->whereHas('cities', function ($w) use ($items) {
                $w->whereIn('city_id', $items);
            });
        }

        if (isset($department) && !empty($department) && is_array($department)) {
            $items = array();
            array_filter($department);
            foreach ($department as $item) {
                if ($item)
                    $items[] = intval(JobDepartment::where('name', $item)->first()->id);
            }
            $jobs = $jobs->whereIn('department_id', $items);
        }

        if (isset($industry) && !empty($industry) && is_array($industry)) {
            $items = array();
            array_filter($industry);
            foreach ($industry as $item) {
                if ($item)
                    $items[] = intval(Industry::where('name', $item)->first()->id);
            }
            $jobs = $jobs->whereIn('industry_id', $items);
        }

        if (isset($gender) && !empty($gender) && is_array($gender)) {
            array_filter($gender);
            $tmp12 = 3;
            $genderTemp = $gender;
            $genderTemp[2] = 3;
            $jobs = $jobs->whereIn('gender', $genderTemp);
        }

        if (isset($company) && !empty($company) && is_array($company)) {
            $items = array();
            array_filter($company);
            foreach ($company as $item) {
                if ($item)
                    $items[] = intval(Company::where('name', $item)->first()->id);
            }
            $jobs = $jobs->whereIn('company_id', $items);
        }

        //******************************************************************************************
        $all_jobs_filter = $jobs->pluck('id')->toArray();
       /* $cooperations_count = DB::table('jobs')
            ->select('cooperation_type', DB::raw('count(*) as total'))
            ->wherein('jobs.id', $all_jobs_filter)
            ->groupBy('cooperation_type')
            ->pluck('total', 'cooperation_type.name')->toArray();
        
        $filter_count = array_merge($cooperations_count, $filter_count
        );*/
        //die(json_encode($filter_count));
        $filter_count = array_merge(
         $active_cooperation_sql->groupBy('cooperation_type')->pluck('total', 'cooperation_type.name')->toArray(),
            $filter_count
        );
       // die(json_encode($filter_count));
        $filter_count = array_merge(
            DB::table('jobs')
                ->select('provinces.name', DB::raw('count(jobs.id) as total'))
                ->leftjoin('job_has_cities', 'jobs.id', '=', 'job_has_cities.job_id')
                ->leftjoin('cities', 'job_has_cities.city_id', '=', 'cities.id')
                ->leftjoin('provinces', 'provinces.id', '=', 'cities.province_id')
                ->where('provinces.name', '!=', null)
                ->wherein('jobs.id', $all_jobs_filter)
                ->groupBy('name')->pluck('total', 'provinces.name')->toArray(),
            $filter_count
        );

        $filter_count = array_merge(
            DB::table('jobs')
                ->select('job_departments.name', DB::raw('count(jobs.id) as total'))
                ->leftjoin('job_departments', 'jobs.department_id', '=', 'job_departments.id')
                ->wherein('jobs.id', $all_jobs_filter)
                ->groupBy('job_departments.name')->pluck('total', 'job_departments.name')->toArray(),
            $filter_count
        );

        $filter_count = array_merge(
            DB::table('jobs')
                ->select('industries.name', DB::raw('count(jobs.id) as total'))
                ->leftjoin('industries', 'industries.id', '=', 'jobs.industry_id')
                ->wherein('jobs.id', $all_jobs_filter)
                ->groupBy('industries.name')->pluck('total', 'industries.name')->toArray(),
            $filter_count
        );

        $job_gender = DB::table('jobs')
            ->select('gender', DB::raw('count(id) as total'))
            ->wherein('jobs.id', $all_jobs_filter)
            ->groupBy('gender')
            ->pluck('total', 'gender')->toArray();

        $filter_count[1] = intval($job_gender[1]) + intval($job_gender[3]);
        $filter_count[2] = intval($job_gender[2]) + intval($job_gender[3]);

        $filter_count = array_merge(
            DB::table('jobs')
                ->select('companies.name', DB::raw('count(jobs.id) as total'))
                ->leftjoin('companies', 'companies.id', '=', 'jobs.company_id')
                ->wherein('jobs.id', $all_jobs_filter)
                ->groupBy('companies.name')->pluck('total', 'companies.name')->toArray(),
            $filter_count
        );

        $tmp = array();
        foreach ($all_filters as $key => $all_filter) {
            $tmp[$key] = array();
            foreach ($all_filter as $value) {
                $tmp[$key][$value] = $filter_count[$value];

            }
            uksort($tmp[$key], array('self', 'merchantSort'));
            $i = 0;
            foreach ($tmp[$key] as $key1 => $val) {
                if (!strpos(urldecode($_SERVER['QUERY_STRING']), $key1))
                    break;
                $i++;
            }
            $tmp2 = array_slice($tmp[$key], 0, $i);
            $tmp3 = array_slice($tmp[$key], $i);
            arsort($tmp2);
            arsort($tmp3);
            $tmp[$key] = array_merge($tmp2, $tmp3);
        }
        $all_filters = $tmp;
        $tmp10 = array();
        foreach ($all_filters['gender'] as $key => $val)
            $tmp10[$key + 1] = $val;
        $all_filters['gender'] = $tmp10;

        //******************************************************************************************
        if (isset($request['s'])) {
            $s = strip_tags($request['s']);
            $searchResult = Job::job_search($s)->pluck('id')->toArray();
            $jobs = $jobs->whereIn('id', $searchResult);
        }
        //die(json_encode($jobs));
// where('name', 'like', '%'.$s.'%');
        $job_count = $jobs->count();
        if (isset($request['sortby'])) {
            if ($request['sortby'] == 'newest') {
                $jobs = $jobs->orderBy('pin_status', 'desc')->orderBy('created_at', 'desc')->paginate(12);
            } else {
                $jobs = $jobs->orderBy('pin_status', 'desc')->orderBy('visit_count', 'desc')->paginate(12);
            }
        } else {
            $jobs = $jobs->orderBy('pin_status', 'desc')
                ->orderBy('created_at', 'desc')->paginate(12);
        }
        $provincesNames = array();
        foreach ($jobs as $job) {

            $cities = $job->cities;

            $result = array();
            foreach ($cities as $city) {
                $result[$city->province->name] = 1;
            }
            $result = array_keys($result);
            if (count($result) == Province::all()->count()) {
                $provincesNames[$job->id] = 'کل کشور';
                continue;
            }

            if (count($result) > 1) {
                $provincesNames[$job->id] = 'شهرهای متعدد';
                continue;
            }

            $result = implode($result, ' ،');
            $provincesNames[$job->id] = $result;

        }
            
                return view('site.pages.new_home',compact(['jobs','all_filters','first_content','sliders','footer','job_provinces','job_companies','job_departments','contents']));
        }

        return view('site.pages.home',compact(['jobs','first_content','sliders','footer','job_provinces','job_companies','job_departments','contents']));
    }
    
    private static function merchantSort($a, $b)
    {

        if (!strpos(urldecode($_SERVER['QUERY_STRING']), $a) && strpos(urldecode($_SERVER['QUERY_STRING']), $b))
            return 1;
        if (strpos(urldecode($_SERVER['QUERY_STRING']), $a) && !strpos(urldecode($_SERVER['QUERY_STRING']), $b))
            return 0;
        if (strpos(urldecode($_SERVER['QUERY_STRING']), $a) && strpos(urldecode($_SERVER['QUERY_STRING']), $b))
            return 0;
        if (!strpos(urldecode($_SERVER['QUERY_STRING']), $a) && !strpos(urldecode($_SERVER['QUERY_STRING']), $b))
            return 0;


    }
}
