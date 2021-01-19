<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>سامانه منابع انسانی گروه صنعتی گلرنگ‌::آگهی</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="www.golrangsystem.com">
    <meta property="og:title" content="{{$job->title}}"/>
    <meta property="og:image" content="{{$gig_data['logo']}}"/>

    <link rel="icon" href="/favicon.ico?v=<?= filemtime('favicon.ico') ?>" type="image/png">

    <link rel="stylesheet" href="/site/companies/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/site/companies/css/fontawesome-all.css"/>
    <link href="/site/companies/css/owl.carousel.min.css" rel="stylesheet">
    <link href="/site/companies/css/owl.theme.default.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/site/companies/css/company.css">



    <script src="/site/companies/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Add your site or application content here -->
<div class="clearfix bg-blue">
    <section class="container wrapper-content1">
        <div class="col-xs-12 job-content no-padd">
            <h1>
                <a href="/company/{{$job->company->id}}/{{$gig_data['url']}}">
                    <img src="{{$gig_data['logo']}}" width="40">
                    شرکت {{$gig_data['title']}}
                </a>
            </h1>
            <div class="clearfix pull-left mt-15">
                @if(Auth::check())
                    @if($job->apply(Auth::user()->id))
                        <button type="button"
                                @if($job->questions->count() || count($cities_for_apply)>1) onclick="$('#questionsModal').modal('show')"
                                @else onclick="$('#apply_form').submit();" @endif  class="request-jobs">درخواست
                            همکاری
                        </button>
                    @else
                        <button type="button" class="request-jobs"><i class="fa fa-check"></i>&nbsp; ثبت شد</button>
                    @endif
                @else
                    <input type="button" class="request-jobs"
                           onclick="$('#modal_message_title').html('پیغام');$('#modal_message_body').html('برای ارسال درخواست برای یک شغل باید وارد سایت شوید');"
                           data-toggle="modal" data-target="#myModal" value="درخواست همکاری">

                @endif

                @if(Auth::check())
                    <a class="btn-jobs pull-left" href="{{route('logout')}}"> خروج <i class="fa fa-sign-out"></i></a>
                    @can('پنل ادمین')
                        <a class="btn-jobs pull-left" href="{{route('adpanel')}}">ادمین <i class="fa fa-gears"></i></a>
                    @endcan
                    <a class="btn-jobs pull-left" href="{{route('site.user.profile')}}">پروفایل <i
                                class="fa fa-user"></i></a>
                @else
                    <a href="/login?job_id={{$job->id}}" target="_blank" class="btn-jobs pull-left">ورود </a>
                    <a href="/register?job_id={{$job->id}}" target="_blank" class="btn-jobs pull-left">عضویت</a>
                @endif
            </div>
        </div>
    </section>
</div>
<div class="clearfix container inner-content">
    <div class="col-xs-12 top-address">
        <div class="col-xs-12 r-address no-padd no-padd-xs">
            <a class="title-timejob" href="">{{$job->cooperation_type_name()}}</a>
            <p><span> مهلت تا : </span><span
                        class="date-jobs">{{JDate::createFromCarbon(Carbon::parse($job->expire_date))->format('l j F Y')}}</span>
            </p>
        </div>
        <br/>
        @if($errors->any())
            <div class="bg-error" style="text-align: right">
                <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                <p style="direction: rtl">{{$errors->first()}}</p>
            </div>

        @endif
    </div>

    <div class="col-xs-12 wrap-content">
        <div class="col-md-6 col-sm-12 col-xs-12 no-padd-r no-padd-xs">
            <div class="clearfix right-jobs">
                @if(isset($job->field) && !is_null($job->field) && !empty($job->field))
                    <div class="col-md-6 col-sm-6 col-xs-12 j-part">
                        <img src="/site/companies/img/1.png" alt="">
                        <div class="clearfix">
                            <h4> مدرک تحصیلی</h4>
                            <h3>{{$job->field}}</h3>
                        </div>
                    </div>
                @endif
                <div class="col-md-6 col-sm-6 col-xs-12 j-part">
                    <img src="/site/companies/img/1.png" alt="">
                    <div class="clearfix">
                        <h4> مدرک تحصیلی</h4>
                        <h3>{{config('app.enum_last_degree')[$job->min_education]}}</h3>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 j-part">
                    <img src="/site/companies/img/4.png" alt="">
                    <div class="clearfix">
                        <h4>صنعت</h4>
                        <h3>{{$job->industry->name}}</h3>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 j-part">
                    <img src="/site/companies/img/5.png" alt="">
                    <div class="clearfix">
                        <h4>جنسیت</h4>
                        <h3>
                            @if($job->gender == 1)
                                {{'مرد'}}
                            @elseif($job->gender == 2)
                                {{'زن'}}
                            @else
                                {{'فرقی نمی کند'}}
                            @endif
                        </h3></div>
                </div>
                @if(isset($job->jobExp) && !is_null($job->jobExp) && !empty($job->jobExp))
                    <div class="col-md-6 col-sm-6 col-xs-12 j-part">
                        <img src="/site/companies/img/2.png" alt="">
                        <div class="clearfix">
                            <h4>سابقه کار</h4>
                            <h3>{{$job->jobExp}}</h3>
                        </div>
                    </div>
                @endif
                <div class="col-md-6 col-sm-6 col-xs-12 j-part">
                    <img src="/site/companies/img/2.png" alt="">
                    <div class="clearfix">
                        <h4>گروه شغلی</h4>
                        <h3>{{$job->department->name}}</h3>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 j-part">
                    <img src="/site/companies/img/3.png" alt="">
                    <div class="wrap-city-job">
                        <h4>استان/استانها</h4>
                        @foreach($cities as $city)
                            <a href="/jobs?province[]={{$city}}" class="city-job"><h3>{{$city}} </h3></a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="clearfix part2-sidebar">
                <div class="clearfix col1-part1">
                    <img src="{{$gig_data['logo']}}" alt="" width="100px" height="100px"
                         class="fr-img">
                    <h2 class="wow animated fadeIn" style="margin-bottom: 10px">{{$gig_data['title']}}</h2>

                    {{--<a href="http//{{$gig_data['web']}}" data-toggle="tooltip"--}}
                    {{--data-original-title="{{$gig_data['title']}}" data-placement="left" target="_blank"><img--}}
                    {{--src="/site/default/img/web.png" alt="" width="20"></a>--}}
                    <div class="two-btn">
                        <a class="r-btn" href="/company/{{$job->company->id}}/{{$gig_data['url']}}">
                            همه مشاغل شرکت</a>
                        @if($job->ticket_id())
                            <a class="l-btn" href="{{route('site.tickets.show', $job->ticket_id())}}">ارتباط با
                                شرکت</a>
                        @else
                            <a class="l-btn" href="" data-toggle="modal" data-target="#contact-modal"
                               data-original-title="">ارتباط با شرکت</a>
                        @endif
                    </div>
                </div>
                <div class="clearfix col1-part2">
                    <div class="owl-carousel owl-theme topslider">
                        @foreach($images as $img)
                            <div class="item"><a><img src="{{$img->url}}" alt=""></a></div>
                        @endforeach
                    </div>
                    <div class="col-md-7 col-sm-12 col-xs-12 ir-address"><p><i class="fa fa-map-marker"></i>
                            <span> دفتر مرکزی  : </span>{{$gig_data['address']}}</p></div>
                    <div class="col-md-5 col-sm-12 col-xs-12 l-address"><p><i class="fa fa-phone"></i> <a
                                    href="tel:982142661000">{{$gig_data['tel']}}</a></p>
                    </div>
                </div>
                <div id="map"></div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 left-jobs no-padd-xs no-padd-l">
            <h3>عنوان شغل :</h3>
            <p>{{$job->title}}</p>
            @if(isset($job->goal_or_mission) && !empty($job->goal_or_mission))
                <h3>هدف / ماموریت شغل : </h3>
            @endif
            {!! $job->goal_or_mission !!}
            @if(isset($job->main_responsibilities) && !empty($job->main_responsibilities))
                <h3>مسئولیتهای اصلی : </h3>
                {!!  $job->main_responsibilities !!}
            @endif

            @if(isset($job->job_general_merites) && !empty($job->job_general_merites))
                <br>
                <h3>شایستگی های عمومی : </h3>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th width="250">عنوان</th>
                        <th>میزان تسلط</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($job->job_general_merites as $general)
                        <tr>
                            <td>
                                <strong>{{$general->name}}</strong>
                            </td>
                            <td>
                                @if($general->pivot->value == 1)
                                    ضعیف
                                @elseif($general->pivot->value == 2)
                                    متوسط
                                @elseif($general->pivot->value == 3)
                                    خوب
                                @elseif($general->pivot->value == 4)
                                    عالی
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @endif

            @if(isset($job->job_professional_merites) && !empty($job->job_professional_merites))
                <h3> شایستگی های تخصصی : </h3>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th width="250">عنوان</th>
                        <th>میزان تسلط</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($job->job_professional_merites as $general)
                        <tr>
                            <td>
                                <strong>{{$general->name}}</strong>
                            </td>
                            <td>
                                @if($general->pivot->value == 1)
                                    ضعیف
                                @elseif($general->pivot->value == 2)
                                    متوسط
                                @elseif($general->pivot->value == 3)
                                    خوب
                                @elseif($general->pivot->value == 4)
                                    عالی
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            @if(isset($job->job_other_features) && !empty($job->job_other_features))
                <h3> سایر ویژگی های شغل : </h3>
                <p>{!!  $job->job_other_features !!}</p>
            @endif
            <div class="clearfix wrap-icon">
                {{--<div class="pull-right">--}}
                {{--<a href=""><img src="/site/companies/img/hr_email.png" alt="" data-toggle="tooltip"--}}
                {{--data-original-title="ارسال به دوستان" data-placement="top"></a>--}}
                {{--<a href=""><img src="/site/companies/img/hr_print.png" alt="" data-toggle="tooltip"--}}
                {{--data-original-title="پرینت" data-placement="top"></a>--}}
                {{--</div>--}}
                <div class="pull-left ltr-dir">
                    <div class="share-button sharer" style="display: block;">
                        <button type="button" class="share-btn"><i class="fa fa-share"></i></button>
                        <div class="social top center networks-5 ">
                            <a class="fbtn share linkedin" rel="nofollow"
                               href=https://www.linkedin.com/shareArticle?mini=true&url={{url()->current()}}&title={{$job->title}}&summary={{HR\myFuncs::limit_words(strip_tags($job->goal_or_mission), 60)}} ...
                               &source=GolrangHr"><i class="fab fa-linkedin"></i></a>
                            <a class="fbtn share linkedin" rel="nofollow"
                               href="https://telegram.me/share/url?text={{$job->title}}&url={{url()->current()}}"><i
                                        class="fab fa-telegram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--modals-->
<div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container" style="background:#ffffff;padding:10px;direction:rtl">
            <button type="button" class="close-form" data-dismiss="modal" aria-hidden="true">×</button>
            @if(Auth::check())
                <h3><span>&nbsp;{{Auth::user()->first_name}} </span> عزیز لطفا جهت ارتباط با
                    شرکت {{$gig_data['title']}} پیغام بگذارید.</h3><br>
                {!! Form::open(['method' => 'POST', 'route' => ['tickets.site_store'] ]) !!}
                {{csrf_field()}}
                <div class="form-group">
                    <select class="form-control" name="priority">
                        <option value="" selected="selected" disabled>اهمیت</option>
                        <option value="high">بالا</option>
                        <option value="medium">متوسط</option>
                        <option value="low">کم</option>
                    </select>
                </div>
                <input type="text" name="subject" class="contact-txt form-control" placeholder="موضوع">
                <input type="hidden" name="company_id" value="{{$job->company->id}}">

                <textarea class="form-control contact-txt" name="body" rows="5" id="body" style="margin:15px 0px"
                          placeholder="پیغام"></textarea>
                <input type="hidden" value="{{$job->id}}" name="job_id">
                <input type="submit" name="submit" class="request-jobs" value="ارسال">

                {!! Form::close() !!}
            @else
                <h3>برای ارسال پیام لطفا وارد وب سایت شوید</h3>

                <br>
                <a href="{{route('login')}}" target="_blank" class="request-jobs">ورود به وب سایت</a>
            @endif
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container" style="background:#ffffff;padding:10px;">
            <button type="button" class="close-form" data-dismiss="modal" aria-hidden="true">×</button>
            <div id="modal_message_body" style="text-align:right;direction:rtl;font-size: 14px;">
                <h3>TITLE</h3>

            </div>
            <a href="{{route('login')}}"
               onclick="$('#myModal').modal('toggle');$('#login-modal').modal('toggle');"
               class="btn login loginmodal-submit" style="width:50px;color:black;">ورود</a>
        </div>
    </div>
</div>
<div id="questionsModal" class="modal fade" role="dialog">
    <div class="col-lg-7" style="margin: 30px auto;float: none;">
        <div class="modal-content">
            <div class="modal-header" style="padding: 10px 15px 0 15px;">
                <button type="button" class="close" data-dismiss="modal" style="float: left;">&times;</button>
                <h4 class="modal-title" style="border: 0; margin: 0;">سوالات کار فرما</h4>
            </div>
            {!! Form::open(['method' => 'POST', 'route' => ['applies.store'], 'id' => 'apply_form' ]) !!}
            <input type="hidden" value="{{$job->id}}" name="job_id">
            <div class="modal-body">
                <div class="col-lg-12" style="margin: 15px 0;">
                    @if($job->questions->count())
                        @foreach($job->questions as $question)
                            <div class="form-group">
                                <label style="float: right;direction: rtl"
                                       for="answer_{{$question->id}}">{{$question->question}}</label>
                                <textarea rows="4"
                                          oninvalid="this.setCustomValidity('پاسخ به سوال اجباری می باشد.')"
                                          oninput="setCustomValidity('')"
                                          maxlength="10000" style="direction: rtl;text-align: right"
                                          class="form-control"
                                          required
                                          name="answer[{{$question->id}}]" id="answer_{{$question->id}}"></textarea>
                            </div>
                        @endforeach
                    @endif
                    @if(count($cities_for_apply)>1)
                        <div class="col-md-6 no-padd no-padd-xs">
                            <label style="direction: rtl" class="col-xs-12 control-label">شهرهایی که میتوانید در آنها
                                فعالیت کنید را از لیست زیر انتخاب فرمایید:<span
                                        class="star">*</span></label>
                            <div class="col-xs-12">
                                <select data-validation="required" name="cities[]" id="pc"
                                        data-placeholder="یک گزینه انتخاب کنید"
                                        class="form-control chosen" multiple>
                                    @foreach($cities_for_apply as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="request-job-btn">درخواست همکاری</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- end of modals-->
<a class="cd-top cd-fade-out" href="#"></a>
<footer class="container footer clearfix">
    <p> کپی رایت © 2018 سامانه منابع انسانی گلرنگ همه حقوق محفوظ است. طراحی و پیاده سازی توسط <a class="link-white"
                                                                                                 href="http://golrangsystem.com"
                                                                                                 target="_blank">گلرنگ
            سیستم</a></p>
</footer>
<script src="/site/companies/js/vendor/jquery-1.12.0.min.js"></script>
<script src="/site/companies/js/bootstrap.min.js"></script>
<script src="/site/companies/js/owl.carousel.min.js"></script>
<script>
    function initMap() {}
    /* topslider */
    $('.topslider').owlCarousel({
        items: 1,
        loop: true,
        margin: 0,
        nav: true,
        navText: ["", ""],
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    });
</script>
<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        var mapOptions = {
            zoom: 16,
            center: new google.maps.LatLng({!! $job->company->LatLng !!}),
            styles: []
        };
        var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement, mapOptions);
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng({!! $job->company->LatLng !!}),
            map: map,
            title: '{!! $gig_data['title'] !!}'
        });
    }

    (function () {
        // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
        if (!String.prototype.trim) {
            (function () {
                // Make sure we trim BOM and NBSP
                var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                String.prototype.trim = function () {
                    return this.replace(rtrim, '');
                };
            })();
        }

        [].slice.call(document.querySelectorAll('input.input__field')).forEach(function (inputEl) {
            // in case the input is already filled..
            if (inputEl.value.trim() !== '') {
                classie.add(inputEl.parentNode, 'input--filled');
            }

            // events:
            inputEl.addEventListener('focus', onInputFocus);
            inputEl.addEventListener('blur', onInputBlur);
        });

        function onInputFocus(ev) {
            classie.add(ev.target.parentNode, 'input--filled');
        }

        function onInputBlur(ev) {
            if (ev.target.value.trim() === '') {
                classie.remove(ev.target.parentNode, 'input--filled');
            }
        }
    })();
</script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMQk4yzR_2-fblGkH1yZ_845WHogqLqXI&callback=initMap&language=fa"></script>
<script>
    $(document).ready(function () {
        $(".share-btn").click(function (e) {
            $('.networks-5').not($(this).next(".networks-5")).each(function () {
                $(this).removeClass("active");
            });
            $(this).next(".networks-5").toggleClass("active");
        });
    });
</script>
</body>
</html>
