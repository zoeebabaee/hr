@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Golrang Human Resource">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('custom_css')

    {{ Html::style('/site/'.config('app.site_theme').'/css/dmuploader.css') }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/chosen.css') }}

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        .blur {
            filter: blur(3px);
            cursor: not-allowed;
        }

        td, th {
            border: 1px solid #dddddd !important;
            text-align: center !important;
            padding: 8px !important;
        }
        .span-style{
            color:#a49d8d;
            font-size:11px !important;
        }
    </style>

@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: تحصیلات
@endsection

@section('content')

    @include('site.pages.user.side_bar')

    {{ Form::open(array('method'=>'PUT','route' => 'user.resume.2.store','files' => true, 'id' => 'eduform')) }}

    <div class="container" id="scroll-resume">
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

        @include('site.modules.resumeCompleteLine')

        <fieldset class="red-fieldset mt-7">
            <div class="float-left font-13 red-fieldset-left dir-ltr  edu-fieldset"><img class="mr-2"
                                                                                         src="/site/default/Template_2019/img/exclamation-mark.svg"/><span>پر کردن آیتم های</span><img
                        class="m-2" src="/site/default/Template_2019/img/Group 166.svg"/><span> اجباری است</span>
            </div>
            <legend>لطفا همه سوابق تحصیلی خود را به ترتیب از آخرین مقطع وارد فرمایید.</legend>
        </fieldset>

        <div class="row mt-2">
            <div class="col-12 people-forms-fields-group">
                 <p>
                     در  صورت عدم مشاهده نام رشته، گرایش یا دانشگاه در لیست انتخابی
                        <a data-toggle="modal" data-target="#basicSupportModal" id="open_modal" href="" data-tickettype="defect_information_box">اینجا</a>
                         کلیک نمایید.
                    </p>
                
                <span class="mr-2 font-14 span-style">جهت حضور در مصاحبه منابع انسانی، تکمیل اطلاعات تحصیلی از مقطع دیپلم الزامی
                    میباشد.</span>
              
             
                <input type="checkbox"
                       {{(count($educational_details) == 0 && HR\myFuncs::percent_state(Auth::user()->complete_percent)[1])?' checked ':''}} value="1"
                       id="no_education" name="no_education"/>
                <label for="no_education">زیر دیپلم</label>
            </div>
            <div id="rows-div" class="container">
                @foreach($educational_details as $edu)
                    <div id="row_{{$edu->id}}" class="row edu-result-row">
                        <div class="col-md-3">
                            <label class="">مقطع:</label>
                            <label id="grade_{{$edu->id}}" grade="{{$edu->grade}}"
                                   style="font-weight: bold;">{{$degrees_array[$edu->grade]}}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="">سال تحصیلی:</label>
                            <label id="duration_{{$edu->id}}" class=""
                                   style="font-weight: bold;">{{substr($edu->start_date,0,4)}}  @if(!is_null($edu->start_date))
                                    -@endif {{(is_null($edu->end_date))?'مشغول به تحصیل':substr($edu->end_date,0,4)}}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="">رشته:</label>
                            <label id="field_{{$edu->id}}" value="" class=""
                                   style="font-weight: bold;">{{$edu->field}}</label>
                        </div>
                        <div class="col-md-3">
                            <label class="">نام مرکز آموزشی:</label>
                            <label id="institute_{{$edu->id}}" class=""
                                   style="font-weight: bold;">{{$edu->institute}}</label>
                        </div>
                        <div class="edu-result-row-btn">
                            <div id="_{{$edu->id}}" class="edit-item">
                                <img src="/site/default/Template_2019/img/edit_btn.svg"/>
                                ویرایش
                            </div>
                            <div id="{{$edu->id}}" class="delete-item edu_{{$edu->id}}">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                حذف
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input id="start_date_{{$edu->id}}" value="{{$edu->start_date}}" type="hidden">
                            <input id="end_date_{{$edu->id}}" value="{{$edu->end_date}}" type="hidden">
                            <input id="city_{{$edu->id}}" value="{{$edu->city}}" type="hidden">
                            <input id="field_type_{{$edu->id}}" value="{{$edu->field_type}}" type="hidden">
                            <input id="field_type_id_{{$edu->id}}"
                                   value="{{$edu->api_education_field_type_id}}" type="hidden">
                            <input id="field_id_{{$edu->id}}" value="{{$edu->api_education_field_id}}"
                                   type="hidden">
                            <input id="orientation_{{$edu->id}}" value="{{$edu->orientation}}" type="hidden">
                            <input id="orientation_id_{{$edu->id}}"
                                   value="{{$edu->api_education_orientation_id}}" type="hidden">
                            <input id="institute_type_{{$edu->id}}" value="{{$edu->institute_type}}" type="hidden">
                            <input id="institute_id_{{$edu->id}}" value="{{$edu->api_institute_place_id}}"
                                   type="hidden">
                            <input id="course_type_{{$edu->id}}" value="{{$edu->course_type}}" type="hidden">
                            <input id="average_{{$edu->id}}" value="{{$edu->average}}" type="hidden">
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="clearfix wrap-acc-form">
                <!-- <div class="clearfix acc-form"></div> -->
                <div class="row col-12">
                    <div class="col-md-4">
                        <div class="people-forms-fields-group">
                            <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/>
                            </div>
                            <select name="grade" id="grade" class="form-control chosen"
                                    onchange="$('#grade-help').text('')">
                                <option value=""></option>
                                @foreach($degrees as $degrees_item)
                                    <option value="{{$degrees_item->id}}">{{$degrees_item->name}}</option>
                                @endforeach
                            </select>
                            <span id="grade-help" class="help-block"></span>
                            <label class="chosen-drop-label">مقطع</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="people-forms-fields-group">
                            <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/>
                            </div>
                            <select name="field_type" id="field_type" class="form-control chosen"
                                    onchange="$('#field_type-help').text('')" data-placeholder="انتخاب کنید">
                                <option value=""></option>

                                @foreach($field_types as $field_type)
                                    <option value="{{$field_type->id}}">{{$field_type->name}}</option>
                                @endforeach

                            </select>
                            <span id="field_type-help" class="help-block"></span>
                            <label class="chosen-drop-label">نوع رشته</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="people-forms-fields-group">
                            <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/>
                            </div>
                            <select name="field" id="field" class="form-control chosen"
                                    onchange="$('#field-help').text('')" data-placeholder="انتخاب کنید">
                                <option value=""></option>

                                {{--@foreach($fields as $field)
                                    <option value="{{$field->name}}">{{$field->name}}</option>
                                @endforeach--}}

                            </select>
                            <span id="field-help" class="help-block"></span>
                            <label class="chosen-drop-label">رشته</label>
                        </div>
                    </div>
                    {{--<div class="col-md-4">
                        <div class="people-forms-fields-group">
                            <div class="orientation_checkbox">
                                <input type="checkbox" value="1" id="orientation_checkbox" name="orientation_checkbox"/>
                                <label for="orientation_checkbox">گرایش (در صورت وجود)</label>
                            </div>
                        </div>
                    </div>--}}

                    <div class="col-md-4">
{{--
                        <div class="orientation_selectbox">
--}}

                            <div class="people-forms-fields-group">
                                <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/>
                                </div>
                            <select name="orientation" id="orientation" class="form-control chosen"
                                    onchange="$('#orientation-help').text('')">
                                <option value=""></option>
                                {{--@foreach($orientations as $orientation)
                                    <option value="{{$orientation->Name}}">{{$orientation->Name}}</option>
                                @endforeach--}}
                            </select>
                            <span id="orientation-help" class="help-block"></span>
                            <label class="chosen-drop-label">گرایش</label>
                        </div>
                    </div>


                </div>
                <div class="row col-12">
                    <div class="col-md-4">
                        <div class="people-forms-fields-group">
                            <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/>
                            </div>
                            <select name="start_month" id="start_month" class="form-control chosen"
                                    onchange="$('#start_month-help').text('')">
                                <option value=""></option>
                                @foreach(config('app.persian_months') as $key=>$item)
                                    <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>
                            <span id="start_month-help" class="help-block"></span>
                            <label class="chosen-drop-label"> ماه شروع</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="people-forms-fields-group">
                            <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/>
                            </div>
                            <select name="start_year" id="start_year" class="form-control chosen"
                                    onchange="$('#start_year-help').text('')">
                                <option value=""></option>
                                @for($i = $current_year; $i > $current_year - 70; $i--)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            <span id="start_year-help" class="help-block"></span>
                            <label class="chosen-drop-label">سال شروع</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="people-forms-fields-group text-right font-13">
                            <input type="checkbox" value="1" id="until_now" name="until_now"
                                   onchange="$('#end_month-help').text('');$('#end_year-help').text('')"/>
                            <label for="until_now">هنوز مشغول به تحصیل هستم.</label>
                        </div>
                    </div>
                </div>
                <div class="row col-12">
                    <div class="col-md-4">
                        <div class="people-forms-fields-group">
                            <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/>
                            </div>
                            <select name="end_month" id="end_month" class="form-control chosen"
                                    onchange="$('#end_month-help').text('')">
                                <option value=""></option>
                                @foreach(config('app.persian_months') as $key=>$item)
                                    <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>
                            <span id="end_month-help" class="help-block"></span>
                            <label class="chosen-drop-label">ماه پایان</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="people-forms-fields-group">
                            <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/>
                            </div>
                            <select name="end_year" id="end_year" class="form-control chosen"
                                    onchange="$('#end_year-help').text('')">
                                <option></option>
                                @for($i = $current_year; $i > $current_year - 70; $i--)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            <span id="end_year-help" class="help-block"></span>
                            <label class="chosen-drop-label">سال پایان</label>

                        </div>
                    </div>
                </div>
                <div class="row col-12">
                    <div class="col-md-4">
                        <div class="people-forms-fields-group">
                            <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/>
                            </div>
                            <select name="institute_type" id="institute_type" class="form-control chosen"
                                    onchange="onchangeInstitute()">
                                <option value=""></option>
                                @foreach($institute_types as $institute_type)
                                    <option value="{{$institute_type->id}}">{{$institute_type->name}}</option>
                                @endforeach
                            </select>
                            <span id="institute_type-help" class="help-block"></span>
                            <label class="chosen-drop-label"> ساختار مؤسسه</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="people-forms-fields-group">
                            <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/>
                            </div>
                             <div class="dropdown_for_institute">
                           
                            <select name="institute" id="institute" class="form-control chosen institute_select"
                                    onchange="$('#institute-help').text('')">
                                <option value=""></option>

                            </select>
                            </div>
                          <div class="input_for_institute">

                            <input name="institute" id="institute"
                                   class="form-control institute_input people-forms-fields"
                                   autocomplete="off" oninput="$('#institute-help').text('')"
                                   style="margin-top: 15px; display:none">
                            </div>       


                            <span id="institute-help" class="help-block"></span>
                            <label class="chosen-drop-label">نام مرکز آموزشی</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="people-forms-fields-group dropdown_province">
                            <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/>
                            </div>
                            <select name="city" id="city" class="form-control chosen"
                                    onchange="$('#city-help').text('')">
                                <option value=""></option>
                                @foreach($provinces as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                            <span id="city-help" class="help-block"></span>
                            <label class="chosen-drop-label">استان</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="people-forms-fields-group">
                            <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/>
                            </div>
                            <select name="course_type" id="course_type"
                                    class="form-control chosen"
                                    onchange="$('#course_type-help').text('')">
                                <option value=""></option>
                                @foreach(config('app.enum_course_type') as $key=>$item)
                                    <option value="{{$key}}">{{$item}}</option>
                                @endforeach
                            </select>
                            <span id="course_type-help" class="help-block"></span>
                            <label class="chosen-drop-label">نوع دوره</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="people-forms-fields-group">
                            <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/>
                            </div>
                            <input name="average" id="average" type="text" class="form-control people-forms-fields"
                                   autocomplete="off" oninput="$('#average-help').text('')">
                            <span id="average-help" class="help-block"></span>
                            <label class="chosen-drop-label">معدل </label>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 mt-3 text-right">
                <div class="col-md-12 mt-3 text-right">
                    <button type="button" class="save save_edu save-btn pr-1 pl-1"
                            id="save_edu"><i class="fa fa-plus"></i> ذخیره ی مقطع تحصیلی
                    </button>
                    <button  style="background: red!important;"  type="button" class="save save-btn pr-5 pl-5 empty_form"><i class="fa fa-minus"></i>
                        پاک کردن
                    </button>
                </div>




            </div>

        </div>
        <hr>
        <fieldset class="mt-5 w-100">
            <legend class="text-left">
                <input type="submit"
                       onclick="var education_id = $('#save_edu').attr('education_id'); if (education_id != null) { $('#save_edu').click(); }"
                       class="save send-btn-green " title="ادامه"
                       value="ادامه">
            </legend>
            {{--<legend>
                <a  class="save send-btn-green laleh" title=" افزودن مقطع تحصیلی جدید ">افزودن مقطع تحصیلی جدید</a>
            </legend>--}}
        </fieldset>

    </div>
    {{Form::close()}}

@endsection

@section('script')


    {{ Html::script('/site/'.config('app.site_theme').'/js/chosen.jquery.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/inputmask.binding.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/jquery.inputmask.bundle.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/phone.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/phone-uk.js') }}

    <script>

        //Edited By KiaM
        $(document).ready(function () {

            $('#field').prop('disabled', true);
            $('#orientation').prop('disabled', true);
            $('#orientation').prop('disabled', true);
            $('#orientation').prop('disabled', true);

            $('.chosen').chosen({
                placeholder_text_single: 'انتخاب کنید'
            });

            if ($('#no_education').prop('checked')) {
                $(".wrap-acc-form, .save_edu").fadeOut(function () {
                });
            } else {
                $(".wrap-acc-form, .save_edu").fadeIn(function () {
                });
            }


            if ($(window).width() < 992) {
                $(document).ready(function () {
                    $('html, body').animate({
                        scrollTop: $('#scroll-resume').offset().top - 20
                    }, 'slow');
                });
            }

        });

        $(document).on('change', '#field_type', function () {
            $('#field').prop('disabled', true).trigger("chosen:updated");
            $('#orientation').prop('disabled', true).trigger("chosen:updated");
            /*$('#field').trigger("chosen:updated");
            $('#orientation')$('#orientation').trigger("chosen:updated");;*/

            let selected_field_type_id = $('#field_type').val();
            $.post("/profile/resume/ajax-educations-fields",
                {
                    _token: "{!! csrf_token() !!}",
                    field_type_id: selected_field_type_id,
                },
                function (data, status) {
                    let newOption = data;
                    $('#field').empty();

                    $('#field').append(newOption);
                    $("#field").chosen({
                        placeholder_text_single: "انتخاب کنید"
                    });
                    $('#field').prop('disabled', false).trigger("chosen:updated");
                    if ($('#field option:selected').val() === '0') {
                        $('#field').change();
                    }
                });

        });

        $(document).on('change', '#field', function () {

            $('#orientation').prop('disabled', true).trigger("chosen:updated");

            let selected_field_id = $('#field').val();
            $.post("/profile/resume/ajax-educations-orientations",
                {
                    _token: "{!! csrf_token() !!}",
                    field_id: selected_field_id,
                },
                function (data, status) {
                    let newOption = data;
                    $('#orientation').empty();
                    $('#orientation').append(newOption);
                    $("#orientation").chosen({
                        placeholder_text_single: "انتخاب کنید"
                    });
                    $('#orientation').trigger("chosen:updated");
                    $('#orientation').prop('disabled', false).trigger("chosen:updated");
                });

            $('#field').trigger("chosen:updated");
        });

         $('body').on('click', '.empty_form', function () {
                    $(this).closest('form').find("select, textarea").val("");
                    $('a.chosen-single').find('span').text('انتخاب کنید');
                    $("#until_now").prop("checked", false);
                    $("#average").val("");

                    // $("#start_month option:selected").removeAttr('selected');

                });

        $(document).on('change', '#institute_type', function () {

            let grade_id = $('#grade option:selected').val();
            if (grade_id != '1') {
                $('#institute').prop('disabled', true).trigger("chosen:updated");

                let selected_institute_type_id = $('#institute_type').val();
                $.post("/profile/resume/ajax-institute",
                    {
                        _token: "{!! csrf_token() !!}",
                        institute_type_id: selected_institute_type_id,
                    },
                    function (data, status) {
                        let newOption = data;
                        $('#institute').empty();
                        $('#institute').append(newOption);
                        $("#institute").chosen({
                            placeholder_text_single: "انتخاب کنید"
                        });
                        $('#institute').trigger("chosen:updated");
                        $('#institute').prop('disabled', false).trigger("chosen:updated");
                    });
            }

        });

        $(document).on('change', '#grade', function () {

            let grade_id = $('#grade option:selected').val();
            if (grade_id == '1') {
                select_diploma();
            } else {
                cancel_select_diploma();
            }

        });

        $('#eduform').on('submit', function (e) {
            e.preventDefault();
            if ($('#grade').val() != "" || $('#field').val() != "" || $('#field_type').val() != "" || $('#orientation').val() != "" || $('#start_month').val() != "" || $('#start_year').val() != "" || $('#end_month').val() != "" || $('#end_year').val() != "" || $('#institute').val() != "" || $('#institute_type').val() != "" || $('#city').val() != "" || $('#course_type').val() != "" || $('#average').val() != "") {
                if (confirm("سابقه ی تحصیلی شما ذخیره نشده است، آیا مایل به ذخیره ی سابقه ی تحصیلی می باشید؟")) {
                    $('#save_edu').click();
                }
            } else if (!$('div').hasClass('edu-result-row') && !$('#no_education').is(':checked')) {
                alert('اگر مدرک شما زیر دیپلم است، گزینه ی زیر دیپلم را انتخاب کنید. در غیر اینصورت لطفا اطلاعات تحصیلی خود را در فرم زیر وارد کنید.');
                return false;
            } else {
                this.submit();
            }
        });

        $('body').on('click', '.delete-item', function () {
            var id = $(this).attr('id');
            $.post(
                "{!! route('user.resume.education.delete') !!}",
                {
                    _token: "{!! csrf_token() !!}",
                    id: id
                }
            ).done(function (data) {
                $('#row_' + id).remove();
            });
        });

        $('body').on('click', '.edit-item', function () {

            if ($(this).hasClass('cancel')) {
                cancel_edit();
                return;
            }
            //cancel_select_diploma();

            // remove edit effects from another divs
            $('.help-block').text('');
            $('.blur').removeClass("blur");
            $('.cancel').removeClass("cancel");
            $('.edit-item').html("<i class=\"fa fa fa-pencil-square-o\" aria-hidden=\"true\"></i> ویرایش");
            $('#save_edu').removeAttr('education_id');
            //add edit effects on
            $('.edu' + $(this).attr('id')).addClass("blur");
            $(this).html("<i class=\"fa fa-times\" aria-hidden=\"true\"></i> انصراف");
            $(this).addClass('cancel');
            $('#save_edu').attr('education_id', $(this).attr('id').substr(1));

            $('#grade').val($('#grade' + $(this).attr('id')).attr('grade'));
            $('#grade').trigger("chosen:updated");

            $('#field_type').val($('#field_type_id' + $(this).attr('id')).val());
            $('#field_type').trigger("chosen:updated");

            $('#institute_type').val($('#institute_type' + $(this).attr('id')).val());
            $('#institute_type').trigger("chosen:updated");

            let th;
            th = $(this);

            let selected_field_type_id = $('#field_type_id' + th.attr('id')).val();
            $.post("/profile/resume/ajax-educations-fields",
                {
                    _token: "{!! csrf_token() !!}",
                    field_type_id: selected_field_type_id,
                },
                function (data, status) {
                    let newOption = data;
                    //console.log(data);
                    $('#field').empty();
                    $('#field').append(newOption);
                    $('#field').trigger("chosen:updated");
                    $('#field').prop('disabled', false).trigger("chosen:updated");
                    let this_id = th[0].attributes.id.nodeValue;
                    let field_value = $('#field_id' + this_id).val();
                    $('#field').val(field_value).trigger("chosen:updated");
                    if ($('#field option:selected').val() === '0') {
                        $('#field').change();
                    }
                });

            $('#orientation').prop('disabled', true).trigger("chosen:updated");
            let selected_field_id = $('#field_id' + th.attr('id')).val();
            $.post("/profile/resume/ajax-educations-orientations",
                {
                    _token: "{!! csrf_token() !!}",
                    field_id: selected_field_id,
                },
                function (data, status) {
                    let newOption = data;
                    $('#orientation').empty();
                    $('#orientation').append(newOption);
                    $('#orientation').trigger("chosen:updated");
                    $('#orientation').prop('disabled', false).trigger("chosen:updated");
                    let this_id = th[0].attributes.id.nodeValue;
                    let orientation_value = $('#orientation_id' + this_id).val();
                    $('#orientation').val(orientation_value).trigger("chosen:updated");
                });

            if ($('#grade').val() == 1){
                select_diploma();

                $('input#institute').val($('#institute' + $(this).attr('id')).html());
            }
            else{
                cancel_select_diploma();

                $('#institute').prop('disabled', true).trigger("chosen:updated");
                let selected_institute_type_id = $('#institute_type' + th.attr('id')).val();
                $.post("/profile/resume/ajax-institute",
                    {
                        _token: "{!! csrf_token() !!}",
                        institute_type_id: selected_institute_type_id,
                    },
                    function (data, status) {
                        let newOption = data;
                        $('#institute').empty();
                        $('#institute').append(newOption);
                        $('#institute').trigger("chosen:updated");
                        $('#institute').prop('disabled', false).trigger("chosen:updated");
                        let this_id = th[0].attributes.id.nodeValue;
                        let institute_value = $('#institute_id' + this_id).val();
                        $('#institute').val(institute_value).trigger("chosen:updated");
                    });

                $('#institute').val($('#institute' + $(this).attr('id')).html());
            }

            $('#course_type').val($('#course_type' + $(this).attr('id')).val());
            $('#course_type').trigger("chosen:updated");

            $('#city').val($('#city' + $(this).attr('id')).val());
            $('#city').trigger("chosen:updated");

            $('#average').val($('#average' + $(this).attr('id')).val());

            $('#start_month').val($('#start_date' + $(this).attr('id')).val().substr(5, 2));
            $('#start_month').trigger("chosen:updated");

            $('#start_year').val($('#start_date' + $(this).attr('id')).val().substr(0, 4));
            $('#start_year').trigger("chosen:updated");
            $('#institute_type').val($('#institute_type' + $(this).attr('id')).val());
            $('#institute_type').trigger("chosen:updated");

            if ($('#end_date' + $(this).attr('id')).val() == "") {
                $("#until_now").prop("checked", true);
                //disable chosens
                $('#end_month').val('');
                $('#end_year').val('');
                $('#end_month').prop('disabled', true);
                $('#end_year').prop('disabled', true);
                $('#end_month').trigger("chosen:updated");
                $('#end_year').trigger("chosen:updated");
            } else {
                //enable chosens
                $('#end_month').prop('disabled', false);
                $('#end_year').prop('disabled', false);
                $('#end_month').trigger("chosen:updated");
                $('#end_year').trigger("chosen:updated");

                $('#end_month').val($('#end_date' + $(this).attr('id')).val().substr(5, 2));
                $('#end_month').trigger("chosen:updated");
                $('#end_year').val($('#end_date' + $(this).attr('id')).val().substr(0, 4));
                $('#end_year').trigger("chosen:updated");
            }

        });

        $('#phone_number_code').keyup(function () {
            if ($(this).val().length === 3)
                $('#phone_number_ext').focus();
        });

        $('#phone_number_ext').on('keydown', function (event) {
            var key = event.keyCode || event.charCode;
            if (key == 8 && $(this).val().length === 0) {
                // $('#phone_number_code').val($('#phone_number_code').val().substr(0,2));
                $('#phone_number_code').focus();
            }
        });

        $("#until_now").on('change', function () {
            if ($(this).is(':checked')) {
                $('#end_month').val('');
                $('#end_year').val('');
                $('#end_month').prop('disabled', true);
                $('#end_year').prop('disabled', true);
                $('#end_month').trigger("chosen:updated");
                $('#end_year').trigger("chosen:updated");
            } else {
                $('#end_month').prop('disabled', false);
                $('#end_month').trigger("chosen:updated");
                $('#end_year').prop('disabled', false);
                $('#end_year').trigger("chosen:updated");
            }
        });

        $('#save_edu').on('click', function () {
            if (!validate_all())
                return;

            $('#no_education').prop('checked', false);
            var education_id = $(this).attr('education_id');
            var grade = $('#grade option:selected').val();

            var field_type = $('#field_type option:selected').text();
            var field_type_id = $('#field_type option:selected').val();

            var field = $('#field option:selected').text();
            var field_id = $('#field option:selected').val();

            var orientation = $('#orientation option:selected').text();
            var orientation_id = $('#orientation option:selected').val();

            if (grade != '1') {
                var institute = $('.institute_select option:selected').text();
                var institute_id = $('.institute_select option:selected').val();
            } else {
                var institute = $('.institute_input').val();
                var institute_id = 0;
            }

            var institute_type = $('#institute_type option:selected').val();

            var course_type = $('#course_type').val();

                var city = $('#city').val();
          


            var average = $('#average').val();

            var enum_degrees = {!! json_encode($degrees_array) !!};

            var start_date = $('#start_year').val() + '/' + $('#start_month').val() + '/01';
            var end_date;
            if ($("#until_now").is(':checked')) {
                end_date = null;
            } else {
                end_date = $('#end_year').val() + '/' + $('#end_month').val() + '/01';
            }

            if (education_id == null) {

                $.post(
                    "{!! route('user.resume.education.create') !!}",
                    {

                        _token: "{!! csrf_token() !!}",
                        grade: grade,
                        field: field,
                        field_id: field_id,
                        field_type: field_type,
                        field_type_id: field_type_id,
                        orientation: orientation,
                        orientation_id: orientation_id,
                        institute: institute,
                        institute_id: institute_id,
                        institute_type: institute_type,
                        course_type: course_type,
                        city: city,
                        average: average,
                        start_date: start_date,
                        end_date: end_date,
                    }
                ).done(function (data) {
                        console.log(data);
                        if (data != 0) {
                            var duration;
                            if ($("#until_now").is(':checked'))
                                duration = $('#start_year').val() + ' - ' + 'مشغول به تحصیل';
                            else {
                                duration = $('#start_year').val();
                                if (grade !== 1)
                                    duration = duration + ' - '
                                duration = duration + $('#end_year').val();
                            }
                            if (end_date == null)
                                end_date = '';
                            if (orientation == null)
                                orientation = '';

                            $('#rows-div').prepend(
                                '<div class="row edu-result-row" id="row_' + data + ' row " >\n' +
                                '\n' +
                                '                                   <div class="col-md-3">\n' +
                                '                                       <label class="">مقطع:</label>\n' +
                                '                                       <label id="grade_' + data + '" grade="' + grade + '" style="font-weight: bold;">' + enum_degrees[grade] + '</label>\n' +
                                '                                   </div>\n' +
                                '\n' +
                                '                                   <div class="col-md-3">\n' +
                                '                                       <label class="">سال تحصیلی:</label>\n' +
                                '                                       <label id="duration_' + data + '" style="font-weight: bold;">' + duration + '</label>\n' +
                                '                                   </div>\n' +
                                '\n' +
                                '                                   <div class="col-md-3">\n' +
                                '                                       <label class="">رشته:</label>\n' +
                                '                                       <label id="field_' + data + '" style="font-weight: bold;">' + field_type + ' ' + field + '</label>\n' +
                                '                                   </div>\n' +
                                '\n' +
                                '                                   <div class="col-md-3">\n' +
                                '                                       <label class="">نام مرکز آموزشی:</label>\n' +
                                '                                       <label id="institute_' + data + '" style="font-weight: bold;">' + institute + '</label>\n' +
                                '                                   </div>\n' +
                                '                                   <div class="clearfix"></div>\n' +
                                '\n' +
                                '                                    <input id="field_type_id_' + data + '" value="' + field_type_id + '" type="hidden">\n' +
                                '                                    <input id="field_type_' + data + '" value="' + field_type + '" type="hidden">\n' +
                                '                                    <input id="field_id_' + data + '" value="' + field_id + '" type="hidden">\n' +
                                '                                    <input id="orientation_id_' + data + '" value="' + orientation_id + '" type="hidden">\n' +
                                '                                    <input id="orientation_' + data + '" value="' + orientation + '" type="hidden">\n' +
                                '                                    <input id="end_date_' + data + '" value="' + end_date + '" type="hidden">\n' +
                                '                                    <input id="city_' + data + '" value="' + city + '" type="hidden">\n' +
                                '                                    <input id="institute_type_' + data + '" value="' + institute_type + '" type="hidden">\n' +
                                '                                    <input id="institute_id_' + data + '" value="' + institute_id + '" type="hidden">\n' +
                                '                                    <input id="course_type_' + data + '" value="' + course_type + '" type="hidden">\n' +
                                '                                    <input id="average_' + data + '" value="' + average + '" type="hidden">\n' +
                                '\n' +
                                '                                    <div class="col-xs-12 action-container">\n' +
                                '                                        <div class="col-xs-12">\n' +
                                '                                            <div id="_' + data + '" class="edit-item" style="display: inline-block;cursor: pointer">\n' +
                                '                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> ویرایش\n' +
                                '                                            </div>\n' +
                                '                                            <div id="' + data + '" style="display: inline-block;cursor: pointer; margin-right: 10px;" class="delete-item edu_' + data + '">\n' +
                                '                                                <i class="fa fa-trash-o" aria-hidden="true"></i>\n' +
                                '                                                حذف\n' +
                                '                                            </div>\n' +
                                '                                        </div>\n' +
                                '                                    </div>\n' +
                                '</div>'
                            );

                            cancel_edit();
                        }
                    }
                ).fail(function(data){
                  /*  var res     = JSON.parse(data);
                    var message = obj[0]['response']*/

                    $('#rows-div').prepend('   <div class="bg-error" style="text-align: right">\n' +
                        '                            <a href="" class="close-error"><i class="fa fa-remove"></i></a>\n' +
                        '                            <p style="direction: rtl" >متاسفانه شما امکان همکاری با گروه صنعتی گلرنگ را ندارید</p>\n' +
                        '                        </div>');


                })

                ;
            } else {
                $.post(
                    "{!! route('user.resume.education.edit') !!}",
                    {
                        _token: "{!! csrf_token() !!}",
                        education_id: education_id,
                        grade: grade,
                        field: field,
                        field_id: field_id,
                        field_type: field_type,
                        field_type_id: field_type_id,
                        orientation: orientation,
                        orientation_id: orientation_id,
                        institute: institute,
                        institute_id: institute_id,
                        institute_type: institute_type,
                        course_type: course_type,
                        city: city,
                        average: average,
                        start_date: start_date,
                        end_date: end_date,
                    }
                ).done(function (data) {

                        if (data != 0) {
                            var duration;
                            if ($("#until_now").is(':checked'))
                                duration = $('#start_year').val() + ' - ' + 'مشغول به تحصیل';
                            else {
                                duration = $('#start_year').val();
                                if (parseInt(grade) !== 1)
                                    duration = duration + ' - ';
                                duration = duration + $('#end_year').val();
                            }

                            $('#grade_' + education_id).html(enum_degrees[grade]);
                            $('#field_' + education_id).html(field_type + ' ' + field);
                            $('#institute_' + education_id).html(institute);
                            $('#duration_' + education_id).html(duration);
                            $('#start_date_' + education_id).val(start_date);
                            if (end_date == null)
                                $('#end_date_' + education_id).val('');
                            else
                                $('#end_date_' + education_id).val(end_date);
                            $('#city_' + education_id).val(city);
                            $('#field_type_' + education_id).val(field_type);
                            $('#field_type_id_' + education_id).val(field_type_id);
                            $('#field_id_' + education_id).val(field_id);
                            if (orientation == null)
                                $('#orientation_' + education_id).val('');
                            else
                                $('#orientation_' + education_id).val(orientation);
                            $('#orientation_id_' + education_id).val(orientation_id);
                            $('#institute_type_' + education_id).val(institute_type);
                            $('#institute_id_' + education_id).val(institute_id);
                            $('#course_type_' + education_id).val(course_type);
                            $('#average_' + education_id).val(average);

                            cancel_edit();
                        }
                    }
                );
            }
        });

        $('#no_education').change(function () {
            if ($('#no_education').prop('checked')) {
                $(".wrap-acc-form, .save_edu").fadeOut("slow", function () {
                });
            } else {
                $(".wrap-acc-form, .save_edu").fadeIn("slow", function () {
                });
            }
        });

        function validate_all(validations) {

            var validity = true;
            var grade = parseInt($('#grade').val());

            if ($('#grade').val() === '') {
                $('#grade-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#start_year').val() === '' && grade !== 1) {
                $('#start_year-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#start_year').val() > $('#end_year').val()) {
                if (!$('#until_now').is(':checked')) {
                    $('#end_year-help').text('سال پایان اشتباه است');
                    validity = false;
                } else
                    validity = true;
            }

            if ($('#start_year').val() == $('#end_year').val()) {
                if ($('#start_month').val() > $('#end_month').val()) {
                    $('#end_month-help').text('ماه پایان اشتباه است');
                    validity = false;
                } else
                    validity = true;
            }

            if ($('#start_month').val() === '' && grade !== 1) {
                $('#start_month-help').text('فیلد اجباری');
                validity = false;
            }

            if (!$('#until_now').is(':checked')) {
                if ($('#end_year').val() === '') {
                    $('#end_year-help').text('فیلد اجباری');
                    validity = false;
                }

                if ($('#end_month').val() === '') {
                    $('#end_month-help').text('فیلد اجباری');
                    validity = false;
                }
            }

            if ($('#field').val() === '') {
                $('#field-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#field_type').val() === '') {
                $('#field_type-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#orientation').val() === '') {
                $('#orientation-help').text('فیلد اجباری');
                validity = false;
            }

            if (grade != '1') {
                let institute_val = $('.institute_select option:selected').val();
            } else {
                var institute_val = $('.institute_input').val();
            }
            if (institute_val === '') {
                $('#institute-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#institute_type').val() === '' && grade !== 1) {
                $('#institute_type-help').text('فیلد اجباری');
                validity = false;
            }

            if (($('#city').val() === ''&& $('#institute_type').val() != 6)|| $('#city').val() === null) {

                $('#city-help').text('فیلد اجباری');
                validity = false;
            }
           /* else
            alert($('#city').val())*/

            if ($('#course_type').val() === '') {
                $('#course_type-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#average').val() === '') {
                $('#average-help').text('فیلد اجباری');
                validity = false;
            }

            return validity;
        }
        
         function  onchangeInstitute() {
        $('#institute_type-help').text('');
        if($('#institute_type').val() == 6)
        {
            $('.dropdown_province').hide();
        }
        else
            $('.dropdown_province').show();
        

       }


        function cancel_edit() {
            //cancel_select_diploma();
            $('.help-block').text('');
            $('.blur').removeClass("blur");
            $('.edit-item').html("<i class=\"fa fa fa-pencil-square-o\" aria-hidden=\"true\"></i> ویرایش");
            $('.cancel').removeClass("cancel");

            $('#grade').prop('disabled', false);
            $('#grade').val('');
            $('#grade').trigger("chosen:updated");

            $('#field').prop('disabled', true);
            $('#field').val('');
            $('#field').trigger("chosen:updated");

            $('#field_type').prop('disabled', false);
            $('#field_type').val('');
            $('#field_type').trigger("chosen:updated");

            $('#orientation').prop('disabled', true);
            $('#orientation').val('');
            $('#orientation').trigger("chosen:updated");

            $('#institute_type').prop('disabled', false);
            $('#institute_type').val('');
            $('#institute_type').trigger("chosen:updated");

            $('#institute').prop('disabled', true);
            $('#institute').val('');
            $('input#institute').val('');
            $('#institute').trigger("chosen:updated");

            $('#course_type').prop('disabled', false);
            $('#course_type').val('');
            $('#course_type').trigger("chosen:updated");

            $('#city').prop('disabled', false);
            $('#city').val('');
            $('#city').trigger("chosen:updated");

            $('#average').val('');

            $('#end_month').prop('disabled', false);
            $('#end_month').val('');
            $('#end_month').trigger("chosen:updated");

            $('#end_year').prop('disabled', false);
            $('#end_year').val('');
            $('#end_year').trigger("chosen:updated");

            $('#start_month').prop('disabled', false);
            $('#start_month').val('');
            $('#start_month').trigger("chosen:updated");

            $('#start_year').prop('disabled', false);
            $('#start_year').val('');
            $('#start_year').trigger("chosen:updated");

            $('#until_now').prop('checked', false);
            $('#until_now').prop('disabled', false);

            $('#save_edu').removeAttr('education_id');
        }

        function select_diploma() {

            /*$('.institute_input').prop('disabled', false);
            $('.institute_input').show();

            $('.institute_select').prop('disabled', true);
            $('.institute_select').next().hide();
            $('.institute_select').trigger("chosen:updated");*/
            $('.dropdown_for_institute').hide();
            $('.input_for_institute').show();
            $('.institute_input').show();

            $('#start_month_div').addClass('blur');
            $('#start_month').prop('disabled', true);
            $('#start_month').val('');
            $('#start_month').trigger("chosen:updated");

            $('#start_year_div').addClass('blur');
            $('#start_year').prop('disabled', true);
            $('#start_year').val('');
            $('#start_year').trigger("chosen:updated");

            $('#until_now_div').addClass('blur');
            $('#until_now').prop('disabled', true);
            $('#until_now').prop('checked', false);

            $('#end_year').prop('disabled', false);
            $('#end_year').trigger("chosen:updated");

            $('#end_month').prop('disabled', false);
            $('#end_month').trigger("chosen:updated");
        }

        function cancel_select_diploma() {
            
           $('.dropdown_for_institute').show();
           $('.input_for_institute').hide();

           /* $('.institute_input').prop('disabled', true);
            $('.institute_input').hide();

            $('.institute_select').prop('disabled', false);
            $('.institute_select').next().show();
            $('.institute_select').trigger("chosen:updated");*/

            $('#institute_type_div').removeClass('blur');
            $('#institute_type').prop('disabled', false);
            $('#institute_type').trigger("chosen:updated");

            $('#start_year_div').removeClass('blur');
            $('#start_year').prop('disabled', false);
            $('#start_year').trigger("chosen:updated");

            $('#start_month_div').removeClass('blur');
            $('#start_month').prop('disabled', false);
            $('#start_month').trigger("chosen:updated");

            $('#until_now_div').removeClass('blur');
            $('#until_now').prop('disabled', false);
            $('#until_now').trigger("chosen:updated");
        }

    </script>

@endsection