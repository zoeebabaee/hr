@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت مشاغل
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/chosen.css') }}

@endsection
@section('content')
    <div id="specific_time_extend" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">تمدیدآگهی</h4>
                </div>
                <div class="modal-body">
                    <p>


                    <div class="form-group inactive_company_field">
                        <label class="font-noraml">
                            تعداد روز</label> <span style="color: red;">*</span>
                        <div>
                            <input type="hidden" id="job_id_for_specific_extended" >
                            <select name="select_extend_days" id="select_extend_days" class="form-control" required>
                                <option value="14">دوهفته</option>
                                <option value="30">یک ماه</option>
                                <option value="60">دو ماه</option>
                            </select>

                        </div>
                    </div>


                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="dismiss_modal" onclick="admin_specific_time_extended()" class="btn btn-info" data-dismiss="modal">تمدید</button>
                </div>
            </div>

        </div>
    </div>
    
        <div id="non_automatic_extend" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">تمدیدآگهی</h4>
                </div>
                <div class="modal-body">
                    <p>


                    <div class="form-group inactive_company_field">
                        <label class="font-noraml">
                            تعداد روز</label> <span style="color: red;">*</span>
                        <div>
                            <input name="extend_days" id="extend_days" type="number"  class="form-control" required>

                        </div>
                    </div>


                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="dismiss_modal" onclick="admin_extended()" class="btn btn-info" data-dismiss="modal">تمدید</button>
                </div>
            </div>

        </div>
    </div>


<div class="ajax_response"></div>
    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>مشاغل</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        خانه</a>
                </li>
                <li class="active">
                    <a><strong>
                            لیست شغل ها</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">

        <div class="row">

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>فیلترها</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="background: #EEEEEE">

                        {{ Form::model($jobs, array('method' => 'GET')) }}

                        <div class="form-group col-lg-4">
                            {{ Form::label('title', 'عنوان') }}
                            {{ Form::text('title', old('title'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group col-lg-4">
                            {{ Form::label('approved', 'وضعیت تایید') }}
                            {{ Form::select('approved', [''=>'لطفا یک گزینه انتخاب کنید',1=>'تایید شده',0=>'تایید نشده'],request('approved'), array('class' => 'form-control chosen')) }}


                        </div>

                        <div class="form-group col-lg-4">
                            {{ Form::label('post_id', 'سمت') }}
                            {{ Form::select('post_id',[null=>'لطفا یک گزینه انتخاب کنید'] + $post->pluck('name','id')->toArray(), old('post'), array('class' => 'form-control chosen','id'=>'post_id')) }}
                        </div>

                        @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            {{--<div class="form-group col-lg-4">
                                {{ Form::label('company_id', 'شرکت') }}
                                {{ Form::select('company_id',[null=>'لطفا یک گزینه انتخاب کنید'] + $companies->pluck('name','id','flag')->toArray(), old('company_id'), array('class' => 'form-control chosen','id'=>'company_id' ,'empty'=>'true')) }}
                            </div>--}}

                            <div class="form-group col-lg-4">

                                <label>
                                    انتخاب شرکت
                                </label>
                                <div>
                                    <select name="company_id" data-placeholder="انتخاب شرکت ..." id="company_id"
                                            class="form-control chosen"
                                            tabindex="2" {{--onchange="getOrganization()" --}}>
                                        <option value="0">انتخاب شرکت</option>

                                        @foreach($companies as $dep)
                                            <option data-flag="{{$dep->flag}}"
                                                @if($selected_company == $dep->id) selected="selected" @endif
                                                    value="{{$dep->id}}">{{$dep->name}}</option>
                                        @endforeach
                                    </select>
                                    {{--
                                                                {{csrf_field()}}
                                    --}}
                                </div>

                            </div>

                        @endif

                        <div class="form-group col-lg-4">
                          {{--  {{ Form::label('department_id', 'حوزه کاری') }}
                            {{ Form::select('department_id',[null=>'لطفا یک گزینه انتخاب کنید'] + $departments->pluck('name','id')->toArray(), old('department_id'), array('class' => 'form-control chosen','id'=>'department_id' ,'empty'=>'true')) }}

--}}
                                <label>
                                    حوزه کاری </label> <span style="color: red;">*</span>
                                <div>
                                    <select name="department_id" id="department_id" data-placeholder="انتخاب حوضه کاری..."
                                            class="form-control chosen" tabindex="2">
                                           <option value="0">لطفا یک گزینه انتخاب کنید</option>


                                        @foreach($departments as $dep)
                                            <option
                                                    @if($selected_department == $dep->id) selected="selected" @endif
                                            value="{{$dep->id}}">{{$dep->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        </div>


                        <div class="clearfix"></div>
                        <button class="btn btn-primary pull-left" type="submit">اعمال فیلترهای جستجو</button>
                        @if(isset($_GET['title']))
                            <a href="{{route('jobs.index')}}" style="margin-left: 2px"
                               class="btn btn-danger pull-right">حذف فیلتر ها</a>
                        @endif

                        <div class="clearfix"></div>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>


            <div class="col-lg-12">

                @if(auth()->user()->hasPermissionTo('مشاغل-جدید') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس|ادمین مشاغل'))
                    <a href="{{ route('jobs.create') }}" class="btn btn-info"><i class="fa fa-newspaper-o"></i>
                        &nbsp;&nbsp;
                        جدید</a>
                @endif
                <a href="{{ route('jobs.export_csv') }}{{$query_string}}" class="btn btn-primary"><i class="fa fa-file-excel-o"></i>
                    &nbsp;&nbsp;
                    خروجی اکسل</a>

                <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>

                            <th>عنوان</th>
                            <th>شرکت</th>
                            @if(auth()->user()->hasPermissionTo('اپلای-مشاهده') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                <th>درخواست ها</th>
                            @endif
                            <th>در خواستهای تایید شده</th>
                            <th>در خواستهای رد شده</th>
                            <th>در خواستهای در انتظار بررسی</th>
                            <th>تاریخ انتشار</th>
                            <th>تاریخ انقضا</th>
                            <th>وضعیت</th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($jobs as $job)
                            <tr
                                    @if(Carbon::parse($job->expire_date)->format('Y-m-d') < Carbon::now()->timezone('Asia/Tehran')->format('Y-m-d'))
                                    class="danger"
                                    @elseif($job->status==1 )
                                    class="success"
                                    @elseif($job->status==2 )
                                    class="warning"
                                    @elseif($job->status==3 )
                                    class="danger"
                                    @endif
                            >

                                <td>
                                    <strong>{{$job->title}} ( <i class="fa fa-thumbs-up"
                                                                 aria-hidden="true"></i> {{$job->users->count()}}
                                        )</strong></td>
                                <td>
                                    {{$job->company->name}}
                                </td>
                                @if(auth()->user()->hasPermissionTo('اپلای-مشاهده') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                    <td>
                                        @if($job->applies()->count()>0)
                                            <a href="{{route('applies.index', ['id' => $job->id])}}" target="_blank"
                                               style="text-decoration: underline;">
                                                {{$job->applies()->count()}}
                                            </a>
                                        @else
                                            هیچ
                                        @endif
                                        @if($job->status ==3)
                                            {!! '<p style="color:red">بسته شده</p>' !!}
                                        @endif
                                    </td>
                                @endif

                                <td {{$job->applies->where('status',2)->count() ?'style=color:green;font-weight:bold':''}} > {{ $job->applies->where('status',2)->count() }}</td>
                                <td {{$job->applies->where('status',3)->count() ?'style=color:red;':''}} >{{ $job->applies->where('status',3)->count() }}</td>
                                <td>{{ $job->applies->where('status',1)->count() + $job->applies->where('status',0)->count()}}</td>

                                <td>{{JDate::createFromCarbon(Carbon::parse($job->created_at))->format('Y-m-d')}}</td>
                                <td>{{JDate::createFromCarbon(Carbon::parse($job->expire_date))->format('Y-m-d')}}</td>
                                <td>

                                    @if($job->approved==1 && $job->deleted_at==null)
                                        <i class="fa fa-check" style="color:green;"></i>&nbsp;
                                        تایید شده
                                    @endif
                                    @if($job->approved==0 && $job->deleted_at==null)
                                        <i class="fa fa-clock-o" style="color:orange;"></i>&nbsp;
                                        در انتظار تایید

                                    @endif

                                    @if($job->approved==1)
                                        @if(auth()->user()->hasPermissionTo('مشاغل-رد') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            {!! Form::open(['method' => 'POST', 'route' => ['jobs.reject', $job->id] ]) !!}
                                            {!! Form::button('<i class="fa fa-times"></i> رد شود', ['type'=>'submit','class' => 'btn btn-outline btn-default btn-xs']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    @else
                                        @if(auth()->user()->hasPermissionTo('مشاغل-تایید') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            {!! Form::open(['method' => 'POST', 'route' => ['jobs.accept', $job->id] ]) !!}
                                            {!! Form::button('<i class="fa fa-check"></i> تایید شود', ['type'=>'submit','class' => 'btn btn-outline btn-primary btn-xs']) !!}
                                            {!! Form::close() !!}
                                            
                                            
                                            {!! Form::open(['method' => 'POST', 'route' => ['jobs.acceptwithoutrelease', $job->id] ]) !!}
                                            {!! Form::button('<i class="fa fa-check"></i> تایید بدون انتشار', ['type'=>'submit','class' => 'btn  btn-default btn-xs']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    @endif
                                </td>


                                <td style="white-space: nowrap;width:170px;">
                                    @if(!$job->ItemId >0)
                                    <a href="{{ route('jobs.copy', $job->id) }}" style="margin-bottom: 5px"
                                               class="btn btn-danger btn-xs  btn-outline"><i
                                                        class="fa fa-times"></i> کپی کردن آگهی
                                    </a>
                                    @endif
                                    @if($job->deleted_at==null)
                                        @if(auth()->user()->hasPermissionTo('مشاغل-ویرایش') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            <a href="{{ route('jobs.edit', $job->id) }}" style="margin-bottom: 5px"
                                               class="btn btn-warning btn-xs  btn-outline"><i
                                                        class="fa fa-edit"></i> ویرایش
                                            </a>
                                        @endif
                                    @endif
                                    
                                            <!--check this job is from portal or not-->
                                           

                                        @if($admin_extended_job == 1)
                                            <a data-toggle="modal" data-target="#non_automatic_extend"  style="margin-bottom: 5px"
                                               class="btn btn-primary btn-xs  btn-outline"><i
                                                        class="fa fa-refresh"></i> تمدید آگهی به مدت دلخواه
                                            </a>
                                        @endif

                                    @if($job->expire_date < Carbon::now()->timezone('Asia/Tehran')->addDay(1)->toDateString())
                                    


                                             <a data-toggle="modal" data-target="#specific_time_extend"  onclick=set_job_id({{$job->id}}) style="margin-bottom: 5px"
                                               class="btn btn-primary btn-xs  btn-outline"><i
                                                        class="fa fa-refresh">تمدید   </i> 
                                                </a>

                                       <!-- <a href="{{ route('jobs.extend', $job->id) }}" style="margin-bottom: 5px"
                                           class="btn btn-primary btn-xs  btn-outline"><i
                                                    class="fa fa-refresh"></i> تمدید
                                        </a>-->


                                        @if($job->status !=3)
                                            <a href="{{ route('jobs.archive', $job->id) }}" style="margin-bottom: 5px"
                                               class="btn btn-danger btn-xs  btn-outline"><i
                                                        class="fa fa-times"></i> بستن
                                            </a>
                                        @endif
                                        
                                             @elseif(auth()->user()->hasAnyRole('برنامه نویس|ادمین مشاغل|ادمین'))
                                  <a href="{{ route('jobs.archive', $job->id) }}" style="margin-bottom: 5px"
                                               class="btn btn-danger btn-xs  btn-outline"><i
                                                        class="fa fa-times"></i> بستن آگهی قبل از انقضا
                                            </a>
                                    @endif

                                    @if($job->deleted_at==null)
                                        @if(auth()->user()->hasPermissionTo('مشاغل-حذف') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            <a href="javascript:void(0);" cat_id="{{$job->id}}"
                                               style="margin-bottom: 5px;margin-right: 3px;"
                                               route="{{route('jobs.destroy', $job->id)}}"
                                               class="btn btn-info btn-xs  btn-danger confirm_alert btn-outline"
                                            ><i class="fa fa-trash"></i> حذف
                                            </a>
                                        @endif
                                    @else
                                        @if(auth()->user()->hasPermissionTo('مشاغل-بازیابی') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            {!! Form::open(['method' => 'POST', 'route' => ['jobs.restore', $job->id],'class'=>'form-btn' ]) !!}
                                            {!! Form::button('<i class="fa fa-undo"></i> بازگردانی', ['type'=>'submit','class' => 'btn btn-primary btn-xs btn-outline']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    @endif

                                    @if($job->deleted_at == null)
                                        <br>
                                        @if(auth()->user()->hasPermissionTo('مشاغل-پین') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                            @if($job->pin_status==1)
                                                {!! Form::open(['method' => 'POST', 'route' => ['jobs.unpin', $job->id],'class'=>'form-btn' ]) !!}
                                                {!! Form::button('<i class="fa fa-thumb-tack"></i> برداشتن پین', ['type'=>'submit','class' => 'btn btn-success btn-xs']) !!}
                                                {!! Form::close() !!}

                                            @else
                                                {!! Form::open(['method' => 'POST', 'route' => ['jobs.pin', $job->id],'class'=>'form-btn' ]) !!}
                                                {!! Form::button('<i class="fa fa-thumb-tack"></i> پین', ['type'=>'submit','class' => 'btn btn-default btn-xs btn-outline']) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        @endif
                                    @endif
                                        <div class="clearfix"></div>
                                        <a class="btn btn-default btn-xs btn-outline" style="margin-top:5px;" href="/jobs/{{$job->persian_alias}}" target="_blank">
                                                <i class="fa fa-eye"></i>
                                                پیش نمایش
                                            </a>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>
                    @if($extended == 0 && $admin_extended_job == 0)
                    {!! $jobs->appends(\Illuminate\Support\Facades\Input::except('page'))->links() !!}
                    @endif

                </div>

                @if(auth()->user()->hasPermissionTo('مشاغل-جدید') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <a href="{{ route('jobs.create') }}" class="btn btn-info"><i class="fa fa-newspaper-o"></i>
                        &nbsp;&nbsp;
                        جدید</a>
                @endif
                <a href="{{ route('jobs.export_csv') }}{{$query_string}}" class="btn btn-primary"><i class="fa fa-file-excel-o"></i>
                    &nbsp;&nbsp;
                    خروجی اکسل</a>
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
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/pace/pace.min.js') }}
    <!-- jQuery UI -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/jquery-ui/jquery-ui.min.js') }}

    <!-- Sweet alert -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/sweetalert/sweetalert.min.js') }}

    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/datapicker/bootstrap-datepicker.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/toastr/toastr.min.js') }}

    <!-- Chosen -->
    {{ Html::script('/site/'.config('app.site_theme').'/js/chosen.jquery.js') }}

@endsection
@section('scripts_page')

    <script>
        $(document).ready(function () {
            $('.chosen').chosen();
            $('.confirm_alert').click(function () {
                var $_this = $(this);
                swal({
                        title: "مطمئنید؟",
                        text: "در صورت تایید ، این اطلاعات برای همیشه حذف می شوند\r\n",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "بله ، حذف شود",
                        cancelButtonText: "خیر ، منصرف شدم",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            var cat_id = $_this.attr('cat_id');
                            $.ajax({

                                type: "DELETE",
                                url: $_this.attr('route'),
                                data: 'job=' + cat_id + '&_token={{csrf_token()}}',
                                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                                complete: function (data) {
                                    swal("حذف شد", "اطلاعات مورد نظر شما حذف شدند", "success");
                                    setTimeout('location.reload();', 1500);
                                }
                            });
                        } else {
                            swal("منصرف شدم", "اطلاعات شما حذف نشدند", "error");
                        }
                    });
            });
            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }

        });
        //this function is for specific extended job
        function set_job_id(id)
        {
            $("#job_id_for_specific_extended").val(id);
        }

        function save_sort_order() {
            var value = [];
            var value_string;
            var inputs = $("input[name='sort_order[]']").map(function () {
                return $(this).attr('id');
            }).get();
            for (var i = 0; i < inputs.length; i++) {
                value[i] = $('#' + inputs[i]).attr('job_id') + ':' + $('#' + inputs[i]).val();
            }
            var value_string = value.join();
            //alert(value_string);
            $.ajax({
                method: "POST",
                url: "{{route('jobs.update.sort_order')}}",
                data: {string: value_string, _token: '{!!csrf_token()!!}'}
            }).done(function (msg) {
                document.location.href = '{{route('jobs.index')}}';
            });
        }

        function admin_extended(){
            if($('#extend_days').val() == '')
            {
                alert('لطفا فیلد مورد نظر را تکمیل کنید')
                $('#dismiss_modal').attr('data-dismiss','')


            }
        else{
                $('#dismiss_modal').attr('data-dismiss','modal')

                var extend_days = $('#extend_days').val();
                $.ajax({
                    type: 'post',
                    data:'days='+extend_days+'&job_id='+<?=$job->id?>,
                    url: "/adpanel/extend-specific-day",
                    success: function (result) {
                        console.log(result)
                        $('.ajax_response').append('<div class="container" id="alert_messages_div">\n' +
                            '                        <div class="alert alert-success"><em> آگهی مورد نظر با مدت '+extend_days+' روز تمدید شد </em>\n' +
                            '                        </div>')



                    }


                })
            }

        }
        
        function admin_specific_time_extended(){
            if($('#select_extend_days').val() == '')
            {
                alert('لطفا فیلد مورد نظر را تکمیل کنید')
                $('#dismiss_modal').attr('data-dismiss','')


            }
        else{
                $('#dismiss_modal').attr('data-dismiss','modal')

                var extend_days = $('#select_extend_days').val();
                var jobid = $('#job_id_for_specific_extended').val();
                $.ajax({
                    type: 'post',
                    data:'days='+extend_days+'&job_id='+jobid,
                    url: "/adpanel/extend-specific-day",
                    success: function (result) {
                        console.log(result)

     toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                positionClass: 'toast-bottom-left',
                timeOut: 10000
            };
            toastr.success('آگهی موردنظر تمدید شد');
    
                    }


                })
            }

        }


        function getOrganization() {
//            var _token = $('input[name="_token"]').val();

          //  var flag = $('#company_id').find(':selected').attr('data-flag');
            $('#department_id').prop('disabled', true).trigger("chosen:updated");


            var api_company_id = $('#company_id').val();

                $.ajax({
                    type: 'get',
                    url: "/adpanel/jobs/company-organization2?id=" + api_company_id,
                    success: function (result) {
                         console.log(result)


                        let newOption = result;
                        $('#department_id').empty();
                        $('#department_id').append(newOption);
                        $("#department_id").chosen({
                            placeholder_text_single: "انتخاب کنید"
                        });
                        $('#department_id').trigger("chosen:updated");
                        $('#department_id').prop('disabled', false).trigger("chosen:updated");
                    }


                })


        }

    </script>
@endsection