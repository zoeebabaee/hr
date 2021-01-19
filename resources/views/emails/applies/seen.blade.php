<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="charset" content="utf-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.0" user-scalable="yes">
    <title>سامانه منابع انسانی گروه صنعتی گلرنگ</title>
</head>
<body>

<div style="background:#fff;" width="100%" cellspacing="0" cellpadding="0" border="0">
    <div>
        {{--@if(!isset($web) || $web != true)--}}
            {{--<p style="direction: rtl;font-family: Tahoma;font-size: 12px">آیا تصاویر را نمی بینید؟ <a--}}
                        {{--href="{{route('emails.apply_seen', $apply->id)}}">اینجا کلیک--}}
                    {{--کنید...</a></p>--}}
        {{--@endif--}}
        <div id="primary" class="main demo" style="min-height:617px;" width="100%" valign="top" align="center">
            <div class="column ui-sortable">
                <div class="lyrow ui-draggable" style="display:block;">
                    <div class="view">
                        <div class="row clearfix">
                            <div class="" style="padding:10px 0; background-color:#782E3B" align="center">
                                <img style="display:block;max-width:180px;" alt=""
                                     src="https://golrang.com/img/hr-logo.png"
                                     border="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lyrow ui-draggable" style="display:block;">
                    <div class="view">
                        <div class="row clearfix">
                            <div class="main" style="background-color:rgb(255,255,255);display:block;"
                                 data-type="text-block" width="100%" cellspacing="0" cellpadding="0" border="0"
                                 align="center">
                                <div class="block-text" data-clonable="true"
                                     style="padding:10px 50px 10px 50px;font-family:calibri;font-size:16px;color:#000000;line-height:22px;text-align:center;">
                                    <p style="text-align:right; padding:14px; direction:rtl;margin-top:10px;margin-bottom:10px;">
                                        {{$apply->user->first_name}} عزیز، سلام
                                    </p>
                                    <p style="text-align:right; padding:14px; direction:rtl;margin-top:5px;margin-bottom:10px;">
                                        ضمن تشکر از تمایل شما به همکاری با گروه صنعتی گلرنگ، به استحضار می رساند بررسی
                                        اولیه درخواست شما برای فرصت شغلی «<strong>{{$apply->job->title}}</strong>
                                        در <strong>{{$apply->job->company->name}}</strong>» انجام و جهت ارزیابی به مدیریت ارجاع داده شده
                                        است.
                                    </p>
                                    <p style="text-align:right; padding:14px; direction:rtl;margin-top:5px;margin-bottom:10px;">
                                        در انتظار اطلاعیه بعدی ما باشید.
                                    </p>
                                    <p style="text-align:right; padding:14px; direction:rtl;margin-top:5px;margin-bottom:0px;">
                                        به امید موفقیت
                                        <br>
                                        دپارتمان منابع انسانی گروه صنعتی گلرنگ
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lyrow ui-draggable" style="display:block;">
                <div class="view">
                    <div class="row clearfix">
                        <div class="social"
                             style="padding:15px 50px 15px 50px;text-decoration: none;background-color: #333"
                             align="center">
                            <p style="color: #fff;font-family: calibri;direction: rtl"> سامانه منابع انسانی را در
                                شبکه های اجتماعی دنبال کنید:</p>
                            <a href="https://www.linkedin.com/company-beta/11221296"
                               style="border:none;text-decoration: none;" class="linkedin">
                                <img src="https://golrang.com/img/linkedin.png"
                                     width="32px" height="32px" border="0">
                            </a><a href="https://www.instagram.com/golrang_people/" style="border:none;"
                                   class="instagram">
                                <img src="https://golrang.com/img/instagram.png"
                                     width="32px" height="32px" border="0">
                            </a>
                            <p style="color: #fff;font-family: Tahoma;font-size: 12px;direction: rtl"> شما این ایمیل
                                را از طرفما به دلیل ثبت نام در سایت ما دریافت کرده اید.</p>
                            <a style="color: #ff8c3f;font-weight: bold;font-family: Tahoma;font-size: 12px;direction: rtl"
                               href="">لغو اشتراک</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>