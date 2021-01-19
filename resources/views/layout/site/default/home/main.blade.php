<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Golrang Human Resource :: سامانه منابع انسانی</title>
    <meta name="description" content="Golrang Human Resource">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="author" content="Golrang System">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    {{ Html::style('/site/'.config('app.site_theme').'/css/bootstrap.css') }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/font-awesome.min.css') }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/animate.css') }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/owl.carousel.css') }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/owl.theme.default.css') }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/main.css') }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/fontiran.css') }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/cubeportfolio.min.css') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/vendor/modernizr-2.8.3.min.js') }}

</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<header class="cd-main-header">
    <a class="cd-logo" href="{{route('home')}}"><img src="/site/default/img/logo.png?v=2" alt="Logo"></a>
    <ul class="cd-header-buttons">
        <li><a class="cd-search-trigger" href="#cd-search"><span></span></a></li>
        <li><a class="cd-nav-trigger" href="#cd-primary-nav"><span></span></a></li>
    </ul>
    <div class="hidden-xs hidden-sm social-networks-menu">
        <a href="#"><img src="/site/{{config('app.site_theme')}}/img/hr_instagram.png" alt="" title="" width="17" height="17"></a>
        <a href="#"><img src="/site/{{config('app.site_theme')}}/img/hr_telegram.png" alt="" title="" width="17" height="17"></a>
        <a href="#"><img src="/site/{{config('app.site_theme')}}/img/hr_linked.png" alt="" title="" width="17" height="17"></a>
        <span> |

        @if(Auth::check())

                خوش آمدید
                <strong>{{Auth::user()->first_name}}</strong>
            @else
                <a href="#" title="" data-toggle="modal" data-target="#login-modal" data-original-title="" class="login-link"><img src="/site/default/img/hr_profile.png" alt="" title="" width="17" height="17"> <span> ورود </span></a>
            @endif
        </span>
    </div>
</header>

<div id="pagepiling" class="cd-main-content">

    @include('layout/site/'.config('app.site_theme').'/home-section-1')
    @include('layout/site/'.config('app.site_theme').'/home-section-2')
    @include('layout/site/'.config('app.site_theme').'/home-section-3')
    @include('layout/site/'.config('app.site_theme').'/home-section-4')
    @include('layout/site/'.config('app.site_theme').'/home-section-5')
    @include('layout/site/'.config('app.site_theme').'/home-footer')

</div>
<div class="cd-overlay"></div>

@include('layout/site/'.config('app.site_theme').'/home-nav')


<a class="cd-top cd-is-visible cd-fade-out" href="#top"></a>
<!--model register-->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">




                <button type="button" class="close-form" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><img src="/site/default/img/profile_login.png" title="" alt="" width="50"><span> ورود</span></h2><br>

                {{ Form::open(array('route' => 'login')) }}

                    {{csrf_field()}}

                    {{ Form::label('mobile', 'موبایل',array('class' => 'rtl-input')) }}
                    {{ Form::text('mobile', null, array('class' => 'form-control')) }}
                    <br>
                    {{ Form::label('password', 'رمزعبور',array('class' => 'rtl-input')) }}
                    {{ Form::password('password', null, array('class' => 'form-control')) }}
                    <br>
                    {{ Form::submit('ورود', array('class' => 'btn btn-primary')) }}

                {{Form::close()}}

                <div class="login-help">
                    <a href="#"> عضویت </a>  |  <a href="#"> فراموشی رمز عبور </a>
                </div>

        </div>
    </div>
</div>
{{ Html::script('/site/'.config('app.site_theme').'/js/vendor/jquery-1.12.0.min.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/bootstrap.min.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/validator.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/classie.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/plugins.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/reveal-animate.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/wow.min.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/owl.carousel.min.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/cubeportfolio.min.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/jquery.easing.min.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/jquery.mobile.custom.min.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/jquery.pagepiling.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/main.js') }}

<script type="text/javascript">
    $('.jobs-carousel').owlCarousel({
        loop:false,
        margin:30,
        autoplay: true,
        nav:true,
        navText: ["", ""],
        autoplayTimeout: 4000,
        responsiveClass:true,
        responsive:{
            0:{
                items:1
            },
            480:{
                items:2
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });
    (function() {
        // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
        if (!String.prototype.trim) {
            (function() {
                // Make sure we trim BOM and NBSP
                var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                String.prototype.trim = function() {
                    return this.replace(rtrim, '');
                };
            })();
        }

        [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
            // in case the input is already filled..
            if( inputEl.value.trim() !== '' ) {
                classie.add( inputEl.parentNode, 'input--filled' );
            }

            // events:
            inputEl.addEventListener( 'focus', onInputFocus );
            inputEl.addEventListener( 'blur', onInputBlur );
        } );

        function onInputFocus( ev ) {
            classie.add( ev.target.parentNode, 'input--filled' );
        }

        function onInputBlur( ev ) {
            if( ev.target.value.trim() === '' ) {
                classie.remove( ev.target.parentNode, 'input--filled' );
            }
        }
    })();
    $('.validation-form').validator()
</script>
</body>
</html>
