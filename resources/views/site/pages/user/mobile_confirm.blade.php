@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Golrang Human Resource">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('custom_css')


    {{--@if($errors)
        {{dd($errors)}}
    @endif--}}
    {{ Html::style('/site/'.config('app.site_theme').'/css/dmuploader.css') }}
    

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }
    </style>

@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: تایید شماره موبایل
@endsection

@section('content')
    <div class="cd-main-content cd-inner-content container">
        <div class="col-xs-12 wrapper-breadcrumb">
            <div class="p-breadcrumbs">
                <ul class="page-breadcrumbs">
                    <li>
                        <a href="{{route('home')}}"> اصلی</a>
                    </li>
                    <li> <i class="fa fa-angle-left"></i> </li>
                    <li class="c-state_active">
                        فراموشی رمز عبور
                    </li>
                </ul>
            </div>
        </div>

    <fieldset class="red-fieldset mt-4 mb-4">
        <legend> تایید شماره موبایل </legend>
    </fieldset>

        <div class="clearfix container inner-content">
            <div class="col-xs-12 wrap-content">
                @if (count($errors) > 0)
                    <div class="bg-error" style="text-align: right">
                        <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                        @foreach ($errors->all() as $error)
                            <p style="direction: rtl" >{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                @if(Session::has('flash_message'))
                    <div class="bg-error" style="text-align: right">
                        <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                        <p style="direction: rtl" >{!! session('flash_message') !!}</p>
                    </div>
                @endif
                <div class="col-md-5 col-xs-12 m-auto left-jobs no-padd-xs no-padd c">
                    <div class="col-md-12" align="center">
                        <form action="{{route('register.confirm.mobile.post')}}" method="POST">
                            {{csrf_field()}}
                               <div class="col-md-12">


                            <div class="people-forms-fields-group">
                                <input class="form-control input-lg text-center people-forms-fields p-2 input__field input__field--minoru"
                                disabled name="mobile" type="text" maxlength="4" id="mobile"
                                value="@if(Auth::user()->temp_mobile){{Auth::user()->temp_mobile}}@else{{Auth::user()->mobile}}@endif" />
                                <label class="pr-4">شماره موبایل</label>

                            </div>
                            </div>
                            
   <div class="col-md-12">


                            <div class="people-forms-fields-group">
                                <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
 
                                <input autocomplete="off" data-validation="required"  oninvalid="$('#code-help').html('لطفا کد را وارد کنید');this.setCustomValidity(' ')"
                                               oninput="setCustomValidity('')"
                                required class="form-control input-lg people-forms-fields input__field  text-center" name="code" type="text" maxlength="4" id="input-13" placeholder="xxxx" />
                                <label class="pr-4">کد ارسالی</label>
                                <p class="help-block" id="code-help"></p>

                            </div>
                            <div id="timer_container">مدت زمان اعتبار کد ارسالی :<span id="timer"></span></div>
</div>                            
                          
   <div class="col-md-12">
                                    <div class="people-forms-fields-group">
                                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                        <input
                                        class="input__field input__field--minoru justpersian people-forms-fields form-control"
                                        name="first_name"
                                        type="text"
                                        id="frist_name"
                                        required
                                        oninvalid="$('#first_name_help').html('لطفا نام خود را وارد کنید.');this.setCustomValidity(' ')"
                                        onkeyup="$('#first_name_help').html('')"
                                        maxlength="255" autocomplete="off"
                                        />
                                        <label>نام</label>
                                    </div>
                                    <p id="first_name_help" class="help-block"></p>
                                    @if($errors->has('first_name'))
                                        <p class="help-block">{{$errors->first('first_name')}}</p>
                                    @endif            
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="people-forms-fields-group">
                                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                        <input
                                                class="input__field input__field--minoru justpersian people-forms-fields form-control"
                                                name="last_name"
                                                type="text"
                                                id="last_name"
                                                required
                                                oninvalid="$('#last_name_help').html('لطفا نام خانوادگی خود را وارد کنید.');this.setCustomValidity(' ')"
                                                oninput="setCustomValidity('')"
                                                onkeyup="$('#last_name_help').html('')"
                                                maxlength="255"
                                                autocomplete="off"
                                        />
                                        <label>نام خانوادگی</label>                                        
                                         <p id="last_name_help" class="help-block"></p>
                                        @if($errors->has('last_name'))
                                            <p class="help-block">{{$errors->first('last_name')}}</p>
                                        @endif                
                                    </div>
                                </div>
                                    

                               
   <div class="col-md-12">

                                <div class="people-forms-fields-group">
                                    <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                    
                                      <div style="position:relative !important;left:20px;top:30px;float:left;z-index:9999">
                                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password fa-sm"></span>

                                    
                                    </div>
                                    <input data-validation="required" class="people-forms-fields  input__field input__field--minoru form-control" type="password" name="user_password" id="user_password"
                                     required
                                               oninvalid="$('#user_password-help').html('لطفا رمز عبور را وارد کنید');this.setCustomValidity(' ')"
                                               oninput="setCustomValidity('')"
                                               onkeyup="$('#user_password-help').html('')"
                                               maxlength="255"        autocomplete="new-password"
                                    />
                                    <label>رمز عبور را وارد کنید</label>
                                    <span id="user_password-help" class="help-block"></span>
                                    <p class="help-block" id="help_password_length"></p>


                                </div>
                                </div>
                               <div class="col-md-12">

                                <div class="people-forms-fields-group">
                                    <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                    
                                      <div style="position:relative !important;left:20px;top:30px;float:left;z-index:9999">
                                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password fa-sm"></span>

                                    
                                    </div>
                                    <input  data-validation="required" class="people-forms-fields input__field input__field--minoru form-control password_confirmation_check" type="password" name="user_password_confirmation" id="user_password_confirmation"
                                    required
                                               oninvalid="$('#password_confirmation-help').html('لطفا یکبار دیگر رمز عبور را وارد کنید');this.setCustomValidity(' ')"
                                               oninput="setCustomValidity('')"
                                               onkeyup="$('#password_confirmation-help').html('')"
                                               maxlength="255"
                                    />
                                    <label> تکرار رمزعبور را  وارد کنید</label>
                                <span id="password_confirmation-help" class="help-block"></span>
                               <p class="help-block" id="help_password_confirmation_same"></p>
                            </div>  
                            </div>  



                        <div class="mt-3 ">
                            <input type="hidden" name="mobile" value="{{Auth::user()->mobile}}">
                            <input type="submit" name="login" class="request-jobs text-light col-7 m-auto " value="تایید">
                            <div class="mt-3">
                                <input type="button" name="resend" id="resend" class="request-jobs text-light" value="ارسال دوباره">
                                <a href="#" title="" class="request-jobs text-light">
                                    <span> تغییر شماره موبایل </span>
                                </a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--
        change mobile modal
    --}}
            <div class="loginmodal-container col-10 col-md-5 m-auto">
                
                    <fieldset class="red-fieldset mt-4 mb-4">
                        <legend>تغییر شماره موبایل </legend>
                    </fieldset>


                            <div class="people-forms-fields-group col-md-7 m-auto">
                                <input type="text" value=" شماره قبلی: {{Auth::user()->mobile}}" disabled style="text-align: center!important;" class="form-control form-control input-lg people-forms-fields p-2">
                                <label class="pr-4">شماره قبلی</label>
                            </div>

                
                
                <form action="{{route('register.confirm.mobile.change.mobile.post')}}" method="POST">
                    {{csrf_field()}}
                    
                            <div class="people-forms-fields-group col-md-7 m-auto">
                                <input type="text" name="mobile"  placeholder="09xxxxxxxxx" class="form-control form-control input-lg people-forms-fields p-2 text-left">
                                <label class="pr-4">شماره موبایل جدید</label>
                            </div>
                            
                            <div class="people-forms-fields-group col-md-7 m-auto">
                                <input type="text" name="change_mobile_captcha" placeholder="متن تصویر امنیتی را تایپ کنید" class="form-control form-control input-lg people-forms-fields p-2">
                            </div>

                            <div class="col-md-7 m-auto">
                                <div class="row">
                                    <div class="captcha col-md-8" align="middle">
                                        <img id="change_mobile_captcha" src="{{route('site.captcha','change_mobile_captcha')}}?ver=<?= time()?>">                                
                                    </div>
                                    <img id="refresh_change_mobile_captcha" src="/site/default/img/refresh.png" onclick="$('#change_mobile_captcha').attr('src', '{{route('site.captcha','change_mobile_captcha')}}?ver='+(new Date()).getTime());" style="cursor: pointer" class="">
                                </div>
                            </div>
                            
                            <div class="col-md-7 text-center m-auto">
                            <input type="submit" name="change" class="request-jobs w-100 text-light"  value="ثبت">
                            </div>
                </form>
            </div>

@endsection

@section('script')
    {{ Html::style('/site/'.config('app.site_theme').'/css/alertify.core.css') }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/alertify.default.css') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/jquery.easing.min.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/alertify.min.js') }}
    <script>
        $(document).ready(function(){
            $(".close-error").click(function(){
                $(".bg-error").hide();
                return false;
            });

        });
           $(document).ready(function () {
            $(".close-error").click(function () {
                $(".bg-error").hide();
                return false;
            });
            $(".close-success").click(function () {
                $(".bg-success").hide();
                return false;
            });
            // $('#mobile').inputmask("(0999) 999-9999");
        });
          
         //just Persian
        $(".justpersian").bind('input propertychange', function () {
            if (!/^[پچجحخهعغفقثصضشسیبلاتنمکگوئ دذرزطظژؤإأءًٌٍَُِّ]+$/.test($(this).val()) && $(this).val() != '') {
                alertify.alert("فقط حروف فارسی مورد قبول است");
                $(this).click();
                $(this).val($(this).val().substr(0, $(this).val().length - 1));
            }
        });
        
               //check password lenght
        $(".password").bind('input propertychange', function () {
            if ($(this).val().length < 8) {
                $('#help_password_length').html('رمز عبور حداقل باید 8 کاراکتر باشد');
                is_validated_password_lenght = false;
            }
            else {
                $('#help_password_length').html('');
                is_validated_password_lenght = true;
            }
        });

        //check passwords are same
           $(".password_confirmation_check").bind('input propertychange', function () {
            if ($("#user_password_confirmation").val() !== $("#user_password").val()) {
                $('#help_password_confirmation_same').html('رمز عبور و تکرار آن مطابقت ندارند');
                is_form_validated = false;
                return false;
            }
            else {
                $('#help_password_confirmation_same').html('');
                is_form_validated = true;
            }
        });
        
         function form_check() {
            validity = true;
   

            if ($('#user_password').val() === '') {
                $('#user_password-help').text('فیلد اجباری');
                validity = false;
            }
            
            if ($('#user_password_confirmation').val() === '') {
                $('#password_confirmation-help').text('فیلد اجباری');
                validity = false;
            }
            if ($('#input-13').val() === '') {
                $('#code-help').text('فیلد اجباری');
                validity = false;
            }
            if (validity == false || is_form_validated==false|| is_validated_password_lenght==false){
                return false;
                
            }
            else
            return true;

            


        }
        
        let timerOn = true;

        function timer(remaining) {
          var m = Math.floor(remaining / 60);
          var s = remaining % 60;
          
          m = m < 10 ? '0' + m : m;
          s = s < 10 ? '0' + s : s;
          document.getElementById('timer').innerHTML = m + ':' + s;
          remaining -= 1;
          
          if(remaining >= 0 && timerOn) {
            setTimeout(function() {
                timer(remaining);
            }, 1000);
            return;
          }
        
          if(!timerOn) {
            // Do validate stuff here
            return;
          }
          
         
        }
        
        timer(120);
        
        $('#resend').click(function () {
          if($('#timer').text() == "00:00")
          {
              $('#timer').text('');
              //$('#timer_container').text('');
                
               $.ajax({
                type:'POST',
                url:"/user/confirm-mobile",
                data:"resend="+'ارسال دوباره'+"&_token=<?=csrf_token();?>",
                success:function(data) {
                    if(data== 1)
                    {
                        $('#timer').append(timer(120));
                        alert("کد فعالسازی برای شما ارسال شد")

                    }
                    else if(data == 3)
                    {
                        alert('تعداد SMS های ارسالی برای شما در امروز به حد نصاب خود رسیده است، لطفا روز بعد مجددا جهت دریافت، تلاش فرمایید.')
                       if($('#timer').text() == "00:00" || $('#timer').text()=="")

                        $('#timer').text("00:00");
                    }
                    else if(data == 0)    
                        alert("کاربر گرامی بعد از گذشت دو دقیقه از ارسال کد فعالسازی قبلی کد جدید برای شما ارسال خواهد شد")
                }
            });
          }
        else
            alert("کاربر گرامی بعد از گذشت دو دقیقه از ارسال کد فعالسازی قبلی کد جدید برای شما ارسال خواهد شد")
             
            });

    </script>
@endsection