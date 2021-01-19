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
                    <a href="">
                        خانه</a>
                </li>
                <li  class="active">
                    <a><strong>افزودن کد ملی جدید</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">


                <h1><i class='fa fa-key'></i> افزودن کدملی جدید</h1>
                <br>

                {{ Form::open(array('route' => 'worker-list.store','id'=>'create-form')) }}

                <div class="form-group">
                    {{ Form::submit('ذخیره و بستن', array('class' => 'btn btn-primary','name'=>'saveAndClose')) }}
                    {{ Form::submit('ذخیره و جدید', array('class' => 'btn btn-primary','name'=>'saveAndNew')) }}
                    {{ Form::submit('ذخیره', array('class' => 'btn btn-primary','name'=>'save')) }}
                    <a href="/adpanel/worker-list" class="btn btn-warning">انصراف</a>
                    <div class="clearfix"><p></p><p></p></div>
                </div>
                
                <div class="form-group">
                    {{ Form::label('national_code', 'کدملی') }}
                    {{ Form::text('national_code', '', ['class' => 'form-control','maxLength'=>'10','autocomplete'=>'off']) }}
                    <label id="codemelli_error" class="error"></label>
                </div>

                <div class="form-group">
                    {{ Form::label('company_id', 'شرکت') }}
                    {{ Form::select('company_id', $companies, ['class' => 'form-control']) }}
                </div>

                <br>
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

        function checkCodeMeli(input) {
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
        }
        $('#create-form').on('submit',function () {
            var national_code = $('#national_code').val();
            if (!checkCodeMeli(national_code)) {
                $('#codemelli_error').html('کدملی وارد شده صحیح نیست.');
                return false;
            } else {
                $('#codemelli_error').html('');
            }
        });


    </script>

@endsection
