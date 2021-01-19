<?php

namespace HR\Http\Controllers;

use Barryvdh\Snappy\Facades\SnappyPdf;
use HR\Industry;
use HR\Introducer;
use HR\JobDepartment;
use HR\JobProfessionalMerites;
use HR\myDate;
use HR\myFuncs;
use HR\Province;
use HR\Resume;
use HR\Job;
use HR\ResumeContractType;
use HR\ResumeEducationalDetails;
use HR\ResumeFamilyDetail;
use HR\ResumeForeignLanguage;
use HR\ResumeQuestion;
use HR\ResumeWorkExperience;
use HR\Site;
use HR\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Knp\Snappy\Pdf;
use Carbon\Carbon;
use p3ym4n\JDate\JDate;

use Illuminate\Support\Facades\DB;
//use App\Http\Controllers\Controller;
//use PhpOffice\PhpWord\PhpWord;;
//use Vsword\VsWord;;
global $a;
$a = 1;
$b = 2;

class resumeController extends Controller
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

        $this->middleware(['auth'])->except('one_time','apiShowResume');
        $this->middleware(['isSuperAdmin'])->only('index');
        $this->middleware(['isAdmin'])->only('show');
        $this->middleware('isMobileVerified')->except('one_time','apiShowResume');
        ini_set('memory_limit', '-1');

    }


    public function index()
    {
        $resumes = Resume::all();
        return view('admin.resumes.index', compact(['resumes']));
    }

    public function show($id)
    {

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
        
        if(Auth::user()->id ==108738)
                    $view = View::make('site.resume.pdf_ba', compact(['resume','user_khedmat_status','user_khedmat_moaf_status','degrees_array','years_old']));


        if (in_array(13, auth()->user()->company->pluck('id')->toArray()))
            $view = View::make('site.resume.pdf_new', compact(['resume','user_khedmat_status','user_khedmat_moaf_status','degrees_array','years_old']));
        else
            $view = View::make('site.resume.pdf', compact(['resume','user_khedmat_status','user_khedmat_moaf_status','degrees_array','years_old']));

        //echo $view;exit;

        $contents = $view->render();
        return SnappyPdf::loadHtml($contents)
            ->setPaper('A4')
            ->setOrientation('portrait')
            ->setOption('margin-bottom', 30)
            ->setOption('dpi', 300)
            ->setOption('footer-html', 'https://people.golrang.com/resume/footer.php')
            ->inline(myDate::now()->timezone('Asia/Tehran')->format('Y-m-d') . '_' . $user->first_name . '_' . $user->last_name . '.pdf');
    }
    public function apiShowResume($id,$token)
    {
        $token_expire = DB::select('select * from tokens where token="'.$token.'" and expire=0 limit 1');

        if(count($token_expire) > 0 ) {
             DB::table('tokens')
                  ->where('token', $token)
                  ->update(array('expire' => 1));
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

        /*if (in_array(13, auth()->user()->company->pluck('id')->toArray()))*/
            $view = View::make('site.resume.pdf_new', compact(['resume','user_khedmat_status','user_khedmat_moaf_status','degrees_array','years_old']));
     /*   else
            $view = View::make('site.resume.pdf', compact(['resume','user_khedmat_status','user_khedmat_moaf_status','degrees_array','years_old']));*/

        //echo $view;exit;

        $contents = $view->render();
        return SnappyPdf::loadHtml($contents)
            ->setPaper('A4')
            ->setOrientation('portrait')
            ->setOption('margin-bottom', 30)
            ->setOption('dpi', 300)
            ->setOption('footer-html', 'https://people.golrang.com/resume/footer.php')
            ->inline(myDate::now()->timezone('Asia/Tehran')->format('Y-m-d') . '_' . $user->first_name . '_' . $user->last_name . '.pdf');
        }else abort(403);

    }

	public function show2($id)
	{

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

		if (in_array(13, auth()->user()->company->pluck('id')->toArray()))
			$view = View::make('site.resume.pdf_new', compact(['resume','user_khedmat_status','user_khedmat_moaf_status','degrees_array','years_old']));
		else
			$view = View::make('site.resume.pdf', compact(['resume','user_khedmat_status','user_khedmat_moaf_status','degrees_array','years_old']));

		//echo $view;exit;

		//$contents = $view->render();
		//include(app_path() . '/PhpOffice/Phpword/PhpWord.php');

		/*$phpWord = new PhpWord();
		 //Adding an empty Section to the document...
		$section = $phpWord->addSection();
		$section->addText($view);
		$objWriter = IOFactory::createWriter($phpWord, 'Word2007');
		$objWriter->save('helloWorld.docx');*/


		$doc = new VsWord();
		$parser = new HtmlParser($doc);
		$parser->parse('<h1>Hello world!</h1>');
		$parser->parse('<h3>Hello world!</h3>');
		$parser->parse('<p>Hello world!</p>');
		$parser->parse('<h2>Header table</h2><table><tr><td>Coll 1</td><td>Coll 2</td></tr></table>');
		$parser->parse($html);

		echo '<pre>'.($doc->getDocument()->getBody()->look()).'</pre>';

		$doc->saveAs('htmlparser.docx');
	}

    public function pdf()
    {
        $resume = null;
        if (auth()->user()->resume)
            $resume = Resume::find(auth()->user()->resume->id);

        return view('site.resume.pdf', compact(['resume']));
    }

    public function preview()
    {
        $CV = Auth::user()->resume;
        if (!$CV) {
            return redirect()->back()->with('flash_message',
                'شما روزمه ای جهت نمایش ندارید');
        }
        return view('admin.resumes.show', compact('CV','degrees'));
    }

    public function store_job_detail(Request $request)
    {
        if(myFuncs::check_blacklist(Auth::user()->profile->national_code))
        {
            return redirect()->back()->withErrors([' متاسفانه شما امکان همکاری با گروه صنعتی گلرنگ را ندارید']);
        }

        foreach ($request->all() as $key => $value)
            $request[$key] = myFuncs::nums_to_en($request[$key]);

        $this->validate($request, [
            'province_id' => 'integer|exists:provinces,id',
            'contract_type' => 'required|array',
            'contract_type.*' => 'integer|exists:resume_contract_types,id',
            'department_id' => 'required|array',
            'department_id.*' => 'integer|exists:job_departments,id',
            'industry_id' => 'required|array',
            'industry_id.*' => 'integer|exists:industries,id',
            'our' => 'integer|between:1,10',
            'requested_salary' => 'required|string',
        ]);

        #save resume
        $resume = Resume::where('user_id', Auth::user()->id)->first();
        if (!$resume)
            $resume = new Resume();
        $resume->user_id = Auth::user()->id;
        $resume->province_id = $request['province_id'];
        $resume->referer = $request['our'];
        if ($request['our'] == 6 || $request['our'] == 4) {
            $this->validate($request, [
                'moaref_fullname' => 'required|string|max:90',
                'moaref_compnay' => 'required|string|max:90',
                'moaref_nesbat' => 'required|string|max:90',
                'moaref_post' => 'required|string|max:90',
            ]);

            $introducer = new Introducer();
            $introducer->name = $request['moaref_fullname'];
            $introducer->company_name = $request['moaref_compnay'];
            $introducer->relevance = $request['moaref_nesbat'];
            $introducer->post = $request['moaref_post'];
            $introducer->user_id = Auth::user()->id;
            $introducer->ashna = 0;
            $introducer->save();
            $resume->introducer_id = $introducer->id;
        } else {
            $resume->introducer_id = null;
        }

        if ($request['our'] == 3) {
            $this->validate($request, [
                'our_others_text' => 'required|string|max:254',
            ]);

            $url = $request['our_others_text'];
            $url = str_replace('http://', '', $url);
            $url = str_replace('https://', '', $url);
            $url = str_replace('www.', '', $url);
            $url = rtrim($url, '/');

            $site = Site::where('url', $url)->first();

            if (is_null($site)) {
                $site = new Site();
                $site->url = $url;
                $site->save();
            }

            $resume->site()->detach();
            $resume->site()->attach($site->id);
        }

        if ($request['our'] == 7) {
            $resume->other = '';
            $this->validate($request, [
                'our_others_text' => 'required|string|max:254',
            ]);
            $resume->other = $request['our_others_text'];
        }

        $resume->save();

        $q = ResumeQuestion::where('resume_id', User::find(Auth::user()->id)->resume->id)->first();
        if ($q == null)
            $q = new ResumeQuestion();
        $q->requested_salary = str_replace(',', '', $request['requested_salary']);
        $q->resume_id = $resume->id;
        $q->save();

        #contract_type
        $resume->contractTypes()->detach();
        $this->validate($request, []);
        foreach ($request['contract_type'] as $item) {
            if (ResumeContractType::find($item)->count())
                $resume->contractTypes()->attach($item);
        }

        #industry
        $resume->industries()->detach();
        foreach ($request['industry_id'] as $item) {
            if (Industry::find($item)->count())
                $resume->industries()->attach($item);
        }

        #department
        $resume->departments()->detach();
        foreach ($request['department_id'] as $item) {
            if (JobDepartment::find($item)->count())
                $resume->departments()->attach($item);
        }
        $user = Auth::user();

        $flag = $user->complete_percent != 31;
        $user->complete_percent = myFuncs::percent_add($user->complete_percent, 1);
        $user->save();

        if(!isset($_SESSION))
        {
            session_start();
        }
        if ($flag && ($user->complete_percent == 31)) {
            if(isset($_SESSION['job_id']) && !is_null($_SESSION['job_id']))
            {
                $job = Job::find($_SESSION['job_id']);

                $_SESSION['job_id'] = '';

                if($job)
                    return redirect('/company-jobs/'.$job->persian_alias);
            }
            return redirect()->route('site.jobs.index')->with('flash_message', 'رزومه ی شما تکمیل شد. اکنون موقعیت شغلی مناسب را انتخاب فرمایید.');
        }


        /*if (Auth::user()->complete_percent != 31) {
            return redirect(
                route('user.resume.2')
            );
        } else
            return redirect()->back()->with('flash_message', 'رزومه با موفقیت ویرایش شد');*/

        return redirect(
            route('user.resume.2')
        );

    }

    public function store_educations(Request $request)
    {
        //print_r($request['grade']);exit;
        if (!Auth::user()->profile) {
            return redirect(route('site.user.profile'))->with('flash_message',
                'جهت تکمیل رزومه ابتدا باید پروفایل خود را تکمیل کنید');
        }
        $user = Auth::user();

        $resume = Resume::where('user_id', $user->id)->first();
        $educational_details = $resume->educational_details()->count();

        if (isset($request['no_education']) && $request['no_education'] == "1") {
            $resume->educational_details()->delete();
        } else {
            if ($educational_details == 0)
                return redirect()->back()
                    ->withErrors(['اگر مدرک شما زیر دیپلم است، گزینه ی زیر دیپلم را انتخاب کنید. در غیر اینصورت لطفا اطلاعات تحصیلی خود را در فرم زیر وارد کنید.']);
        }


        $flag = $user->complete_percent != 31 ;
        $user->complete_percent = myFuncs::percent_add($user->complete_percent, 2);
        $user->save();
        if(!isset($_SESSION))
        {
            session_start();
        }
        if ($flag && ($user->complete_percent == 31)) {
            if(isset($_SESSION['job_id']) && !is_null($_SESSION['job_id']))
            {
                $job = Job::find($_SESSION['job_id']);

                $_SESSION['job_id'] = '';

                if($job)
                    return redirect('/company-jobs/'.$job->persian_alias);
            }
            return redirect()->route('site.jobs.index')->with('flash_message', 'رزومه ی شما تکمیل شد. اکنون موقعیت شغلی مناسب را انتخاب فرمایید.');
        }
        /*if (Auth::user()->complete_percent != 31) {
            return redirect(
                route('user.resume.3')
            );
        }

        return redirect()->back()->with('flash_message', 'رزومه با موفقیت ویرایش شد');*/

	    return redirect(
		    route('user.resume.3')
	    );
    }

    public function store_skills(Request $request)
    {
        if(myFuncs::check_blacklist(Auth::user()->profile->national_code))
        {
            return redirect()->back()->withErrors([' متاسفانه شما امکان همکاری با گروه صنعتی گلرنگ را ندارید']);
        }

    	foreach ($request->all() as $key => $value)
        $request[$key] = myFuncs::nums_to_en($request[$key]);
        $resume = Resume::find(User::find(Auth::user()->id)->resume->id);

        if (isset($request['ProfesstionalTrainingRecords'])) {
            $this->validate($request, [
                'ProfesstionalTrainingRecords' => 'array|max:100',
                'ProfesstionalTrainingRecords.*.title' => 'required|string|max:255',
                'ProfesstionalTrainingRecords.*.duration' => 'required|integer',
                'ProfesstionalTrainingRecords.*.hasCertificate' => 'nullable|max:1',
                'ProfesstionalTrainingRecords.*.endDate' => 'required|integer',
                'ProfesstionalTrainingRecords.*.instituteName' => 'required|string|max:255',
            ]);
            $resume->professional_training_records()->detach();
//            dd($request['ProfesstionalTrainingRecords']);
            foreach ($request['ProfesstionalTrainingRecords'] as $item) {
                $item['title'] = str_replace('"', '', $item['title']);
                $merit = JobProfessionalMerites::where('name', $item['title'])->first();
                if (!$merit) {
                    JobProfessionalMerites::create(['name' => $item['title']]);
                    $merit = JobProfessionalMerites::where('name', $item['title'])->first();
                }
                if (isset($item['hasCertificate']) && $item['hasCertificate'] == '1') {
                    $resume->professional_training_records()->attach(
                        [
                            $merit->id => [
                                'duration' => $item['duration'],
                                'has_certificate' => 1,
                                'finish_year' => $item['endDate'],
                                'institute_name' => $item['instituteName'],
                            ]]
                    );
                } else {
                    $resume->professional_training_records()->attach(
                        [
                            $merit->id => [
                                'duration' => $item['duration'],
                                'has_certificate' => 0,
                                'finish_year' => $item['endDate'],
                                'institute_name' => $item['instituteName'],
                            ]]
                    );
                }
            }
        } else {
            $resume->professional_training_records()->detach();
        }


        if (isset($request['ForeignLanguage'])) {
            $this->validate($request, [
                'ForeignLanguage.*.title' => 'required|string|max:255',
                'ForeignLanguage.*.speaking' => 'required|integer|between:1,4',
                'ForeignLanguage.*.writing' => 'required|integer|between:1,4',
                'ForeignLanguage.*.comprehension' => 'required|integer|between:1,4',
                'ForeignLanguage.*.Certificate' => 'nullable|string|max:255',
            ]);
            ResumeForeignLanguage::where('resume_id', $resume->id)->delete();
            foreach ($request['ForeignLanguage'] as $item) {
                $languagesmap_id =  DB::table('languagesmap')->where('title','like',$item['title'])->first()->data_id;

                $fl = new ResumeForeignLanguage();
                $fl->resume_id = User::find(Auth::user()->id)->resume->id;
                $fl->title = $item['title'];
                $fl->conversation = $item['speaking'];
                $fl->writing = $item['writing'];
                $fl->comprehension = $item['comprehension'];
                $fl->certificate = $item['Certificate'];
                $fl->languagesmap_id = $languagesmap_id;
                $fl->save();
            }
        } else {
            ResumeForeignLanguage::where('resume_id', $resume->id)->delete();
        }


        if (isset($request['computerSkill'])) {
            $this->validate($request, [
                'computerSkill.*.title' => 'required|string|max:255',
                'computerSkill.*.proficiency' => 'required|integer|between:1,4',
                'computerSkill.*.has_certificate' => 'nullable|integer|between:1,1',
                'computerSkill.*.description' => 'nullable|string|max:255',
            ]);
            $resume->computer_skills()->detach();
            foreach ($request['computerSkill'] as $item) {

                $merit = JobProfessionalMerites::where('name', $item['title'])->first();

                if (!$merit) {
                    JobProfessionalMerites::create(['name' => $item['title']]);
                    $merit = JobProfessionalMerites::where('name', $item['title'])->first();
                }

                if (isset($item['Certificate'])) {
                    $resume->computer_skills()->attach(
                        [
                            $merit->id => [
                                'proficiency' => $item['proficiency'],
                                'has_certificate' => 1,
                                'description' => $item['description'],
                            ]]
                    );
                } else {
                    $resume->computer_skills()->attach(
                        [
                            $merit->id => [
                                'proficiency' => $item['proficiency'],
                                'has_certificate' => 0,
                                'description' => $item['description'],
                            ]]
                    );
                }

            }
        } else {
            $resume->computer_skills()->detach();
        }


        if (isset($request['experimental'])) {

            $this->validate($request, [
                'experimental.*.title' => 'required|string|max:255',
                'experimental.*.proficiency' => 'required|integer|between:1,4',
                'experimental.*.description' => 'nullable|string|max:5000',
            ]);
            $resume->experimental_expertises()->detach();
            foreach ($request['experimental'] as $item) {
                $merit = JobProfessionalMerites::where('name', $item['title'])->first();
                if (!$merit) {
                    JobProfessionalMerites::create(['name' => $item['title']]);
                    $merit = JobProfessionalMerites::where('name', $item['title'])->first();
                }
                $resume->experimental_expertises()->attach(
                    [
                        $merit->id => [
                            'proficiency' => $item['proficiency'],
                            'description' => $item['description'],
                        ]]
                );
            }
        } else {
            $resume->experimental_expertises()->detach();
        }

        $user = Auth::user();
        $flag = $user->complete_percent != 31 ;
        $user->complete_percent = myFuncs::percent_add($user->complete_percent, 3);
        $user->save();

        if(!isset($_SESSION))
        {
            session_start();
        }

        if ($flag && ($user->complete_percent == 31)) {

            if(isset($_SESSION['job_id']) && !is_null($_SESSION['job_id']))
            {
                $job = Job::find($_SESSION['job_id']);

                $_SESSION['job_id'] = '';

                if($job)
                    return redirect('/company-jobs/'.$job->persian_alias);
            }

            return redirect()->route('site.jobs.index')->with('flash_message', 'رزومه ی شما تکمیل شد. اکنون موقعیت شغلی مناسب را انتخاب فرمایید.');
        }

        /*if (Auth::user()->complete_percent != 31) {
            return redirect(
                route('user.resume.' . (string)myFuncs::percent_status(Auth::user()->complete_percent))
            );
        }
        return redirect()->back()->with('flash_message', 'رزومه با موفقیت ویرایش شد');*/
	    return redirect(
		    route('user.resume.5')
	    );
    }

    public function store_work_experience(Request $request)
    {

        if (!Auth::user()->profile) {
            return redirect(route('site.user.profile'))->with('flash_message',
                'جهت تکمیل رزومه ابتدا باید پروفایل خود را تکمیل کنید');
        }
        $user = Auth::user();

        $resume = Resume::where('user_id', $user->id)->first();
        $work_experiences = $resume->work_experiences()->count();


        if (isset($request['no_work_experience']) && $request['no_work_experience'] == "1") {
            $resume->work_experiences()->delete();
        } else {
            if ($work_experiences == 0)
                return redirect()->back()
                    ->withErrors(['اگر سابقه شغلی ندارید، لطفا گزینه ی «فاقد سابقه‌ی کار هستم» را انتخاب کنید. در غیر اینصورت لطفا سوابق شغلی خود را در فرم زیر وارد کنید.']);
        }


        $flag = $user->complete_percent != 31 ;
        $user->complete_percent = myFuncs::percent_add($user->complete_percent, 4);

        $user->save();
        if(!isset($_SESSION))
        {
            session_start();
        }
        if ($flag && ($user->complete_percent == 31)) {
            if(isset($_SESSION['job_id']) && !is_null($_SESSION['job_id']))
            {
                $job = Job::find($_SESSION['job_id']);

                $_SESSION['job_id'] = '';

                if($job)
                    return redirect('/company-jobs/'.$job->persian_alias);
            }
            return redirect()->route('site.jobs.index')->with('flash_message', 'رزومه ی شما تکمیل شد. اکنون موقعیت شغلی مناسب را انتخاب فرمایید.');
        }

        /*if (Auth::user()->complete_percent != 31) {
            return redirect(
                //route('user.resume.' . (string)myFuncs::percent_status(Auth::user()->complete_percent))
                route('user.resume.4')
            );
        }

        return redirect()->back()->with('flash_message', 'رزومه با موفقیت ویرایش شد');*/
	    return redirect(
		    route('user.resume.4')
	    );
    }

    public function store_questions(Request $request)
    {
        if(myFuncs::check_blacklist(Auth::user()->profile->national_code))
        {
            return redirect()->back()->withErrors([' متاسفانه شما امکان همکاری با گروه صنعتی گلرنگ را ندارید']);
        }


        foreach ($request->all() as $key => $value)
            $request[$key] = myFuncs::nums_to_en($request[$key]);

        $this->validate($request, [
            'crime' => 'required|integer|between:0,1',
            'crime_description' => 'nullable|string|max:5000',
            'sickness' => 'required|integer|between:0,1',
            'sickness_description' => 'nullable|string|max:5000',
            'introducer' => 'required_if:intro,1|array|max:100',
            'intro' => 'nullable|integer|between:0,1',
            'introducer.*.name' => 'nullable|string|max:50',
            'introducer.*.company' => 'nullable|string|max:255',
            'introducer.*.relation' => 'nullable|string|max:255',
            'introducer.*.post' => 'nullable|string|max:255',
            'q1' => 'string|max:5000',
            'q2' => 'string|max:5000',
            'q3' => 'string|max:5000',
            'q4' => 'nullable|string|max:5000',
            'accept' => 'required|integer',
            'Family' => 'required|array|min:1|max:100',
            //'Family.*.name' => 'required|string|max:256',
            'Family.*.relation' => 'required|string|max:256',
            'Family.*.relation' => 'nullable|string|max:256',
            'Family.*.organization' => 'nullable|string|max:256'
        ]);
        $q = ResumeQuestion::where('resume_id', User::find(Auth::user()->id)->resume->id)->first();
        if ($q == null)
            $q = new ResumeQuestion();
        $q->resume_id = User::find(Auth::user()->id)->resume->id;

        $q->crime = $request['crime'];
        $q->crime_description = $request['crime_description'];
        $q->sickness = $request['sickness'];
        if ($request['sickness'] == 1) {
            $this->validate($request, [
                'treatment' => 'required|integer|between:0,1',
            ]);
        }
        $q->sickness_description = $request['sickness_description'];
        $q->treatment = $request['treatment'];
        $q->Q1 = $request['q1'];
        $q->Q2 = $request['q2'];
        $q->Q3 = $request['q3'];
        $q->Q4 = $request['q4'];

        $resume = Resume::find(User::find(Auth::user()->id)->resume->id);
        $resume->introducers()->detach();

        if ($request['intro'] == 1) {
            foreach ($request['introducer'] as $item) {
                $introducer = new Introducer();
                $introducer->name = $item['name'];
                $introducer->company_name = $item['company'];
                $introducer->relevance = $item['relation'];
                $introducer->post = $item['post'];
                $introducer->user_id = Auth::user()->id;
                $introducer->ashna = 1;
                $introducer->save();
                $resume->introducers()->attach($introducer->id);

            }
        }

        $q->save();
        ResumeFamilyDetail::where('resume_id', $resume->id)->delete();
        foreach ($request['Family'] as $family) {
            $tmp = new ResumeFamilyDetail();
            $tmp->name = $family['first_name'].' '.$family['last_name'];
            
            $tmp->first_name = $family['first_name'];
            $tmp->last_name = $family['last_name'];
            $tmp->resume_id = $resume->id;
            $tmp->relation = $family['relation'];
            $tmp->job = isset($family['job']) ? $family['job'] : '';
            $tmp->organization = isset($family['organization']) ? $family['organization'] : '';
            $tmp->save();
        }


        $user = Auth::user();

        $user->complete_percent = myFuncs::percent_add($user->complete_percent, 5);
        $user->form_2 = 1;
        $user->save();

        /*if (Auth::user()->complete_percent != 31) {
            return redirect(
                route('user.resume.' . (string)myFuncs::percent_status(Auth::user()->complete_percent))
            );
        }
        return redirect()->route('user.resume.6')->with('flash_message', 'رزومه با موفقیت ویرایش شد');*/

	    return redirect(
		    route('user.resume.6')
	    );
    }

    public function job_detail()
    {
        if(myFuncs::check_blacklist(Auth::user()->profile->national_code))
        {
            return redirect()->back()->withErrors([' متاسفانه شما امکان همکاری با گروه صنعتی گلرنگ را ندارید']);
        }

        if (!Auth::user()->profile) {
            return redirect(route('site.user.profile'))->with('flash_message',
                'جهت تکمیل رزومه ابتدا باید پروفایل خود را تکمیل کنید');
        }

        $provinces = Province::all();
        $departments = JobDepartment::all();
        $industries = Industry::all()->sortBy("industry_order");
        if (Auth::user()->resume)
            $resume = Resume::find(Auth::user()->resume->id);
        else
            $resume = null;

        return view('site.pages.user.resume.job_detail', compact(['provinces', 'departments', 'industries', 'resume']));
    }

    public function skills()
    {
        $languages = array();
        $langs = DB::table('languagesmap')->where('id','<>','1')->get();
        foreach($langs as $lang){
            $languages[] = $lang->title;
        }

        if (!Auth::user()->profile) {
            return redirect(route('site.user.profile'))->with('flash_message',
                'جهت تکمیل رزومه ابتدا باید پروفایل خود را تکمیل کنید');
        }

        $resume = Resume::where('user_id', Auth::user()->id)->first();

        if ($resume)
            $english = ResumeForeignLanguage::where('resume_id', $resume->id)
                ->where('title', 'انگلیسی')->first();
        else
            $english = null;

        if (!$resume) {
            return redirect(route('user.resume.2'))->with('flash_message',
                'ابتدا باید این بخش از فرم، تکمیل گردد');
        }

        $provinces = Province::all();

        return view('site.pages.user.resume.skills', compact(['resume', 'english', 'provinces','languages']));
    }

    public function work_experience()
    {
        if (!Auth::user()->profile) {
            return redirect(route('site.user.profile'))->with('flash_message',
                'جهت تکمیل رزومه ابتدا باید پروفایل خود را تکمیل کنید');
        }

        $resume = Resume::where('user_id', Auth::user()->id)->first();
        if($resume)
        $work_experiences = $resume->work_experiences()->count();

        else {
            return redirect(route('user.resume.2'))->with('flash_message',
                'ابتدا باید این بخش از فرم، تکمیل گردد');
        }
        $current_year = intval(JDate::createFromCarbon(Carbon::now())->format('Y'));
	    $provinces = Province::all();

        return view('site.pages.user.resume.work-experience', compact(['resume', 'current_year', 'provinces']));
    }

    public function educations()
    {

        if (!Auth::user()->profile) {
            return redirect(route('site.user.profile'))->with('flash_message',
                'جهت تکمیل رزومه ابتدا باید پروفایل خود را تکمیل کنید');
        }

        $resume = Resume::where('user_id', Auth::user()->id)->first();


        if (!$resume)
            return redirect(route('user.resume.1'))->with('flash_message',
                'ابتدا باید این بخش از فرم، تکمیل گردد');

	    $field_types = DB::table('api_education_field_types')->get();
	    $institute_types = DB::table('api_institute_types')->get();
	    $fields = DB::table('api_education_fields')->get();
        $orientations = DB::table('api_education_orientations')->get();

        /*$educations = DB::table('educations')->whereNotIn('reshteh_code', [128249,128245])->get();
        $educations_gerayesh = DB::table('educations_gerayesh')->get();*/

        $educational_details = $resume->educational_details()->orderByDesc('grade')->get();
        $current_year = intval(JDate::createFromCarbon(Carbon::now())->format('Y'));
        $provinces = Province::all()->pluck('name')->toArray();
        $degrees = DB::table('degrees')->where('id', '<',7)->get();
        $degrees_array = $this->degrees_array;
        
        return view('site.pages.user.resume.educations', compact(['resume', 'current_year', 'educational_details', 'provinces','degrees','degrees_array','field_types','fields','orientations','institute_types']));
    }

    public function ajax_educations_fields(Request $request){
        $field_type_id = $request['field_type_id'];
	    $result = '';

        $fields = DB::table('api_education_fields')->where('api_education_field_type_id', '=', $field_type_id)->get();

        if (count($fields) > 0):
	        $result = '<option> </option>';
	        foreach ($fields as $field) {
		        $result .= '<option value="' . $field->id . '">' . $field->name . '</option>';
	        }
        else:
	        $result .= '<option value="0">-</option>';
        endif;

        return $result;
    }

	public function ajax_educations_orientations(Request $request){
        $field_id = $request['field_id'];

        $orientations = DB::table('api_education_orientations')->where('api_education_field_id', '=', $field_id)->get();
	    $result = '';

        if (count($orientations) > 0):
	        $result = '<option> </option>';
	        foreach ($orientations as $orientation) {
		        $result .= '<option value="' . $orientation->id . '">' . $orientation->name . '</option>';
	        }
        else:
	        $result .= '<option value="0">-</option>';
        endif;
        return $result;
    }

	public function ajax_institute(Request $request){
        $institute_type_id = $request['institute_type_id'];

        $institute = DB::table('api_institute_places')->where('api_institute_type_id', '=', $institute_type_id)->get();
	    $result = '';

        if (count($institute) > 0):
	        $result = '<option> </option>';
	        foreach ($institute as $institute) {
		        $result .= '<option value="' . $institute->id . '">' . $institute->name . '</option>';
	        }
        else:
	        $result = '<option></option>';
        endif;
        return $result;
    }

    public function questions()
    {
        if (!Auth::user()->profile) {
            return redirect(route('site.user.profile'))->with('flash_message',
                'جهت تکمیل رزومه ابتدا باید پروفایل خود را تکمیل کنید');
        }

        $resume = Resume::where('user_id', Auth::user()->id)->first();
        if (!$resume) {
            return redirect(route('user.resume.1'))->with('flash_message',
                'ابتدا باید این بخش از فرم، تکمیل گردد');
        }
        
        $relations = config('gng_config.gng.relation');
        

        return view('site.pages.user.resume.questions', compact('resume','relations'));
    }

    public function further_information()
    {
        if (!Auth::user()->profile) {
            return redirect(route('site.user.profile'))->with('flash_message',
                'جهت تکمیل رزومه ابتدا باید پروفایل خود را تکمیل کنید');
        }

        $resume = Resume::where('user_id', Auth::user()->id)->first();

        if (!$resume) {
            return redirect(route('user.resume.1'))->with('flash_message',
                'ابتدا باید این بخش از فرم، تکمیل گردد');
        }

        return view('site.pages.user.resume.further_information', compact('resume'));
    }

    public function ajax_resume_work_exp_create(Request $request)
    {

    if(myFuncs::check_blacklist(Auth::user()->profile->national_code))
        {
            return \Response::json(['response' => 'متاسفانه شما امکان همکاری با گروه صنعتی گلرنگ را ندارید.'],403);

        }

//        dd($_POST);
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'start_date' => 'required',
            'end_date' => 'nullable',
            'last_post' => 'required|string|max:255',
            'cause_interruption' => 'nullable',
            'phone_number' => 'nullable|string|min:11|max:11',
            'important_tasks' => 'required|string|max:5000',
        ]);

        if($request['until_now'])
        {

        }
        else
        {
            if($request['start_date'] > $request['end_date'])
                return 0;
        }


        $work = new ResumeWorkExperience();
        $work->resume_id = User::find(Auth::user()->id)->resume->id;
        $work->title = $request['title'];
        $work->start_date = $request['start_date'];
        if (isset($request['end_date']) && $request['end_date'] != '')
            $work->end_date = $request['end_date'];
        else
            $work->end_date = null;
        $work->last_post = $request['last_post'];
        $work->cause_interruption = $request['cause_interruption'];
        $work->phone_number = $request['phone_number'];
        $work->important_tasks = $request['important_tasks'];
        $work->province_id = $request['province_id'];
        if ($work->save())
            return $work->id;
        else
            return 0;
    }

    public function ajax_resume_work_exp_update(Request $request)
    {
        $this->validate($request, [
            'job_id' => 'required|exists:resume_work_experiences,id',
            'title' => 'required|string|max:255',
            'start_date' => 'required',
            'end_date' => 'nullable',
            'last_post' => 'required|string|max:255',
           // 'cause_interruption' => 'required|string|max:255',
            'phone_number' => 'nullable|string|min:11|max:11',
            'important_tasks' => 'required|string|max:5000',
        ]);
//        dd($_POST);
        $work = ResumeWorkExperience::find($request['job_id']);
        $work->resume_id = User::find(Auth::user()->id)->resume->id;
        $work->title = $request['title'];
        $work->start_date = $request['start_date'];
        if (isset($request['end_date']) && $request['end_date'] != '')
            $work->end_date = $request['end_date'];
        else
            $work->end_date = null;
        $work->last_post = $request['last_post'];
        $work->cause_interruption = $request['cause_interruption'];
        $work->phone_number = $request['phone_number'];
        $work->important_tasks = $request['important_tasks'];

        if ($work->save())
            return $work->id;
        else
            return 0;
    }

    public function ajax_resume_work_exp_delete(Request $request)
    {

        $this->validate($request, [
                'id' => 'required|exists:resume_work_experiences,id'
            ]
        );
        ResumeWorkExperience::find($request['id'])->delete();
        return 1;
    }

    public function ajax_get_education_field_name_by_id(Request $request){
        // M.Mahdavi Kia
        $id = $request['id'];
        $education_selected_record = DB::table('educations')->where('id','=',$id)->get()->last();
        return $education_selected_record->RelationCode_Name;
    }

    public function ajax_resume_education_create(Request $request)
    {

        if(myFuncs::check_blacklist(Auth::user()->profile->national_code))
        {
            return \Response::json(['response' => 'متاسفانه شما امکان همکاری با گروه صنعتی گلرنگ را ندارید.'],403);

        }

        $this->validate($request, [
            'grade' => 'required|int|between:1,6',
            'start_date' => 'required_unless:grade,1',
            'end_date' => 'nullable',
            'field_type' => 'nullable|string|max:255',
            'api_education_field_type_id' => 'nullable',
            'field' => 'required|string|max:255',
            'api_education_field_id' => 'nullable',
            'orientation' => 'nullable|string|max:255',
            'api_education_orientation_id' => 'nullable',
            'institute' => 'required|string|max:255',
            'api_institute_place_id' => 'nullable',
            //'institute_type' => 'required_unless:grade,1',
            'institute_type' => 'required|int|between:1,15',
            'course_type' => 'required|int|between:1,4',
            'city' => 'required|string|max:255',
            'average' => 'required|string|max:255',
        ]);

        $edu = new ResumeEducationalDetails();
        $edu->resume_id = User::find(Auth::user()->id)->resume->id;
        $edu->grade = $request['grade'];
        $edu->field_type = $request['field_type'];
        $edu->api_education_field_type_id = $request['field_type_id'];
        $edu->field = $request['field'];
        $edu->api_education_field_id = $request['field_id'];
        $edu->orientation = $request['orientation'];
        $edu->api_education_orientation_id = $request['orientation_id'];
        $edu->institute = $request['institute'];
        $edu->api_institute_place_id = $request['institute_id'];
        $edu->institute_type = $request['institute_type'];
        $edu->course_type = $request['course_type'];
        $edu->city = $request['city'];
        $edu->average = $request['average'];
        $edu->start_date = $edu->grade == 1 ? null : $request['start_date'];
        $edu->end_date = $request['end_date'];

        if ($edu->save())
            return $edu->id;
        else
            return 0;
    }

    public function ajax_resume_education_edit(Request $request)
    {


    	$this->validate($request, [
            'education_id' => 'required|exists:resume_educational_details,id',
	        'grade' => 'required|int|between:1,6',
	        'start_date' => 'required_unless:grade,1',
	        'end_date' => 'nullable',
	        'field_type' => 'nullable|string|max:255',
	        'api_education_field_type_id' => 'nullable',
	        'field' => 'required|string|max:255',
	        'api_education_field_id' => 'nullable',
	        'orientation' => 'nullable|string|max:255',
	        'api_education_orientation_id' => 'nullable',
	        'institute' => 'required|string|max:255',
	        'api_institute_place_id' => 'nullable',
	        //'institute_type' => 'required_unless:grade,1',
		    'institute_type' => 'required|int|between:1,15',
	        'course_type' => 'required|int|between:1,4',
	        'city' => 'required|string|max:255',
	        'average' => 'required|string|max:255',
        ]);

        $edu = ResumeEducationalDetails::findOrFail($request['education_id']);
        /*
         * M.Mahdavi Kia
         * Find 'field' id from table 'educations':
         *          id =  SAVE THIS ID REPLACE IN $edu->field
         *          RelationCode_Name
         *          RelationCode_Code
         */
        //$education_selected_record = DB::table('educations_gerayesh')->where('RelationCode_Name','=',$request['field'])->get()->last();
        //$education_id = $education_selected_record->id;

	    $edu->grade = $request['grade'];
	    $edu->field_type = $request['field_type'];
	    $edu->api_education_field_type_id = $request['field_type_id'];
	    $edu->field = $request['field'];
	    $edu->api_education_field_id = $request['field_id'];
	    $edu->orientation = $request['orientation'];
	    $edu->api_education_orientation_id = $request['orientation_id'];
	    $edu->institute = $request['institute'];
	    $edu->api_institute_place_id = $request['institute_id'];
	    $edu->institute_type = $request['institute_type'];
	    $edu->course_type = $request['course_type'];
	    $edu->city = $request['city'];
	    $edu->average = $request['average'];
	    $edu->start_date = $edu->grade == 1 ? null : $request['start_date'];
	    $edu->end_date = $request['end_date'];

        if ($edu->save())
            return $edu->id;
        else
            return 0;
    }

    public function ajax_resume_education_delete(Request $request)
    {
        $this->validate($request, [
                'id' => 'required|exists:resume_educational_details,id'
            ]
        );
        ResumeEducationalDetails::find($request['id'])->delete();
        return 1;
    }

    public function one_time($access_token)
    {
        $resume = null;
        $resume = Resume::where('access_token', $access_token)->get()->last();
        if ($resume) {
            $resume->access_token = null;
            $resume->save();
        } else {
            abort(404);
        }

        return view('site.resume.pdf', compact(['resume']));
    }

    public function final_step()
    {
	    $resume = null;
        if (Auth::user()->complete_percent != 31):
            return redirect(
                route('user.resume.' . (string)myFuncs::percent_status(Auth::user()->complete_percent))
            );
        endif;
	    return view('site.pages.user.resume.final_step', compact('resume'));

    }


}
