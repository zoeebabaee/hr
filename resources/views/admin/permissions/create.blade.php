@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    ایجاد دسترسی جدید
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
            <h2>دسترسی ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        خانه</a>
                </li>
                <li  class="active">
                    <a><strong>افزودن دسترسی جدید</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">


                <h1><i class='fa fa-key'></i> افزودن دسترسی جدید</h1>
                <br>

                {{ Form::open(array('route' => 'permissions.store')) }}

                <div class="form-group">
                    {{ Form::submit('ذخیره و بستن', array('class' => 'btn btn-primary','name'=>'saveAndClose')) }}
                    {{ Form::submit('ذخیره و جدید', array('class' => 'btn btn-primary','name'=>'saveAndNew')) }}
                    {{ Form::submit('ذخیره', array('class' => 'btn btn-primary','name'=>'save')) }}
                    {{ Form::button('انصراف', array('class' => 'btn btn-warning','onclick'=>'history.back()')) }}
                    <div class="clearfix"><p></p><p></p></div>
                </div>
                
                <div class="form-group">
                    {{ Form::label('name', 'نام دسترسی') }}
                    {{ Form::text('name', '', array('class' => 'form-control')) }}
                </div><br>
                @if(!$roles->isEmpty())
                <h4>افزودن دسترسی به نقش</h4>

                @foreach ($roles as $role)
                        @if($role->name == 'برنامه نویس' && !auth()->user()->hasRole('برنامه نویس'))
                            @continue
                        @endif
                    {{ Form::checkbox('roles[]',  $role->id ) }}
                    {{ Form::label($role->name, ucfirst($role->name)) }}<br>

                @endforeach
                @endif
                <br>
                {{ Form::submit('ذخیره و بستن', array('class' => 'btn btn-primary','name'=>'saveAndClose')) }}
                {{ Form::submit('ذخیره و جدید', array('class' => 'btn btn-primary','name'=>'saveAndNew')) }}
                {{ Form::submit('ذخیره', array('class' => 'btn btn-primary','name'=>'save')) }}
                {{ Form::button('انصراف', array('class' => 'btn btn-warning','onclick'=>'history.back()')) }}
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
