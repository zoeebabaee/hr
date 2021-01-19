<?php

namespace HR\Http\Controllers;

use Carbon\Carbon;
use HR\ApiModel\FieldType;
use HR\City;
use HR\Company;
use HR\Industry;
use HR\Job;
use HR\UserProfile;
use HR\JobDepartment;
use HR\JobGeneralMerites;
use HR\JobOrganizationalCategory;
use HR\JobPost;
use HR\JobProfessionalMerites;
use HR\JobQuestions;
use HR\myFuncs;
use HR\Province;
use HR\ResumeContractType;
use HR\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
//use MongoDB\Driver\Session;
use p3ym4n\JDate\JDate;
use HR\User;
use HR\CurlFuncs;
use HR\CurlImpersonated;
use Symfony\Component\HttpFoundation\Session\Session;
use HR\Mail\ApproveJobAlert;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;



class JobController extends Controller
{

    public function __construct()
    {
        /**
         * Degrees DB table replace with config('app.enum_degrees')
         * 97-11-17
         * @author M.Mahdavi Kia
         * @global $this->degrees_array
         */
        $this->degrees_array = array();
        $Degrees = DB::table('degrees')->get();
        foreach($Degrees as $deg){
            $this->degrees_array[$deg->id] = $deg->name;
        }

        $this->middleware([
            'auth', 'isAdmin'
        ])
            ->except(
                'show',
                'site_index',
                'GetCities', 'favorite'
            );
        $this->middleware(['auth'])->only(
            'favorite'
        );
        ini_set('memory_limit', '-1');
    }

   /* public function index()
    {

        $jobs = Job::myJobs();

        if (request('professionalMerit') && !empty(request('professionalMerit'))) {
            $ptr = request('professionalMerit');
            $jobs->whereHas('job_professional_merites', function ($w) use ($ptr) {
                $w->where('professional_merites_id', $ptr);
            });
        }

        if (request('title') && !empty(request('title'))) {
            $jobs->where('title', 'like', '%' . request('title') . '%');
        }

        if (((request('approved') != null))) {
            $jobs->where('approved', request('approved'));
        }


        if (request('post_id') && !empty(request('post_id'))) {
            $jobs->where('post_id', request('post_id'));
        }

        if (request('company_id') && !empty(request('company_id'))) {
            $selected_company = request('company_id');
            $jobs->where('company_id', request('company_id'));
          //  die(request('company_id').'***');
        }

        if (request('department_id') && !empty(request('department_id'))) {
            $selected_department = request('department_id') ;
            $jobs->where('department_id', request('department_id'));
        }

        $jobs = $jobs->orderBy('status', 'asc')
            ->orderBy('expire_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(50);
        $orgs = JobOrganizationalCategory:a:all();
        $departments = JobDepartment::all();
        $provinces = Province::all();
        $post = JobPost::all();
        $companies = Company::all();
        $query_string = (parse_url(URL::full())['query']) ? '?' . parse_url(URL::full())['query'] : null;
        return view('admin.jobs.index', compact(['jobs', 'orgs', 'departments', 'provinces', 'companies', 'post', 'query_string','selected_company','selected_department']));
    }*/
    
    public function index()
    {
        if(intval(request('extended_job'))){

            $jobs = Job::where('id',intval(request('id')))->get();
            $extended = 1;
            //die($jobs);
        }
        if((\session('admin_extended_job'))){

            $jobs = Job::where('id',intval(request('id')))->get();
//            $admin_extended_job = \session('admin_extended_job');
            $admin_extended_job = 1;
            //die($jobs);
        }
        else {
            $admin_extended_job = 0;
            $extended = 0;
            $jobs = Job::myJobs();

            if (request('professionalMerit') && !empty(request('professionalMerit'))) {
                $ptr = request('professionalMerit');
                $jobs->whereHas('job_professional_merites', function ($w) use ($ptr) {
                    $w->where('professional_merites_id', $ptr);
                });
            }

            if (request('title') && !empty(request('title'))) {
                $jobs->where('title', 'like', '%' . request('title') . '%');
            }

            if (((request('approved') != null))) {
                $jobs->where('approved', request('approved'));
            }


            if (request('post_id') && !empty(request('post_id'))) {
                $jobs->where('post_id', request('post_id'));
            }

            if (request('company_id') && !empty(request('company_id'))) {
                $selected_company = request('company_id');
                $jobs->where('company_id', request('company_id'));
                //  die(request('company_id').'***');
            }

            if (request('department_id') && !empty(request('department_id'))) {
                $selected_department = request('department_id');
                $jobs->where('department_id', request('department_id'));
            }


            $jobs = $jobs->orderBy('status', 'asc')
                ->orderBy('expire_date', 'desc')
                ->orderBy('created_at', 'desc')
                ->paginate(50);
        }
        $orgs = JobOrganizationalCategory::all();
        $departments = JobDepartment::where('data_id',0)->get();
        $provinces = Province::all();
        $post = JobPost::all();
        $companies = Company::all();
        $query_string = (parse_url(URL::full())['query']) ? '?' . parse_url(URL::full())['query'] : null;
        return view('admin.jobs.index', compact(['extended','admin_extended_job','jobs', 'orgs', 'departments', 'provinces', 'companies', 'post', 'query_string','selected_company','selected_department']));
    }



    public function favorite()
    {
        $id = request('id');
        if (in_array($id, Auth::user()->jobs()->pluck('job_id')->toArray())) {
            Auth::user()->jobs()->detach($id);
            return 'deleted';
        }
        Auth::user()->jobs()->attach($id);
        return 'added';
    }

    public function create()
    {
        $curls = new CurlFuncs();
        $companies = \HR\Company::get();
//        $organization_unit= (json_decode($curls::getOrganizationUnits()))->data;
        //$organization_post= (json_decode($curls::getOrganizationPost()))->data;
        $departments = JobDepartment::where('data_id',0)->get();
        $field_type_array = $results = DB::select('select * from api_education_field_types');

        $posts = JobPost::all();
        $orgs = JobOrganizationalCategory::all();
        $job_general_merites = JobGeneralMerites::all();
        $users_professional_merites = array_merge(
            array_merge(
                DB::table('resume_has_exp_expertises')->pluck('professional_merites_id')->toArray(),
                DB::table('resume_has_p_t_r')->pluck('professional_merites_id')->toArray()),
            DB::table('resume_has_com_skills')->pluck('professional_merites_id')->toArray());
        $users_professional_merites = array_unique($users_professional_merites);
        $jobs_professional_merites = array_unique(DB::table('job_has_professional_merites')
            ->pluck('professional_merites_id')->toArray());
        $blocked_professional_merites = array_diff($users_professional_merites, $jobs_professional_merites);
        $job_professional_merites = JobProfessionalMerites::whereNotIn('id', $blocked_professional_merites)->get();

        $cities = City::all();
        $industries = Industry::all();

        $Degrees = $this->degrees_array;//config('app.enum_last_degree');

        return view('admin.jobs.create',
            compact(['departments', 'posts', 'cities', 'orgs', 'job_general_merites', 'job_professional_merites', 'industries','Degrees','companies','field_type_array']));
    }

    public function companyOrganization(Request $request)
    {
        $company_id     = $request->input('id');
         $api_company = \HR\Company::where('id',$company_id)->first();
        $api_company_id = $api_company['data_id'];
        
        
        
        session()->put('gng_apply_baseurl',$api_company['gng_apply_baseurl'] );
        session()->put('gng_hr_baseurl', $api_company['gng_hr_baseurl']);
        session()->put('gng_master_baseurl',$api_company['gng_master_baseurl'] );
        session()->put('token', CurlImpersonated::impersonatedLogin($api_company_id));
        $token = session()->get('token');
        
        
        $gng_apply_baseurl = session()->get('gng_apply_baseurl');
        $gng_hr_baseurl = session()->get('gng_hr_baseurl');
        $gng_master_baseurl = session()->get('gng_master_baseurl');
        
        $baseurl = ["gng_apply_baseurl"=>$gng_apply_baseurl,"gng_hr_baseurl"=>$gng_hr_baseurl,"gng_master_baseurl"=>$gng_master_baseurl];

        
        
        //die($token);
        $organization_units = (json_decode(CurlImpersonated::companyOrganization($token,$baseurl)))->data;


        $dropdown_option='<option value="">انتخاب حوزه کاری</option>';
        foreach ($organization_units as $organization_unit)
        {
            $dropdown_option .= '<option value="'.$organization_unit->name."**".$organization_unit->id."**".$organization_unit->serialNumber.'">'.$organization_unit->name.'</option>';
        }

        echo $dropdown_option;
    }

    public function organizationPost(Request $request)
    {
        $token = session()->get('token');
        $gng_apply_baseurl = session()->get('gng_apply_baseurl');
        $gng_hr_baseurl = session()->get('gng_hr_baseurl');
        $gng_master_baseurl = session()->get('gng_master_baseurl');
        $baseurl = ["gng_apply_baseurl"=>$gng_apply_baseurl,"gng_hr_baseurl"=>$gng_hr_baseurl,"gng_master_baseurl"=>$gng_master_baseurl];
        //die($token);
        $unit_id    = $request->input('unit_id');
        $organization_posts = (json_decode(CurlImpersonated::organizationPost($token,$unit_id,$baseurl)))->data;
        $dropdown_option='<option>انتخاب پست</option>';
        foreach ($organization_posts as $organization_post)
        {
            $dropdown_option .= '<option data-personcount="'.$organization_post->personCount.'" value="'.$organization_post->postName."**".$organization_post->id."**".$organization_post->serialNumber.'">'.$organization_post->postName.'</option>';
        }

        echo $dropdown_option;
    }

    public function getField(Request $request)
    {
        $field_type_id = $request->input('id');
        $field_array = DB::select('select * from api_education_fields where api_education_field_type_id="'.$field_type_id.'"');

        $dropdown_option='<option>انتخاب رشته</option>';
	    if (count($field_array) > 0):
	        foreach ($field_array as $field)
	        {
	            $dropdown_option .= '<option value="'.$field->name.'**'.$field->id.'">'.$field->name.'</option>';
	        }
        else:
	        $dropdown_option='<option value="-">-</option>';
        endif;

        echo $dropdown_option;
    }

    public function getOrientation(Request $request)
    {
        $field_id = $request->input('id');
        $orientation_array = DB::select('select * from  api_education_orientations where api_education_field_id="'.$field_id.'"');

        $dropdown_option='<option>گرایش</option>';
        foreach ($orientation_array as $orientation)
        {
            $dropdown_option .= '<option value="'.$orientation->id.'">'.$orientation->name.'</option>';
        }

        echo $dropdown_option;
    }

    public function getInactiveCompanyMerits()
    {
        $general_merit_array      = JobGeneralMerites::get();
        $professional_merit_array = JobProfessionalMerites::get();

        $general_option='';
        foreach ($general_merit_array as $general_merit)
        {
            $general_option .= '<option value="'.$general_merit->id.'">'.$general_merit->name.'</option>';
        }

        $professional_option='';
        foreach ($professional_merit_array as $professional_merit)
        {
            $professional_option .= '<option value="'.$professional_merit->id.'">'.$professional_merit->name.'</option>';
        }

        $res[] =['general' => $general_option , 'professional'=>$professional_option];

        echo json_encode($res);
    }

    public function getActiveCompanyMerits(Request $request)
    {
        $token   = session()->get('token');
        $gng_apply_baseurl = session()->get('gng_apply_baseurl');
        $gng_hr_baseurl = session()->get('gng_hr_baseurl');
        $gng_master_baseurl = session()->get('gng_master_baseurl');
        $baseurl = ["gng_apply_baseurl"=>$gng_apply_baseurl,"gng_hr_baseurl"=>$gng_hr_baseurl,"gng_master_baseurl"=>$gng_master_baseurl];
        $post_id = $request->input('post_id');
        
        $merit_array = (json_decode(CurlImpersonated::merites($token , $post_id,$baseurl)))->data;

        $general_option='<option>انتخاب شایستگی عمومی</option>';
        $professional_option='<option>انتخاب شایستگی تخصصی</option>';
        foreach ($merit_array as $merit)
        {
            if($merit->postMeritTypeCode == 1)
                $general_option .= '<option value="'.$merit->postMeritCodeName.'**'.$merit->postMeritCode.'">'.$merit->postMeritCodeName.'</option>';
            else if($merit->postMeritTypeCode == 2)
                $professional_option .= '<option value="'.$merit->postMeritCodeName.'**'.$merit->postMeritCode.'">'.$merit->postMeritCodeName.'</option>';
        }


        $res[] =['general' => $general_option , 'professional'=>$professional_option];

        echo json_encode($res);
    }

    public function store(Request $request)
    {
        if ($request['apply_limit'] != '') {
            $this->validate($request, [
                'apply_limit' => 'integer'
            ]);
        }
        $this->validate($request, [
            'alias' => 'required|string',
            'pin_status' => 'required|integer|min:0|max:1',
           // 'department' => 'required',
            'min_education' => 'integer|max:10',
            //'post' => 'required|string',
            'main_responsibilities' => 'required|string',
            'cooperation_type' => 'integer|min:1',
            'gender' => 'integer|min:1|max:3',
            'company' => 'integer|exists:companies,id',
            'city_id' => 'required|array|min:1',
            'industry_id' => 'integer',
            'status' => 'integer|min:1|max:3',
            'images' => 'nullable|string',
            'jobExp' => 'nullable|string',
            //'field' => 'nullable|string',
            'goal_or_mission' => 'required|string',
            'skill_1' => 'required|array|min:1|max:100',
            'skill_2' => 'required|array|min:1|max:100',
            'questions' => 'sometimes|required|array|min:1|max:100',
            'questions.*.question' => 'sometimes|required|string|max:255',
            'expire_date' => 'sometimes|persian_date:Y-m-d',
        ]);
        $job = new Job();
        $company = Company::where('id',$request['company'])->first();
        $company_status = $company->flag;
        $post_and_id = explode('**',$request['api_post']);
        $department_and_id = explode('**',$request['api_department']);

        if($company_status == 1)
        {
            $post_title = $post_and_id[0];
            $job->title = $post_title;
            
            $check_job_department_using_title_sql = JobDepartment::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $department_and_id[0]));
            if ($check_job_department_using_title_sql->count() == 0) {
            $check_job_department_using_serialnumber_sql = JobDepartment::where('data_serial_number',$department_and_id[2]);
                if($check_job_department_using_serialnumber_sql->count() > 0)
                {
                    //updte
                    $department_id = $check_job_department_using_serialnumber_sql->first()->id;
                    $data = array('name'=> $department_and_id[0]);
                    DB::table('job_departments')
                        ->where('id', $department_id)
                        ->update($data);
                }
                else
                {
                    //create
                    JobDepartment::create(['name' => $department_and_id[0], 'data_id' => $department_and_id[1],'data_serial_number' => $department_and_id[2], 'company_id' =>$request['company'] ]);
                    $department_id  = JobDepartment::where('name' , $department_and_id[0])->first()->id;
                    $job->department_id  = $department_id;
                }

            }
              else{
                $department  = JobDepartment::where('name' , $department_and_id[0])->first();
                $department_id  = $department->id;
                $job->department_id  = $department_id;
                if($company_status == 1 && $department->data_serial_number == 0)
             {

             $data = array('data_serial_number'=> $department_and_id[2],'data_id' => $department_and_id[1]);
                DB::table('job_departments')
                    ->where('id', $department_id)
                    ->update($data);
             }
            }
            $company_name =  str_replace(array(' ', '/'), array('-', '-'), $company->name);
            $post_title_alias = $post_title;
            $post_title_alias = str_replace(array(' ', '/'), array('-', '-'),$post_title_alias);
            $created = date('Y-m-d');
            
           $persian_alias = $company_name.'_'.$post_title_alias.'_'.$created;
           $job->persian_alias = $persian_alias;






        }
        else
        {
            $post_title = $request['post'];
            $job->department_id = $request['department'];
            $job->title = $post_title;
            
            $company_name =  str_replace(array(' ', '/'), array('-', '-'), $company->name);
            $post_title = str_replace(array(' ', '/'), array('-', '-'),$post_title);
            $created = date('Y-m-d');
            
           $persian_alias = $company_name.'_'.$post_title.'_'.$created;
           $job->persian_alias = $persian_alias;
            
        }

        $job->alias = str_replace(array(' ', '/'), array('-', '-'), $request['alias']);
        $i = 1;
        $tmp_alias = $job->alias;
        if (Job::where('alias', $job->alias)->count()) {

            while (Job::where('alias', $tmp_alias)->count()) {
                $i++;
                $tmp_alias = $job->alias . '-' . $i;
            }
            $job->alias = $tmp_alias;
        }
        $job->api_post_id = $post_and_id[1];
        $job->api_department_id = $department_and_id[1];
        $job->alias = strtolower($job->alias);
        $job->pin_status = $request['pin_status'];
        $job->min_education = $request['min_education'];
        $job->company_id = $request['company'];
        $job->cooperation_type = $request['cooperation_type'];
        $job->gender = $request['gender'];
        $job->goal_or_mission = $request['goal_or_mission'];
        $job->main_responsibilities = $request['main_responsibilities'];
        $job->job_other_features = $request['other_features'];
        $job->status = $request['status'];
        $job->industry_id = $request['industry_id'];
        $job->industry_id = $request['industry_id'];
        $job->jobExp = $request['jobExp'];
        if($company_status == 1)
        {
            $field_and_title = explode('**',$request['api_field']);
            $job->api_field_id	 = $field_and_title[1];
            $job->field	 = $field_and_title[0];
            $job->api_field_type_id	 = $request['field_type'];
        }
        else
        {
            $job->field=$request['field'];

        }

        if (isset($request['expire_date']))
            $job->expire_date = JDate::createFromFormat('Y-m-d', $request['expire_date'])->carbon->toDateTimeString();
        else
            $job->expire_date = Carbon::now()->timezone('Asia/Tehran')->addDay(30);

        $job->apply_limit = $request['apply_limit'];

        $job->created_by = Auth::user()->id;
        $job->modified_by = Auth::user()->id;
        
        
        
        $check_job_post_using_title_sql = JobPost::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $post_title));
        if ($check_job_post_using_title_sql->count() == 0) {

            if($company_status == 1){
                $department_id  = JobDepartment::where('name' , $department_and_id[0])->first()->id;

                // JobPost::create(['name' => $post_title,'data_id'=> $post_and_id[1],'department_data_id'=>$department_and_id[1]]);
                $check_job_post_using_serialnumber_sql = JobPost::where('data_serial_number', $post_and_id[2]);


                if($check_job_post_using_serialnumber_sql->count() > 0)
                {
                    //update
                    $post_id = $check_job_post_using_serialnumber_sql->first()->id;
                    $data = array('name'=> $post_and_id[0],  'department_id' => $department_id);
                    DB::table('job_posts')
                        ->where('id', $post_id)
                        ->update($data);
                }
                else{
                    //create
                 JobPost::create(['name' => $post_title,'data_id'=> $post_and_id[1],'data_serial_number'=> $post_and_id[2],'department_id'=>$department_id]);

                $post_id = JobPost::where('name', $post_title)->first()->id;
                }
            }
            else
            {
                JobPost::create(['name' => $post_title]);
                $post_id = JobPost::where('name', $post_title)->first()->id;
            }
        } else {
             $post    = JobPost::where('name', $post_title)->first();
             $post_id = $post->id;
             if($company_status == 1 && $post->data_serial_number == 0)
             {
                                 $department_id  = JobDepartment::where('name' , $department_and_id[0])->first()->id;

             $data = array('data_id'=> $post_and_id[1],'data_serial_number'=> $post_and_id[2],'department_id'=>$department_id);
                DB::table('job_posts')
                    ->where('id', $post_id)
                    ->update($data);
             }
        }
        $job->post_id = $post_id;




        $job->save();

        #extra questions
        if (isset($request['questions'])) {
            foreach ($request['questions'] as $item) {
                $q = new JobQuestions();
                $q->question = $item['question'];
                $q->job_id = $job->id;
                $q->save();
            }
        }
        #end of extra questions

        foreach ($request['city_id'] as $item) {
            $job->cities()->attach($item);
        }


        if (isset($request['images']) && !empty($request['images'])) {
            $images = explode(',', $request['images']);
            $images = array_filter($images);
            foreach ($images as $image) {
                $img = new Slider();
                $img->model_name = 'Job';
                $img->model_id = $job->id;
                $img->url = $image;
                $img->save();
            }
        }

        # start of job_general_merites
        $skill_1 = $request['skill_1'];
        $last_job_id = $job->id;
        
        foreach ($skill_1 as $item) {
           $merit = JobGeneralMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $item['name']))->first();
            if (!$merit || ($merit && (!$merit->general_data_id || $merit->general_data_id == 0))) 
            {

                    if($company_status == 1)
                    {
                        
                       foreach ($request['master_data_id'] as $master_data_id) {
                           $master_merit = explode('**',$master_data_id['name']);
                           $master_name = $master_merit[0];
                           $master_id = $master_merit[1];
                           if($item['name'] != $master_name)
                            continue;
                           else
                           {
                               if(!$merit)
                               {
                                   $date = date('Y-m-d H:i:s');
                                    $data=array('name' => $master_name,'general_data_id'=>$master_id,'created_at'=>$date,'updated_at'=>$date);
                                    DB::table('job_general_merites')->insert($data);
                                    $merit = JobGeneralMerites::where('name', $master_name)->first();
                                    if(DB::table('job_has_general_merites')->where('job_id',$last_job_id)->where('general_merites_id',$merit->id)->first())
                                    {
                                        
                                    }
                                    else
                                        $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);
                                    break;
                               }
                               else{
                                     DB::table('job_general_merites')
                                        ->where('id', $merit->id)
                                        ->update(array('general_data_id' => $master_id));
                                    if(DB::table('job_has_general_merites')->where('job_id',$last_job_id)->where('general_merites_id',$merit->id)->first())
                                    {
                                        
                                    }
                                    else
                                        $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);

                               }
                                
                           }
                        }
                    }
                    else if($company_status == 0 && $merit)
                    {
                        $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);
                        break;
                    }
                    else if($company_status == 0 && !$merit)
                    {
                        if(auth()->user()->hasRole('سوپرادمین'))
                        {
                            JobGeneralMerites::create(['name' => $item['name']]);
                            $merit = JobGeneralMerites::where('name', $item['name'])->first();
                            $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);
                        }

                    }
            }
            else
            {
                if(DB::table('job_has_general_merites')->where('job_id',$last_job_id)->where('general_merites_id',$merit->id)->first())
                {
                    
                }
                else
                $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);
            }
        }
        # end of job_general_merites
        //master_data_id_pro
        
       $skill_2 = $request['skill_2'];

       foreach ($skill_2 as $item) {
           $merit = JobProfessionalMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $item['name']))->first();
            if (!$merit || ($merit && (!$merit->professional_data_id || $merit->professional_data_id == 0))) 
            {

                    if($company_status == 1)
                    {
                        
                       foreach ($request['master_data_id_pro'] as $master_data_id) {
                           $master_merit = explode('**',$master_data_id['name']);
                           $master_name = $master_merit[0];
                           $master_id = $master_merit[1];
                           if($item['name'] != $master_name)
                            continue;
                           else
                           {
                               if(!$merit)
                               {
                                   $date = date('Y-m-d H:i:s');
                                    $data=array('name' => $master_name,'professional_data_id'=>$master_id,'created_at'=>$date,'updated_at'=>$date);
                                    DB::table('job_professional_merites')->insert($data);
                                    $merit = JobProfessionalMerites::where('name', $master_name)->first();
                                    
                                    if(DB::table('job_has_professional_merites')->where('job_id',$last_job_id)->where('professional_merites_id',$merit->id)->first())
                                    {}
                                    else
                                  
                                    $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);
                                    break;
                               }
                               else{
                                     DB::table('job_professional_merites')
                                        ->where('id', $merit->id)
                                        ->update(array('professional_data_id' => $master_id));
                                        
                                    if(DB::table('job_has_professional_merites')->where('job_id',$last_job_id)->where('professional_merites_id',$merit->id)->first())
                                    {}
                                    else
                                        
                                    $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);
    
                                        
                               }
                                
                           }
                        }
                    }
                    else if($company_status == 0 && $merit)
                    {
                         $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);

                    }
                    else if($company_status == 0 && !$merit)
                    {
                        JobProfessionalMerites::create(['name' => $item['name']]);
                        $merit = JobProfessionalMerites::where('name', $item['name'])->first();
                        $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);

                    }
            }
            else
            {
                if(DB::table('job_has_professional_merites')->where('job_id',$last_job_id)->where('professional_merites_id',$merit->id)->first())
                {
                    
                }
                else
                    $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);
            }
        }

        return redirect()->route('jobs.index')
            ->with('flash_message',
                'شغل  با موفقیت ایجاد گردید');
    }

    public function show($id)
    {
        $job = Job::where('persian_alias', $id)->first();
        //dd($job);
        if (!$job) {
            abort(404);
        }
        /**
         * M.Mahdavi Kia
         * if auth user = creator : SHOW
         */
        $allow_ids = [83179,34,108738];
        if($job){
            $creator_user = User::find($job->created_by);
            $auth_user = \Auth::user();

            //dd('Status:'.$job->status.' / Creator id:'.$creator_user->id.' / Auth user:'.$auth_user->id);
            //dd($job->status);

            if($auth_user){
                // if auth user
                if($creator_user->id != $auth_user->id){
                    // if auth user is not creator:
                    //if($job->status != "1"){
                    if(($job->approved!=1)||($job->status!=1)||(strtotime($job->expire_date)<time())){

                        // if status == 0 , not show
                        if(!in_array($auth_user->id,$allow_ids)){
                            abort(404);
                        }
                    }
                }// else SHOW
            }else{
                // if not auth user
              //  if($job->status != "1"){
                if(($job->approved!=1)||($job->status!=1)||(strtotime($job->expire_date)<time())){

                    // if status == 0, not show
                    if(!in_array($auth_user->id,$allow_ids)){
                        abort(404);
                    }
                }// else SHOW
            }
        }

        $job->visit_count += 1;
        $job->save();

        $images = Slider::where('model_name', 'Job')->where('model_id', $job->id)
            ->orWhere(function ($query) use ($job) {
                $query->where('model_name', 'company')
                    ->where('model_id', $job->company->id);
            })
            ->get();

        $cities = DB::table('jobs')
            ->where('jobs.persian_alias', $id)
            ->where('jobs.deleted_at', null)
            ->leftJoin('job_has_cities', 'jobs.id', '=', 'job_has_cities.job_id')
            ->leftJoin('cities', 'cities.id', '=', 'job_has_cities.city_id')
            ->leftJoin('provinces', 'provinces.id', '=', 'cities.province_id')
            ->pluck('provinces.name')->toArray();
            $cities = array_unique($cities); 
        if (count($cities) == Province::all()->count()) {
            $cities = array('کل کشور');
        }
        $cities_for_apply = DB::select(
            "
            SELECT `cities`.`id`, CONCAT(`provinces`.`name`, ' - ', `cities`.`name`) as name
            FROM `provinces` LEFT JOIN `cities` ON provinces.id = cities.province_id
            where `cities`.`id` IN (" . implode(', ', $job->cities->pluck('id')->toArray()) . ")
             "
        );
        
        
        $gig_data = $job->company->get_gig_data();

        return view('site.pages.jobs.show', compact(['job','gig_data', 'images', 'cities', 'cities_for_apply']));
    }

   public function edit($id)
    {
        $job = Job::findOrFail($id);


        $company= Company::where('id', $job['company_id'])->first();
        $company_flag = $company['flag'];
        $field_type_array = $results = DB::select('select * from api_education_field_types');

        if ($company_flag == 1) {

            $api_company_id = $company['data_id'];
      
            
            session()->put('gng_apply_baseurl',$company['gng_apply_baseurl'] );
            session()->put('gng_hr_baseurl', $company['gng_hr_baseurl']);
            session()->put('gng_master_baseurl',$company['gng_master_baseurl'] );
            
            $gng_apply_baseurl = session()->get('gng_apply_baseurl');
            $gng_hr_baseurl = session()->get('gng_hr_baseurl');
            $gng_master_baseurl = session()->get('gng_master_baseurl');
            $baseurl = ["gng_apply_baseurl"=>$gng_apply_baseurl,"gng_hr_baseurl"=>$gng_hr_baseurl,"gng_master_baseurl"=>$gng_master_baseurl];
            
            session()->put('token', CurlImpersonated::impersonatedLogin($api_company_id));
            $token = session()->get('token');
            //die($api_company_id);
            

            $departments = (json_decode(CurlImpersonated::companyOrganization($token,$baseurl)))->data;
           // die(json_encode($departments));
	        //dd($company);
            $field_array = DB::select('select * from api_education_fields where api_education_field_type_id="'.$job['api_field_type_id'].'"');
            if($job['department_id'])
            {
                $posts = (json_decode(CurlImpersonated::organizationPost($token,$job->department->data_serial_number,$baseurl)))->data;
                //die(json_encode($posts));
                foreach($posts as $post){
                    if($post->serialNumber != $job->post->data_serial_number)
                    continue;
                    else
                    {
                        $data_apply_limit = $post->personCount;
                        break;
                    }
                    
                }
            }
            else
            {
            $posts = [];
                        $data_apply_limit = 0;
}
            if($job->post->data_serial_number != 0)
            {
                $merit_array = (json_decode(CurlImpersonated::merites($token , $job->post->data_serial_number,$baseurl)))->data;
    
                $job_general_merites='';
                $job_professional_merites='';
              
                
                foreach ($merit_array as $merit)
                {
                    if($merit->postMeritTypeCode == 1)
                        $job_general_merites .= '<option value="'.$merit->postMeritCodeName.'**'.$merit->postMeritCode.'">'.$merit->postMeritCodeName.'</option>';
                    else if($merit->postMeritTypeCode == 2)
                        $job_professional_merites .= '<option value="'.$merit->postMeritCodeName.'**'.$merit->postMeritCode.'">'.$merit->postMeritCodeName.'</option>';
                }
            }
            
            else
            {
                $job_professional_merites = [];
                $job_general_merites = [];
            }
        


        }
        else {
            $departments = JobDepartment::where('data_id',0)->get();
            $orgs = JobOrganizationalCategory::all();
            $posts = JobPost::all();
            $data_apply_limit = 0;
            
              $job_general_merites = JobGeneralMerites::all();

        $users_professional_merites = array_merge(
            array_merge(
                DB::table('resume_has_exp_expertises')->pluck('professional_merites_id')->toArray(),
                DB::table('resume_has_p_t_r')->pluck('professional_merites_id')->toArray()),
            DB::table('resume_has_com_skills')->pluck('professional_merites_id')->toArray());

        $users_professional_merites = array_unique($users_professional_merites);

        $jobs_professional_merites = array_unique(DB::table('job_has_professional_merites')
            ->pluck('professional_merites_id')->toArray());
        //dd($users_professional_merites);

        $blocked_professional_merites = array_diff($users_professional_merites, $jobs_professional_merites);
        //dd($blocked_professional_merites);

        $job_professional_merites = JobProfessionalMerites::whereNotIn('id', $blocked_professional_merites)->get();
        }

      


        $images = Slider::where('model_name', 'Job')->where('model_id', $id)->get();
        $industries = Industry::all();

        $cities = City::all();
        $Degrees = $this->degrees_array;//config('app.enum_last_degree');

        return view('admin.jobs.edit', compact([
            'job',
            'data_apply_limit',
            'departments',
            'posts',
            'orgs',
            'job_general_merites',
            'job_professional_merites',
            'cities',
            'industries',
            'images'
            , 'Degrees',
            'field_type_array',
            'comp',
            'company_flag',
            'field_array'
        ]));
    }

    public function loadInactiveCompanyDepartment()
    {
        $departments = JobDepartment::where('data_id',0)->get();
        $dropdown_option='<option>حوزه کاری</option>';
        foreach ($departments as $dep)
        {
            $dropdown_option .= '<option value="'.$dep->id.'">'.$dep->name.'</option>';
        }

        echo $dropdown_option;

    }

    public function update(Request $request, $id)
    {
        //die($request['post'].'##');
        if ($request['apply_limit'] != '') {
            $this->validate($request, [
                'apply_limit' => 'integer'
            ]);
        }
        $this->validate($request, [

            'alias' => 'required|string',
            'pin_status' => 'required|integer|min:0|max:1',
            'department' => 'required',
            'min_education' => 'integer|max:10',
            'post' => 'required_without:api_post',
            'api_post' => 'required_without:post',
            'cooperation_type' => 'integer|min:1',
            'main_responsibilities' => 'required|string',
            'gender' => 'integer|min:1|max:3',
            'company' => 'integer|exists:companies,id',
            'city_id' => 'required|array|min:1',
            'industry_id' => 'integer',
            'status' => 'integer|min:1|max:3',
            'images' => 'nullable|string',
            'jobExp' => 'nullable|string',
            //'field' => 'nullable|string',
            'goal_or_mission' => 'required|string',
            'skill_1' => 'required|array|min:1|max:100',
            'skill_2' => 'required|array|min:1|max:100',
            'admin_message' => 'nullable|string|min:0|max:100000',
            'expire_date' => 'sometimes|persian_date:Y-m-d',
            'questions' => 'sometimes|required|array|min:1|max:100',
            'questions.*.question' => 'sometimes|required|string|max:255',
        ]);
        $log_request = json_encode($request->all());
        Storage::append('editd_request.txt', "\n job_id==>  ".$id."  " . date('Y-m-d H:m') . '===>' . $log_request);

      //  die(json_encode($request['department']));
        $job = Job::findOrFail($id);
        
       $new_msg = $request['admin_message'];
       $old_msg = $job->admin_message;
       $new_msg = str_replace(array("\n", "\r"," "), '', $request['admin_message']);
       $old_msg = str_replace(array("\n", "\r"," "), '', $job->admin_message);
       

 /*        if (stristr(strip_tags(trim($request['admin_message'])),strip_tags(trim($job->admin_message))))
        return redirect()->back()
		        ->withErrors('ویرایش پیامهای قبلی امکان پذیر نیست.');
		        
		        
       */
        
       // $job->title = $request['post'];
        $company = Company::where('id',$request['company'])->first();
        $company_status = $company->flag;

        if($company_status == 1)
        {
            if (strpos($request['api_post'], '**') === false || strpos($request['api_department'], '**') === false )
            {
                
            return redirect()->back()->withErrors([' لطفا پست و سازمان را انتخاب کنید']);

            
            }
            $post_and_id = explode('**',$request['api_post']);
            $department_and_id = explode('**',$request['api_department']);
            $post_title = $post_and_id[0];
            
            
            $company_name =  str_replace(array(' ', '/'), array('-', '-'), $company->name);
            $post_title_alias = $post_title;
            $post_title_alias = str_replace(array(' ', '/'), array('-', '-'),$post_title_alias);
            $created = explode(" ",$job->created_at)[0];
            
           $persian_alias = $company_name.'_'.$post_title_alias.'_'.$created;
           $job->persian_alias = $persian_alias;
            
            
            $job->title = $post_title;
            $job->api_post_id = $post_and_id[1];
            $job->api_department_id = $department_and_id[1];

            $check_job_department_using_title_sql = JobDepartment::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $department_and_id[0]));
            if ($check_job_department_using_title_sql->count() == 0) {
                $check_job_department_using_serialnumber_sql = JobDepartment::where('data_serial_number',$department_and_id[2]);
                if($check_job_department_using_serialnumber_sql->count() > 0)
                {
                    //updte
                    $department_id = $check_job_department_using_serialnumber_sql->first()->id;
                    $data = array('name'=> $department_and_id[0]);
                    DB::table('job_departments')
                        ->where('id', $department_id)
                        ->update($data);
                }
                else
                {
                    //create
                    JobDepartment::create(['name' => $department_and_id[0], 'data_id' => $department_and_id[1], 'company_id' =>$request['company'],
                    'data_serial_number' => $department_and_id[2] ]);
                    $job->department_id  = JobDepartment::where('name' , $department_and_id[0])->first()->id;
                }

            }
            
              else{
                $department  = JobDepartment::where('name' , $department_and_id[0])->first();
                $department_id  = $department->id;
                $job->department_id  = $department_id;
               if($company_status == 1 && $department->data_serial_number == 0)
               {

                $data = array('data_serial_number'=> $department_and_id[2],'data_id' => $department_and_id[1]);
                DB::table('job_departments')
                    ->where('id', $department_id)
                    ->update($data);
               }
              }


        }
        else
        {
            $job->department_id = $request['department'];
            $post_title = $request['post'];
            
            $company_name =  str_replace(array(' ', '/'), array('-', '-'), $company->name);
            $post_title_alias = $post_title;
            $post_title_alias = str_replace(array(' ', '/'), array('-', '-'),$post_title_alias);
            $created = explode(" ",$job->created_at)[0];
            
           $persian_alias = $company_name.'_'.$post_title_alias.'_'.$created;
           $job->persian_alias = $persian_alias;
            
            
            
            $job->title = $post_title;
        }
        if ($request['alias'] != $job->alias) {
            $job->alias = str_replace(' ', '-', $request['alias']);
            if (Job::where('alias', $job->alias)->count())
                $job->alias .= '-' . (string)Job::where('alias', $job->alias)->count();
            $job->alias = strtolower($job->alias);
        }
        //die($request['department']);
//dd($request);
        $job->pin_status = $request['pin_status'];
     //   $job->department_id = $request['department'];
        $job->company_id = $request['company'];
        $job->cooperation_type = $request['cooperation_type'];
        $job->gender = $request['gender'];
        $job->min_education = $request['min_education'];
        $job->industry_id = $request['industry_id'];
        $job->goal_or_mission = $request['goal_or_mission'];
        $job->main_responsibilities = $request['main_responsibilities'];
        $job->job_other_features = $request['other_features'];
        $job->status = $request['status'];
        $job->jobExp = $request['jobExp'];
        
         $company_name =  str_replace(array(' ', '/'), array('-', '-'), $company->name);
         

        
            if(substr_count($request['admin_message'] , "<hr />") != substr_count($job->admin_message , "<hr>"))
                return redirect()->back()->withErrors([' ویرایش پیام ها امکان پذیر نیست']);

            else{
                
                if($old_msg)
                {
                
                if(!stristr(strip_tags($new_msg),strip_tags($old_msg)))
                    return redirect()->back()->withErrors([' ویرایش پیام ها امکان پذیر نیست']);
          
            
                    
                }
            }
            

         if (strlen($request['admin_message']) > strrpos($request['admin_message'] , "<hr />") + 10)
        {
            
       
        if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
        {
              
               if($job->admin_message ){
                  // die(json_encode(  htmlspecialchars($request['admin_message']) ));
                  $index =  strrpos($request['admin_message'] , "<hr />")+6;
                  $admin_message =$job->admin_message .auth()->user()->first_name.' '.auth()->user()->last_name. "(سوپرادمین) :
                      ". substr($request['admin_message'],$index)."<hr>\n";

            }
            else   
                $admin_message =auth()->user()->first_name.' '.auth()->user()->last_name. "(سوپرادمین) : "
                . $request['admin_message']."<hr>\n";
             
             $job->admin_message = $admin_message;
            // if(Auth::user()->id == 108738)
                         //todo comment email
                          $this->email($job);



         }
        elseif(in_array($job->company_id, auth()->user()->company->pluck('id')->toArray()))
           {
               if($job->admin_message ){
                  $index =  strrpos($request['admin_message'] , "<hr />")+6;
                  $admin_message =$job->admin_message .auth()->user()->first_name.' '.auth()->user->last_name. "(ادمین): 
                      ". substr($request['admin_message'],$index)."<hr>\n";

            }
            else   
                $admin_message =auth()->user()->first_name.' '.auth()->user()->last_name. "(ادمین) : 
                    ". $request['admin_message']."<hr>\n";
             
             $job->admin_message = $admin_message;

         }
        }
        
     
        


        if($company_status == 1)
        {
            $field_and_title = explode('**',$request['api_field']);
            $job->api_field_id	 = $field_and_title[1];
            $job->field	 = $field_and_title[0];
            $job->api_field_type_id	 = $request['field_type'];


        }
        else
        {
            $job->field=$request['field'];

        }

        if (isset($request['expire_date']))
            $job->expire_date = JDate::createFromFormat('Y-m-d', $request['expire_date'])->carbon->toDateString();

        $job->apply_limit = $request['apply_limit'];

        $job->modified_by = Auth::user()->id;
       

        $check_job_post_using_title_sql = JobPost::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $post_title));
        if (JobPost::where('name', $post_title)->count() == 0) {
        if ($check_job_post_using_title_sql->count() == 0) {
            if ($company_status == 1) {
                $post_and_id = explode('**', $request['api_post']);
                $department_and_id = explode('**', $request['api_department']);
//              JobPost::create(['name' => $post_title,'data_id'=> $post_and_id[1],'department_data_id'=>$department_and_id[1]]);
                $check_job_post_using_serialnumber_sql = JobPost::where('data_serial_number', $post_and_id[2]);
                $department_id = JobDepartment::where('name', $department_and_id[0])->first()->id;


                if($check_job_post_using_serialnumber_sql->count() > 0)
                {
                    //update
                    $post_id = $check_job_post_using_serialnumber_sql->first()->id;
                    $data = array('name'=> $post_and_id[0],  'department_id' => $department_id);
                    DB::table('job_posts')
                        ->where('id', $post_id)
                        ->update($data);
                }
                else
                {
                    //create
                
                    JobPost::create(['name' => $post_title, 'data_id' => $post_and_id[1],'data_serial_number'=> $post_and_id[2],  'department_id' => $department_id]);
                }

                $job->title = $post_title;

                $post_id = JobPost::where('name', $post_title)->first()->id;
            }
            else {
                try {
                    JobPost::create(['name' => $post_title]);
                    $job->title = $post_title;

                } catch (\Exception $e) {
                    Storage::append('create_post_error.txt', "\n" . date('Y-m-d H:m') . '===>' . $e->getMessage());

                }
                $post_id = JobPost::where('name', $post_title)->first()->id;
            }
        }

        //if the post exist but with some space
        else{
            $old_post = JobPost::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $post_title))->first()->id;
            //it can be update if user is superadmin
            $user_role = DB::table('model_has_roles')->where('model_id','=',Auth::user()->id)->first()->role_id;
            if($user_role == 9)
            {
                $data = array('name' => $post_title);
                DB::table('job_posts')
                    ->where('id', $old_post)
                    ->update($data);
                $post_id = $old_post;
                $job->title = $post_title;


            }
            else
            {
                $post_id = $old_post;


            }

        }
    }

       else {

             $post    = JobPost::where('name', $post_title)->first();
             $post_id = $post->id;
             if($company_status == 1 && $post->data_serial_number == 0)
             {
             $data = array('data_id'=> $post_and_id[1],'data_serial_number'=> $post_and_id[2]);
                DB::table('job_posts')
                    ->where('id', $post_id)
                    ->update($data);
             }
            
            
        }
        
      //  die($request['post'].'##');
        $job->post_id = $post_id;





try{

        $job->save();
    }
        catch(\Exception $e){
            Storage::append('edit_job_error.txt', "\n".date('Y-m-d H:m').'===>'.$e->getMessage());

        }

        //--------------------------------------------------------------
        // M.M.Kia
        // Update PUBLISH status in Sharepoint
        $job_sharepoint_itemID = $job->ItemId;
        $job_sharepoint_PortalAdrs = $job->PortalAddress;
        if(isset($job->ItemId) && $job->ItemId !== null) {
            $data = array(
                "PortalAdrs" => $job_sharepoint_PortalAdrs,
                "ItemID" => $job_sharepoint_itemID,
                "Status" => $request['status']
            );
            $data_string = json_encode($data);
            $ch = curl_init('https://portal.golrang.com/_vti_bin/SPService.svc/UpdatePublishStatus');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
            );
            $result = curl_exec($ch);
        }
        //-----------------------------------------------------------------

        #extra questions
        JobQuestions::where('job_id', $job->id)->delete();
        if (isset($request['questions'])) {
            foreach ($request['questions'] as $item) {
                $q = new JobQuestions();
                $q->question = $item['question'];
                $q->job_id = $job->id;
                $q->save();
            }
        }
        #end of extra questions

        $job->cities()->detach();
        foreach ($request['city_id'] as $item) {

            $job->cities()->attach($item);
        }
        Slider::where('model_name', 'Job')->where('model_id', $job->id)->delete();
        if (isset($request['images']) && !empty($request['images'])) {
            $images = explode(',', $request['images']);
            $images = array_filter($images);
            foreach ($images as $image) {
                $img = new Slider();
                $img->model_name = 'Job';
                $img->model_id = $job->id;
                $img->url = $image;
                $img->save();
            }
        }
/*
        $job->job_general_merites()->detach();
        $job->job_professional_merites()->detach();*/

        # start of job_general_merites
        $skill_1    = $request['skill_1'];

         $last_job_id = $job->id;        
        foreach ($skill_1 as $item) {
           $merit = JobGeneralMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $item['name']))->first();
            if (!$merit || ($merit && (!$merit->general_data_id || $merit->general_data_id == 0))) 
            {

                    if($company_status == 1)
                    {
                        
                       foreach ($request['master_data_id'] as $master_data_id) {
                           $master_merit = explode('**',$master_data_id['name']);
                           $master_name = $master_merit[0];
                           $master_id = $master_merit[1];
                           if($item['name'] != $master_name)
                            continue;
                           else
                           {
                               if(!$merit)
                               {
                                   $date = date('Y-m-d H:i:s');
                                    $data=array('name' => $master_name,'general_data_id'=>$master_id,'created_at'=>$date,'updated_at'=>$date);
                                    DB::table('job_general_merites')->insert($data);
                                    $merit = JobGeneralMerites::where('name', $master_name)->first();
                                    
                                    if(DB::table('job_has_general_merites')->where('job_id',$last_job_id)->where('general_merites_id',$merit->id)->first())
                                    {
                                        
                                    }
                                    else
                                        $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);
                                    break;
                               }
                               else{
                                     DB::table('job_general_merites')
                                        ->where('id', $merit->id)
                                        ->update(array('general_data_id' => $master_id));
                                        
                                    if(DB::table('job_has_general_merites')->where('job_id',$last_job_id)->where('general_merites_id',$merit->id)->first())
                                    {
                                        
                                    }
                                    else    
                                        $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);

                               }
                                
                           }
                        }
                    }
                    else if($company_status == 0 && $merit)
                    {
                        $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);
                    }
                    else if($company_status == 0 && !$merit)
                    {
                        JobGeneralMerites::create(['name' => $item['name']]);
                        $merit = JobGeneralMerites::where('name', $item['name'])->first();
                        $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);

                    }
            }
            else
            {
                if(DB::table('job_has_general_merites')->where('job_id',$last_job_id)->where('general_merites_id',$merit->id)->first())
                {
                    
                }
                else
                    $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);
            }
        }
        # end of job_general_merites
        //master_data_id_pro
        
       $skill_2 = $request['skill_2'];

       foreach ($skill_2 as $item) {
           $merit = JobProfessionalMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $item['name']))->first();
            if (!$merit || ($merit && (!$merit->professional_data_id || $merit->professional_data_id == 0))) 
            {

                    if($company_status == 1)
                    {
                        
                       foreach ($request['master_data_id_pro'] as $master_data_id) {
                           $master_merit = explode('**',$master_data_id['name']);
                           $master_name = $master_merit[0];
                           $master_id = $master_merit[1];
                           similar_text($item['name'],$master_name,$per);

                           /*if($per >= 98)
                            {
                                
                if(DB::table('job_has_professional_merites')->where('job_id',$last_job_id)->where('professional_merites_id',$merit->id)->first())
                {}
                else
                {
                                DB::table('job_professional_merites')
                                        ->where('id', $merit->id)
                                        ->update(array('professional_data_id' => $master_id));
                    
                    $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);
                            }
                            }*/
                            
                            
                           if($item['name'] != $master_name)
                            continue;

                            else
                           {
                               if(!$merit)
                               {
                                   $date = date('Y-m-d H:i:s');
                                    $data=array('name' => $master_name,'professional_data_id'=>$master_id,'created_at'=>$date,'updated_at'=>$date);
                                    DB::table('job_professional_merites')->insert($data);
                                    $merit = JobProfessionalMerites::where('name', $master_name)->first();
                                    if(DB::table('job_has_professional_merites')->where('job_id',$last_job_id)->where('professional_merites_id',$merit->id)->first())
                                    {}
                                    else
                                        $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);
                                    break;
                               }
                               else{
                                     DB::table('job_professional_merites')
                                        ->where('id', $merit->id)
                                        ->update(array('professional_data_id' => $master_id));
                                    if(DB::table('job_has_professional_merites')->where('job_id',$last_job_id)->where('professional_merites_id',$merit->id)->first())
                                    {}
                                    else
                                        $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);
    
                                        
                               }
                                
                           }
                        }
                    }
                    else if($company_status == 0 && $merit)
                    {

                        $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);
                        

                    }
                    else if($company_status == 0 && !$merit)
                    {
                        JobProfessionalMerites::create(['name' => $item['name']]);
                        $merit = JobProfessionalMerites::where('name', $item['name'])->first();
                        $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);

                    }
            }
            else
            {
                if(DB::table('job_has_professional_merites')->where('job_id',$last_job_id)->where('professional_merites_id',$merit->id)->first())
                {}
                else
                {
                    if(count($request['master_data_id_pro']) == 1)
                    {
                        $master_data_id =$request['master_data_id_pro'];
                        $master_merit = explode('**',$master_data_id['name']);
                           $master_name = $master_merit[0];
                           $master_id = $master_merit[1];
                                       DB::table('job_professional_merites')
                                        ->where('id', $merit->id)
                                        ->update(array('professional_data_id' => $master_id));
                           
                    }
        
                  /*  foreach ($request['master_data_id'] as $master_data_id) {
                           $master_merit = explode('**',$master_data_id['name']);
                           $master_name = $master_merit[0];
                           $master_id = $master_merit[1];
                     DB::table('job_professional_merites')
                                        ->where('id', $merit->id)
                                        ->update(array('professional_data_id' => $master_id));
                    }*/
                    $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);
                }
            }
        }


        return redirect()->route('jobs.index')
            ->with('flash_message',
                'شغل  با موفقیت ویرایش گردید');
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return redirect()->route('jobs.index')
            ->with('flash_message',
                'شغل به سطل زباله منتقل شد');
    }

    public function restore($id)
    {
        $job = Job::onlyTrashed()->findOrFail($id);
        $job->restore();
        return redirect()->route('jobs.index')
            ->with('flash_message',
                'شغل با موفقیت بازیابی شد');

    }

    public function pin($id)
    {
        DB::table('jobs')
            ->where('id', $id)
            ->update(['pin_status' => 1]);

        return redirect()->route('jobs.index')
            ->with('flash_message',
                'شغل مورد نظر پین شد');
    }

    public function unpin($id)
    {
        DB::table('jobs')
            ->where('id', $id)
            ->update(['pin_status' => 0]);

        return redirect()->route('jobs.index')
            ->with('flash_message',
                'پین شغل حذف شد');
    }

    public function accept($id)
    {
        $job = Job::findOrFail($id);

        $job_sharepoint_itemID = $job->ItemId;
        $job_sharepoint_PortalAdrs = $job->PortalAddress;
        $job->approved = 1;

        if (!$job->save()):
	        return redirect()->back()
		        ->with('flash_message',
			        'مشکلی در تایید پیش امده است.');
	    endif;

        /**
		* ُ Sharepoint call service:
		* M.M.Kia
        * Edited by Kiarashmhr
		*/


        if(isset($job->ItemId) && $job->ItemId !== null):

            $data = array(
                "PortalAdrs" => $job_sharepoint_PortalAdrs,
                "ItemID" => $job_sharepoint_itemID,
                "Status" => 1
            );

            $data_string = json_encode($data, true);

            $ch = curl_init('https://portal.golrang.com/_vti_bin/SPService.svc/UpdatePublishStatus');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
            );
            $result = curl_exec($ch);

	        if ($result != '"1"'):
		        return redirect()->back()
			        ->with('flash_message',
				        'شغل مورد نظر تایید شد ولی مشکلی در ثبت در پرتال پیش آمده است.');
	        endif;
	        $this->email($job);
	        return redirect()->back()
		        ->with('flash_message',
			        'شغل مورد نظر تایید شد و در پرتال ثبت گردید.');

        endif;

	    $this->email($job);

        return redirect()->back()
            ->with('flash_message',
                'شغل مورد نظر تایید شد');


    }
    
     public function email($job)
    {
        
      /*  $all_admins = $job->company()->first()->users()
            ->join('model_has_roles','model_has_roles.model_id','users.id')
            ->whereIn('model_has_roles.role_id', [15, 16]) // admin , admine mashaghel

            ->pluck('user_id')->toArray();*/
            
            $company_id = $job->company()->first()->id;
            $jobid = $job->id;
             //it is just for golrang system
                if($job->company()->first()->id == 1)
                {
                    
                    
                    
                    $admin_detail = User::where('id',34)->first(); //hard code
                   
                    
                    $email = new ApproveJobAlert($job,$admin_detail);

                     Mail::to(['Eyvazi.Farzaneh@Golrang.com'])->send($email);
                    // Mail::to(['zoeejoon@gmail.com'])->send($email);


                    // todo 
                    Storage::append('confirmjob_mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> admin => eyvazi for job '.$jobid );
                }
            
           $all_admins = DB::table('user_has_companies')
         // ->leftjoin('BI_user_status','user_has_companies.user_id','BI_user_status.user_id')
          ->join('model_has_roles','user_has_companies.user_id','model_has_roles.model_id')
          ->where('user_has_companies.company_id',$company_id)->wherein('role_id',[15,16])
          ->pluck('user_has_companies.user_id')->toArray();
          

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
                                      //  $creator_detail = User::where('id',108738)->first();

                    $email = new ApproveJobAlert($job,$creator_detail);

                     Mail::to($creator_detail->email)->send($email);
                    //todo  
                   // Mail::to(User::where('id',108738)->first()->email)->send($email);
                    Storage::append('confirmjob_mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> creator => '.$creator_detail->email.' for job '.$jobid );
                }
                else
                    Storage::append('confirmjob_not_exist_mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> creator1 => '.$creator.' for job '.$jobid );


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
                                             //   $admin_detail = User::where('id',108738)->first();

                            $email = new ApproveJobAlert($job,$admin_detail);

                            Mail::to($admin_detail->email)->send($email);
                            //todo
                   // Mail::to(User::where('id',108738)->first()->email)->send($email);
                            Storage::append('confirmjob_mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> admin => '.$admin_detail->email.' for job '.$jobid );

                        }
                        else
                            Storage::append('confirmjob_not_exist_mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> admin2 => '.$admin_detail->email.' for job '.$jobid );






                    }
                }
                else if(count($admins) == 1){
                    $admin_detail = User::where('id',$admins)->first();
                    if(strlen($admin_detail->email) > 3)
                    {
                                           // $admin_detail = User::where('id',108738)->first();

                       $email = new ApproveJobAlert($job,$admin_detail);

                         Mail::to($admin_detail->email)->send($email);
                        //todo
                   // Mail::to(User::where('id',108738)->first()->email)->send($email);
                        Storage::append('confirmjob_mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> admin => '.$admin_detail->email.' for job '.$jobid );
                    }
                    else
                    {
                        Storage::append('confirmjob_not_exist_mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> admin3 => '.json_encode($admins).' for job '.$jobid );

                    }
                }
                else
                {
                    $admin_detail = User::where('id',108738)->first();
                    $email = new ApproveJobAlert($job,$admin_detail);

                          Mail::to($admin_detail->email)->send($email);
                        //todo
                        Storage::append('confirmjob_not_exist_mail_log.txt', "\n" . date('Y-m-d H:i:s').'==> adminfinal => '.$admin_detail->email.' for job '.$jobid );

                }
            }
        }
              

    }

    public function reject($id)
    {
        $job = Job::findOrFail($id);
        $job_sharepoint_itemID = $job->ItemId;
        $job_sharepoint_PortalAdrs = $job->PortalAddress;
        $job->approved = 0;
	    if (!$job->save()):
		    return redirect()->back()
			    ->with('flash_message',
				    'مشکلی در رد شغل پیش امده است.');
	    endif;

	    /**
		* Sharepoint call service:
		* M.M.Kia
		* Edited by Kiarashmhr
		*/

        if(isset($job->ItemId) && $job->ItemId !== null) :
            $data = array(
                "PortalAdrs" => $job_sharepoint_PortalAdrs,
                "ItemID" => $job_sharepoint_itemID,
                "Status" => 0
            );
            $data_string = json_encode($data);
            $ch = curl_init('https://portal.golrang.com/_vti_bin/SPService.svc/UpdatePublishStatus');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
            );
            $result = curl_exec($ch);

	        if ($result != '"1"'):
		        return redirect()->back()
			        ->with('flash_message',
				        'شغل مورد نظر رد شد ولی مشکلی در ثبت در پرتال پیش آمده است.');

	        endif;

	        return redirect()->back()
		        ->with('flash_message',
			        'شغل مورد نظر رد شد و در پرتال ثبت گردید.');
        endif;

        return redirect()->back()
            ->with('flash_message',
                'شغل مورد نظر رد شد');
    }

    public function GetCities()
    {
        $province_id = request('province');
        $province = Province::findOrFail($province_id);
        return json_encode($province->cities);
    }

   /* public function Search()
    {
        if (request('approved') == '3')
            $jobs = Job::myJobs()->onlyTrashed();

        elseif (request('approved') == 'all')
            $jobs = Job::myJobs()->withTrashed();

        else
            $jobs = Job::myJobs()->orderby('pin_status', 'desc');


        $orgs = JobOrganizationalCategory::all();
        $departments = JobDepartment::all();
        $provinces = Province::all();
        $post = JobPost::all();
        $companies = Company::all();

        #Check for title
        if (request('title') != '')
            $jobs->where('title', 'like', '%' . request('title') . '%');

        #Check for approved
        if (request('approved') != '' && request('approved') != 'all' && request('approved') != '3')
            $jobs->where('approved', request('approved'));

        #Check for post
        if (request('post') != '')
            $jobs->where('post_id', request('post'));

        #Check for organizational_category
        if (request('organizational_category') != '')
            $jobs->where('organizational_category_id', request('organizational_category'));

        #Chech for department
        if (request('department') != '')
            $jobs->where('department_id', request('department'));

        if (request('company') != '')
            $jobs->where('company_id', request('company'));


        $jobs = $jobs->orderby('pin_status', 'desc')->paginate(25);

        return view('admin.jobs.index', compact(['jobs', 'companies', 'orgs', 'departments', 'provinces', 'post']));

    }*/
    
        public function Search()
    {
        if (request('approved') == '3')
            $jobs = Job::myJobs()->onlyTrashed();

        elseif (request('approved') == 'all')
            $jobs = Job::myJobs()->withTrashed();

        else
            $jobs = Job::myJobs()->orderby('pin_status', 'desc');

        if (request('professionalMerit') && !empty(request('professionalMerit'))) {
            $ptr = request('professionalMerit');
            $jobs->whereHas('job_professional_merites', function ($w) use ($ptr) {
                $w->where('professional_merites_id', $ptr);
            });
        }

        if (request('title') && !empty(request('title'))) {
            $jobs->where('title', 'like', '%' . request('title') . '%');
        }

        if (((request('approved') != null))) {
            $jobs->where('approved', request('approved'));
        }


        if (request('post_id') && !empty(request('post_id'))) {
            $jobs->where('post_id', request('post_id'));
        }

        if (request('company_id') && !empty(request('company_id'))) {
            $selected_company = request('company_id');
            $jobs->where('company_id', request('company_id'));
            //  die(request('company_id').'***');
        }

        if (request('department_id') && !empty(request('department_id'))) {
            $selected_department = request('department_id') ;
            $jobs->where('department_id', request('department_id'));
        }

        $jobs = $jobs->orderBy('status', 'asc')
            ->orderBy('expire_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(50);
        $orgs = JobOrganizationalCategory::all();
        $departments = JobDepartment::where('data_id',0)->get();
        $provinces = Province::all();
        $post = JobPost::all();
        $companies = Company::all();
        $query_string = (parse_url(URL::full())['query']) ? '?' . parse_url(URL::full())['query'] : null;
        return view('admin.jobs.index', compact(['jobs', 'orgs', 'departments', 'provinces', 'companies', 'post', 'query_string','selected_company','selected_department']));

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

    public function update_sort_order()
    {
        $tmps = explode(',', $_POST['string']);
        foreach ($tmps as $tmp) {
            $tmp1 = explode(':', $tmp);
            $id = $tmp1[0];
            $order = intval($tmp1[1]) * -1;
            if ($order == 0) $order = null;
            $job = Job::findOrFail($id);
            $job->sort_order = $order;
            $job->save();
        }
    }

    public function site_index(Request $request)
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
        $jobs = Job::where('approved', 1)->where('status', '!=', 2)
            ->where('expire_date', '>=', date('Y-m-d h:i:s', time()));
		#GET all active jobs
        $most_jobs = Job::with('company')
	        ->selectRaw('jobs.*, count(jobs.id) AS `count`')
            ->where('jobs.approved', 1)
	        ->where('jobs.status', '!=', 2)
            ->where('jobs.expire_date', '>=', date('Y-m-d h:i:s', time()))
            ->groupBy('jobs.company_id')
	        ->orderBy('count','DESC')
	        ->take(5)
	        ->get();
        //******************************************************************************************
        #Make All filters
        $all_filters = [
            'province' => Province::pluck('name')->toArray(),
            'department' => JobDepartment::pluck('name')->toArray(),
            'industry' => Industry::pluck('name')->toArray(),
            'gender' => [1, 2],
            'company' => Company::pluck('name')->toArray(),
        ];

        //******************************************************************************************
        $all_filters['cooperation_type'] = ResumeContractType::pluck('name')->toArray();

        $filter_count = array();
        $cooperations = ResumeContractType::pluck('id', 'name')->toArray();


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
        $cooperations_count = DB::table('jobs')
            ->select('cooperation_type', DB::raw('count(*) as total'))
            ->wherein('jobs.id', $all_jobs_filter)
            ->groupBy('cooperation_type')
            ->pluck('total', 'cooperation_type')->toArray();

        foreach ($all_filters['cooperation_type'] as $cooper) {
            $filter_count[$cooper] = isset($cooperations_count[$cooperations[$cooper]]) ? $cooperations_count[$cooperations[$cooper]] : 0;
        }

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
//die(json_encode($jobs));
        return view(
            'site.pages.jobs.index',
            compact(['filter_count', 'all_filters', 'jobs', 'job_count', 'provincesNames', 'most_jobs']));
    }

    public function export_csv()
    {

        $jobs = DB::table('jobs')->select(
            'jobs.title AS job_name',
            DB::raw('GROUP_CONCAT(DISTINCT cities.name SEPARATOR \', \') AS cities'),
            'jobs.gender',
            'industries.name as industries',
            'resume_contract_types.name',
            'jobs.min_education',
            'jobs.field',
            'jobs.jobExp',
            'companies.name as company_name',
            DB::raw('CONCAT(users.first_name, " ", users.last_name) AS admin_name'),
            'job_departments.name as department_name',
            'jobs.created_at',
            'jobs.expire_date',
            DB::raw('(select COUNT(applies.id) from applies where applies.job_id = jobs.id AND applies.deleted_at is null ) as received_applies'),
            DB::raw('(select COUNT(applies.id) from applies where applies.job_id = jobs.id AND applies.deleted_at is null AND applies.status=1 ) as noAnswer_applies'),
            DB::raw('(select COUNT(applies.id) from applies where applies.job_id = jobs.id AND applies.deleted_at is null AND applies.status=4 ) as seen_applies'),
            DB::raw('(select COUNT(applies.id) from applies where applies.job_id = jobs.id AND applies.deleted_at is null AND applies.status=3 ) as rejected_applies'),
            DB::raw('(select COUNT(applies.id) from applies where applies.job_id = jobs.id AND applies.deleted_at is null AND applies.status=2 ) as accepted_applies'),
            'jobs.approved'
        )
            ->leftJoin('job_has_cities', 'job_has_cities.job_id', '=', 'jobs.id')
            ->leftJoin('cities', 'cities.id', '=', 'job_has_cities.city_id')
            ->leftJoin('industries', 'industries.id', '=', 'jobs.industry_id')
            ->leftJoin('resume_contract_types', 'resume_contract_types.id', '=', 'jobs.cooperation_type')
            ->leftJoin('companies', 'companies.id', '=', 'jobs.company_id')
            ->leftJoin('users', 'users.id', '=', 'jobs.created_by')
            ->leftJoin('job_departments', function ($join){
                $join->on('job_departments.id', '=', 'jobs.department_id')->where('job_departments.deleted_at', null);
            })->where('jobs.deleted_at', null)
            ->groupBy('jobs.id');

        if (request('title') && !empty(request('title'))) {
            $jobs->where('jobs.title', 'like', '%' . request('title') . '%');
        }

        if (request('approved') && !empty(request('approved'))) {
            $jobs->where('jobs.approved', request('approved'));
        }


        if (request('post_id') && !empty(request('post_id'))) {
            $jobs->where('jobs.post_id', request('post_id'));
        }

        if (request('company_id') && !empty(request('company_id'))) {
            $jobs->where('jobs.company_id', request('company_id'));
        }

        if (request('department_id') && !empty(request('department_id'))) {
            $jobs->where('jobs.department_id', request('department_id'));
        }

        $user_companies = auth()->user()->company->pluck('id')->toArray();
        if(!auth()->user()->hasRole('برنامه نویس') && !auth()->user()->hasRole('سوپرادمین'))
            $jobs->whereIn('jobs.company_id',$user_companies);

        $jobs = $jobs->get();
        $header = [
            'عنوان شغل',
            'شهر',
            'جنسیت',
            'صنعت',
            'نوع همکاری',
            'حداقل مدرک تحصیلی',
            'رشته تحصیلی',
            'سابقه کار',
            'نام شرکت',
            'نام ادمین',
            'حوزه کاری',
            'تاریخ ایجاد',
            'تاریخ انقضای رزومه',
            'تعداد رزومه دریافت شده',
            'تعداد رزومه بررسی نشده',
            'تعداد رزومه برگزیده',
            'تعداد رزومه رد شده',
            'تعداد رزومه تایید نهایی',
            'درصد رزومه های بررسی نشده',
            'درصد رزومه های رد شده',
            'درصد رزومه های برگزیده',
            'وضعیت تایید',
        ];
        $body = array();
        foreach ($jobs as $job) {
            $body[] = [
                $job->job_name,
                $job->cities,
                config('app.enum_gender')[$job->gender],
                $job->industries,
                $job->name,
                $this->degrees_array[$job->min_education],
                $job->field,
                $job->jobExp,
                $job->company_name,
                $job->admin_name,
                $job->department_name,
                JDate::createFromCarbon(Carbon::parse($job->created_at))->format('Y-m-d'),
                JDate::createFromCarbon(Carbon::parse($job->expire_date))->format('Y-m-d'),
                $job->received_applies,
                $job->noAnswer_applies,
                $job->seen_applies,
                $job->rejected_applies,
                $job->accepted_applies,
                $job->received_applies?number_format((float)(($job->noAnswer_applies/$job->received_applies)*100), 2, '.', '').'%':'-',
                $job->received_applies?number_format((float)((100)-((($job->noAnswer_applies/$job->received_applies)*100))-(((($job->seen_applies + $job->accepted_applies)/$job->received_applies)*100))), 2, '.', '').'%':'-',
                $job->received_applies?number_format((float)((($job->seen_applies + $job->accepted_applies)/$job->received_applies)*100), 2, '.', '').'%':'-',
                $job->approved?'تایید شده':'منتظر تایید'
            ];
        }
        myFuncs::export_to_csv($header, $body, 'Jobs_export');

    }

    function archive_job($id)
    {
        $job = Job::find($id);
        $job->archive();

        return redirect()->route('jobs.index')
            ->with('flash_message',
                'آگهی مورد نظر بسته شد.');
    }

    function extend($id)
    {
        $job = Job::find($id);
        $job->extend();
        $extended_job = 1;
        return redirect()->route('jobs.index',compact('extended_job','id'))
            ->with('flash_message',
                'آگهی مورد نظر به مدت ده روز تمدید شد.');
    }

    function  showNonAutomaticExtend(job $id)
    {
      //  die(json_encode($id->company_id));
       // die(json_encode($id->company()->first()->id));
        $company_id = 13;
       /* $user_companies = auth()->user()->company->where('id',$company_id)->toArray();
die(json_encode($user_companies));*/
        $admin_extended_job = 1;
        return redirect()->route('jobs.index',compact('admin_extended_job','id'))->with( ['admin_extended_job' => $admin_extended_job] );
       //$rows = Job::
    /*   die(json_encode(auth()->user()->jobs()));

        return Job::whereIn('company_id',$user_companies);*/
    }

    function extendSpecificDay(Request $request)
    {
        $days = $request['days'];
        $job  = Job::where('id',$request['job_id'])->first();
        if($job->specificExtend($days) == 1)
            return 1;
        else
            return 0;
      /*  return redirect()->route('jobs.index',compact('extended_job','id'))
            ->with('flash_message',
                'آگهی مورد نظر به مدت '.$days.' روز تمدید شد.');*/


    }
    
        function reminder_email()
    {
        /*$job1 = Job::where('id',1183)->first();
        $this->email($job1);*/
       

    }

}