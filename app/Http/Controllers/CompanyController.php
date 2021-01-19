<?php

namespace HR\Http\Controllers;

use HR\Company;
use HR\Job;
use HR\myFuncs;
use HR\Province;
use HR\Slider;
use HR\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isSuperAdmin'])->except(['show', 'job']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(50, ['logo', 'id', 'name', 'home_page_url', 'created_at', 'gig_company_id']);
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::role('برنامه نویس')->get()->merge((User::role('سوپرادمین')->get()))->merge((User::permission('پنل ادمین')->get()));
        $gig_all_companies = json_decode(file_get_contents("https://golrang.com/api/get-all-companies"), 1);
        if (!is_null($gig_all_companies) && $gig_all_companies['status'])
            $gig_all_companies = $gig_all_companies['data']['companies'];

        $gig_all_selected_companies = array_filter(Company::all()->pluck('gig_company_id')->toArray());

        foreach ($gig_all_companies as $key => $company)
            if (in_array($company['id'], $gig_all_selected_companies))
                unset($gig_all_companies[$key]);

        $gig_all_companies = array_merge(['0' => ["id" => '', "title" => "انتخاب کنید"]], $gig_all_companies);

        return view('admin.companies.create', compact(['users', 'gig_all_companies']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($_POST);
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'LatLng' => 'required|string|max:255',
            'gig_company_id' => 'required|integer|min:1|max:1000',
            'images' => 'required|string|max:10000',
            'admins' => 'nullable|array|max:1000'
        ]);
        $company = Company::create($request->all());
        $images = explode(',', $request['images']);
        $images = array_filter($images);
        foreach ($images as $image) {
            $img = new Slider();
            $img->model_name = 'company';
            $img->model_id = $company->id;
            $img->url = $image;
            $img->save();
        }
        if (isset($request['admins']) && !is_null($request['admins'] && is_array($request['admins']) && !empty($request['admins']))) {
            foreach ($request['admins'] as $item)
                $company->users()->attach($item);
        }
        return redirect()->route('companies.index')
            ->with('flash_message', 'آیتم با موفقیت ایجاد گردید');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $url = null)
    {
        $company = Company::findOrFail($id);
        if (!auth()->check()) {
            /*if (!isset($_SESSION)) {
                session_start();
            }
            if (!isset($_SESSION['referrer_company_id']))
                $_SESSION['referrer_company_id'] = $id;*/
                
            if (!session()->get('referrer_company_id'))
            {
                session()->put('referrer_company_id', $id);
                session()->save();
            }
        }
        $data = json_decode(file_get_contents("https://golrang.com/api/get-companies?company_list=[%22" . $company->gig_company_id . "%22]"), 1);
        if (!is_null($data) && $data['status'])
            $data = $data['data']['companies'][0];
        $data['logo'] = 'https://golrang.com' . $data['logo'];
        /*if (empty($data) || $data['url'] != $url)
            abort(404);*/
        $images = Slider::where('model_name', 'company')->where('model_id', $id)->get();
        $jobs = Job::where('approved', 1)
            ->where('status', 1)
            ->where('expire_date', '>=', Carbon::now()->toDateTimeString())
            ->where('company_id', $id)->paginate(6);

        $company_detail = array();

        if (!empty($data['qualification']))
            $company_detail['گواهینامه های کیفی اخذ شده'] = $data['qualification'];
        if (!empty($data['vision']))
            $company_detail['چشم انداز'] = $data['vision'];

        if (!empty($data['mission']))
            $company_detail['ماموریت'] = $data['mission'];


        if (!empty($data['foundation_date']))
            $company_detail['سال تاسیس'] = $data['foundation_date'];

        if (!empty($data['site_count']))
            $company_detail['تعداد سایت های تولیدی'] = $data['site_count'];

        if (!empty($data['personel_count']))
            $company_detail['تعداد کارکنان'] = $data['personel_count'];

        if (!empty($data['address']))
            $company_detail['آدرس'] = $data['address'];

        $company_detail_left = array();
        $company_detail_right = array();

        foreach ($company_detail as $key => $item) {
            if ((strlen(implode(' ', $company_detail_left)) + count($company_detail_left) * 350) < (strlen(implode(' ', $company_detail_right)) + count($company_detail_right) * 350))
                $company_detail_left[$key] = $item;
            else
                $company_detail_right[$key] = $item;
        }

        return view('site.companies.show', compact([
            'company', 'data', 'images', 'jobs', 'company_detail_left', 'company_detail_right'
        ]));
    }

    public function job($alias)
    {
        $job = Job::where('persian_alias', $alias)->first();
        if (!$job)
            abort(404);
        $job->visit_count += 1;
        $job->save();
        $images = Slider::where('model_name', 'Job')->where('model_id', $job->id)
            ->orWhere(function ($query) use ($job) {
                $query->where('model_name', 'company')
                    ->where('model_id', $job->company->id);
            })
            ->get();

        $cities = DB::table('jobs')
            ->where('jobs.persian_alias', $alias)
            ->leftJoin('job_has_cities', 'jobs.id', '=', 'job_has_cities.job_id')
            ->leftJoin('cities', 'cities.id', '=', 'job_has_cities.city_id')
            ->leftJoin('provinces', 'provinces.id', '=', 'cities.province_id')->pluck('provinces.name')->toArray();
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
        return view('site.companies.job', compact(['job', 'gig_data', 'images', 'cities', 'cities_for_apply']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $images = Slider::where('model_name', 'company')->where('model_id', $id)->get();
        $users = User::role('برنامه نویس')->get()->merge((User::role('سوپرادمین')->get()))->merge((User::permission('پنل ادمین')->get()));

        $gig_all_companies = json_decode(file_get_contents("https://golrang.com/api/get-all-companies"), 1);
        if (!is_null($gig_all_companies) && $gig_all_companies['status'])
            $gig_all_companies = $gig_all_companies['data']['companies'];
        $gig_all_selected_companies = array_filter(Company::where('id', '!=', $id)->pluck('gig_company_id')->toArray());

        foreach ($gig_all_companies as $key => $company)
            if (in_array($company['id'], $gig_all_selected_companies))
                unset($gig_all_companies[$key]);

        $gig_all_companies = array_merge(['0' => ["id" => '', "title" => "انتخاب کنید"]], $gig_all_companies);
        $company = Company::find($id);

        return view('admin.companies.edit', compact(['company', 'companies', 'images', 'users', 'gig_all_companies']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($_POST);
        $this->validate($request, [
            'LatLng' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'images' => 'required|string|max:10000',
            'admins' => 'nullable|array|max:1000',
            'gig_company_id' => 'required|integer|min:1|max:1000'
        ]);

        $company = Company::find($id);
        $company->name = $request['name'];
        $company->gig_company_id = $request['gig_company_id'];
        $company->save();

        Slider::where('model_name', 'company')->where('model_id', $company->id)->delete();

        $images = explode(',', $request['images']);
        $images = array_filter($images);
        foreach ($images as $image) {
            $img = new Slider();
            $img->model_name = 'company';
            $img->model_id = $company->id;
            $img->url = $image;
            $img->save();
        }
        $company->users()->detach();
        if (isset($request['admins']) && !is_null($request['admins'] && is_array($request['admins']) && !empty($request['admins']))) {
            foreach ($request['admins'] as $item)
                $company->users()->attach($item);
        }
        return redirect()->route('companies.index')
            ->with('flash_message', 'آیتم با موفقیت ویرایش گردید');
    }

    public function export()
    {
       /* if(Auth::user()->id == 108738)
        {
            $r = Company::where('id',270)->first();
            die(json_encode($r->users));
        }*/
        $companies = Company::all();
        $hr_companies = [];
        foreach ($companies as $company)
        {
            $hr_companies[$company->gig_company_id] = '';
            foreach ($company->users as $user)
                $hr_companies[$company->gig_company_id].=$user->first_name.' '.$user->last_name.'، ';

        }


        $gig_all_companies = json_decode(file_get_contents("https://golrang.com/api/get-all-companies"), 1);

        if(!isset($gig_all_companies['data']['companies']))
            return redirect()->back()->withErrors(['خطا در فراخوانی سرویس شرکت ها از سایت گلرنگ']);

        $gig_all_companies = $gig_all_companies['data']['companies'];

        $line_counter = 1;
        $body = [];
        $header = [
            'ردیف',
            'نام شرکت',
            'فعال/غیر فعال',
            'ادمین ها',
        ];
        foreach ($gig_all_companies as $company)
            $body[] = [
                $line_counter++,
                $company['title'],
                isset($hr_companies[$company['id']])?'فعال':'غیر فعال',
                $hr_companies[$company['id']]
            ];

        myFuncs::export_to_csv($header, $body, 'Companies_csvExp_');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::destroy($id);
        return redirect()->route('admin.companies.index')
            ->with('flash_message', 'آیتم با موفقیت حذف گردید');
    }
}
