@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Golrang Human Resource">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection
@section('custom_css')
    {{ Html::style('/site/'.config('app.site_theme').'/css/chosen.css') }}
    {{--@if($errors)
    {{dd($errors)}}
    @endif--}}
    {{ Html::style('/site/'.config('app.site_theme').'/css/dmuploader.css') }}

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        .chosen-container {
            width: 100% !important;
        }

        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;
        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }

        .avatar-upload .avatar-edit input {
            display: none;
        }

        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-upload .avatar-edit input + label:after {
            content: "\f040";
            font-family: 'FontAwesome';
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }

        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .birth-day-box .chosen-container-single .chosen-single,
        .marriage-date-box .chosen-container-single .chosen-single {
            border: 0;
            margin-top: -7px;
            background-color: transparent;
        }

    </style>

@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: پروفایل
@endsection

@section('content')

    @include('site.pages.user.side_bar')


    <div class="container mt-5">
        <img title="راهنما" src="/site/default/Template_2019/img/Group 146.svg"
             onclick="introJs().setOptions({'nextLabel': 'بعد','prevLabel': 'قبل','skipLabel': 'خروج','doneLabel': 'اتمام'}).start();">
        {{ Form::open(array('method'=>'PUT','route' => 'site.user.profile.put','files'=>true,'onsubmit'=>'return form_check()')) }}
    </div>


    <div id="scroll-resume" data-position="top" data-scrollTo="tooltip" data-step="1"
         data-intro="ابتدا اطلاعات پروفایل خود را تکمیل کنید.">
        @if (count($errors) > 0)
            <div class="bg-error" style="text-align: right">
                <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                @foreach ($errors->all() as $error)
                    <p style="direction: rtl">{{ $error }}</p>
                @endforeach
            </div>
        @endif
        @if(Session::has('flash_message'))
            <div class="bg-success" style="text-align: right">
                <a href="" class="close-success"><i class="fa fa-remove"></i></a>
                <p style="direction: rtl">{!! session('flash_message') !!}</p>
            </div>
        @endif
        {{ Form::open(array('id'=>'profile-form', 'method'=>'PUT','route' => 'site.user.profile.put','files'=>true,'onsubmit'=>'return form_check()')) }}

        <div class="container">
            <div class="upload-img text-center">
                <div id="drag-and-drop-zone_profile" class="uploader0 ">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type="file" name="profile" multiple="multiple" title="Click to add Files"
                                   id="imageUpload" accept=".png, .jpg, .jpeg">
                            <label for="imageUpload"><img src="/site/default/Template_2019/img/Group 167.svg"/></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image:url('{{Auth::user()->avatar}}')">
                            </div>
                            <div class="font-13 text-center mt-3"><a href="#"
                                                                     class="profile-picture-remove text-danger"><span>حذف عکس</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="font-13 font-weight-bold text-center mt-1">عکس خود را بارگذاری یا ویرایش کنید</div>
                    <div class="font-13 font-weight-light text-center mt-3"><img class="ml-2"
                                                                                 src="/site/default/Template_2019/img/exclamation-mark.svg"/><span>ابعاد عکس حداکثر ۶۴۰ در ۶۴۰ پیکسل باشد. حجم بالاتر از 1 مگابایت نباشد</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container people-forms moshkasatfard">
            <div class="row">
                <fieldset class="red-fieldset mt-7">
                    <div class="float-left font-13 red-fieldset-left dir-ltr"><img class="mr-2"
                                                                                   src="/site/default/Template_2019/img/exclamation-mark.svg"/><span>پر کردن آیتم های</span><img
                                class="m-2"
                                src="/site/default/Template_2019/img/Group 166.svg"/><span> اجباری است</span></div>
                    <legend>اطلاعات فردی</legend>
                </fieldset>
                <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <input data-validation="required" type="text" name="first_name" id="first_name"
                               value="{{!is_null(old('first_name'))?old('first_name'):Auth::user()->first_name}}"
                               class="first_name form-control people-forms-fields"  oninput="$('#first_name-help').text('')"/>
                        <label>نام</label>
                        <span id="first_name-help" class="help-block"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <input data-validation="required" type="text" name="last_name" id="last_name"
                               value="{{!is_null(old('last_name'))?old('last_name'):Auth::user()->last_name}}"
                               class="last_name form-control people-forms-fields" oninput="$('#last_name-help').text('')"/>
                        <label>نام خانوادگی</label>
                        <span id="last_name-help" class="help-block"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <input data-validation="required number length" data-validation-length="10" type="text"
                               name="national_id" id="national_id"
                               value="@if($profile!=null){{$profile->national_code}}@else{{old('national_id')}}@endif"
                               class="national_id form-control people-forms-fields" id="national_id" oninput="$('#codemelli-help').text('')"/>
                        <label>کد ملی</label>
                        <span id="codemelli-help" class="help-block"></span>

                    </div>
                </div>
               
                
                  <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <input data-validation="required" type="text" name="english_first_name" id="english_first_name"
                               value="{{!is_null(old('english_first_name'))?old('english_first_name'):Auth::user()->english_first_name}}"
                               class="first_name form-control people-forms-fields"  oninput="$('#english_first_name-help').text('')"/>
                        <label> نام انگلیسی</label>
                        <span id="english_first_name-help" class="help-block"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <input data-validation="required" type="text" name="english_last_name" id="english_last_name"
                               value="{{!is_null(old('english_last_name'))?old('english_last_name'):Auth::user()->english_last_name}}"
                               class="last_name form-control people-forms-fields" oninput="$('#english_last_name-help').text('')"/>
                        <label> نام خانوادگی انگلیسی</label>
                        <span id="english_last_name-help" class="help-block"></span>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <select data-validation="required" name="gender" id="gender" data-placeholder="یک گزینه انتخاب کنید"
                                class="jensiat-select form-control people-forms-fields po-input-select ">
                            <option></option>
                            @foreach($genders as $key=>$gender)
                            <option value={{$key}} {{(isset($profile) && $profile->gender==$key?' selected ':'')}}>{{$gender['name']}}
                                </option>
                            @endforeach

                          <!-- @if(is_null(old('gender')))
                                <option value="1" {{(isset($profile) && $profile->gender=="1"?' selected ':'')}}>مرد
                                </option>
                                <option value="2" {{(isset($profile) && $profile->gender=="2"?' selected ':'')}}>زن
                                </option>
                            @else
                                <option value="1" {{(old('gender')=="1"?' selected ':'')}}>مرد</option>
                                <option value="2" {{(old('gender')=="2"?' selected ':'')}}>زن</option>
                            @endif-->
                        </select>
                        <label>جنسیت</label>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="people-forms-fields-group birth-day-box">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <div class="radio-Input">
                            <div class="row">
                                <div class="col-4 col-md-4 pl-0 ">تاریخ تولد</div>
                                <div class="col-2 col-md-2 pr-0 pl-0">
                                    <select name="born_day" id="born_day" class="form-control chosen-day"
                                            onchange="$('#born_day-help').text('')">
                                        <option value=""></option>
                                        @foreach(range(1,31) as $item)
                                            <option @if($item==intval(substr($profile->born_date,8,2))) selected
                                                    @elseif(!is_null(old('born_day')) && old('born_day')==$item) selected
                                                    @endif
                                                    value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <span id="born_day-help" class="help-block"></span>
                                </div>
                                <div class="col-3 col-md-3 pr-0 pl-0">
                                    <select name="born_month" id="born_month" class="form-control chosen-month"
                                            onchange="$('#born_month-help').text('')">
                                        <option value=""></option>
                                        @foreach(config('app.persian_months') as $key=>$item)
                                            <option @if($key==intval(substr($profile->born_date,5,2))) selected
                                                    @elseif(!is_null(old('born_month')) && old('born_month')==$key) selected
                                                    @endif
                                                    value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <span id="born_month-help" class="help-block"></span>
                                </div>
                                <div class="col-3 col-md-3 pr-0 pl-0">
                                    <select name="born_year" id="born_year" class="form-control chosen-year"
                                            onchange="$('#born_year-help').text('')">
                                        <option value=""></option>
                                        @for($i = $current_year; $i > $current_year - 70; $i--)
                                            <option @if($i==intval(substr($profile->born_date,0,4))) selected
                                                    @elseif(!is_null(old('born_month')) && old('born_month')==$i) selected
                                                    @endif
                                                    value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                    <span id="born_year-help" class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <div class="radio-Input">
                            <div class="row">
                                <div class="col-4 col-md-4 pl-0 ">وضعیت تأهل</div>
                                {{--@if(is_null(old('marriage_status')))
                                    <div class="col-4 col-md-3">
                                        <span>مجرد</span>
                                        <input id="toggle-1" type="radio" data-validation="required"
                                               name="marriage_status" id="marriage_status" checked="checked" value="1"
                                               {{(isset($profile) && $profile->marriage_status=="1"?' checked ':'')}}/>
                                        <label for="toggle-1"></label>
                                        <span id="marriage_status-help" class="help-block"></span>
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <span>متاهل</span>
                                        <input id="toggle-2" type="radio" data-validation="required"
                                               name="marriage_status" id="marriage_status" checked="checked" value="2"
                                               {{(isset($profile) && $profile->marriage_status=="2"?' checked ':'')}}/>
                                        <label for="toggle-2"></label>
                                    </div>
                                @else
                                    <div class="col-4 col-md-3">
                                        <span>مجرد</span>
                                        <input id="toggle-1" type="radio" data-validation="required"
                                               name="marriage_status" id="marriage_status" checked="checked" value="1"
                                               {{(old('marriage_status')=="1"?' selected ':'')}}/>
                                        <label for="toggle-1"></label>
                                        <span id="marriage_status-help" class="help-block"></span>
                                    </div>
                                    <div class="col-4 col-md-3">
                                        <span>متاهل</span>
                                        <input id="toggle-2" type="radio" data-validation="required"
                                               name="marriage_status" id="marriage_status" checked="checked" value="2"
                                               {{(old('marriage_status')=="2"?' selected ':'')}}/>
                                        <label for="toggle-2"></label>
                                    </div>
                                @endif--}}
                                <div class="col-4 col-md-3">
                                    <span>مجرد</span>
                                    <input id="toggle-1" type="radio" data-validation="required"
                                           name="marriage_status" id="marriage_status" value="1"
                                            {{(isset($profile) && $profile->marital_status != "2"?' checked ':'')}}/>
                                    <label for="toggle-1"></label>
                                    <span id="marriage_status-help" class="help-block"></span>
                                </div>
                                <div class="col-4 col-md-3">
                                    <span>متاهل</span>
                                    <input id="toggle-2" type="radio" data-validation="required"
                                           name="marriage_status" id="marriage_status" value="2"
                                            {{(isset($profile) && $profile->marital_status == "2" ?' checked ':'')}}/>
                                    <label for="toggle-2"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--<div class="col-md-4" {{(isset($profile) && $profile->marital_status != "2"?' style=display:none ':'')}}>
                    <div class="people-forms-fields-group marriage-date-box">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <div class="radio-Input">
                            <div class="row">
                                <div class="col-4 col-md-4 pl-0 ">تاریخ ازدواج</div>
                                <div class="col-2 col-md-2 pr-0 pl-0">
                                    <select name="marriage_day" id="marriage_day" class="form-control chosen-day"
                                            onchange="$('#marriage-day-help').text('')">
                                        <option value=""></option>
                                        @foreach(range(1,31) as $item)
                                            <option @if($item==intval(substr($profile->marriage_date,8,2))) selected
                                                    @elseif(!is_null(old('marriage_day')) && old('marriage_day')==$item) selected
                                                    @endif
                                                    value="{{$item}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <span id="marriage_day-help" class="help-block"></span>
                                </div>
                                <div class="col-3 col-md-3 pr-0 pl-0">
                                    <select name="marriage_month" id="marriage_month" class="form-control chosen-month"
                                            onchange="$('#marriage_month-help').text('')">
                                        <option value=""></option>
                                        @foreach(config('app.persian_months') as $key=>$item)
                                            <option @if($key==intval(substr($profile->marriage_date,5,2))) selected
                                                    @elseif(!is_null(old('marriage_month')) && old('marriage_month')==$key) selected
                                                    @endif
                                                    value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                    <span id="marriage_month-help" class="help-block"></span>
                                </div>
                                <div class="col-3 col-md-3 pr-0 pl-0">
                                    <select name="marriage_year" id="marriage_year" class="form-control chosen-year"
                                            onchange="$('#marriage_year-help').text('')">
                                        <option value=""></option>
                                        @for($i = $current_year; $i > $current_year - 70; $i--)
                                            <option @if($i==intval(substr($profile->marriage_date,0,4))) selected
                                                    @elseif(!is_null(old('marriage_month')) && old('marriage_month')==$i) selected
                                                    @endif
                                                    value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                    <span id="marriage_year-help" class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--}}
                
                
<!--                         <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div id="drag-and-drop-zone" class="clearfix uploader">
                            <div class="clearfix browser">
                                <label id="delete_file">
                                    <span><i class="fa fa-times" style="vertical-align: middle;"></i></span>
                                </label>
                                @if(Storage::disk('resume')->exists('cv/'.\HR\myFuncs::spilit_string(Auth::user()->id).'/resume.pdf'))
                                    <a id="cv_link" href="{{route('cv.show',Auth::user()->id)}}" target="_blank"><span
                                                id="cv_label">مشاهده فایل آپلود شده</span></a>
                                @else
                                    <div onclick="$('#cv').click()"
                                         style="color: #000;float: right;padding: 8px 10px;font-size: 14px;"
                                         id="cv_label">رزومه خود را آپلود کنید.
                                    </div>
                                @endif
                                <label>
                                    <span><i class="fa fa-cloud-upload"></i></span>
                                    <input type="file" accept="application/pdf" id="cv" name="cv"
                                           onchange=" document.getElementById('cv_label').innerHTML = this.value;"
                                           title="کلیک کنید و فایل مورد نظر را انتخاب کنید">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
-->

                

                <div class="col-md-4 nezamvazife" {!! (isset($profile) && $profile->gender=="2"?' style="display:none" ':' style="display:block" ') !!}>
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <select data-validation="" name="military_status" data-placeholder="یک گزینه انتخاب کنید"
                                class="vaziatnezamvazife-select form-control people-forms-fields po-input-select"
                                id="vaziatnezamvazife-select">
                            <option value=""></option>
                            @if(is_null(old('military_status')))
                                @foreach($khedmat as $kh)
                                    <option value="{{$kh->site_id}}" {{(isset($profile) && $profile->military_status==$kh->site_id?' selected ':'')}}>
                                        {{$kh->Name}}
                                    </option>
                                @endforeach
                                {{--
                                    <option value="1" {{(isset($profile) && $profile->military_status=="1"?' selected ':'')}}>
                                        پایان خدمت
                                    </option>
                                    <option value="2" {{(isset($profile) && $profile->military_status=="2"?' selected ':'')}}>
                                        معافیت
                                    </option>
                                    <option value="3" {{(isset($profile) && $profile->military_status=="3"?' selected ':'')}}>
                                        خرید خدمت
                                    </option>
                                    <option value="4" {{(isset($profile) && $profile->military_status=="4"?' selected ':'')}}>
                                        مشمول
                                    </option>
                                --}}
                            @else
                                @foreach($khedmat as $kh)
                                    <option value="{{$kh->site_id}}" {{(isset($profile) && $profile->military_status==$kh->site_id?' selected ':'')}}>
                                        {{$kh->Name}}
                                    </option>
                                @endforeach
                                {{--
                                <option value="1" {{(old('military_status')=="1"?' selected ':'')}}>
                                    پایان خدمت
                                </option>
                                <option value="2" {{(old('military_status')=="2"?' selected ':'')}}>
                                    معافیت
                                </option>
                                <option value="3" {{(old('military_status')=="3"?' selected ':'')}}>
                                    خرید خدمت
                                </option>
                                <option value="4" {{(old('military_status')=="4"?' selected ':'')}}>
                                    مشمول
                                </option>
                                --}}
                            @endif
                        </select>
                        <label>وضعیت نظام وظیفه</label>
                        <span id="military_status-help" class="help-block"></span>
                    </div>
                </div>

                <div class="nezamvazifetarikhpayan col-12" {!! (isset($profile) && $profile->military_status=="1"?' style="display:block" ':' style="display:none" ') !!}>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="people-forms-fields-group" id="military_month_div">
                                <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/>
                                </div>
                                <select name="military_month" id="military_month"
                                        class="form-control chosen-month"
                                        onchange="$('#military_month-help').text('')">
                                    <option value=""></option>
                                    @foreach(config('app.persian_months') as $key=>$item)
                                        <option @if($key==intval(substr($profile->military_end_date,5,2))) selected
                                                @elseif(!is_null(old('military_month')) && old('military_month')==$key) selected
                                                @endif
                                                value="{{$key}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                <label class="chosen-drop-label">ماه اتمام</label>
                                <span id="military_month-help" class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="people-forms-fields-group" id="military_month_div">
                                <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/>
                                </div>
                                <select name="military_year" id="military_year"
                                        class="form-control chosen-year"
                                        onchange="$('#military_year-help').text('')">
                                    <option value=""></option>
                                    @for($i = $current_year; $i > $current_year - 70; $i--)
                                        <option @if($i==intval(substr($profile->military_end_date,0,4))) selected
                                                @elseif(!is_null(old('military_year')) && old('military_year')==$i) selected
                                                @endif
                                                value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                <label class="chosen-drop-label">سال اتمام</label>
                                <span id="military_year-help" class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 nezamvazifemoafiat" {!! (isset($profile) && $profile->military_status=="2" && $profile->gender=="1" ?' style="display:block" ':' style="display:none" ') !!}>
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <select data-validation="" name="military_free"
                                data-placeholder="یک گزینه انتخاب کنید"
                                class="dalilmoafiat-select form-control has-value people-forms-fields po-input-select"
                                id="dalilmoafiat-select">
                            <option value="">یک گزینه را انتخاب کنید</option>

                            @if(is_null(old('military_free')))
                                @foreach($khedmat_moaf as $kh_moaf)
                                    <option value="{{$kh_moaf->id}}" {{(isset($profile) && $profile->reason_exemption==$kh_moaf->id?' selected ':'')}}>
                                        {{$kh_moaf->Name}}
                                    </option>
                                @endforeach
                                {{--
                                    <option value="1" {{(isset($profile) && $profile->reason_exemption=="1"?' selected ':'')}}>
                                        تحصیلی
                                    </option>
                                    <option value="2" {{(isset($profile) && $profile->reason_exemption=="2"?' selected ':'')}}>
                                        کفالت
                                    </option>
                                    <option value="3" {{(isset($profile) && $profile->reason_exemption=="3"?' selected ':'')}}>
                                        پزشکی
                                    </option>
                                    <option value="4" {{(isset($profile) && $profile->reason_exemption=="4"?' selected ':'')}}>
                                        موارد خاص
                                    </option>
                                --}}
                            @else
                                @foreach($khedmat_moaf as $kh_moaf)
                                    <option value="{{$kh_moaf->site_id}}" {{(isset($profile) && $profile->military_free==$kh_moaf->site_id?' selected ':'')}}>
                                        {{$kh_moaf->Name}}
                                    </option>
                                @endforeach
                                {{--
                                    <option value="1" {{(old('military_free')=="1"?' selected ':'')}}>
                                        تحصیلی
                                    </option>
                                    <option value="2" {{(old('military_free')=="2"?' selected ':'')}}>
                                        کفالت
                                    </option>
                                    <option value="3" {{(old('military_free')=="3"?' selected ':'')}}>
                                        پزشکی
                                    </option>
                                    <option value="4" {{(old('military_free')=="4"?' selected ':'')}}>
                                        موارد خاص
                                    </option>
                                --}}
                            @endif
                        </select>
                        <label>دلیل معافیت</label>
                        <span id="military_free-help" class="help-block"></span>
                    </div>
                </div>

                <div class="col-md-4 nezamvazifemashmool " {!! (isset($profile) && $profile->military_status=="4"?' style="display:block" ':' style="display:none" ') !!}>
                    <div class="people-forms-fields-group" id="military_month_div">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <select data-validation="" name="nezamvazifemashmool_select"
                                data-placeholder="یک گزینه انتخاب کنید" class="dalilmoafiat-select form-control"
                                id="nezamvazifemashmool_select">
                            <option @php if ($profile->khedmat_mashmool == "در حال خدمت _ سایر") echo ' SELECTED '; @endphp  value="در حال خدمت _ سایر">
                                در حال خدمت _ سایر
                            </option>
                            <option @php if ($profile->khedmat_mashmool == "معاف موقت تحصیلی") echo ' SELECTED '; @endphp value="معاف موقت تحصیلی">
                                معاف موقت تحصیلی
                            </option>
                            <option @php if ($profile->khedmat_mashmool == "در حال خدمت _ طرح نخبگان") echo ' SELECTED '; @endphp value="در حال خدمت _ طرح نخبگان">
                                در حال خدمت _ طرح نخبگان
                            </option>
                        </select>
                        <label>نوع معافیت</label>
                        <span id="nezamvazifemashmool_select-help" class="help-block"></span>
                    </div>
                </div>


                <fieldset class="red-fieldset mt-7">
                    <legend>اطلاعات سکونت</legend>
                </fieldset>
                <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <select class="form-control people-forms-fields" data-validation="required" name="pc" id="pc"
                                data-placeholder="یک گزینه انتخاب کنید"
                                class="form-control chosen ostan-select">
                            <option value="">یک گزینه را انتخاب کنید</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}"
                                        @if( isset($profile) && $profile->city->id==$city->id) selected
                                        @elseif(!is_null(old('pc')) && old('pc') == $city->id) selected @endif
                                >
                                    {{$city->name}}
                                </option>
                            @endforeach
                        </select>
                        <label>استان - شهر </label>
                        <span id="pc-help" class="help-block"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <input type="text"
                               value="@if($profile!=null){{$profile->neighborhood}}@else{{old('address_area')}}@endif"
                               name="address_area" id="address_area" maxlength="20" class="addressmahale form-control people-forms-fields"
                               oninput="$('#address_area-help').text('')">
                        <label>محله</label>
                        <span id="address_area-help" class="help-block"></span>
                    </div>
                </div>
                <fieldset class="red-fieldset mt-7">
                    <legend>اطلاعات تماس</legend>
                </fieldset>
                <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <input type="tel" name="mobile" id="mobile" value="{{ Auth::user()->mobile }}" disabled
                               class="addresstelhamrah form-control ltr-input people-forms-fields" oninput="$('#mobile-help').text('')">
                        <label>تلفن همراه</label>
                        <span id="mobile-help" class="help-block"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row phone-Input">
                        <div class="people-forms-fields-group col-8 col-md-8 pl-0">
                            <input class=" form-control people-forms-fields"
                                   value="@if($profile!=null){{substr($profile->home_phone,3)}}@else{{substr(old('home_phone'),3)}}@endif"
                                   name="home_phone[ext]" id="home_phone_ext" type="tel" maxlength="8"
                                   oninvalid="$('#mobile_help').html('لطفا تلفن منزل را وارد کنید');"
                                   onkeyup="$('#mobile_help').html('')"/>
                            <label>تلفن</label>
                            <span id="home_phone_ext-help" class="help-block"></span>
                        </div>
                        <div class="people-forms-fields-group col-4 col-md-4 pr-1">
                            <input class=" form-control people-forms-fields"
                                   value="@if($profile!=null){{substr($profile->home_phone,0,3)}}@else{{substr(old('home_phone'),0,3)}}@endif"
                                   name="home_phone[code]" id="home_phone_code" type="tel" maxlength="3"
                                   oninvalid="$('#mobile_help').html('لطفا کد شهر را وارد کنید');"
                                   onkeyup="$('#mobile_help').html('')"/>
                                   <label>کد شهر</label>
                        </div>
                        <span id="home_phone_code-help" class="help-block"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="fields-required"></div>
                    <div class="people-forms-fields-group">
                        <input type="email" name="email" id="email"
                               value="{{!is_null(old('email'))?old('email'):Auth::user()->email}}"
                               class="addressemail form-control people-forms-fields"  oninput="$('#email-help').text('')">
                        <label>ایمیل</label>
                        <span id="email-help" class="help-block"></span>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <div class="people-forms-fields-group">
                        @if(!is_null(Auth::user()->is_email_verified) && Auth::user()->profile)
                            <a target="_blank" href="{{route('user.email.verification')}}" class=" font-13 text-dark">در
                                صورتی که هنوز ایمیل خود را فعال نکیده اید کلیک کنید</a>
                        @endif
                    </div>
                    <div class="people-forms-fields-group">
                        <input id="newsletter" @if($profile && $profile->is_newsletter_member()) checked
                               @elseif(old('newsletter')) checked @endif type="checkbox" data-validation=""
                               name="newsletter" value="1">
                        <label for="newsletter" class="font-13 text-dark">آیا در خبرنامه عضو شده اید؟</label>
                    </div>
                </div>


                <fieldset class="mt-5 w-100">
                    <legend class="text-left">
                        <input type="submit" class="save send-btn-green" title="ذخیره و ادامه"
                               value="ذخیره و ادامه">
                    </legend>
                </fieldset>
                {{Form::close()}}

            </div>
        </div>
        {{Form::close()}}
    </div>
@endsection

@section('script')
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/inputmask.binding.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/jquery.inputmask.bundle.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/phone.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/phone-uk.js') }}

    {{ Html::script('/site/'.config('app.site_theme').'/js/dmuploader.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/chosen.jquery.js') }}

    <script>
        if ($(window).width() < 992) {
            $(document).ready(function () {
                // Handler for .ready() called.
                $('html, body').animate({
                    scrollTop: $('#scroll-resume').offset().top - 20
                }, 'slow');

            });
        }

        $(document).ready(function () {
            @if($first_time)
            introJs().setOptions({
                'nextLabel': 'بعد',
                'prevLabel': 'قبل',
                'skipLabel': 'خروج',
                'doneLabel': 'اتمام'
            }).start();
            @endif

            ajax_select_city();
        });

        $(".close-error").click(function () {
            $(".bg-error").hide();
            return false;
        });
        $(".close-success").click(function () {
            $(".bg-success").hide();
            return false;
        });

        /*$(document).find('input:radio[name="marriage_status"]').on('change', function() {
                if ($(this).filter(':checked').val() == '1') {
                    $(document).find('.marriage-date-box').parent().hide();

                } else {
                    $(document).find('.marriage-date-box').parent().show();
                }
        });
*/


        // hide and show nezamvazife
        $('.moshkasatfard').on('change', function () {
            if ($('.jensiat-select').val() == '1') {
                $('.nezamvazife').show();
                $('#vaziatnezamvazife-select').attr('data-validation', 'required');
                $('#vaziatnezamvazife-select').attr('required', 'required');
                $('.nezamvazife').change();

            } else if ($('.jensiat-select').val() != '1') {
                $('.nezamvazife').hide();
                $('#vaziatnezamvazife-select').attr('data-validation', '');
                $('#vaziatnezamvazife-select').removeAttr('required');
                $('.nezamvazifetarikhpayan').hide();
                $('#military_month').attr('data-validation', '');
                $('#military_month').removeAttr('required');
                $('#military_year').attr('data-validation', '');
                $('#military_year').removeAttr('required');
                $('.nezamvazifemashmool').hide();
                $('#nezamvazifemashmool_select').attr('data-validation', '');
                $('#nezamvazifemashmool_select').removeAttr('required');
                $('.nezamvazifemoafiat').hide();
                $('#dalilmoafiat-select').attr('data-validation', '');
                $('#dalilmoafiat-select').removeAttr('required');
            }
        });


        // hide and show payan khedmat
        $('.nezamvazife').on('change', function () {
            $('.nezamvazifetarikhpayan').hide();
            $('#military_month').attr('data-validation', '');
            $('#military_month').removeAttr('required');
            $('#military_year').attr('data-validation', '');
            $('#military_year').removeAttr('required');
            $('.nezamvazifemashmool').hide();
            $('#nezamvazifemashmool_select').attr('data-validation', '');
            $('#nezamvazifemashmool_select').removeAttr('required');
            $('.nezamvazifemoafiat').hide();
            $('#dalilmoafiat-select').attr('data-validation', '');
            $('#dalilmoafiat-select').removeAttr('required');

            if ($('.vaziatnezamvazife-select').val() == '1') {

                $('.nezamvazifetarikhpayan').show();
                $('#military_month').attr('data-validation', 'required');
                $('#military_month').attr('required', 'required');
                $('#military_year').attr('data-validation', 'required');
                $('#military_year').attr('required', 'required');
            } else if ($('.vaziatnezamvazife-select').val() == '4') {
                $('.nezamvazifemashmool').show();
                $('#nezamvazifemashmool_select').attr('data-validation', 'required');
                $('#nezamvazifemashmool_select').attr('required', 'required');
            } else if ($('.vaziatnezamvazife-select').val() == '2') {
                $('.nezamvazifemoafiat').show();
                $('#dalilmoafiat-select').attr('data-validation', 'required');
                $('#dalilmoafiat-select').attr('required', 'required');
            } else if ($('.vaziatnezamvazife-select').val() == '3') {
                $('.nezamvazifetarikhpayan').show();
                $('#military_month').attr('data-validation', 'required');
                $('#military_month').attr('required', 'required');
                $('#military_year').attr('data-validation', 'required');
                $('#military_year').attr('required', 'required');
            }
        });


        /////////////// add family row

        $(".add-row-family").click(function () {
            var addfamilyrow = '<tr><td><button type="button" class="remove-row" title="Remove row">X</button></td><td><input type="text" name="namenamefam" class="namenamefam form-control"></td><td><div class="col-xs-12 no-padd no-padd-xs"><select data-placeholder="یک گزینه انتخاب کنید"  class="nesbat-select form-control" > <option value="">یک گزینه را انتخاب کنید</option><option value="pedar">پدر</option><option value="madar">مادر</option><option value="khahar">خواهر</option><option value="barader">برادر</option><option value="hamsar">همسر</option><option value="farzand">فرزند</option></select><i class="fa fa-chevron-down tb-icon"></i></div><td><input type="text" name="shogl" class="shogl form-control"> <input type="checkbox" name="shogl" class="adameshtghal"> عدم اشتغال </td><td><input type="text" name="sazmansenf" class="sazmansenf form-control"></td></tr>';
            $("table.family-table tbody").append(addfamilyrow);
        });
        /////////////// remove rows

        $(document).on('click', 'button.remove-row', function () {
            $(this).closest('tr').remove();
            return false;
        });

        /////////////// gheyr fal kardan input

        $(document).on('click', 'input.adameshtghal', function () {
            if ($(this).prop("checked") == true) {
                $(this).closest('td').find("input.shogl").prop('disabled', true);

            } else if ($(this).prop("checked") == false) {
                $(this).closest('td').find("input.shogl").prop('disabled', false);
            }
        });




        // Upload Plugin
       /* $('#delete_file').on('click', function () {
            $('#cv').val('');
            $('#cv_label').html('رزومه خود را آپلود کنید.');
            $('#cv_link').removeAttr('href').attr('onclick', "$('#cv').click()");
        });*/

        $('.profile-picture-remove').on('click', function () {
            $.ajax({
                type: "POST",
                url: '{{route('remover')}}',
                dataType: 'json',
                data: '_token={{csrf_token()}}&name=avatar',
                success: function (data) {
                    $('#imagePreview').css('background-image', 'url("' + data.file + '")');
                }
            });
        });


        $('#drag-and-drop-zone_profile').dmUploader({
            url: '{{route('uploader')}}',
            dataType: 'json',
            allowedTypes: 'image/*',
            extraData: {
                _token: '{{ csrf_token() }}',
                name: 'avatar'
            },
            onUploadSuccess: function (id, data) {
                $('#profile_preview').attr('src', data.file);
                $('#imagePreview').css('background-image', 'url("' + data.file + '")');
            }
        });
        $('#drag-and-drop-zone_cover').dmUploader({
            url: '{{route('uploader')}}',
            dataType: 'json',
            allowedTypes: 'image/*',
            extraData: {
                _token: '{{ csrf_token() }}',
                name: 'cover'
            },
            onUploadSuccess: function (id, data) {
                $('#cover_preview').attr('src', data.file);
            }
        });

        function ajax_select_city() {
            var city_id ={{(isset($profile->city->id)?$profile->city->id:0)}};
            var p = $('#provinces option:selected').val();
            $.ajax({
                type: "GET",
                url: '{{route('jobs.get.cities')}}',
                data: '_token={{csrf_token()}}&province=' + p,
                success: function (data) {
                    var select = $('#city');
                    select.find('option').remove();
                    data = $.parseJSON(data);
                    $.each(data, function (i, item) {
                        if (city_id == item.id) {
                            select.append('<option value="' + item.id + '" selected>' + item.name + '</option>');
                        } else {
                            select.append('<option value="' + item.id + '">' + item.name + '</option>');
                        }

                    });
                }
            });
        }


        function SA_DateDiff(from_date, to_date) {
            /*
            var currentTime = new Date();
            var month = currentTime.getMonth() + 1;
            var day = currentTime.getDate();
            var year = currentTime.getFullYear();
            var today=(year + "/" + month + "/" + day);
            */

            d1 = new Date(from_date);
            d2 = new Date(to_date);

            df = d2 - d1;
            dfDay = Math.round(df / 24 / 60 / 60 / 1000);
            return dfDay;

        }

/*        function checkCodeMeli(input) {
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
        }*/

        $('.chosen').chosen();
        $('.chosen-day').chosen({
            placeholder_text_single: 'روز'
        });
        $('.chosen-month').chosen({
            placeholder_text_single: 'ماه'
        });
        $('.chosen-year').chosen({
            placeholder_text_single: 'سال'
        });

        function form_check() {
            validity = true;
            var codemelli = $('#national_id').val();
            //alert(checkCodeMeli(codemelli));
            if (!checkCodeMeli(codemelli)) {
                //alert('کدملی وارد شده واقعی نیست');
                $('#codemelli-help').html('کدملی وارد شده صحیح نیست.');
                validity = false;
            } else {
                $('#codemelli_error').html('');
            }
            var vaziatnezamvazife_select = $('#vaziatnezamvazife-select option:selected').val();
            //vaziattahol-select
            var vaziattahol_select = $('#vaziattahol-select option:selected').val();

            if ($('#first_name').val() === '') {
                $('#first_name-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#last_name').val() === '') {
                $('#last_name-help').text('فیلد اجباری');
                validity = false;
            }
            
             if ($('#english_first_name').val() === '') {
                $('#english_first_name-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#english_last_name').val() === '') {
                $('#english_last_name-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#national_id').val() === '') {
                $('#national_id-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#gender').val() === '') {
                $('#gender-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#born_day').val() === '') {
                $('#born_day-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#born_month').val() === '') {
                $('#born_month-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#born_year').val() === '') {
                $('#born_year-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#military_status').val() === '4' & $('#vaziatnezamvazife-select').val() === '') {
                $('#vaziatnezamvazife-select-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#gender').val() === '1' &  $('#military_status').val() === '') {
                $('#military_status-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#pc').val() === '') {
                $('#pc-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#address_area').val() === '') {
                $('#address_area-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#mobile').val() === '') {
                $('#mobile-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#home_phone_ext').val() === '') {
                $('#home_phone_ext-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#home_phone_code').val() === '') {
                $('#home_phone_code-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#marriage_status').val() === '') {
                $('#marriage_status-help').text('فیلد اجباری');
                validity = false;
            }

            if (validity == false){
                return false;
            }


        }


        $('#testquidance').on('click', function () {
            console.log('1111111111111');
            introJs().setOptions({
                'nextLabel': 'بعد',
                'prevLabel': 'قبل',
                'skipLabel': 'خروج',
                'doneLabel': 'اتمام'
            }).start()
            introJs().onchange(function (targetElement) {
                console.log("new step");
            });
            setInterval(function () {
                // console.log('next');
                // introJs().start().nextStep();
            }, 3000);

            // console.log('2222');
            // introJs().goToStep(3).start();
        });


    </script>
@endsection