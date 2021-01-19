@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    درخواست ها
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}

    {{ Html::style('/admin/'.config('app.admin_theme').'/jalalicalendar/skins/calendar-system.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/persian-datepicker/persian-datepicker.min.css') }}

    {{ Html::style('/site/'.config('app.site_theme').'/css/chosen.css') }}
    <style>
        .dropup .dropdown-toggle::after {
            border-top: 0;
            border-bottom: .3em solid
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: right;
            min-width: 10rem;
            padding: .5rem 0;
            margin: .125rem 0 0;
            font-size: 1rem;
            color: #212529;
            text-align: right;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .15);
            border-radius: .25rem
        }

        .dropdown-divider {
            height: 0;
            margin: .5rem 0;
            overflow: hidden;
            border-top: 1px solid #e9ecef
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: .25rem 1.5rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            white-space: nowrap;
            background: 0 0;
            border: 0
        }

        .dropdown-item:focus, .dropdown-item:hover {
            color: #16181b;
            text-decoration: none;
            background-color: #f8f9fa
        }

        .dropdown-item.active, .dropdown-item:active {
            color: #fff;
            text-decoration: none;
            background-color: #007bff
        }

        .dropdown-item.disabled, .dropdown-item:disabled {
            color: #868e96;
            background-color: transparent
        }

        .show > a {
            outline: 0
        }

        .dropdown-menu.show {
            display: block
        }

        .dropdown-header {
            display: block;
            padding: .5rem 1.5rem;
            margin-bottom: 0;
            font-size: .875rem;
            color: #868e96;
            white-space: nowrap
        }
    </style>

@endsection
@section('content')
    <img  id="loading" src="/loadinggif.gif" alt="loading" title="loading"
          class="img-responsive  text-right img-{{$apply->id}}"
          style="right:50%;left:50%;width:15%;position:fixed;top:10%;z-index:9999999999;background-size: cover; display: none">

    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>درخواست ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        خانه</a>
                </li>
                <li class="active">
                    <a><strong>
                            درخواست ها برای
                            {{$job->title}}
                        </strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">

        <div class="row">
            {{--Filters--}}
            <div class="col-lg-12">
                <div class="ibox float-e-margins ">
                    <div class="ibox-title">
                        <h5>فیلترها</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="background: #EEEEEE">

                        {{ Form::model($applies, array('method' => 'GET')) }}

                        <div class="form-group col-lg-12">

                            {{ Form::label('all_fields', 'کلیدواژه') }}
                            {{ Form::text('all_fields', old('all_fields'), array('class' => 'form-control')) }}

                        </div>

                        <div class="form-group col-lg-3">

                            {{ Form::label('first_name', 'نام') }}
                            {{ Form::text('first_name', old('first_name'), array('class' => 'form-control')) }}

                        </div>

                        <div class="form-group col-lg-3">

                            {{ Form::label('last_name', 'نام خانوادگی') }}
                            {{ Form::text('last_name', old('last_name'), array('class' => 'form-control')) }}

                        </div>
                        @if( auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <div class="form-group col-lg-3">

                                {{ Form::label('mobile', 'موبایل') }}
                                {{ Form::text('mobile', old('mobile'), array('class' => 'ltr-input form-control')) }}

                            </div>
                        @endif

                        <div class="form-group col-lg-3">
                            {{ Form::label('email', 'ایمیل') }}
                            {{ Form::text('email', old('email'), array('class' => 'ltr-input form-control')) }}
                        </div>

                        <div class="form-group col-lg-3">
                            {{ Form::label('age_range', 'بازه سنی') }}
                            {{ Form::select('age_range',config('app.age_range'),null, array('class' => 'form-control chosen','name'=>'age_range[]','multiple','data-placeholder'=>'انتخاب کنید')) }}
                        </div>


                        @if($job->cities && $job->cities->count() > 1)
                            <div class="form-group col-lg-3">
                                <label for="cities">شهر مورد تقاضا در آگهی</label>
                                <select name="city_id" id="cities" class="form-control chosen">
                                    <option value="" style="color: #ccc;" disabled selected>انتخاب کنید</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}" {{($_GET['city_id'] && $_GET['city_id'] ==$city->id?' selected ':'')}}>{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group col-lg-3">
                            <label for="cities">شهر محل سکونت</label>
                            <select name="home_city_id" id="cities" class="form-control chosen">
                                <option value="" style="color: #ccc;" disabled selected>انتخاب کنید</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}" {{($_GET['home_city_id'] && $_GET['home_city_id'] ==$city->id?' selected ':'')}}>{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-3">

                            {{ Form::label('neighborhood', 'محله/منطقه') }}
                            {{ Form::text('neighborhood', old('neighborhood'), array('class' => 'form-control')) }}

                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-lg-3">
                            <label for="provinces">متقاضی کار در استان</label>
                            <select name="province_id" id="provinces" class="form-control chosen">
                                <option value="" style="color: #ccc;" disabled selected>انتخاب کنید</option>
                                @foreach(\HR\Province::all() as $province)
                                    <option value="{{$province->id}}" {{($_GET['province_id'] && $_GET['province_id'] ==$province->id?' selected ':'')}}>{{$province->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group col-lg-3">
                            {{ Form::label('gender', 'جنسیت') }}
                            {{ Form::select('gender', [0=>'انتخاب کنید',1=>'مرد',2=>'زن'],null, array('class' => 'form-control chosen')) }}
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="last_degree">سطح تحصیلات</label>
                            <select name="last_degree[]" multiple id="last_degree" data-placeholder="انتخاب کنید"
                                    class="form-control chosen">
                                @foreach(config('app.enum_last_degree') as $val => $degree)
                                    <option value="{{$val}}" {{($degree_selected && in_array($val,$degree_selected )?' selected="selected" ':'')}}>{{$degree}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="clearfix"></div>
                        
                        <div class="col-lg-3">
                        <div class="form-group" id="data_1">
                            <label class="font-noraml">
                                 از  </label> 
                            <div class="input-group date">
                                <input autocomplete="off"
                                        type="text"
                                        class="form-control ltr-input"
                                        name="first_date"
                                        value="{{$first_date}}"
                                >
                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar">
                                                    </i>
                                </span>
                            </div>
                        </div>
                        </div>
                          
                        <div class="col-lg-3">
                        <div class="form-group" id="data_2">
                            <label class="font-noraml">
                                 تا  </label> 
                            <div class="input-group date">
                                <input
                                        type="text"
                                        class="form-control ltr-input"
                                        name="last_date"
                                        value="{{$last_date}}"
                                >
                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar">
                                                    </i>
                                </span>
                            </div>
                        </div>
                        </div>
                        
                        <div class="clearfix"></div>
                        
                        
                        
                        <button class="btn btn-primary pull-left" type="submit">اعمال فیلترهای جستجو</button>
                        <a href="{{route('applies.index',$job->id)}}" style="margin-left: 2px"
                           class="btn btn-danger pull-right">حذف فیلتر ها</a>
                        <div class="clearfix"></div>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
            {{--End of Filters--}}

            <div class="col-lg-12">

                <div class="col-lg-2">
                    <a href="{{route('applies.index', ['id' => $job->id,'status'=>1])}}">
                        <div class="widget style1 yellow-bg widget-left-bg{{$status==1?'-active':''}}">
                            <div class="row">
                                <div class="col-xs-4 widget-right-yellow">
                                    <i class="fa fa-square-o fa-3x" style="line-height: 100px"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span style="line-height: 35px"> درخواست بررسی نشده </span>
                                    <h2 class="font-bold">{{$new_applies}}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-2">
                    <a href="{{route('applies.index', ['id' => $job->id,'status'=>4])}}">
                        <div class="widget style1 navy-bg widget-left-bg{{$status==4?'-active':''}}">
                            <div class="row">
                                <div class="col-xs-4 widget-right-navy">
                                    <i class="fa fa-check-square-o fa-3x" style="line-height: 100px"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span style="line-height: 35px"> لیست برگزیده </span>
                                    <h2 class="font-bold">{{$seen_applies}}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-2">

                    <a href="{{route('applies.index', ['id' => $job->id,'status'=>3])}}">
                        <div class="widget style1 red-bg widget-left-bg{{$status==3?'-active':''}}">
                            <div class="row">
                                <div class="col-xs-4 widget-right-red">
                                    <i class="fa fa-times-rectangle fa-3x" style="line-height: 100px"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span style="line-height: 35px"> لیست نامتناسب </span>
                                    <h2 class="font-bold">{{$rejected_applies}}</h2>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>

                <div class="col-lg-2">
                    <a href="{{route('applies.index', ['id' => $job->id,'status'=>2])}}">
                        <div class="widget style2 lazur-bg widget-left-bg{{$status==2?'-active':''}}">
                            <div class="row">
                                <div class="col-xs-4 widget-right-lazur">
                                    <i class="fa fa-check-square fa-3x" style="line-height: 100px"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span style="line-height: 35px"> لیست تایید نهایی </span>
                                    <h2 class="font-bold">{{$accepted_applies}}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-2">
                    <a href="{{route('applies.index', ['id' => $job->id,'status'=>9])}}">
                        <div class="widget style1 yellow-bg widget-left-bg{{$status==9?'-active':''}}">
                            <div class="row">
                                <div class="col-xs-4 widget-right-yellow">
                                    <i class="fa fa-square-o fa-3x" style="line-height: 100px"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span style="line-height: 35px">  اولویت اول </span>
                                    <h2 class="font-bold">{{$first_priority_applies}}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                
                
                <div class="col-lg-2">
                    <a href="{{route('applies.index', ['id' => $job->id,'status'=>10])}}">
                        <div class="widget style1 yellow-bg widget-left-bg{{$status==10?'-active':''}}">
                            <div class="row">
                                <div class="col-xs-4 widget-right-yellow">
                                    <i class="fa fa-square-o fa-3x" style="line-height: 100px"></i>
                                </div>
                                <div class="col-xs-8 text-right">
                                    <span style="line-height: 35px">اولویت دوم</span>
                                    <h2 class="font-bold">{{$second_priority_applies}}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12" style="margin-bottom: 10px">
                    <button id="select-all" style="width: 100px;" class="btn btn-default"><i
                                class="fa fa-square-o"></i> انتخاب همه
                    </button>
                    <button id="de-select-all" style="display: none;width: 100px;"
                            class="btn btn-warning"><i class="fa fa-check-square-o"></i> انتخاب همه
                    </button>
                    <a title="برگزیده"
                       onclick="$('#selects-form').attr('action', '{{route('applies.seenAll')}}'); $('#selects-form').submit();"
                       style="margin-right: 10px;" class="btn btn-primary"><i style="font-size: 20px;"
                                                                              class="fa fa-check-square-o"></i> </a>
                    {{--@if(auth()->user()->hasAnyRole('برنامه نویس'))--}}
                    {{--<a title="خروجی اکسل از رزومه های فیلتر شده" style="margin-right: 10px;"--}}
                    {{--href="/adpanel/apply-list-export/{{$job->id}}/{{$status}}{{(string)$query_string}}"--}}
                    {{--class="btn btn-primary pull-left"><i style="font-size: 20px;" class="fa fa-file-excel-o"></i></a>--}}
                    {{--@endif--}}
                </div>

                <div class="col-lg-12">
                    <form method="post" id="selects-form">
                        <div class="table-responsive">


                            <table class="table table-striped table-bordered table-hover">



                                @foreach($applies as $apply)
                                    <input type="hidden" id="reject_reason_{{$apply->id}}"
                                           value="{{$apply->reject_reason}}">
                                    <input type="hidden" id="reject_description_{{$apply->id}}"
                                           value="{{$apply->reject_description}}">
                                    <tr id="ajax-res-{{$apply->id}}" ></tr>
                                    <tr id="tr-{{$apply->id}}" >

                                        <td><input id="select-{{$apply->id}}" class="apply-check" value="1"
                                                   name="selected_applies[{{$apply->id}}]"
                                                   type="checkbox">
                                        </td>
                                        <td >
                                            <p title="تاریخ درخواست">
                                                {{ JDate::createFromCarbon(Carbon::parse($apply->created_at))->format('Y/m/d') }}
                                            </p>
                                        </td>
                                        <td>
                                            <div class="col-lg-3">
                                                <div class="col-lg-6">

                                                    <img src="{{$apply->user->avatar}}" class="img-circle"
                                                         style="width: 80px;height: 80px;padding:1px;border:1px #888 solid;"/>
                                                </div>
                                                <div class="col-lg-6">
                                                    <p> @if($apply->user->profile->gender == 1)<i
                                                                style="font-size: 18px"
                                                                class="fa fa-male"></i>@else <i
                                                                style="font-size: 18px"
                                                                class="fa fa-female"></i>@endif

                                                        {!!'<span id="first_name_'.$apply->id.'">'.$apply->user->first_name.'</span> '.$apply->user->last_name!!}
                                                        @if(\HR\myFuncs::check_blacklist($apply->user->profile->national_code))
                                                            <i style="color:red; cursor: pointer;" class="fa fa-warning" title="black_list"></i>
                                                        @endif
                                                        @if(\HR\myFuncs::check_worker_state($user->profile->national_code )== 'فعال')
                                                            <span title="همکار" style="color:red">G</span> &nbsp;
                                                        @elseif(\HR\myFuncs::check_worker_state($user->profile->national_code )== 'غيرفعال')
                                                            <span title="همکار سابق" style="color:slategray">G</span>
                                                        @endif
                                                    </p>
                                                    <?php
                                                    $age = substr($apply->user->profile->born_date, 0, 4); // sample : 1361
                                                    /*$year = \p3ym4n\JDate\JDate::now()->year;// sample : 1397
                                                    $years_old = $year - $age;*/
                                                    ?>
                                                    <p>{{ $apply->user->profile->age() }} ساله</p>
                                                    <p>آخرین
                                                        ورود: {{ JDate::createFromCarbon(Carbon::parse($apply->user->last_login))->format('Y/m/d') }}</p>
                                                    @if(\HR\WorkerList::where('national_code', $apply->user->profile->national_code)->first())
                                                        <p style="color:darkgoldenrod;"><i class="fa fa-star" ></i> کارمند تعدیلی از {{\HR\WorkerList::where('national_code', $apply->user->profile->national_code)->first()->company->name}}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <p title="پست فعلی"><i class="fa fa-briefcase"></i>
                                                    <b>{{$apply->user->resume->work_experiences()->orderBy('start_date', 'desc')->first()->last_post}}</b>
                                                </p>
                                                <p title="شرکت فعلی"><b><i
                                                                class="fa fa-industry"></i> {{$apply->user->resume->work_experiences()->orderBy('start_date', 'desc')->first()->title}}
                                                    </b></p>
                                                <p title="آخرین رشته تحصیلی"><b><i
                                                                class="fa fa-graduation-cap"></i> {{$apply->user->resume->educational_details()->orderBy('start_date', 'desc')->first()->field}}
                                                    </b></p>
                                                <p title="آخرین دانشگاه"><i class="fa fa-university"></i>
                                                    <b>{{$apply->user->resume->educational_details()->orderBy('start_date', 'desc')->first()->institute}}</b>
                                                </p>
                                            </div>
                                            <div class="col-lg-2">
                                                <p title="حقوق درخواستی"><i
                                                            class="fa fa-dollarZ"></i> {{ config('app.salery_range')[$apply->user->resume->questions->requested_salary] }}
                                                </p>
                                                @if(auth()->user()->hasPermissionTo('رزومه-مشاهده') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                                    <p>
                                                        <a target="_blank"
                                                           href="{{route('resumes.show',$apply->user->resume->id)}}">
                                                            <button style="width: 85px; text-align: left;" type="button"
                                                                    class="btn btn-sm btn-primary btn-outline">
                                                                GIG CV <i class="fa fa-download"></i>
                                                            </button>
                                                        </a>
                                                    </p>
                                                @endif
                                                @if(auth()->user()->hasPermissionTo('cv-مشاهده') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس') && Storage::disk('resume')->exists('cv/'.\HR\myFuncs::spilit_string($apply->user->id).'/resume.pdf'))
                                                    <p>
                                                        <a target="_blank"
                                                           href="{{route('cv.show',$apply->user->id)}}"
                                                        >

                                                            <button style="width: 85px; text-align: left;" type="button"

                                                                    class="btn btn-sm btn-primary btn-outline"
                                                            >
                                                                CV <i class="fa fa-download"></i>
                                                            </button>
                                                        </a>
                                                    </p>
                                                @endif


                                            </div>
                                            {{--ADD TO :--}}
                                            <div class="col-lg-3">
                                                @if($apply->status != 4 && $delete_button == 0 )
                                                <select   class="form-control chosen"  onchange="changeStatus(this,{{$apply->id}})">
                                                    <option>افزودن به </option>
                                                @if($apply->status == 10 && $delete_button == 0 )

                                                  
                                                    
                                                    <option value="secondPriorityAjax">
                                                      اولویت اول
                                                    </option>
                                                
                                                @endif    
                                                @if($apply->status != 1 && ($apply->status != 9 && $apply->status != 10) && $delete_button == 0 )
                                                 
                                                    <option value="m2AjaxBaresiNashodeh">
                                                         بررسی نشده
                                                    </option>
                                                @endif
                                                @if($apply->status != 4 && ($apply->status != 9 && $apply->status != 10) && $delete_button == 0 )
                                                   
<!---->
                                                    <option value="m2Ajax">
                                                        برگزیده
                                                    </option>
                                                    
                                                    <option value="firstPriorityAjax">
                                                        اولویت اول
                                                    </option>
                                                    
                                                    <option value="secondPriorityAjax">
                                                        اولویت دوم
                                                    </option>




                                                @endif
                                                
                                                @if($apply->status == 9 && $delete_button == 0 )
                                                
                                                 <option value="secondPriorityAjax">
                                                        اولویت دوم
                                                    </option>
                                                @endif    
                                                @if($apply->status == 4 && $delete_button == 0 )
                                                   
                                                  
                                                    <option value="m2AjaxAccept">
                                                        تایید نهایی
                                                    </option>
                                                @endif



                                                @if($apply->status != 3 &&($apply->status != 9 ) && $delete_button == 0 )

                                                  
                                                    
                                                    <option value="namotenaseb">
                                                      نامتناسب
                                                    </option>
                                                
                                                @endif
                                                
                                                
                                                </select>
                                                @endif
                                                
                                                @if($apply->status == 3 && ($apply->reject_reason && !empty($apply->reject_description)) )
                                                   <button type="button" onclick="apply_id ='{{$apply->id}}';"
                                                            class="btn btn-xs btn-info dim user-reject-reason">
                                                        <i class="fa fa-info"></i>
                                                        علت رد
                                                    </button>
                                                    
                                                @endif
                                                
                                                <p><a target="_blank"
                                                      href="{{route('users.apply_list',$apply->user->id)}}">مشاهده سایر
                                                        درخواست ها</a></p>
                                                @if($apply->answers->count())
                                                    <p><a onclick="
                                                        @foreach($job->questions as $question)
                                                                $('#answer_{{$question->id}}').html('{{\HR\JobQuestionAnswer::where('question_id',$question->id)->first()->answer}}');
                                                        @endforeach $('#questionsModal').modal('show');
                                                                " href="javascript:void('')">پاسخ سوالات</a></p>
                                                @endif
                                            </div>

                                            <div class="col-lg-1">
                                                <p>عملیات:</p>
                                                @if($apply->ticket_reply_from_user())
                                                    <a target="_blank" title="پاسخ به پیام ارسالی از سمت کاربر"
                                                       href="{{route('tickets.show',[$apply->ticket_reply_from_user()])}}">

                                                        <button class="btn btn-sm btn-danger dim" type="button">
                                                            <i class="fa fa-reply"></i>
                                                        </button>
                                                    </a>
                                                @else
                                                    <a target="_blank" title="ارسال پیام"
                                                       @if($apply->user_ticket())
                                                       href="{{route('tickets.show',[$apply->user_ticket()])}}"
                                                       @else
                                                       href="{{'/adpanel/tickets/create/'.$apply->user_id.'/'.$apply->job->id}}"
                                                            @endif
                                                    >
                                                        <button class="btn btn-sm btn-warning dim" type="button">
                                                            <i class="fa fa-envelope"></i>
                                                        </button>
                                                    </a>
                                                @endif


                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </form>
                </div>
                <div class="clearfix"></div>
                {!! $applies->appends(\Illuminate\Support\Facades\Input::except('page'))->links() !!}
            </div>
        </div>
    </div>
    @if($status != 3)
        <div id="rejectReasonModal" class="modal fade" role="dialog">
            <div class="col-lg-9" style="margin: 30px auto;float: none;">
                <div class="modal-content">
                    <form action="javascript:void(0);" id="rejectReasonForm" method="POST" onsubmit="return m2Ajaxrejectform();">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">دلیل رد شدن:</h4>
                        </div>
                        <div class="modal-body">

                            <div class="col-lg-4 form-group">
                                <div class="col-lg-12">
                                    <label for="reject_reason">دلیل رد</label>
                                    <select
                                            required oninvalid="this.setCustomValidity('انتخاب دلیل رد اجباری می باشد')" oninput="setCustomValidity('')"
                                            class="form-control" name="reject_reason" id="reject_reason">
                                        <option value="" disabled="" style="color: #ccc;" selected>انتخاب کنید</option>
                                        @foreach($reject_reasons as $reason)
                                            <option value="{{$reason->id}}">{{$reason->reason}}</option>
                                        @endforeach
                                        <option value="0">سایر دلایل</option>
                                    </select>
                                </div>

                                <div class="col-lg-12">
                                    <label for="reject_description">توضیحات</label>
                                    <textarea name="reject_description" rows="5" id="reject_description"
                                              oninvalid="this.setCustomValidity('وفتی سایر دلایل را انتخاب می کنید، ارائه توضیحات اجباری می باشد')" oninput="setCustomValidity('')"
                                              class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-8 form-group">

                                <div class="col-lg-12">
                                    <label>متن ارسالی</label>
                                    <hr>
                                    <p class="border-dashed-italic"></p>
                                    <p><span id="apply_user_name">امیر</span> عزیز، سلام</p>
                                    <p>
                                        ضمن تشکر از تمایل شما به همکاری با گروه صنعتی گلرنگ، به استحضار می رساند، بررسی
                                        اولیه
                                        درخواست شما برای فرصت شغلی «<strong>{{$job->title}}</strong> در شرکت
                                        <strong>{{$job->company->name}}</strong>» انجام شد و متاسفانه <span
                                                id="reason_of_reject" style="text-decoration: underline;"></span> امکان
                                        همکاری در این مقطع زمانی میسر نمی باشد.
                                        امیدواریم بتوانیم در‌ آینده
                                        نزدیک، زمینه پیوستن به خانواده گلرنگ را برایتان فراهم آوریم.
                                    </p>
                                    <p id="admin_decs" style="display: none;"><strong>توضیحات تکمیلی</strong></p>
                                    <pre style="display: none;background-color: #eee" id="desc_text"></pre>
                                    <br>
                                    <p>به امید موفقیت</p>
                                    <p>دپارتمان منابع انسانی گروه صنعتی گلرنگ</p>
                                    <p class="border-dashed-italic"></p>
                                </div>
                                <div class="clearfix"></div>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
                            <input id="reject_btn" type="submit" value="ثبت" class="btn btn-primary">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    @endif
    @if($status == 3)
        <div id="rejectReasonModal" class="modal fade" role="dialog">
            <div class="col-lg-9" style="margin: 30px auto;float: none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">دلیل رد شدن:</h4>
                    </div>
                    <div class="modal-body">

                        <div class="col-lg-4 form-group">
                            <div class="col-lg-12">
                                <label for="reject_reason">دلیل رد</label>
                                <select disabled required class="form-control" name="reject_reason" id="reject_reason">
                                    <option value="" disabled="" selected>انتخاب کنید</option>
                                    @foreach($reject_reasons as $reason)
                                        <option value="{{$reason->id}}">{{$reason->reason}}</option>
                                    @endforeach
                                    <option value="0">سایر دلایل</option>
                                </select>
                            </div>

                            <div class="col-lg-12">
                                <label for="reject_description">توضیحات</label>
                                <textarea disabled name="reject_description" rows="5" id="reject_description"
                                          class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-8 form-group">

                            <div class="col-lg-12">
                                <label>متن ارسالی</label>
                                <hr>
                                <p class="border-dashed-italic"></p>
                                <p><span id="apply_user_name">امیر</span> عزیز، سلام</p>
                                <p>
                                    ضمن تشکر از تمایل شما به همکاری با گروه صنعتی گلرنگ، به استحضار می رساند، بررسی
                                    اولیه
                                    درخواست شما برای فرصت شغلی «<strong>{{$job->title}}</strong> در شرکت
                                    <strong>{{$job->company->name}}</strong>» انجام شد و متاسفانه <span
                                            id="reason_of_reject" style="text-decoration: underline;"></span> امکان
                                    همکاری در این مقطع زمانی میسر نمی باشد.
                                    امیدواریم بتوانیم در‌ آینده
                                    نزدیک، زمینه پیوستن به خانواده گلرنگ را برایتان فراهم آوریم.
                                </p>
                                <p id="admin_decs" style="display: none;"><strong>توضیحات تکمیلی</strong></p>
                                <pre style="display: none;background-color: #eee" id="desc_text"></pre>
                                <br>
                                <p>به امید موفقیت</p>
                                <p>دپارتمان منابع انسانی گروه صنعتی گلرنگ</p>
                                <p class="border-dashed-italic"></p>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
                    </div>
                </div>

            </div>
        </div>
    @endif
    @if($job->questions->count())
        <div id="questionsModal" class="modal fade" role="dialog">
            <div class="col-lg-7" style="margin: 30px auto;float: none;">
                <div class="modal-content">
                    <div class="modal-header" style="padding: 10px 15px 0 15px;">
                        <button type="button" class="close" data-dismiss="modal" style="float: left;">&times;</button>
                        <h4 class="modal-title" style="border: 0; margin: 0;">سوالات کار فرما</h4>
                    </div>
                    <input type="hidden" value="{{$job->id}}" name="job_id">
                    <div class="modal-body">
                        <div class="col-lg-12" style="margin: 15px 0;">
                            @foreach($job->questions as $question)
                                <div class="form-group">
                                    <p><strong>{{$question->question}}</strong></p>
                                    <p id="answer_{{$question->id}}"></p>
                                </div>
                            @endforeach
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts_footer')
    <!-- Mainly scripts -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/jquery-2.1.1.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/bootstrap.min.js') }}

    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/metisMenu/jquery.metisMenu.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/slimscroll/jquery.slimscroll.min.js') }}

    <!-- Custom and plugin javascript -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/rada.js') }}
    <!-- jQuery UI -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/jquery-ui/jquery-ui.min.js') }}


    <!--### Jalali Popup Calendar.MMKIA ###-->
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/jalali.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/calendar.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/calendar-setup.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/lang/calendar-fa.js') }}  
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/persian-datepicker/persian-date.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/persian-datepicker/persian-datepicker.min.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/chosen.jquery.js') }}

@endsection
@section('scripts_page')

    <script>
    
    
    function changeStatus(selectObject,applyid)
    {
        var value = selectObject.value; 
        if(value =="m2AjaxBaresiNashodeh")
            m2AjaxBaresiNashodeh(applyid);
        else if(value == "m2Ajax")   
            m2Ajax(applyid)
        else if(value == "m2AjaxAccept")   
            m2AjaxAccept(applyid) 
        else if(value == "firstPriorityAjax")   
            firstPriorityAjax(applyid)  
        else if(value == "secondPriorityAjax")   
            secondPriorityAjax(applyid)
        else if(value == "namotenaseb")   
        {
            apply_id = applyid;
            $('#rejectReasonModal').modal('show');
    
        }
        
    }
    
    
    @if($first_date)
    $('#data_1 .input-group.date > input').pDatepicker({
            format: 'YYYY-MM-DD',
            timePicker: {
                enabled: true
            },
            autoClose: true
        });
        @else
         $('#data_1 .input-group.date > input').pDatepicker({
            format: 'YYYY-MM-DD',
            timePicker: {
                enabled: true
            },
            autoClose: true
        }).val('');
        @endif

    $('#data_2 .input-group.date > input').pDatepicker({
            format: 'YYYY-MM-DD',
            timePicker: {
                enabled: true
            },
            autoClose: true
        });
    
        var apply_id = '';

        function scrollto(id) {
            var etop = $('#' + id).offset().top;
            $(window).scrollTop(etop);

        }

        $(document).ready(function () {
            $('.chosen').chosen();
            @if(Session::has('jumpTo'))
            scrollto("apply{{session('jumpTo')}}");
            @endif
        });

        $('.confirm_alert').click(function () {
            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }
        });

        $('#select-all').click(function () {
            $('.apply-check').prop('checked', true);
            $(this).hide();
            $('#de-select-all').show();
        });

        $('#de-select-all').click(function () {
            $('.apply-check').prop('checked', false);
            $(this).hide();
            $('#select-all').show();
        });

        $('#reject_reason').on('change', function () {
            if ($(this).val() == 0)
            {
                $('#reason_of_reject').html('');
                $('#reject_description').attr('required', 'required')
            }
            else {
                $('#reason_of_reject').html('به دلیل ' + $("#reject_reason option:selected").text());
                $('#reject_description').removeAttr('required')
            }
        });

        $('#reject_description').on('keyup', function () {
            $('#desc_text').html($(this).val());
            if ($(this).val() === '') {
                $('#desc_text').hide();
                $('#admin_decs').hide();
            }
            else {
                $('#desc_text').show();
                $('#admin_decs').show();
            }
        });
        $('#rejectReasonModal').on('show.bs.modal', function () {
            $('#apply_user_name').html($('#first_name_' + apply_id).text());
        });

        $('.user-reject-reason').on('click', function () {
            $('#rejectReasonModal').modal('show');
            $('#reject_reason').val($('#reject_reason_' + apply_id).val());

            if ($('#reject_description_' + apply_id).val() === '') {
                $('#desc_text').hide();
                $('#admin_decs').hide();
            }
            else {
                $('#reject_description').val($('#reject_description_' + apply_id).val());
                $('#desc_text').html($('#reject_description').val());
                $('#desc_text').show();
                $('#admin_decs').show();
            }
        });
        //-- M.Mahdavi Kia --//
        //

        var m2Ajax_click_count = 0
        function m2Ajax(_id){
            $('button').prop('disabled',true);
            m2Ajax_click_count++;
            if(m2Ajax_click_count == 1)

            {
                $('.row').css( "background-color","#fff !important");
                $('.row').css( "opacity","0.7");
                $('#loading').show();



                $.ajax({
                    type:'POST',
                    url:"/adpanel/apply-list/ajax/seen",
                    data:"id="+_id+"&_token=<?=csrf_token();?>",
                    success:function(data) {
                        m2Ajax_click_count = 0;
                        $('button').prop('disabled',false);
                        $('.row').css( "opacity","1");
                         console.log(data)



                       var obj = JSON.parse(data);
                       var status = obj[0]['has_error'];
                        var message = obj[0]['message'];
                        $('#loading').hide();
                        
                        

                        if(status == 0)
                        {

                            // $('#tr-'+_id)
                            $('#ajax-res-'+_id).html('<td class="col-lg-12" style="padding:20px;text-align:center;vertical-align: middle;background:green;color:white;" colspan="3">'+message+'</td>');
                            $('#ajax-res-'+_id).show();
                            setTimeout(function(){
                                $('#ajax-res-'+_id).css('display','none');// or fade, css display however you'd like.
                            }, 3000);




                        }
                        else
                        {
                            $('#ajax-res-'+_id).html('<td class="col-lg-12" style="padding:20px;text-align:center;vertical-align: middle;background:red;color:white;" colspan="3">'+message+'</td>');
                            $('#ajax-res-'+_id).show();
                            setTimeout(function(){
                                $('#ajax-res-'+_id).css('display','none');// or fade, css display however you'd like.
                            }, 3000);



                        }

                    }
                });
            }
            else
            {

                return false;

            }



        }
        function firstPriorityAjax(_id){
            $('button').prop('disabled',true);
            m2Ajax_click_count++;
            if(m2Ajax_click_count == 1)

            {
                $('.row').css( "background-color","#fff !important");
                $('.row').css( "opacity","0.7");
                $('#loading').show();



                $.ajax({
                    type:'POST',
                    url:"/adpanel/apply-list/ajax/first_priority",
                    data:"id="+_id+"&_token=<?=csrf_token();?>",
                    success:function(data) {
                        m2Ajax_click_count = 0;
                        $('button').prop('disabled',false);
                        $('.row').css( "opacity","1");
                         console.log(data)



                       var obj = JSON.parse(data);
                       var status = obj[0]['has_error'];
                        var message = obj[0]['message'];
                        $('#loading').hide();
                        
                        

                        if(status == 0)
                        {

                            // $('#tr-'+_id)
                            $('#ajax-res-'+_id).html('<td class="col-lg-12" style="padding:20px;text-align:center;vertical-align: middle;background:green;color:white;" colspan="3">'+message+'</td>');
                            $('#ajax-res-'+_id).show();
                            setTimeout(function(){
                                $('#ajax-res-'+_id).css('display','none');// or fade, css display however you'd like.
                            }, 3000);




                        }
                        else
                        {
                            $('#ajax-res-'+_id).html('<td class="col-lg-12" style="padding:20px;text-align:center;vertical-align: middle;background:red;color:white;" colspan="3">'+message+'</td>');
                            $('#ajax-res-'+_id).show();
                            setTimeout(function(){
                                $('#ajax-res-'+_id).css('display','none');// or fade, css display however you'd like.
                            }, 3000);



                        }

                    }
                });
            }
            else
            {

                return false;

            }



        }
        function secondPriorityAjax(_id){
            $('button').prop('disabled',true);
            m2Ajax_click_count++;
            if(m2Ajax_click_count == 1)

            {
                $('.row').css( "background-color","#fff !important");
                $('.row').css( "opacity","0.7");
                $('#loading').show();



                $.ajax({
                    type:'POST',
                    url:"/adpanel/apply-list/ajax/second_priority",
                    data:"id="+_id+"&_token=<?=csrf_token();?>",
                    success:function(data) {
                        m2Ajax_click_count = 0;
                        $('button').prop('disabled',false);
                        $('.row').css( "opacity","1");
                         console.log(data)



                       var obj = JSON.parse(data);
                       var status = obj[0]['has_error'];
                        var message = obj[0]['message'];
                        $('#loading').hide();
                        
                        

                        if(status == 0)
                        {

                            // $('#tr-'+_id)
                            $('#ajax-res-'+_id).html('<td class="col-lg-12" style="padding:20px;text-align:center;vertical-align: middle;background:green;color:white;" colspan="3">'+message+'</td>');
                            $('#ajax-res-'+_id).show();
                            setTimeout(function(){
                                $('#ajax-res-'+_id).css('display','none');// or fade, css display however you'd like.
                            }, 3000);




                        }
                        else
                        {
                            $('#ajax-res-'+_id).html('<td class="col-lg-12" style="padding:20px;text-align:center;vertical-align: middle;background:red;color:white;" colspan="3">'+message+'</td>');
                            $('#ajax-res-'+_id).show();
                            setTimeout(function(){
                                $('#ajax-res-'+_id).css('display','none');// or fade, css display however you'd like.
                            }, 3000);



                        }

                    }
                });
            }
            else
            {

                return false;

            }



        }

        function m2AjaxAccept(_id){
            $.ajax({
                type:'POST',
                url:"/adpanel/apply-list/ajax/accept",
                data:"id="+_id+"&_token=<?=csrf_token();?>",
                success:function(data) {
                    $('#tr-'+_id).html('<td class="col-lg-12" style="padding:20px;text-align:center;vertical-align: middle;background:green;color:white;" colspan="3">'+data+'</td>');
                }
            });
        }

        function m2AjaxBaresiNashodeh(_id){
            $.ajax({
                type:'POST',
                url:"/adpanel/apply-list/ajax/waiting",
                data:"id="+_id+"&_token=<?=csrf_token();?>",
                success:function(data) {
                    $('#tr-'+_id).html('<td class="col-lg-12" style="padding:20px;text-align:center;vertical-align: middle;background:green;color:white;" colspan="3">'+data+'</td>');
                }
            });
        }

        function m2Ajaxrejectform(){
            let _id = apply_id;
            let reject_reason = $('#reject_reason option:selected').val();
            let reject_description = $('#reject_description').val();

            $('#tr-'+_id).css({'opacity':0.2});
            $('#reject_btn').attr('disabled',true);
            $('#reject_btn').attr('value','کمی صبر کنید');

            $.ajax({
                type:'POST',
                url:"/adpanel/apply-list/ajax/reject",
                data:"id="+_id+"&reject_reason="+reject_reason+"&reject_description="+reject_description+"&_token=<?=csrf_token();?>",
                success:function(data) {
                    alert(data);
                    $('#tr-'+_id).remove();
                    $('#reject_btn').attr('disabled',false);
                    $('#reject_btn').attr('value','ثبت');
                    $('#rejectReasonModal').modal('toggle');
                },
                error:function(data){
                    alert(data);
                    $('#tr-'+_id).css({'opacity':1});
                    $('#reject_btn').attr('disabled',false);
                    $('#reject_btn').attr('value','ثبت');
                }

            });
            return false;
        }

    </script>

@endsection
