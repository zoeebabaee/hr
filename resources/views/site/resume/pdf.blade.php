<!doctype html>
<html class="no-js" lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>سامانه منابع انسانی گلرنگ | رزومه</title>
    <meta name="description" content="سامانه منابع انسانی گلرنگ | رزومه">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="www.golrangsystem.com">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="icon" href="/resume/favicon.ico" type="image/png">
    <link rel="stylesheet" href="https://people.golrang.com/resume/css/main.css?v=14">
    <style>
        img, p {
            page-break-inside: avoid !important;
        }
    </style>
</head>
<body style="background-color: #eee">
<!-- M2Kia -->
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<section class="clearfix container">

    <div class="clearfix right-sidebar">
        <div class="img-resume"><img
                    src="data:image/png;base64, {{base64_encode(file_get_contents('https://people.golrang.com'.$resume->user->avatar))}}"
                    alt="" title=""></div>
        <div style="text-align: center;font-size: 27px;margin: 0px;">
            <strong>{{$resume->user->first_name.' '.$resume->user->last_name}}</strong><br/>
            <strong>{{$resume->user->english_first_name.' '.$resume->user->english_last_name}}</strong>

        </div>
        <div class="r-section">
            <div class="r-title">
                <strong>
                    اطلاعات فردی
                </strong>
                <span class="line"></span>
            </div>
            <div class="r-content">
                <p>
                    <span class="line-height-28"><img src="https://people.golrang.com/resume/img/i1.png" alt="" title=""></span>
                    {{$years_old}}
                    ساله{{--،--}}
                    {{--{{$resume->user->profile->born_date}}--}}

                </p>
                <p>
                    <span class="line-height-28"><img src="https://people.golrang.com/resume/img/marriage.png" alt="" title=""></span>
                    @if($resume->user->profile->marital_status==1)
                        مجرد
                    @endif
                    @if($resume->user->profile->marital_status==2)
                        متاهل {{--, {{$resume->user->profile->marriage_date}}--}}
                    @endif
                    @if($resume->user->profile->marital_status==3)
                        متارکه
                    @endif
                </p>
                <p>
                    <span class="line-height-28"><img src="https://people.golrang.com/resume/img/i1.png" alt="" title=""></span>
                    ساکن
                    {{$resume->user->profile->city->name.'، '.$resume->user->profile->province->name}}
                    @if(isset($resume->user->profile->neighborhood) && $resume->user->profile->neighborhood!="")
                        ،
                        @if(intval($resume->user->profile->neighborhood)>0)
                            منطقه
                            {{$resume->user->profile->neighborhood}}
                        @else
                            {{$resume->user->profile->neighborhood}}
                        @endif
                    @endif

                </p>
                {{--
                <p><span class="line-height-28"><img src="https://people.golrang.com/resume/img/i1.png" alt="" title=""></span>
                    متولد
                    {{\HR\myFuncs::farsi_numbers(str_replace('-','/',substr($resume->user->profile->born_date, 0, 4)))}}
                    ،
                    {{$resume->user->profile->province->name.'، '.$resume->user->profile->city->name}}
                    </p>

                <p><span class="line-height-30"><img src="https://people.golrang.com/resume/img/marriage.png" alt=""
                                                     title=""></span>@if($resume->user->profile->marital_status==1)
                        مجرد
                    @endif
                    @if($resume->user->profile->marital_status==2)
                        متاهل
                    @endif
                    @if($resume->user->profile->marital_status==3)
                        متارکه
                    @endif
                </p>
                --}}
                @if($resume->user->email && is_null($resume->user->is_email_verified))
                    <p style="word-wrap: break-word"><span class="line-height-25"><img
                                    src="https://people.golrang.com/resume/img/i2.png" alt=""
                                    title=""></span> {{$resume->user->email}} </p>
                @elseif($resume->user->email && !is_null($resume->user->is_email_verified))
                    <p style="word-wrap: break-word"><span class="line-height-25"><img
                                    src="https://people.golrang.com/resume/img/i20.png" alt=""
                                    title=""></span> {{$resume->user->email}} </p>
                @endif


            @if(!empty($resume->user->profile->linkedin) && !is_null($resume->user->profile->linkedin))
                    <p style="word-wrap: break-word"><span class="line-height-27"><img
                                    src="https://people.golrang.com/resume/img/i3.png" alt=""
                                    title=""></span> {{$resume->user->profile->linkedin}} </p>
                @endif
                <p>
                    <span class="line-height-28"><img src="https://people.golrang.com/resume/img/i7.png" alt=""
                                                      title=""></span> {{$resume->user->mobile}}
                    <span class="line-height-29"><img src="https://people.golrang.com/resume/img/i4.png" alt=""
                                                      title=""></span> {{ substr($resume->user->profile->home_phone, 0,3).'-'.substr($resume->user->profile->home_phone,3) }}
                </p>

                @if($resume->user->profile->gender==1)
                    <p><span class="line-height-30"><img src="https://people.golrang.com/resume/img/i6.png" alt=""
                                                         title=""></span>
                        @if($resume->user->profile->military_status==1)
                            {{$user_khedmat_status->Name}}{{--, {{$resume->user->profile->military_end_date	}}--}}
                        @else
                            {{$user_khedmat_status->Name}}
                                @if($user_khedmat_status->site_id=="2")
                                    @if(isset($user_khedmat_moaf_status) && !empty($user_khedmat_moaf_status->Name))
                                        ، {{$user_khedmat_moaf_status->Name}}
                                    @endif
                                @endif
                            {{--
                            @if($resume->user->profile->reason_exemption==1)
                                تحصیلی
                            @elseif($resume->user->profile->reason_exemption==2)
                                کفالت
                            @elseif($resume->user->profile->reason_exemption==3)
                                پزشکی
                            @elseif($resume->user->profile->reason_exemption==4)
                                موارد خاص
                            @endif
                            --}}

                        @endif
                    </p>
                @endif
            </div>
        </div>
        <div class="r-section">
            <div class="r-title">
                <strong>اطلاعات شغلی</strong>
                <span class="line"></span>
            </div>
            <div class="r-content">
                @if(!is_null($resume->questions->requested_salary))
                    <p>حقوق درخواستی:</p>
                    <p style="margin-bottom: 40px;">
                        <strong> {{ config('app.salery_range')[$resume->questions->requested_salary] }}</strong></p>
                @endif
                @if($resume->departments && $resume->departments->count())
                    <p>زمینه تخصصی:</p>
                    <p style="margin-bottom: 40px;">
                        <strong> {{implode('، ',$resume->departments->pluck('name')->toArray())}} </strong></p>
                @endif
                @if($resume->industries && $resume->industries->count())
                    <p>صنعت مورد علاقه:</p>
                    <p style="margin-bottom: 40px;">
                        <strong> {{implode('، ',$resume->industries->pluck('name')->toArray())}} </strong></p>
                @endif
                @if($resume->contractTypes && $resume->contractTypes->count())
                    <p>نوع همکاری: </p>
                    <p style="margin-bottom: 40px;">
                        <strong> {{implode('، ',$resume->contractTypes->pluck('name')->toArray())}} </strong></p>
                @endif
                @if(!is_null($resume->referer))
                    <p>طریقه آشنایی با شرکت:</p>
                    <p style="margin-bottom: 40px;">
                        <strong> {{config('app.enum_referer')[$resume->referer]}}
                            @if($resume->introducer)
                                / {{$resume->introducer->name}} / {{$resume->introducer->post}}
                                / {{$resume->introducer->company_name}}/ {{$resume->introducer->relevance}}
                            @endif
                        </strong>
                    </p>
                @endif
                {{--<p>متقاضی کار در استان: </p>--}}
                {{--<p style="margin-bottom: 40px;"><strong> {{$resume->province->name}} </strong></p>--}}
                
            </div>
        </div>
    </div>

    <div class="wrapper-left-content">
        <div class="left-content">
            <div class="l-section">
                <div class="l-title">
                    <img src="https://people.golrang.com/resume/img/b1.png" alt="" title="">
                    <h1>
                        تحصیلات
                    </h1>
                    <span class="b-line"></span>
                </div>
            </div>
            <div class="l-content">

                <ul class="ul-content">
                    @if($resume->educational_details && $resume->educational_details->count())
                        @foreach($resume->educational_details->sortByDesc('grade') as $grade)
                            <li>
                                <p class="lvluni">
                                    <span class="circle"></span>
                                    <span class="left-circle">
                                <span style="position: absolute; width: 180px">{{$degrees_array[$grade->grade]}}</span>
                                
                                
                                    <?php if ($grade->field_id = 0): ?>
                                        <span class="field" style="position: absolute; padding-right: 195px;width: 400px" >{{$grade->field_type}}</span>
	                                <?php else: ?>
                                        <span class="field" style="position: absolute; padding-right: 195px;width: 400px" >@if($grade->grade == 1){{$grade->field_type}}@else{{$grade->field}}{{($grade->orientation == null)?'':' ('.$grade->orientation.')'}}@endif</span>
	                                <?php endif; ?>
                              
                                
                                </span>
                                </p>

                                <p style="margin-top: 30px">
                                <span class="year" style="width: 130px">
                                    {{\HR\myFuncs::farsi_numbers(substr($grade->start_date,0,4))}}
                                    @if($grade->end_date!="")
                                        تا
                                        {{\HR\myFuncs::farsi_numbers(substr($grade->end_date,0,4))}}
                                    @else
                                        تاکنون
                                    @endif
                                </span>
                                    <span class="rate"  style="position: absolute; right: 145px" >معدل {{\HR\myFuncs::farsi_numbers($grade->average)}}</span>
	                         
                                     <span style="position: absolute; right: 300px;width: 470px;" class="university">{{$grade->institute}}
                                    | {{$grade->city}}  </span>
                              
                                </p>
                            </li>
                        @endforeach
                    @else
                        <li>
                            <p class="lvluni">
                                <span class="circle"></span>
                                <span class="left-circle">
                                    زیر دیپلم
                                </span>
                            </p>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="left-content">
            <div class="l-section">
                <div class="l-title">
                    <img src="https://people.golrang.com/resume/img/b2.png" alt="" title="">
                    <h1>سوابق کاری</h1>
                    <span class="b-line"></span>
                </div>
            </div>
            <div class="l-content">
                <ul class="ul-content">
                    @if($resume->work_experiences && $resume->work_experiences->count())
                        @foreach($resume->work_experiences->sortByDesc('start_date') as $work)
                            <li>
                                <p class="lvluni">
                                    <span class="circle"></span>
                                    <span style="width: 300px; position: absolute;top:0; ">{{$work->title}}</span>
                                    <span style="width: 300px;right: 315px; position: absolute; top: 0;"
                                          class="university">{{$work->last_post}}  </span>
                                </p>
                                <p @if(intval(strlen($work->title)/50)) style="margin-top: {!! intval(strlen($work->title)/50)*30 !!}px" @endif>
                            <span class="year" >
                                <img src="https://people.golrang.com/resume/img/calendar.png" alt=""
                                     title="">
                                {{/*\HR\myFuncs::farsi_numbers*/(substr($work->start_date,0,7))}}
                                @if(!is_null($work->end_date) && !empty($work->end_date))
                                    تا
                                    {{/*\HR\myFuncs::farsi_numbers*/(substr($work->end_date,0,7))}}
                                @else
                                    تاکنون
                                @endif
                            </span>
                                    @if(!empty($work->phone_number) && !is_null($work->phone_number))
                                    <span style="direction: ltr" class="i-contact"><img
                                                src="https://people.golrang.com/resume/img/tel.png" alt=""
                                                title="">‌@php $work->phone_number = \HR\myFuncs::nums_to_en($work->phone_number) @endphp {{substr($work->phone_number,3).'-'.substr($work->phone_number,0,3)}} </span>
                                    @endif
                                </p>
                                <p style="text-align: justify" class="c-txt">{{$work->important_tasks}}</p>
                                @if(!is_null($work->cause_interruption) && !empty($work->cause_interruption) && strlen($work->cause_interruption) > 3)
                                    <br>
                                    <span class="c-txt" style="text-align: justify; padding-right: 5px"><img
                                                style="float: right;margin-right: 25px;"
                                                src="https://people.golrang.com/resume/img/salary.png"
                                                alt=""
                                                title=""> {{$work->cause_interruption}}</span>
                                @endif
                            </li>
                        @endforeach
                    @else
                        <li>
                            <p class="lvluni">
                                <span class="circle"></span>
                                <span class="left-circle">
                                    فاقد سابقه کار هستم
                                </span>
                            </p>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="left-content">
            <div class="l-section">
                <div class="l-title">
                    <img src="https://people.golrang.com/resume/img/b3.png" alt="" title="">
                    <h1>زبان خارجی</h1>
                    <span class="b-line"></span>
                </div>
            </div>
            <div class="l-content">
                <ul class="ul-content">
                    @foreach($resume->foreign_languages as $lang)
                        <li>
                            <p class="lang" style="display: inline-block; width: 253px;"><span style="margin-right: 0px"
                                                                                               class="circle"></span>
                                {{$lang->title}}
                            </p>

                            <div class="w-progress ">
                                <span class="lable-pb">مکالمه</span>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                         aria-valuenow="{!! (5-$lang->conversation)*25 !!}" aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="width:{!! (5-$lang->conversation)*25 !!}%">
                                        {{--<p>{!! (5-$lang->conversation)*25 !!}%</p>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="w-progress" style="margin-right: 33px;">
                                <span class="lable-pb">درک مطلب</span>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"
                                         aria-valuenow="{!! (5-$lang->comprehension)*25 !!}" aria-valuemin="0"
                                         aria-valuemax="100"
                                         style="width:{!! (5-$lang->comprehension)*25 !!}%">
                                        {{--<p>{!! (5-$lang->comprehension)*25 !!}%</p>--}}
                                    </div>
                                </div>
                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @if($resume->computer_skills && $resume->computer_skills->count())
            <div class="left-content">
                <div class="l-section">
                    <div class="l-title">
                        <img src="https://people.golrang.com/resume/img/b4.png" alt="" title="">
                        <h1>نرم افزار</h1>
                        <span class="b-line"></span>
                    </div>
                </div>
                <div class="l-content">
                    <ul class="ul-content">
                        @foreach($resume->computer_skills as $skill)
                            <li>
                                <p class="lvluni" style="display: inline-block; width: 523px;"><span
                                            class="circle"></span>
                                    {{$skill->name}}
                                </p>
                                <div class="w-progress mr-350 absolute">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                             aria-valuenow="{!! (5 - $skill->pivot->proficiency) * 25 !!}"
                                             aria-valuemin="0"
                                             aria-valuemax="100"
                                             style="width:{!! (5 - $skill->pivot->proficiency) * 25 !!}%">
                                            <p>{!! (5 - $skill->pivot->proficiency) * 25 !!}%</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        @if($resume->professional_training_records && $resume->professional_training_records->count())
            <div class="left-content">
                <div class="l-section">
                    <div class="l-title">
                        <img src="https://people.golrang.com/resume/img/b5.png" alt="" title="">
                        <h1>دوره های آموزشی</h1>
                        <span class="b-line"></span>
                    </div>
                </div>
                <div class="l-content">
                    <ul class="ul-content">
                        @foreach($resume->professional_training_records as $expert)
                            <li>
                                <p class="lvluni" style="display: inline-block; width: 474px;text-align: justify"><span
                                            class="circle"></span>

                                    <span style="font-weight: bold;">{{$expert->name}}</span> / <span
                                            class="thesis">{{$expert->pivot->institute_name}} </span>
                                </p>
                                <div class="w-progress absolute">
                                    <span class="university"> {{\HR\myFuncs::farsi_numbers($expert->pivot->finish_year)}}</span>
                                    | <span
                                            class="thesis">{{\HR\myFuncs::farsi_numbers($expert->pivot->duration)}}
                                        ساعت  </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if($resume->experimental_expertises && ($resume->experimental_expertises->count()))
            <div class="left-content">
                <div class="l-section">
                    <div class="l-title">
                        <img src="https://people.golrang.com/resume/img/icon-skills.png" alt="" title="">
                        <h1>مهارت های تجربی</h1>
                        <span class="b-line"></span>
                    </div>
                </div>
                <div class="l-content">
                    <ul class="ul-content">
                        @foreach($resume->experimental_expertises as $exp)
                            <li>
                                <p class="lvluni" style="display: inline-block;width: 70%;"><span class="circle"></span>
                                    {{$exp->name}}
                                </p>
                                <div class="w-progress absolute" style=" float: left;margin-left: 41px;">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                             aria-valuenow="{!! (5 - $exp->pivot->proficiency) * 25 !!}"
                                             aria-valuemin="0"
                                             aria-valuemax="100"
                                             style="width:{!! (5 - $exp->pivot->proficiency) * 25 !!}%">
                                            <p>{!! (5 - $exp->pivot->proficiency) * 25 !!}%</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="c-txt">{{$exp->pivot->description}}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if($resume->family && $resume->family->count())
            <div class="left-content">
                <div class="l-section">
                    <div class="l-title">
                        <img src="https://people.golrang.com/resume/img/b6.png" alt="" title="">
                        <h1>اعضای خانواده</h1>
                        <span class="b-line"></span>
                    </div>
                </div>
                <div class="l-content">
                    <ul class="ul-content">
                        @foreach($resume->family as $family)
                            <li>
                                <p class="lvluni" style="font-weight: normal;padding-bottom: 20px">
                                    <span class="circle"></span>
                                    <span class="left-circle">
                                        <span style="display: inline-block; width: 150px;position: absolute"><strong>{{$family->name}}</strong></span>
                                        <span style="display: inline-block; padding-right:165px ; width: 80px;position: absolute"> <strong>{{config('gng_config.gng.relation')[$family->relation]['name']}} </strong></span>
                                        @if($family->job)
                                            <span style="display: inline-block; padding-right:260px ; width: 150px;position: absolute"><span style="font-size: 13px;">شغل</span>  <strong> {{$family->job}}  </strong></span>
                                            @if(!empty($family->organization) && !is_null($family->organization))
                                            <span style="display: inline-block; padding-right:425px ; width: 300px;position: absolute"> <span style="font-size: 13px;">سازمان / صنف</span>  <strong> {{$family->organization?$family->organization:''}} </strong></span>
                                            @endif
                                        @else
                                            <span style="display: inline-block; padding-right:260px ; width: 150px;position: absolute"><strong style="font-size: 13px;">عدم اشتغال</strong></span>
                                        @endif

                                </span>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        @if(\HR\myFuncs::is_complete($resume->user->complete_percent,5))
            <div class="left-content">
                <div class="l-section">
                    <div class="l-title">
                        <img src="https://people.golrang.com/resume/img/b7.png" alt="" title="">
                        <h1>سوالات</h1>
                        <span class="b-line"></span>
                    </div>
                </div>
                <div class="l-content">
                    <ul class="ul-content">
                        <li>
                            <p class="lvluni">
                                <span class="circle"></span> آیا از کارکنان گروه صنعتی گلرنگ کسی را می شناسید؟
                                @if(!count($resume->introducers->toArray()))
                                    <span class="c-txt1">خیر</span>
                                @else
                                    @foreach($resume->introducers as $person)
                                        <span class="c-txt1"> {{$person->name}}/ {{$person->post}}
                                            / {{$person->company_name}}</span>
                                    @endforeach
                                @endif
                            </p>
                        </li>
                        <li>
                            <p class="lvluni">
                                <span class="circle"></span> آیا سابقه محکومیت کیفری داشته اید؟
                                @if($resume->questions->crime!=1)
                                    <span class="c-txt1"> خیر</span>
                                @elseif($resume->questions->crime==1)
                                    <span class="c-txt1"> بله، {{$resume->questions->crime_description}} </span>
                                @endif

                            </p>
                        </li>
                        <li>
                            <p class="lvluni">
                                <span class="circle"></span> آیا سابقه بیماری و یا جراحی خاصی داشته اید؟
                                @if($resume->questions->sickness==0)
                                    <span class="c-txt1">خیر</span>
                                @elseif($resume->questions->sickness==1)
                                    <span class="c-txt1">
                                بله،
                                        @if(!is_null($resume->questions->sickness_description) && !empty($resume->questions->sickness_description))
                                            <span style="border-bottom: dashed 1px;">{{$resume->questions->sickness_description}}</span>
                                        @endif
                                        و
                                        @if($resume->questions->treatment==1)
                                            کاملا بهبود یافته ام
                                        @else
                                            هنوز بهبود نیافته ام
                                        @endif
                                    </span>
                            @endif
                        </li>
                        <li>
                            <p class="lvluni">
                                <span class="circle"></span> مهمترین موفقیت کاری / شخصی شما چه بوده است؟
                                <span class="c-txt1">{{$resume->questions->Q1}}  </span>
                            </p>
                        </li>
                        <li>
                            <p class="lvluni">
                                <span class="circle"></span>اهداف کاري/ شخصی خود را براي 5 سال آینده بیان نمائید.
                                <span class="c-txt1">{{$resume->questions->Q2}}</span>
                            </p>
                        </li>
                        <li @if(empty($resume->questions->Q4) || is_null($resume->questions->Q4)) style="padding-bottom: 0px" @endif>
                            <p class="lvluni">
                                <span class="circle"></span> بارزترین ارزش توانایی و یا قابلیتی که برای شرکت به همراه می
                                اورید چیست؟
                                <span class="c-txt1"> {{$resume->questions->Q3}}</span>
                            </p>
                        </li>
                        @if(!empty($resume->questions->Q4) && !is_null($resume->questions->Q4))
                            <li style="padding-bottom: 0px">
                                <p class="lvluni">
                                    <span class="circle"></span> در صورتی که نکته خاصی جود دارد که احتمالا در استخدام
                                    شما
                                    موثر
                                    است، بیان کنید
                                    <span class="c-txt1">{{$resume->questions->Q4}} </span>
                                </p>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        @endif
    </div>
</section>
</body>
</html>
