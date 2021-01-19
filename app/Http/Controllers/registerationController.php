<?php

namespace HR\Http\Controllers;

use HR\MobileConfirm;
use HR\myFuncs;
use HR\SMS;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use HR\User;
use Illuminate\Http\Request;
use Carbon\Carbon;


class registerationController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only('confirm_mobile_get','confirm_mobile_post');
    }
    public function create()
    {
        if(Auth::check())
            return redirect('/');
            
        if(!is_null(request('job_id')) && !empty(request('job_id')))
        {
            if(!isset($_SESSION))
            {
                session_start();
            }
            $_SESSION['job_id']=request('job_id');
        }
            
            
        return view('site.pages.user.register');
    }
    /*public function store(Request $request)
    {

        $request['mobile'] = myFuncs::nums_to_en($request['mobile']);
        $request['register_captcha'] = myFuncs::nums_to_en($request['register_captcha']);
        $request['mobile'] = myFuncs::remove_input_mask($request['mobile']);


        $this->validate($request,[
            'first_name' => 'required|regex:/[آ-ی]/|max:255',
            'last_name' => 'required|regex:/[آ-ی]/|max:255',
            'email'=>'nullable|email',
            'mobile' => array(
                'required',
                'unique:users',
                'regex:/[0-9]{11}/u',
                'string','max:11'
            ),
            'password'=>'required|min:8|max:255|confirmed',
            'register_captcha' => 'check_captcha:register|string|max:10'
        ]);
        if(!empty($request['email']))
        {
            $users = User::where('email',$request['email'])->where('is_email_verified',null)->count();
            if($users)
	            return redirect()->back()
		            ->with('error_message',
			            'ایمیل وارد شده تکراری است');
        }

        $user = new User();
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->email = $request['email'];
        $user->mobile = $request['mobile'];
        $user->is_email_verified = myFuncs::quickRandom(30);
        $user->password = bcrypt($request['password']);
       /* if(!isset($_SESSION))
        {
            session_start();
        }
        $user->referrer_company_id = null;
        if(isset($_SESSION['referrer_company_id']))
            $user->referrer_company_id = $_SESSION['referrer_company_id'];
            
        if(session()->get('referrer_company_id'))
        $user->referrer_company_id = session()->get('referrer_company_id');

        $user->save();

        if($user->referrer_company_id)
            $user->owner()->attach($user->referrer_company_id);

        auth()->login($user);
        $sms = new SMS();
        $code = random_int(1000,9999);
        $mobileConfirm = new MobileConfirm();
        $mobileConfirm->user_id = $user->id;
        $mobileConfirm->token = $code;
        $mobileConfirm->save();
        $sms->Send('کد تایید شما در سامانه منابع انسانی گروه صنعتی گلرنگ '.$code.' می باشد.'."\n".'با سپاس.',Auth::user()->mobile,'0','register',$user->id);
        return redirect(route('register.confirm.mobile'));
    }*/
    
    public function store(Request $request)
    {

        $request['mobile'] = myFuncs::nums_to_en($request['mobile']);
        $request['register_captcha'] = myFuncs::nums_to_en($request['register_captcha']);
        $request['mobile'] = myFuncs::remove_input_mask($request['mobile']);
        $request_mobile    = myFuncs::remove_input_mask($request['mobile']);


        $this->validate($request,[
            /*'first_name' => 'required|regex:/[آ-ی]/|max:255',
            'last_name' => 'required|regex:/[آ-ی]/|max:255',
            'email'=>'nullable|email',*/
            'mobile' => array(
                'required',
               // 'unique:users',
                'regex:/[0-9]{11}/u',
                'string','max:11'
            ),
           // 'password'=>'required|min:8|max:255|confirmed',
            'register_captcha' => 'check_captcha:register|string|max:10'
        ]);
      /*  if(!empty($request['email']))
        {
            $users = User::where('email',$request['email'])->where('is_email_verified',null)->count();
            if($users)
	            return redirect()->back()
		            ->with('error_message',
			            'ایمیل وارد شده تکراری است');
        }*/
        $check_repeated_user = User::where('mobile',$request_mobile)->first();
        if($check_repeated_user->is_mobile_verified == 1)
            return redirect()->back()
                ->with('error_message',
                            'شماره موبایل وارد شده تکراری است');
		else if($check_repeated_user&&$check_repeated_user->is_mobile_verified == 0) 
		{
		   $user = User::find($check_repeated_user->id);
		   $user->mobile = $request['mobile'];
		   $user->mobile_confirm()->delete();

     	}
        else if(!$check_repeated_user)
        {
             $user = new User();
            $user->mobile = $request['mobile'];
        }
        
       
        
       
        $user->is_email_verified = myFuncs::quickRandom(30);
      
        $user->referrer_company_id = null;
        if(session()->get('referrer_company_id'))
            $user->referrer_company_id = session()->get('referrer_company_id');

        $user->save();

        if($user->referrer_company_id)
            $user->owner()->attach($user->referrer_company_id);

        auth()->login($user);
        $sms = new SMS();
        $code = random_int(1000,9999);
        $mobileConfirm = new MobileConfirm();
        $mobileConfirm->user_id = $user->id;
        $mobileConfirm->token = $code;
        $mobileConfirm->save();
        $phone_for_sms = $request['mobile'] ;

        $sms->Send('کد تایید شما در سامانه منابع انسانی گروه صنعتی گلرنگ '.$code.' می باشد.'."\n".'با سپاس.',$phone_for_sms,'0','register',$user->id);
        return redirect(route('register.confirm.mobile'));
    }
    public function confirm_mobile_get()
    {
        if(Auth::user()->is_mobile_verified)
            return redirect()->back();
        return view('site.pages.user.mobile_confirm');
    }
/*    public function confirm_mobile_post(Request $request)
    {
        
        if($request['resend']=='ارسال دوباره')
        {
            $user = User::find(Auth::user()->id);
            $sms = new SMS();
            $code = random_int(1000,9999);
            $user->mobile_confirm()->delete();
            $mobileConfirm = new MobileConfirm();
            $mobileConfirm->user_id = $user->id;
            $mobileConfirm->token = $code;
            $mobileConfirm->save();
            $sms->Send('کد تایید شما در سامانه منابع انسانی گروه صنعتی گلرنگ '.$code.' می باشد.'."\n".'با سپاس.',Auth::user()->mobile,'0','register',$user->id);
            return redirect(route('register.confirm.mobile'));
        }
        
        $request['code'] = myFuncs::nums_to_en($request['code']);
        


        $user = User::find(Auth::user()->id);
        
        if($request['code']== $user->mobile_confirm->token)
        {
            $user->mobile_confirm()->delete();
            $user->is_mobile_verified = 1;
            $user->save();

            return redirect()->route('site.user.profile',1)
                ->with('flash_message',
                    'شماره موبایل شما تایید شد');
        }else{
            return redirect()->back()
                ->with('flash_message',
                    'کد وارد شده صحیح نیست');
        }
    }
    public function change_mobile_in_confirm_mobile(Request $request)
    {
        #validate mobile
        $persian_digits = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
        $arabic_digits = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
        $request['mobile'] = str_replace($arabic_digits, $persian_digits, $request['mobile']);
    
        $persian_digits = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
        $english_digits = array('0','1','2','3','4','5','6','7','8','9');
        $request['mobile'] = str_replace($persian_digits, $english_digits, $request['mobile']);
        
        $this->validate($request,[
            'mobile' => array(
                'required',
                'unique:users',
                'regex:/[0-9]{11}/u',
                'string',
                'max:12'
            ),
            'change_mobile_captcha' =>'check_captcha:change_mobile_captcha|string|max:10'
        ]);
        $user = Auth::user();
        $user->mobile = $request['mobile'];
        $user->save();

        $sms = new SMS();
        $code = random_int(1000,9999);
        MobileConfirm::where('user_id',$user->id)->delete();
        $mobileConfirm = new MobileConfirm();
        $mobileConfirm->user_id = $user->id;
        $mobileConfirm->token = $code;
        $mobileConfirm->save();
        $sms->Send('کد تایید شما در سامانه منابع انسانی گروه صنعتی گلرنگ '.$code.' می باشد.'."\n".'.با سپاس',$user->mobile,'0','register',$user->id);
        return redirect(route('register.confirm.mobile'))->with('flash_message',
            'منتظر دریافت پیامک به شماره جدید باشید');
    }*/
    
        public function confirm_mobile_post(Request $request)
    {
        if($request['resend']=='ارسال دوباره')
        {

        $check_change_mobile = User::find(Auth::user()->id)->temp_mobile;
        if($check_change_mobile && $check_change_mobile != null)
        {
            $user = User::where('mobile',$check_change_mobile)->where('is_mobile_verified',0)->first();
            $mobile = $check_change_mobile;           
        }
        else
        {
            $user = User::find(Auth::user()->id);
            $mobile = $user->mobile;
        }

            if(($user->mobile_confirm || ($user->mobile_confirm && Carbon::now() > $user->mobile_confirm->created_at->addMinutes(2))) || !$user->mobile_confirm)
            {
               if($user->smses()->whereDate('created_at', \DB::raw('CURDATE()'))->count() >= 3 )
               {
                   $status = 3;
                   return $status;
               }
                    
                    else
                    {
                        $sms = new SMS();
                        $code = random_int(1000,9999);
                        $user->mobile_confirm()->delete();
                        /*$old_user_temp = User::where('temp_mobile',$check_change_mobile)->first();
                        $old_user_temp->mobile_confirm()->delete();*/

                      //  die('***'.$old_user->mobile_confirm());
                        $mobileConfirm = new MobileConfirm();
                        $mobileConfirm->user_id = $user->id;
                        $mobileConfirm->token = $code;
                        $mobileConfirm->save();
                        
                        $sms->Send('کد تایید شما در سامانه منابع انسانی گروه صنعتی گلرنگ '.$code.' می باشد.'."\n".'با سپاس.',$mobile,'0','register',$user->id);

                        
                        $status = 1;
                        return $status;
                    }
            }
            
            else
            {
                $status = 0;
                return $status;
            }
                
        }
        
        $request['code'] = myFuncs::nums_to_en($request['code']);
     /*   $user_temp = User::where('mobile',$request['mobile'])->where('is_mobile_verified',0)->first();


        if(count($user_temp)>0)
            $user = $user_temp;
        else
        {*/
        
            $user = User::where('mobile',$request['mobile'])->where('is_mobile_verified',0)->first();
            if(!empty($user->temp_mobile) || $user->temp_mobile != null)
            {
                $check_exist_notconfirmed_user = User::where('mobile',$user->temp_mobile)->where('is_mobile_verified',0)->first();
                if( $check_exist_notconfirmed_user)
                $user = $check_exist_notconfirmed_user; 
                
                
            }
        //}

     /*  var_dump($request['code']);
       var_dump($user);
  die(json_encode($user->mobile_confirm->token));*/
        if(($request['code']== $user->mobile_confirm->token) &&(Carbon::now() < $user->mobile_confirm->created_at->addMinutes(2)))
        {
         //  die('yes');
                if($check_exist_notconfirmed_user)
                {
                    $user->temp_mobile='';
                    $user = $check_exist_notconfirmed_user;
                    $olduser = User::find(Auth::user()->id);
                    $olduser->temp_mobile = '';
                    $olduser->save();
              //  die(json_encode($check_exist_notconfirmed_user));     
                             auth()->login($check_exist_notconfirmed_user);

                }
                    
            
            $user->mobile_confirm()->delete();
             if(count($olduser))
            $olduser->mobile_confirm()->delete();
            $user->password = bcrypt($request['user_password']);
            
            $request['mobile'] = myFuncs::nums_to_en($request['mobile']);
        $request['mobile'] = myFuncs::remove_input_mask($request['mobile']);


        $this->validate($request,[
            'first_name' => 'required|regex:/[آ-ی]/|max:255',
            'last_name' => 'required|regex:/[آ-ی]/|max:255',
            'user_password'=>'required|min:8|max:255|confirmed',
        ]);
       
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->password = bcrypt($request['user_password']);
      
        $user->referrer_company_id = null;
       
            
        if(session()->get('referrer_company_id'))
        $user->referrer_company_id = session()->get('referrer_company_id');

        $user->save();

        if($user->referrer_company_id)
            $user->owner()->attach($user->referrer_company_id);
        
            
            $user->is_mobile_verified = 1;
           
            $user->save();
            
            /*$delete_user = User::where('mobile' , Auth::user()->mobile)->where('is_mobile_verified' , 0)->first();
            $delete_user->deleted_at = date("Y-m-d H:i:s");
            $delete_user->save();*/

            

            return redirect()->route('site.user.profile',1)
                ->with('flash_message',
                    'شماره موبایل شما تایید شد');
        }else{
            return redirect()->back()
                ->with('flash_message',
                    'کد وارد شده صحیح نیست');
        }
    }
    public function change_mobile_in_confirm_mobile(Request $request)
    {
        #validate mobile
        $persian_digits = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
        $arabic_digits = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
        $request['mobile'] = str_replace($arabic_digits, $persian_digits, $request['mobile']);
    
        $persian_digits = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
        $english_digits = array('0','1','2','3','4','5','6','7','8','9');
        $request['mobile'] = str_replace($persian_digits, $english_digits, $request['mobile']);
        $request_mobile = str_replace($persian_digits, $english_digits, $request['mobile']);
        
        $this->validate($request,[
            'mobile' => array(
                'required',
               // 'unique:users',
                'regex:/[0-9]{11}/u',
                'string',
                'max:12'
            ),
            'change_mobile_captcha' =>'check_captcha:change_mobile_captcha|string|max:10'
        ]);
        if(User::where('mobile',$request_mobile)->where('is_mobile_verified',1)->count())
            return redirect()->back()
                ->withErrors([
                            'شماره موبایل وارد شده تکراری است']);
       else if(User::where('mobile',$request_mobile)->where('is_mobile_verified',0)->count())
       {
           $user = Auth::user();
           

           $user->temp_mobile = $request['mobile'];
           $user->save();
           $user = User::where('mobile',$request_mobile)->where('is_mobile_verified',0)->first();
       }
       else
       {
           #change mobile in users db
            $user = Auth::user();
            $user->mobile = $request['mobile'];
            $user->save();
       }

       if(User::find($user->id)->smses()->whereDate('created_at', \DB::raw('CURDATE()'))->count() >= 3)
        {
            return redirect()->back()
                ->with('flash_message', 'تعداد SMS های ارسالی برای شما در امروز به حد نصاب خود رسیده است، لطفا روز بعد مجددا جهت دریافت، تلاش فرمایید.');
        }
        $sms = new SMS();
        $code = random_int(1000,9999);
        MobileConfirm::where('user_id',$user->id)->delete();
        $mobileConfirm = new MobileConfirm();
        $mobileConfirm->user_id = $user->id;
        $mobileConfirm->token = $code;
        $mobileConfirm->save();

        $sms->Send('کد تایید شما در سامانه منابع انسانی گروه صنعتی گلرنگ '.$code.' می باشد.'."\n".'.با سپاس',$user->mobile,'0','register',$user->id);
        return redirect(route('register.confirm.mobile'))->with('flash_message',
            'منتظر دریافت پیامک به شماره جدید باشید');
       
    }

    public function forget_password()
    {
        return view ('site.pages.user.forget_password');
    }

    public function forget_password_post(Request $request)
    {
        $persian_digits = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
        $arabic_digits = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
        $request['mobile'] = str_replace($arabic_digits, $persian_digits, $request['mobile']);
    
        $persian_digits = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
        $english_digits = array('0','1','2','3','4','5','6','7','8','9');
        $request['mobile'] = str_replace($persian_digits, $english_digits, $request['mobile']);
        $this->validate($request,[
           'mobile' => 'exists:users,mobile|required',
            'forget_captcha' =>'check_captcha:forget|string|max:10'
        ]);
        if(!isset($_SESSION))
        {
            session_start();
        }
        if(strtolower($request['forget_captcha']) != strtolower($_SESSION['forget'])){
            return redirect()->back()->with('flash_message',
                'کد امنیتی اشتباه است');
        }

        $user = User::where('mobile',$request['mobile'])->first();
        if(!$user)
            return redirect()->back()->with('flash_message',
                'کاربر با این شماره موبایل در سیستم وجود ندارد');
        $sms = new SMS();
        $code = random_int(1000,9999);
        MobileConfirm::where('user_id',$user->id)->delete();
        $mobileConfirm = new MobileConfirm();
        $mobileConfirm->user_id = $user->id;
        $mobileConfirm->token = $code;
        $mobileConfirm->save();
        $sms->Send('کد تایید شما در سامانه منابع انسانی گروه صنعتی گلرنگ '.$code.' می باشد.'."\n".'.با سپاس',$user->mobile,'0','forget',$user->id);
        return redirect(route('user.forget.confirm.mobile',$request['mobile']));
    }
    public function forget_password_verify_mobile($mobile)
    {
        $user= User::where('mobile',$mobile)->first();
        return view('site.pages.user.mobile_confirm_forget',compact(['user','mobile']));
    }
    public function forget_password_verify_mobile_post(Request $request,$mobile)
    {

        if($request['resend']=='ارسال دوباره')
        {
            $user = User::where('mobile',$mobile)->first();
            $sms = new SMS();
            $code = random_int(1000,9999);
            $user->mobile_confirm()->delete();
            $mobileConfirm = new MobileConfirm();
            $mobileConfirm->user_id = $user->id;
            $mobileConfirm->token = $code;
            $mobileConfirm->save();
            $sms->Send('کد تایید شما در سامانه منابع انسانی گروه صنعتی گلرنگ '.$code.' می باشد.'."\n".'با سپاس.',$user->mobile,'0','register',$user->id);
            return redirect(route('user.forget.confirm.mobile',$mobile));
        }
    
        $persian_digits = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
        $arabic_digits = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
        $request['code'] = str_replace($arabic_digits, $persian_digits, $request['code']);
    
        $persian_digits = array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
        $english_digits = array('0','1','2','3','4','5','6','7','8','9');
        $request['code'] = str_replace($persian_digits, $english_digits, $request['code']);
        

        $user = User::where('mobile',$mobile)->first();
        if($request['code'] == $user->mobile_confirm->token)
        {
            MobileConfirm::where('user_id',$user->id)->delete();
            auth()->login($user);
            return redirect()->route('site.user.profile.reset.password')
                ->with('flash_message',
                    'شماره موبایل شما تایید شد');
        }else{
            return redirect()->back()
                ->with('flash_message',
                    'کد وارد شده صحیح نیست');
        }
    }

    public function confirm_email($key){

        $user_id = DB::table('users')->where(DB::raw('LOWER(`is_email_verified`)'),$key)->first()->id;

        if(!$user_id)
            return redirect(route('site.user.profile'))->withErrors(['خطا در اطلاعات دریافتی']);

        $user = User::find($user_id);
        $user->is_email_verified = null;
        $user->save();

        return redirect(route('site.user.profile'))->with('flash_message',
            'ایمیل شما با موفقیت تایید شد.');

    }

}
