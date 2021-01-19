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
        }

        td, th {
            border: 1px solid #dddddd !important;
            text-align: center !important;
            padding: 8px !important;
        }
    </style>

@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: پروفایل
@endsection

@section('content')

    @include('site.pages.user.side_bar')

    {{ Form::open(array('method'=>'PUT','route' => 'user.resume.3.store','files' => true, 'id' => 'workform')) }}

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
            <legend>لطفا همه سوابق شغلی خود را به ترتیب از آخرین مقطع وارد فرمایید.</legend>
        </fieldset>


        <div class="row mt-2">
            <div class="col-12 people-forms-fields-group">
                <p style="color:red">جهت حضور در مصاحبه منابع انسانی، تکمیل کلیه سوابق شغلی الزامی میباشد.</p>

                <input type="checkbox"
                       {{(count($resume->work_experiences) == 0 && HR\myFuncs::percent_state(Auth::user()->complete_percent)[3]) ? checked:''}} value="1"
                    id="no_work_experience" name="no_work_experience" data-enpassusermodified="yes">
                <label for="no_work_experience">
                    فاقد سابقه ی کار هستم
                </label>
            </div>
            <div id="rows-div" class="container">

            @foreach($resume->work_experiences as $job)
                <div class="row edu-result-row prev-experiences" id="row_{{$job->id}}">
                    <div class="col-md-3 exp_{{$job->id}}">
                        <label class="">عنوان شغلی :</label>
                        <label id="last_post_{{$job->id}}">{{$job->last_post}}</label>
                    </div>
                    <div class="col-md-3 exp_{{$job->id}}">
                        <label class="">سازمان:</label>
                        <label id="title_{{$job->id}}" class="">{{$job->title}}</label>
                    </div>
                    <div class="col-md-3 exp_{{$job->id}}">
                        <label class="">مدت همکاری:</label>
                        <label id="duration_{{$job->id}}" class="">{{substr($job->start_date,0,4)}}
                            - {{(is_null($job->end_date))?'تاکنون':substr($job->end_date,0,4)}}</label>
                    </div>
                    <div class="col-md-3 exp_{{$job->id}}">
                        <label class="">تلفن:</label>
                        <label id="phone_number_ext_{{$job->id}}" class="">{{substr($job->phone_number,3)}}</label>
                        -
                        <label id="phone_number_code_{{$job->id}}" class="">{{substr($job->phone_number,0,3)}}</label>
                    </div>
                    <div class="edu-result-row-btn">
                        <div id="_{{$job->id}}" class="edit-item">
                            <img src="/site/default/Template_2019/img/edit_btn.svg"/> ویرایش
                        </div>
                        <div id="{{$job->id}}" class="delete-item exp_{{$job->id}}">
                            <img src="/site/default/Template_2019/img/remove_btn.svg"/>حذف
                        </div>
                    </div>
                    <input id="start_date_{{$job->id}}" value="{{$job->start_date}}" type="hidden">
                    <input id="end_date_{{$job->id}}" value="{{$job->end_date}}" type="hidden">
                    <input id="cause_interruption_{{$job->id}}" value="{{$job->cause_interruption}}" type="hidden">
                    <input id="important_tasks_{{$job->id}}" value="{{$job->important_tasks}}" type="hidden">
                    <input id="province_id_{{$job->id}}" value="{{$job->province_id}}" type="hidden">
                </div>
            @endforeach
            <div class="row col-12 add-experience">
                <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <input maxlength="100" id="title" type="text" class="form-control people-forms-fields"
                               oninput="$('#title-help').text('')">
                        <label class="chosen-drop-label">سازمان</label>
                        <span id="title-help" class="help-block"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <input maxlength="50" id="last_post" type="text" class="form-control people-forms-fields"
                               oninput="$('#last_post-help').text('')">
                        <label class="chosen-drop-label">عنوان شغلی </label>
                        <span id="last_post-help" class="help-block"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row phone-Input">
                        <div class="people-forms-fields-group col-8 col-md-8 pl-0">
                            <input id="phone_number_ext" name="phone_number_ext"
                                   class="form-control people-forms-fields" maxlength="8" type="tel"
                                   onchange="$('#phone_number-help').text('')">
                            <label class="chosen-drop-label">تلفن</label>
                            <span id="phone_number-help" class="help-block"></span>
                        </div>
                        <div class="people-forms-fields-group col-4 col-md-4 pr-1">
                            <input id="phone_number_code" name="phone_number_code"
                                   class="form-control people-forms-fields" maxlength="3" type="tel"
                                   onchange="$('#phone_number-help').text('')">
                        </div>
                        <span id="phone_number_ext-help" class="help-block"></span>
                    </div>
                </div>
                <div class="row col-md-12 m-0 p-0">
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
                            <label class="chosen-drop-label">ماه شروع</label>
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
                        <div class="people-forms-fields-group">
                            <input type="checkbox" value="1" id="until_now" name="until_now"
                                   onchange="$('#end_month-help').text('');$('#end_year-help').text('')"/>
                            <label for="until_now">
                                هنوز در این شرکت مشغول به کار هستم.
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <select name="end_month" id="end_month" class="form-control chosen"
                                onchange="$('#end_month-help').text('')">
                            <option value=""></option>
                            @foreach(config('app.persian_months') as $key=>$item)
                                <option value="{{$key}}">{{$item}}</option>
                            @endforeach
                        </select>
                        <label class="chosen-drop-label">ماه پایان</label>
                        <span id="end_month-help" class="help-block"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <select name="end_year" id="end_year" class="form-control chosen"
                                onchange="$('#end_year-help').text('')">
                            <option></option>
                            @for($i = $current_year; $i > $current_year - 70; $i--)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        <label class="chosen-drop-label">سال پایان</label>
                        <span id="end_year-help" class="help-block"></span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <select onchange="fillAreaCode()" name="province" id="provinces"
                                data-placeholder="یک گزینه انتخاب کنید"
                                class="ostan-select form-control has-value form-control people-forms-fields po-input-select chosen">
                            <option value="">یک گزینه را انتخاب کنید</option>

                            @foreach($provinces as $province)
                                <option value="{{$province->id}}"
                                        areacode="{{$province->areacode}}">{{(isset($province->name)?$province->name:'')}}</option>
                            @endforeach
                        </select>
                        <label class="chosen-drop-label">استان</label>
                        <span id="provinces-help" class="help-block"></span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <textarea name="cause_interruption" id="cause_interruption"
                                  class="form-control form-control-area comment-contact" rows="3"
                                  onchange="$('#cause_interruption-help').text('')"
                                  ></textarea>
                                               <label>علت قطع همکاری</label>

                        <span id="cause_interruption-help" class="help-block"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"/></div>
                        <textarea name="important_tasks" id="important_tasks"
                                  class="form-control form-control-area comment-contact" rows="4"
                                  onchange="$('#important_tasks-help').text('')"></textarea>
                                               <label>وظایف اصلی </label>

                        <span id="important_tasks-help" class="help-block"></span>
                    </div>
                </div>
                <div class="mt-5 text-center btn add-row-experimental add-row-btn">
                    <button type="button" class="save save-btn pr-5 pl-5" id="save_job"><i class="fa fa-plus"></i>ذخیره
                        ی سابقه شغلی
                    </button>
                </div>

                <div class="mt-5 text-center btn add-row-experimental add-row-btn">
                    <button  style="background: red!important;"  type="button" class="save save-btn pr-5 pl-5 empty_form"><i class="fa fa-minus"></i>
                        پاک کردن
                    </button>
                </div>


            </div>
            <hr>
            <fieldset class="mt-5 w-100">
                <legend class="text-left">
                    <input type="submit"
                           {{--onclick="var job_id = $('#save_job').attr('job_id'); if (job_id != null) { $('#save_job').click(); }" --}} class="save send-btn-green"
                           title="ادامه" value="ادامه">
                </legend>
            </fieldset>
        </div>

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
        $(document).ready(function () {
            $('.chosen').chosen({
                placeholder_text_single: 'انتخاب کنید'
            });
            @if ($resume->work_experiences->count() == 0 && HR\myFuncs::percent_state(Auth::user()->complete_percent)[3])
            $(".add-experience").css('display', 'none');

            @endif
        });

        $('#workform').on('submit', function (e) {
            e.preventDefault();
            /*var job_id = $('#save_job').attr('job_id');*/
            /*if (job_id != null) {
                $('#save_job').click();
                this.submit();*/
            if ($('#title').val() != "" || $('#last_post').val() != "" || $('#cause_interruption').val() != "" || $('#important_tasks').val() != "" || $('#phone_number_ext').val() != "" || $('#phone_number_code').val() != "") {
                if (confirm("سابقه ی شغلی شما ذخیره نشده است، آیا مایل به ذخیره ی سابقه ی شغلی می باشید؟")) {
                    $('#save_job').click();
                }
            } else if (!$('div').hasClass('edu-result-row') && !$('#no_work_experience').is(':checked')) {
                alert('اگر سابقه شغلی ندارید، لطفا گزینه ی «فاقد سابقه‌ی کار هستم» را انتخاب کنید. در غیر اینصورت لطفا سوابق شغلی خود را در فرم زیر وارد کنید.');
                return false;

            } else {
                this.submit();
            }
        });


        function fillAreaCode() {
            var value = $(document).find('#provinces').val();
            var arecode = $("#provinces").find(':selected').attr('areacode');
            $("#phone_number_code").val(arecode);
            $('#provinces-help').text('');
        }

        if ($(window).width() < 992) {
            $(document).ready(function () {
                $('html, body').animate({
                    scrollTop: $('#scroll-resume').offset().top - 20
                }, 'slow');
            });
        }
        $('#no_work_experience').change(function () {
            if ($('#no_work_experience').prop('checked')) {
                $(".prev-experiences,.add-experience").fadeOut("slow", function () {
                });
            } else {
                $(".prev-experiences,.add-experience").fadeIn("slow", function () {
                });
            }
        });

        function validate_all(validations) {
            var validity = true;

            if ($('#title').val() === '') {
                $('#title-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#last_post').val() === '') {
                $('#last_post-help').text('فیلد اجباری');
                validity = false;
            }

            /* if ($('#cause_interruption').val() === '') {
                 $('#cause_interruption-help').text('فیلد اجباری');
                 validity = false;
             }*/

            if ($('#important_tasks').val() === '') {
                $('#important_tasks-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#start_year').val() === '') {
                $('#start_year-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#start_month').val() === '') {
                $('#start_month-help').text('فیلد اجباری');
                validity = false;
            }

            if ($('#provinces').val() === '') {
                $('#provinces-help').text('فیلد اجباری');
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

                if ($('#cause_interruption').val() === '') {
                    $('#cause_interruption-help').text('فیلد اجباری');
                    validity = false;
                }
            }
            if (($('#phone_number_code').val() != "") && (/[0۰٠][۰۱۲۳۴۵۶۷۸۹0123456789٠١٢٣٤٥٦٧٨٩]{2}/.test($('#phone_number_code').val()) == false)) {
                $('#phone_number-help').text('مقدار پیش شماره نامعتبر');
                validity = false;
            }

            if($('#start_year').val() > $('#end_year').val())
            {
                if (!$("#until_now").is(':checked')) {

                    $('#end_year-help').text('سال پایان اشتباه است');
                    validity = false;
                }
                else
                    validity=true;

            }
            if($('#start_year').val() == $('#end_year').val())
            {
                if($('#start_month').val() > $('#end_month').val())

                {
                    $('#end_month-help').text('ماه پایان اشتباه است');
                    validity = false;

                }

            }

            if (($('#phone_number_ext').val() != "")) {
                if ((/[0۰٠][۰۱۲۳۴۵۶۷۸۹0123456789٠١٢٣٤٥٦٧٨٩]{2}/.test($('#phone_number_code').val()) == false)) {
                    $('#phone_number-help').text('مقدار پیش شماره نامعتبر');
                    validity = false;
                } else if ((/[۰۱۲۳۴۵۶۷۸۹0123456789٠١٢٣٤٥٦٧٨٩]{8}/.test($('#phone_number_ext').val()) == false)) {
                    $('#phone_number-help').text('مقدار شماره تلفن نامعتبر');
                    validity = false;
                }

            }

            return validity;
        }

        function cancel_edit() {
            $('.blur').removeClass("blur");
            $('.edit-item').html("<i class=\"fa fa fa-pencil-square-o\" aria-hidden=\"true\"></i> ویرایش");
            $('.cancel').removeClass("cancel");
            $('#title').val('');
            $('#last_post').val('');
            $('#phone_number_ext').val('');
            $('#phone_number_code').val('');
            $('#cause_interruption').val('');
            $('#important_tasks').val('');
            $('#provinces').val('');
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
            $('#provinces').prop('disabled', false);
            $('#provinces').val('');
            $('#provinces').trigger("chosen:updated");
            $('#start_year').trigger("chosen:updated");
            $('#until_now').prop('checked', false);
            $('#save_job').removeAttr('job_id');
        }

        $('body').on('click', '.delete-item', function () {
            var id = $(this).attr('id');
            $.post(
                "{!! route('user.resume.job_exp.delete') !!}",
                {
                    _token: "{!! csrf_token() !!}",
                    id: id
                }
            ).done(function (data) {
                $('#row_' + id).remove();
            });
        });
         $('body').on('click', '.empty_form', function () {
                    $(this).closest('form').find("select, textarea").val("");
                    $('a.chosen-single').find('span').text('انتخاب کنید');
                    $("#until_now").prop("checked", false);
                    $("#title").val("");
                    $("#last_post").val("");
                    $("#phone_number_ext").val("");
                    $("#phone_number_code").val("");
                    $("#important_tasks").prop( "disabled", false );
                    $("#cause_interruption").prop( "disabled", false );

                    // $("#start_month option:selected").removeAttr('selected');

                });
            $('body').on('click', '.edit-item', function () {

            if ($(this).hasClass('cancel')) {
                cancel_edit();
                return;
            }

            // remove edit effects from another divs
            $('.blur').removeClass("blur");
            $('.cancel').removeClass("cancel");
            $('.edit-item').html("<i class=\"fa fa fa-pencil-square-o\" aria-hidden=\"true\"></i> ویرایش");
            $('#save_job').removeAttr('job_id');
            //add edit effects on
            $('.exp' + $(this).attr('id')).addClass("blur");
            $(this).html("<i class=\"fa fa-times\" aria-hidden=\"true\"></i> انصراف");
            $(this).addClass('cancel');
            $('#save_job').attr('job_id', $(this).attr('id').substr(1));

            $('#title').val($('#title' + $(this).attr('id')).html());
            $('#last_post').val($('#last_post' + $(this).attr('id')).html());
            $('#phone_number_ext').val($('#phone_number_ext' + $(this).attr('id')).html());
            $('#phone_number_code').val($('#phone_number_code' + $(this).attr('id')).html());
            $('#cause_interruption').val($('#cause_interruption' + $(this).attr('id')).val());
            $('#important_tasks').val($('#important_tasks' + $(this).attr('id')).val());
            $('#provinces').val($('#province_id' + $(this).attr('id')).val());
            $('#provinces').trigger("chosen:updated");

            $('#start_month').val($('#start_date' + $(this).attr('id')).val().substr(5, 2));
            $('#start_month').trigger("chosen:updated");

            $('#start_year').val($('#start_date' + $(this).attr('id')).val().substr(0, 4));
            $('#start_year').trigger("chosen:updated");

            if ($('#end_date' + $(this).attr('id')).val() == "") {
                $("#until_now").prop("checked", true);
                //disable chosens
                $('#end_month').val('');
                $('#end_year').val('');
                $('#cause_interruption').val('');
                $('#end_month').attr('disabled', 'disabled');
                $('#end_year').attr('disabled', 'disabled');
                $('#cause_interruption').attr('disabled', 'disabled');
                $('#end_month').trigger("chosen:updated");
                $('#end_year').trigger("chosen:updated");
            } else {
                //enable chosens
                $('#end_month').removeAttr('disabled');
                $('#end_year').removeAttr('disabled');
                $('#cause_interruption').removeAttr('disabled');
                $('#end_month').trigger("chosen:updated");
                $('#end_year').trigger("chosen:updated");

                //set chosen's data
                $("#until_now").prop("checked", false);
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
                $('#cause_interruption').val('');
                $('#end_month').attr('disabled', 'disabled');
                $('#end_year').attr('disabled', 'disabled');
                $('#cause_interruption').attr('disabled', 'disabled');
                $('#end_month').trigger("chosen:updated");
                $('#end_year').trigger("chosen:updated");
            } else {
                $('#end_month').removeAttr('disabled');
                $('#end_month').trigger("chosen:updated");
                $('#end_year').removeAttr('disabled');
                $('#end_year').trigger("chosen:updated");
                $('#cause_interruption').removeAttr('disabled');
            }
        });

        $('#save_job').on('click', function () {

            $('#no_work_experience').prop('checked', false);
            if (!validate_all()) {
                return;
            }
            var job_id = $(this).attr('job_id');
            var title = $('#title').val();
            var until_now = $('#until_now').val();
            var start_date = $('#start_year').val() + '/' + $('#start_month').val() + '/01';
            var end_date;
            if ($("#until_now").is(':checked')) {
                end_date = null;
            } else {
                end_date = $('#end_year').val() + '/' + $('#end_month').val() + '/01';
            }
            var last_post = $('#last_post').val();
            var cause_interruption;
            if ($("#until_now").is(':checked')) {
                cause_interruption = null;
            } else {
                cause_interruption = $('#cause_interruption').val();
            }
            var phone_number = ($('#phone_number_ext').val() == "" ? "" : $("#phone_number_code").val() + $('#phone_number_ext').val());
            var important_tasks = $("#important_tasks").val();
            var province_id = $("#provinces").val();
            if (job_id == null) {
                $.post(
                    "{!! route('user.resume.job_exp.create') !!}",
                    {
                        _token: "{!! csrf_token() !!}",
                        title: title,
                        start_date: start_date,
                        end_date: end_date,
                        until_now: until_now,
                        last_post: last_post,
                        cause_interruption: cause_interruption,
                        phone_number: phone_number,
                        important_tasks: important_tasks,
                        province_id: province_id,
                    }
                ).done(function (data) {
                        $(".prev-experiences,.add-experience").fadeIn("slow", function () {
                            // Animation complete.
                        });
                        if (data != 0) {
                            var duration;
                            if ($("#until_now").is(':checked'))
                                duration = $('#start_year').val() + ' - ' + 'تاکنون';
                            else
                                duration = $('#start_year').val() + ' - ' + $('#end_year').val();
                            if (end_date == null)
                                end_date = '';
                            $('#rows-div').prepend(
                                '<div id="row_' + data + '" class="row edu-result-row prev-experiences" style="display:block;">' +
                                '<div class="row col-12">' +
                                '<div class="col-md-3">' +
                                '<label class="">عنوان شغلی:</label>' +
                                '<label id="last_post_' + data + '" style="font-weight: bold;">' + last_post + '</label>' +
                                '</div>' +
                                '<div class="col-md-3">' +
                                '<label class="">نام سازمان:</label>' +
                                '<label id="title_' + data + '" class="" style="font-weight: bold;">' + title + '</label>' +
                                '</div>' +
                                '<div class="col-md-3">' +
                                '<label class="">مدت همکاری:</label>' +
                                '<label id="duration_' + data + '" class="" style="font-weight: bold;">' + duration + '</label>' +
                                '</div>' +
                                '<div class="col-md-3">' +
                                '<label class="">تلفن:</label>' +
                                '<label id="phone_number_ext_' + data + '" class="" style="font-weight: bold;direction: ltr">' + $('#phone_number_ext').val() + '</label>-<label id="phone_number_code_' + data + '" class="" style="font-weight: bold;direction: ltr">' + $('#phone_number_code').val() + '</label>' +
                                '</div>' +
                                '</div>' +
                                '<input id="start_date_' + data + '" value="' + start_date + '" type="hidden">' +
                                '<input id="end_date_' + data + '" value="' + end_date + '" type="hidden">' +
                                '<input id="cause_interruption_' + data + '" value="' + cause_interruption + '" type="hidden">' +
                                '<input id="important_tasks_' + data + '" value="' + important_tasks + '" type="hidden">' +
                                '<input id="province_id_' + data + '" value="' + province_id + '" type="hidden">' +
                                '<div class="col-xs-12 action-container">' +
                                '<div class="edu-result-row-btn text-right">' +
                                '<div id="_' + data + '" class="edit-item" style="display: inline-block;cursor: pointer">' +
                                '<img src="/site/default/Template_2019/img/edit_btn.svg"/> ویرایش' +
                                '</div>' +
                                '<div id="' + data + '" style="display: inline-block;cursor: pointer; margin-right: 10px;" class="delete-item exp_' + data + '">' +
                                '<img src="/site/default/Template_2019/img/remove_btn.svg"/> حذف' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
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


                });
            } else {
                $.post(
                    "{!! route('user.resume.job_exp.update') !!}",
                    {
                        _token: "{!! csrf_token() !!}",
                        job_id: job_id,
                        title: title,
                        start_date: start_date,
                        end_date: end_date,
                        last_post: last_post,
                        cause_interruption: cause_interruption,
                        phone_number: phone_number,
                        important_tasks: important_tasks,
                        province: province_id,
                    }
                ).done(function (data) {
                        if (data != 0) {
                            $('#last_post_' + job_id).html(last_post);
                            $('#title_' + job_id).html(title);
                            $('#phone_number_ext_' + job_id).html($('#phone_number_ext').val());
                            $('#phone_number_code_' + job_id).html($('#phone_number_code').val());
                            if ($("#until_now").is(':checked'))
                                $('#duration_' + job_id).html($('#start_year').val() + ' - ' + 'تاکنون');
                            else
                                $('#duration_' + job_id).html($('#start_year').val() + ' - ' + $('#end_year').val());

                            $('#start_date_' + job_id).val(start_date);
                            if (end_date == null)
                                $('#end_date_' + job_id).val('');
                            else
                                $('#end_date_' + job_id).val(end_date);

                            $('#cause_interruption_' + job_id).val(cause_interruption);
                            $('#important_tasks_' + job_id).val(important_tasks);

                            $('#provinces_' + job_id).val(province_id);

                            cancel_edit();
                        }
                    }
                );
            }
        });

        $(".close-success").click(function () {
            $(".bg-success").hide();
            return false;
        });


    </script>

@endsection