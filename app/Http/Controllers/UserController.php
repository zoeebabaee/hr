<?php

namespace HR\Http\Controllers;

use Carbon\Carbon;
use HR\Apply;
use HR\UserProfile;
use HR\City;
use HR\Company;
use HR\Industry;
use HR\JobDepartment;
use HR\JobProfessionalMerites;
use HR\myDate;
use HR\myFuncs;
use HR\Province;
use HR\Resume;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use HR\User;
use Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;


//Importing laravel-permission models
//use Image;
use p3ym4n\JDate\JDate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

//Enables us to output flash messaging
use Session;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
        ini_set('memory_limit', '-1');
    }

    public function apply_list($id)
    {
        $user = User::find($id);

        $applies = Apply::where('user_id', $id)->whereHas('job', function ($e) {
            $e->where('deleted_at', null);
        })->withTrashed()->get();

        return View::make('admin.users.apply_list', compact(['applies', 'user']));
    }

    public function index()
    {
        $users = User::myUsers();

        $query_string = (parse_url(URL::full())['query']) ? '?' . parse_url(URL::full())['query'] : null;

        #check Age Range


       if (request('age_range') != '') {
            $age_ranges = request('age_range');
            $users->whereHas('profile', function ($q) {
                    $i = 0;
                    foreach (request('age_range') as $item) {

                        $age_range = explode('-', config('app.age_range')[$item]);
                        $start_date = Carbon::now()->subYear($age_range[0])->format('Y/m/d');
                        $end_date = Carbon::now()->subYear($age_range[1])->format('Y/m/d');
                        if($i == 0)
                            $q->where(DB::raw('DATE(born_date)'), '<=', $start_date)->where(DB::raw('DATE(born_date)'), '>=', $end_date);
                        else
                            $q->orWhere(DB::raw('DATE(born_date)'), '<=', $start_date)->where(DB::raw('DATE(born_date)'), '>=', $end_date);
                        $i++;
                    }
            
            });

        }


        $usertype = request('usertype');
        if (request('usertype') != 0) {
            if($usertype == -1)
                $usertype = 0;
            $users->Join('BI_user_status', 'users.id', '=', 'BI_user_status.user_id')->where('BI_user_status.status', $usertype);
            $usertype = request('usertype');
        }


        # First name contains ...
        if (request('first_name') != '')
            $users->where('first_name', 'like', '%' . request('first_name') . '%');

        # Last name contains ...
        if (request('last_name') != '')
            $users->where('last_name', 'like', '%' . request('last_name') . '%');

        # Mobile contains ...
        if (request('mobile') != '')
            $users->where('mobile', 'like', '%' . request('mobile') . '%');

        # Email contains ...
        if (request('email') != '')
            $users->where('email', 'like', '%' . request('email') . '%');

        # Users From City ...
        if (request('city_id') != '') {
            $city_id = request('city_id');
            $users->whereHas('profile', function ($w) use ($city_id) {
                $w->where('city_id', $city_id);
            });
        }

        # Gender IS ...
        if (request('gender') != '' && request('gender') != 0) {
            $gender = request('gender');
            $users->whereHas('profile', function ($w) use ($gender) {
                $w->where('gender', $gender);
            });
        }

        # ptr_id IS ...
        $ptrs_selected = request('ptrs');
        if ($ptrs_selected != '' && is_array($ptrs_selected)) {
            $users->whereIn('id', Resume::whereHas('departments', function ($w) use ($ptrs_selected) {
                $w->whereIn('department_id', $ptrs_selected);
            })->pluck('user_id')->toArray());
        }

        # industries IS ...
        $industries_selected = request('industries');
        if ($industries_selected != '' && is_array($industries_selected)) {
            $users->whereIn('users.id', Resume::whereHas('industries', function ($w) use ($industries_selected) {
                $w->whereIn('industry_id', $industries_selected);
            })->pluck('user_id')->toArray());
        }

        # last degree IS ...
        $degree_selected = request('last_degree');
        if ($degree_selected != '' && is_array($degree_selected)) {
            $users->whereHas('resume', function ($w) use ($degree_selected) {
                $w->whereHas('educational_details', function ($q) use ($degree_selected) {
                    $q->groupBy('resume_id')->havingRaw('MAX(grade) IN (' . implode(', ', $degree_selected) . ')');
                });
            });
        }

        # Province ID ...
        $province_id = request('province_id');
        if (!empty($province_id) && !is_null($province_id)) {
            $users->whereHas('resume', function ($w) use ($province_id) {
                $w->where('province_id', $province_id);
            });
        }

        # field IS ...
        $fields_selected = request('fields');
        if ($fields_selected != '' && is_array($fields_selected)) {
            $users->whereHas('resume', function ($w) use ($fields_selected) {
                $w->whereHas('educational_details', function ($q) use ($fields_selected) {
                    $q->whereIn('field', $fields_selected);
                });
            });
        }


        # neighborhood LIKE ...
        $neighborhood = request('neighborhood');
        if (!empty($neighborhood) && !is_null($neighborhood)) {
            $users->whereHas('profile', function ($w) use ($neighborhood) {
                $w->where('neighborhood', 'like', '%' . $neighborhood . '%');
            });
        }
        
        if (request('first_date') != '' && request('first_date') != 0) {
            $first_date = JDate::createFromFormat('Y-m-d', request('first_date'))->carbon->toDateTimeString();
            $users->where('created_at', '>',  $first_date );

        }
              // 
 
        if (request('last_date') != '' && request('last_date') != 0) {
            $last_date  = JDate::createFromFormat('Y-m-d', request('last_date'))->carbon->toDateTimeString();
            $users->where('created_at', '<',  $last_date );

        }
        
        /**
         * Mahdavi Kia
         * Advanced keywords search
         */
        $keyword = trim(request('keyword'));
        if (!empty($keyword) && !is_null($keyword)) {
            $users->whereHas('resume', function ($w) use ($keyword) {
                $w->whereHas('work_experience', function ($q) use ($keyword) {
                    $q->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('last_post', 'like', '%' . $keyword . '%')
                        ->orWhere('important_tasks', 'like', '%' . $keyword . '%')
                        ->orWhere('cause_interruption', 'like', '%' . $keyword . '%');
                });
            });
        }

        $users = $users->orderBy('users.id')->paginate(10);

       /* $req = array();
        foreach ((array)request()->request as $item) {
            $req = $item;
            break;
        }*/
        $allRoles = Role::all()->pluck('name');
        $cities = $users_ids = DB::select(
            "
            SELECT `cities`.`id`, CONCAT(`provinces`.`name`, ' - ', `cities`.`name`) as name
            FROM `provinces` LEFT JOIN `cities` ON provinces.id = cities.province_id
            where 1
             "
        );
        $ptrs = JobDepartment::all();
        $industries = Industry::all()->whereIn('id', DB::table('resume_has_industries')->pluck('industry_id')->toArray());
        $fields = DB::table('resume_educational_details')->select('field')->distinct()->pluck('field');
        $provinces = Province::all();
        return view(
            'admin.users.index',
            compact(
                [
                    'users', 'allRoles', 'cities',
                    'ptrs', 'ptrs_selected', 'industries', 'industries_selected',
                    'degree_selected', 'fields', 'fields_selected', 'query_string', 'provinces','first_date','last_date','usertyp'
                ]
            )
        );
    }

    public function create()
    {
        //Get all roles and pass it to the view
        $roles = Role::where('id', '>=', '1')->get();
        $companies = Company::all();
        return View::make('admin.users.create', compact(['companies', 'roles']));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'mobile' => array(
                'required',
                'regex:/[0-9]{11}/u',
                'unique:users'
            ),
            'email' => 'nullable|email',
            'password' => 'required|min:6|confirmed',
            'company_id' => 'nullable|array|max:100'
        ]);
        if (!empty($request['email'])) {
            $users = User::where('email', $request['email'])->where('is_email_verified', null)->count();
            if ($users)
                return redirect()->back()->withErrors(['ایمیل وارد شده تکراری است']);
        }


        $user = new User();
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->email = request('email');
        $user->mobile = request('mobile');
        $user->password = bcrypt(request('password'));
        $user->avatar = request('avatar');
        $user->save();

        $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('name', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }

        if (isset($request['company_id']) && !is_null($request['company_id'] && is_array($request['company_id']) && !empty($request['company_id'])))
            foreach ($request['company_id'] as $item)
                $user->company()->attach($item);


        //Redirect to the users.index view and display message
        return redirect()->route('users.index')
            ->with('flash_message',
                'دسته بندی با موفقیت ایجاد گردید');
    }

    public function show($id)
    {
        return redirect('users');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); //Get user with specified id
        if ($user->hasRole('برنامه نویس') && auth()->user()->id != $id)
            return redirect()->route('users.index')
                ->with('flash_message',
                    'نمیتوانید اطلاعات برنامه نویس را ویرایش کنید');

        $roles = Role::where('id', '>=', '1')->get(); //Get all roles
        $rolesId = $user->roles()->where('id', '>=', '1')->pluck('id')->toArray();
        $companies = Company::all();
        return view('admin.users.edit', compact(['user', 'roles', 'rolesId', 'companies'])); //pass user and roles data to view

    }

    public function update(Request $request, $id)
    {
        if ($id == 1)
            return redirect()->route('users.index')
                ->with('flash_message',
                    'نمیتوانید اطلاعات برنامه نویس را ویرایش کنید');

        $user = User::findOrFail($id); //Get role specified by id

        $verify_flag = 0;
        if ($user->mobile != $request['mobile']) {
            $user->is_mobile_verified = 0;
            $verify_flag = 1;
        }
        if ($user->email != $request['email']) {
            $user->is_email_verified = myFuncs::quickRandom(30);
            $verify_flag = 1;
        }
        if ($verify_flag)
            $user->save();

        //Validate name, email and password fields
        $this->validate(request(), [
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'status' => 'integer|min:0|max:1',
            'mobile' => 'required|unique:users,mobile,' . $user->id,
            'password' => 'confirmed',
            'avatar' => 'nullable',
            'company_id' => 'nullable|array|max:100'

        ]);
        if ($request['email'] != '')
            $this->validate(request(), ['email' => 'email']);

        if ($request['password'] == '' && $request['password_confirmation'] == '') {
            $user->first_name = $request['first_name'];
            $user->last_name = $request['last_name'];
            $user->email = $request['email'];
            $user->mobile = $request['mobile'];
            if (isset($request['avatar']) && $request['avatar'] != '')
                $user->avatar = $request['avatar'];
            else
                $user->avatar = $request['avatar'];
            $user->status = $request['status'];
            $user->save();
        } else {
            $user->first_name = $request['first_name'];
            $user->last_name = $request['last_name'];
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
            if (isset($request['avatar']) && $request['avatar'] != '')
                $user->avatar = $request['avatar'];
            else
                $user->avatar = '/golrangsystem-file-manager/photos/1/default/noimage_profile.png';
            $user->status = $request['status'];
            $user->save();
        }


        if ($user->roles()->count()) {
            foreach ($user->roles()->get()->toArray() as $role) {
                $user->removeRole($role['name']);
            }
        }

        //Checking if a role was selected
        if (isset($request['roles']) && !empty($request['roles']) && is_array($request['roles'])) {
            $roles = array_unique($request['roles']); //Retrieving the roles field
            foreach ($roles as $role) {
                $role_r = Role::where('name', '=', $role)->first();
                $user->assignRole($role_r); //Assigning role to user
            }
            foreach ($user->roles()->get() as $role) {
                foreach ($role->permissions()->get()->toArray() as $perm) {
                    $user->revokePermissionTo($perm['name']);
                }
            }
        }


        $user->company()->detach();
        if (isset($request['company_id']) && !is_null($request['company_id'] && is_array($request['company_id']) && !empty($request['company_id'])))
            foreach ($request['company_id'] as $item)
                $user->company()->attach($item);

        return redirect()->route('users.index')
            ->with('flash_message',
                'اطلاعات کاربر با موفقیت ویرایش گردید');
    }

    public function destroy($id)
    {
        //Find a user with a given id and delete
        if ($id == 1)
            return redirect()->route('users.index')
                ->with('flash_message',
                    'نمیتوانید کاربر برنامه نویس را حذف کنید');
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')
            ->with('flash_message',
                'کاربر با موفقیت حذف شد');
    }

    public function confirm_email($id)
    {
        $user = User::findOrFail($id);
        $user->is_email_verified = null;
        $user->save();
    }

    public function confirm_mobile($id)
    {
        $user = User::findOrFail($id);
        $user->is_mobile_verified = 1;
        $user->save();

    }

    public function Search()
    {


        return view('admin.users.index', compact(['users', 'allRoles', 'req']));
    }

    public function have_resume_export_csv()
    {
        $extra_query = '';

        if (request('age_range') != '') {
            $age_range = explode('-', config('app.age_range')[request('age_range')]);
            $start_date = Carbon::now()->subYear($age_range[0])->format('Y-m-d');
            $end_date = Carbon::now()->subYear($age_range[1])->format('Y-m-d');
            $extra_query .= " AND DATE(user_profiles.born_date) <= '$start_date' AND DATE(user_profiles.born_date) >= '$end_date'";
        }
//        dd($extra_query);


        # First name contains ...
        if (request('first_name') != '')
            $extra_query .= " AND users.first_name LIKE '%" . myFuncs::RemoveSpecialChar(request('first_name')) . "%'";

        # Last name contains ...
        if (request('last_name') != '')
            $extra_query .= " AND users.last_name LIKE '%" . myFuncs::RemoveSpecialChar(request('last_name')) . "%'";

        # Mobile contains ...
        if (request('mobile') != '')
            $extra_query .= " AND users.mobile LIKE '%" . myFuncs::RemoveSpecialChar(request('mobile')) . "%'";

        # Email contains ...
        if (request('email') != '')
            $extra_query .= " AND users.email LIKE '%" . myFuncs::RemoveSpecialChar(request('email')) . "%'";

        # Users From City ...
        if (request('city_id') != '') {
            $extra_query .= " AND user_profiles.city_id = " . myFuncs::RemoveSpecialChar(request('city_id'));
        }

        # Province ID ...
        $province_id = request('province_id');
        if (!empty($province_id) && !is_null($province_id)) {
            $extra_query .= " AND resumes.province_id = $province_id ";
        }

        # neighborhood LIKE ...
        $neighborhood = request('neighborhood');
        if (!empty($neighborhood) && !is_null($neighborhood)) {
            $extra_query .= " AND user_profiles.neighborhood = $neighborhood ";
        }

        # Gender IS ...
        if (request('gender') != '' && request('gender') != 0) {
            $extra_query .= " AND user_profiles.gender = " . myFuncs::RemoveSpecialChar(request('gender'));
        }

        # ptr_id IS ...
        $ptrs_selected = request('ptrs');
        if ($ptrs_selected != '' && is_array($ptrs_selected)) {
            $extra_query .= " AND job_departments.id IN (" . implode(', ', $ptrs_selected) . ")";
        }

        # industries IS ...
        $industries_selected = request('industries');
        if ($industries_selected != '' && is_array($industries_selected)) {
            $extra_query .= " AND industries.id IN (" . implode(', ', $industries_selected) . ")";
        }

        # last degree IS ...
        $degree_selected = request('last_degree');
        if ($degree_selected != '' && is_array($degree_selected)) {
            $extra_query .= " AND `last_edu`.`grade` IN (" . implode(', ', $degree_selected) . ")";
        }

        # field IS ...
        $fields_selected = request('fields');
        if ($fields_selected != '' && is_array($fields_selected)) {
            $extra_query .= " AND `last_edu`.`field` IN ('" . implode("', '", $fields_selected) . "')";
        }
        if (!auth()->user()->hasAnyRole('برنامه نویس|سوپرادمین')) {
            $companies = implode(', ', auth()->user()->company->pluck('id')->toArray());
            $goal_date = Carbon::now()->timezone('Asia/Tehran')->subMonth(2)->toDateTimeString();
            $extra_query .= " AND (company_has_users.company_id IN ($companies) OR users.created_at < '$goal_date') ";
        }

        /*$users = DB::select('
          SELECT
            `users`.`created_at` AS `register_date`,
            `p1`.`name` AS `work_province`,
            GROUP_CONCAT(DISTINCT resume_contract_types.name SEPARATOR \', \') AS cooperation_types,
            GROUP_CONCAT(DISTINCT job_departments.name SEPARATOR \', \') AS departments,
            GROUP_CONCAT(DISTINCT industries.name SEPARATOR \', \') AS industries,
            `p2`.`name` AS `born_province`,
            `user_profiles`.`neighborhood`,
            `users`.`first_name`,
            `users`.`last_name`,
            `user_profiles`.`national_code`,
            `user_profiles`.`gender`,
            `user_profiles`.`born_date`,
            `user_profiles`.`marital_status`,
            `users`.`mobile`,
            `users`.`email`,
            `last_edu`.`grade`,
            `last_edu`.`field`,
            `last_edu`.`institute`,
            `last_edu`.`end_date`,
            `english`.`conversation`,
            `last_work`.`last_post`,
            MIN(resume_work_experiences.end_date) AS ready_to_work,
            `resume_questions`.`requested_salary`,
            `resume_questions`.`crime`,
            `resume_questions`.`crime_description`,
            `resumes`.`referer`,
            `applysCount`.apply_count,
            `RejectedApplysCount`.rejected_apply_count,
            `SeenedApplysCount`.seened_apply_count,
            `AcceptedApplysCount`.accepted_apply_count,
            `users`.`last_login`,
            `users`.`complete_percent`
            
        FROM `users`
        LEFT JOIN `company_has_users` ON `users`.`id` = `company_has_users`.`user_id`
        LEFT JOIN `resumes` ON `users`.`id` = `resumes`.`user_id`
        LEFT JOIN `provinces` AS p1 ON `resumes`.`province_id` = `p1`.`id`
        LEFT JOIN `resume_has_contract_type` ON `resumes`.`id` = `resume_has_contract_type`.`resume_id`
        LEFT JOIN `resume_contract_types` ON `resume_has_contract_type`.`contract_type_id` = `resume_contract_types`.`id`
        LEFT JOIN `resume_has_departments` ON `resume_has_departments`.`resume_id` = `resumes`.`id`
        LEFT JOIN `job_departments` ON `resume_has_departments`.`department_id` = `job_departments`.`id`
        LEFT JOIN `resume_has_industries` ON `resume_has_industries`.`resume_id` = `resumes`.`id`
        LEFT JOIN `industries` ON `resume_has_industries`.`industry_id` = `industries`.`id`
        LEFT JOIN `user_profiles` ON `user_profiles`.`user_id` = `users`.`id`
        LEFT JOIN `provinces` AS p2 ON `user_profiles`.`province_id` = `p2`.`id`        
        LEFT JOIN (SELECT resume_educational_details.*, MAX(start_date) AS max_edu_date FROM resume_educational_details GROUP BY resume_id) AS last_edu ON last_edu.resume_id = resumes.id AND max_edu_date = last_edu.start_date
        LEFT JOIN (SELECT resume_foreign_languages.* FROM resume_foreign_languages GROUP BY resume_id) AS english ON english.resume_id = resumes.id AND english.title ="زبان انگلیسی"
        LEFT JOIN `resume_work_experiences` ON `resume_work_experiences`.`resume_id` = `resumes`.`id`
        LEFT JOIN (SELECT resume_work_experiences.*, MAX(start_date) AS maxdate FROM resume_work_experiences GROUP BY resume_id) AS last_work ON last_work.resume_id = resumes.id AND maxdate = resume_work_experiences.start_date
        LEFT JOIN `resume_questions` ON `resume_questions`.`resume_id` = `resumes`.`id`
        LEFT JOIN (SELECT user_id, COUNT(`id`) AS apply_count FROM `applies` GROUP BY user_id) AS applysCount ON applysCount.user_id = users.id
        LEFT JOIN (SELECT user_id, COUNT(`id`) AS rejected_apply_count FROM `applies` WHERE status = 3 GROUP BY user_id) AS RejectedApplysCount ON RejectedApplysCount.user_id = users.id
        LEFT JOIN (SELECT user_id, COUNT(`id`) AS seened_apply_count FROM `applies` WHERE status = 4 GROUP BY user_id) AS SeenedApplysCount ON SeenedApplysCount.user_id = users.id
        LEFT JOIN (SELECT user_id, COUNT(`id`) AS accepted_apply_count FROM `applies` WHERE status = 4 GROUP BY user_id) AS AcceptedApplysCount ON AcceptedApplysCount.user_id = users.id
        WHERE `users`.`complete_percent` > 0
        ' . $extra_query . '
        GROUP BY `users`.`id`
        ');*/

       /* $header = [
            'تاریخ ثبت نام', 'متقاضی کار در استان', 'نوع همکاری', 'زمینه تخصصی', 'زمینه صنعت مورد علاقه', 'استان محل سکونت',
            'منطقه/ محله', 'نام', 'نام خانوادگی', 'کد ملی', 'جنسیت', 'تاریخ تولد', 'سن', 'وضعیت تاهل', 'تلفن همراه', 'ایمیل',
            'آخرین مدرک تحصیلی', 'رشته تحصیلی', 'نام دانشگاه', 'وضعیت تحصیل', 'سطح زبان انگلیسی-مکالمه', 'آخرین سمت سازمانی',
            'وضعیت شغلی', 'آخرین حقوق درخواستی', 'سابقه محکومیت کیفری', 'طریقه آشنایی با شرکت', 'تعداد درخواستهای شغلی',
            'تعداد درخواستهای رد شده', 'تعداد درخواستهای برگزیده', 'تعداد درخواستهای تایید شده نهایی', 'آخرین زمان بازدید سایت',
            'درصد تکمیل فرم استخدام'
        ];

        $body = array();
        foreach ($users as $user) {

            $body[] = [
                myDate::createFromCarbon(Carbon::parse($user->register_date))->format('Y-m-d'),
                $user->work_province,
                $user->cooperation_types,
                $user->departments,
                $user->industries,
                $user->born_province,
                $user->neighborhood,
                $user->first_name,
                $user->last_name,
                "\t" . $user->national_code . "\t",
                config('app.enum_gender')[$user->gender],
                myDate::createFromCarbon(Carbon::parse($user->born_date))->format('Y-m-d'),
                Carbon::now()->diffInYears(Carbon::parse($user->born_date)),
                config('app.enum_marital_status')[$user->marital_status],
                $user->mobile . '',
                $user->email,
                config('app.enum_last_degree')[$user->grade],
                $user->field,
                $user->institute,
                myDate::createFromCarbon(Carbon::parse($user->end_date))->format('Y-m-d'),
                config('app.enum_level')[$user->conversation],
                $user->last_post,
                myDate::createFromCarbon(Carbon::parse($user->ready_to_work))->format('Y-m-d'),
                config('app.salery_range')[$user->requested_salary],
                $user->crim ? 'بله، ' . $user->crime_description : 'خیر',
                config('app.enum_referer')[$user->referer],
                $user->apply_count,
                $user->rejected_apply_count,
                $user->seened_apply_count,
                $user->accepted_apply_count,
                myDate::createFromCarbon(Carbon::parse($user->last_login))->format('Y-m-d'),
                myFuncs::percent_calc($user->complete_percent)
            ];
        }
        myFuncs::export_to_csv($header, $body, 'Users_export');*/
        $users = DB::select('
          SELECT
            `users`.`created_at` AS `register_date`,
            `p1`.`name` AS `work_province`,
            GROUP_CONCAT(DISTINCT resume_contract_types.name SEPARATOR \', \') AS cooperation_types,
            GROUP_CONCAT(DISTINCT job_departments.name SEPARATOR \', \') AS departments,
            GROUP_CONCAT(DISTINCT industries.name SEPARATOR \', \') AS industries,
            `p2`.`name` AS `born_province`,
            `user_profiles`.`neighborhood`,
            `users`.`first_name`,
            `users`.`last_name`,
            `user_profiles`.`national_code`,
            `user_profiles`.`gender`,
            `user_profiles`.`born_date`,
            `user_profiles`.`marital_status`,
            `users`.`mobile`,
            `users`.`email`,
            `last_edu`.`grade`,
            `last_edu`.`field`,
            `last_edu`.`institute`,
            `last_edu`.`end_date`,
            `english`.`conversation`,
            `last_work`.`last_post`,
            MIN(resume_work_experiences.end_date) AS ready_to_work,
            `resume_questions`.`requested_salary`,
            `resume_questions`.`crime`,
            `resume_questions`.`crime_description`,
            `resumes`.`referer`,
            `applysCount`.apply_count,
            `RejectedApplysCount`.rejected_apply_count,
            `SeenedApplysCount`.seened_apply_count,
            `AcceptedApplysCount`.accepted_apply_count,
            `users`.`last_login`,
            `users`.`complete_percent`,
            `BI_user_status`.status as bi_status
            
        FROM `users`
        LEFT JOIN `company_has_users` ON `users`.`id` = `company_has_users`.`user_id`
        LEFT JOIN `BI_user_status` ON `users`.`id` = `BI_user_status`.`user_id`
        LEFT JOIN `resumes` ON `users`.`id` = `resumes`.`user_id`
        LEFT JOIN `provinces` AS p1 ON `resumes`.`province_id` = `p1`.`id`
        LEFT JOIN `resume_has_contract_type` ON `resumes`.`id` = `resume_has_contract_type`.`resume_id`
        LEFT JOIN `resume_contract_types` ON `resume_has_contract_type`.`contract_type_id` = `resume_contract_types`.`id`
        LEFT JOIN `resume_has_departments` ON `resume_has_departments`.`resume_id` = `resumes`.`id`
        LEFT JOIN `job_departments` ON `resume_has_departments`.`department_id` = `job_departments`.`id`
        LEFT JOIN `resume_has_industries` ON `resume_has_industries`.`resume_id` = `resumes`.`id`
        LEFT JOIN `industries` ON `resume_has_industries`.`industry_id` = `industries`.`id`
        LEFT JOIN `user_profiles` ON `user_profiles`.`user_id` = `users`.`id`
        LEFT JOIN `provinces` AS p2 ON `user_profiles`.`province_id` = `p2`.`id`        
        LEFT JOIN (SELECT resume_educational_details.*, MAX(start_date) AS max_edu_date FROM resume_educational_details GROUP BY resume_id) AS last_edu ON last_edu.resume_id = resumes.id AND max_edu_date = last_edu.start_date
        LEFT JOIN (SELECT resume_foreign_languages.* FROM resume_foreign_languages GROUP BY resume_id) AS english ON english.resume_id = resumes.id AND english.title ="زبان انگلیسی"
        LEFT JOIN `resume_work_experiences` ON `resume_work_experiences`.`resume_id` = `resumes`.`id`
        LEFT JOIN (SELECT resume_work_experiences.*, MAX(start_date) AS maxdate FROM resume_work_experiences GROUP BY resume_id) AS last_work ON last_work.resume_id = resumes.id AND maxdate = resume_work_experiences.start_date
        LEFT JOIN `resume_questions` ON `resume_questions`.`resume_id` = `resumes`.`id`
        LEFT JOIN (SELECT user_id, COUNT(`id`) AS apply_count FROM `applies` GROUP BY user_id) AS applysCount ON applysCount.user_id = users.id
        LEFT JOIN (SELECT user_id, COUNT(`id`) AS rejected_apply_count FROM `applies` WHERE status = 3 GROUP BY user_id) AS RejectedApplysCount ON RejectedApplysCount.user_id = users.id
        LEFT JOIN (SELECT user_id, COUNT(`id`) AS seened_apply_count FROM `applies` WHERE status = 4 GROUP BY user_id) AS SeenedApplysCount ON SeenedApplysCount.user_id = users.id
        LEFT JOIN (SELECT user_id, COUNT(`id`) AS accepted_apply_count FROM `applies` WHERE status = 4 GROUP BY user_id) AS AcceptedApplysCount ON AcceptedApplysCount.user_id = users.id
        WHERE `users`.`complete_percent` > 0 
        ' . $extra_query . '
        GROUP BY `users`.`id`
        ');
        
         $header = [
            'تاریخ ثبت نام', 'متقاضی کار در استان', 'نوع همکاری', 'زمینه تخصصی', 'زمینه صنعت مورد علاقه', 'استان محل سکونت',
            'منطقه/ محله', 'نام', 'نام خانوادگی', 'کد ملی', 'جنسیت', 'تاریخ تولد', 'سن', 'وضعیت تاهل', 'تلفن همراه', 'ایمیل',
            'آخرین مدرک تحصیلی', 'رشته تحصیلی', 'نام دانشگاه', 'وضعیت تحصیل', 'سطح زبان انگلیسی-مکالمه', 'آخرین سمت سازمانی',
            'وضعیت شغلی', 'آخرین حقوق درخواستی', 'سابقه محکومیت کیفری', 'طریقه آشنایی با شرکت', 'تعداد درخواستهای شغلی',
            'تعداد درخواستهای رد شده', 'تعداد درخواستهای برگزیده', 'تعداد درخواستهای تایید شده نهایی', 'آخرین زمان بازدید سایت',
            'درصد تکمیل فرم استخدام', 'وضعیت'
        ];

        $body = array();
        foreach ($users as $user) {

            /*    if(json_decode(file_get_contents("http://172.31.2.18/PersonneBlackList/GetCode?CodeMelli=$user->national_code"))->Result == 1)
                    $state = "بلک لیست";
                else{
                    if(json_decode(file_get_contents("http://172.31.2.18/PersonnelStatus/GetState?MeliCode=$user->national_code"))->Status == 'فعال')
                        $state = 'فعال';
                    else if(json_decode(file_get_contents("http://172.31.2.18/PersonnelStatus/GetState?MeliCode=$user->national_code"))->Status == "")
                        $state='';
                    else
                        $state = 'همکار سابق';

                }*/
                
                     if($user->bi_status == '-1')
                $state = "بلک لیست";

            else if($user->bi_status == '1')
                $state = "فعال";

            else if($user->bi_status == '0')
                $state = "همکار سابق";
            else
                $state = "جذب نشده";



                
                

            $body[] = [
                myDate::createFromCarbon(Carbon::parse($user->register_date))->format('Y-m-d'),
                $user->work_province,
                $user->cooperation_types,
                $user->departments,
                $user->industries,
                $user->born_province,
                $user->neighborhood,
                $user->first_name,
                $user->last_name,
                "\t" . $user->national_code . "\t",
                config('app.enum_gender')[$user->gender],
                myDate::createFromCarbon(Carbon::parse($user->born_date))->format('Y-m-d'),
                Carbon::now()->diffInYears(Carbon::parse($user->born_date)),
                config('app.enum_marital_status')[$user->marital_status],
                $user->mobile . '',
                $user->email,
                config('app.enum_last_degree')[$user->grade],
                $user->field,
                $user->institute,
                myDate::createFromCarbon(Carbon::parse($user->end_date))->format('Y-m-d'),
                config('app.enum_level')[$user->conversation],
                $user->last_post,
                myDate::createFromCarbon(Carbon::parse($user->ready_to_work))->format('Y-m-d'),
                config('app.salery_range')[$user->requested_salary],
                $user->crim ? 'بله، ' . $user->crime_description : 'خیر',
                config('app.enum_referer')[$user->referer],
                $user->apply_count,
                $user->rejected_apply_count,
                $user->seened_apply_count,
                $user->accepted_apply_count,
                myDate::createFromCarbon(Carbon::parse($user->last_login))->format('Y-m-d'),
                myFuncs::percent_calc($user->complete_percent),
                $state
            ];
        }
        myFuncs::export_to_csv($header, $body, 'Users_export');
    }

    public function not_have_resume_export_csv()
    {
        //
//        $users = User::select('users.complete_percent AS completePercent','users.id AS userID','users.first_name AS firstName','users.last_name AS lastName','users.email AS userEmail','users.mobile AS userMobile','users.last_login AS userLastLogin','provinces.name AS provinceName','cities.name AS cityName','resumes.id AS res_id','resume_educational_details.grade AS userEducationGrade','degrees.name AS userDegreesName');
        $users = User::select('users.complete_percent AS completePercent','users.id AS userID','users.first_name AS firstName','users.last_name AS lastName','users.email AS userEmail','users.mobile AS userMobile','users.last_login AS userLastLogin');
//        $users = User::select()->where('users.complete_percent','=',0);

        #m2kia
//        $users->join('user_profiles', function($join) {
//            $join->select(['province_id','city_id'])->on('user_profiles.user_id', '=', 'users.id');
//        });
//        $users->join('provinces', function($join) {
//            $join->select(['name'])->on('provinces.id', '=', 'user_profiles.province_id');
//        });
//        $users->join('cities', function($join) {
//            $join->select(['name'])->on('cities.id', '=', 'user_profiles.city_id');
//        });
//        $users->join('resumes', function($join) {
//            $join->select(['id','user_id'])->on('resumes.user_id', '=', 'users.id');
//        });
//        $users->join('resume_educational_details', function($join) {
//            $join->select(['id','grade'])->on('resume_educational_details.resume_id', '=', 'resumes.id');
//        });
//        $users->join('degrees', function($join) {
//            $join->select(['name'])->on('degrees.id', '=', DB::raw("(select max(`grade`) from resume_educational_details where resume_id = resumes.id)"));
//        });
//        # First name contains ...
//        if (request('first_name') != '')
//            $users->where('first_name', 'like', '%' . request('first_name') . '%');
//
//        # Last name contains ...
//        if (request('last_name') != '')
//            $users->where('last_name', 'like', '%' . request('last_name') . '%');
//
//        # Mobile contains ...
//        if (request('mobile') != '')
//            $users->where('mobile', 'like', '%' . request('mobile') . '%');
//
//        # Email contains ...
//        if (request('email') != '')
//            $users->where('email', 'like', '%' . request('email') . '%');
//
//        # Gender ...
//        if (request('gender') != '' && request('gender') != 0) {
//            $users->where('user_profiles.gender', '=', myFuncs::RemoveSpecialChar(request('gender')));
//        }


        $users = $users->groupBy('users.mobile')->get();
//        var_dump($users);exit;
        $extra_query = null;


        $header = [
            'نام',
            'نام خانوادگی',
            'ایمیل',
            'شماره موبایل',
            'آخرین ورود',
            'تحصیلات',
            'استان-شهر'
        ];
        //config('app.enum_last_degree')[$user->grade]
        $body = array();
        foreach ($users as $user) {
//            echo $user->completePercent.'<br>';
//            if(intval($user->completePercent) == 0){
                 $body[] = [
                    $user->firstName,
                    $user->lastName,
                    $user->userEmail,
                    "\t" . $user->userMobile . "\t",
                    myDate::createFromCarbon(Carbon::parse($user->userLastLogin))->format('Y-m-d'),
                    $user->userDegreesName,
                    $user->provinceName.' - '.$user->cityName
                ];
//            }
        }
//        exit;
        myFuncs::export_to_csv($header, $body, 'Users_export');
    }

   /* public function export_admins_csv()
    {
        $users = DB::table('users')->leftJoin('resumes', 'users.id', '=', 'resumes.user_id')
            ->rightJoin('model_has_roles', function ($join) {
                $join->on('users.id', '=', 'model_has_roles.model_id')
                    ->where('model_has_roles.model_type', 'HR\User');
            })->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->leftJoin('provinces', 'provinces.id', '=', 'resumes.province_id')
            ->leftJoin('resume_has_industries', 'resume_has_industries.resume_id', '=', 'resumes.id')
            ->leftJoin('industries', 'industries.id', '=', 'resume_has_industries.industry_id')
            ->select(
                'users.id as user_id',
                'resumes.id as resume_id',
                'users.first_name',
                'users.last_name',
                DB::raw('(select last_post from resume_work_experiences where resumes.id  =   resume_work_experiences.resume_id  and end_date is NULL order by id asc limit 1) as last_post'),
                DB::raw('(select title from resume_work_experiences where resumes.id  =   resume_work_experiences.resume_id  and end_date is NULL order by id asc limit 1) as company_name'),
                'provinces.name AS pName',
                DB::raw('GROUP_CONCAT(DISTINCT industries.name SEPARATOR \', \') AS user_industries'),
                DB::raw('GROUP_CONCAT(DISTINCT roles.name SEPARATOR \', \') AS user_roles'),
                DB::raw('(select COUNT(jobs.id) from jobs where jobs.created_by  =   users.id  and jobs.deleted_at is NULL ) as job_count'),
                'users.last_login'
            )
            ->groupBy('users.id')
            ->get();

        $line_counter = 1;
        $body = array();
        $header = [
            'ردیف',
            'نام',
            'نام خانوادگی',
            'سمت سازمانی',
            'نام شرکت',
            'استان محل کار',
            'زمینه صنعت',
            'نوع دسترسی',
            'تعداد آگهی ثبتی',
//            'درصد رزومه های بررسی شده',
            'آخرین زمان بازدید سایت',
        ];
        foreach ($users as $user)
            $body[] = [
                $line_counter++,
                $user->first_name,
                $user->last_name,
                $user->last_post,
                $user->company_name,
                $user->pName,
                $user->user_industries,
                $user->user_roles,
                $user->job_count,
                myDate::createFromCarbon(Carbon::parse($user->last_login))->format('Y-m-d'),
            ];
        myFuncs::export_to_csv($header, $body, 'Users_csvExp_');
    }*/
    
    
     /*   public function export_admins_csv()
    {
        $users = DB::table('users')->leftJoin('resumes', 'users.id', '=', 'resumes.user_id')
            ->rightJoin('model_has_roles', function ($join) {
                $join->on('users.id', '=', 'model_has_roles.model_id')
                    ->where('model_has_roles.model_type', 'HR\User');
            })->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->leftJoin('provinces', 'provinces.id', '=', 'resumes.province_id')
            ->leftJoin('resume_has_industries', 'resume_has_industries.resume_id', '=', 'resumes.id')
            ->leftJoin('industries', 'industries.id', '=', 'resume_has_industries.industry_id')
            ->leftJoin('user_BI_data', 'user_BI_data.user_id', '=', 'users.id')
            ->Join('BI_user_status', 'BI_user_status.user_id', '=', 'users.id')
            ->Join('user_profiles', 'user_profiles.user_id', '=', 'users.id')

            ->select(
                'users.id as user_id',
                'resumes.id as resume_id',
                'users.first_name',
                'users.last_name',
                'user_profiles.national_code',

//                DB::raw('(select last_post from resume_work_experiences where resumes.id  =   resume_work_experiences.resume_id  and end_date is NULL order by id asc limit 1) as last_post'),
                'user_BI_data.company_name',
                'user_BI_data.department_name',
                'user_BI_data.post_title',
                'BI_user_status.company_id as bi_company_id',
                
//                DB::raw('(select title from resume_work_experiences where resumes.id  =   resume_work_experiences.resume_id  and end_date is NULL order by id asc limit 1) as company_name'),
                'provinces.name AS pName',
                DB::raw('GROUP_CONCAT(DISTINCT industries.name SEPARATOR \', \') AS user_industries'),
                DB::raw('GROUP_CONCAT(DISTINCT roles.name SEPARATOR \', \') AS user_roles'),
                DB::raw('(select COUNT(jobs.id) from jobs where jobs.created_by  =   users.id  and jobs.deleted_at is NULL ) as job_count'),
                'users.last_login'
            )
           >groupBy('users.id')
            ->get();

        $line_counter = 1;
        $body = array();
        $header = [
            'ردیف',
            'نام',
            'نام خانوادگی',
            'کدملی',
            'نام شرکت',
            'سمت سازمانی',
            'پست',
            'استان محل کار',
            'زمینه صنعت',
            'نوع دسترسی',
            'تعداد آگهی ثبتی',
//            'درصد رزومه های بررسی شده',
            'آخرین زمان بازدید سایت',
        ];
        foreach ($users as $user)
        {
           $status_result = DB::table('BI_user_status')->where('user_id', $user->user_id)->where('company_id',$user->bi_company_id)->get();

            $body[] = [
                $line_counter++,
                $user->first_name,
                $user->last_name,
                $user->national_code,
                $user->company_name,
                $user->department_name,
                $user->post_title,
                $user->pName,
                $user->user_industries,
                $user->user_roles,
                $user->job_count,
               // myDate::createFromCarbon(Carbon::parse($user->last_login))->format('Y-m-d'),
            ];
        }
        myFuncs::export_to_csv($header, $body, 'Users_csvExp_');
    }*/
    
        public function export_admins_csv()
    {
        $users = DB::table('users')->leftJoin('resumes', 'users.id', '=', 'resumes.user_id')
            ->rightJoin('model_has_roles', function ($join) {
                $join->on('users.id', '=', 'model_has_roles.model_id')
                    ->where('model_has_roles.model_type', 'HR\User');
            })->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->leftJoin('provinces', 'provinces.id', '=', 'resumes.province_id')
            ->leftJoin('resume_has_industries', 'resume_has_industries.resume_id', '=', 'resumes.id')
            ->leftJoin('industries', 'industries.id', '=', 'resume_has_industries.industry_id')
            ->leftJoin('user_BI_data', 'user_BI_data.user_id', '=', 'users.id')

              ->leftJoin('BI_user_status', function ($join1) {
                $join1->on('users.id', '=', 'BI_user_status.user_id')
                    ->where('BI_user_status.status',1);
            })
            
            
            ->Join('user_profiles', 'user_profiles.user_id', '=', 'users.id')

            ->select(
                'users.id as user_id',
                'resumes.id as resume_id',
                'users.first_name',
                'users.last_name',
                'user_profiles.national_code',

//                DB::raw('(select last_post from resume_work_experiences where resumes.id  =   resume_work_experiences.resume_id  and end_date is NULL order by id asc limit 1) as last_post'),
                'user_BI_data.company_name as company_name',
                'user_BI_data.department_name as department_name',
                'user_BI_data.post_title as post_title',
                'BI_user_status.status as bi_user_status',

//                DB::raw('(select title from resume_work_experiences where resumes.id  =   resume_work_experiences.resume_id  and end_date is NULL order by id asc limit 1) as company_name'),
                'provinces.name AS pName',
                DB::raw('GROUP_CONCAT(DISTINCT industries.name SEPARATOR \', \') AS user_industries'),
                DB::raw('GROUP_CONCAT(DISTINCT roles.name SEPARATOR \', \') AS user_roles'),
                DB::raw('(select COUNT(jobs.id) from jobs where jobs.created_by  =   users.id  and jobs.deleted_at is NULL ) as job_count'),
                'users.last_login'
            )
             ->groupBy('users.id')
            ->get();

        $line_counter = 1;
        $body = array();
        $header = [
            'ردیف',
            'نام',
            'نام خانوادگی',
            'کدملی',
            'نام شرکت',
            'سمت سازمانی',
            'پست',
            'استان محل کار',
            'زمینه صنعت',
            'نوع دسترسی',
            'تعداد آگهی ثبتی',
//            'درصد رزومه های بررسی شده',
            'آخرین زمان بازدید سایت',
        ];
        
            for($i=1;$i<6;$i++)
            {
                array_push($header,'شرکت','وضعیت');
            }
        $body=[];
        foreach ($users as $user)
        {
            
            $user_history = DB::table('BI_user_status')->where('user_id', $user->user_id)->where('status',0)->get();
          
            if(count($user_history) > 0)
            {
                 if ($user->bi_user_status == -1)
                    $user_his_status = "بلک لیست";
                 if ($user->bi_user_status == 0)
                    $user_his_status = "ادمین سابق";
                 else
                    $user_his_status = $user->user_roles;
                
                $body = [
                $line_counter++,
                $user->first_name,
                $user->last_name,
                $user->national_code,
                $user->company_name,
                $user->department_name,
                $user->post_title,
                $user->pName,
                $user->user_industries,
                $user_his_status,
                $user->job_count,
                myDate::createFromCarbon(Carbon::parse($user->last_login))->format('Y-m-d'),
            ];

            foreach ($user_history as $user_his) {
                
                 if ($user_his->status == -1)
                    $user_his_status = "بلک لیست";
                 if ($user_his->status == 0)
                    $user_his_status = "ادمین سابق";
                 else
                    $user_his_status = $user->user_roles;

                array_push($body,$user_his->company_name,$user_his_status);
                }
            }
            else if( count(DB::table('BI_user_status')->where('user_id', $user->user_id)->where('status',1)->get())>0)
            {
    
         
                
                $body = [
                $line_counter++,
                $user->first_name,
                $user->last_name,
                $user->national_code,
                $user->company_name,
                $user->department_name,
                $user->post_title,
                $user->pName,
                $user->user_industries,
                $user->user_roles,
                $user->job_count,
                myDate::createFromCarbon(Carbon::parse($user->last_login))->format('Y-m-d'),
            ];
                
            }
            else
            continue;
            $res[]=$body;
         /*               if(count($user_history) > 0)

           { var_dump($header);
               var_dump($res);
              // exit();
           }*/
        }
        myFuncs::export_to_csv($header, $res, 'Users_csvExp_');
    }
    
         public function export_admins_csv3()
    {
        $users = DB::table('users')->leftJoin('resumes', 'users.id', '=', 'resumes.user_id')
            ->rightJoin('model_has_roles', function ($join) {
                $join->on('users.id', '=', 'model_has_roles.model_id')
                    ->where('model_has_roles.model_type', 'HR\User');
            })->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->leftJoin('provinces', 'provinces.id', '=', 'resumes.province_id')
            ->leftJoin('resume_has_industries', 'resume_has_industries.resume_id', '=', 'resumes.id')
            ->leftJoin('industries', 'industries.id', '=', 'resume_has_industries.industry_id')
            ->leftJoin('user_BI_data', 'user_BI_data.user_id', '=', 'users.id')

              ->leftJoin('BI_user_status', function ($join1) {
                $join1->on('users.id', '=', 'BI_user_status.user_id')
                    ->where('BI_user_status.status',1);
            })
            
            
            ->Join('user_profiles', 'user_profiles.user_id', '=', 'users.id')

            ->select(
                'users.id as user_id',
                'resumes.id as resume_id',
                'users.first_name',
                'users.last_name',
                'user_profiles.national_code',

//                DB::raw('(select last_post from resume_work_experiences where resumes.id  =   resume_work_experiences.resume_id  and end_date is NULL order by id asc limit 1) as last_post'),
                'user_BI_data.company_name as company_name',
                'user_BI_data.department_name as department_name',
                'user_BI_data.post_title as post_title',
                'BI_user_status.status as bi_user_status',

//                DB::raw('(select title from resume_work_experiences where resumes.id  =   resume_work_experiences.resume_id  and end_date is NULL order by id asc limit 1) as company_name'),
                'provinces.name AS pName',
                DB::raw('GROUP_CONCAT(DISTINCT industries.name SEPARATOR \', \') AS user_industries'),
                DB::raw('GROUP_CONCAT(DISTINCT roles.name SEPARATOR \', \') AS user_roles'),
                DB::raw('(select COUNT(jobs.id) from jobs where jobs.created_by  =   users.id  and jobs.deleted_at is NULL ) as job_count'),
                'users.last_login'
            )
             ->groupBy('users.id')
            ->get();

        $line_counter = 1;
        $body = array();
        $header = [
            'ردیف',
            'نام',
            'نام خانوادگی',
            'کدملی',
            'نام شرکت',
            'سمت سازمانی',
            'پست',
            'استان محل کار',
            'زمینه صنعت',
            'نوع دسترسی',
            'تعداد آگهی ثبتی',
//            'درصد رزومه های بررسی شده',
            'آخرین زمان بازدید سایت',
        ];
        
            for($i=1;$i<6;$i++)
            {
                array_push($header,'شرکت','وضعیت');
            }
        $body=[];
        foreach ($users as $user)
        {
            if($user->bi_user_status == 1)
            {
                
                  if ($user->status == -1)
                    $user_his_status = "بلک لیست";
                 if ($user->status == 0)
                    $user_his_status = "ادمین سابق";
                 else
                    $user_his_status = $user->user_roles;
                  $body = [
                $line_counter++,
                $user->first_name,
                $user->last_name,
                $user->national_code,
                $user->company_name,
                $user->department_name,
                $user->post_title,
                $user->pName,
                $user->user_industries,
                $user_his_status,
                $user->job_count,
                myDate::createFromCarbon(Carbon::parse($user->last_login))->format('Y-m-d'),
            ];
            
    $user_history = DB::table('BI_user_status')->where('user_id', $user->user_id)->where('status',0)->get();
          
            if(count($user_history) > 1)
            {
               foreach ($user_history as $user_his) { 
                   
                    if ($user_his->status == -1)
                    $user_his_status = "بلک لیست";
                 if ($user_his->status == 0)
                    $user_his_status = "ادمین سابق";
                 else
                    $user_his_status = $user->user_roles;
                $body = [
                $line_counter++,
                $user->first_name,
                $user->last_name,
                $user->national_code,
                $user_his->company_name,
                $user->department_name,
                $user->post_title,
                $user->pName,
                $user->user_industries,
                $user_his_status,
                $user->job_count,
                myDate::createFromCarbon(Carbon::parse($user->last_login))->format('Y-m-d'),
            ];

            
                
                

                array_push($body,$user_his->company_name,$user_his_status);
                }

            
            
            }
            else
            {
                    $body = [
                $line_counter++,
                $user->first_name,
                $user->last_name,
                $user->national_code,
                $user_his->company_name,
                $user->department_name,
                $user->post_title,
                $user->pName,
                $user->user_industries,
                $user_his_status,
                $user->job_count,
                myDate::createFromCarbon(Carbon::parse($user->last_login))->format('Y-m-d'),
            ];

            }
            
        
            }
            else  if($user->bi_user_status == 0)
            {
                 $user_history = DB::table('BI_user_status')->where('user_id', $user->user_id)->where('status',0)->get();
                if(count($user_history)>1)
                {
                    
                   foreach ($user_history as $user_his) { 
                   
                    if ($user_his->status == -1)
                    $user_his_status = "بلک لیست";
                 if ($user_his->status == 0)
                    $user_his_status = "ادمین سابق";
                 else
                    $user_his_status = $user->user_roles;
                $body = [
                $line_counter++,
                $user->first_name,
                $user->last_name,
                $user->national_code,
                $user_his->company_name,
                $user->department_name,
                $user->post_title,
                $user->pName,
                $user->user_industries,
                $user_his_status,
                $user->job_count,
                myDate::createFromCarbon(Carbon::parse($user->last_login))->format('Y-m-d'),
            ];

            
                
                

                array_push($body,$user_his->company_name,$user_his_status);
                }

                }
                else
                {
    
                
                 if ($user->status == -1)
                    $user_his_status = "بلک لیست";
                 if ($user->status == 0)
                    $user_his_status = "ادمین سابق";
                 else
                    $user_his_status = $user->user_roles;
                
                $body = [
                $line_counter++,
                $user->first_name,
                $user->last_name,
                $user->national_code,
                $user_his->company_name,
                $user->department_name,
                $user->post_title,
                $user->pName,
                $user->user_industries,
                $user_his_status,
                $user->job_count,
                myDate::createFromCarbon(Carbon::parse($user->last_login))->format('Y-m-d'),
            ];
                }
                
            }
         
            $res[]=$body;
         /*               if(count($user_history) > 0)

           { var_dump($header);
               var_dump($res);
              // exit();
           }*/
        }
        myFuncs::export_to_csv($header, $res, 'Users_csvExp_');
    }



    public function export_companies_activity()
    {
        $companies = Company::all()->pluck('name','id')->toArray();
        $tmp = [];
        foreach ($companies as $id=>$company){
            $tmp[$id] = ['company_name'=>$company];
        }
        $companies = $tmp;

        $result = DB::select("SELECT
    `companies`.`id`,
    `companies`.`name` AS company_name,
    COUNT(`jobs`.`id`) AS jobs_count
FROM
    `companies`
LEFT JOIN `jobs` ON `companies`.`id` = `jobs`.`company_id`
WHERE
    `jobs`.`status` = 1 AND DATE(`jobs`.`expire_date`) >= CURRENT_DATE
    AND `jobs`.`deleted_at` IS NULL AND jobs.approved = 1
GROUP BY
    `companies`.`id`");
        foreach ($result as $item){
            $companies[$item->id]['jobs_count'] = $item->jobs_count;
        }

        $result = DB::select("SELECT
    `companies`.`id`,
    `companies`.`name` AS company_name,
    COUNT(`applies`.`id`) AS applies_count
FROM
    `companies`
LEFT JOIN `jobs` ON `companies`.`id` = `jobs`.`company_id`
LEFT JOIN `applies` ON `applies`.`job_id` = `jobs`.`id`

WHERE
    `jobs`.`status` = 1 AND DATE(`jobs`.`expire_date`) >= CURRENT_DATE AND `jobs`.`deleted_at` IS NULL AND jobs.approved = 1 AND applies.deleted_at is null
GROUP BY
    `companies`.`id`");

        foreach ($result as $item){
            $companies[$item->id]['applies_count'] = $item->applies_count;
        }

        $result = DB::select("SELECT
    `companies`.`id`,
    `companies`.`name` AS company_name,
    COUNT(`applies`.`id`) AS applies_approved_count
FROM
    `companies`
LEFT JOIN `jobs` ON `companies`.`id` = `jobs`.`company_id`
LEFT JOIN `applies` ON `applies`.`job_id` = `jobs`.`id`

WHERE
    `jobs`.`status` = 1 AND DATE(`jobs`.`expire_date`) >= CURRENT_DATE AND `jobs`.`deleted_at` IS NULL AND jobs.approved = 1 AND applies.deleted_at is null AND applies.status = 2
GROUP BY
    `companies`.`id`");

        foreach ($result as $item){
            $companies[$item->id]['applies_approved_count'] = $item->applies_approved_count;
        }

        $result = DB::select("SELECT
    `companies`.`id`,
    `companies`.`name` AS company_name,
    COUNT(`applies`.`id`) AS applies_accepted_count
FROM
    `companies`
LEFT JOIN `jobs` ON `companies`.`id` = `jobs`.`company_id`
LEFT JOIN `applies` ON `applies`.`job_id` = `jobs`.`id`

WHERE
    `jobs`.`status` = 1 AND DATE(`jobs`.`expire_date`) >= CURRENT_DATE AND `jobs`.`deleted_at` IS NULL AND jobs.approved = 1 AND applies.deleted_at is null AND applies.status = 4
GROUP BY
    `companies`.`id`");

        foreach ($result as $item){
            $companies[$item->id]['applies_accepted_count'] = $item->applies_accepted_count;
        }

        $result = DB::select("SELECT
    `companies`.`id`,
    `companies`.`name` AS company_name,
    COUNT(`applies`.`id`) AS applies_rejected_count
FROM
    `companies`
LEFT JOIN `jobs` ON `companies`.`id` = `jobs`.`company_id`
LEFT JOIN `applies` ON `applies`.`job_id` = `jobs`.`id`

WHERE
    `jobs`.`status` = 1 AND DATE(`jobs`.`expire_date`) >= CURRENT_DATE AND `jobs`.`deleted_at` IS NULL AND jobs.approved = 1 AND applies.deleted_at is null AND applies.status =3
GROUP BY
    `companies`.`id`");

        foreach ($result as $item){
            $companies[$item->id]['applies_rejected_count'] = $item->applies_rejected_count;
        }

        $line_counter = 1;
        $body = array();
        $header = [
            'ردیف',
            'نام شرکت',
            'تعداد آگهی',
            'همه‌ی درخواست ها',
            'درخواست های تایید شده',
            'درخواست های برگزیده',
            'درخواست های نامتناست',
        ];
        foreach ($companies as $item)
            $body[] = [
                $line_counter++,
                $item['company_name'],
                isset($item['jobs_count'])?$item['jobs_count']:0,
                isset($item['applies_count'])?$item['applies_count']:0,
                isset($item['applies_approved_count'])?$item['applies_approved_count']:0,
                isset($item['applies_accepted_count'])?$item['applies_accepted_count']:0,
                isset($item['applies_rejected_count'])?$item['applies_rejected_count']:0,
            ];
        myFuncs::export_to_csv($header, $body, 'Companies_csvExp_');
    }

    public function export_companies_activity_all()
    {
        $companies = Company::all()->pluck('name','id')->toArray();
        $tmp = [];
        foreach ($companies as $id=>$company){
            $tmp[$id] = ['company_name'=>$company];
        }
        $companies = $tmp;

        $result = DB::select("SELECT
    `companies`.`id`,
    `companies`.`name` AS company_name,
    COUNT(`jobs`.`id`) AS jobs_count
FROM
    `companies`
LEFT JOIN `jobs` ON `companies`.`id` = `jobs`.`company_id`
WHERE
    `jobs`.`deleted_at` IS NULL AND jobs.approved = 1
GROUP BY
    `companies`.`id`");
        foreach ($result as $item){
            $companies[$item->id]['jobs_count'] = $item->jobs_count;
        }

        $result = DB::select("SELECT
    `companies`.`id`,
    `companies`.`name` AS company_name,
    COUNT(`applies`.`id`) AS applies_count
FROM
    `companies`
LEFT JOIN `jobs` ON `companies`.`id` = `jobs`.`company_id`
LEFT JOIN `applies` ON `applies`.`job_id` = `jobs`.`id`

WHERE
    `jobs`.`deleted_at` IS NULL AND jobs.approved = 1 AND applies.deleted_at is null
GROUP BY
    `companies`.`id`");

        foreach ($result as $item){
            $companies[$item->id]['applies_count'] = $item->applies_count;
        }

        $result = DB::select("SELECT
    `companies`.`id`,
    `companies`.`name` AS company_name,
    COUNT(`applies`.`id`) AS applies_approved_count
FROM
    `companies`
LEFT JOIN `jobs` ON `companies`.`id` = `jobs`.`company_id`
LEFT JOIN `applies` ON `applies`.`job_id` = `jobs`.`id`

WHERE
    `jobs`.`deleted_at` IS NULL AND jobs.approved = 1 AND applies.deleted_at is null AND applies.status = 2
GROUP BY
    `companies`.`id`");

        foreach ($result as $item){
            $companies[$item->id]['applies_approved_count'] = $item->applies_approved_count;
        }

        $result = DB::select("SELECT
    `companies`.`id`,
    `companies`.`name` AS company_name,
    COUNT(`applies`.`id`) AS applies_accepted_count
FROM
    `companies`
LEFT JOIN `jobs` ON `companies`.`id` = `jobs`.`company_id`
LEFT JOIN `applies` ON `applies`.`job_id` = `jobs`.`id`

WHERE
    `jobs`.`deleted_at` IS NULL AND jobs.approved = 1 AND applies.deleted_at is null AND applies.status = 4
GROUP BY
    `companies`.`id`");

        foreach ($result as $item){
            $companies[$item->id]['applies_accepted_count'] = $item->applies_accepted_count;
        }

        $result = DB::select("SELECT
    `companies`.`id`,
    `companies`.`name` AS company_name,
    COUNT(`applies`.`id`) AS applies_rejected_count
FROM
    `companies`
LEFT JOIN `jobs` ON `companies`.`id` = `jobs`.`company_id`
LEFT JOIN `applies` ON `applies`.`job_id` = `jobs`.`id`

WHERE
    `jobs`.`deleted_at` IS NULL AND jobs.approved = 1 AND applies.deleted_at is null AND applies.status = 3
GROUP BY
    `companies`.`id`");

        foreach ($result as $item){
            $companies[$item->id]['applies_rejected_count'] = $item->applies_rejected_count;
        }

        $result = DB::select("SELECT
    `companies`.`id`,
    `companies`.`name` AS company_name,
    COUNT(`applies`.`id`) AS applies_not_checked_count
FROM
    `companies`
LEFT JOIN `jobs` ON `companies`.`id` = `jobs`.`company_id`
LEFT JOIN `applies` ON `applies`.`job_id` = `jobs`.`id`

WHERE
    `jobs`.`deleted_at` IS NULL AND jobs.approved = 1 AND applies.deleted_at is null AND applies.status = 1
GROUP BY
    `companies`.`id`");

        foreach ($result as $item){
            $companies[$item->id]['applies_not_checked_count'] = $item->applies_not_checked_count;
        }


        $line_counter = 1;
        $body = array();
        $header = [
            'ردیف',
            'نام شرکت',
            'تعداد آگهی',
            'همه‌ی درخواست ها',
            'درخواست های تایید شده',
            'درخواست های برگزیده',
            'درخواست های نامتناست',
            'درخواست های در انتظار بررسی',
        ];
        foreach ($companies as $item)
            $body[] = [
                $line_counter++,
                $item['company_name'],
                isset($item['jobs_count'])?$item['jobs_count']:0,
                isset($item['applies_count'])?$item['applies_count']:0,
                isset($item['applies_approved_count'])?$item['applies_approved_count']:0,
                isset($item['applies_accepted_count'])?$item['applies_accepted_count']:0,
                isset($item['applies_rejected_count'])?$item['applies_rejected_count']:0,
                isset($item['applies_not_checked_count'])?$item['applies_not_checked_count']:0,
            ];
        myFuncs::export_to_csv($header, $body, 'Companies_csvExp_');
    }
    
    public function Blacklist()
    {
        $results = json_decode(file_get_contents("http://172.31.2.18:1459/deactive/default/GetResults/"));
        $block_res = 0;
        $users=[];
        foreach($results as $result)
        {
            $u_profile = UserProfile::where('national_code',$result->Codemelli)->first();
            if(count($u_profile) > 0)
            {
                if(count($u_profile->user) > 0)
                 $users[] = $u_profile->user;
            }
                
            else
                continue;
   
        }
       // die(json_encode($users));
        return view(
            'admin.users.blacklist',
            compact(
                [
                    'users'
                ]
            )
        );
    }
    
    public function export_blacklist()
    {
        
        $results = json_decode(file_get_contents("http://172.31.2.18:1459/deactive/default/GetResults/"));
        $block_res = 0;
        $users=[];
        foreach($results as $result)
        {
            $u_profile = UserProfile::where('national_code',$result->Codemelli)->first();
            if(count($u_profile) > 0)
            {
                if(count($u_profile->user) > 0)
                 $users[] = $u_profile->user;
            }
                
            else
                continue;
   
        }
        
                 $header = [
        'نام', 'نام خانوادگی', 'موبایل','ایمیل','کد ملی','تاریخ ثبت نام','تاریخ آخرین ورود'
         ];

        $body = array();
        foreach ($users as $user) {




                
                

            $body[] = [
                $user->first_name,
                $user->last_name,
                $user->mobile,
                $user->email,
                $user->profile->national_code,
                JDate::createFromCarbon(Carbon::parse($user->created_at)->timezone('Asia/Tehran'))->format('Y/m/d'),
                JDate::createFromCarbon(Carbon::parse($user->last_login)->timezone('Asia/Tehran'))->format('Y/m/d')              
            ];
        }
        myFuncs::export_to_csv($header, $body, 'blacklist');
    }


/*    public function zoee_search()
    {
        //DB::table('users')->where('id',114908)->get();
        die(DB::table('users')->where('id',116771)->get());
    }*/
}
