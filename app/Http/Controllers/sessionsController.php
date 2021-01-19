<?php

namespace HR\Http\Controllers;

use HR\LoginDetail;
use HR\MobileConfirm;
use HR\myFuncs;
use HR\SMS;
use HR\User;
use HR\UserProfile;
use HR\Job;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class sessionsController extends Controller
{
    public function create()
    {
        if(Auth::check())
            return redirect()->intended('/');
            
        if(!is_null(request('job_id')) && !empty(request('job_id')))
        {
            if(!isset($_SESSION))
            {
                session_start();
            }
            $_SESSION['job_id']=request('job_id');
        }
            
        return view('site.pages.user.login');
    }

    /*public function store(Request $request)
    {

        $request['mobile'] = myFuncs::nums_to_en($request['mobile']);
       
        $this->validate($request, [
            'mobile' => array(
                'required',
                'regex:/[0-9]{11}/u'),
            'captcha' =>'check_captcha:login|required|string|max:10',
            'password' => 'required|string|max:255',
            'remember' => 'nullable|integer'
        ]);
    
        
        $remember = (isset($request['remember']))?1:0;

        if (!auth()->attempt(request(['mobile','password']),$remember))
        {
            return redirect()->back()->with('flash_message',
                'نام کاربری یا رمز عبور اشتباه است');
        }
        else {
            $user = User::find(Auth::user()->id);
            $user->last_login = Carbon::now()->timezone('Asia/Tehran')->toDateTimeString();
            $user->save();
         
            if(!isset($_SESSION))
            {
                session_start();
            }
           
            if(isset($_SESSION['job_id']) && !is_null($_SESSION['job_id']))
            {
                $job = Job::find($_SESSION['job_id']);
                if($job)
                    return redirect('/company-jobs/'.$job->alias);
            }
         
            return redirect()->intended(route('site.user.profile'));
        }
    }*/
    
    public function store(Request $request)
    {

        $request['mobile'] = myFuncs::nums_to_en($request['mobile']);

        $this->validate($request, [
            'mobile' => array(
                'required',
                'regex:/[0-9]{11}/u'),
            'captcha' =>'check_captcha:login|required|string|max:10',
            'password' => 'required|string|max:255',
            'remember' => 'nullable|integer'
        ]);
    
        
        $remember = (isset($request['remember']))?1:0;

        if (!auth()->attempt(request(['mobile','password']),$remember))
        {
            return redirect()->back()->with('flash_message',
                'نام کاربری یا رمز عبور اشتباه است');
        }
        else {
            
             if(isset($request['admin_national_code'])) {
                 if(!empty($request['national_code']))
                 {
                        $check_not_exist_national_code =  UserProfile::where('user_id','!=', Auth::user()->id)->where('national_code', $request['national_code'])->count();
                        if($check_not_exist_national_code <1)
                        {
                            $check_national_code = UserProfile::where('user_id', Auth::user()->id)->count();
                            if($check_national_code < 1)
                            {
                                $profile = new UserProfile();
                                $profile->user_id =  Auth::user()->id;
                                $profile->national_code = $request['national_code'];
                                $profile->save();
                                
                                
            
                            } 
                        }
                    else{
                         //logout 
                        auth()->logout();
                        return redirect()->back()->with('flash_message',
                    
                    'کد ملی وارد شده تکراری است.');
                         
                     }
                        
                 }
                 else{
                     //logout 
                     auth()->logout();
                     return redirect()->back()->with('flash_message',
                
                'در صورت درخواست ادمین شدن پر کردن فیلد کد ملی الزامی است.');
                     
                 }
             
                
            }
            
            $user = User::find(Auth::user()->id);
            $user->last_login = Carbon::now()->timezone('Asia/Tehran')->toDateTimeString();
            $user->save();
            
            

            if(!isset($_SESSION))
            {
                session_start();
            }

            if(isset($_SESSION['job_id']) && !is_null($_SESSION['job_id']))
            {
                $job = Job::find($_SESSION['job_id']);
                if($job)
                    return redirect('/company-jobs/'.$job->persian_alias);
            }

            return redirect()->intended(route('site.user.profile'));
        }
    }

    public function destroy()
    {
        auth()->logout();
        if(!isset($_SESSION))
        {
            session_start();
        }
        $_SESSION['admin_login']='';
        return redirect()->back();
    }

    public function store_modal(Request $request)
    {
        foreach ($request->all() as $key=>$value)
            $request[$key] = myFuncs::nums_to_en($request[$key]);
        if(!isset($_SESSION))
            session_start();
        if(strtolower(request('login_captcha')) != strtolower($_SESSION['login_modal'])){
            return 'لطفا کد امنیتی را بدرستی وارد کنید';
        }


        if(!preg_match('/[0-9]{11}/u',
            request('mobile')))
        {
            return 'فرمت شماره موبایل صحیح نیست';
        }
        $remember = (isset($request['remember']))?1:0;

        if (!auth()->attempt(request(['mobile','password']),$remember))
        {
            if(request('checkboxes'))
                if (request('checkboxes') == 1)
                    auth()->login(Auth::user(),1);
            return 'نام کاربری یا رمز عبور اشتباه است';
        }
        else {
            return 'ok';
        }
    }

    public function loginAs($id)
    {
        $log = new LoginDetail();
        $log->user_id = $id;
        $log->date = Carbon::now()->toDateTimeString();
        $log->ip = request()->ip();
        $log->login_user_id = Auth::user()->id;
        $log->action = 'login';
        $log->save();

        if(!isset($_SESSION))
        {
            session_start();
        }
        $_SESSION['admin_login'] = Auth::user()->id;

        $user = User::find($id);
        #logout admin
        auth()->logout();
        #login user
        auth()->login($user);
        #set session


        return redirect(route('site.user.profile'));
    }

    public function returnToAdmin()
    {
        $log = new LoginDetail();
        $log->user_id = Auth::user()->id;
        $log->date = Carbon::now()->toDateTimeString();
        $log->ip = request()->ip();

        auth()->logout();
        if(!isset($_SESSION))
        {
            session_start();
        }
        $user = User::find($_SESSION['admin_login']);
        $_SESSION['admin_login']='';
        auth()->login($user);
        $log->login_user_id = Auth::user()->id;
        $log->action = 'logout';
        $log->save();
        return redirect(route('users.index'));
    }

    public function resend_sms($id)
    {
        $user = User::find($id);
        $sms = new SMS();
        $code = random_int(1060,9999);
        $user->mobile_confirm()->delete();
        $mobileConfirm = new MobileConfirm();
        $mobileConfirm->user_id = $user->id;
        $mobileConfirm->token = $code;
        $mobileConfirm->save();
        $sms->Send('کد تایید شما در سامانه منابع انسانی گروه صنعتی گلرنگ '.$code.' می باشد.'."\n".'با سپاس.',$user->mobile,'0','register',$user->id);
        return redirect()->back()->with('flash_message','کد '.$code.' پیام با موفقیت ارسال شد.');
    }

}
