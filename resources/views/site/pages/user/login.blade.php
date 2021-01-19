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
            overflow:auto;
            margin:0;
            padding:0;
            -webkit-tap-highlight-color: rgba(0,0,0,0);
        }
        .captcha_login{    border-radius: 40px;}
    </style>
@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: ثبت نام/ورود
@endsection

@section('content')

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
                    
                    <div class="container mt-5">
                        <div class="row col-md-12 m-auto">
                            <div class="col-md-5 mt-5 ml-3"><img src="/site/default/Template_2019/img/login-illu.svg"/></div>
                            <section class="col-md-6 content mt-5">
                                    <fieldset class="red-fieldset">
                                        <legend class="text-center">ورود</legend>
                                    </fieldset>
                                <form class="form-horizontal people-forms row" action="{{route('login.store')}}" method="POST" onsubmit="return form_check()">
                                    {{csrf_field()}}
                                    <section class="content w-100">
                                        <div class="col-md-12">
                                            <div class="people-forms-fields-group">
                                                <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                                <input class="people-forms-fields input__field input__field--minoru form-control" type="text" id="input-13" value="" name="mobile" placeholder="0912xxxxxxx" style="text-align: left;direction:ltr;"/>
                                                <label>شماره همراه</label>
                                            </div>
                                        </div>                                    
                                        <div class="col-md-12">
                                            <div class="people-forms-fields-group">
                                                <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" />
                                                     <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" style=" padding-top:14px;margin: auto;color:red"></span>
                                                </div>
                                                <input class="people-forms-fields input__field input__field--minoru form-control dir-ltr text-left" type="password" value="" name="password" id="input-14"/>
                                                <label style="padding-right:20px">رمز عبور</label>
                                            </div>
                                        </div>                                                                            
                                        <div class="col-md-12">
                                            <div class="people-forms-fields-group">
                                                <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                                <input class="people-forms-fields input__field input__field--minoru form-control" autocomplete="off" name="captcha" type="text" id="input-18"/>
                                                <label> تصویر امنیتی را تایپ کنید</label>
                                            </div>
                                        </div>                                                                                                                    
                                        <div class="col-md-12">
                                            <div class="people-forms-fields-group text-right">
                                                <img class="captcha_login" id="captcha_login_1" src="{{route('site.captcha','login')}}?ver=<?= time()?>">
                                                <img id="refresh-captcha" src="/site/default/Template_2019/img/refresh.svg" onclick="$('#captcha_login_1').attr('src', '{{route('site.captcha','login')}}?ver='+(new Date()).getTime());" style="cursor: pointer">
                                            </div>
                                        </div>                                           
                                    <div class="col-md-12 people-forms-fields-group"><input id="checkboxesremember" name="remember" value="1" type="checkbox"><label for="checkboxesremember"> مرا به خاطر بسپار</label>
                                      <input  type="checkbox" value="1" name="admin_national_code" id="admin_national_code" /><label for="admin_national_code">
دسترسی ادمین (تیم منابع انسانی خانواده گلرنگ)                                     
                                        </label>
                                   <div class="codemelli"></div><br/>
                                   <div class="col-md-12 pr-0"><a class="w-100 d-block text-right font-14 text-danger" href="{{route('user.forget.password')}}">فراموشی رمز عبور</a></div></div>

                                        <fieldset class="mt-2 w-100">
                                            <legend>
                                            <input type="submit" name="login" class="save send-btn-green request-jobs" value="ورود"/>
                                            </legend>
                                        </fieldset>
                                    </section>
                                </form>
                        </section>
                        </div>
                    </div>
                    
@endsection

@section('script')
    {{ Html::script('/site/'.config('app.site_theme').'/js/jquery.easing.min.js') }}
    <script>
        $(document).ready(function(){
            $(".close-error").click(function(){
                $(".bg-error").hide();
                return false;
            });
        });
        
        $('#admin_national_code').change(function() {
        if(this.checked) {
            $('.codemelli').append('<div class="people-forms-fields-group"><input type="text" name="national_code" id="national_code" class="people-forms-fields input__field input__field--minoru form-control"  maxlength="10" /><label>کد ملی</label> <span id="codemelli-help" class="help-block"></span></div>')
        }
        else
         $('.codemelli').html('')
        
        });
        
        if ($(window).width() < 992) {
            $(document).ready(function () {
                // Handler for .ready() called.
                $('html, body').animate({
                    scrollTop: $('#register').offset().top -20
                }, 'slow');
            });
        }
        
        function form_check() {
            validity = true;
            if( $('#national_code').val().length >0)
            {
                var codemelli = $('#national_code').val();
                if (!checkCodeMeli(codemelli)) {
                    $('#codemelli-help').html('کدملی وارد شده صحیح نیست.');
                    validity = false;
                } else {
                    $('#codemelli_error').html('');
                }
            }
          


            if (validity == false || is_form_validated==false){
                return false;
            }


        }

    </script>
@endsection