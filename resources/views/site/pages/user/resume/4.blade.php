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

        .textarea-rtl {
            text-align: right;
            direction: rtl;
            height: 200px;
        }
    </style>

@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: پروفایل
@endsection

@section('content')
    <div class="cd-main-content cd-inner-content">
        <div class="col-xs-12 wrapper-breadcrumb">
            <div class="p-breadcrumbs">
                <ul class="page-breadcrumbs">
                    <li>
                        <a href="{{url('home')}}">صفحه اصلی</a>
                    </li>
                    <li><i class="fa fa-angle-left"></i></li>
                    <li class="c-state_active">
                        حساب کاربری
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 top-innerpage"
             style="background:url('{{Auth::user()->cover}}') no-repeat top center/cover;">
            <div class="container"
            ><h1 class="wow animated fadeInUp" style="text-shadow: 0 0 8px #000000;">رزومه من </h1></div>
        </div>
        <div class="clearfix container inner-content">
            <div class="col-xs-12 wrap-content">

                @include('site.pages.user.side_bar')

                {{ Form::open(array('method'=>'PUT','route' => 'user.resume.4.store','files' => true,'onsubmit'=>'return check_employment()')) }}

                <div class="col-md-9 col-sm-12 col-xs-12 left-jobs no-padd-xs no-padd-l" id="scroll-resume">
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
                    <h3>رزومه من</h3>
                    <h4>ارائه اطلاعات تکمیلی </h4>
                    @include('site.modules.resumeCompleteLine')
                    <div class="col-md-12 no-padd no-padd-xs">
                        <div class="row">
                            <div class="col-xs-12 title-address"><h5> نام و مشخصات شغلی اعضای خانواده</h5></div>
                            <div class="col-xs-12">
                                <div class="wrapper-family-table">
                                    <table class="family-table">
                                        <tbody>
                                        <tr>
                                            <th>
                                                <button type="button" class="add-row-family" title="Add Row">+</button>
                                            </th>
                                            <th>نام و نام خانوادگی</th>
                                            <th>نسبت</th>
                                            <th class="job_col">شغل</th>
                                            <th class="organization_col">سازمان / صنف</th>
                                        </tr>
                                        @php
                                            $c=1;
                                            $edu=null;
                                        @endphp
                                        @if($resume->family->count()==0)
                                            <tr>
                                                <td>
                                                    <!--<button type="button" class="remove-row" title="Remove row">X</button>-->
                                                </td>
                                                <td>
                                                    <input type="text" value="" name="Family[{{$c}}][name]"
                                                           class="name form-control">
                                                </td>
                                                <td>
                                                    <div class="col-xs-12 no-padd no-padd-xs">

                                                        <select data-validation="required"
                                                                data-placeholder="یک گزینه انتخاب کنید"
                                                                name="Family[{{$c}}][relation]"
                                                                class="relation-select form-control">
                                                            <option value="">انتخاب کنید...</option>
                                                            <option value="1">پدر</option>
                                                            <option value="2">مادر</option>
                                                            <option value="3">خواهر</option>
                                                            <option value="4">برادر</option>
                                                            <option value="5">همسر</option>
                                                            <option value="6">فرزند</option>

                                                        </select>
                                                        <i class="fa fa-chevron-down tb-icon"></i>
                                                    </div>
                                                </td>
                                                <td class="job_col">
                                                    <input type="text" value="" id="job_{{$c}}"
                                                           name="Family[{{$c}}][job]" class="job form-control">
                                                    <input type="checkbox" id="unemployed_{{$c}}"
                                                           name="Family[{{$c}}][unemployed]" class="unemployed"> عدم
                                                    اشتغال
                                                </td>
                                                <td class="organization_col">
                                                    <input type="text" value="" id="organization_{{$c}}"
                                                           name="Family[{{$c}}][organization]"
                                                           class="organization  form-control">
                                                </td>
                                            </tr>
                                        @else
                                            @foreach($resume->family as $family)
                                                @php
                                                    $c++;
                                                @endphp
                                                <tr>
                                                    <td>
														<?php
														if($c > 2){
														?>
                                                        <button type="button" class="remove-row" title="Remove row">X
                                                        </button>
														<?php } ?>
                                                    </td>
                                                    <td>
                                                        <input data-validation="required" type="text"
                                                               value="{{$family->name}}" name="Family[{{$c}}][name]"
                                                               class="name form-control">
                                                    </td>
                                                    <td>
                                                        <div class="col-xs-12 no-padd no-padd-xs">

                                                            <select data-validation="required"
                                                                    data-placeholder="یک گزینه انتخاب کنید"
                                                                    name="Family[{{$c}}][relation]"
                                                                    class="relation-select form-control">
                                                                <option value=""{{($family->relation==0?' selected ':'')}}>
                                                                    یک گزینه را انتخاب کنید
                                                                </option>
                                                                <option value="1"{{($family->relation==1?' selected ':'')}}>
                                                                    پدر
                                                                </option>
                                                                <option value="2"{{($family->relation==2?' selected ':'')}}>
                                                                    مادر
                                                                </option>
                                                                <option value="3"{{($family->relation==3?' selected ':'')}}>
                                                                    خواهر
                                                                </option>
                                                                <option value="4"{{($family->relation==4?' selected ':'')}}>
                                                                    برادر
                                                                </option>
                                                                <option value="5"{{($family->relation==5?' selected ':'')}}>
                                                                    همسر
                                                                </option>
                                                                <option value="6"{{($family->relation==6?' selected ':'')}}>
                                                                    فرزند
                                                                </option>

                                                            </select>
                                                            <i class="fa fa-chevron-down tb-icon"></i>
                                                        </div>
                                                    </td>
                                                    <td class="job_col">
                                                        <input type="text"
                                                               {{($family->job==null?' disabled ':'')}} value="{{$family->job}}"
                                                               id="job_{{$c}}" name="Family[{{$c}}][job]"
                                                               class="job form-control">
                                                        <input type="checkbox"
                                                               {{($family->job==null?' checked ':'')}}  id="unemployed_{{$c}}"
                                                               onclick="unemployed({{$c}});"
                                                               name="Family[{{$c}}][unemployed]" class="unemployed"> عدم
                                                        اشتغال
                                                    </td>
                                                    <td class="organization_col">
                                                        <input type="text"
                                                               {{($family->job==null?' disabled ':'')}} value="{{$family->organization}}"
                                                               id="organization_{{$c}}"
                                                               name="Family[{{$c}}][organization]"
                                                               class="organization  form-control">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 no-padd no-padd-xs text-left">
                        <input type="submit" class="save" title="ذخیره و ادامه"
                               value="<?= (Auth::user()->complete_percent != 31) ? 'ذخیره و ادامه' : 'ذخیره' ?>">
                    </div>

                    {{Form::close()}}

                </div>
            </div>
        </div>
        <script>
            var job = null;
            var organization = null;

            function unemployed(id) {
                var chk = $('#unemployed_' + id).is(':checked');
                if (chk) {
                    job = $('#job_' + id).val();
                    organization = $('#organization_' + id).val();
                    $('#job_' + id).prop('disabled', true);
                    $('#organization_' + id).prop('disabled', true);
                    $('#job_' + id).val('');
                    $('#organization_' + id).val('');
                } else {
                    $('#job_' + id).val(job);
                    $('#organization_' + id).val(organization);
                    $('#job_' + id).prop('disabled', false);
                    $('#organization_' + id).prop('disabled', false);
                }
            }

            function check_employment() {
                for (var id = 1; id < 100; id++) {
                    if ($('#unemployed_' + id)) {
                        var chk = $('#unemployed_' + id).is(':checked');
                        var job = $('#job_' + id).val();
                        var organization = $('#organization_' + id).val();
                        if (!chk && job == "" && organization == "") {
                            alert('لطفا وضعیت اشتغال را مشخص فرمایید');
                            return false;
                        }
                    }
                }
            }
        </script>
        @endsection

        @section('script')

            {{ Html::script('/site/'.config('app.site_theme').'/js/chosen.jquery.js') }}


            <script type="text/javascript">
                if ($(window).width() < 992) {
                    $(document).ready(function () {
                        // Handler for .ready() called.
                        $('html, body').animate({
                            scrollTop: $('#scroll-resume').offset().top - 20
                        }, 'slow');
                    });
                }
                var Family_rowCounter = 100;
                $(document).ready(function () {
                    $(".close-error").click(function () {
                        $(".bg-error").hide();
                        return false;
                    });

                });

                /*
                $(document).on('click', '.unemployed', function() {
                    var field_id=$(this).attr('field_id');
                    if($(this).is(':checked')){
                        $('#job_'+field_id+',#organization_'+field_id).hide();
                    }else{
                        $('#job_'+field_id+',#organization_'+field_id).show();
                    }
                });
                */


                var f_counter ={{$c+1}};
                $(".add-row-family").click(function () {
                    f_counter++;
                    Family_rowCounter++;
                    var tmp = '<tr><td><button type="button" class="remove-row" title="Remove row">X</button></td><td><input data-validation="" type="text" name="Family[' + Family_rowCounter + '][name]" class="name form-control"></td><td><div class="col-xs-12 no-padd no-padd-xs"><select data-validation="required" data-placeholder="یک گزینه انتخاب کنید" name="Family[' + Family_rowCounter + '][relation]" class="relation-select form-control" ><option value="">یک گزینه را انتخاب کنید</option><option value="1">پدر</option><option value="2">مادر</option><option value="3">خواهر</option><option value="4">برادر</option><option value="5">همسر</option><option value="6">فرزند</option></select><i class="fa fa-chevron-down tb-icon"></i></div></td><td><input type="text" id="job_' + f_counter + '" name="Family[' + Family_rowCounter + '][job]" class="job form-control">&nbsp;<input type="checkbox" id="unemployed_' + f_counter + '" onclick="unemployed(f_counter);" name="Family[' + Family_rowCounter + '][unemployed]" class="unemployed"> عدم اشتغال</td><td><input type="text" id="organization_' + f_counter + '" name="Family[' + Family_rowCounter + '][organization]" class="organization form-control"></td></tr>';
                    $("table.family-table tbody").append(tmp);
                    $.validate({
                        modules: 'date',
                        lang: 'fa'
                    });
                });


                $(document).on('click', 'button.remove-row', function () {
                    $(this).closest('tr').remove();
                    return false;
                });


                $('.mahkomiat').bind('change', function (e) {
                    if ($('.sabghemahkomiat-select').val() == 'Yes') {
                        $('.elatmahkomiat').show();
                    } else if ($('.sabghemahkomiat-select').val()) {
                        $('.elatmahkomiat').hide();
                    }
                });


                $('.jarahi').bind('change', function (e) {
                    if ($('.sabghejarahi-select').val() == 'Yes') {
                        $('.namebimary').show();
                        $('.behbodjarahi-select').show();
                    } else if ($('.sabghejarahi-select').val()) {
                        $('.namebimary').hide();
                        $('.behbodjarahi-select').hide();
                    }
                });


                $('.mishnasid').bind('change', function (e) {
                    if ($('.kasiramishnasid-select').val() == 'Yes') {
                        $('.karkonantarigheash').show();
                    } else if ($('.kasiramishnasid-select').val()) {
                        $('.karkonantarigheash').hide();
                    }
                });

                $("input[checker=fawoa]").bind('input propertychange', function () {
                    if (!/^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FF\s]+$/.test($(this).val())) {
                        $(this).val("");
                    }
                });

                $("input[checker=favad]").bind('input propertychange', function () {
                    if (!/^[\u0600-\u06FF\0-9\s]+$/.test($(this).val())) {
                        $(this).val("");
                    }
                });

                $("input[checker=addrial]").on('click', function () {
                    $('.rialnamad').hide();
                });

                $("input[checker=addrial]").on('blur', function () {
                    $('.rialnamad').show();
                });

                $('input[checker=addrial]').number(true);


                $(document).on('click', 'button.remove-row', function () {
                    $(this).closest('tr').remove();
                    return false;
                });


                $(".elatmahkomiat").attr("style", "display:none");
                $(".namebimary").attr("style", "display:none");
                $(".behbodjarahi-select").attr("style", "display:none");
                $(".karkonantarigheash").attr("style", "display:none");
                $(".rialnamad").attr("style", "display:none");


            </script>

@endsection