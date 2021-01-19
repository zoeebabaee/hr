@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('custom_css')
    <style>
        html, body {
            overflow: auto;
            margin: 0;
            padding: 0;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }
        .captcha_login{    border-radius: 40px;}
    </style>
    {{ Html::style('/site/'.config('app.site_theme').'/css/alertify.core.css') }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/alertify.default.css') }}
@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: ثبت نام/ورود
@endsection

@section('content')

                    @if(Session::has('flash_message'))
                        <div class="bg-success" style="text-align: right">
                            <a href="" class="close-success"><i class="fa fa-remove"></i></a>
                            <p style="direction: rtl">{!! session('flash_message') !!}</p>
                        </div>
                    @endif

            <div class="container mt-5">
                <div class="row col-md-12 m-auto">
                    <div class="col-12 col-md-5 mt-md-5 ml-md-3 m-0 p-0"><img src="/site/default/Template_2019/img/login-illu.svg"/></div>
                    <div class="col-12 col-md-6 mt-md-5 ml-md-3 m-0 p-0" align="center" id="register">
                        <fieldset class="red-fieldset">
                            <legend class="text-center">ثبت نام</legend>
                        </fieldset>

                        <form action="{{route('register.store')}}" method="POST" onsubmit="return validateMyForm();">
                            {{csrf_field()}}
                            <section class="content">
                                
                                
                       
                                
                                <div class="col-md-12">
                                    <div class="people-forms-fields-group">
                                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                        <input class="input__field input__field--minoru people-forms-fields text-left form-control"
                                               value="{{substr(old('mobile'),1)}}"
                                               style="direction: ltr"
                                               name="mobile"
                                               type="tel"
                                               minlength="11"
                                               maxlength="11"
                                               id="mobile"
                                               placeholder="(0912) xxx-xxxx"
                                               required
                                               oninvalid="$('#mobile_help').html('لطفا شماره موبایل خود را وارد کنید');"
                                               onkeyup="$('#mobile_help').html('')"
                                        />
                                        <label>شماره همراه</label>                                        
                                        <p id="mobile_help" class="help-block"></p>
                                        @if($errors->has('mobile'))
                                            <p class="help-block">{{$errors->first('mobile')}}</p>
                                        @endif                
                                    </div>
                                </div>
                                
                           <!--     <div class="col-md-12">
                                    <div class="people-forms-fields-group">
                                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                        <input class="input__field input__field--minoru people-forms-fields text-left form-control" value="{{old('email')}}"
                                               style="direction: ltr" name="email" type="text" id="email"
                                               placeholder="example@mail.com"
                                               maxlength="255"
                                        />
                                        <label>ایمیل</label>                                        
                                        @if($errors->has('email'))
                                            <p class="help-block">{{$errors->first('email')}}</p>
                                        @endif                
                                    </div>
                                </div>     -->   
                                                        
                               <!-- <div class="col-md-12">
                                    <div class="people-forms-fields-group">
                                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                        <input class="input__field input__field--minoru password password_confirmation_check people-forms-fields form-control"
                                               style="direction: ltr"
                                               value="{{old('password')}}"
                                               type="password"
                                               name="password"
                                               id="password_field"
                                               required
                                               oninvalid="$('#help_password').html('لطفا رمز عبور را وارد کنید');this.setCustomValidity(' ')"
                                               oninput="setCustomValidity('')"
                                               onkeyup="$('#help_password').html('')"
                                               maxlength="255"
                                        />
                                        <label>رمز عبور</label>                                        
                                        <p class="help-block" id="help_password"></p>
                                        <p class="help-block" id="help_password_length"></p>
                                        @if($errors->has('password'))
                                            <p class="help-block">{{$errors->first('password')}}</p>
                                        @endif             
                                    </div>
                                </div>
                        
                                <div class="col-md-12">
                                    <div class="people-forms-fields-group">
                                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                        <input class="input__field input__field--minoru password_confirmation_check  people-forms-fields form-control"
                                               style="direction: ltr"
                                               value="{{old('password_confirmation')}}"
                                               type="password"
                                               name="password_confirmation"
                                               id="password_confirmation"
                                               required
                                               oninvalid="$('#help_password_confirmation').html('لطفا یکبار دیگر رمز عبور را وارد کنید');this.setCustomValidity(' ')"
                                               oninput="setCustomValidity('')"
                                               onkeyup="$('#help_password_confirmation').html('')"
                                               maxlength="255"
                                        />
                                        <label>تکرار رمز عبور</label>                                        
                                        <p class="help-block" id="help_password_confirmation"></p>
                                        <p class="help-block" id="help_password_confirmation_same"></p>
                                        @if($errors->has('password_confirmation'))
                                            <p class="help-block">{{$errors->first('password_confirmation')}}</p>
                                        @endif           
                                    </div>
                                </div>-->
                                
                                <div class="col-md-12">
                                    <div class="people-forms-fields-group">
                                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                        <input class="input__field input__field--minoru people-forms-fields form-control" autocomplete="off"
                                               name="register_captcha" type="text" id="register_captcha"
                                               required
                                               oninvalid="$('#register_captcha_help').html('لطفا تصویر امنیتی را وارد کنید');this.setCustomValidity(' ')"
                                               oninput="setCustomValidity('')"
                                               onkeyup="$('#register_captcha_help').html('')"
                                               maxlength="5"
                                        />
                                        <label>تصویر امنیتی</label>  
                                        <p class="help-block" id="register_captcha_help"></p>
                                        @if($errors->has('register_captcha'))
                                            <p class="help-block">{{$errors->first('register_captcha')}}</p>
                                        @endif
                                    </div>
                                </div>          
                                
                                <div class="col-md-12">
                                    <div class="people-forms-fields-group">
                                        <div class="captcha">
                                            <img class="captcha_login" id="captcha" src="{{route('site.captcha','register')}}?ver=<?= time()?>">
                                            <img id="refresh-captcha" src="/site/default/Template_2019/img/refresh.svg" onclick="$('#captcha').attr('src', '{{route('site.captcha','register')}}?ver='+(new Date()).getTime());" >
                                        </div>
                                    </div>
                                </div>    
                                
                            </section>
                            <fieldset class="mt-2 w-100">
                                <legend>
                                <input type="submit" name="login" class="save send-btn-green request-jobs" value="ثبت نام">
                                </legend>
                            </fieldset>                            
                        </form>


                    </div>
                </div>
            </div>

@endsection

@section('script')
    {{ Html::script('/site/'.config('app.site_theme').'/js/jquery.easing.min.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/alertify.min.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/inputmask.binding.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/jquery.inputmask.bundle.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/phone.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/phone-uk.js') }}
    <script>
    
        $("#mobile").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        
        var is_form_validated = true;
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

        if ($(window).width() < 992) {
            $(document).ready(function () {
                // Handler for .ready() called.
                $('html, body').animate({
                    scrollTop: $('#register').offset().top - 20
                }, 'slow');
            });
        }

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
                is_form_validated = false;
            }
            else {
                $('#help_password_length').html('');
                is_form_validated = true;
            }
        });

        //check passwords are same
        $(".password_confirmation_check").bind('input propertychange', function () {
            if ($("#password_confirmation").val() !== $("#password_field").val()) {
                $('#help_password_confirmation_same').html('رمز عبور و تکرار آن مطابقت ندارند');
                is_form_validated = false;
            }
            else {
                $('#help_password_confirmation_same').html('');
                is_form_validated = true;
            }
        });

        function validateMyForm() {
            if (!is_form_validated)
                event.preventDefault();
            return is_form_validated;
        }
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection