<?php

namespace HR\Http\Controllers;

use HR\City;
use HR\myDate;
use HR\myFuncs;
use HR\newsletter_mails;
use HR\Province;
use HR\User;
use HR\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Imagine\Image\Profile;
use HR\UserResumeList;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Mail;


class SiteUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isMobileVerified');
    }

    public function get_cv($id)
    {/*
        if($id == 108738)
        {
                    header("Content-type:application/pdf");

                    $resume_name = DB::table('user_resume_lists')->where('user_id',$id)->orderBy('id', 'desc')->first()->file_name;
            echo Storage::disk('resume')->get('cv/'.myFuncs::spilit_string($id).'/'.$resume_name);

        }*/
        header("Content-type:application/pdf");
        $resume_name_sql = DB::table('user_resume_lists')->where('user_id',$id)->orderBy('id', 'desc');
        $count_resume_name_sql = $resume_name_sql->count();
        if($count_resume_name_sql > 0)
        $resume_name = $resume_name_sql->first()->file_name;
        
        if($count_resume_name_sql > 1)
        {
           if(Storage::disk('resume')->exists('cv/'.myFuncs::spilit_string($id).'/'.$resume_name))
                echo Storage::disk('resume')->get('cv/'.myFuncs::spilit_string($id).'/'.$resume_name);
            else
                abort(404); 
        }
        else if($count_resume_name_sql == 1)
        {
            if(Storage::disk('resume')->exists('cv/'.myFuncs::spilit_string($id).'/resume.pdf'))
                echo Storage::disk('resume')->get('cv/'.myFuncs::spilit_string($id).'/resume.pdf');
            else
                abort(404);
        }
    }

    public function profile(Request $request,$first_time=null)
    {
        if (!Auth::check())
            return redirect('login');


        $user = User::find(Auth::user()->id);

        if ($user->profile()->count()) {
            $profile = UserProfile::find($user->profile->id);
        }
        else
            $profile = null;


        $cities = $users_ids = DB::select(
            "
            SELECT `cities`.`id`, CONCAT(`provinces`.`name`, ' - ', `cities`.`name`) as name
            FROM `provinces` LEFT JOIN `cities` ON provinces.id = cities.province_id
            where 1
             "
        );
        $current_year = intval(myDate::createFromCarbon(Carbon::now())->format('Y'));

        $khedmat = DB::table('khedmatmap')->get();
        $khedmat_moaf = DB::table('khedmatmoafmap')->orderBy('master_id', 'ASC')->get();
        $genders = config('gng_config.gng.gender');
        /*if(Auth::user()->id == 108738)
        die(json_encode($genders));*/
        
       
        return view('site.pages.user.profile', compact(['profile','cities', 'current_year','first_time','khedmat','khedmat_moaf','genders']));
    }

    public function profileUpdate(Request $request)
    {
        $genders = config('gng_config.gng.gender');


        if(myFuncs::check_blacklist(Auth::user()->profile->national_code))
        {
            return redirect()->back()->withErrors([' متاسفانه شما امکان همکاری با گروه صنعتی گلرنگ را ندارید']);
        }
        foreach ($request->all() as $key=>$value)
            $request[$key] = myFuncs::nums_to_en($request[$key]);

        $request['home_phone'] = $request['home_phone']['code'].$request['home_phone']['ext'];

        $user = User::find(Auth::user()->id);
        $request['born_date'] = $request['born_year'].'/'.$request['born_month'].'/'.str_pad($request['born_day'], 2, '0', STR_PAD_LEFT);
        $this->validate($request, [
            'first_name' => 'required|regex:/[آ-ی]/|max:255',
            'last_name' => 'required|regex:/[آ-ی]/|max:255',
            'english_first_name' => 'required|regex:/(^([a-zA-Z\s]+)(\d+)?$)/u|max:255|string',
            'english_last_name' => 'required|regex:/(^([a-zA-Z\s]+)(\d+)?$)/u|max:255|string',
            'born_date' => 'persian_date:Y/m/d',
            'national_id' => 'required|regex:/^[0-9]/|min:10|max:10',
            'gender' => 'required|integer|between:1,2',
            'pc' => 'required|exists:cities,id',
            'marriage_status' => 'required|integer',
            'address_area' => 'nullable|string|max:255',
            'home_phone' => 'required|regex:/(0)[0-9]{6,11}/|max:11',
            'email' => 'nullable|email|'
            ]);

       if(!empty($request['email']))
        {
            $users = User::where('id','<>',Auth::user()->id)->where('email',$request['email'])->count();
           // die(json_encode($users));
            if($users)
                return redirect()->back()->withErrors(['ایمیل وارد شده تکراری است']);
        }


        
      /*  else{

            if(Storage::disk('resume')->exists('cv/'.myFuncs::spilit_string(Auth::user()->id).'/resume.pdf'))
                Storage::disk('resume')->delete('cv/'.myFuncs::spilit_string(Auth::user()->id).'/resume.pdf');

        }*/

         $user->first_name = $request['first_name'];
        $user->english_first_name = $request['english_first_name'];

        $user->last_name = $request['last_name'];
        $user->english_last_name = $request['english_last_name'];

        if ($request['email'] != $user->email) {
            $user->email = $request['email'];
            $user->user_email = $request['email'];
            $user->is_email_verified = myFuncs::quickRandom(30);
        }

        $user->save();

        if ($user->profile()->count()) {
            $profile = UserProfile::find($user->profile->id);
        } else {
            $profile = new UserProfile();
        }
        $profile->user_id = Auth::user()->id;
        $profile->national_code = $request['national_id'];
        $profile->gender = $request['gender'];
        $profile->born_date = $request['born_date'];
        $profile->marital_status = $request['marriage_status'];

        if(!empty($request['national_id']))
        {
            $users = UserProfile::where('user_id','<>',Auth::user()->id)->where('national_code',$request['national_id'])->count();
            if($users)
                return redirect()->back()->withErrors(['کد ملی وارد شده تکراری است']);
        }


        /* if($request['marriage_status'] == 2):
             $profile->marriage_date = $request['marriage_year'].'/'.$request['marriage_month'].'/'.str_pad($request['marriage_day'], 2, '0', STR_PAD_LEFT);
         else:
             $profile->marriage_date = null;
         endif;*/

        if($request['military_status'] == 2):
            $profile->khedmat_mashmool = $request['nezamvazifemashmool_select'];
        else:
            $profile->khedmat_mashmool = null;
        endif;

        if($request['gender'] != 1):
            $profile->military_status = null;
            $profile->reason_exemption = null;
            $profile->military_end_date =null;
	        $profile->khedmat_mashmool =null;
        endif;

        $profile->province_id = City::find($request['pc'])->province->id;
        $profile->city_id = $request['pc'];
        $profile->neighborhood = $request['address_area'];
        $profile->home_phone = $request['home_phone'];

        if($request['gender'] == 1) {
            $this->validate($request, ['military_status' => 'required|integer']);
            $profile->military_status = $request['military_status'];
            switch ($request['military_status'])
            {
                case 1:
                    $request['military_date'] = $request['military_year'].'/'.$request['military_month']. '/01';
                    $this->validate($request, ['military_date' => 'required|persian_date:Y/m/d']);
                    $profile->military_end_date = $request['military_date'];
                    break;
                case 2:
                    $this->validate($request, ['military_free' => 'required|integer']);
                    $profile->reason_exemption = $request['military_free'];
                    break;
                case 3:
                    $request['military_date'] = $request['military_year'].'/'.$request['military_month']. '/01';
                    $this->validate($request, ['military_date' => 'required|persian_date:Y/m/d']);
                    $profile->military_end_date = $request['military_date'];
                    break;
                case 4:
                    $profile->khedmat_mashmool = $request['nezamvazifemashmool_select'];
                    break;
                default:
                    break;
            }

        }

        $profile->save();
        #newsletter member:
        if(
            isset($request['newsletter']) && $request['newsletter'] == '1'
            && !empty($request['email'])
            && !$profile->is_newsletter_member()
        )
            newsletter_mails::create(['email'=>$user->email]);

        if((!isset($request['newsletter']) || $request['newsletter'] != '1'
            || empty($request['email'])) && $profile->is_newsletter_member())
            newsletter_mails::where('email',$user->email)->delete();


        /*if(!$user->resume)*/
            return redirect(route('user.resume.1'))
                ->with('flash_message','جهت ادامه‌ کار باید رزومه‌ی خود را تکمیل کنید');

        /*return redirect()->back()->with('flash_message',
            'پروفایل شما با موفقیت آپدیت شد');*/
    }

    public function reset_password(Request $request){
        $this->validate($request,[
            'password'=>'required|min:6|confirmed',
        ]);

        Auth::user()->password = bcrypt(request('password'));
        Auth::user()->save();
        return redirect(route('site.user.profile'))->with('flash_message',
            'رمز عبور با موفقیت تغییر یافت');
    }

    public function get_all_favorite()
    {
        $jobs = Auth::user()->jobs;
        return view('site.pages.user.favorite_jobs',compact('jobs'));
    }

    public function send_verification_email(){
        $user = User::find(auth()->user()->id);

        if(is_null($user->is_email_verified))
            return redirect()->back()->with('flash_message', 'ایمیل شما قبلا تایید شده است.');

        $time = null;
        if(session('send_email_ts'))
            $time = session('send_email_ts');

        if($time)
        {
            if((time() - $time) < 60)
                return redirect()->back()->withErrors([ 'تا ارسال ایمیل بعدی باید '.(60 - time() + $time).' ثانیه صبر کنید.']);
        }

        $user->is_email_verified = myFuncs::quickRandom(30);
        $user->save();
        sleep(1);
        try{
            Mail::to($user->email)->send(new \HR\Mail\VerificationEmail($user));
            session(['send_email_ts' => time()]);
        }catch (\Exception $exception){
            return redirect()->back()->withErrors(['خطا در ارسال ایمیل، لطفا دقایقی دیگر مجددا تست فرمایید.']);
        }


        return redirect()->back()->with('flash_message',
            'ایمیل تایید برای شما ارسال گردید.');
    }
    public function profileUpdateLinkdin(Request $request)
    {
        $this->validate($request, [
            'cv'       => 'nullable|mimes:pdf|max:5000',
            'linkedin' => 'nullable|string|max:256'
            ]);
        $profile = Auth::user()->profile;
        
        if($request['cv'])
        {
            $path = Auth::user()->id;
            $path_folders = str_split((string)$path);
            $cv_path = 'cv';
            foreach ($path_folders as $folder) {
                if(!in_array($cv_path."/$folder",Storage::disk('resume')->directories($cv_path))) {
                    Storage::disk('resume')->makeDirectory($cv_path . "/$folder");
                }
                $cv_path.= "/$folder";
            }
            $date = time();
            if(Storage::disk('resume')->exists('cv/'.myFuncs::spilit_string(Auth::user()->id).'/resume.pdf'))
            {
                Storage::disk('resume')->putFileAs($cv_path, $request['cv'], 'resume'.$date.'.pdf');
                $file_name = 'resume'.$date.'.pdf';
            }
            else{

                Storage::disk('resume')->putFileAs($cv_path, $request['cv'], 'resume.pdf');
                $file_name = 'resume.pdf';
            }


            $resume_list = new UserResumeList();
            $resume_list->user_id    = Auth::user()->id;
            $resume_list->file_name  = $file_name;
            $resume_list->save();
        }
	    $profile->linkedin = $request['linkedin'];
	    $profile->save();
	    
	    return redirect()->route('user.resume.5.store');
    }
    
}
