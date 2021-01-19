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
    </style>
@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: ثبت نام/ورود
@endsection

@section('content')
    <div class="cd-main-content cd-inner-content">
        <div class="col-xs-12 wrapper-breadcrumb">
            <div class="p-breadcrumbs">
                <ul class="page-breadcrumbs">
                    <li>
                        <a href="{{route('home')}}">صفحه اصلی</a>
                    </li>
                    <li> <i class="fa fa-angle-left"></i> </li>
                    <li class="c-state_active">
                        عضویت
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 top-innerpage" style="background:url('/site/default/img/banner_blog.png') no-repeat top center/cover;">
            <div class="container"><h1 class="wow animated fadeInUp"> عضویت </h1></div>
        </div>

        <div class="clearfix container inner-content">
            <div class="col-xs-12 wrap-content">
                <div class="col-xs-12 left-jobs no-padd-xs no-padd">
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
                    <div class="col-md-6 c-left-b" align="center">
                        <img src="/site/default/img/login.png" class="icon-head" alt=""/>
                        <h3 class="inner-title1">ورود</h3>
                        <section class="content">
                            <form class="form-horizontal"  action="{{route('login.store')}}" method="POST">
                                {{csrf_field()}}
                                <section class="content">
                                <span class="input input--minoru">
                                    <label class="input__label input__label--minoru" for="input-13">
                                        <span class="input__label-content input__label-content--minoru"> شماره همراه <span class="stars">*</span></span>
                                    </label>
                                    <input class="input__field input__field--minoru" type="text" id="input-13" value="" name="mobile" placeholder="0912xxxxxxx" style="text-align: left;direction:ltr;"/>
                                </span>
                                    <span class="input input--minoru">
                                     <label class="input__label input__label--minoru" for="input-14">
                                        <span class="input__label-content input__label-content--minoru"> رمز عبور <span class="stars">*</span></span>
                                    </label>
                                    <input class="input__field input__field--minoru" type="password" value="" name="password" id="input-14" placeholder="رمز عبور را وارد کنید."  style="text-align: left;direction:ltr;"/>
                                </span>
                                <span class="input input--minoru">
                                <div class="captcha">
                                    <img id="captcha_login_1" src="{{route('site.captcha','login')}}">
                                    <img id="refresh-captcha" src="/site/default/img/refresh.png" onclick="$('#captcha_login_1').attr('src', '{{route('site.captcha','login')}}?ver='+(new Date()).getTime());" style="cursor: pointer">
                                </div>
                                
                                <label class="input__label input__label--minoru" for="input-18">
                                <span class="input__label-content input__label-content--minoru">  تصویر امنیتی <span class="stars">*</span></span>
                                    </label>
                                    <input  style="text-align: left;direction:ltr;" value="" class="input__field input__field--minoru" autocomplete="off" name="login_captcha" type="text" id="input-18" placeholder=" تصویر امنیتی را تایپ کنید."/>
                                </span>
                                <span class="input input--minoru">
                                <input id="checkboxes-0" name="remember" value="1" type="checkbox">
                                مرا به خاطر بسپار | <a href="{{route('user.forget.password')}}">فراموشی رمز عبور</a>
                                </span>
                                <span class="input input--minoru">
                                    <input type="submit" name="login" class="request-jobs" value="ورود">
                                    
                                </span> 
                                {{--<span class="input input--minoru">
                                    <input type="submit" name="login" class="btn-google-register" value="">
                                </span>--}}
                                </section>
                            </form>
                        </section>
                    </div>
                    <div class="line-bottom hidden-lg hidden-md visible-sm visible-xs"></div>
                    <div class="col-md-6 c-right-b" align="center" id="register">
                        <img src="/site/default/img/register.png" class="icon-head" alt=""/>
                        <h3 class="inner-title1">ثبت نام</h3>
                        <form action="{{route('register.store')}}" method="POST">
                            {{csrf_field()}}
                            <section class="content">
                                <span class="input input--minoru">
                                     <label class="input__label input__label--minoru" for="input-14">
                                        <span class="input__label-content input__label-content--minoru">  نام <span class="stars">*</span></span>
                                    </label>
                                    <input class="input__field input__field--minoru" value="{{old('first_name')}}" name="first_name" type="text" id="input-14" placeholder="نام کاربری را وارد کنید."/>
                                </span>
                                <span class="input input--minoru">
                                    <label class="input__label input__label--minoru" for="input-15">
                                        <span class="input__label-content input__label-content--minoru">  نام خانوادگی <span class="stars">*</span></span>
                                    </label>
                                    <input class="input__field input__field--minoru" value="{{old('last_name')}}" name="last_name" type="text" id="input-15" placeholder="نام خانوادگی کاربری را وارد کنید."/>
                                </span>

                                <span class="input input--minoru">
                                    <label class="input__label input__label--minoru" for="input-13">
                                        <span class="input__label-content input__label-content--minoru">شماره همراه <span class="stars">*</span></span>
                                    </label>
                                    <input class="input__field input__field--minoru" value="{{old('mobile')}}" name="mobile" type="text" id="input-13" placeholder="0912xxxxxxx" />
                                </span>
                                <span class="input input--minoru">
                                    <label class="input__label input__label--minoru" for="input-13">
                                        <span class="input__label-content input__label-content--minoru">ایمیل </span>
                                    </label>
                                    <input class="input__field input__field--minoru" value="{{old('email')}}" name="email" type="text" id="input-13" placeholder="example@mail.com" />
                                </span>

                                <span class="input input--minoru">
                                     <label class="input__label input__label--minoru" for="input-16">
                                        <span class="input__label-content input__label-content--minoru">  رمز عبور <span class="stars">*</span></span>
                                    </label>
                                    <input class="input__field input__field--minoru" value="{{old('password')}}" type="password" name="password" id="input-16" placeholder="رمز عبور را وارد کنید."/>
                                </span>
                                <span class="input input--minoru">
                                    <label class="input__label input__label--minoru" for="input-17">
                                        <span class="input__label-content input__label-content--minoru">  تکرار رمز عبور <span class="stars">*</span></span>
                                    </label>
                                    <input class="input__field input__field--minoru" value="{{old('password_confirmation')}}" type="password" name="password_confirmation" id="input-17" placeholder="رمز عبور را مجددا وارد کنید."/>
                                </span>
                                <span class="input input--minoru">
                                <div class="captcha">
                                    <img id="captcha" src="{{route('site.captcha','register')}}">
                                    <img id="refresh-captcha" src="/site/default/img/refresh.png" onclick="$('#captcha').attr('src', '{{route('site.captcha','register')}}?ver='+(new Date()).getTime());" style="cursor: pointer">
                                </div>
                                
                                    <label class="input__label input__label--minoru" for="input-18">
                                <span class="input__label-content input__label-content--minoru">  تصویر امنیتی <span class="stars">*</span></span>
                                    </label>
                                    <input class="input__field input__field--minoru" autocomplete="off" value="" name="register_captcha" type="text" id="input-18" placeholder=" تصویر امنیتی را تایپ کنید."/>
                                </span>
                            </section>
                            <input type="submit" name="login" class="request-jobs" value="ثبت نام">
                        </form>
                    </div>
                </div>
            </div>
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
        if ($(window).width() < 992) {
        $(document).ready(function () {
            // Handler for .ready() called.
            $('html, body').animate({
                scrollTop: $('#register').offset().top -20
            }, 'slow');
        });
        }
    </script>
@endsection