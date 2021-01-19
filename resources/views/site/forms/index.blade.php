<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>چهارمین نمایشگاه خانواده فناوری شریف</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="www.golrangsystem.com">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="icon" href="favicon.ico" type="image/png">

    <link rel="stylesheet" href="/site/form/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/site/form/css/main.css">
    <link rel="stylesheet" href="/site/form/css/chosen.min.css">
    <script src="/site/form/js/vendor/modernizr-2.8.3.min.js"></script>
    <style>
        /* Toast Styles */
        #toast-message {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
            direction: rtl;
        }
        #toast-message.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }
        @-webkit-keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }
        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }
        @-webkit-keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }
        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }

    </style>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->


<div class="container mt-100">

    <div class="col-xs-12 no-padd no-padd-xs">
        <div class="col-md-7">
            @if(Session::has('flash_message'))
                <div class="bg-success" id="flash_message" style="text-align: right">
                    <span style="cursor: pointer" onclick="$('#flash_message').remove()"><i class="fa fa-remove"></i></span>
                    <p style="direction: rtl" >{!! session('flash_message') !!}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-6 logo-img">
                    <img src="/site/form/img/golrangsystem.png" alt="" title="" class="img-responsive">
                </div>
                <div class="col-xs-6 logo-img">
                    <img src="/site/form/img/Sharif.png" alt="" title="" class="img-responsive">
                </div>
            </div>
            <div class="row wrapper-form">
                <h1>چهارمین نمایشگاه خانواده فناوری شریف</h1>
                <p>لطفا تمام موارد زیر را تکمیل کنید</p>
                <hr>
                <form class="form-horizontal" action="{{route('forms.store')}}" enctype="multipart/form-data"
                      method="POST">
                    <div class="row">
                        <div class="col-md-6 no-padd no-padd-xs form-group">
                            <label class="col-md-12 control-label" for="name">نام و نام خانوادگی</label>

                            <div class="col-md-12">
                                <input class="form-control input-md"
                                       value="{{old('name')}}"
                                       name="name" type="text"
                                       id="name"
                                       required="true"
                                       oninvalid="$('#name_help').html('لطفا نام و نام خانوادگی خود را وارد کنید.');this.setCustomValidity(' ')"
                                       oninput="setCustomValidity('')"
                                       onkeyup="$('#name_help').html('')"
                                       maxlength="255"
                                >
                                @if ($errors->has('name'))
                                    <span id="name_help" class="help-block">{{$errors->first('name')}}</span>
                                @else
                                    <span id="name_help" class="help-block"></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 no-padd no-padd-xs form-group">
                            <label class="col-md-12 control-label" for="request_type">نوع درخواست</label>
                            <div class="col-md-12">
                                <select id="request_type"
                                        required="true"
                                        oninvalid="$('#request_type_help').html('لطفا نوع درخواست را انتخاب فرمایید.');this.setCustomValidity(' ')"
                                        onchange="setCustomValidity('')"
                                        name="request_type[]"
                                        data-placeholder="نوع درخواست همکاری انتخاب کنید"
                                        multiple class="chosen-select">
                                    <option value="همکاری"
                                            @if(old('request_type') && in_array('همکاری', old('request_type'))) selected @endif>
                                        همکاری
                                    </option>
                                    <option value="مشاوره"
                                            @if(old('request_type') && in_array('مشاوره', old('request_type'))) selected @endif>
                                        مشاوره
                                    </option>
                                    <option value="کارآموزی"
                                            @if(old('request_type') && in_array('کارآموزی', old('request_type'))) selected @endif>
                                        کارآموزی
                                    </option>
                                    <option value="اسپانسری"
                                            @if(old('request_type') && in_array('اسپانسری', old('request_type'))) selected @endif>
                                        اسپانسری
                                    </option>
                                    <option value="طرح‌های پیشنهادی"
                                            @if(old('request_type') && in_array('طرح‌های پیشنهادی', old('request_type'))) selected @endif>
                                        طرح‌های پیشنهادی
                                    </option>
                                    <option value="عضویت در گروه سفیران سازمانی تغییر"
                                            @if(old('request_type') && in_array('عضویت در گروه سفیران سازمانی تغییر', old('request_type'))) selected @endif>
                                        عضویت در گروه سفیران سازمانی تغییر
                                    </option>
                                </select>
                                @if ($errors->has('request_type'))
                                    <span id="request_type_help"
                                          class="help-block">{{$errors->first('request_type')}}</span>
                                @else
                                    <span id="request_type_help" class="help-block"></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 no-padd no-padd-xs form-group">
                            <label class="col-md-12 control-label" for="email">ایمیل</label>
                            <div class="col-md-12">
                                <input required="true"
                                       id="email"
                                       value="{{old('email')}}"
                                       oninvalid="$('#email_help').html('لطفا ایمیل خود را وارد کنید.');this.setCustomValidity(' ')"
                                       oninput="setCustomValidity('')"
                                       onkeyup="$('#email_help').html('')"
                                       name="email" type="email"
                                       placeholder="sample@gmail.com" class="form-control input-md ltr">
                                @if ($errors->has('email'))
                                    <span id="email_help" class="help-block">{{$errors->first('email')}}</span>
                                @else
                                    <span id="email_help" class="help-block"></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 no-padd no-padd-xs form-group">
                            <label class="col-md-12 control-label" for="mobile">شماره همراه</label>
                            <div class="col-md-12">
                                <input id="mobile"
                                       required="true"
                                       pattern="[0۰٠][9۹٩][۰۱۲۳۴۵۶۷۸۹0123456789٠١٢٣٤٥٦٧٨٩]{9}"
                                       oninvalid="$('#mobile_help').html('لطفا شماره موبایل خود را با فرمت صحیح وارد فرمایید.');this.setCustomValidity(' ')"
                                       oninput="setCustomValidity('')"
                                       onkeyup="$('#mobile_help').html('')"
                                       name="mobile" type="tel"
                                       value="{{old('mobile')}}"
                                       placeholder="0912 - - - - - - -"
                                       maxlength="11"
                                       class="form-control input-md ltr">
                                @if ($errors->has('mobile'))
                                    <span id="mobile_help" class="help-block">{{$errors->first('mobile')}}</span>
                                @else
                                    <span id="mobile_help" class="help-block"></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-pull-6 no-padd no-padd-xs form-group">
                            <label class="col-md-12 control-label" for="description">زمینه همکاری / توضیحات</label>
                            <div class="col-md-12">
                                <textarea
                                        oninvalid="$('#description_help').html('لطفا زمینه همکاری / توضیحات را وارد فرمایید.');this.setCustomValidity(' ')"
                                        oninput="setCustomValidity('')"
                                        onkeyup="$('#description_help').html('')"
                                        class="form-control rtl txtarea" required="true" id="description"
                                        name="description" placeholder="متن پیام شما">{{old('description')}}</textarea>
                                @if ($errors->has('description'))
                                    <span id="description_help" class="help-block">{{$errors->first('description')}}</span>
                                @else
                                    <span id="description_help" class="help-block"></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 col-md-push-6 no-padd no-padd-xs form-group">
                            <div class="clearfix">
                                <label class="col-md-12 control-label" for="resume">فایل رزومه <span class="help-block" style="display: inline-block">(pdf، jpeg, png)</span></label>
                                <div class="col-md-12">
                                    <div class="upload-btn-wrapper">
                                        <button  type="button"><img src="/site/form/img/upload.png" alt="" title="">فایل مورد نظر
                                            را انتخاب نمایید
                                        </button>
                                        <input required="true"
                                               oninvalid="$('#resume_help').html('لطفا فایل رزومه خود را آپلود فرمایید.');this.setCustomValidity(' ')"
                                               oninput="setCustomValidity('')"
                                               onchange="$('#resume_help').html('')"
                                               type="file" name="resume" id="resume"/>
                                        @if ($errors->has('resume'))
                                            <span id="resume_help" class="help-block">{{$errors->first('resume')}}</span>
                                        @else
                                            <span id="resume_help" class="help-block"></span>
                                        @endif
                                    </div>
                                </div>
                                <label class="col-md-12 control-label"
                                       for="captcha">
                                    تصویر امنیتی
                                </label>
                                <div class="col-md-12">
                                    <input required="true" id="captcha" name="captcha" type="text"
                                           placeholder="تصویر امنیتی زیر را وارد کنید"
                                           autocomplete="off"
                                           oninvalid="$('#captcha_help').html('لطفا تصویر امنیتی را وارد فرمایید.');this.setCustomValidity(' ')"
                                           oninput="setCustomValidity('')"
                                           onkeyup="$('#captcha_help').html('')"
                                           class="form-control input-md ltr">
                                    @if ($errors->has('captcha'))
                                        <span id="captcha_help" class="help-block">{{$errors->first('captcha')}}</span>
                                    @else
                                        <span id="captcha_help" class="help-block"></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 no-padd no-padd-xs form-group">
                            <div class="clearfix">
                                <div class="col-md-12">
                                    <div class="captcha">
                                        <img id="captcha_Contact" src="{{route('site.captcha','form')}}">
                                        <img id="refresh-captcha" src="/site/form/img/refresh.png"
                                             onclick="$('#captcha_Contact').attr('src', '{{route('site.captcha','form')}}?ver='+(new Date()).getTime());">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="wrap-register">
                                <button id="singlebutton" type="submit" name="singlebutton" class="btn btn-register">ثبت
                                    نام
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <div class="wrap-share" onclick="copyToClipboard('https://people.golrang.com/sharif-fair');toastMessage('لینک صفحه کپی شد!')">
                                <span class="title-share">اشتراک گذاری</span>
                                <a style="cursor: pointer" class="btn btn-share">با دیگران به اشتراک میگذارم</a>
                            </div>
                        </div>
                    </div>
                    {{ csrf_field() }}
                </form>
                <p class="copyright">.کلیه حقوق متعلق به شرکت گلرنگ سیستم می باشد © 2018</p>
            </div>
        </div>
        <div class="col-md-5 hidden-sm hidden-xs left-panel">
            <img src="/site/form/img/BG_main.svg" alt="" title="" class="img-responsive" style="position: relative;
                    right: 100px;">
        </div>
    </div>
</div>
<div id="toast-message">Some text some message..</div>
<script>
    function toastMessage(string) {
        var x = document.getElementById("toast-message");
        x.innerHTML = string;
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
</script>
<script src="/site/form/js/vendor/jquery-1.12.0.min.js"></script>
<script src="/site/form/js/bootstrap.min.js"></script>
<script src="/site/form/js/chosen.jquery.min.js"></script>
<script type="text/javascript">
    $(".chosen-select").chosen({width: "100%", rtl: true});
    $('.chosen-select').on('change', function () {
        $('#request_type_help').html('')
    })
    function copyToClipboard(inp) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(inp).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>
</body>
</html>
