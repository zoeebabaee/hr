<?php

namespace HR\Http\Controllers;

use HR\UserProfile;
use Illuminate\Http\JsonResponse;
use Storage;
use Response;
use HR\myFuncs;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use HR\Apply;
use HR\City;
use HR\Company;
use HR\Industry;
use HR\Job;
use HR\JobDepartment;
use HR\JobGeneralMerites;
use HR\JobOrganizationalCategory;
use HR\JobPost;
use HR\JobProfessionalMerites;
use HR\JobQuestions;
use HR\myDate;
use HR\Province;
use HR\RejectReasons;
use HR\Resume;
use HR\ResumeContractType;
use HR\Slider;
use HR\SMS;
use HR\User;
use HR\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use p3ym4n\JDate\JDate;
use HR\CurlImpersonated;


class ApiController extends Controller
{
    public function __construct()
    {
        /**
         * Degrees DB table replace with config('app.enum_degrees')
         * 97-11-17
         * @author M.Mahdavi Kia
         * @global $this ->degrees_array
         */
        $this->degrees_array = array();
        $Degrees = DB::table('degrees')->get();
        foreach ($Degrees as $deg) {
            $this->degrees_array[$deg->id] = $deg->name;
        }
    }

    public function get_job_posts()
    {
        return JobPost::where('data_id', 0)->get();
    }

    public function apply_status(Request $request)
    {
        $post = $request->all();
        $apply_arr = config('app.enum_apply_status');
        $apply_id = $post['apply_id'];
        $status = intval($post['status']);
        $applies_table = DB::table('applies')->where('id', '=', $apply_id)->get()->last();
        if (isset($applies_table->status)) {

            $result = DB::table('applies')
                ->where('id', $apply_id)
                ->update(['status' => $status]);
            if ($result == "1") {
                $a = ['status' => 1, 'message' => 'successful'];
            } else {
                $a = ['status' => 0, 'message' => 'error or duplicate update'];
            }
            echo json_encode($a);
            exit;

        } else {
            $a = ['status' => 0, 'message' => 'apply_id not found'];
            echo json_encode($a);
            exit;
        }
    }

    public function get_institute_structure()
    {

        $arr = config('app.enum_institute_structure');
        $arr2 = [];
        $a = 0;
        foreach ($arr as $as) {
            $a++;
            $arr2[] = ["id" => $a, "name" => $as];
        }
        $j = json_encode($arr2);
        echo $j;
        exit;
    }

    public function get_job_departments()
    {
        return JobDepartment::where('data_id', 0)->get();
    }

    public function get_job_organizational_category()
    {
        return JobOrganizationalCategory::all();
    }

    public function get_job_general_skills()
    {
        return JobGeneralMerites::all();
    }

    public function get_job_special_skills()
    {
        $jobs_professional_merites = array_unique(DB::table('job_has_professional_merites')
            ->pluck('professional_merites_id')->toArray());
        $job_professional_merites = JobProfessionalMerites::whereIn('id', $jobs_professional_merites)->get();

        return $job_professional_merites;
    }

    public function get_cities()
    {
        $result = [];

        foreach (City::all() as $item)
            $result[] = (object)[
                'id' => $item->id,
                'name' => $item->province->name . ' - ' . $item->name
            ];

        return $result;
    }

    public function get_provinces()
    {
        return Province::all();
    }

    public function get_industries()
    {
        return Industry::all();
    }

    public function get_min_education()
    {
        $enum_degrees = $this->degrees_array;
        $result = [];
        foreach ($enum_degrees as $key => $item) {
            $result[] = (object)[
                'id' => $key,
                'name' => $item
            ];
        }

        return $result;
    }

    public function get_cooperation_types()
    {
        return ResumeContractType::all();
    }

    public function get_job_exp()
    {
        $enum_exp_needed = array_values(config('app.enum_exp_needed'));
        $result = [];
        $i = 1;
        foreach ($enum_exp_needed as $item) {
            $result[] = (object)[
                'id' => $i++,
                'name' => $item
            ];
        }

        return $result;
    }

    public function get_companies()
    {
        return Company::all(['id', 'name']);
    }

    /*public function post_create_job(Request $request)
    {
        $rules = array(
            'apply_limit' => 'sometimes|nullable|integer',
            'alias' => 'required|string',
            'pin_status' => 'required|integer|between:0,1',
            //'department' => 'required|integer|exists:job_departments,id',
            'min_education' => 'required|integer|between:0,10',
            'post' => 'required|string|max:256',
            'mobile' => 'required|regex:/[0-9]{11}/u',
            'main_responsibilities' => 'required|string',
            'cooperation_type' => 'required|integer|min:1',
            'gender' => 'required|integer|between:1,3',
            'company' => 'required|integer|exists:companies,id',
            'city_id' => 'required|array|min:1',
            'industry_id' => 'required|integer|exists:industries,id',
            'status' => 'required|integer|between:1,3',
            'images' => 'nullable|string',
            'jobExp' => 'nullable|string',
            'field' => 'nullable|string',
            'goal_or_mission' => 'required|string',
            'general_skill' => 'required|array|min:1|max:100',
            'general_skill.*.name' => 'required|string|min:1|max:256',
            'general_skill.*.value' => 'required|int|between:1,4',
            'special_skill' => 'required|array|min:1|max:100',
            'special_skill.*.name' => 'required|string|min:1|max:256',
            'special_skill.*.value' => 'required|int|between:1,4',
            'questions' => 'nullable|array',
            'questions.*.question' => 'nullable|string|max:255',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->messages();
        }
        $company_flag = Company::where('id',$request['company'])->first()->flag;

        $job = new Job();
        if($company_flag == 0) {
            $job->title = $request['post'];

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
            $job->alias = strtolower($job->alias);
            $job->pin_status = $request['pin_status'];
            $job->department_id = $request['department'];
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
            $job->field = $request['field'];
            $job->expire_date = Carbon::now()->timezone('Asia/Tehran')->addDay(30);
            $job->apply_limit = $request['apply_limit'];

            // M.M.Kia
            // 1398/01/18
            $job->PortalAddress = $request['PortalAdrs'];
            $job->ItemId = $request['ItemID'];
            $job->PortalStatus = $request['status'];

            $mobile = $request['mobile'];
            $user = User::where('mobile', $mobile)->get()->first();

            if (
                !$user ||
                (!in_array($request['company'], $user->company->pluck('id')->toArray()) && !auth()->user()->hasAnyRole('برنامه نویس|سوپرادمین'))
            )
                return ['ادمین موردنظر یافت نشد یا مربوط به شرکت انتخاب شده نمی باشد.'];

            $job->created_by = $user->id;
            $job->modified_by = $user->id;

            if (JobPost::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $request['post']))->count() == 0) {
                JobPost::create(['name' => $request['post']]);
                $post_id = JobPost::where('name', $request['post'])->first()->id;
            } else {
                $post_id = JobPost::where('name', $request['post'])->first()->id;
            }
            $job->post_id = $post_id;
        }
        else
        {
            $job->title = $request['api_post_name'];

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
            $job->alias = strtolower($job->alias);
            $job->pin_status = $request['pin_status'];
           // $job->department_id = $request['department'];
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
            $job->field = $request['field'];
            $job->expire_date = Carbon::now()->timezone('Asia/Tehran')->addDay(30);
            $job->apply_limit = $request['apply_limit'];

            // M.M.Kia
            // 1398/01/18
            $job->PortalAddress = $request['PortalAdrs'];
            $job->ItemId = $request['ItemID'];
            $job->PortalStatus = $request['status'];
            $job->api_post_id  = $request['api_post_id'];
            $job->api_serial_number_post  = $request['api_serial_number_post'];
            $job->api_department_id  = $request['api_department_id'];

            $api_dep_name = $request['api_department_name'];
            $api_post_name = $request['api_post_name'];

            $mobile = $request['mobile'];
            $user = User::where('mobile', $mobile)->get()->first();

            if (
                !$user ||
                (!in_array($request['company'], $user->company->pluck('id')->toArray()) && !auth()->user()->hasAnyRole('برنامه نویس|سوپرادمین'))
            )
                return ['ادمین موردنظر یافت نشد یا مربوط به شرکت انتخاب شده نمی باشد.'];

            $job->created_by = $user->id;
            $job->modified_by = $user->id;

            if (JobDepartment::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $request['api_department_name']))->count() == 0) {
                JobDepartment::create(['name' => $request['api_department_name'], 'data_id' => $request['api_department_id'], 'company_id' =>$request['company'] ]);
                $job->department_id  = JobDepartment::where('name' , $request['api_department_name'])->first()->id;

            }


            if (JobPost::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $request['api_post_name']))->count() == 0) {
                $department_id  = JobDepartment::where('name' , $request['api_department_name'])->first()->id;

                JobPost::create(['name' => $request['api_post_name'],'data_id'=> $request['api_post_id'],'department_id'=>$department_id]);

                $post_id = JobPost::where('name', $request['api_post_name'])->first()->id;
            } else {
                $post_id = JobPost::where('name', $request['api_post_name'])->first()->id;
            }
            $job->post_id = $post_id;
            $job->post_id = $post_id;
        }

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
        if($company_flag == 0) {
            $general_skill = $request['general_skill'];
            foreach ($general_skill as $item) {

                $merit = JobGeneralMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $item['name']))->first();
                if (!$merit) {
                    JobGeneralMerites::create(['name' => $item['name']]);
                    $merit = JobGeneralMerites::where('name', $item['name'])->first();
                }
                $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);
            }
            # end of job_general_merites


            # start of job_general_merites
            $special_skill = $request['special_skill'];
            foreach ($special_skill as $item) {
                $merit = JobProfessionalMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $item['name']))->first();
                if (!$merit) {
                    JobProfessionalMerites::create(['name' => $item['name']]);
                    $merit = JobProfessionalMerites::where('name', $item['name'])->first();
                }
                $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);
            }
            # end of job_general_merites
        }
        else
        {
            $general_skill = $request['general_skill'];
            foreach ($general_skill as $item) {

                $merit = JobGeneralMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $item['name']))->first();
                if (!$merit) {
                    JobGeneralMerites::create(['name' => $item['name'], 'general_data_id' => $item['id']]);
                    $merit = JobGeneralMerites::where('name', $item['name'])->first();
                }
                $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);
            }
            # end of job_general_merites


            # start of job_general_merites
            $special_skill = $request['special_skill'];
            foreach ($special_skill as $item) {
                $merit = JobProfessionalMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $item['name']))->first();
                if (!$merit) {
                    JobProfessionalMerites::create(['name' => $item['name'], 'professional_data_id' => $item['id']]);
                    $merit = JobProfessionalMerites::where('name', $item['name'])->first();
                }
                $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);
            }
        }

        return $job;
    }*/

    public function post_create_job_old(Request $request)
    {
        $rules = array(
            'apply_limit' => 'sometimes|nullable|integer',
            'alias' => 'required|string',
            'pin_status' => 'required|integer|between:0,1',
            'department' => 'required|integer|exists:job_departments,id',
            'min_education' => 'required|integer|between:0,10',
            'post' => 'required|string|max:256',
            'mobile' => 'required|regex:/[0-9]{11}/u',
            'main_responsibilities' => 'required|string',
            'cooperation_type' => 'required|integer|min:1',
            'gender' => 'required|integer|between:1,3',
            'company' => 'required|integer|exists:companies,id',
            'city_id' => 'required|array|min:1',
            'industry_id' => 'required|integer|exists:industries,id',
            'status' => 'required|integer|between:1,3',
            'images' => 'nullable|string',
            'jobExp' => 'nullable|string',
            'field' => 'nullable|string',
            'goal_or_mission' => 'required|string',
            'general_skill' => 'required|array|min:1|max:100',
            'general_skill.*.name' => 'required|string|min:1|max:256',
            'general_skill.*.value' => 'required|int|between:1,4',
            'special_skill' => 'required|array|min:1|max:100',
            'special_skill.*.name' => 'required|string|min:1|max:256',
            'special_skill.*.value' => 'required|int|between:1,4',
            'questions' => 'nullable|array',
            'questions.*.question' => 'nullable|string|max:255',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->messages();
        }

        $job = new Job();
        $job->title = $request['post'];

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
        $job->alias = strtolower($job->alias);
        $job->pin_status = $request['pin_status'];
        $job->department_id = $request['department'];
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
        $job->field = $request['field'];
        $job->expire_date = Carbon::now()->timezone('Asia/Tehran')->addDay(30);
        $job->apply_limit = $request['apply_limit'];

        // M.M.Kia
        // 1398/01/18
        $job->PortalAddress = $request['PortalAdrs'];
        $job->ItemId = $request['ItemID'];
        $job->PortalStatus = $request['status'];

        $mobile = $request['mobile'];
        $user = User::where('mobile', $mobile)->get()->first();

        if (
            !$user ||
            (!in_array($request['company'], $user->company->pluck('id')->toArray()) && !$user->hasAnyRole('برنامه نویس|سوپرادمین'))
        )
            return ['ادمین موردنظر یافت نشد یا مربوط به شرکت انتخاب شده نمی باشد.'];

        $job->created_by = $user->id;
        $job->modified_by = $user->id;

        if (JobPost::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $request['post']))->count() == 0) {
            JobPost::create(['name' => $request['post']]);
            $post_id = JobPost::where('name', $request['post'])->first()->id;
        } else {
            $post_id = JobPost::where('name', $request['post'])->first()->id;
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
        $general_skill = $request['general_skill'];
        foreach ($general_skill as $item) {

            $merit = JobGeneralMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $item['name']))->first();
            if (!$merit) {
                JobGeneralMerites::create(['name' => $item['name']]);
                $merit = JobGeneralMerites::where('name', $item['name'])->first();
            }
            $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);
        }
        # end of job_general_merites


        # start of job_general_merites
        $special_skill = $request['special_skill'];
        foreach ($special_skill as $item) {
            $merit = JobProfessionalMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $item['name']))->first();
            if (!$merit) {
                JobProfessionalMerites::create(['name' => $item['name']]);
                $merit = JobProfessionalMerites::where('name', $item['name'])->first();
            }
            $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);
        }
        # end of job_general_merites

        return $job;
    }

    public function post_create_job(Request $request)
    {
        \Illuminate\Support\Facades\Storage::append('api_postcreatejob_error.txt', "\n" . date('Y-m-d H:m') . ' ===> ' . json_encode($request->all()));
        $rules = array(
            'apply_limit' => 'sometimes|nullable|integer',
            'alias' => 'required|string',
            'pin_status' => 'required|integer|between:0,1',
            'department' => 'required|integer|exists:job_departments,id',
            'min_education' => 'required|integer|between:0,10',
            'post' => 'required|string|max:256',
            'mobile' => 'required|regex:/[0-9]{11}/u',
            'main_responsibilities' => 'required|string',
            'cooperation_type' => 'required|integer|min:1',
            'gender' => 'required|integer|between:1,3',
            'company' => 'required|integer|exists:companies,id',
            'city_id' => 'required|array|min:1',
            'industry_id' => 'required|integer|exists:industries,id',
            'status' => 'required|integer|between:1,3',
            'images' => 'nullable|string',
            'jobExp' => 'nullable|string',
            'field' => 'nullable|string',
            'goal_or_mission' => 'required|string',
            'general_skill' => 'required|array|min:1|max:100',
            'general_skill.*.name' => 'required|string|min:1|max:256',
            'general_skill.*.value' => 'required|int|between:1,4',
            'special_skill' => 'required|array|min:1|max:100',
            'special_skill.*.name' => 'required|string|min:1|max:256',
            'special_skill.*.value' => 'required|int|between:1,4',
            'questions' => 'nullable|array',
            'questions.*.question' => 'nullable|string|max:255',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->messages();
        }

        $job = new Job();
        $job->title = $request['post'];

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
        $job->alias = strtolower($job->alias);
        $job->pin_status = $request['pin_status'];
        $job->department_id = $request['department'];
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
        $job->field = $request['field'];
        $job->expire_date = Carbon::now()->timezone('Asia/Tehran')->addDay(30);
        $job->apply_limit = $request['apply_limit'];

        // M.M.Kia
        // 1398/01/18
        $job->PortalAddress = $request['PortalAdrs'];
        $job->ItemId = $request['ItemID'];
        $job->PortalStatus = $request['status'];

        $mobile = $request['mobile'];
        $user = User::where('mobile', $mobile)->get()->first();

        if (
            !$user ||
            (!in_array($request['company'], $user->company->pluck('id')->toArray()) && !$user->hasAnyRole('برنامه نویس|سوپرادمین'))
        )
            return ['ادمین موردنظر یافت نشد یا مربوط به شرکت انتخاب شده نمی باشد.'];
        if (Job::where('ItemId', $request['ItemID'])->count())
            return ['آگهی تکراری است'];

        $job->created_by = $user->id;
        $job->modified_by = $user->id;

        if (JobPost::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $request['post']))->count() == 0) {
            JobPost::create(['name' => $request['post']]);
            $post_id = JobPost::where('name', $request['post'])->first()->id;
        } else {
            $post_id = JobPost::where('name', $request['post'])->first()->id;
        }
        $job->post_id = $post_id;
        $company = Company::where('id', $request['company'])->first();

        $company_name = str_replace(array(' ', '/'), array('-', '-'), $company->name);
        $post_title_alias = $request['post'];
        $post_title_alias = str_replace(array(' ', '/'), array('-', '-'), $post_title_alias);
        $created = date('Y-m-d');

        $persian_alias = $company_name . '_' . $post_title_alias . '_' . $created;
        $job->persian_alias = $persian_alias;

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
        $general_skill = $request['general_skill'];
        foreach ($general_skill as $item) {

            $merit = JobGeneralMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $item['name']))->first();
            if (!$merit) {
                JobGeneralMerites::create(['name' => $item['name']]);
                $merit = JobGeneralMerites::where('name', $item['name'])->first();
            }
            $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);
        }
        # end of job_general_merites


        # start of job_general_merites
        $special_skill = $request['special_skill'];
        foreach ($special_skill as $item) {
            $merit = JobProfessionalMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $item['name']))->first();
            if (!$merit) {
                JobProfessionalMerites::create(['name' => $item['name']]);
                $merit = JobProfessionalMerites::where('name', $item['name'])->first();
            }
            $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);
        }
        # end of job_general_merites

        return $job;
    }

    public function post_create_job_using_gng(Request $request)
    {

        \Illuminate\Support\Facades\Storage::append('api_postcreatejob_error_using_gng.txt', "\n" . date('Y-m-d H:m') . ' ===> ' . json_encode($request->all()));
        $rules = array(
            'apply_limit' => 'sometimes|nullable|integer',
            'alias' => 'required|string',
            'gng_department_title' => 'required',
            'gng_departmet_id' => 'required',
            'gng_post_title' => 'required',
            'gng_post_id' => 'required',
            'pin_status' => 'required|integer|between:0,1',
            //'department' => 'required|integer|exists:job_departments,id',
            'min_education' => 'required|integer|between:0,10',
            //'post' => 'required|string|max:256',
            'mobile' => 'required|regex:/[0-9]{11}/u',
            'main_responsibilities' => 'required|string',
            'cooperation_type' => 'required|integer|min:1',
            'gender' => 'required|integer|between:1,3',
            'company' => 'required|integer|exists:companies,id',
            'city_id' => 'required|array|min:1',
            'industry_id' => 'required|integer|exists:industries,id',
            'status' => 'required|integer|between:1,3',
            'images' => 'nullable|string',
            'jobExp' => 'nullable|string',
            'goal_or_mission' => 'required|string',
            'general_skill' => 'required|array|min:1|max:100',
            'general_skill.*.value' => 'required|int|between:1,4',
            'special_skill' => 'required|array|min:1|max:100',
            'special_skill.*.value' => 'required|int|between:1,4',
            'questions' => 'nullable|array',
            'questions.*.question' => 'nullable|string|max:255',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->messages();
        }

        $job = new Job();
        $job->title = $request['post'];


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
        $job->alias = strtolower($job->alias);
        $job->pin_status = $request['pin_status'];
        $job->min_education = Degree::where('data_id', $request['min_education'])->first()->id;
        $job->company_id = $request['company'];
        $job->cooperation_type = $request['cooperation_type'];
        $job->gender = $request['gender'];
        $job->goal_or_mission = $request['goal_or_mission'];
        $job->main_responsibilities = $request['main_responsibilities'];
        $job->job_other_features = $request['other_features'];
        $job->status = $request['status'];
        $job->industry_id = $request['industry_id'];
        $job->jobExp = $request['jobExp'];
        $job->expire_date = Carbon::now()->timezone('Asia/Tehran')->addDay(30);
        $job->apply_limit = $request['apply_limit'];
        $job->PortalAddress = $request['PortalAdrs'];
        $job->ItemId = $request['ItemID'];
        $job->PortalStatus = $request['status'];
        $job->api_field_id = $db_field_id[0]->id;

        $mobile = $request['mobile'];
        $user = User::where('mobile', $mobile)->get()->first();
        $company = Company::where('id', $request['company'])->first();

        if (
            !$user ||
            (!in_array($request['company'], $user->company->pluck('id')->toArray()) && !$user->hasAnyRole('برنامه نویس|سوپرادمین'))
        )
            return ['ادمین موردنظر یافت نشد یا مربوط به شرکت انتخاب شده نمی باشد.'];
        if (Job::where('ItemId', $request['ItemID'])->count())
            return ['آگهی تکراری است'];

        $job->created_by = $user->id;
        $job->modified_by = $user->id;
        $company_name = str_replace(array(' ', '/'), array('-', '-'), $company->name);
        $post_title_alias = $request['post'];
        $post_title_alias = str_replace(array(' ', '/'), array('-', '-'), $post_title_alias);
        $created = date('Y-m-d');

        $persian_alias = $company_name . '_' . $post_title_alias . '_' . $created;
        $job->persian_alias = $persian_alias;
        if ($company->flag == 0) {
            $job->department_id = $request['gng_departmet_id'];
            if (JobPost::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $request['post']))->count() == 0) {
                JobPost::create(['name' => $request['post']]);
                $post_id = JobPost::where('name', $request['post'])->first()->id;
            } else {
                $post_id = JobPost::where('name', $request['post'])->first()->id;
            }
            $job->post_id = $post_id;

        } else {
            $gng_field_id = $request['gng_field_id'];
            $gng_field_type = $request['gng_field_type'];
            $job->api_field_id = $gng_field_id;
            $db_field_db = DB::select('select id,name from api_education_fields where data_id="' . $gng_field_id . '"');
            $db_field_id = $db_field_db[0]->id;

            $job->api_field_id = $db_field_db[0]->id;
            $job->field = $db_field_db[0]->name;

            $db_field_type_id = DB::select('select id from api_education_field_types where data_id="' . $gng_field_type . '"')[0]->id;

            $job->api_field_id = $db_field_id;
            $job->api_field_type_id = $db_field_type_id;

            $check_job_department_using_title_sql = JobDepartment::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $request['gng_department_title']));


            if ($check_job_department_using_title_sql->count() == 0) {

                $check_job_department_using_serialnumber_sql = JobDepartment::where('data_serial_number', $request['gng_departmet_id']);
                if ($check_job_department_using_serialnumber_sql->count() > 0) {
                    //update
                    $department_id = $check_job_department_using_serialnumber_sql->first()->id;
                    $data = array('name' => $request['gng_department_title']);
                    DB::table('job_departments')
                        ->where('id', $department_id)
                        ->update($data);
                } else {
                    //create
                    JobDepartment::create(['name' => $request['gng_department_title'], 'data_serial_number' => $request['gng_departmet_id'], 'company_id' => $request['company']]);

                }

                $department_id = JobDepartment::where('name', $request['gng_department_title'])->first()->id;
                $job->department_id = $department_id;


            } else {
                $department = JobDepartment::where('name', $request['gng_department_title'])->first();
                $department_id = $department->id;
                $job->department_id = $department_id;
                if ($company->flag == 1 && $department->data_serial_number == 0) {

                    $data = array('data_serial_number' => $request['gng_departmet_id']);
                    DB::table('job_departments')
                        ->where('id', $department_id)
                        ->update($data);
                }
            }


            if (JobPost::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $request['gng_post_title']))->count() == 0) {
                if ($company->flag == 1) {
                    $department_id = JobDepartment::where('name', $request['gng_department_title'])->first()->id;

                    $check_job_post_using_serialnumber_sql = JobPost::where('data_serial_number', $request['gng_post_id']);


                    if ($check_job_post_using_serialnumber_sql->count() > 0) {
                        //update
                        $post_id = $check_job_post_using_serialnumber_sql->first()->id;
                        $data = array('name' => $request['gng_post_title'], 'department_id' => $department_id);
                        DB::table('job_posts')
                            ->where('id', $post_id)
                            ->update($data);
                    } else {
                        //create
                        JobPost::create(['name' => $request['gng_post_title'], 'data_serial_number' => $request['gng_post_id'], 'department_id' => $department_id]);
                        $post_id = JobPost::where('name', $request['gng_post_title'])->first()->id;

                    }

                    // JobPost::create(['name' => $post_title,'data_id'=> $post_and_id[1],'department_data_id'=>$department_and_id[1]]);

                } else {
                    JobPost::create(['name' => $request['gng_post_title']]);
                    $post_id = JobPost::where('name', $request['gng_post_title'])->first()->id;
                }
            } else {
                $post = JobPost::where('name', $request['gng_post_title'])->first();
                $post_id = $post->id;
                if ($company->flag == 1 && $post->data_serial_number == 0) {
                    $data = array('data_serial_number' => $request['gng_post_id']);
                    DB::table('job_posts')
                        ->where('id', $post_id)
                        ->update($data);
                }
            }
            //  die($post_id.'***');
            $job->post_id = $post_id;
            $job->title = $request['gng_post_title'];


        }
        $job->save();


        $api_company_id = $company['data_id'];


        session()->put('gng_apply_baseurl', $company['gng_apply_baseurl']);
        session()->put('gng_hr_baseurl', $company['gng_hr_baseurl']);
        session()->put('gng_master_baseurl', $company['gng_master_baseurl']);
        session()->put('token', CurlImpersonated::impersonatedLogin($api_company_id));
        $token = session()->get('token');


        $gng_apply_baseurl = session()->get('gng_apply_baseurl');
        $gng_hr_baseurl = session()->get('gng_hr_baseurl');
        $gng_master_baseurl = session()->get('gng_master_baseurl');

        $baseurl = ["gng_apply_baseurl" => $gng_apply_baseurl, "gng_hr_baseurl" => $gng_hr_baseurl, "gng_master_baseurl" => $gng_master_baseurl];

        $merit_array = (json_decode(CurlImpersonated::merites($token, $request['gng_post_id'], $baseurl)))->data;
        $gng_generalmerit_array = [];
        $gng_generalmerit_name = [];
        $gng_generalmerit_value = [];

        $gng_professionalmerit_array = [];
        $gng_professionalmerit_name = [];
        $gng_professionalmerit_value = [];
        foreach ($merit_array as $merit) {
            if ($merit->postMeritTypeCode == 1) {
                $gng_generalmerit_name[] = $merit->postMeritCodeName;
                $gng_generalmerit_value[] = $merit->postMeritCode;

            } else if ($merit->postMeritTypeCode == 2) {
                $gng_professionalmerit_name[] = $merit->postMeritCodeName;
                $gng_professionalmerit_value[] = $merit->postMeritCode;
            }
            // $gng_professionalmerit_array[] = [$merit->postMeritCode=>$merit->postMeritCodeName];
        }
        #die(json_encode($gng_generalmerit_name));
        $gng_generalmerit_array = array_combine($gng_generalmerit_value, $gng_generalmerit_name);
        $gng_professionalmerit_array = array_combine($gng_professionalmerit_value, $gng_professionalmerit_name);

        if ($company->flag == 0) {

            # start of job_general_merites = [];


            $general_skill = $request['general_skill'];
            foreach ($general_skill as $item) {
                if (array_key_exists($item['id'], $gng_generalmerit_array)) {
                    $general_name = $gng_generalmerit_array[$item['id']];
                }

                $merit = JobGeneralMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $general_name))->first();
                if (!$merit) {
                    $date = date('Y-m-d H:i:s');

                    $data = array('name' => $general_name, 'general_data_id' => $item['id'], 'created_at' => $date, 'updated_at' => $date);
                    DB::table('job_general_merites')->insert($data);
                    $merit = JobGeneralMerites::where('name', $general_name)->first();
                }
                $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);
            }
            # end of job_general_merites


            # start of job_general_merites
            $special_skill = $request['special_skill'];
            foreach ($special_skill as $item) {
                if (array_key_exists($item['id'], $gng_professionalmerit_array)) {
                    $professional_name = $gng_professionalmerit_array[$item['id']];
                }

                $merit = JobProfessionalMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $professional_name))->first();
                if (!$merit) {
                    JobProfessionalMerites::create(['name' => $item['name']]);

                    $date = date('Y-m-d H:i:s');

                    $data = array('name' => $professional_name, 'general_data_id' => $item['id'], 'created_at' => $date, 'updated_at' => $date);
                    DB::table('job_professional_merites')->insert($data);
                    $merit = JobProfessionalMerites::where('name', $professional_name)->first();
                }
                $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);
            }
            # end of job_general_merites

        } else {
            $general_skill = $request['general_skill'];

            foreach ($general_skill as $item) {
                if (array_key_exists($item['data_id'], $gng_generalmerit_array)) {
                    $general_name = $gng_generalmerit_array[$item['data_id']];
                }

                $merit = JobGeneralMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $general_name))->first();
                if (!$merit) {
                    $date = date('Y-m-d H:i:s');

                    $data = array('name' => $general_name, 'general_data_id' => $item['data_id'], 'created_at' => $date, 'updated_at' => $date);
                    var_dump($gng_generalmerit_array[$item['data_id']]);
                    DB::table('job_general_merites')->insert($data);
                    $merit = JobGeneralMerites::where('name', $general_name)->first();
                }       // var_dump($gng_generalmerit_array[$item['data_id']]);

                $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);
            }

            # end of job_general_merites


            # start of job_general_merites
            $special_skill = $request['special_skill'];
            foreach ($special_skill as $item) {
                if (array_key_exists($item['data_id'], $gng_professionalmerit_array)) {
                    $professional_name = $gng_professionalmerit_array[$item['data_id']];
                }

                $merit = JobProfessionalMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $professional_name))->first();
                if (!$merit) {
                    JobProfessionalMerites::create(['name' => $item['name']]);

                    $date = date('Y-m-d H:i:s');

                    $data = array('name' => $professional_name, 'general_data_id' => $item['data_id'], 'created_at' => $date, 'updated_at' => $date);
                    DB::table('job_professional_merites')->insert($data);
                    $merit = JobProfessionalMerites::where('name', $professional_name)->first();
                }
                $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);
            }

        }

        if (isset($request['questions'])) {
            foreach ($request['questions'] as $item) {
                $q = new JobQuestions();
                $q->question = $item['question'];
                $q->job_id = $job->id;
                $q->save();
            }
        }
        foreach ($request['city_id'] as $item) {
            $city_id = city::where('data_id', $item)->first()->id;
            $job->cities()->attach($city_id);
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
        return $job;

    }


    public function post_edit_job(Request $request)
    {
        $rules = array(
            'id' => 'required|integer|exists:jobs,id',
            'apply_limit' => 'sometimes|nullable|integer',
            'alias' => 'required|string',
            'pin_status' => 'required|integer|between:0,1',
            'department' => 'required|integer|exists:job_departments,id',
            'min_education' => 'required|integer|between:0,10',
            'post' => 'required|string|max:256',
            'mobile' => 'required|regex:/[0-9]{11}/u',
            'main_responsibilities' => 'required|string',
            'cooperation_type' => 'required|integer|min:1',
            'gender' => 'required|integer|between:1,3',
            'company' => 'required|integer|exists:companies,id',
            'city_id' => 'required|array|min:1',
            'industry_id' => 'required|integer|exists:industries,id',
            'status' => 'required|integer|between:1,3',
            'images' => 'nullable|string',
            'jobExp' => 'nullable|string',
            'field' => 'nullable|string',
            'goal_or_mission' => 'required|string',
            'general_skill' => 'required|array|min:1|max:100',
            'general_skill.*.name' => 'required|string|min:1|max:256',
            'general_skill.*.value' => 'required|int|between:1,4',
            'special_skill' => 'required|array|min:1|max:100',
            'special_skill.*.name' => 'required|string|min:1|max:256',
            'special_skill.*.value' => 'required|int|between:1,4',
            'questions' => 'sometimes|required|array|min:1|max:100',
            'questions.*.question' => 'sometimes|required|string|max:255',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $validator->messages();
        }


        $job = Job::FindOrFail($request['id']);

        $job->title = $request['post'];
        if ($request['alias'] != $job->alias) {
            $job->alias = str_replace(' ', '-', $request['alias']);
            if (Job::where('alias', $job->alias)->count())
                $job->alias .= '-' . (string)Job::where('alias', $job->alias)->count();
            $job->alias = strtolower($job->alias);
        }
        $job->pin_status = $request['pin_status'];
        $job->department_id = $request['department'];
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
        $job->field = $request['field'];
        $job->expire_date = Carbon::now()->timezone('Asia/Tehran')->addDay(30);
        $job->apply_limit = $request['apply_limit'];

        // M.M.Kia
        // 1398/01/18
        $job->PortalAddress = $request['PortalAdrs'];
        $job->ItemId = $request['ItemID'];
        $job->PortalStatus = $request['status'];

        $mobile = $request['mobile'];
        $user = User::where('mobile', $mobile)->get()->first();

        if (
            !$user ||
            (!in_array($request['company'], $user->company->pluck('id')->toArray()) && !auth()->user()->hasAnyRole('برنامه نویس|سوپرادمین'))
        )
            return ['ادمین موردنظر یافت نشد یا مربوط به شرکت انتخاب شده نمی باشد.'];

        $job->created_by = $user->id;
        $job->modified_by = $user->id;

        if (JobPost::where('name', $request['post'])->count() == 0) {
            JobPost::create(['name' => $request['post']]);
            $post_id = JobPost::where('name', $request['post'])->first()->id;
        } else {
            $post_id = JobPost::where('name', $request['post'])->first()->id;
        }
        $job->post_id = $post_id;

        $job->save();

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

        $job->job_general_merites()->detach();
        $job->job_professional_merites()->detach();

        # start of job_general_merites
        $general_skill = $request['general_skill'];
        foreach ($general_skill as $item) {

            $merit = JobGeneralMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $item['name']))->first();
            if (!$merit) {
                JobGeneralMerites::create(['name' => $item['name']]);
                $merit = JobGeneralMerites::where('name', $item['name'])->first();
            }
            $job->job_general_merites()->attach([$merit->id => ['value' => $item['value']]]);
        }
        # end of job_general_merites


        # start of job_general_merites
        $special_skill = $request['special_skill'];
        foreach ($special_skill as $item) {
            $merit = JobProfessionalMerites::where(DB::raw('replace(name, " ", "")'), str_replace(' ', '', $item['name']))->first();
            if (!$merit) {
                JobProfessionalMerites::create(['name' => $item['name']]);
                $merit = JobProfessionalMerites::where('name', $item['name'])->first();
            }
            $job->job_professional_merites()->attach([$merit->id => ['value' => $item['value']]]);
        }
        # end of job_general_merites

        return $job;
    }

    public function get_confirmed_users()
    {

        $rules = array(
            'job_id' => 'required|integer|exists:jobs,id'
        );


        $validator = Validator::make(request()->all(), $rules);
        if ($validator->fails()) {
            return $validator->messages();
        }

        $applies = \HR\Apply
            ::leftjoin('users', 'applies.user_id', '=', 'users.id')
            ->leftjoin('resumes', 'resumes.user_id', '=', 'users.id')
            ->leftjoin('user_profiles', 'user_profiles.user_id', '=', 'users.id')
            ->leftjoin('provinces', 'provinces.id', '=', 'user_profiles.province_id')
            ->leftjoin('cities', 'cities.id', '=', 'user_profiles.city_id')
            ->leftjoin('resume_educational_details', 'resume_educational_details.resume_id', '=', 'resumes.id')
            ->select('users.id as user_id',
                'applies.id as apply_id',
                'applies.created_at as apply_date',
                'users.first_name',
                'users.last_name',
                'users.mobile as mobile',
                'user_profiles.home_phone as home_phone',
                'user_profiles.neighborhood as district',
                'provinces.name as province_name',
                'cities.name as city_name',
                'user_profiles.born_date as born_date',
                'user_profiles.national_code as national_code',
                'resume_educational_details.grade as level',
                'resume_educational_details.field',
                'resume_educational_details.institute'
            )
            ->where('applies.job_id', request('job_id'))
            ->where('applies.status', 4)
            ->groupBy('users.id')
            ->havingRaw('resume_educational_details.grade = MAX(resume_educational_details.grade)')
            ->get();
        foreach ($applies as $apply) {
            $apply->level = config('app.enum_last_degree')[$apply->level];
        }

        return $applies;
    }

    public function post_view_resume(Request $request)
    {
        $rules = array(
            'apply_id' => 'required|integer|exists:applies,id',
            'job_id' => 'required|integer|exists:jobs,id'
        );

        $validator = Validator::make(request()->all(), $rules);
        if ($validator->fails()) {
            return $validator->messages();
        }

        $apply = Apply::find($request['apply_id']);

        if ($apply->job_id != $request['job_id'])
            return ['درخواست ارسال شده برای این آگهی معتبر نمی باشد.'];

        if (!in_array($request['apply_id'],
            Apply::where('applies.job_id', request('job_id'))
                ->where('applies.status', 4)
                ->pluck('id')->toArray())
        )
            return ['درخواست انتخابی شما در لیست تایید نهایی این آگهی نمی باشد.'];


        $user = User::find($apply->user_id);
        $resume = Resume::find($user->resume->id);

        $view = View::make('site.resume.pdf', compact('resume'));

        $contents = $view->render();

        $pdf = SnappyPdf::loadHtml($contents)
            ->setPaper('A4')
            ->setOrientation('portrait')
            ->setOption('margin-bottom', 30)
            ->setOption('dpi', 300)
            ->setOption('footer-html', 'https://people.golrang.com/resume/footer.html');

        return $pdf->stream('result.pdf');

    }

    public function get_reject_reasons()
    {
        return RejectReasons::all(['id', 'reason']);
    }

    public function getUserHistory(Request $request)
    {
        $mobile = $request['mobile'];
        $detail = $request['detail'];
        //$user_profile = UserProfile::where('user_id',$user_id)->first();
        $userid = User::where('mobile', $mobile)->first()->id;
        //die(json_encode($userid));
        if ($detail == "false") {
            $data = collect(User::with(array(
                'applies' => function ($query) use ($userid) {
                    $query->select('user_id', 'id as people_applicate_id', 'job_id', 'status', 'reject_reason', 'reject_description')->where('user_id', $userid);
                },
                'applies.job' => function ($query) {
                    $query->select('id', 'ItemId', 'post_id');
                },

                'profile' => function ($query) {
                    $query->select('user_id', 'national_code');
                },
                'resume.educational_details',
                'resume.work_experience',
                'applies.job.post' => function ($query) {
                    $query->select('id', 'name', 'data_serial_number');
                }
            ))->where('id', $userid)->get())->map(function ($value, $key) {
                $value['IsBlackList'] = (\GuzzleHttp\json_decode(file_get_contents("http://172.31.2.18/PersonneBlackList/GetCode?CodeMelli=" . $value['national_code'])))->Result;
                $value['cover'] = 'https://people.golrang.com/' . $value['cover'];
                $value['avatar'] = 'https://people.golrang.com/' . $value['avatar'];
                if ($value['cv'] == '')
                    $value['cv'] = '';
                else
                    $value['cv'] = 'https://people.golrang.com/' . $value['cv'];
                return $value;
            });
        } else if ($detail == "true") {
            $data = collect(User::with(array(
                'applies' => function ($query) use ($userid) {
                    $query->select('user_id', 'id as people_applicate_id', 'job_id', 'status', 'reject_reason', 'reject_description')->where('user_id', $userid);
                },
                'profile' => function ($query) {
                    $query->select('user_id', 'national_code');
                },
                'resume.educational_details',
                'resume.work_experience',
                'resume.family' => function ($query) {
                    $query->select('resume_id', 'first_name as FirstName', 'last_name as LastName', 'job as OrganizationPostName', 'organization as CompanyName', 'relation as ApplicantRelativeTypeCode');
                },


                'applies.job.post'))->where('id', $userid)->get())->map(function ($value, $key) {

                foreach($value['resume']['family'] as $val){
                    $val['applicantId'] = 0;
                }

                $value['IsBlackList'] = (\GuzzleHttp\json_decode(file_get_contents("http://172.31.2.18/PersonnelStatus/GetState?MeliCode=" . $value['national_code'])))->Status;

                $value['cover'] = 'https://people.golrang.com/' . $value['cover'];
                $value['avatar'] = 'https://people.golrang.com/' . $value['avatar'];
                $value['file_content'] = json_encode(file_get_contents('https://people.golrang.com/adpanel/cv/' . $value['id'] . '/show.pdf'));
                $value['file_type'] = 'pdf';

                return $value;
            });
        }
        return new JsonResponse($data->all());
    }

    public static function getUserApply($userid)
    {

        $data = collect(User::with(array(
            'applies' => function ($query) {
                $query->select('user_id', 'id as people_applicate_id', 'job_id', 'status', 'reject_reason', 'reject_description');
            },
            'profile' => function ($query) {
                $query->select('user_id', 'national_code', 'born_date');
            },
            'resume.educational_details.api_educations',
            'resume.educational_details.api_education_type',
            'resume.educational_details.api_education_orientation',
            'resume.educational_details.api_education_institute_place',
            'resume.educational_details.api_education_institute_type',
            'resume.work_experience',
            'resume.foreign_languages',
            'applies.job.company',


            'applies.job.post'))->where('id', $userid)->get())->map(function ($value, $key) {
            $value['IsBlackList'] = (\GuzzleHttp\json_decode(file_get_contents("http://172.31.2.18/PersonneBlackList/GetCode?CodeMelli=" . $value['national_code'])))->Result;

            $value['cover'] = 'https://people.golrang.com/' . $value['cover'];
            $value['avatar'] = 'https://people.golrang.com/' . $value['avatar'];
            $value['file_content'] = '';
            $value['resume_url'] = 'https://people.golrang.com/cv/' . $value['id'] . '/show.pdf';
            $value['file_type'] = 'pdf';

            return $value;
        });

        return new JsonResponse($data->all());
    }

    public function generateToken()
    {
        $token = openssl_random_pseudo_bytes(16);
        $token = bin2hex($token);

        $data = array('token' => $token);
        DB::table('tokens')->insert($data);

        $token = collect(array('token' => $token));
        return new JsonResponse($token);
    }

    public function apiGetOnlineCv($national_code, $token)
    {
        $user_id = UserProfile::where('national_code', $national_code)->first()->user_id;
        $resume_id = Resume::where('user_id', $user_id)->first()->id;
        $token_expire = DB::select('select * from tokens where token="' . $token . '" and expire=1 limit 1');
        //  DB::table('tokens')->insert($data);

        /*  if(count($token_expire) > 0 && $token_expire[0]->expire == 0)
          {
              DB::table('tokens')
                  ->where('token', $token)
                  ->update(array('expire' => 1));
              header("Content-type:application/pdf");
              return \Redirect::route('api.resumes.show', ['resume'=>$resume_id]);

          }

          else
             */

        if (count($token_expire) > 0) {
            abort(403);
        } else if ($resume_id > 0) {
            $data = array('token' => $token);

            header("Content-type:application/pdf");
            return \Redirect::route('api.resumes.show', ['resume' => $resume_id, 'token' => $token]);
        } else {

            return view('admin.api.404')->with('books', $books)->with('top_books', $top_books);;
        }


    }

    public function apiGetUploadedCv($id)
    {
        header("Content-type:application/pdf");

        if (\Illuminate\Support\Facades\Storage::disk('resume')->exists('cv/' . myFuncs::spilit_string($id) . '/resume.pdf')) {
            echo Storage::disk('resume')->get('cv/' . myFuncs::spilit_string($id) . '/resume.pdf');
        } else {
            abort(404);
        }
    }

    public function userHistoryWithoutAnyId(Request $request)
    {
        $national_code = $request['national_code'];

        $user_id = UserProfile::where('national_code', $national_code)->first()->user_id;

        $applies = User::with(array(
            'applies' => function ($query) {
                $query->select('user_id', 'id', 'job_id', 'status', 'reject_reason', 'reject_description', 'deleted_at', 'created_at');
            },
            'applies.job' => function ($query) {
                $query->select('id', 'ItemId', 'post_id', 'company_id', 'deleted_at');
            },

            'applies.job.post' => function ($query) {
                $query->select('id', 'name');
            }, 'applies.job.company' => function ($query) {
                $query->select('id', 'name');
            }
        ))->where('id', $user_id)->get();

        $app_status = config('app.enum_apply_status');
        //die(json_encode($applies[0]->applies));
        $user_paplies = $applies[0]->applies;


        if (count($user_paplies) > 0) {
            foreach ($user_paplies as $i => $apply) {
                $date = date('Y-m-d H:i:s', $apply->created_at->timestamp);
                if ($apply->deleted_at)
                    $data['Data'][] = array(
                        'Status' => 'حذف شده توسط کاربر',
                        'Reject_reason' => $apply->reason->reason,
                        'Reject_description' => $apply->reject_description,
                        'Created_at' => $date,
                        'Post' => $apply->job->post->name,
                        'Company' => $apply->job->company->name,
                    );
                else
                    $data['Data'][] = array(
                        'Status' => $app_status[$apply->status],
                        'Reject_reason' => $apply->reason->reason,
                        'Reject_description' => $apply->reject_description,
                        'Created_at' => $date,
                        'Post' => $apply->job->post->name,
                        'Company' => $apply->job->company->name,
                    );
            }
        } else {
            $date = date('Y-m-d H:i:s', $user_paplies->created_at->timestamp);
            if ($user_paplies->deleted_at)
                $data['Data'][] = array(
                    'Status' => 'حذف شده توسط کاربر',
                    'Reject_reason' => $user_paplies->reason->reason,
                    'Reject_description' => $user_paplies->reject_description,
                    'Created_at' => $date,
                    'Post' => $user_paplies->job->post->name,
                    'Company' => $user_paplies->job->company->name,
                );
            else
                $data['Data'][] = array(
                    'Status' => $app_status[$user_paplies->status],
                    'Reject_reason' => $user_paplies->reason->reason,
                    'Reject_description' => $user_paplies->reject_description,
                    'Created_at' => $date,
                    'Post' => $user_paplies->job->post->name,
                    'Company' => $user_paplies->job->company->name,
                );
        }


        return new JsonResponse($data);


    }

    public function updateRecruitmentStatus(Request $request)
    {
        \Illuminate\Support\Facades\Storage::append('update_apply_status_from_gng.txt', "\n" . date('Y-m-d H:m') . ' ===> ' . json_encode($request->all()));

        $post = $request->all();
        $status = $post['status'];
        $userApplicantId = $post['userApplicantId'];

        $affected = DB::table('applies')
            ->where('id', $userApplicantId)
            ->update(array('status' => $status));
        if ($affected == 1) {
            $res['status'] = 1;
            $res['message'] = "رکورد مورد نظر آپدیت شد";

        } else if (Apply::find($request['apply_id'])->status == $status) {
            $res['status'] = 1;
            $res['message'] = "رکورد مورد نظر آپدیت شد";
        } else {
            $res['status'] = 0;
            $res['message'] = "رکورد مورد نظر آپدیت نشد.";
        }


        return new JsonResponse($res);

    }


}