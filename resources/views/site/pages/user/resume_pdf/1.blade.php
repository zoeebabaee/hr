<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>رزومه {{$user->first_name.' '.$user->last_name}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    {{ Html::style('/site/'.config('app.site_theme').'/css/fontiran.css') }}
    <style type="text/css">
        * {
            font-family: IRANSans !important;
        }

        .relative-wrapper {
            margin-bottom: 90px;
            position: relative;
        }

        .bgdark {
            background: url("https://people.golrang.com/resume/bgdark.png") repeat;
            height: 140px;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            z-index: 99;
            width: 960px;
        }

        .title-pdf1 {
            color: #fff;
            direction: rtl;
            font-size: 21px;
            font-weight: 500;
            margin: 75px 0px 5px 0px;
            text-align: right;
            position: relative;
            top: 50px;
        }

        .title-pdf2 {
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            margin: 0px;
            text-align: right;
            position: relative;
            top: 40px;
        }

        .bgdark h4 {
            color: #000;
            font-size: 18px;
            font-weight: 500;
            margin: 15px 0px;
            text-align: right;
        }

        .top-innerpage {
            height: 140px;
            width: 960px;
        }

        .fr-img-curve {
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 100%;
            float: right;
            height: 130px;
            margin-left: 20px;
            margin-right: 50px;
            margin-top: 30px;
            padding: 3px;
            width: 130px;
        }

        .fl-img-logo {
            float: left;
            left: 25px;
            position: absolute;
            top: 40px;
        }

        .pdf-title {
            background: #fff;
            border-bottom: 1px solid #c4161c;
            float: right;
            font-size: 13px;
            font-weight: 700;
            height: 40px;
            line-height: 40px;
            margin-bottom: 15px;
            text-indent: 15px;
            text-align: right;
            width: 430px;
        }

        .pdf-title1 {
            background: #fff;
            border-bottom: 1px solid #c4161c;
            float: right;
            font-size: 13px;
            font-weight: 700;
            height: 40px;
            line-height: 40px;
            margin-bottom: 15px;
            text-indent: 15px;
            text-align: right;
            width: 960px;
        }

        .wrap-pdf {
            border-right: 1px solid #999;
            margin-bottom: 30px;
            padding-bottom: 15px;
            float: right
        }

        .wrap-pdf p {
            padding: 2px 15px;
        }

        .wrap-pdf strong {
            font-size: 14px;
            font-weight: 500;
        }

        .wrap-pdf-inner {
            background: #f3f3f3;
            margin-bottom: 5px;
            margin-top: 5px;
            padding-bottom: 5px !important;
            padding-top: 5px !important;
        }

        .wrap-pdf-inner-3 {
            background: #f3f3f3;
            margin-bottom: 5px;
            margin-top: 5px;
            padding-bottom: 5px !important;
            padding-top: 5px !important;
        }

        .exph {
            border-bottom: 1px solid #999;
            border-top: 1px solid #999;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 5px;
            margin-top: 5px;
            padding: 5px 0px;
        }

        .container {
            width: 960px;
            margin: 0px auto;
            text-align: right;
            direction: rtl;
            font-size: 13px;
            font-family: Tahoma;
        }

        .com-half {
            float: right;
            margin-bottom: 30px;
            width: 960px;
        }

        .half-part1 {
            width: 450px;
            margin-left: 60px;
            float: right
        }

        .half-part {
            width: 450px;
            float: right
        }

        .wrap-pdf-inner p {
            width: 20%;
            float: right;
            color: #555;
        }

        .wrap-pdf-inner-3 p {
            width: 30%;
            float: right;
            color: #555;
        }

        h2 {
            border-right: solid #c4161c;
            padding-right: 5px
        }
    </style>

</head>
<body>
<div class="clearfix container inner-content">
    <div class="relative-wrapper">
        <div class="top-innerpage"></div>
        <div class="bgdark"
             style="background:url('https://people.golrang.com/resume/bgdark.png') no-repeat top center/cover;">
            <img src="{{'https://people.golrang.com/'.$user->avatar}}" alt="" class="fr-img-curve">
            <p class="title-pdf1">{{$user->first_name.' '.$user->last_name}}</p>
            <p class="title-pdf2">{{$user->profile->city->name}}</p>
            <img src="https://people.golrang.com/resume/print-logo.png" alt="" class="fl-img-logo">
        </div>
    </div>
    <div class="left-jobs">
        <div class="com-half">
            <h2>اطلاعات فردی</h2>
            <div class="half-part1">
                <div class="clearfix wrap-pdf">
                    <div class="pdf-title">مشخصات عمومی</div>
                    <p><strong>نام و نام خانوادگی: </strong> {{$user->first_name.' '.$user->last_name}}</p>
                    <p><strong>کد ملی: </strong>{{ \HR\myFuncs::farsi_numbers($user->profile->national_code)}}</p>
                    <p><strong>جنسیت: </strong>
                        @if($user->profile->gender==1)
                            مرد
                        @endif
                        @if($user->profile->gender==2)
                            زن
                        @endif
                        @if($user->profile->gender==3)
                            همه
                        @endif
                    </p>
                    <p><strong>تاریخ
                            تولد: </strong>{{\HR\myFuncs::farsi_numbers(str_replace('-','/',$user->profile->born_date))}}
                    </p>
                    <p><strong>وضعیت تاهل: </strong>
                        @if($user->profile->marital_status==1)
                            مجرد
                        @endif
                        @if($user->profile->marital_status==2)
                            متاهل
                        @endif
                        @if($user->profile->marital_status==3)
                            متارکه
                        @endif
                    </p>


                    @if(isset($user->profile->military_status) && !is_null($user->profile->military_status))
                        <p><strong>وضعیت نظام وظیفه: </strong>
                            @if($user->profile->military_status==1)
                                پایان خدمت
                            @endif
                            @if($user->profile->military_status==2)
                                معافیت
                            @endif
                            @if($user->profile->military_status==3)
                                خرید خدمت
                            @endif
                            @if($user->profile->military_status==4)
                                مشمول
                    @endif
                    @endif

                    @if($user->profile->military_status==1)
                        <p><strong>تاریخ پایان
                                خدمت: </strong> {{(!empty($user->profile->military_end_date)?str_replace('-','/',\HR\myFuncs::farsi_numbers($user->profile->military_end_date)):'وارد نشده')}}
                        </p>
                    @endif
                    @if($user->profile->military_status==3)
                        <p><strong>تاریخ دریافت
                                کارت: </strong> {{(!empty($user->profile->military_end_date)?str_replace('-','/',\HR\myFuncs::farsi_numbers($user->profile->military_end_date)):'وارد نشده')}}
                        </p>
                    @endif

                    @if($user->profile->military_status==2)
                        <p><strong>دلیل
                                معافیت: </strong>{{--(!empty($user->profile->reason_exemption)?$user->profile->reason_exemption:'وارد نشده')--}}
                            @if(!empty($user->profile->reason_exemption))
                                @if($user->profile->reason_exemption==1)
                                    تحصیلی
                                @endif
                                @if($user->profile->reason_exemption==2)
                                    کفالت
                                @endif
                                @if($user->profile->reason_exemption==3)
                                    پزشکی
                                @endif
                                @if($user->profile->reason_exemption==4)
                                    موارد خاص
                                @endif

                            @endif
                        </p>
                    @endif
                </div>
            </div>
            <div class="half-part">
                <div class="clearfix wrap-pdf">
                    <div class="pdf-title">محل سکونت</div>
                    <p><strong>استان: </strong> {{\HR\myFuncs::farsi_numbers($user->profile->province->name)}} </p>
                    <p><strong>شهر/شهرستان: </strong> {{$user->profile->city->name}}</p>
                    @if(!is_null($user->profile->neighborhood))
                        <p><strong>منطقه/محله: </strong> {{\HR\myFuncs::farsi_numbers($user->profile->neighborhood)}}
                        </p>
                    @endif
                    <p><strong>تلفن منزل: </strong> {{\HR\myFuncs::farsi_numbers($user->profile->home_phone)}}</p>
                    <p><strong>تلفن همراه: </strong> {{\HR\myFuncs::farsi_numbers($user->mobile)}} </p>
                    <p><strong>ایمیل: </strong>{{(!empty($user->email)?$user->email:'وارد نشده')}} </p>
                </div>
            </div>
        </div>
        <div class="com-half">
            <div class=" wrap-pdf">
                <div class="pdf-title1">مشخصات شغل درخواستی</div>
                <p class=""><strong>استان: </strong> {{$resume->province->name}}</p>
                <p><strong>نوع همکاری: </strong> {{implode('، ',$resume->contractTypes->pluck('name')->toArray())}}</p>
                @if(isset($resume->experimental_expertises) && $resume->experimental_expertises->count())
                    <p><strong>زمینه تخصصی: </strong>{{implode('، ',$resume->departments->pluck('name')->toArray())}}
                    </p>
                @endif
                <p><strong> زمینه صنعت:</strong> {{implode('، ',$resume->industries->pluck('name')->toArray())}} </p>
                <p><strong> طریقه آشنایی با شرکت: </strong>

                    @if($resume->referer==1)
                        آگهی روزنامه
                    @endif
                    @if($resume->referer==2)
                        تماس اولیه از طرف گلرنگ
                    @endif
                    @if($resume->referer==3)
                        سایت شرکت
                        ({{$resume->site->first()->url}})
                    @endif
                    @if($resume->referer==4)
                        معرفي آشنايان و دوستان
                    @endif
                    @if($resume->referer==5)
                        مراکز کاريابي
                    @endif
                    @if($resume->referer==8)
                        نمایشگاه کار
                    @endif
                    @if($resume->referer==6)
                        معرفی کارکنان گلرنگ
                    @endif
                    @if($resume->referer==7)
                        سایر
                        ({{$resume->other}})
                    @endif
                </p>
                @if($resume->introducer)
                    <div class="clearfix com-half wrap-pdf-inner">
                        <p><strong> نام و نام خانوادگی: </strong> {{$resume->introducer->name}} </p>
                        <p><strong> نام شرکت: </strong> {{$resume->introducer->company_name}} </p>
                        <p><strong> نسبت: </strong> {{$resume->introducer->relevance}} </p>
                        <p><strong> سمت: </strong> {{$resume->introducer->post}}</p>
                    </div>

                @endif
            </div>
        </div>
        @if($resume->educational_details->count())
            <div class="com-half">
                <h2> تحصیلات، آموزشها و مهارتها </h2>
                <div class=" wrap-pdf">
                    <div class="pdf-title1">تحصیلات</div>

                    @foreach($resume->educational_details as $grade)
                        <br>
                        <p class=""><strong>مورد {{\HR\myFuncs::farsi_numbers($loop->index + 1)}}</strong>:
                            از تاریخ {{\HR\myFuncs::farsi_numbers(str_replace('-','/',$grade->start_date))}}
                            تا
                            @if($grade->end_date!="")
                                {{\HR\myFuncs::farsi_numbers(str_replace('-','/',$grade->end_date))}}

                            @else
                                اکنون
                            @endif
                        </p>

                        <div class="com-half wrap-pdf-inner">
                            <p><strong>مقطع تحصیلی: </strong>{{config('app.enum_last_degree')[$grade->grade]}}</p>
                            <p><strong>رشته: </strong> {{$grade->field}}  </p>
                            @if(isset($grade->tendency) && !empty($grade->tendency))
                                <p><strong> گرایش: </strong> {{$grade->tendency}} </p>
                            @else
                                <p><strong> گرایش: </strong> ندارد </p>
                            @endif
                            @php
                                $structure = [
                                '',
                                'سراسری',
                                'آزاد',
                                'پیام نور',
                                'غیرانتفاعی',
                                'علمی-کاربردی',
                                'پردیس',
                                'خارج از کشور',
                                'تربیت معلم',
                                'فنی و حرفه ای',
                                'کار و دانش',
                                'مؤسسات آموزش عالی آزاد',
                                'پردیس بین الملل',
                                ];
                            @endphp
                            @if($grade->institute_structure)
                                <p><strong> ساختار موسسه: </strong>
                                    {{$structure[$grade->institute_structure]}}
                                </p>
                            @endif
                            <p><strong> موسسه: </strong> {{$grade->institute}}  </p>
                            <p><strong> استان: </strong> {{$grade->city}}</p>
                            <p><strong> معدل: </strong> {{\HR\myFuncs::farsi_numbers($grade->average)}}  </p>
                            <p><strong> نوع دوره: </strong>
                                @if($grade->course_type == 1)
                                    روزانه
                                @endif
                                @if($grade->course_type == 2)
                                    شبانه
                                @endif
                                @if($grade->course_type == 3)
                                    غیرحضوری/مجازی
                                @endif
                                @if($grade->course_type == 4)
                                    نیمه حضوری
                                @endif
                            </p>
                        </div>
                    @endforeach

                </div>
            </div>
        @else
            <div class="com-half">
                <h2> تحصیلات، آموزشها و مهارتها </h2>
                <div class=" wrap-pdf">
                    <div class="pdf-title1">تحصیلات</div>
                    <p>زیر دیپلم</p>

                </div>
            </div>
        @endif
    </div>
    @if(isset($resume->professional_training_records) && $resume->professional_training_records->count())
        <div class="com-half">
            <div class=" wrap-pdf">
                <div class="pdf-title1">سوابق آموزش تخصصی</div>
                @foreach($resume->professional_training_records as $expert)
                    <div class="com-half wrap-pdf-inner">
                        <p><strong> عنوان دوره: </strong> {{\HR\myFuncs::farsi_numbers($expert->name)}}  </p>
                        <p><strong> امکان ارائه گواهینامه: </strong> {{($expert->pivot->has_certificate)?'بله':'خیر'}}
                        </p>
                        <p><strong>مدت دوره: </strong> {{\HR\myFuncs::farsi_numbers($expert->pivot->duration)}} ساعت
                        </p>
                        <p><strong> نام آموزشگاه/موسسه: </strong> {{$expert->pivot->institute_name}} </p>
                        <p><strong> سال اتمام: </strong> {{\HR\myFuncs::farsi_numbers($expert->pivot->finish_year)}}
                        </p>

                    </div>

                @endforeach
            </div>
        </div>
    @endif

    @if(isset($resume->experimental_expertises) && ($resume->experimental_expertises->count()))
        <div class="com-half">
            <div class=" wrap-pdf">
                <div class="pdf-title1">مهارت های تجربی</div>
                @php
                    $ar=[
                    1=>'عالی',
                    2=>'خوب',
                    3=>'متوسط',
                    4=>'ضعیف'
                    ]
                @endphp
                @foreach($resume->experimental_expertises as $exp)
                    <p><strong> عنوان : </strong> {{$exp->name}}  </p>
                    <p><strong> میزان تسلط : </strong> {{$ar[$exp->pivot->proficiency]}}   </p>
                    <p><strong> توضیحات: </strong>{{$exp->pivot->description}} </p>
                    @if(!$loop->last)
                        <hr style="width: 40%; float: right"/>
                        <br>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
    @if(!is_null($resume->foreign_languages) && $resume->foreign_languages->count())
        <div class="half-part1">
            <div class=" wrap-pdf" style="display: inline-block">
                <div class="pdf-title"> آشنایی با زبان های خارجی</div>
                @foreach($resume->foreign_languages as $lang)
                    <p><strong> عنوان: </strong> {{$lang->title}} </p>
                    <p><strong> مکالمه: </strong>
                        @if($lang->conversation==1)
                            عالی
                        @endif
                        @if($lang->conversation==2)
                            خوب
                        @endif
                        @if($lang->conversation==3)
                            متوسط
                        @endif
                        @if($lang->conversation==4)
                            ضعیف
                        @endif
                    </p>
                    <p><strong> نگارش: </strong>
                        @if($lang->writing==1)
                            عالی
                        @endif
                        @if($lang->writing==2)
                            خوب
                        @endif
                        @if($lang->writing==3)
                            متوسط
                        @endif
                        @if($lang->writing==4)
                            ضعیف
                        @endif
                    </p>
                    <p><strong> درک مطلب و ترجمه: </strong>
                        @if($lang->comprehension==1)
                            عالی
                        @endif
                        @if($lang->comprehension==2)
                            خوب
                        @endif
                        @if($lang->comprehension==3)
                            متوسط
                        @endif
                        @if($lang->comprehension==4)
                            ضعیف
                        @endif
                    </p>

                    <p><strong> گواهینامه: </strong>
                        @if(!empty($lang->certificate))
                            {{$lang->certificate}}
                        @else
                            ندارد
                        @endif
                    </p>

                    @if(!$loop->last)
                        <hr/>
                    @endif
                <!--                                    <div class="hr-pdf"></div>-->
                @endforeach
            </div>
        </div>
    @endif

    @if(!is_null($resume->computer_skills) && $resume->computer_skills->count())
        <div class="half-part">
            <div class=" wrap-pdf" style="display: inline-block">
                <div class="pdf-title"> آشنایی با کامپیوتر</div>

                @foreach($resume->computer_skills as $skill)

                    <p><strong>نام نرم افزار: </strong> {{$skill->name}} </p>
                    <p><strong> میزان تسلط: </strong>
                        @if($skill->pivot->proficiency==1)
                            عالی
                        @endif
                        @if($skill->pivot->proficiency==2)
                            خوب
                        @endif
                        @if($skill->pivot->proficiency==3)
                            متوسط
                        @endif
                        @if($skill->pivot->proficiency==4)
                            ضعیف
                        @endif
                    </p>
                    <p><strong> گواهینامه: </strong> {{($skill->pivot->has_certificate==1?'بله':'خیر')}} </p>
                    <p><strong> توضیحات: </strong>
                        @if(!empty($skill->pivot->description))
                            {{$skill->pivot->description}}
                        @else
                            ندارد
                        @endif
                    </p>
                    @if(!$loop->last)
                        <hr/>
                    @endif

                @endforeach
            </div>
        </div>
    @endif

    @if(!is_null($resume->work_experiences) && $resume->work_experiences->count())
        <div class="com-half">
            <div class=" wrap-pdf">
                <div class="pdf-title1"><h2 style="background: #fff;
            border-bottom: 1px solid #c4161c;
            float: right;
            font-size: 13px;
            font-weight: 700;
            height: 40px;
            line-height: 40px;
            margin-bottom: 15px;
            text-indent: 15px;
            text-align: right;
            border-right: none;
            padding-right: 0px;
            width: 960px;">سوابق شغلی</h2></div>

                @foreach($resume->work_experiences as $work)
                    <p class=""><strong>مورد {{\HR\myFuncs::farsi_numbers($loop->index + 1)}}</strong>:
                        از تاریخ {{\HR\myFuncs::farsi_numbers(str_replace('-','/',$work->start_date))}}
                        تا
                        @if($work->end_date!="")
                            {{\HR\myFuncs::farsi_numbers(str_replace('-','/',$work->end_date))}} </p>
                    @else
                        اکنون
                    @endif
                    <div class="com-half wrap-pdf-inner-3">
                        <p><strong> نام سازمان: </strong> {{$work->title}}  </p>
                        <p><strong> آخرین سمت سازمانی: </strong> {{$work->last_post}} </p>
                        <p style="width: 30%"><strong> شماره
                                تماس: </strong> {{\HR\myFuncs::farsi_numbers($work->phone_number)}} </p>
                        <p style="width: 50%"><strong> علت قطع همکاری: </strong> {{$work->cause_interruption}}  </p>
                        <p style="width: 80%"><strong> اهم وظایف: </strong> {{$work->important_tasks}} </p>
                    </div>
                @endforeach

            </div>
        </div>
    @endif

    @if(isset($resume->questions) && ($resume->questions->count()))

        <div class="com-half">
            <div class=" wrap-pdf">
                <div class="pdf-title1"><h2 style="background: #fff;
            border-bottom: 1px solid #c4161c;
            float: right;
            font-size: 13px;
            font-weight: 700;
            height: 40px;
            line-height: 40px;
            margin-bottom: 15px;
            text-indent: 15px;
            text-align: right;
            border-right: none;
            padding-right: 0px;
            width: 960px;">سوالات تکمیلی</h2></div>
                <p><span style="background-color: #c9d0d9; font-size: 14px; margin-left: 5px;padding: 3px">

                    <strong>سوال</strong>
                </span>
                    <strong> حقوق درخواستی:</strong>
                    <span>
                    {{config('app.salery_range')[$resume->questions->requested_salary] }}
                </span>
                </p>
                <p>
                <span style="background-color: #c9d0d9; font-size: 14px; margin-left: 5px;padding: 3px">
                    <strong>سوال</strong>
                </span>
                    <strong>آیا سابقه محکومیت کیفری داشته اید؟ </strong>
                    @if($resume->questions->crime!=1)
                        خیر
                    @endif
                </p>

                @if($resume->questions->crime==1)
                    <p style="margin-right: 46px;">بله،{{$resume->questions->crime_description}} </p>
                @endif

                <p>
                <span style="background-color: #c9d0d9; font-size: 14px; margin-left: 5px;padding: 3px">
                    <strong>سوال</strong>
                </span>
                    <strong>آيا سابقه بيماري یا جراحی خاصی داشته ايد؟ </strong>
                    @if($resume->questions->sickness==0)
                        خیر
                    @endif
                </p>
                @if($resume->questions->sickness==1)
                    <p style="margin-right: 46px;">
                        بله، @if(!is_null($resume->questions->sickness_description) && !empty($resume->questions->sickness_description))
                            <span style="border-bottom: dashed 1px;">{{$resume->questions->sickness_description}}</span>@endif
                        و @if($resume->questions->treatment==1)
                            کاملا بهبود یافته ام
                        @else
                            هنوز بهبود نیافته ام
                        @endif
                    </p>
                @endif
                <p>
                <span style="background-color: #c9d0d9; font-size: 14px; margin-left: 5px;padding: 3px">
                    <strong>سوال</strong>
                </span>
                    <strong>مهم ترین موفقیت کاری/شخصی شما چه بوده است؟ لطفا توضیح دهید.</strong>
                </p>
                <p style="margin-right: 46px;">
                    {{$resume->questions->Q1}}
                </p>

                <p>
                <span style="background-color: #c9d0d9; font-size: 14px; margin-left: 5px;padding: 3px">
                    <strong>سوال</strong>
                </span>
                    <strong>اهداف کاري/ شخصی خود را براي 5 سال آینده بیان نمائید.</strong>
                </p>
                <p style="margin-right: 46px;">
                    {{$resume->questions->Q2}}
                </p>

                <p>
                <span style="background-color: #c9d0d9; font-size: 14px; margin-left: 5px;padding: 3px">
                    <strong>سوال</strong>
                </span>
                    <strong>بارزترین ارزش، توانایی یا قابلیتی که براي شرکت به همراه می آورید چیست؟</strong>
                </p>
                <p style="margin-right: 46px;">
                    {{$resume->questions->Q3}}
                </p>

                <p>
                <span style="background-color: #c9d0d9; font-size: 14px; margin-left: 5px;padding: 3px">
                    <strong>سوال</strong>
                </span>
                    <strong>درصورتی که نکته خاصی وجود دارد که احتمالا در استخدام/عدم استخدام شما موثر است، بیان
                        نمائید.</strong>@if(empty($resume->questions->Q4) || is_null($resume->questions->Q4))  پاسخی داده نشده @endif
                </p>
                @if(!empty($resume->questions->Q4) && !is_null($resume->questions->Q4))
                <p style="margin-right: 46px;">

                        {{$resume->questions->Q4}}
                </p>
                @endif
                <p>
                <span style="background-color: #c9d0d9; font-size: 14px; margin-left: 5px;padding: 3px">
                    <strong>سوال</strong>
                </span>
                    <strong>آیا از کارکنان گروه صنعتی گلرنگ کسی را میشناسید؟</strong>
                    {{(count($resume->introducers->toArray())?'بله':'خیر')}}
                </p>
                @foreach($resume->introducers as $person)

                    <div class=" com-half wrap-pdf-inner">

                        <p><strong> نام و نام خانوادگی: </strong> {{$person->name}} </p>
                        <p><strong> نام شرکت فعلی: </strong> {{$person->company_name}} </p>
                        <p><strong> نسبت: </strong> {{$person->relevance}} </p>
                        <p><strong> سمت: </strong> {{$person->post}}</p>

                    </div>

                @endforeach

            </div>
        </div>
    @endif
</div>
</body>
