@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    کاربران
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/jalalicalendar/skins/calendar-system.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/persian-datepicker/persian-datepicker.min.css') }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/chosen.css') }}
    <!-- Sweet Alert -->
@endsection
@section('content')
    <div class="clearfix wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>کاربران سیستم</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        خانه</a>
                </li>
                <li class="active">
                    <a><strong>
                            کاربران جدول اطلاعات</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">

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

                        {{ Form::model($users, array('method' => 'GET')) }}

                        <div class="form-group col-lg-3">

                            {{ Form::label('first_name', 'نام') }}
                            {{ Form::text('first_name', old('first_name'), array('class' => 'form-control')) }}

                        </div>

                        <div class="form-group col-lg-3">

                            {{ Form::label('last_name', 'نام خانوادگی') }}
                            {{ Form::text('last_name', old('last_name'), array('class' => 'form-control')) }}

                        </div>

                        <div class="form-group col-lg-3">

                            {{ Form::label('mobile', 'موبایل') }}
                            {{ Form::text('mobile', old('mobile'), array('class' => 'ltr-input form-control')) }}

                        </div>

                        <div class="form-group col-lg-3">

                            {{ Form::label('email', 'ایمیل') }}
                            {{ Form::text('email', old('email'), array('class' => 'ltr-input form-control')) }}

                        </div>
                       
                        <div class="form-group col-lg-3">
                            {{ Form::label('age_range', 'بازه سنی') }}
                            {{ Form::select('age_range',config('app.age_range'),null, array('class' => 'form-control chosen','name'=>'age_range[]','multiple','data-placeholder'=>'انتخاب کنید')) }}
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="cities">شهر محل سکونت</label>
                            <select name="city_id" id="cities" class="form-control chosen">
                                <option value="" selected>انتخاب کنید</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}" {{($_GET['city_id'] && $_GET['city_id'] ==$city->id?' selected ':'')}}>{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="cities">متقاضی کار در استان</label>
                            <select name="province_id" id="cities" class="form-control chosen">
                                <option value="" selected>انتخاب کنید</option>
                                @foreach($provinces as $province)
                                    <option value="{{$province->id}}" {{($_GET['province_id'] && $_GET['province_id'] ==$province->id?' selected ':'')}}>{{$province->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-3">

                            {{ Form::label('neighborhood', 'محله/منطقه') }}
                            {{ Form::text('neighborhood', old('neighborhood'), array('class' => 'form-control')) }}

                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-lg-3">
                            {{ Form::label('gender', 'جنسیت') }}
                            {{ Form::select('gender', [0=>'یک گزینه انتخاب کنید',1=>'مرد',2=>'زن'],null, array('class' => 'form-control chosen')) }}
                        </div>
                        {{--
                        M.Mahdavi Kia
                        --}}
                        @php
                        $sakhtaar = config('app.enum_institute_structure');
                        array_unshift($sakhtaar,[""=>"یک گزینه انتخاب کنید"]);
                        @endphp
                        <div class="form-group col-lg-3">
                            {{ Form::label('sakhtaar', 'ساختار موسسه') }}
                            {{ Form::select('sakhtaar', $sakhtaar,null, array('class' => 'form-control chosen')) }}
                        </div>

                        {{--

                        Mahdavi Kia #*#
                        --}}
                        <div class="form-group col-lg-3">
                            {{ Form::label('keyword', 'کلید واژه عمومی') }}
                            {{ Form::text('keyword', old('keyword'), array('class' => 'form-control','minlength'=>3)) }}
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-lg-6">
                            <label for="ptrs">زمینه تخصصی</label>
                            <select name="ptrs[]" multiple id="ptrs" data-placeholder="انتخاب کنید"
                                    class="form-control chosen">
                                @foreach($ptrs as $ptr)
                                    <option value="{{$ptr->id}}" {{($ptrs_selected && in_array($ptr->id,$ptrs_selected )?' selected="selected" ':'')}}>{{$ptr->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="industries">حوزه صنعت</label>
                            <select name="industries[]" multiple id="industries" data-placeholder="انتخاب کنید"
                                    class="form-control chosen">
                                @foreach($industries as $industry)
                                    <option value="{{$industry->id}}" {{($industries_selected && in_array($industry->id,$industries_selected )?' selected="selected" ':'')}}>{{$industry->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="last_degree">آخرین مقطع تحصیلی</label>
                            <select name="last_degree[]" multiple id="last_degree" data-placeholder="انتخاب کنید"
                                    class="form-control chosen">
                                @foreach(config('app.enum_last_degree') as $val => $degree)
                                    <option value="{{$val}}" {{($degree_selected && in_array($val,$degree_selected )?' selected="selected" ':'')}}>{{$degree}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="fields">آخرین رشته تحصیلی</label>
                            <select name="fields[]" multiple id="fields" data-placeholder="انتخاب کنید"
                                    class="form-control chosen">
                                @foreach($fields as $field)
                                    <option value="{{$field}}" {{($fields_selected && in_array($field,$fields_selected )?' selected="selected" ':'')}}>{{$field}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="clearfix"></div>
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
                        @if(isset($_GET['first_name']))
                            <a href="{{route('users.index')}}" style="margin-left: 2px"
                               class="btn btn-danger pull-right">حذف فیلتر ها</a>
                        @endif
                        <div class="clearfix"></div>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>

            <div class="col-lg-12">

                <a href="{{ route('users.export_csv') }}{{(string)$query_string}}" class="btn btn-primary"><i
                            class="fa fa-file-excel-o"></i>خروجی
                    اکسل از کاربران دارای رزومه</a>
                <a href="{{ route('users.export_csv_no_resume') }}{{(string)$query_string}}" class="btn btn-primary"><i
                            class="fa fa-file-excel-o"></i>خروجی
                    اکسل از کاربران بدون رزومه</a>
                @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <a href="{{ route('users.export_admins_csv') }}" class="btn btn-success"><i
                                class="fa fa-file-excel-o"></i>خروجی اکسل از ادمین ها</a>
                @endif

                <br><br>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="20px">***</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>موبایل</th>
                            <th>ایمیل</th>
                            <th>تاریخ ثبت نام</th>
                            <th>آخرین ورود</th>
                            <th>دسترسی ها</th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr  @if(\HR\myFuncs::check_blacklist($user->profile->national_code)) style="color: red" title="black_list" @endif>
                                <td width="20px">

                                    @if(\HR\myFuncs::check_worker_state($user->profile->national_code )== 'فعال')
                                        <span title="همکار" style="color:red">G</span> &nbsp;
                                    @elseif(\HR\myFuncs::check_worker_state($user->profile->national_code )== 'غيرفعال')
                                        <span title="همکار سابق" style="color:#999"><strong>G</strong></span>
                                    @endif

                            {{--
                            @php
                            echo \HR\myFuncs::check_worker_state($user->profile->national_code);
                            @endphp
                            --}}
            </td>
            <td>
                @if(\HR\myFuncs::check_blacklist($user->profile->national_code))
                    <i style="color:red; cursor: pointer;" class="fa fa-warning"
                       title="black_list"></i>
                @endif


                {{$user->first_name}}
                {!! ($user->status==0?' <span style="color:red">(غیرفعال)</span>':'')!!}
            </td>
            <td @if(\HR\WorkerList::where('national_code', $user->profile->national_code)->first())onclick="alert('کارمند تعدیلی از {{\HR\WorkerList::where('national_code', $user->profile->national_code)->first()->company->name}}')"@endif>
                {{$user->last_name}}
                @if(\HR\WorkerList::where('national_code', $user->profile->national_code)->first())
                    <i style="color:darkgoldenrod;" class="fa fa-star"></i>
                @endif
            </td>
            <td id="mobile_td_{{$user->id}}">
                @if($user->is_mobile_verified==0)
                    <i class="fa fa-warning HR-font-color-red" title="تایید نشده"></i>&nbsp;
                @endif
                {{$user->mobile}}

                @if($user->is_mobile_verified==0)
                    <br>

                    @hasanyrole('برنامه نویس|سوپرادمین')
                    <a href="javascript:void(0)"
                       onclick="HR_HandlyConfirm('mobile', {{$user->id}},'{{route('users.confirm_mobile', $user->id)}}','{{$user->mobile}}');">
                        <button type="button" class="btn btn-outline btn-primary btn-xs">
                            تایید دستی
                        </button>
                    </a>
                    @endrole

                    {!! Form::open(['method' => 'POST', 'route' => ['resend.sms', $user->id] ]) !!}
                    {!! Form::button('ارسال مجدد کد', ['type'=>'submit','class' => 'btn btn-outline btn-warning btn-xs'
                    ,'style'=>'margin-top:5px;']) !!}
                    {!! Form::close() !!}
                @endif


            </td>
            <td id="email_td_{{$user->id}}">
                @if(!empty($user->email))
                    @if(!is_null($user->is_email_verified))
                        <i class="fa fa-warning HR-font-color-red" title="تایید نشده"></i>&nbsp;
                    @endif
                    {{$user->email}}
                    @if(!is_null($user->is_email_verified))
                        <a href="javascript:void(0)"
                           onclick="HR_HandlyConfirm('email',{{$user->id}},'{{route('users.confirm_email', $user->id)}}','{{$user->email}}');">
                            <button type="button" class="btn btn-outline btn-primary btn-xs">
                                تایید دستی
                            </button>
                        </a>

                    @endif
                @else
                    -
                @endif
            </td>
            <td class="ltr-input"><i class="fa fa-calendar-o"></i>
                {{JDate::createFromCarbon(Carbon::parse($user->created_at)->timezone('Asia/Tehran'))->format('Y/m/d')}}
            </td>
            <td class="ltr-input"><i class="fa fa-calendar-o"></i>
                {{JDate::createFromCarbon(Carbon::parse($user->last_login)->timezone('Asia/Tehran'))->format('Y/m/d')}}
            </td>
            <td class="ltr-input"><i
                        class="fa fa-key"></i>&nbsp;{{$user->roles()->pluck('name')->implode(', ')}}
            </td>
            <td style="white-space: nowrap;width:134px;">
                @if( /*auth()->user()->hasPermissionTo('کاربران-ویرایش-اطلاعات') ||*/ auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                    <a title="ویرایش اطلاعات کاربری" href="{{ route('users.edit', $user->id) }}"
                       class="btn btn-info btn-xs  btn-outline"
                       @if((($user->hasRole('برنامه نویس') || $user->hasRole('سوپرادمین')) && auth()->user()->id != $user->id && !auth()->user()->hasRole('برنامه نویس')))
                       disabled
                            @endif
                    ><i class="fa fa-edit"></i> ویرایش
                    </a>
                @endif

                @if(auth()->user()->hasPermissionTo('کاربران-ارسال-پیام') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <a target="_blank" title="ارسال پیام"
                       href="{{route('tickets.create',[$user->id])}}"
                       class="btn btn-xs btn-warning btn-outline"><i class="fa fa-envelope"></i>
                        ارسال پیام
                    </a>
                @endif

                @if(auth()->user()->hasPermissionTo('کاربران-مشاهده-رزومه') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس') && !is_null($user->resume))
                    <a target="_blank"
                       href="{{route('resumes.show',$user->resume->id)}}" title="مشاهده رزومه"
                       class="btn btn-primary btn-xs btn-outline "><i class="fa fa-eye"></i> رزومه
                    </a>
                @endif
                @if(
                 (auth()->user()->hasPermissionTo('کاربران-لاگین-بجای-کاربر')
                || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                && ((!$user->hasRole('برنامه نویس') && !$user->hasRole('سوپرادمین')) || auth()->user()->hasRole('برنامه نویس'))
                )
                    {!! Form::open(['method' => 'POST','style'=>'display:inline', 'route' => ['admin.login.as', $user->id]]) !!}
                    {!! Form::button('<i class="fa fa-sign-in"></i> login as', ['type'=>'submit','class' => 'btn btn-xs btn-outline btn-danger']) !!}
                    {!! Form::close() !!}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>


</table>
{!! $users->appends(\Illuminate\Support\Facades\Input::except('page'))->links() !!}
</div>
{{--@if(auth()->user()->hasPermissionTo('کاربران-افزودن-کاربر-جدید') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))--}}
                {{--<a href="{{ route('users.create') }}" users class="btn btn-info"><i class="fa fa-user-plus"></i>&nbsp;--}}
                {{--افزودن--}}
                {{--کاربر</a>--}}
                {{--@endif--}}
            </div>
        </div>
    </div>
@endsection

@section('scripts_footer')
    <!-- Mainly scripts -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/jquery-2.1.1.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/bootstrap.min.js') }}

    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/metisMenu/jquery.metisMenu.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/slimscroll/jquery.slimscroll.min.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/sweetalert/sweetalert.min.js') }}

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
    
        $(document).ready(function () {
            $(".chosen").chosen({rtl: true});

            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }
        });

        function HR_HandlyConfirm(_type, _id, _route, _content) {

            if (_type == "email") {
                swal({
                        title: "مطمئنید؟",
                        text: "تایید ایمیل به صورت دستی",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "بله تایید شود",
                        cancelButtonText: "خیر، منصرف شدم",
                        closeOnConfirm: false,
                        closeOnCancel: false,
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: "PUT",
                                url: _route,
                                data: '_token={{csrf_token()}}',
                                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                                complete: function (data) {
                                    swal("انجام شد", "ایمیل به صورت دستی تایید شد", "success");
                                    $('#email_td_' + _id).html(_content);
                                }
                            });
                        } else {
                            swal("منصرف شدم", "عملیات متوقف شد", "error");
                        }
                    });
            }
            if (_type == "mobile") {
                swal({
                        title: "مطمئنید؟",
                        text: "تایید موبایل به صورت دستی",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "بله تایید شود",
                        cancelButtonText: "خیر، منصرف شدم",
                        closeOnConfirm: false,
                        closeOnCancel: false,
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: "PUT",
                                url: _route,
                                data: '_token={{csrf_token()}}',
                                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                                complete: function (data) {
                                    swal("انجام شد", "موبایل به صورت دستی تایید شد", "success");
                                    $('#mobile_td_' + _id).html(_content);
                                }
                            });

                        } else {
                            swal("منصرف شدم", "عملیات متوقف شد", "error");
                        }
                    });
            }

        }


    </script>

@endsection
