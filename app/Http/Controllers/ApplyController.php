<?php

namespace HR\Http\Controllers;

use DebugBar\Storage\FileStorage;
use HR\Apply;
use HR\City;
use HR\Company;
use HR\CurlImpersonated;
use HR\Job;
use HR\Resume;
use HR\User;
use HR\Degree;
use HR\JobQuestionAnswer;
use HR\Jobs\SendApplyRejectByAdminAlert;
use HR\Jobs\SendApplySeenedByAdminAlert;
use HR\Mail\ApplyRejectByAdminAlert;
use HR\Mail\ApplySeenedByAdminAlert;
use HR\Mail\JobExpirationAlert;
use HR\Message;
use HR\myDate;
use HR\myFuncs;
use HR\RejectReasons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use p3ym4n\JDate\JDate;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Filesystem\Filesystem;


class ApplyController extends Controller
{



    public function __construct()
    {
        $this->middleware(['isAdmin'])->except('store', 'site_index', 'destroy');
        $this->middleware(['auth']);
        $this->middleware('isMobileVerified');
    }
    public function ajax_old(){
        $id = request('id');
        if($id != ''){
            $apply = Apply::find($id);
            $apply->status = 4;
            $apply->save();

            if (!empty($apply->user->email) && is_null($apply->user->is_email_verified))
            {
                $email = new ApplySeenedByAdminAlert($apply);
                Mail::to($apply->user->email)->send($email);
            }

            echo 'تغییر وضعیت با موفقیت انجام شد';
        }else{
            echo 'خطا در تغییر وضعیت';
        }
    }

    public function ajax(){
        $id = request('id');
        $apply  = Apply::find($id);

        if($id != '' && $apply) {

            $db_job = Job::where('id', $apply->job_id)->first();
            $db_company_id = $db_job->company_id;
            if(($db_job->apply_limit && $db_job->apply_limit > 0 && ($db_job->apply_limit > Apply::where("job_id",$apply->job_id)->where("status",2)->count()))||(!$db_job->apply_limit || $db_job->apply_limit == 0))
            {

            /*if (!empty($apply->user->email) && is_null($apply->user->is_email_verified))
            {
                $email = new ApplySeenedByAdminAlert($apply);
                Mail::to($apply->user->email)->send($email);
            }*/


            $company = Company::where('id', $db_company_id)->first();
            $company_flag = $company->flag;
            $gng_apply_baseurl = $company['gng_apply_baseurl'];
            
            
            
            
            if ($company_flag == 1) {

            $user_apply = ApiController::getUserApply($apply->user->id);
            $company_id = Company::where('id',$db_company_id)->first()->data_id;
            $token = CurlImpersonated::impersonatedLogin($company_id);

            $user = $user_apply->getData()[0];
            $first_name = $user->first_name;
            $last_name = $user->last_name;
            /*  if(empty($user->email) || strlen($user->email)< 2)
                  $email      = 'info@infooooo.com';
              else*/
            $email = $user->email;
            $mobile = $user->mobile;
            $bio = $user->bio;

            $avatar = $user->avatar;
            $cover = $user->cover;
            $cv = '';
            if ($user->IsBlackList == 0)
                $isBlackList = 0;
            else
                $isBlackList = 1;
            $people_user_id = $user->id;
            $national_code = $user->profile->national_code;
            $people_applicant_id = $id;
            $people_applicant_id_name = $apply->job->post->name;

            $resume_url = $user->resume_url;
            $check_exist_file = $user->file_content;
            /*            die($check_exist_file.'***');*/
            /* if(Storage::disk('resume')->exists('cv/'.\HR\myFuncs::spilit_string(intval($apply->user->id)).'/resume.pdf'))
                 $cv = base64_encode(file_get_contents('https://people.golrang.com/cv/'.intval($apply->user->id).'/show.pdf'));
             else
                 $cv = '';
             */
            if (strlen(@file_get_contents('https://people.golrang.com/cv/' . intval($apply->user->id) . '/show.pdf')) > 10)
                $cv = base64_encode(file_get_contents('https://people.golrang.com/cv/' . intval($apply->user->id) . '/show.pdf'));
            else
                $cv = '';

            $birth_date = $user->profile->user_born_date;

            $resume_educations = $user->resume->educational_details;
            if (count($resume_educations) > 1) {
                foreach ($resume_educations as $key => $resume_education) {
                    $city_id = City::where('name', 'like', $resume_education->city)->first()->data_id;
                    $gng_grade_id = Degree::where('id', $resume_education->grade)->first()->data_id;
                    $gng_field_type_id = DB::table('api_education_field_types')->where('id', $resume_education->api_education_field_type_id)->first()->data_id;
                    //$gng_field_id  = DB::table('api_education_fields')->where('id',$resume_education->api_education_field_id)->first()->data_id;
                    $gng_orientation_id = DB::table('api_education_orientations')->where('id', $resume_education->api_education_orientation_id)->first()->data_id;
                    $gng_institute_id = DB::table('api_institute_places')->where('id', $resume_education->api_institute_place_id)->first()->data_id;
                    $gng_institute_type_id = DB::table('api_institute_types')->where('id', $resume_education->institute_type)->first()->data_id;

                    $gng_field_id = $resume_education->api_education_field->data_id;


                    $education[$key]['educationDegreeCode'] = $gng_grade_id;
                    $education[$key]['educationFieldTypeCode'] = $gng_field_type_id;
                    $education[$key]['educationFieldCode'] = $gng_field_id;
                    $education[$key]['educationTendencyCode'] = $gng_orientation_id;
                    $education[$key]['instituteCode'] = $gng_institute_id;
                    $education[$key]['instituteTypeCode'] = $gng_institute_type_id;
                    $education[$key]['startDate'] = $resume_education->start_date_education;
                    $education[$key]['endDate'] = $resume_education->end_date_education;
                    $education[$key]['average'] = $resume_education->average;
                    $education[$key]['educationCityId'] = $city_id;
                    $education[$key]['description'] = null;
                    $education[$key]['isCertified'] = 1;
                    $education[$key]['educationTypeCode'] = null;
                }
            } else if (count($resume_educations) == 1) {

                $gng_field_id = $resume_educations[0]->api_educations->data_id;

                $city_id = City::where('name', 'like', $resume_educations[0]->city)->first()->data_id;
                $gng_grade_id = Degree::where('id', $resume_educations[0]->grade)->first()->data_id;
                $gng_field_type_id = DB::table('api_education_field_types')->where('id', $resume_educations[0]->api_education_field_type_id)->first()->data_id;
                // $gng_field_id  = DB::table('api_education_fields')->where('id',$resume_educations[0]->api_education_field_id)->first()->data_id;
                $gng_orientation_id = DB::table('api_education_orientations')->where('id', $resume_educations[0]->api_education_orientation_id)->first()->data_id;
                $gng_institute_id = DB::table('api_institute_places')->where('id', $resume_educations[0]->api_institute_place_id)->first()->data_id;
                $gng_institute_type_id = DB::table('api_institute_types')->where('id', $resume_educations[0]->institute_type)->first()->data_id;


                $education[0]['educationDegreeCode'] = $gng_grade_id;
                $education[0]['educationFieldTypeCode'] = $gng_field_type_id;
                $education[0]['educationFieldCode'] = $gng_field_id;
                $education[0]['educationTendencyCode'] = $gng_orientation_id;
                $education[0]['instituteCode'] = $gng_institute_id;
                $education[0]['instituteTypeCode'] = $gng_institute_type_id;
                $education[0]['startDate'] = $resume_educations[0]->start_date_education;
                $education[0]['endDate'] = $resume_educations[0]->end_date_education;
                $education[0]['average'] = $resume_educations[0]->average;
                $education[0]['educationCityId'] = $city_id;
                $education[0]['description'] = null;
                $education[0]['isCertified'] = 1;
                $education[0]['educationTypeCode'] = null;


            }


            $resume_work_experiences = $user->resume->work_experience;
            if (count($resume_work_experiences) > 1) {
                foreach ($resume_work_experiences as $key => $resume_work_experience) {

                    $WorkExperience[$key]['title'] = $resume_work_experience->title;
                    $WorkExperience[$key]["startDate"] = $resume_work_experience->start_date_experience;
                    $WorkExperience[$key]["endDate"] = $resume_work_experience->end_date_experience;
                    $WorkExperience[$key]["lastPost"] = $resume_work_experience->last_post;
                    $WorkExperience[$key]["lastGivenSalary"] = 0;
                    $WorkExperience[$key]["causeInterruption"] = $resume_work_experience->cause_interruption;
                    $WorkExperience[$key]["phoneNumber"] = $resume_work_experience->phone_number;
                    $WorkExperience[$key]["provinceId"] = $resume_work_experience->province_id;
                    $WorkExperience[$key]["importantTasks"] = $resume_work_experience->important_tasks;
                }
            } elseif (count($resume_work_experiences) == 1) {
                $WorkExperience = [];
                $WorkExperience[0]['title'] = $resume_work_experiences[0]->title;
                $WorkExperience[0]["startDate"] = $resume_work_experiences[0]->start_date_experience;
                $WorkExperience[0]["endDate"] = $resume_work_experiences[0]->end_date_experience;
                $WorkExperience[0]["lastPost"] = $resume_work_experiences[0]->last_post;
                $WorkExperience[0]["lastGivenSalary"] = 0;
                $WorkExperience[0]["causeInterruption"] = $resume_work_experiences[0]->cause_interruption;
                $WorkExperience[0]["phoneNumber"] = $resume_work_experiences[0]->phone_number;
                $WorkExperience[0]["provinceId"] = $resume_work_experiences[0]->province_id;
                $WorkExperience[0]["importantTasks"] = $resume_work_experiences[0]->important_tasks;
            }

            $resume_foreign_languages = $user->resume->foreign_languages;

            $foreignLanguages = [];
            if (count($resume_foreign_languages) > 1) {
                foreach ($resume_foreign_languages as $key => $resume_foreign_language) {
                    $LanguageCode = DB::table('languagesmap')->where('id', $resume_foreign_language->languagesmap_id)->first()->data_id;
                    $foreignLanguages[$key]["LanguageCode"] = $LanguageCode;
                    $foreignLanguages[$key]["WritingSkillCode"] = $resume_foreign_language->writing;
                    $foreignLanguages[$key]["ReadingSkillCode"] = $resume_foreign_language->comprehension;
                    $foreignLanguages[$key]["SpeakingSkillCode"] = $resume_foreign_language->conversation;
                    $foreignLanguages[$key]["ListeningSkillCode"] = null;
                }
            } elseif (count($resume_foreign_languages) == 1) {
                $LanguageCode = DB::table('languagesmap')->where('id', $resume_foreign_languages[0]->languagesmap_id)->first()->data_id;
                $foreignLanguages[0]["LanguageCode"] = $LanguageCode;
                $foreignLanguages[0]["WritingSkillCode"] = $resume_foreign_languages[0]->writing;
                $foreignLanguages[0]["ReadingSkillCode"] = $resume_foreign_languages[0]->comprehension;
                $foreignLanguages[0]["SpeakingSkillCode"] = $resume_foreign_languages[0]->conversation;
                $foreignLanguages[0]["ListeningSkillCode"] = null;

            }


            $data = json_encode(array(
                "peopleUserId" => $apply->user->id,/*$apply->user->id*/
                "firstName" => $first_name,
                "lastName" => $last_name,
                "email" => $email,
                "mobile" => $mobile,
                /*                "ResumeUrl"=>$resume_url,*/

                "isBlackList" => $isBlackList,
                "nationalityNumber" => $national_code,
                "agreedJobGradeCode" => null,
                "agreedSalaryAmount" => 0,
                "agreedJobStartDate" => null,
                "employmentPermitDate" => null,
                "peopleApplicantId" => $id,
                "peopleApplicantIdName" => $people_applicant_id_name,
                "doc_educations" => $education,
                "docJobExp" => $WorkExperience,
                "howToAcquaintedWithCompany" => $user->resume->our,
                "requestedOrganizationPostSerialNumber" => $apply->job->post->data_serial_number,
                "GigCompanyId" => $apply->job->company->data_id,
                "acquaintanceshipTypeCode" => $user->resume->referer,
                "recruitmentPermitId" => $apply->job->ItemId,
                "birthdate" => $birth_date,
                "fileContent" => $cv,
                "foreignLanguages" => $foreignLanguages,


            ));
           /* if(Auth::user()->id == 108738)
            var_dump($data);
            exit();*/
            
            
            $conten_len = strlen($data);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $gng_apply_baseurl.config('app.people_applicant'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    "authorization: $token",
                    "Content-Type: application/json",
                    "Content-Length:$conten_len",

                ),
            ));
            $response = curl_exec($curl);
                    

//die($response);
            Storage::append('jazb_log.txt', "\n" . date('Y-m-d H:i:s') .'   selector => '.Auth::user()->id.   '   job_id => '.$apply->job_id.'  emloyee => '.$apply->user->id .'  ==> get result.  ' .$response. "\n\n");

            $info = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if($info != 200)
            {
                Storage::append('error_message_from_gng.txt', "\n" . date('Y-m-d H:i:s') .'   selector => '.Auth::user()->id.   '   job_id => '.$apply->job_id.  '  emloyee => '.$apply->user->id .'  ==>' . "\n".$response."  ".$info."\n\n");
                $result[] = ['message' => 'خطا در تغییر وضعیت', 'has_error' => 1];
                
                echo json_encode($result);

            }
            
            else if (json_decode($response)->hasError == 1) {
                Storage::append('error_message_from_gng.txt', "\n" . date('Y-m-d H:i:s') .'   selector => '.Auth::user()->id.'  emloyee => '.$apply->user->id .'  ==>' . "\n".$response."\n\n");
                $result[] = ['message' => json_decode($response)->friendlyMessages[0]->message, 'has_error' => 1];
                //$result[] = ['message'=>$response];

                echo json_encode($result);

            } else if($info == 200) {
                $apply->status = 4;
                $apply->save();
                $result[] = ['message' => json_decode($response)->friendlyMessages[0]->message, 'has_error' => 0];
                //$result[] = ['message'=>$response];
                echo json_encode($result);

            }
        }
            else{

                $apply->status = 4;
                $apply->save();
                $result[] = ['message' => 'تغییر وضعیت با موفقیت انجام شد.', 'has_error' => 0];
                //$result[] = ['message'=>$response];
                echo json_encode($result);

            }

        }
        
        else{
            
              $result[] = ['message' => 'خطا در تغییر وضعیت', 'has_error' => 1];
                //$result[] = ['message'=>$response];

                echo json_encode($result);
        
        }
        }
        else{
            
              $result[] = ['message' => 'خطا در تغییر وضعیت', 'has_error' => 1];
                //$result[] = ['message'=>$response];

                echo json_encode($result);
        
        }
    }
    public function firstPriority(){
        $id = request('id');
        $apply  = Apply::find($id);

        if($id != '' && $apply) {

        $db_job = Job::where('id', $apply->job_id)->first();
        if(($db_job->apply_limit && $db_job->apply_limit > 0 && ($db_job->apply_limit > Apply::where("job_id",$apply->job_id)->where("status",2)->count()))||(!$db_job->apply_limit || $db_job->apply_limit == 0))
        {

                $apply->status = 9;
                $apply->save();
                $result[] = ['message' => 'تغییر وضعیت با موفقیت انجام شد.', 'has_error' => 0];
                //$result[] = ['message'=>$response];
                echo json_encode($result);

        
        }
        
        else{
            
              $result[] = ['message' => 'خطا در تغییر وضعیت', 'has_error' => 1];
                //$result[] = ['message'=>$response];

                echo json_encode($result);
        
        }
        }
        else{
            
              $result[] = ['message' => 'خطا در تغییر وضعیت', 'has_error' => 1];
                //$result[] = ['message'=>$response];

                echo json_encode($result);
        
        }
    }
    
    public function secondPriority(){
        $id = request('id');
        $apply  = Apply::find($id);

        if($id != '' && $apply) {

            $db_job = Job::where('id', $apply->job_id)->first();
            if(($db_job->apply_limit && $db_job->apply_limit > 0 && ($db_job->apply_limit > Apply::where("job_id",$apply->job_id)->where("status",2)->count()))||(!$db_job->apply_limit || $db_job->apply_limit == 0))
            {

                $apply->status = 10;
                $apply->save();
                $result[] = ['message' => 'تغییر وضعیت با موفقیت انجام شد.', 'has_error' => 0];
                echo json_encode($result);

        
        }
        
        else{
            
              $result[] = ['message' => 'خطا در تغییر وضعیت', 'has_error' => 1];
              echo json_encode($result);
        
        }
        }
        else{
            
              $result[] = ['message' => 'خطا در تغییر وضعیت', 'has_error' => 1];
              echo json_encode($result);
        
        }
    }



    public function ajaxwaiting(){
        $id = request('id');
        if($id != ''){
            $apply = Apply::find($id);
            $apply->status = 1;
            $apply->save();

            if (!empty($apply->user->email) && is_null($apply->user->is_email_verified))
            {
                $email = new ApplySeenedByAdminAlert($apply);
                Mail::to($apply->user->email)->send($email);
            }

            echo 'تغییر وضعیت با موفقیت انجام شد';
        }else{
            echo 'خطا در تغییر وضعیت';
        }
    }

    public function index($id, $status = 1)
    {

        $apply = Job::find($id);
        $company_flag = $apply->company->flag;
        if($status == 1 || $status == 3)
        {
            $delete_button = 0;
        }
        else if($status !=1 && $company_flag == 1)
        {
            $delete_button = 1;
        }

        $applies = Job::findOrFail($id)->applies()->where('status', $status);

        $new_applies = Job::findOrFail($id)->applies()->where('status', 1)->count();
        $seen_applies = Job::findOrFail($id)->applies()->where('status', 4)->count();
        $rejected_applies = Job::findOrFail($id)->applies()->where('status', 3)->count();
        $accepted_applies = Job::findOrFail($id)->applies()->where('status', 2)->count();

        $reject_reasons = RejectReasons::all();

        # First name contains ...
        if (request('first_name') != '') {
            $first_name = request('first_name');
            $applies->whereHas('user', function ($q) use ($first_name) {
                $q->where('first_name', 'like', '%' . $first_name . '%');
            });
        }

        # Last name contains ...
        if (request('last_name') != '') {
            $last_name = request('last_name');
            $applies->whereHas('user', function ($q) use ($last_name) {
                $q->where('last_name', 'like', '%' . $last_name . '%');
            });
        }

        # mobile contains ...
        if (request('mobile') != '') {
            $mobile = request('mobile');
            $applies->whereHas('user', function ($q) use ($mobile) {
                $q->where('mobile', 'like', '%' . $mobile . '%');
            });
        }

        # email contains ...
        if (request('email') != '') {
            $email = request('email');
            $applies->whereHas('user', function ($q) use ($email) {
                $q->where('email', 'like', '%' . $email . '%');
            });
        }

        #check Age Range
        if (request('age_range') != '') {
            $age_ranges = request('age_range');
            $applies->whereHas('user', function ($q) use ($age_ranges) {
                $q->whereHas('profile', function ($w) use ($age_ranges) {
                    $i = 0;
                    foreach (request('age_range') as $item) {

                        $age_range = explode('-', config('app.age_range')[$item]);
                        $start_date = Carbon::now()->subYear($age_range[0])->format('Y/m/d');
                        $end_date = Carbon::now()->subYear($age_range[1])->format('Y/m/d');
                        if($i == 0)
                            $w->where(DB::raw('DATE(born_date)'), '<=', $start_date)->where(DB::raw('DATE(born_date)'), '>=', $end_date);
                        else
                            $w->orWhere(DB::raw('DATE(born_date)'), '<=', $start_date)->where(DB::raw('DATE(born_date)'), '>=', $end_date);
                        $i++;
                    }
                });
            });

        }

        # Users apply for ...
        if (request('city_id') != '') {
            $city_id = request('city_id');
            $applies->whereHas('cities', function ($q) use ($city_id) {
                $q->where('city_id', $city_id);
            });
        }

        # home_city_id ...
        if (request('home_city_id') != '') {
            $city_id = request('home_city_id');
            $applies->whereHas('user', function ($q) use ($city_id) {
                $q->whereHas('profile', function ($w) use ($city_id) {
                    $w->where('city_id', $city_id);
                });
            });
        }

        # Users From City  ...
        if (request('province_id') != '') {
            $province_id = request('province_id');
            $applies->whereHas('user', function ($q) use ($province_id) {
                $q->whereHas('resume', function ($w) use ($province_id){
                    $w->where('province_id', $province_id);
                });
            });
        }


        # neighborhood LIKE ...
        $neighborhood = request('neighborhood');
        if(!empty($neighborhood) && !is_null($neighborhood)){
            $applies->whereHas('user', function ($q) use ($neighborhood) {
                $q->whereHas('profile', function ($w) use ($neighborhood) {
                    $w->where('neighborhood', $neighborhood);
                });
            });
        }


        # Gender IS ...
        if (request('gender') != '' && request('gender') != 0) {
            $gender = request('gender');
            $applies->whereHas('user', function ($q) use ($gender) {
                $q->whereHas('profile', function ($w) use ($gender) {
                    $w->where('gender', $gender);
                });
            });
        }

        # last degree IS ...
        $degree_selected = request('last_degree');
        if ($degree_selected != '' && is_array($degree_selected)) {
            $applies->whereHas('user', function ($e) use ($degree_selected) {
                $e->whereHas('resume', function ($w) use ($degree_selected) {
                    $w->whereHas('educational_details', function ($q) use ($degree_selected) {
                        $q->groupBy('resume_id')->havingRaw('MAX(grade) IN (' . implode(', ', $degree_selected) . ')');
                    });
                });
            });
        }

        if (request('usertype') != 0) {
            $usertype = request('usertype');
            if($usertype == -1)
                $usertype=0;
                $applies->whereHas('user', function ($q) use ($usertype)  {
                $q->Join('BI_user_status', 'users.id', '=', 'BI_user_status.user_id')->where('BI_user_status.status', $usertype)
                ;
                    $usertype = request('usertype');

                });
        }

        if (request('first_date') != '' && request('first_date') != 0) {
            $first_date = JDate::createFromFormat('Y-m-d', request('first_date'))->carbon->toDateTimeString();
            $applies->whereHas('user', function ($q) use ($first_date) {
                $q->where('created_at', '>=',  $first_date );
            });
        }
        //

        if (request('last_date') != '' && request('last_date') != 0) {
            $last_date  = JDate::createFromFormat('Y-m-d', request('last_date'))->carbon->toDateTimeString();
            $applies->whereHas('user', function ($q) use ($last_date) {
                $q->where('created_at', '<=',  $last_date );
            });
        }

        # all_fields contains ...
        # all_fields contains ...
        if (request('all_fields') != '') {
            $query = request('all_fields');
            $tmp = $applies;
            $apply_users = $tmp->pluck('user_id')->toArray();
            $array = implode(",", $apply_users);
            if(count($apply_users)> 0 )
                $q =  'AND users.id IN ('.$array .')';
            else
                $q = "";
            $users_ids = DB::select("SELECT 
                `users`.`id`
            FROM
                `users`
            LEFT JOIN `resumes` ON `resumes`.`user_id` = `users`.`id`
            LEFT JOIN `resume_has_com_skills` ON `resume_has_com_skills`.`resume_id` = `resumes`.`id`
            LEFT JOIN `resume_has_exp_expertises` ON `resume_has_exp_expertises`.`resume_id` = `resumes`.`id`
            LEFT JOIN `resume_has_p_t_r` ON `resume_has_p_t_r`.`resume_id` = `resumes`.`id`  
            LEFT JOIN `job_professional_merites` AS jpm_com_skill ON `resume_has_com_skills`.`professional_merites_id` = jpm_com_skill.`id`
            LEFT JOIN `job_professional_merites` AS jpm_exp_expertises ON `resume_has_exp_expertises`.`professional_merites_id` = jpm_exp_expertises.`id`
            LEFT JOIN `job_professional_merites` AS jpm_p_t_r ON `resume_has_p_t_r`.`professional_merites_id` = jpm_p_t_r.`id`
             where 
            `resumes`.`id` in (SELECT  distinct(`resume_id`) FROM `resume_work_experiences` where resume_work_experiences.title LIKE '%$query%'
            OR resume_work_experiences.last_post LIKE '%$query%'
            OR resume_work_experiences.cause_interruption LIKE '%$query%'
            OR resume_work_experiences.phone_number LIKE '%$query%'
            OR resume_work_experiences.important_tasks LIKE '%$query%' )
            or `resumes`.`id` in (SELECT  distinct(`resume_id`) FROM `resume_educational_details` where  resume_educational_details.field LIKE '%$query%'
            OR resume_educational_details.orientation LIKE '%$query%'
            OR resume_educational_details.institute LIKE '%$query%'
            OR resume_educational_details.institute LIKE '%$query%'
            OR resume_educational_details.average LIKE '%$query%'
            OR resume_educational_details.city LIKE '%$query%')
            or `resumes`.`id` in (SELECT  distinct(`resume_id`) FROM `resume_family_details`  where  resume_family_details.name LIKE '%$query%'
            OR resume_family_details.relation LIKE '%$query%'
            OR resume_family_details.job LIKE '%$query%'
            OR resume_family_details.organization LIKE '%$query%')
            
            or `resumes`.`id` in (SELECT  distinct(`resume_id`) FROM `resume_foreign_languages`  where resume_foreign_languages.title LIKE '%$query%'
            OR resume_foreign_languages.certificate LIKE '%$query%')
            
            or `resumes`.`id` in (SELECT  distinct(`resume_id`) FROM `resume_questions`  where resume_questions.Q1 LIKE '%$query%'
            OR resume_questions.Q2 LIKE '%$query%'
            OR resume_questions.Q3 LIKE '%$query%'
            OR resume_questions.Q4 LIKE '%$query%'
            OR resume_questions.sickness_description LIKE '%$query%'
            OR resume_questions.crime_description LIKE '%$query%' )    
            
                    
            OR jpm_exp_expertises.name LIKE '%$query%'
            OR jpm_p_t_r.name LIKE '%$query%'    
            OR users.first_name LIKE '%$query%' 
            OR users.last_name LIKE '%$query%' 
            OR users.email LIKE '%$query%' 
            OR users.mobile LIKE '%$query%' 
             $q");
            $tmp = array();
            foreach ($users_ids as $item)
                $tmp[] = $item->id;
            $users_ids = $tmp;

            $applies->whereHas('user', function ($q) use ($users_ids) {
                $q->whereIn('id', $users_ids);
            });
        }

        $applies = $applies->orderBy('id', 'asc')->paginate('10');
        $job = Job::findOrFail($id);


        $cities = DB::select(
            "
            SELECT `cities`.`id`, CONCAT(`provinces`.`name`, ' - ', `cities`.`name`) as name
            FROM `provinces` LEFT JOIN `cities` ON provinces.id = cities.province_id
            where 1
             "
        );

        $query_string = (parse_url(URL::full())['query'])?'?'.parse_url(URL::full())['query']:null;
        return view('admin.applies.index', compact([
            'applies', 'job', 'reject_reasons', 'cities','query_string', 'degree_selected', 'new_applies',
            'seen_applies', 'rejected_applies', 'accepted_applies', 'status','delete_button','usertype'
        ]));
    }
    //
    public function export_csv($id, $status = 1)
    {
        $applies=DB::table('users')
            ->leftJoin('user_profiles', 'user_profiles.user_id', '=', 'users.id')
            ->leftJoin('applies', 'applies.user_id', '=', 'users.id')
            ->leftJoin('resumes', 'resumes.user_id', '=', 'users.id')
            ->leftJoin('provinces', 'resumes.province_id', '=', 'provinces.id')
            ->leftJoin('provinces as p1', 'user_profiles.province_id', '=', 'p1.id')
            ->leftJoin('resume_has_contract_type', 'resume_has_contract_type.resume_id', '=', 'resumes.id')
            ->leftJoin('resume_contract_types', 'resume_has_contract_type.contract_type_id', '=', 'resume_contract_types.id')
            ->leftJoin('resume_has_departments', 'resume_has_departments.resume_id', '=', 'resumes.id')
            ->leftJoin('job_departments', 'job_departments.id', '=', 'resume_has_departments.department_id')
            ->leftJoin('resume_has_industries', 'resume_has_industries.resume_id', '=', 'resumes.id')
            ->leftJoin('industries', 'industries.id', '=', 'resume_has_industries.industry_id')
            ->leftJoin('resume_educational_details', function ($join){
                $join->on('resume_educational_details.resume_id', '=', 'resumes.id')->orderByDesc('grade')->limit(1);
            })
            ->leftJoin('resume_foreign_languages', function ($join){
                $join->on('resume_foreign_languages.resume_id', '=', 'resumes.id')->where('title','"زبان انگلیسی"')->limit(1);
            })
            ->leftJoin('resume_work_experiences', function ($join){
                $join->on('resume_work_experiences.resume_id', '=', 'resumes.id')->orderByDesc('start_date')->limit(1);
            })
            ->leftJoin('resume_questions', 'resume_questions.resume_id', '=', 'resume_questions.id')
            ->leftJoin('jobs', 'jobs.id', '=', 'applies.job_id')
            ->select(
                'users.created_at',
                'provinces.name as pName',
                DB::raw('GROUP_CONCAT(resume_contract_types.name SEPARATOR \', \') AS contract_types'),
                DB::raw('GROUP_CONCAT(job_departments.name SEPARATOR \', \') AS job_departments'),
                DB::raw('GROUP_CONCAT(industries.name SEPARATOR \', \') AS industries'),
                'p1.name as born_place',
                'user_profiles.neighborhood',
                'users.first_name',
                'users.last_name',
                'user_profiles.national_code',
                'user_profiles.gender',
                'user_profiles.born_date',
                'user_profiles.marital_status',
                'users.mobile',
                'users.email',
                'resume_educational_details.grade as edu_grade',
                'resume_educational_details.field as edu_field',
                'resume_educational_details.institute as edu_institute',
                'resume_educational_details.end_date as edu_end_date',
                'resume_foreign_languages.conversation',
                'resume_work_experiences.last_post',
                'resume_work_experiences.end_date as work_end_date',
                'resume_questions.requested_salary',
                'resume_questions.crime',
                'resume_questions.crime_description',
                'resumes.referer',
                'jobs.title'
            )
            ->where('applies.job_id', $id)
            ->where('applies.status', $status)
            ->groupBy('resumes.id')
        ;

        dd($applies->get()->toArray());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if(Auth::user()->is_mobile_verified == 0)
                return redirect(route('register.store'));


        if (Auth::user()->profile) {
            if(myFuncs::check_blacklist(Auth::user()->profile->national_code))
            {
                return Redirect::back()->withErrors(['متاسفانه شما امکان همکاری با مجموعه گروه صنعتی گلرنگ را ندارید']);

            }

        }

        if (!Auth::check()) {
            return redirect(route('login'));
        }

        if (!Auth::user()->profile) {
            return redirect(route('site.user.profile'))->with('flash_message',
                'جهت ارسال درخواست ابتدا باید اطلاعات فردی . سپس رزومه را تکمیل کنید');
        }

        if ( Auth::user()->complete_percent != 31 && Auth::user()->complete_percent != 15) {
            return redirect(
                route('user.resume.' . (string)myFuncs::percent_status(Auth::user()->complete_percent))
            )->with('flash_message', 'جهت ارسال درخواست باید رزومه ی شما صد در صد تکمیل باشد');
        }
        $now = Carbon::now()->timezone('Asia/Tehran')->toDateString();

        $apply_count = DB::table('applies')
            ->select('applies.id')
            ->leftjoin('jobs','applies.job_id', '=', 'jobs.id')
            ->leftjoin('users','applies.user_id', '=', 'users.id')
            ->where('jobs.deleted_at', null)
            ->where('applies.deleted_at', null)
            ->where('jobs.status',1)
            ->where(DB::raw('DATE(jobs.expire_date)'),'>=',$now)
            ->where('users.id', auth()->user()->id)
            ->get()->count();

        if($apply_count >= 3)
        {
            return Redirect::back()->withErrors(['خواست های فعال شما نمی تواند بیش از ۳ مورد باشد']);

/*            return redirect()->back()->with('flash_message', 'تعداد درخواست های فعال شما نمی تواند بیش از ۳ مورد باشد');
*/        }


        $this->validate($request, [
            'job_id' => 'integer',
            'answer' => 'sometimes|required|array|max:100',
            'cities' => 'sometimes|required|array|max:500',
            'answer.*' => 'sometimes|required|string|max:10000',
        ]);

        $mainJob=Job::whereId($request['job_id'])->first();
        if(($mainJob->approved!=1)||($mainJob->status!=1)||(strtotime($mainJob->expire_date)<time())){
            return redirect()->back()->withErrors([ 'این شغل هنوز فعال نشده است']);
           // echo '<Br> dead <br>';
        }


        if (Apply::all()->where('job_id', $request['job_id'])
                ->where('user_id', Auth::user()->id)->count() == 0) {
            $apply = new Apply();
            $apply->user_id = Auth::user()->id;
            $apply->job_id = $request['job_id'];
            $apply->status = 1;
            $apply->save();
        }

        if (isset($request['answer'])) {
            foreach ($request['answer'] as $q => $item) {
                $a = new JobQuestionAnswer();
                $a->question_id = $q;
                $a->apply_id = $apply->id;
                $a->answer = $item;
                $a->save();
            }
        }

        if (isset($request['cities'])) {
            foreach ($request['cities'] as $item) {
                $item = City::find($item);
                $apply->cities()->attach($item);
            }
        }else{
            $item = City::find($apply->job->cities->first()->id);
            $apply->cities()->attach($item);
        }

        $goal_date = strtotime(Carbon::now()->subMonth(2)->toDateString());
        $user = auth()->user();
        if(
            !in_array($apply->job->company->id,$user->owner->pluck('id')->toArray()) &&
            strtotime(Carbon::parse(auth()->user()->created_at)->format('Y-m-d')) >= $goal_date
        )
            $user->owner()->attach($apply->job->company->id);



        return redirect()->back()->with('flash_message',
            'درخواست  همکاری ارسال گردید');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {

        $apply = Apply::find($id);
        $company_id = $apply->job->company->id;
        $user = auth()->user();
        if (
            DB::table('companies')->select(DB::raw('COUNT(applies.id) as apply_count'))
            ->leftjoin('jobs','jobs.company_id', '=', 'companies.id')
            ->leftjoin('applies','jobs.id', '=', 'applies.job_id')
            ->where('companies.id', $company_id)
            ->where('applies.user_id', auth()->user()->id)
            ->first()->apply_count == 1 && auth()->user()->referrer_company_id != $company_id
        )
            $user->owner()->detach($apply->job->company->id);

        if($apply && $apply->user() && $apply->user->id != auth()->user()->id)
            return redirect()->back()->withErrors(['شما دسترسی حذف اپلای های سایر کاربران را ندارید. در صورت تلاش مجدد برای هک سیستم، مورد پیگرد قانونی قرار خواهید گرفت.']);

        Apply::findOrFail($id)->delete();





        return redirect()->back()->with('flash_message',
            'درخواست  با موفقیت حذف شد');
    }

    public function restore($id)
    {
        Apply::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back()->with('flash_message',
            'درخواست  با موفقیت بازیابی شد');
    }

    public function accept($id)
    {
        $apply = Apply::find($id);
        $apply->status = 2;
        $apply->save();
        return redirect()->back()
            ->with('flash_message',
                'درخواست مورد نظر تایید شد')
            ->with('jumpTo', $apply->id);
    }

    public function ajaxaccept(Request $request)
    {
        $id = $request['id'];
        $apply = Apply::find($id);
        $apply->status = 2;
        $apply->save();
        echo 'درخواست مورد نظر تایید نهایی شد';
//        return redirect()->back()
//            ->with('flash_message',
//                'درخواست مورد نظر تایید شد')
//            ->with('jumpTo', $apply->id);
    }

    public function reject(Request $request, $id)
    {
        $this->validate($request, [
            'reject_reason' => 'required|integer',
            'reject_description' => 'nullable|string'
        ]);
        $apply = Apply::find($id);
        $apply->reject_reason = $request['reject_reason'];
        $apply->reject_description = $request['reject_description'];
        $apply->status = 3;
        $apply->save();
        if (!empty($apply->user->email) && is_null($apply->user->is_email_verified))
        {
            $email = new ApplyRejectByAdminAlert($apply);
            Mail::to($apply->user->email)->send($email);
        }

        return redirect()->back()
            ->with('flash_message',
                'درخواست مورد نظر رد شد')
            ->with('jumpTo', $apply->id);
    }

    public function ajaxreject(Request $request)
    {

        $this->validate($request, [
            'reject_reason' => 'required|integer',
            'reject_description' => 'nullable|string'
        ]);

        $id = $request['id'];

        $apply = Apply::find($id);
        $apply->reject_reason = $request['reject_reason'];
        $apply->reject_description = $request['reject_description'];
        $apply->status = 3;
        $apply->save();
        if (!empty($apply->user->email) && is_null($apply->user->is_email_verified))
        {
            $email = new ApplyRejectByAdminAlert($apply);
            Mail::to($apply->user->email)->send($email);
        }
        echo 'درخواست مورد نظر رد شد';
//
//        return redirect()->back()
//            ->with('flash_message',
//                'درخواست مورد نظر رد شد')
//            ->with('jumpTo', $apply->id);
    }

    public function seen($id)
    {
        $apply = Apply::find($id);
        $apply->status = 4;
        $apply->save();

        if (!empty($apply->user->email) && is_null($apply->user->is_email_verified))
        {
            $email = new ApplySeenedByAdminAlert($apply);
//            Mail::to($apply->user->email)->send($email);
            try {
                Mail::to($apply->user->email)->send($email);
            } catch (\Exception $e) {
//                echo 'Message: ' .$e->getMessage();
//                throw new \Exception('Email send error.'.$e->getMessage());
                return redirect()->back()
                    ->with('flash_message',
                        'وضعیت درخواست تغییر کرد'.'Send email error! '.$e->getMessage())
                    ->with('jumpTo', $apply->id);
//                File::put('sample.txt',$e->getMessage());

            }
        }

        return redirect()->back()
            ->with('flash_message',
                'وضعیت درخواست تغییر کرد')
            ->with('jumpTo', $apply->id);
    }

    public function seenAll(Request $request)
    {
        $this->validate($request, [
            'selected_applies' => 'required|array|min:1'
        ]);
        $applies = Apply::whereIn('id', array_keys(request('selected_applies')))->get();
        foreach ($applies as $apply) {
            $apply->status = 4;
            $apply->save();
            if (!empty($apply->user->email) && is_null($apply->user->is_email_verified))
            {
                $email = new ApplySeenedByAdminAlert($apply);
                Mail::to($apply->user->email)->send($email);
            }
        }
        return redirect()->back()
            ->with('flash_message',
                'وضعیت درخواستها تغییر کرد')
            ->with('jumpTo', $apply->id);
    }

    public function rejectAll(Request $request)
    {
        $this->validate($request, [
            'selected_applies' => 'required|array|min:1'
        ]);
        $applies = Apply::whereIn('id', array_keys(request('selected_applies')))->get();

        foreach ($applies as $apply) {
            $apply->status = 3;
            $apply->save();
        }
        return redirect()->back()
            ->with('flash_message',
                'وضعیت درخواستها تغییر کرد')
            ->with('jumpTo', $apply->id);
    }

    public function waiting($id)
    {
        $apply = Apply::find($id);
        $apply->status = 1;
        $apply->save();
        return redirect()->back()
            ->with('flash_message',
                'وضعیت درخواست تغییر کرد')
            ->with('jumpTo', $apply->id);
    }

    public function site_index()
    {

        $now = Carbon::now()->timezone('Asia/Tehran')->toDateString();
        $applies_ids = DB::table('applies')
            ->select('applies.id')
            ->leftjoin('jobs','applies.job_id', '=', 'jobs.id')
            ->leftjoin('users','applies.user_id', '=', 'users.id')
            ->where('jobs.deleted_at', null)
            ->where('applies.deleted_at', null)
            ->where('jobs.status',1)
            ->where(DB::raw('DATE(jobs.expire_date)'),'>=',$now)
            ->where('users.id', auth()->user()->id)
            ->get()->merge(
                DB::table('applies')
                ->select('applies.id')
                ->leftjoin('jobs','applies.job_id', '=', 'jobs.id')
                ->leftjoin('users','applies.user_id', '=', 'users.id')
                    ->where('jobs.deleted_at', null)
                    ->where('applies.deleted_at', null)
                ->where('users.id', auth()->user()->id)
                ->where(function ($query) use($now)  {
                    $query->where('jobs.status', 3)
                    ->orWhere(DB::raw('DATE(jobs.expire_date)'),'<',$now);
                })->get()
            )->pluck('id')->toArray();



        $applies = Apply::whereIn('id',$applies_ids)->get();

        $result = array();
        foreach ($applies as $item) {
            $result[$item->id] = $item;
        }

//        dd($applies->first()->id);

        return view('site.pages.user.applies',compact(['result' ,'applies_ids']));
    }

    public function testtttt()
    {
        $job = Job::find(953);
        $company_id = $job->company()->first()->id;
        die(json_encode(DB::table('user_has_companies')
                      ->join('BI_user_status','user_has_companies.user_id','BI_user_status.user_id')
                      ->join('model_has_roles','user_has_companies.user_id','model_has_roles.model_id')
                      ->where('user_has_companies.company_id',$company_id)->where('status',1)->wherein('role_id',[15,16])
                      ->pluck('user_has_companies.user_id')->toArray()));
        
        die(json_encode($user->company()->get()));
        die(json_encode(base64_encode(file_get_contents('https://people.golrang.com/cv/108738/show.pdf'))));
    }

    public function quick_view()
    {
        $id = request('id');
        $resume = Resume::find($id);
        $user = $resume->user;

        $khedmat_status = DB::table('user_profiles')->where('user_id','=',$user->id)->get();
        $user_khedmat_status = DB::table('khedmatmap')->where('site_id','=',$khedmat_status[0]->military_status)->get();
        $user_khedmat_moaf_status = DB::table('khedmatmoafmap')->where('id','=',$khedmat_status[0]->reason_exemption)->get();
        $user_khedmat_status = $user_khedmat_status[0];
        $user_khedmat_moaf_status = $user_khedmat_moaf_status[0];

        $Degrees = DB::table('degrees')->get();

        $degrees_array = $this->degrees_array;

        $age = substr($resume->user->profile->born_date, 0, 4); // sample : 1361
        $year = \p3ym4n\JDate\JDate::now()->year;// sample : 1397
        $years_old = $year - $age;

    }

}
