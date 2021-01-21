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
    td, th {
        border: 1px solid #dddddd !important;
        text-align: center !important;
        padding: 8px !important;
    }
    .bs-wizard{display: none;}
</style>

@endsection

@section('title')
سامانه منابع انسانی :: پروفایل
@endsection

@section('content')

@include('site.pages.user.side_bar')
{{ Form::open(array('method'=>'PUT','route' => 'user.resume.1.store','files' => true)) }}
<div id="scroll-resume" class="container">
    @include('site.modules.resumeCompleteLine')
    <div class="form-horizontal">
        @if (count($errors) > 0)
        <div class="bg-error" style="text-align: right">
            <a href="" class="close-error"><i class="fa fa-remove"></i></a>
            @foreach ($errors->all() as $error)
            <p style="direction: rtl" >{{ $error }}</p>
            @endforeach
        </div>
        @endif
        @if(Session::has('flash_message'))
        <div class="bg-success" style="text-align: right">
            <a href="" class="close-success"><i class="fa fa-remove"></i></a>
            <p style="direction: rtl" >{!! session('flash_message') !!}</p>
        </div>
        @endif
    </div>
    <fieldset class="red-fieldset mt-7">
        <div class="float-left font-13 red-fieldset-left dir-ltr"><img class="mr-2" src="/site/default/Template_2019/img/exclamation-mark.svg"/><span>پر کردن آیتم های</span><img class="m-2" src="/site/default/Template_2019/img/Group 166.svg" /><span> اجباری است</span></div>
        <legend>مشخصات شغلی</legend>
    </fieldset>
    <div class="people-forms row">
        <div class="col-md-4">
            <div class="people-forms-fields-group">
                <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                <select data-validation="required" name="province_id" id="provinces" data-placeholder="یک گزینه انتخاب کنید"  class="ostan-select form-control people-forms-fields po-input-select" required>
                    @foreach($provinces as $province)
                    <option value="{{(isset($province->id)?$province->id:'')}}" {{(isset($province->id) && isset($resume->province) && $province->id==$resume->province->id?' selected ':'')}}>{{(isset($province->name)?$province->name:'')}}</option>
                    @endforeach
                </select>
                <label>متقاضی کار در استان</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="people-forms-fields-group">
                <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                <select data-validation="required" name="requested_salary" id="requested_salary" class="form-control po-input-select people-forms-fields"  required>
                    <option {{(($resume->questions != null) && ($resume->questions->requested_salary=="" || $resume->questions->requested_salary==null)?' selected ':'')}} value="">حتما انتخاب کنید</option>
                    @foreach(config('app.salery_range') as $key=>$value)
                    <option {{(($resume->questions != null) && $resume->questions->requested_salary==$key?' selected ':'')}} value="{{$key}}">
                        {{$value}}
                    </option>
                    @endforeach
                </select>
                <label>حقوق درخواستی</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="people-forms-fields-group">
                <input type="checkbox" {{($resume->novice =="1"?' checked ':'')}} id="novice" value="1"
                       name="novice">
                <label for="novice">علاقه مند به کارآموزی </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="people-forms-fields-group">
                <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                <select data-validation="required" name="contract_type[]" data-placeholder="یک گزینه انتخاب کنید"  class="noegharardad-select form-control po-input-select has-value" multiple >
                    @php
                    $ar= \HR\ResumeContractType::all()->pluck('name','id')->toArray();
                    @endphp
                    @for($i=1;$i<(count($ar)+1);$i++)
                    <option value="{{$i}}" {{(isset($resume->contractTypes) && in_array($i,$resume->contractTypes->pluck('id')->toArray())?'selected':'')}}>{{$ar[$i]}}</option>
                    @endfor
                </select>
                <label class="chosen-choices-lable">نوع همکاری</label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="people-forms-fields-group">
                <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                <select data-validation="required" name="department_id[]" data-placeholder="یک گزینه انتخاب کنید"  class="zaminetakhasosi-select form-control po-input-select has-value" multiple>
                    @foreach($departments as $department)
                    <option value="{{$department->id}}" {{(isset($department->id) && isset($resume->departments) && in_array($department->id,$resume->departments->pluck('id')->toArray())?'selected':'')}}>{{(isset($department->name) && $department->name?$department->name:'')}}</option>
                    @endforeach
                </select>
                <label class="chosen-choices-lable"> حوزه کاری مورد علاقه </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="people-forms-fields-group">
                <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                <select data-validation="required" name="industry_id[]" data-placeholder="یک گزینه انتخاب کنید"  class="zaminesanat-select form-control po-input-select has-value" multiple >
                    @foreach($industries as $industry)
                    <option value="{{$industry->id}}" {{(isset($industry->id) && isset($resume->industries) && in_array($industry->id,$resume->industries->pluck('id')->toArray())?'selected':'')}}>{{$industry->name}}</option>
                    @endforeach

                </select>
                <label class="chosen-choices-lable">صنعت مورد علاقه</label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="people-forms-fields-group">
                <p class="text-right font-13 m-0 ">طریقه آشنایی با شرکت</p>
                <select data-validation="required" name="our" id="our" data-placeholder="یک گزینه انتخاب کنید"  class="tarigheashnaii-select form-control po-input-select people-forms-fields">
                    <option value="1" {{(isset($resume->referer) && $resume->referer=='1'?'selected':'')}}>آگهي روزنامه</option>
                    <option value="10" {{(isset($resume->referer) && $resume->referer=='10'?'selected':'')}}>ایران تلنت</option>
                    <option value="9" {{(isset($resume->referer) && $resume->referer=='9'?'selected':'')}}>لینکداین</option>
                    <option value="2" {{(isset($resume->referer) && $resume->referer=='2'?'selected':'')}}>تماس اولیه از طرف گلرنگ </option>
                    <option value="3" {{(isset($resume->referer) && $resume->referer=='3'?'selected':'')}}>وب سایت</option>
                    <option value="4" {{(isset($resume->referer) && $resume->referer=='4'?'selected':'')}}>معرفي آشنايان و دوستان</option>
                    <option value="5" {{(isset($resume->referer) && $resume->referer=='5'?'selected':'')}}>مراکز کاريابي</option>
                    <option value="8" {{(isset($resume->referer) && $resume->referer=='8'?'selected':'')}}>نمایشگاه کار</option>
                    <option value="6" {{(isset($resume->referer) && $resume->referer=='6'?'selected':'')}}>معرفی کارکنان گلرنگ</option>
                    <option value="7" {{(isset($resume->referer) && $resume->referer=='7'?'selected':'')}}>سایر:</option>
                </select>
            </div>
        </div>
        <input name="our_others_text" type="text" data-validation="required" value="@php
        if(!is_null($resume) && isset($resume->referer) && $resume->site->count()){
            if($resume->referer!=3){
                echo $resume->other;
            }else{
                echo $resume->site->first()->url;
            }
        }
        @endphp" class="sayertarigheash form-control people-forms-fields" style="display:none;"/>
        <div class="wrapper-learn-table karkonantarigheash row col-12"  style="display:none;">
                <div class="col-md-3">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                        <input type="text" value="{{isset($resume->introducer) && $resume->introducer->name?$resume->introducer->name:''}}" name="moaref_fullname" id="moaref_fullname" class="namenamefam font-13 people-forms-fields form-control">
                        <label>نام و نام خانوادگی</label>
                    </div>
                </div>            
                <div class="col-md-3">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                        <input type="text" value="{{isset($resume->introducer) && $resume->introducer->company_name?$resume->introducer->company_name:''}}" name="moaref_compnay" id="moaref_compnay" class="namesherkat font-13 people-forms-fields form-control">
                        <label>نام شرکت فعلی</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                        <input type="text" value="{{isset($resume->introducer) && $resume->introducer->relevance?$resume->introducer->relevance:''}}"  name="moaref_nesbat" id="moaref_nesbat" class="nesbat font-13 people-forms-fields form-control">
                        <label>نسبت</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="people-forms-fields-group">
                        <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                        <input type="text" value="{{isset($resume->introducer) && $resume->introducer->post?$resume->introducer->post:''}}" name="moaref_post" id="moaref_post" class="semat font-13 people-forms-fields form-control">
                        <label>سمت</label>
                    </div>
                </div>                

        </div>
        <fieldset class="mt-5 w-100">
            <legend class="text-left">
                <input type="submit" class="save send-btn-green" title="ذخیره و ادامه" value="ذخیره و ادامه"  >
            </legend>
        </fieldset>
        
        {{Form::close()}}
    </div>
</div>
@endsection
@section('script')
{{ Html::script('/site/'.config('app.site_theme').'/js/bootstrap-datepicker.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/bootstrap-datepicker.fa.js') }}
{{ Html::script('/site/'.config('app.site_theme').'/js/chosen.jquery.js') }}
<script>

    $(document).ready(function(){
        $(".close-error").click(function(){
            $(".bg-error").hide();
            return false;
        });


    });




    //$(document).ready(function() {
    /////////////// chosen
    $(".zaminetakhasosi-select").chosen({
        max_selected_options: 3,
        placeholder_text_multiple: 'انتخاب',
        placeholder_text_single: 'انتخاب',
        rtl: true
    });

    var last_valid_selection = null;
    $(".zaminetakhasosi-select").change(function(event, params) {
        if ($(this).val().length > 3) {
            $(this).val(last_valid_selection);
        } else {
            last_valid_selection = $(this).val();
        }
    });

    $(".zaminesanat-select").chosen({
        max_selected_options: 3,
        rtl: true
    });

    $(".zaminesanat-select").change(function(event) {
        if ($(this).val().length > 3) {
            $(this).val(last_valid_selection);
        } else {
            last_valid_selection = $(this).val();
        }
    });

    $(".noegharardad-select").chosen({
        max_selected_options: 3,
        rtl: true
    });

    $(".noegharardad-select").change(function(event) {
        if ($(this).val().length > 3) {
            $(this).val(last_valid_selection);
        } else {
            last_valid_selection = $(this).val();
        }
    });

    /////////////// hide and show

    $('.tarigheashnaii-select').bind('change', function(e) {
        if ($('.tarigheashnaii-select').val() == 7) {
            $('.sayertarigheash').show();
            $('.karkonantarigheash').hide();
            $('.sayertarigheash').attr('placeholder','');
            $('.sayertarigheash').attr('style','text-align:right;direction:rtl;');
            $('.sayertarigheash').attr('data-validation','required');
            $('.sayertarigheash').attr('value','{{$resume->other}}');

            $('#moaref_fullname').attr('data-validation','');
            $('#moaref_compnay').attr('data-validation','');
            $('#moaref_nesbat').attr('data-validation','');
            $('#moaref_post').attr('data-validation','');


        }
        if ($('.tarigheashnaii-select').val() == 6) {
            $('.sayertarigheash').hide();
            $('.karkonantarigheash').show();

            $('#moaref_fullname').attr('data-validation','required');
            $('#moaref_compnay').attr('data-validation','required');
            $('#moaref_nesbat').attr('data-validation','required');
            $('#moaref_post').attr('data-validation','required');
        }

        if ($('.tarigheashnaii-select').val() == 5) {
            $('.sayertarigheash').hide();
            $('.karkonantarigheash').hide();

            $('#moaref_fullname').attr('data-validation','');
            $('#moaref_compnay').attr('data-validation','');
            $('#moaref_nesbat').attr('data-validation','');
            $('#moaref_post').attr('data-validation','');
        }
        if ($('.tarigheashnaii-select').val() == 2) {
            $('.sayertarigheash').hide();
            $('.karkonantarigheash').hide();

            $('#moaref_fullname').attr('data-validation','');
            $('#moaref_compnay').attr('data-validation','');
            $('#moaref_nesbat').attr('data-validation','');
            $('#moaref_post').attr('data-validation','');
        }

        if ($('.tarigheashnaii-select').val() == 4) {
            $('.sayertarigheash').hide();
            $('.karkonantarigheash').show();

            $('#moaref_fullname').attr('data-validation','required');
            $('#moaref_compnay').attr('data-validation','required');
            $('#moaref_nesbat').attr('data-validation','required');
            $('#moaref_post').attr('data-validation','required');
        }

        if ($('.tarigheashnaii-select').val() == 1 || $('.tarigheashnaii-select').val() == 8 || $('.tarigheashnaii-select').val() == 9) {
            $('.sayertarigheash').hide();
            $('.karkonantarigheash').hide();

            $('#moaref_fullname').attr('data-validation','');
            $('#moaref_compnay').attr('data-validation','');
            $('#moaref_nesbat').attr('data-validation','');
            $('#moaref_post').attr('data-validation','');

        }

        if ($('.tarigheashnaii-select').val() == 3) {
            $('.sayertarigheash').attr('placeholder','sample.com');//,'style':'text-align:left;direction:ltr;']);
            $('.sayertarigheash').attr('data-validation','required');
            $('.sayertarigheash').attr('style','text-align:left;direction:ltr;');
            //$resume->site->first()->url
            $('.sayertarigheash').attr('value','@if($resume->site) {{$resume->site->first()->url}} @endif');

            $('.sayertarigheash').show();
            $('.karkonantarigheash').hide();

            $('#moaref_fullname').attr('data-validation','');
            $('#moaref_compnay').attr('data-validation','');
            $('#moaref_nesbat').attr('data-validation','');
            $('#moaref_post').attr('data-validation','');
        }
    }).trigger('change');

    //});
    if ($(window).width() < 992) {
        $(document).ready(function () {
            // Handler for .ready() called.
            $('html, body').animate({
                scrollTop: $('#scroll-resume').offset().top -20
            }, 'slow');
        });
    }
</script>
@endsection

