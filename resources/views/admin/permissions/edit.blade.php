@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت دسترسی ها
@endsection

@section('header_styles')
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.bootstrap.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.responsive.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.tableTools.min.css') }}

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}

@endsection
@section('content')
    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>دسترسی ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        خانه</a>
                </li>
                <li>
                    ویرایش دسترسی
                </li>
                <li  class="active">
                    <a><strong>{{$permission->name}}</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">

                <h1><i class='fa fa-key'></i> ویرایش {{$permission->name}}</h1>
                <br>
                {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with permission data --}}

                <div class="form-group">
                    {{ Form::submit('ذخیره', array('class' => 'btn btn-primary')) }}
                    {{ Form::button('انصراف', array('class' => 'btn btn-warning','onclick'=>'history.back()')) }}
                    <div class="clearfix"><p></p><p></p></div>
                </div>
                
                <div class="form-group">
                    {{ Form::label('name', 'نام دسترسی') }}
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>
                <br>
                {{ Form::submit('ویرایش', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}

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

    <!-- iCheck -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/iCheck/icheck.min.js') }}
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

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

