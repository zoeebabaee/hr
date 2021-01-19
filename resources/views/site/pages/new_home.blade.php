<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>سامانه منابع انسانی گروه صنعتی گلرنگ</title>
    <meta name="keywords" content="">
    <meta name="Resource-type" content="Document"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description"
    content="درخواست همکاری در مجموعه بزرگ گروه صنعتی گلرنگ در حوزه های متنوع و تخصصی از طریق ثبت نام و تکمیل رزومه در سامانه منابع انسانی"/>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="author" content="Golrang System">
    <meta property="og:title" content="سامانه منابع انسانی گروه صنعتی گلرنگ"/>
    <meta property="og:image" content="https://people.golrang.com/og.png"/>
    <meta property="og:description "
content="درخواست همکاری در مجموعه بزرگ گروه صنعتی گلرنگ در حوزه های متنوع و تخصصی از طریق ثبت نام و تکمیل رزومه در سامانه منابع انسانی"/>
  
    <link href="/favicon.ico" rel="shortcut icon"/>
    {{ Html::style('/site/'.config('app.site_theme').'/Template_2019/css/bootstrap.min.css',['async' => 'async']) }}
    {{ Html::style('/site/'.config('app.site_theme').'/Template_2019/css/owl.carousel.css',['async' => 'async']) }}
    {{ Html::style('/site/'.config('app.site_theme').'/Template_2019/css/owl.theme.default.css',['async' => 'async']) }}
    {{ Html::style('/site/'.config('app.site_theme').'/Template_2019/css/style.css?v='.time(),['async' => 'async']) }}
    {{ Html::style('/site/'.config('app.site_theme').'/Template_2019/css/jquery.fancybox.min.css',['async' => 'async']) }}


    <!--[if IE]>
    <script type="text/javascript">
        var console = {
            log: function () {
            }
        };
    </script>
    <![endif]-->
    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a
            href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112435217-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-112435217-3');
    </script>
    <style>
        .form-control:disabled, .form-control[readonly] {
    background-color: transparent;
    opacity: 1;
    background: transparent;
}
    </style>
</head>
<body>


<div class="illust-back"></div>
<div class="right-illu"></div>

<div class="container header position-relative">
    <div class="left-illu col-lg-5 d-lg-block d-md-none d-sm-none d-none">
        <div class="items">
            <div class="items__inner" id="js-scene">
                <div class="items__layer layer" data-depth="0.10">
                    <div class="items__item" data-title=""></div>
                </div>
                <div class="items__layer layer" data-depth="0.20">
                    <div class="items__item" data-title=""></div>
                </div>
                <div class="items__layer layer" data-depth="0.20">
                    <div class="items__item" data-title=""></div>
                </div>
                <div class="items__layer layer" data-depth="0.20">
                    <div class="items__item" data-title=""></div>
                </div>
                <div class="items__layer layer" data-depth="0.20">
                    <div class="items__item" data-title=""></div>
                </div>
                <div class="items__layer layer" data-depth="0.25">
                    <div class="items__item" data-title=""></div>
                </div>
                <div class="items__layer layer" data-depth="0.20">
                    <div class="items__item" data-title=""></div>
                </div>
                <div class="items__layer layer" data-depth="0.20">
                    <div class="items__item" data-title=""></div>
                </div>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light py-3">
                    <a class="navbar-brand" href="/">
                        {{ HTML::image('/site/'.config('app.site_theme').'/Template_2019/img/gig-logo.svg') }}
                    </a>
                    <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars"
                            aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div id="navbarContent" class="collapse navbar-collapse home-navbar-collapse">
                        <ul class="navbar-nav rtl ">
                            <!-- Megamenu-->
                            <li class="nav-item dropdown megamenu"><a id="megamneu" href="" data-toggle="dropdown"
                                                                      aria-haspopup="true" aria-expanded="false"
                                                                      class="nav-link dropdown-toggle">خانواده گلرنگ</a>
                                <div aria-labelledby="megamneu" class="dropdown-menu">
                                    <div class="row rtl">
                                        <div class="col-12">
                                            <div class="bg-white p-4">
                                                <div class="row rtl">
                                                    <div class="col-md-4 mb-4">
                                                        <h6 class="text-right">استخدام</h6>
                                                        <ul class="list-unstyled">
                                                            <li class="nav-item"><a class="nav-link text-small pb-0"
                                                                                    href="{{route('site.jobs.index')}}">فرصت
                                                                    های شغلی</a></li>
                                                            <li class="nav-item"><a class="nav-link text-small pb-0"
                                                                                    href="{{route('pages.absorption_process')}}">فرآیند
                                                                    جذب</a></li>
                                                            <li class="nav-item"><a class="nav-link text-small pb-0"
                                                                                    href="{{route('user.resume.1')}}">فرم استخدام</a></li>
                                                            <li class="nav-item"><a class="nav-link text-small pb-0"
                                                                                    href="{{route('site.statics.pages',HR\Content::find(5)->alias)}}">{{HR\Content::find(5)->title}}</a>
                                                            </li>
                                                            <!--
                                                            <li class="nav-item"><a class="nav-link text-small pb-0"
                                                                                    href="{{route('pages.help')}}">{{'راهنمای سامانه'}}</a>
                                                            </li>
                                                            -->
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4 mb-4">
                                                        <h6 class="text-right">آموزش و توسعه</h6>
                                                        <ul class="list-unstyled">
                                                            <li class="nav-item"><a class="nav-link text-small pb-0"
                                                                                    href="{{route('site.pages.learning_movie')}}">فیلم
                                                                    های آموزشی</a></li>
                                                            <li class="nav-item"><a class="nav-link text-small pb-0"
                                                                                    href="{{route('site.books.index')}}">معرفی
                                                                    کتاب</a></li>
                                                            <li class="nav-item"><a class="nav-link text-small pb-0"
                                                                                    href="{{route('site.statics.pages',HR\Content::find(14)->alias)}}">{{HR\Content::find(14)->title}}</a>
                                                            </li>
                                                            <li class="nav-item"><a class="nav-link text-small pb-0"
                                                                                    href="{{route('site.events.educational.index')}}">رویدادهای
                                                                    آموزشی</a></li>
                                                            <li class="nav-item"><a class="nav-link text-small pb-0"
                                                                                    href="{{route('site.statics.pages',HR\Content::find(16)->alias)}}">{{HR\Content::find(16)->title}}</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4 mb-4">
                                                        <h6 class="text-right">درباره ما</h6>
                                                        <ul class="list-unstyled">
                                                            <li class="nav-item"><a class="nav-link text-small pb-0"
                                                                                    href="{{route('site.pages.gallery')}}">گالری
                                                                    تصاویر</a></li>
                                                            <li class="nav-item"><a class="nav-link text-small pb-0"
                                                                                    href="{{route('site.events.index')}}">اخبار
                                                                    و رویدادها</a></li>
                                                            <li class="nav-item"><a class="nav-link text-small pb-0"
                                                                                    href="{{route('aboutUs')}}">معرفی
                                                                    شرکت</a></li>
                                                            <li class="nav-item"><a class="nav-link text-small pb-0"
                                                                                    href="{{route('contact.create')}}">تماس
                                                                    با گلرنگ</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item"><a href="{{route('site.jobs.index')}}" class="nav-link">فرصت های
                                    شغلی</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    @if(Session::has('flash_message'))
        <div class="bg-success" style="text-align: right">
            <a href="" class="close-success"><i class="fa fa-remove"></i></a>
            <p style="direction: rtl">{!! session('flash_message') !!}</p>
        </div>
    @endif
    @php
        if(!isset($_SESSION))
        {
            session_start();
        }
    @endphp
    @if( isset($_SESSION['admin_login']) && !empty($_SESSION['admin_login']))
        <li class="nav-item"><a class="nav-link" href="{{route('admin.login.as.return')}}" style="color: red;">بازگشت به
                ادمین</a></li>
    @endif

    @if(Auth::check())
        <div class="right-sec-1 col-xl-5 col-lg-6 col-12 float-right mt-5">
            <h1 class="font-weight-light">ســامانه منـابع انسـانی گروه صنعتی گلرنگ</h1>
            <fieldset class="sec-1-fieldset">
                <legend>ســـرآغـاز یــک موفـقیـــت</legend>
            </fieldset>
            <div class="row">
{{--
                @php die(Auth()->user()->id.'***'); @endphp
--}}
                @can('پنل ادمین')
                    <div class="col-md-12 mt-2 mb-2 text-center"><img data-src="{{Auth::user()->avatar}}" alt="" title=""
                                                                      width="100" height="100"  class="lazy avatar_home">
                    </div>
                    @if(DB::table('model_has_roles')->where('model_id','=',Auth()->user()->id)->count() > 0)

                    <div class="col-md-12 mt-2 mb-2 text-center"><a class="d-block p-2 o-btn w-50 m-auto"
                                                                    href="{{route('adpanel')}}">ادمین</a></div>
                    @endif
                    <div class="col-md-12 mt-2 mb-2 text-center"><a class="d-block p-2 o-btn w-50 m-auto"
                                                                    href="{{route('site.user.profile')}}">پروفایل</a>
                    </div>
                    <div class="col-md-12 mt-2 mb-2 text-center"><a class="d-block p-2 o-btn w-50 m-auto"
                                                                    href="{{route('logout')}}">خروج</a></div>
                @else
                    <div class="col-md-8 m-auto text-center">
                        <a class="d-block p-2 m-auto user-name-mainpage-header" href="{{route('site.user.profile')}}">
                            <img data-src="{{Auth::user()->avatar}}" alt="" title="" class="lazy avatar_home">
                        </a>
                        <span class="avatar_name"> {{Auth::user()->first_name}}   خوش آمدید</span>
                    </div>
                    <div class="col-md-8 m-auto text-center c-links">
                        @if(DB::table('model_has_roles')->where('model_id','=',Auth()->user()->id)->where('role_id','<',19)->count() > 0)

                        <a class="" href="{{route('adpanel')}}">ادمین</a>@endif
                        <a class="" href="{{route('site.user.profile')}}">پروفایل</a>
                        <a class="" href="{{route('logout')}}">خروج</a>
                    </div>
                @endcan
            </div>
        </div>
    @else
        <div class="right-sec-1 col-xl-5 col-lg-6 col-12 float-right mt-5" id="register">
            <h1 class="font-weight-light">ســامانه منـابع انسـانی گروه صنعتی گلرنگ</h1>
            <fieldset class="sec-1-fieldset mb-1">
                <legend>ســـرآغـاز یــک موفـقیـــت</legend>
            </fieldset>

            <form action="{{route('register.store')}}" method="POST" onsubmit="return validateMyForm();"
                class="home_register_form">
                {{csrf_field()}}
                <div class="form-row">
                    <div class="error_box_home_register">
                        @if(Session::has('error_message'))
                            <div class="bg-error" style="text-align: right">
                                <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                                <p style="direction: rtl" >{!! session('error_message') !!}</p>
                            </div>
                        @endif
                        @if(Session::has('flash_message'))
                            <div class="bg-success" style="text-align: right">
                                <a href="" class="close-success"><i class="fa fa-remove"></i></a>
                                <p style="direction: rtl">{!! session('flash_message') !!}</p>
                            </div>
                        @endif
                        <!--<p id="first_name_help" class="help-block help-block"></p>
                        @if($errors->has('first_name'))
                            <p class="help-block">{{$errors->first('first_name')}}</p>
                        @endif

                        <p id="last_name_help" class="help-block"></p>
                        @if($errors->has('last_name'))
                            <p class="help-block">{{$errors->first('last_name')}}</p>
                        @endif

                        @if($errors->has('email'))
                            <p class="help-block">{{$errors->first('email')}}</p>
                        @endif-->

                        <p id="mobile_help" class="help-block"></p>
                        @if($errors->has('mobile'))
                            <p class="help-block">{{$errors->first('mobile')}}</p>
                        @endif

                    <!--    <p class="help-block" id="help_password"></p>
                        <p class="help-block" id="help_password_length"></p>
                        @if($errors->has('password'))
                            <p class="help-block">{{$errors->first('password')}}</p>
                        @endif

                        <p class="help-block" id="help_password_confirmation"></p>
                        <p class="help-block" id="help_password_confirmation_same"></p>
                        @if($errors->has('password_confirmation'))
                            <p class="help-block">{{$errors->first('password_confirmation')}}</p>
                        @endif
-->
                        <p class="help-block" id="register_captcha_help"></p>
                        @if($errors->has('register_captcha'))
                            <p class="help-block">{{$errors->first('register_captcha')}}</p>
                        @endif
                    </div>

            <!--        <div class="form-group col-md-6">
                        {{ HTML::image('/site/'.config('app.site_theme').'/Template_2019/img/avatar%20(-1.svg', '', array('class' => 'form-icon')) }}
                        <input
                                class="input__field input__field--minoru justpersian form-control"
                                value="{{old('first_name')}}"
                                name="first_name"
                                type="text"
                                id="frist_name"
                                required
                                oninvalid="$('#first_name_help').html('لطفا نام خود را وارد کنید.');this.setCustomValidity(' ')"
                                oninput="setCustomValidity('')"
                                onkeyup="$('#first_name_help').html('')"
                                maxlength="255"
                        />
                        <label for="frist_name" class="home-label">نام</label>
                        <div class="line"></div>
                    </div>

                    <div class="form-group col-md-6">
                        {{ HTML::image('/site/'.config('app.site_theme').'/Template_2019/img/avatar%20(-1.svg', '', array('class' => 'form-icon')) }}
                        <input
                                class="input__field input__field--minoru justpersian form-control"
                                value="{{old('last_name')}}"
                                name="last_name"
                                type="text"
                                id="last_name"
                                required
                                oninvalid="$('#last_name_help').html('لطفا نام خانوادگی خود را وارد کنید.');this.setCustomValidity(' ')"
                                oninput="setCustomValidity('')"
                                onkeyup="$('#last_name_help').html('')"
                                maxlength="255"
                        />
                        <label for="last_name" class="home-label">نام خانوادگی</label>
                        <div class="line"></div>
                    </div>-->

<!--                </div>
-->

         <!--       <div class="form-row">
                    <div class="form-group col-md-6">
                        {{ HTML::image('/site/'.config('app.site_theme').'/Template_2019/img/envelope.svg', '', array('class' => 'form-icon')) }}
                        <input class="input__field input__field--minoru form-control" value="{{old('email')}}"
                               style="direction: ltr" name="email" type="text" id="email"
                               maxlength="255"
                               readonly onfocus="this.removeAttribute('readonly');"
                        />
                        <label for="email" class="home-label">پست الکترونیکی</label>
                        <div class="line"></div>
                    </div>-->



               <!-- </div>-->

      <!--          <div class="form-row">
                    <div class="form-group col-md-6">
                        {{ HTML::image('/site/'.config('app.site_theme').'/Template_2019/img/asset1.svg', '', array('class' => 'form-icon')) }}
                        <input class="input__field input__field--minoru password password_confirmation_check form-control"
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
                        <label for="password_field" class="home-label">رمز عبور</label>
                        <div class="line"></div>
                    </div>

                    <div class="form-group col-md-6">
                        {{ HTML::image('/site/'.config('app.site_theme').'/Template_2019/img/asset1.svg', '', array('class' => 'form-icon')) }}

                        <input class="input__field input__field--minoru password_confirmation_check form-control"
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

                        <label for="password_confirmation" class="home-label">تکرار رمز عبور</label>
                        <div class="line"></div>
                    </div>

                </div>-->
               
                                        <div class="form-group col-md-6">
                        {{ HTML::image('/site/'.config('app.site_theme').'/Template_2019/img/smartphone.svg', '', array('class' => 'form-icon')) }}
                        <input class="input__field input__field--minoru form-control"
                               value="{{substr(old('mobile'),1)}}"
                               style="direction: ltr"
                               name="mobile"
                               type="tel"
                               minlength="11"
                               maxlength="11"
                               id="mobile"
                               required
                               oninvalid="$('#mobile_help').html('لطفا شماره موبایل خود را وارد کنید');"
                               onkeyup="$('#mobile_help').html('')"
                        />
                        <label for="mobile" class="home-label">شماره همراه</label>
                        <div class="line"></div>
                    </div>
                    </div>
                   <div class="form-row">


                    <div class="form-group col-md-6">
                        <input class="input__field input__field--minoru form-control" autocomplete="off"
                               name="register_captcha" type="text" id="register_captcha"  
                                                              style="direction: ltr"

                               required
                               oninvalid="$('#register_captcha_help').html('لطفا تصویر امنیتی را وارد کنید');this.setCustomValidity(' ')"
                               oninput="setCustomValidity('')"
                               onkeyup="$('#register_captcha_help').html('')"
                               maxlength="5"
                        />
                        <label for="register_captcha" class="home-label">کد امنیتی</label>
                        <div class="line"></div>
                    </div>

                    <div class="form-group col-md-6 text-right mt-2">
                        <div class="col-md-12">
                            <div class="captcha-cell pull-right text-center">
                                <img id="refresh-captcha" src="/site/default/Template_2019/img/reload.svg"
                                     onclick="$('#captcha').attr('src', '{{route('site.captcha','register')}}?ver='+(new Date()).getTime());"
                                     style="cursor: pointer">
                            </div>
                            <div class="captcha pull-left">
                                <img id="captcha" class="lazy img-fluid" data-src="{{route('site.captcha','register')}}?ver=<?= time()?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12 text-center">
                        <input type="submit" name="login" class="login-btn m-atu col-10 col-md-6 m-auto" value="ثبت نام">
                    </div>
                    <fieldset class="sec-1-fieldset m-0 mt-4 mb-2">
                        <legend class="font-13">قبلا ثبت نام کرده اید؟</legend>
                    </fieldset>
                    <div class="col-md-12">
                        <a class="register-btn d-block text-center pt-1 col-10 col-md-6 m-auto" href="{{route('login')}}">ورود به ناحیه کاربری</a>
                    </div>
                </div>
            </form>


        </div>
    @endif

</div>






@if(\HR\Job::active_jobs_count())
<div class="clearfix"></div>
    <div class="container">
        <div class="col-md-12">
           <div class="search-box-section p-5 bg-light mb-4 radius-7">
            <fieldset>
                <legend class="pl-4 pr-4 font-13">جستجوی پیشرفته</legend>
            </fieldset>
            {{ Form::open(array('method'=>'GET' , 'id'=>'search_form','onsubmit'=>'if(document.getElementById("s_query").value==""){return false;}') ) }}
            <div class="people-forms-fields-group col-md-12 po-input-search">

                <input type="text" class="form-control input-lg people-forms-fields p-2" name="s" id="s_query"
                       value="{{{(old('s')==""?(isset($_GET['s'])?$_GET['s']:''):old('s'))}}}" id="textinput"/>
                <label class="pr-4">جستجو کنید</label>
                <a class="o-btn filter-btn" data-toggle="collapse" href="#collapseExample" role="button"
                   aria-expanded="false" aria-controls="collapseExample">
                    <img src="/site/default/Template_2019/img/filter (3).svg"/>
                </a>
                <button class="search-input-btn" type="submit">
                    <img src="/site/default/Template_2019/img/search.svg"/>
                </button>

            </div>


            <div class="collapse filter-input-search" id="collapseExample">
                <div class="row">
                    @php
                        $gets=strip_tags(urldecode(parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY)));
                        $gets_array=explode('&',$gets);
                        $gets_array=array_filter($gets_array);// remove empty elements
                        foreach($gets_array as $get){
                        $get_arr=(explode('=',$get));
                        if(isset($get_arr[1]) && !empty($get_arr[1])){
                        $my_get= $get_arr[0].'='.$get_arr[1];
                        $url=str_replace($my_get,'',$gets);
                        if($get_arr[1]=='list') continue;
                        if($get_arr[1]=='grid') continue;
                        if($get_arr[0]=='page') continue;
                        if($get_arr[1]=='1') $get_arr[1]='مرد';
                        if($get_arr[1]=='2')  $get_arr[1]='زن';
                        if($get_arr[1]=='newest') $get_arr[1]='جدیدترین ها';
                        if($get_arr[1]=='most-visited') $get_arr[1]='پربازدیدترین ها';
                        if($get_arr[1] != 'جدیدترین ها' && $get_arr[1] != 'پربازدیدترین ها')
                        echo '<div class="col-md-3 dir-ltr text-right font-13"><a href="'.route('site.jobs.index').'?'.$url.'" class="show-loading  text-dark">'.$get_arr[1].' <i class="fa fa-remove pointer-hand  text-dark"></i></a></div>';
                        }

                        }
                    @endphp
                </div>
                <hr>
                @if(count($gets_array)>0)

                    <a href="{{route('site.jobs.index')}}" class="all-links show-loading">پاک کردن همه</a>
                @endif

                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 w-filter">
                        <h2>استان</h2>
                        @php
                            $colors=["red","orange","yellow","blue","darkblue","green"];
                            $c=0;
                            $i=0;
                        @endphp
                        @foreach ( array_slice($all_filters['province'], 0, 6) as $title => $count )
                            <ul>
                                <li>
                                    <input
                                            @if(!is_null(request('province')))
                                            {{(in_array($title,request('province'))?' checked ':'')}}
                                            @endif
                                            type="checkbox" value="{{$i}}"
                                            data-filter_name="province[]={{$title}}" name="province[]={{$title}}"
                                            class="input-sidebar"
                                            id="province{{$title.time()}}"
                                    >
                                    <label for="province{{$title.time()}}">{{$title}}</label>
                                    <span>({{intval($count)}})</span>
                                </li>
                            </ul>
                        @endforeach

                        @if(count($all_filters['province'])>6)
                            <a href="javascript:void(0);" class="more" data-toggle="modal"
                               data-target="#province-modal"
                               data-original-title=""><i class="fa fa-plus"></i> بیشتر</a>
                        @endif
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 w-filter">
                        <h2>نوع همکاری</h2>
                        @foreach ( array_slice($all_filters['cooperation_type'], 0, 10) as $title => $count )
                            <ul>
                                <li>
                                    <input
                                            @if(!is_null(request('cooperation_type')))
                                            {{(in_array($title,request('cooperation_type'))?' checked ':'')}}
                                            @endif
                                            type="checkbox"
                                            data-filter_name="cooperation_type[]={{$title}}"
                                            name="cooperation_type[]={{$title}}"
                                            class="input-sidebar  {{HR\Job::cooperation_type_class($title)}}"
                                            id="cooperation_type{{$title}}"
                                    >
                                    <label for="cooperation_type{{$title}}">{{$title}}</label>

                                    <span>({{intval($count)}})</span>

                                </li>
                            </ul>
                        @endforeach
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 w-filter">
                        <h2>تخصص</h2>
                        @foreach ( array_slice($all_filters['department'], 0, 6) as $title => $count )
                            <ul>
                                <li>
                                    <input type="checkbox"
                                           @if(!is_null(request('department')))
                                           {{(in_array($title,request('department'))?' checked ':'')}}
                                           @endif
                                           data-filter_name="department[]={{$title}}" name="department[]={{$title}}"
                                           class="input-sidebar"
                                           id="department{{$title}}"
                                    >
                                    <label for="department{{$title}}">{{$title}}</label>
                                    <span>({{ intval($count) }})</span>
                                </li>
                            </ul>
                        @endforeach
                        @if(count($all_filters['department'])>6)
                            <a href="javascript:void(0);" class="more" data-toggle="modal"
                               data-target="#skills-modal"
                               data-original-title=""><i class="fa fa-plus"></i> بیشتر</a>
                        @endif
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 w-filter">
                        <h2>صنعت</h2>
                        @foreach ( array_slice($all_filters['industry'], 0, 6) as $title => $count )
                            <ul>
                                <li>
                                    <input
                                            @if(!is_null(request('industry')))
                                            {{(in_array($title,request('industry'))?' checked ':'')}}
                                            @endif
                                            type="checkbox" data-filter_name="industry[]={{$title}}"
                                            name="industry[]={{$title}}"
                                            class="input-sidebar"
                                            id="industry{{$title}}"
                                    >
                                    <label for="industry{{$title}}">{{$title}}</label>

                                    <span>({{intval($count)}})</span>

                                </li>
                            </ul>
                        @endforeach
                        @if(count($all_filters['industry'])>6)
                            <a href="javascript:void(0);" class="more" data-toggle="modal"
                               data-target="#industry-modal"
                               data-original-title=""><i class="fa fa-plus"></i> بیشتر</a>
                        @endif
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 w-filter">
                        <h2>جنسیت</h2>
                        @foreach ($all_filters['gender'] as $title => $count )
                            @php
                                $gender_title='';
                                if($title=='1') $gender_title='مرد';
                                if($title=='2') $gender_title='زن';
                            @endphp
                            <ul>
                                <li>
                                    <input
                                            @if(!is_null(request('gender')))
                                            {{(in_array($title,request('gender'))?' checked ':'')}}
                                            @endif
                                            type="checkbox" data-filter_name="gender[]={{$title}}"
                                            name="gender[]={{$title}}"
                                            {{(!is_null(request('gender')) && in_array($title,request('gender'))?' checked ':'')}} class="input-sidebar"
                                            id="gender{{$title}}"
                                    >
                                    <label for="gender{{$title}}">{{$gender_title}}</label>

                                    <span>({{intval($count)}})</span>

                                </li>
                            </ul>
                        @endforeach
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 w-filter">
                        <h2>شرکت ها</h2>
                        @foreach ( array_slice($all_filters['company'], 0, 6) as $title => $count )
                            <ul>
                                <li>
                                    <input
                                            @if(!is_null(request('company')))
                                            {{(in_array($title,request('company'))?' checked ':'')}}
                                            @endif
                                            type="checkbox"
                                            data-filter_name="company[]={{$title}}"
                                            name="company[]={{$title}}"
                                            class="input-sidebar" id="company{{$title}}">
                                    <label for="company{{$title}}">{{$title}}</label>

                                    <span>({{ intval($count) }})</span>

                                </li>
                            </ul>
                        @endforeach
                        @if(count($all_filters['company'])>6)
                            <a href="javascript:void(0);" class="more" data-toggle="modal"
                               data-target="#company-modal"
                               data-original-title=""><i class="fa fa-plus"></i> بیشتر</a>
                        @endif
                    </div>
                </div>

                <!--<div class="people-forms-fields-group">-->
                <!--    جدیدترین-->
                <!--    <label class="switch">-->
            <!--        @if(isset($_GET['sortby']))-->
            <!--        <input type="checkbox" {{($_GET['sortby']=="newest"?' checked ':'')}} id="sortby"-->
                <!--        name="sortby">-->
                <!--        @else-->
                <!--        <input type="checkbox" checked id="sortby" name="sortby">-->
                <!--        @endif-->
                <!--        <span class="slider round"></span>-->
                <!--    </label>-->
                <!--    پربازدیدترین-->
                <!--</div>-->
            </div>
            {{Form::close()}}
        </div>


        </div>
    </div>


    <div class="container mt-7 c-relative">
        <div class="col-md-12">
            <fieldset class="mb-4">
                <legend class="font-16">آخرین فرصت های شغلی</legend>
            </fieldset>
            <div class="owl-carousel owl-theme dir-ltr home-carousel">
                @foreach($jobs as $job)
                    <div class="item">
                        <div class="col-md-12 pr-0 pl-0 item-job-into">
                            <a href="{{route('jobs.show',$job->persian_alias)}}">
                                <div class="item-job-img">
                                    <img class="img-fluid" src="{{$job->company->get_gig_data()['logo']}}"
                                         alt="{{$job->title}}:{{$job->company->name}}">
                                </div>
                                <hr>
                                <h5 class="item-job-title">{{$job->title}}</h5>
                                <div class="item-job-target">{{ HTML::image('/site/'.config('app.site_theme').'/Template_2019/img/target.svg') }}
                                    <span class="type-jobs color{{$job->cooperation_type}}-timejob-grid">{{$job->company->name}}</span>
                                </div>
                                <div class="item-job-location">{{ HTML::image('/site/'.config('app.site_theme').'/Template_2019/img/Location.svg') }}
                                    <span>
                            @php
                                $city_count=\HR\City::all()->count();
                                $cities = $job->cities->count();
                                if($cities == $city_count)
                                    echo 'کل کشور';
                                elseif($cities > 1)
                                    echo 'شهرهای متعدد';
                                else
                                {
                                    echo $job->cities->first()->province->name;
                                }
                            @endphp
                        </span></div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <fieldset class="mb-5 w-100">
                <legend>
                    <a class="btn o-btn p-2 pr-3 pl-3" href="{{route('site.jobs.index')}}">مشاهده فرصت های شغلی
                        بیشتر</a>
                </legend>
            </fieldset>
        </div>
    </div>
@endif

<div class="container sec-4 mt-7 text-center">
    <div class="col-md-12">
        <fieldset class="mb-4">
            <legend class="font-16">فرایند جذب نیرو</legend>
        </fieldset>
    <?= '<img data-src="/site/'.config("app.site_theme").'/Template_2019/img/Process.svg" class="lazy mt-3 full-width" >' ?>
    </div>
</div>


<div class="mt-7 clearfix sec-5  c-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="owl-carousel2 owl-theme dir-ltr">
                    @foreach(\HR\OthersSay::all() as $qoute)
                        <div class="item text-center">
                            <h4 class="font-weight-normal span-rtl-13 mt-5 title-txt-slider">{{$qoute->name}} {{$qoute->post}} از
                                شرکت {{$qoute->company}}</h4>
                            <span class="font-13 span-rtl-13 d-block text-muted font-weight-light text-right mb-4">{!! strip_tags($qoute->body) !!}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4 d-lg-block d-md-none d-sm-none d-none">
                <?= '<img data-src="/site/'.config("app.site_theme").'/Template_2019/img/Group 108.svg" class="lazy sec-5-illue" >' ?>
            </div>
        </div>
        <div class="sec-5-right-img d-lg-block d-md-none d-sm-none d-none">
           <?= '<img data-src="/site/'.config("app.site_theme").'/Template_2019/img/Group 168.svg" class="lazy" >' ?>
        </div>
    </div>
</div>

<div class="container mt-7">
    <div class="col-md-12">
        <fieldset class="mb-4">
            <legend class="font-16">رویدادها</legend>
        </fieldset>
        <div class="owl-carousel owl-theme dir-ltr home-carousel">

            @foreach($contents as $content)
                <div class="item">
                    <div class="col-md-12 pl-0 pr-0">
                        @if($content->cat_id == 9)
                            <a href="{{route('site.news.show',$content->alias)}}">
                                <img src="/{{$content->xxl_image}}" alt=""
                                     class="lazy radius-7 {{($i%2)?'fr-img': 'fl-img'}}">
                                <span class="font-13 text-dark text-right d-block mt-3">{{$content->title}}</span>
                            </a>
                        @elseif($content->cat_id == 11)
                            <a href="{{route('site.blog.show',$content->alias)}}">
                                <img src="/{{$content->xxl_image}}" alt=""
                                     class="lazy radius-7 {{($i%2)?'fr-img': 'fl-img'}}">
                                <span class="font-13 text-dark text-right d-block mt-3">{{$content->title}}</span>
                            </a>
                        @else
                            <a href="{{route('site.events.show',$content->alias)}}">
                                <img src="/{{$content->xxl_image}}" alt=""
                                     class="lazy radius-7 {{($i%2)?'fr-img': 'fl-img'}}">
                                <span class="font-13 text-dark text-right d-block mt-3">{{$content->title}}</span>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

<footer class="mt-7">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-right font-14 mb-4">
                <div class='title-footer'>
                    {{ Html::image('/site/'.config('app.site_theme').'/Template_2019/img/placeholder (3).svg') }}
                    <span>دفتر مرکزی</span>
                </div>
                <hr>
                <div>تهران، خیابان ولیعصر، ضلع شمالی پارک ساعی، خیابان ساعی یکم، پلاک ۱</div>
                <div class="mt-3">
                    <span>مسیریابی</span>
                    <a href="https://www.waze.com/ul?ll=35.73828470%2C51.41003300&navigate=yes" >{{ HTML::image('/site/'.config('app.site_theme').'/Template_2019/img/Mask Group 14.png') }}</a>
                    <a href="https://goo.gl/maps/GY3aMAhKAoPmEe1P9" >{{ HTML::image('/site/'.config('app.site_theme').'/Template_2019/img/Mask Group 15.png') }}</a>
                </div>
            </div>
            <div class="col-md-4 text-right font-14 mb-4">
                <div class='title-footer'>
                    {{ Html::image('/site/'.config('app.site_theme').'/Template_2019/img/placeholder (3).svg') }}
                    <span>تماس با ما</span>
                </div>
                <hr>
                <div class="row contact-info">
                    <div class="col-md-6">دفتر مرکزی : <a href="tel:02142661000">42661000 </a></div>
                    <div class="col-md-5">فکس : <a href="tel:02142661111 ">42661111 </a></div>
                </div>
                <div class="font-13 mt-2 time-working">( شنبه تا چهارشنبه : ۸ تا ۱۶ پنجشنبه : ۸ تا ۱۳ )</div>
                <div class="home-sn">
                    <span>به ما بپیوندید</span>
                    <a href="https://www.instagram.com/golrang_people/" target="_blank"><img class="lazy"
                                                                                             src="/site/default/Template_2019/img/instagram-icon.png" alt="golrang_people"
                                                                                             title="golrang_people" width="35px"></a>
                    <a href="https://www.linkedin.com/in/golrang-people-718430127/" target="_blank"><img class="lazy"
                                                                                                         src="/site/default/Template_2019/img/linkdin-icon.png" alt="golrang_people"
                                                                                                         title="golrang_people" width="35px"></a>
                </div>
            </div>
            <div class="col-md-4 logo-footer">
                {{ HTML::image('/site/'.config('app.site_theme').'/Template_2019/img/golrang-logo.png', '', array('class' => 'mt-4')) }}
            </div>
        </div>
    </div>
</footer>

    <!--model more-->
    <div class="modal fade" id="province-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="clearfix modal-body">
                    <h4 class="modal-title">استان</h4>
                    <div class="skin-section half-width">
                        <ul class="list">
                            @foreach ( array_slice($all_filters['province'],6,count($all_filters['province'])) as $title => $count )
                                <li>
                                    <input
                                            @if(!is_null(request('province')))
                                            {{(in_array($title,request('province'))?' checked ':'')}}
                                            @endif
                                            data-filter_name="province[]={{$title}}"
                                            type="checkbox" value="{{$i}}" class="input-sidebar">
                                    <label for="minimal-checkbox-1">{{$title}}</label>

                                    <span>({{intval($count)}})</span>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--model more-->
    <div class="modal fade" id="skills-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="clearfix modal-body">
                    <h4 class="modal-title">تخصص</h4>
                    <div class="skin-section half-width">
                        <ul class="list">
                            @foreach ( array_slice($all_filters['department'],6,count($all_filters['department'])) as $title => $count )
                                <li>
                                    <input
                                            @if(!is_null((request('department'))))
                                            {{(in_array($title,request('department'))?' checked ':'')}}
                                            @endif
                                            type="checkbox" data-filter_name="department[]={{$title}}"
                                            value="{{$i}}" class="input-sidebar">
                                    <span for="">{{$title}}</span>

                                    <span>({{intval($count)}})</span>

                                </li>
                            @endforeach
                        </ul>
                        {{--<button type="button" class="save">ثبت</button>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--model more-->
    <div class="modal fade" id="industry-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="clearfix modal-body">
                    <h4 class="modal-title">صنعت</h4>
                    <div class="skin-section half-width">
                        <ul class="list">
                            @foreach ( array_slice($all_filters['industry'],6,count($all_filters['industry'])) as $title => $count )
                                <li>
                                    <input
                                            @if(!is_null(request('industry')))
                                            {{(in_array($title,request('industry'))?' checked ':'')}}
                                            @endif
                                            type="checkbox" data-filter_name="industry[]={{$title}}"
                                            value="{{$i}}" class="input-sidebar">
                                    <span for="">{{$title}}</span>

                                    <span>({{intval($count)}})</span>

                                </li>
                            @endforeach
                        </ul>
                        {{--<button type="button" class="save">ثبت</button>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--model more-->
    <div class="modal fade" id="company-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="clearfix modal-body">
                    <h4 class="modal-title">شرکت</h4>
                    <div class="skin-section half-width">
                        <ul class="list">
                            @foreach ( array_slice($all_filters['company'],6,count($all_filters['company'])) as $title => $count )
                                <li>
                                    <input
                                            @if(!is_null(request('company')))
                                            {{(in_array($title,request('company'))?' checked ':'')}}
                                            @endif
                                            type="checkbox" data-filter_name="company[]={{$title}}"
                                            value="{{$i}}" class="input-sidebar">
                                    <span for="">{{$title}}</span>

                                    <span>({{intval($count)}})</span>

                                </li>
                            @endforeach
                        </ul>
                        {{--<button type="button" class="save">ثبت</button>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="WarningModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body" style="text-align: center;direction:rtl;border:0;">
                    <h4 class="modal-title"><i class="fa fa-warning" style="color:#FF6D6E;"></i> توجه</h4>
                    <p>
                        برای افزودن به لیست علاقمندی های خود، باید ثبت نام و سپس وارد شوید.</p>
                    <br>
                </div>
            </div>
        </div>
    </div>
@section('script')

    {{ Html::script('/site/'.config('app.site_theme').'/js/jquery.easing.min.js',['async' => 'async']) }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/alertify.min.js',['async' => 'async']) }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/inputmask.binding.js',['async' => 'async']) }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/jquery.inputmask.bundle.js',['async' => 'async']) }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/phone.js',['async' => 'async']) }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/phone-uk.js',['async' => 'async']) }}
    <script>

        $("#mobile").on("keypress keyup blur", function (event) {
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
            } else {
                $('#help_password_length').html('');
                is_form_validated = true;
            }
        });

        //check passwords are same
        $(".password_confirmation_check").bind('input propertychange', function () {
            if ($("#password_confirmation").val() !== $("#password_field").val()) {
                $('#help_password_confirmation_same').html('رمز عبور و تکرار آن مطابقت ندارند');
                is_form_validated = false;
            } else {
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

<div class="container copyright">کپی رایت © ۲۰۱۹ همه حقوق محفوظ است. طراحی و پیاده سازی
    توسط <a href="http://golrangsystem.com" target="_blank"> گلرنگ سیستم </a>
</div>

{{ Html::script('/site/'.config('app.site_theme').'/Template_2019/js/jquery-3.4.1.min.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/Template_2019/js/jquery.lazy.min.js') }}
<script>
    $(document).ready(function () {
        $('.lazy').Lazy();
    });
</script>
{{ Html::script('/site/'.config('app.site_theme').'/Template_2019/js/owl.carousel.min.js',['async' => 'async']) }}
{{ Html::script('/site/'.config('app.site_theme').'/Template_2019/js/jquery.fancybox.min.js',['async' => 'async']) }}
{{ Html::script('/site/'.config('app.site_theme').'/Template_2019/js/popper.min.js',['async' => 'async']) }}
{{ Html::script('/site/'.config('app.site_theme').'/Template_2019/js/bootstrap.min.js',['async' => 'async']) }}
{{ Html::script('/site/'.config('app.site_theme').'/Template_2019/js/parallax.min.js',['async' => 'async']) }}
{{ Html::script('/site/'.config('app.site_theme').'/Template_2019/js/main.js?v='.time(),['async' => 'async']) }}
</body>
</html>