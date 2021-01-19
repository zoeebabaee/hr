<!doctype html>
<html class="no-js" lang="">
<head>
    @yield('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="keywords" content="">
    <meta name="Resource-type" content="Document" />
    <meta name="description" 
content="درخواست همکاری در مجموعه بزرگ گروه صنعتی گلرنگ در حوزه های متنوع و تخصصی از طریق ثبت نام و تکمیل رزومه در سامانه منابع انسانی"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta name="author" content="www.golrangsystem.com">
    <meta property="og:title" content="سامانه منابع انسانی گروه صنعتی گلرنگ"/>
    <meta property="og:image" content="https://people.golrang.com/og.png"/>
    <meta property="og:description "
content="درخواست همکاری در مجموعه بزرگ گروه صنعتی گلرنگ در حوزه های متنوع و تخصصی از طریق ثبت نام و تکمیل رزومه در سامانه منابع انسانی"/>
    <link href="/favicon.ico" rel="shortcut icon"/>
    {{ Html::style('/site/'.config('app.site_theme').'/Template_2019/css/bootstrap.min.css',['async' => 'async']) }}
    {{ Html::style('/site/'.config('app.site_theme').'/Template_2019/css/owl.carousel.css',['async' => 'async']) }}
    {{ Html::style('/site/'.config('app.site_theme').'/Template_2019/css/owl.theme.default.css',['async' => 'async']) }}
    {{ Html::style('/site/'.config('app.site_theme').'/Template_2019/css/style.css?v='.time()) }}
    {{ Html::style('/css/jquery.fancybox.min.css') }}
    @yield('custom_css')
    {{ Html::style('/site/'.config('app.site_theme').'/css/font-awesome.min.css',['async' => 'async']) }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/animate.css',['async' => 'async']) }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/flat/_all.css',['async' => 'async']) }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/cubeportfolio.min.css',['async' => 'async']) }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/intro.css',['async' => 'async']) }}
    <!--[if IE]>
    <script type="text/javascript">
        var console = { log: function() {} };
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
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-112435217-3');
    </script>
    
    {{ Html::style('/admin/'.config('app.admin_theme').'/jalalicalendar/skins/calendar-blue.css',['async' => 'async']) }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/jalali.js',['async' => 'async']) }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/calendar.js',['async' => 'async']) }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/calendar-setup.js',['async' => 'async']) }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/lang/calendar-fa.js',['async' => 'async']) }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/vendor/modernizr-2.8.3.min.js',['async' => 'async']) }}
    
    <!-- Hotjar Tracking Code for people.golrang.com -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1877196,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
    
</head>
<body class="innerpage">

@include('layout.site.default.global.header')

@include('layout.site.default.global.navbar')

@yield('content')


@include('layout.site.default.global.footer')

{{ Html::script('/js/jquery-3.2.1.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/classie.js',['async' => 'async']) }}
{{ Html::script('/site/'.config('app.site_theme').'/js/plugins.js',['async' => 'async']) }}
{{ Html::script('/site/'.config('app.site_theme').'/js/reveal-animate.js',['async' => 'async']) }}
{{ Html::script('/site/'.config('app.site_theme').'/js/wow.min.js',['async' => 'async']) }}
{{ Html::script('/site/'.config('app.site_theme').'/js/cubeportfolio.min.js',['async' => 'async']) }}
{{ Html::script('/site/'.config('app.site_theme').'/js/jquery.easing.min.js',['async' => 'async']) }}
{{ Html::script('/site/'.config('app.site_theme').'/js/jquery.pagepiling.js',['async' => 'async']) }}
{{ Html::script('/site/'.config('app.site_theme').'/js/icheck.min.js',['async' => 'async']) }}
{{ Html::script('/site/'.config('app.site_theme').'/js/intro.js',['async' => 'async']) }}
{{ Html::script('/site/'.config('app.site_theme').'/Template_2019/js/owl.carousel.min.js',['async' => 'async']) }}
{{ Html::script('/js/jquery.fancybox.min.js',['async' => 'async']) }}
{{ Html::script('/js/popper.min.js',['async' => 'async']) }}
{{ Html::script('/js/bootstrap.min.js',['async' => 'async']) }}
{{ Html::script('/site/'.config('app.site_theme').'/Template_2019/js/main.js?v='.time(),['async' => 'async']) }}


@yield('script')

{{ Html::script('/site/'.config('app.site_theme').'/js/form-validator/form-validator/jquery.form-validator.min.js') }}


<script>

        $(document).ready(function () {
            //if($('.input-sidebar'))  {
                //$('.input-sidebar').iCheck({
                 //   checkboxClass: 'icheckbox_flat-red',
                 //   radioClass: 'iradio_flat-red'
               // });
            //}
            $(document).click(function (){
                $('.bg-error').remove();
            });

           // $('#login_ajax_modal').submit(function (event){

            //});

        });

        $(function() {

            $.validate({
                modules : 'date',
                lang:'fa'
            });
        });
        
/*                $( ".store_ticket" ).one( "click", function() {
*/                $( ".store_ticket" ).on( "click", function() {

        
            var email                   = $('#email').val();
            var ticket_type             = $('#ticket_type').val();
            var company_name            = $('#company_name').val();
            var tec_problem_detail      = $('#tec_problem_detail').val();
            var resume_more_details     = $('#resume_more_details').val();
            var suggestion_more_details = $('#suggestion_more_details').val();
            var defect_details          = $('#defect_details').val();
            var captcha                 = $('#captcha').val();

            if(ticket_type == 'technical_problem_box')
                var data = "email="+email+"&detail="+tec_problem_detail+"&ticket_type="+ticket_type+"&captcha="+captcha;

            else if(ticket_type == 'review_user_resume_box')
                var data = "email="+email+"&detail="+resume_more_details+"&ticket_type="+ticket_type+"&company_name="+company_name+"&captcha="+captcha;

            else if(ticket_type == 'suggestions_box')
                var data = "email="+email+"&detail="+suggestion_more_details+"&ticket_type="+ticket_type+"&captcha="+captcha;  
            else if(ticket_type == 'defect_information_box')
                var data = "email="+email+"&detail="+defect_details+"&ticket_type="+ticket_type+"&captcha="+captcha;

            $.ajax({
                type:'POST',
                url:"/adpanel/support-tickets/store",
                data:data+"&_token=<?=csrf_token();?>",
                success:function(res) {

                   
            $('#basicSupportModal').modal('hide');
        
                    
            $('#email').val('');
            $("#ticket_type").val($("#ticket_type option:first").val());
            $('#company_name').val('');
            $('#tec_problem_detail').val('');
            $('#resume_more_details').val('');
            $('#suggestion_more_details').val('');
            $('#defect_details').val('');
            $('#captcha_login_1').attr('src', '{{route('site.captcha','support_ticket_captcha')}}?ver='+(new Date()).getTime());

            if($.isNumeric(res))
            {

             alert('کاربر گرامی تیکت شما با موفقیت درج شد شماره پیگیری : '+res);
            }
             
             else
             {
                   alert(res)
             }
             }
            });
        })

$( "#open_modal" ).click(function() {
    
/*    ="defect_information_box"
*/    ticket_type = $(this).attr("data-tickettype"); 
      $('#ticket_type').val(ticket_type).prop('selected', true);

       $('#'+ticket_type).siblings('.support_hide').hide();
       $('#'+ticket_type).show();

});
        
          function checkCodeMeli(input) {
            if (!/^\d{10}$/.test(input)
                || input == '0000000000'
                || input == '1111111111'
                || input == '2222222222'
                || input == '3333333333'
                || input == '4444444444'
                || input == '5555555555'
                || input == '6666666666'
                || input == '7777777777'
                || input == '8888888888'
                || input == '9999999999')
                return false;
            var check = parseInt(input[9]);
            var sum = 0;
            var i;
            for (i = 0; i < 9; ++i) {
                sum += parseInt(input[i]) * (10 - i);
            }
            sum %= 11;
            return (sum < 2 && check == sum) || (sum >= 2 && check + sum == 11);
        }
        
      $(".toggle-password").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $(this).parent().next('input.people-forms-fields');
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });


    </script>


</body>
</html>
