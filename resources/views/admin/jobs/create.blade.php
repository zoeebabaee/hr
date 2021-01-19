{{--@php--}}
{{--dd(old())--}}
{{--@endphp--}}

@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    ایجاد شغل جدید
@endsection

@section('header_styles')
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.bootstrap.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.responsive.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.tableTools.min.css') }}
    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}

    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/persian-datepicker/persian-datepicker.min.css') }}

    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/chosen/chosen.css') }}

    <style>
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        table, th, td {

            border: 1px solid #cdcdcd;
        }

        table th, table td {
            padding: 5px;
            text-align: left;
        }

        .active_company_field {
            display: none;
        }

        .chosen-container-single .chosen-single {
            border-radius: 0px !important;
            background: none !important;
            box-shadow: none !important;
            min-height: 34px !important;
            border: 1px solid #e5e6e7 !important;
            line-height: 2.5!important;
        }
    </style>



@endsection

@section('content')
    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>شغل ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/adpanel">
                        خانه</a>
                </li>
                <li class="active">
                    <a><strong>افزودن شغل جدید</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            {{ Form::open(array('route' => 'jobs.store')) }}
            <div class="col-lg-12">
                <h1><i class='fa fa-key'></i> افزودن شغل</h1>
                <hr>


                <div class="form-group">
                    {{ Form::submit('ذخیره', array('class' => 'btn btn-primary')) }}
                    {{ Form::button('انصراف', array('class' => 'btn btn-warning','onclick'=>'history.back()')) }}
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-6">
                    <div class="form-group">
                        {{ Form::label('status', 'وضعیت') }} <span style="color: red;">*</span>
                        {{ Form::select('status', [1=>'منتشر شده',2=>'منتشر نشده',3=>'آرشیو شده'],old('status'), array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>
                            انتخاب شرکت
                        </label> <span style="color: red;">*</span>
                        <div>
                            <select name="company" data-placeholder="انتخاب شرکت ..." id="api_company"
                                    class="chosen-select chosen-rtl form-control"
                                    tabindex="2"  onchange="getOrganization()"  style="border-radius: 0px !important; background: none !important">
                                <option>انتخاب شرکت</option>

                                @foreach($companies as $dep)
                                    <option data-flag="{{$dep->flag}}"
                                            {{( !is_null(old('company')) && $dep->id == old('company')?' selected ':'')}} value="{{$dep->id}}">{{$dep->name}}</option>
                                @endforeach
                            </select>
                            {{--
                                                        {{csrf_field()}}
                            --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">

                <div class="col-lg-6">
                    <div class="form-group inactive_company_field">
                        <label>
                            حوزه کاری </label> <span style="color: red;">*</span>
                        <div>
                            <select name="department" data-placeholder="انتخاب حوضه کاری..."
                                    class="form-control" tabindex="2">

                                @foreach($departments as $dep)
                                    <option {{( !is_null(old('department')) && old('department') == $dep->id ?' selected ':'')}} value="{{$dep->id}}">{{$dep->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group active_company_field">
                        <label>
                            حوزه کاری </label> <span style="color: red;">*</span>
                        <div>
                            <select name="api_department" data-placeholder="انتخاب حوضه کاری..."
                                    id="api_organization_id"
                                    class="form-control active_company_field" tabindex="2" onchange="getOrganizationPost()">

                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">

                    <div class="form-group inactive_company_field">
                        {{ Form::label('post', 'عنوان شغل(پست)') }} <span style="color: red;">*</span>
                        {{ Form::text('post', old('post'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group active_company_field">
                        <label>
                            پست ها</label> <span style="color: red;">*</span>
                        <div>
                            <select name="api_post" data-placeholder="انتخاب پست..." id="api_post_id"
                                    onchange="loadActiveCompanyMerit()"
                                    class="form-control active_company_field" tabindex="2">


                            </select>
                        </div>
                    </div>
                </div>
            </div>


            {{--<div class="col-lg-6">
                <div class="form-group">
                    {{ Form::label('post', 'عنوان شغل(پست)') }} <span style="color: red;">*</span>
                    {{ Form::text('post', old('post'), array('class' => 'form-control','id'=>'post')) }}
                </div>
            </div>--}}
            <div class="form-group col-lg-12">
                <div class="form-group col-lg-12">
                    {{ Form::label('alias', ' نام مستعار لاتین(فقط از حروف انگلیسی و - استفاده کنید)')}} <span
                            style="color: red;">*</span>
                    {{ Form::text('alias', old('alias'), array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="form-group col-lg-12">
                @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <div class="col-lg-4">
                        <div class="form-group" id="data_5">
                            <label class="font-noraml">
                                تاریخ انقضای آگهی</label> <span style="color: red;">*</span>
                            <div class="input-group date">
                                <input
                                        type="text"
                                        class="form-control ltr-input"
                                        name="expire_date"
                                        value="{{ Carbon::now()->timezone('Asia/Tehran')->addDay(30)->format('Y-m-d') }}"
                                >
                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar">
                                                    </i>
                            </span>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-lg-4">
                    <div class="form-group">
                        {{ Form::label('gender', 'جنسیت') }} <span style="color: red;">*</span>
                        {{ Form::select('gender', [1=>'مرد',2=>'زن',3=>'هر دو'],old('gender'), array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        {{ Form::label('min_education', 'حداقل مدرک تحصیلی') }} <span style="color: red;">*</span>
                        {{ Form::select('min_education', $Degrees,old('min_education'), array('class' => 'form-control')) }}
                    </div>
                </div>
            </div>

            {{-- City --}}
            <div class="col-lg-12">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="cities">شهر</label> <span style="color: red;">*</span>
                        <div class="clearfix"></div>
                        <button type="button" class="btn chosen-toggle select">انتخاب همه</button>
                        <button type="button" class="btn chosen-toggle deselect">لغو انتخاب</button>
                        <select name="city_id[]" id="cities" class="form-control" multiple>
                            @foreach($cities as $city)
                                <option {{( !is_null(old('city_id')) && is_array(old('city_id')) && in_array($city->id , old('city_id'))?' selected ':'')}} value="{{$city->id}}">{{$city->province->name.' - '. $city->name}}</option>
                            @endforeach
                        </select>

                        <button type="button" class="btn chosen-toggle select">انتخاب همه</button>
                        <button type="button" class="btn chosen-toggle deselect">لغو انتخاب</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-3">
                    <div class="form-group">
                        {{ Form::label('apply_limit','تعداد افراد مورد نیاز')}}
                        {{ Form::text('apply_limit', old('apply_limit'), array('class' => 'form-control')) }}
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        {{ Form::label('pin_status', 'پین شود') }} <span style="color: red;">*</span>
                        {{ Form::select('pin_status', [0=>'خیر',1=>'بله'],old('pin_status'), array('class' => 'form-control')) }}
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group"><span style="color: red;">*</span>
                        {{ Form::label('industry_id', 'صنعت') }}
                        {{ Form::select('industry_id', $industries->pluck('name','id')->toArray(),old('industry_id'), array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group"><span style="color: red;">*</span>
                        {{ Form::label('cooperation_type', 'نوع همکاری') }}
                        {{ Form::select('cooperation_type', HR\ResumeContractType::all()->pluck('name','id')->toArray(),old('cooperation_type'),array('class' => 'form-control')) }}
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-6">
                    <div class="form-group">
                        {{ Form::label('jobExp','سابقه کار')}}
                        {{ Form::select('jobExp',config('app.enum_exp_needed') ,old('jobExp'), array('class' => 'form-control')) }}
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group inactive_company_field">
                        {{ Form::label('field','رشته تحصیلی')}}
                        {{ Form::text('field', old('field'), array('class' => 'form-control')) }}
                    </div>
                </div>
            </div>

            <div class="col-lg-12">

                <div class="col-lg-6">
                    <div class="form-group active_company_field">
                        <label>
                            نوع رشته تحصیلی</label> <span style="color: red;">*</span>
                        <div>
                            <select name="field_type" data-placeholder="انتخاب نوع رشته..." id="api_fieldtype_id"
                                    onchange="getField()"
                                    class="form-control" tabindex="2">
                                <option>انتخاب نوع رشته</option>
                                @foreach($field_type_array as $field_type)
                                    <option {{( !is_null(old('field_type')) && old('field_type') == $field_type->id ?' selected ':'')}} value="{{$field_type->id}}">{{$field_type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group active_company_field">
                        <label>
                            رشته تحصیلی </label> <span style="color: red;">*</span>
                        <div>
                            <select name="api_field" data-placeholder="انتخاب رشته تحصیلی..." id="api_field_id"
                                    class="form-control" tabindex="2">


                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{--
                <div class="col-lg-12">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>
                                حوزه کاری </label> <span style="color: red;">*</span>
                            <div>
                                <select name="department" data-placeholder="انتخاب حوضه کاری..."
                                        class="chosen-select chosen-rtl form-control" tabindex="2">

                                    @foreach($departments as $dep)
                                        <option {{( !is_null(old('department')) && old('department') == $dep->id ?' selected ':'')}} value="{{$dep->id}}">{{$dep->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>
                                انتخاب شرکت
                            </label> <span style="color: red;">*</span>
                            <div>
                                <select name="company" data-placeholder="انتخاب شرکت ..."
                                        class="chosen-select chosen-rtl form-control"
                                        tabindex="2">

                                    @foreach(\HR\Company::myCompanies() as $dep)
                                        <option {{( !is_null(old('company')) && $dep->id == old('company')?' selected ':'')}} value="{{$dep->id}}">{{$dep->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            --}}
            <div class="col-lg-12" style="margin-bottom: 30px">
                <label class="font-normal">
                    شایستگی های عمومی
                </label> <span style="color: red;">*</span>
                <div class="clearfix"></div>

                <div class="col-lg-4">
                    <div class="form-group">
                        {{--
                        M.M.Kia
                        98/01/26
                        Make dropdown list for skill
                        --}}

                        <select name="skill" id="skill" data-placeholder="انتخاب کنید:"
                                class="chosen-select chosen-rtl form-control" style="max-width:auto;" tabindex="2">
                              @foreach($job_general_merites as $generalMeritesListItem)
                                  <option value="{{$generalMeritesListItem->name}}">{{$generalMeritesListItem->name}}</option>
                              @endforeach

                        </select>
                        {{--
                        {{ Form::text('skill', old('skill'), array('class' => 'form-control rtl-input','id'=>'skill')) }}
                        --}}
                    </div>
                </div>

                <div class="col-lg-6">
                    {{ Form::select('skill_value', config('app.enum_shayestegi'),NULL, array('class' => 'form-control','id'=>'skill_value')) }}
                </div>

                <div class="col-lg-2">
                    <input type="button" class="btn btn-success btn-sx" value="افزودن شایستگی"
                           onclick="add_skill_1()">
                </div>

                <div class="col-lg-12">
                    <div class="clearfix"></div>
                    <table id="skill_table">
                        <thead>
                        <tr>
                            <th>انتخاب</th>
                            <th>شایستگی</th>
                            <th>میزان مهارت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!is_null(old('skill_1')) && is_array(old('skill_1')) && count(old('skill_1')))
                            @for($i = 1; $i <= count(old('skill_1')); $i++)
                                <tr>
                                    <td>
                                        <input type='checkbox' name='record'>
                                    </td>
                                    <td>
                                        <input style='border: 0' class='form-control input-sm '
                                               value='{{old('skill_1')[$i]['name']}}' type='text'
                                               name='skill_1[{{$i}}][name]'>
                                       <input style='border: 0' class='form-control input-sm '
                                       value='{{old('skill_1')[$i]['name']}}' type='hidden'
                                       name='master_data_id[{{$i}}][name]'>
                                    </td>
                                    <td>
                                        <select id='skill_value_1_{{$i}}' class='form-control input-sm'
                                                style='border: 0'
                                                name='skill_1[{{$i}}][value]'>

                                            <option value='3' @if(old('skill_1')[$i]['value'] <= 3) selected @endif >
                                                مزیت
                                                محسوب می شود
                                            </option>
                                            <option value='4' @if(old('skill_1')[$i]['value'] == 4) selected @endif >
                                                الزامی است
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                            @endfor
                        @endif
                        </tbody>
                    </table>
                    <button type="button" style="margin-bottom: 5px;" id="del_skill_1" class=" btn btn-danger btn-sx">
                        حذف
                        شایستگی های انتخاب شده
                    </button>
                </div>
            </div>

            <div class="col-lg-12" style="margin-bottom: 30px">
                <hr>
                <label class="font-normal">
                    شایستگی های تخصصی
                </label> <span style="color: red;">*</span>
                <div class="clearfix"></div>
                <div class="col-lg-4">
                    <div class="form-group" id="pr_merit">
                        {{--
                        M.M.Kia
                        98/01/26
                        Make dropdown list for skill

                        <select name="skill2" id="skill2" data-placeholder="انتخاب کنید:"
                                class="chosen-select chosen-rtl form-control" style="width:auto;" tabindex="2">
                            <option value="">انتخاب کنید:</option>
                            @foreach($job_professional_merites as $professionalMeritesListItem)
                                <option value="{{$professionalMeritesListItem->name}}">{{$professionalMeritesListItem->name}}</option>
                            @endforeach

                        </select>
                        --}}
                        {{ Form::text('skill2', old('skill2'), array('class' => 'form-control rtl-input','id'=>'skill2')) }}

                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="col-lg-6">
                    {{ Form::select('skill_value2', config('app.enum_shayestegi'),NULL, array('class' => 'form-control','id'=>'skill_value2')) }}
                </div>

                <div class="col-lg-2">
                    <input type="button" class="btn btn-success btn-sx" value="افزودن شایستگی"
                           onclick="add_skill_2()">
                </div>

                <div class="col-lg-12">
                    <div class="clearfix"></div>
                    <table id="skill_table2">
                        <thead>
                        <tr>
                            <th>انتخاب</th>
                            <th>شایستگی</th>
                            <th>میزان مهارت</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(!is_null(old(skill_2)) && is_array(old(skill_2)) && count(old(skill_2)))
                            @for($i = 1; $i <= count(old(skill_2)); $i++)
                                <tr>
                                    <td>
                                        <input type='checkbox' name='record'>
                                    </td>
                                    <td>
                                        <input style='border: 0' class='form-control input-sm '
                                               value='{{old(skill_2)[$i]['name']}}' type='text'
                                               name='skill_2[{{$i}}][name]'>
                                        <input style='border: 0' class='form-control input-sm '
                                               value='{{old(skill_2)[$i]['name']}}' type='hidden'
                                               name='master_data_id_pro[{{$i}}][name]'>
                                               
                                    </td>
                                    <td>
                                        <select id='skill_value_2_{{$i}}' class='form-control input-sm'
                                                style='border: 0'
                                                name='skill_2[{{$i}}][value]'>

                                            <option value='3' @if(old(skill_2)[$i]['value'] <= 3) selected @endif >مزیت
                                                محسوب می شود
                                            </option>
                                            <option value='4' @if(old(skill_2)[$i]['value'] == 4) selected @endif >
                                                الزامی است
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                            @endfor
                        @endif
                        </tbody>
                    </table>
                    <button type="button" style="margin-bottom: 5px;" id="del_skill_2" class=" btn btn-danger btn-sx">
                        حذف
                        شایستگی های انتخاب شده
                    </button>
                </div>
            </div>
            <div class="col-lg-12">
                <div style="margin-bottom: 30px;border-bottom: 1px #eee solid;" class="col-lg-12">
                    <label class="font-normal">
                        سوالات شما از درخواست کننده
                    </label>
                    <div class="clearfix"></div>

                    <div class="col-lg-8">
                        <div class="form-group">
                            {{ Form::text('question', old('question'), array('class' => 'form-control rtl-input','id'=>'question')) }}
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <input type="button" class="btn btn-success btn-sx" value="افزودن سوال"
                               onclick="add_question()">
                    </div>

                    <div class="clearfix"></div>
                    <table id="questions_table">
                        <thead>
                        <tr>
                            <th style="width: 80px; text-align: center">انتخاب</th>
                            <th style=" text-align: center">سوال</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!is_null(old('questions')) && is_array(old('questions')) && count(old('questions')))
                            @for($i = 1; $i <= count(old('questions')); $i++)
                                <tr>
                                    <td>
                                        <input type='checkbox' name='record'>
                                    </td>
                                    <td>
                                        <input style='border: 0' class='form-control input-sm '
                                               value='{{old('questions')[$i]['question']}}' type='text'
                                               name='questions[{{$i}}][question]'>
                                    </td>
                                </tr>
                            @endfor
                        @endif
                        </tbody>
                    </table>
                    <button type="button" style="margin-bottom: 5px;" id="del_questions" class=" btn btn-danger btn-sx">حذف
                        سوالات انتخاب شده
                    </button>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        {{ Form::label('goal_or_mission', 'اهداف و ماموریت ها')}} <span style="color: red;">*</span>
                        {{ Form::textarea('goal_or_mission', old('goal_or_mission'), array('class' => 'form-control')) }}
                    </div>


                    <div class="form-group">
                        {{ Form::label('main_responsibilities', 'مسئولیت های اصلی')}} <span style="color: red;">*</span>
                        {{ Form::textarea('main_responsibilities', old('main_responsibilities'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('other_features', 'سایر ویژگی ها')}}
                        {{ Form::textarea('other_features', old('other_features'), array('class' => 'form-control')) }}
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-lg-6">

                        <div class="input-group rtl-input input-sx">
                                      <span class="input-group-btn">
                                        <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                          <i class="fa fa-picture-o"></i>انتخاب عکس
                                        </a>
                                      </span>
                            <input id="thumbnail1" class="form-control input-sm" type="text" value=""
                                   name="main_image"
                                   style="font:9pt 'courier new';text-align:left;direction:ltr;">
                        </div>

                        <img id="holder1" style="margin-top:15px;max-height:100px;margin-bottom:5px;"
                             src="/GolrangSystem-File-Manager/photos/1/default/noimage_news.png">
                        <br>
                        <a class="btn btn-xs btn-danger" href="javascript:void(0)"
                           onclick="$('#holder1').attr('src','/GolrangSystem-File-Manager/photos/1/default/noimage_news.png');$('#thumbnail1').val('');">X</a>
                        <a class="btn btn-xs btn-success" href="javascript:void(0);"
                           onclick="ajax_save_job_image();">افزودن به گالری</a>
                    </div>
                    <div class="clearfix"></div>
                    <div id="selected_images_div" style="padding:5px;margin:5px;border:1px #888 dotted;"></div>
                </div>

                <div class="clearfix"></div>

                <br><br>
                <textarea id="selected_images_field" name="images" style="display: none;"></textarea>


                {{ Form::submit('افزودن', array('class' => 'btn btn-primary')) }}


            </div>
            {{ Form::close() }}
        </div>

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

    <!-- Custom and plugin javascript -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/rada.js') }}
    <!-- jQuery UI -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/jquery-ui/jquery-ui.min.js') }}
    <!-- Sweet alert -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/sweetalert/sweetalert.min.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/persian-datepicker/persian-date.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/persian-datepicker/persian-datepicker.min.js') }}
    <!-- Chosen -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/chosen/chosen.jquery.js') }}
    <script src="/vendor/ck/ckeditor.js"></script>

@endsection

@section('scripts_page')

    <script>
        $('#data_5 .input-group.date > input').pDatepicker({
            format: 'YYYY-MM-DD',
            timePicker: {
                enabled: true
            },
            autoClose: true
        });
        CKEDITOR.replace('other_features', {
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=file',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=file&_token='

        });
        CKEDITOR.replace('main_responsibilities', {
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=file',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=file&_token='

        });
        CKEDITOR.replace('goal_or_mission', {
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=file',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=file&_token='

        });
        CKEDITOR.config.language = 'fa';
        CKEDITOR.config.removePlugins = 'font';
        var cc = 0;

        function ajax_save_job_image() {

            if ($('#selected_images_clearfix')) {
                $('#selected_images_clearfix').remove();
            }
            var selected_image = $('#thumbnail1').val();
            var current_selected_images = $('#selected_images_field').val();
            if (selected_image != "") {

                current_selected_images = current_selected_images + ',' + selected_image;

                $('#selected_images_field').val(current_selected_images);
                cc++;
                $('#selected_images_div').append('' +
                    '<div id="selected_image_' + cc + '" style="margin:2px;float:right;">' +
                    '<img src="' + selected_image + '" style="width:150px;margin:2px;"/>' +
                    '<br>' +
                    '<a href="javascript:void(0);" onclick="selected_image_delete(\'selected_image_' + cc + '\',\'' + selected_image + '\')">' +
                    'حذف' +
                    '</a>' +
                    '</div>' +
                    '');

                $('#selected_images_div').append('<div id="selected_images_clearfix" class="clearfix"></div>');
                $('#holder1').attr('src', '/GolrangSystem-File-Manager/photos/1/default/noimage_news.png');
                $('#thumbnail1').val('');

            } else {
                $('#selected_images_div').append('<div id="selected_images_clearfix" class="clearfix"></div>');
            }
        }
        function getOrganization() {
//            var _token = $('input[name="_token"]').val();
            var flag = $('#api_company').find(':selected').attr('data-flag');
           // loadActiveCompanyMerit();
            if (flag == 1) {
                
                $('#skill').empty();
                $('#skill').trigger("chosen:updated");
                $('#skill2').remove();
                $('#pr_merit').append('<select id="skill2"  class="form-control" tabindex="2"></select>')

                $('.inactive_company_field').hide();
                $('.active_company_field').show();

                var api_company_id = $('#api_company').val();
                //alert('hoze')
                $.ajax({
                    type: 'get',
                    url: "/adpanel/jobs/company-organization?id=" + api_company_id,
                    success: function (result) {

                       // let newOption = result;



                        if(result == 500)
                            alert('500')
                        console.log(result)
                        $('#api_organization_id').html(result)

                    },
                    error:function () {
                        alert('error')

                    }


                })

            } else {
                $('.inactive_company_field').show();
                $('.active_company_field').hide();

                $.ajax({

                    type: 'get',
                    url: "/adpanel/jobs/get-inactive-company-merits",
                    success: function (result) {
                        var obj = jQuery.parseJSON(result);

                        $('#skill').empty();
                        $('#skill').append(obj[0].general);
                        $("#skill").chosen({
                            placeholder_text_single: "انتخاب کنید"
                        });
                        $('#skill').trigger("chosen:updated");
                        $('#skill').prop('disabled', false).trigger("chosen:updated");
                        
                        $('#skill2').remove();
                        $('#pr_merit').append('<input id="skill2"  class="form-control rtl-input" tabindex="2"></input>')



                    }


                })






            }
                //  loadInactiveCompanyMerit();





        }


        function getOrganizationPost() {

            var api_unit_id = $('#api_organization_id').val().split('**')
            var api_company_id = $('#api_company').val();

            $.ajax({

                type: 'get',
                url: "/adpanel/jobs/organization-post?company_id=" + api_company_id + "&unit_id=" + api_unit_id[2],
                success: function (result) {
                    console.log(result)
                    $('#api_post_id').html(result)

                }


            })
        }

        function getField() {


            var api_fieldtype_id = $('#api_fieldtype_id').val();

            $.ajax({

                type: 'get',
                url: "/adpanel/jobs/get-field?id=" + api_fieldtype_id,
                success: function (result) {

                    $('#api_field_id').html(result)

                }


            })
        }
        
          function loadActiveCompanyMerit() {
            $('#apply_limit').attr('readonly', false);
            var personcount=  $( "#api_post_id option:selected").attr("data-personcount");
            $("#apply_limit").val(personcount);
            $('#apply_limit').attr('readonly', true);

            

          /*  $('#skill2').remove();
            $('#pr_merit').append('<select id="skill2"  class="form-control" tabindex="2"></select>')*/
            var api_post_id_split = $('#api_post_id').val().split('**');
            var api_post_id = api_post_id_split[2];
           // alert(api_post_id+'****'+api_post_id_split[1])
            var company_id = $('#api_company').val();

            $.ajax({

                type: 'get',
                url: "/adpanel/jobs/get-active-company-merits?company_id=" + company_id + "&post_id=" + api_post_id,
                success: function (result) {
                    // console.log(result)
                    var obj = jQuery.parseJSON(result);
                  //  alert(obj[0].general)

                    console.log(result);

                    $('#skill').empty();
                    $('#skill').append(obj[0].general);
                    $("#skill").chosen({
                        placeholder_text_single: "انتخاب کنید"
                    });
                    $('#skill').trigger("chosen:updated");
                    $('#skill').prop('disabled', false).trigger("chosen:updated");
                    $('#skill2').html(obj[0].professional)

                    /* $('#skill').html(obj[0].general)
                    */


                }


            })
        }
        
            function add_skill_1() {
           // let skill = $("#skill").chosen().val().split('**')[0];
            let skill = $("#skill option:selected").text();
            let skill_value = $("#skill_value").val()
            let master_data_id = $('#skill option:selected').val();
            skill_count++;
            <?php if(auth()->user()->hasRole('سوپرادمین')){?>
                let markup = "<tr><td><input type='checkbox' name='record'></td><td><input style='border: 0' class='form-control input-sm ' value='" + skill + "' type='text' name='skill_1[" + skill_count + "][name]'><input style='border: 0' value='" + master_data_id + "' type='hidden' name='master_data_id[" + skill_count + "][name]'></td><td><select id='skill_value_1_" + skill_count + "' class='form-control input-sm' style='border: 0' name='skill_1[" + skill_count + "][value]'><option value='3'>مزیت محسوب می شود</option><option value='4'>الزامی است</option></select></td></tr>";
            <?php }else{?>
                 let markup = "<tr><td><input type='checkbox' name='record'></td><td><input style='border: 0' class='form-control input-sm ' value='" + skill + "' type='text' name='skill_1[" + skill_count + "][name]' readonly><input style='border: 0' value='" + master_data_id + "' type='hidden' name='master_data_id[" + skill_count + "][name]'</td><td><select id='skill_value_1_" + skill_count + "' class='form-control input-sm' style='border: 0' name='skill_1[" + skill_count + "][value]'><option value='3'>مزیت محسوب می شود</option><option value='4'>الزامی است</option></select></td></tr>";
           <?php }?>
            $("#skill_table").append(markup);
            $("#skill_value_1_" + skill_count).val(skill_value);
            $("#skill_value").val(3);
            $("#skill").val("").trigger("chosen:updated");
        }

        
            function add_skill_2() {
            var skill2 = $("#skill2").val().split('**')[0];
            //var skill2 = $("#skill2").chosen().val();
            var skill_value2 = $("#skill_value2").val();
            skill_2_count++;
            let master_data_id_pro =$('#skill2 option:selected').val();
               var markup = "<tr><td><input type='checkbox' name='record'></td><td><input style='border: 0' class='form-control input-sm ' value='" + skill2 + "' type='text' name='skill_2[" + skill_2_count + "][name]'><input style='border: 0' class='form-control input-sm ' value='" + master_data_id_pro + "' type='hidden' name='master_data_id_pro[" + skill_2_count + "][name]'></td><td><select id='skill_value_2_" + skill_2_count + "' class='form-control input-sm' style='border: 0' name='skill_2[" + skill_2_count + "][value]'><option value='3'>مزیت محسوب می شود</option><option value='4'>الزامی است</option></select></td></tr>";
            

            $("#skill_table2").append(markup);
            $("#skill_value_2_" + skill_2_count).val(skill_value2);
            $("#skill_value2").val(3);
            $("#skill2").val("");
            //$("#skill2").chosen().val("").trigger("chosen:updated");
        }

  


        function selected_image_delete(id, image_path) {
            var ss = window.confirm('از حذف این تصویر مطمئن هستید؟');
            if (ss) {
                $('#' + id).remove();
                var current_selected_images = $('#selected_images_field').val();
                current_selected_images = current_selected_images.replace(image_path, '');
                $('#selected_images_field').val(current_selected_images);
            }
        }

        var route_prefix = "{{ url(config('lfm.prefix')) }}";
        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
        $('#lfm1').filemanager('image', {prefix: route_prefix});
        $(document).ready(function () {
            // Define function to open filemanager window
            var lfm1 = function (options, cb) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                window.open(route_prefix + '?type=' + options.type || 'image', 'FileManager', 'width=900,height=600');
                window.SetUrl = cb;
            };
        });

        $(document).ready(function () {
            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }
        });

        CKEDITOR.config.language = 'fa';
        CKEDITOR.config.removePlugins = 'font';

        $(function () {
            var availableTags = [
                {!! '"'.implode('","',$posts->pluck('name')->toArray()).'"'  !!}
            ];

            var availableTagsSkills = [
                {!! '"'.implode('","',$job_general_merites->pluck('name')->toArray()).'"'  !!}
            ];
            var availableTagsSkills2 = [
                {!! '"'.implode('","',$job_professional_merites->pluck('name')->toArray()).'"'  !!}
            ];

            function split(val) {
                return val.split(/ \s*/);
            }

            function extractLast(term) {
                return split(term).pop();
            }

            $("#post")
                // don't navigate away from the field on tab when selecting an item
                .on("keydown", function (event) {
                    if (event.keyCode === $.ui.keyCode.TAB &&
                        $(this).autocomplete("instance").menu.active) {
                        event.preventDefault();
                    }
                })
                .autocomplete({
                    minLength: 0,
                    source: function (request, response) {
                        // delegate back to autocomplete, but extract the last term
                        response($.ui.autocomplete.filter(
                            availableTags, extractLast(request.term)).slice(0, 10));
                    },
                    focus: function () {
                        // prevent value inserted on focus
                        return false;
                    },
                    select: function (event, ui) {
                        var terms = split(this.value);
                        // remove the current input
                        terms.pop();
                        // add the selected item
                        terms.push(ui.item.value);
                        // add placeholder to get the comma-and-space at the end
                        terms.push("");
                        this.value = terms.join(" ");
                        return false;
                    }
                });


            $("#skill")
                // don't navigate away from the field on tab when selecting an item
                .on("keydown", function (event) {
                    if (event.keyCode === $.ui.keyCode.TAB &&
                        $(this).autocomplete("instance").menu.active) {
                        event.preventDefault();
                    }
                })

                .autocomplete({
                    minLength: 2,
                    source: function (request, response) {
                        // delegate back to autocomplete, but extract the last term
                        response($.ui.autocomplete.filter(
                            availableTagsSkills, extractLast(request.term)).slice(0, 10));
                    },
                    focus: function () {
                        // prevent value inserted on focus
                        return false;
                    },
                    select: function (event, ui) {
                        var terms = split(this.value);
                        // remove the current input
                        terms.pop();
                        // add the selected item
                        terms.push(ui.item.value);
                        // add placeholder to get the comma-and-space at the end
                        terms.push("");
                        this.value = terms.join(" ");
                        return false;
                    }
                });



            $("#skill2").on("keydown", function (event) {
                if (event.keyCode === $.ui.keyCode.TAB &&
                    $(this).autocomplete("instance").menu.active) {
                    event.preventDefault();
                }
            }).autocomplete({
                minLength: 2,
                source: function (request, response) {
                    // delegate back to autocomplete, but extract the last term
                    response($.ui.autocomplete.filter(availableTagsSkills2, extractLast(request.term)).slice(0, 10));
                },
                focus: function () {
                    // prevent value inserted on focus
                    return false;
                },
                select: function (event, ui) {
                    var terms = split(this.value);
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push(ui.item.value);
                    // add placeholder to get the comma-and-space at the end
                    terms.push("");
                    this.value = terms.join(" ");
                    return false;
                }
            });

            var config = {
                '.chosen-select': {},
                '.chosen-select-deselect': {
                    allow_single_deselect: true
                },
                '.chosen-select-no-single': {
                    disable_search_threshold: 10
                },
                '.chosen-select-no-results': {
                    no_results_text: 'Oops, nothing found!'
                },
                '.chosen-select-width': {
                    width: "95%"
                }
            };
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }

        });

        $("#cities").chosen({rtl: true});

        $('.chosen-toggle').each(function (index) {
            $(this).on('click', function () {
                $(this).parent().find('option').prop('selected', $(this).hasClass('select')).parent().trigger('chosen:updated');
            });
        });

                @if(!is_null(old('skill_1')) && is_array(old('skill_1')) && count(old('skill_1')))
        var skill_count = {!! count(old('skill_1')) !!};
                @else
        var skill_count = 0;

        @endif

    

        function add_question() {
            var question = $('#question').val();
            var index = $('#questions_table tr').length;

            var markup = "<tr><td><input type='checkbox' name='record'></td><td><input style='border: 0' class='form-control input-sm ' value='" + question + "' type='text' name='questions[" + index + "][question]'></td></tr>";
            $('#questions_table').append(markup);
            $('#question').val('');
        }

        $("#del_skill_1").click(function () {
            $("#skill_table").find('input[name="record"]').each(function () {
                if ($(this).is(":checked")) {
                    $(this).parents("tr").remove();
                }
            });
        });

        $("#del_questions").click(function () {
            $("#questions_table").find('input[name="record"]').each(function () {
                if ($(this).is(":checked")) {
                    $(this).parents("tr").remove();
                }
            });
        });
                @if(!is_null(old('skill2')) && is_array(old('skill2')) && count(old('skill2')))
        var skill_2_count = {!! count(old('skill2')) !!};
                @else
        var skill_2_count = 0;

        @endif

     

        $("#del_skill_2").click(function () {
            $("#skill_table2").find('input[name="record"]').each(function () {
                if ($(this).is(":checked")) {
                    $(this).parents("tr").remove();
                }
            });
        });

    </script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-menu-item-wrapper {
            font: 12pt 'B Nazanin';
            background: #efefef;

        }
    </style>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

@endsection
