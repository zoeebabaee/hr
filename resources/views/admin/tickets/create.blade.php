@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    ارسال پیام
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
            <h2>ارسال پیام</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/adpanel">
                        خانه</a>
                </li>
                <li class="active">
                    <a href="/adpanel/users"><strong>لیست کاربران</strong></a>
                </li>
                <li class="active">
                    <a><strong>ارسال پیام</strong> به {{$user->first_name . ' '. $user->last_name }}</a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">

                {{ Form::open(array('route' => 'tickets.store')) }}

                <div class="form-group">
                    {{ Form::label('company_id', 'از طرف شرکت') }}
                    {{ Form::select('company_id', Auth::user()->company->pluck('name','id'), old('company_id'), ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('subject', 'موضوع') }}
                    {{ Form::text('subject', old('subject'), ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('priority', 'اهمیت') }}
                    {{ Form::select('priority',config('app.enum_ticket_priority'), old('priority'), ['class' => 'form-control']) }}
                </div>


                {{ Form::label('body', 'متن') }}

                {{ Form::textarea('body', old('body'), array('class' => 'form-control')) }}


                <div class="clearfix"></div>
                <br>

                {{ Form::submit('ارسال', array('class' => 'btn btn-primary')) }}
                {{ Form::hidden('user_id', $user->id) }}
                {{ Form::hidden('job_id', $job_id) }}
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
    <script src="/vendor/ck/ckeditor.js"></script>


@endsection

@section('scripts_page')

    <script>

        $(document).ready(function () {
            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }
        });
        CKEDITOR.replace('body', {
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=file',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=file&_token='

        });
        CKEDITOR.config.language = 'fa';
    </script>

@endsection
