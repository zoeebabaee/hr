@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    همکاران قابل انتقال
@endsection

@section('header_styles')

    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.bootstrap.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.responsive.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.tableTools.min.css') }}

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}

@endsection
@section('content')
    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>لیست همکاران قابل انتقال</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('home')}}">
                        خانه</a>
                </li>
                <li class="active">
                    <a><strong>
                            لیست همکاران قابل انتقال</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft ">
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
                    <div class="ibox-content">

                        {{ Form::model($workerList, array('route' => ['worker-list.index'], 'method' => 'GET','class'=>'form-inline')) }}

                        <div class="form-group">
                            {{ Form::label('national_code', 'کدملی') }}
                            {{ Form::text('national_code', old('title'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('company_id', 'شرکت') }}
                            {{ Form::select('company_id',[null=>'لطفا یک گزینه انتخاب کنید'] + $companies->pluck('name','id')->toArray(), old('company'), array('class' => 'form-control chosen-select chosen-rtl','id'=>'company' ,'empty'=>'true')) }}
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success" type="submit">جستجو</button>
                        </div>
                        <div class="clearfix"></div>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">

                <h1><i class="fa fa-key"></i>&nbsp;کدملی های موجود
                </h1>

                <a href="{{ route('worker-list.create') }}" class="btn btn-success">افزودن کدملی جدید</a>

                <br><br>
                @for($i = 0; $i<count($workers); $i++)
                    <div class="table-responsive col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <table class="table table-bordered table-striped">

                            <thead>
                            <tr>
                                <th>کدملی</th>
                                <th>نام</th>
                                <th>شرکت</th>
                                <th>مدیریت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($workers[$i])
                                @foreach ($workers[$i] as $worker)
                                    <tr>
                                        <td>{{ $worker->national_code }}</td>
                                        <td>{{
                                         isset($user_lists[$worker->national_code]) ?
                                         $user_lists[$worker->national_code]['first_name'].' '.$user_lists[$worker->national_code]['last_name']
                                         :
                                         'عضو نیست'
                                         }}</td>
                                        <td>{{ $worker->company->name }}</td>
                                        <td>
                                            <a href="{{ route('worker-list.edit', $worker->id) }}"
                                               class="btn btn-warning btn-xs  pull-left"
                                               style="margin-right: 3px;"><i
                                                        class="fa fa-edit"></i> </a>

                                            {!! Form::open(['method' => 'DELETE', 'route' => ['worker-list.destroy', $worker->id] ]) !!}
                                            {!! Form::button('<i class="fa fa-trash"></i> ', ['type'=>'submit','class' => 'btn btn-danger btn-xs pull-left ']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                    </div>
                @endfor
                <div class="clearfix"></div>
                <a href="{{ route('worker-list.create') }}" class="btn btn-success">افزودن کدملی جدید</a>

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
    <!-- Flot -->

    <!-- Peity -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/peity/jquery.peity.min.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/demo/peity-demo.js') }}
    <!-- Custom and plugin javascript -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/rada.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/pace/pace.min.js') }}
    <!-- jQuery UI -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/jquery-ui/jquery-ui.min.js') }}
    <!-- Jvectormap -->
    <!-- EayPIE -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/easypiechart/jquery.easypiechart.js') }}
    <!-- Sparkline -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/sparkline/jquery.sparkline.min.js') }}
    <!-- Sparkline demo data  -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/demo/sparkline-demo.js') }}



    <!-- Sweet alert -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/sweetalert/sweetalert.min.js') }}


@endsection
@section('scripts_page')

    <script>
        $(document).ready(function () {

            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }
        });


    </script>

@endsection
