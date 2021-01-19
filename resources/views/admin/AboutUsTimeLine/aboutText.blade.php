@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    درباره ما
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
            <h2>درباره ما</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/adpanel">
                        خانه</a>
                </li>
                <li class="active">
                    مطلب بالای صفحه در باره ما
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">

                <div class="form-group-lg col-lg-8">
                        <h1><i class='fa fa-user-md'></i>&nbsp;مطلب بالای صفحه در باره ما</h1>

                        {{ Form::model($about, ['route' => ['aboutUsText.update'], 'method' => 'PUT','class'=>'form','files' => true]) }}
                        <div class="clearfix"></div>

                        <div class="form-group">
                            {{ Form::label('body', 'متن') }}
                            {{ Form::textarea('body', $about->body, array('class' => 'form-control','id'=>'body')) }}
                        </div>

                        {{ Form::submit('ذخیره', array('class' => 'btn btn-primary')) }}
                        {{ Form::button('انصراف', array('class' => 'btn btn-warning','onclick'=>'history.back()')) }}

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

    <!-- jQuery UI -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/jquery-ui/jquery-ui.min.js') }}

    <!-- Custom and plugin javascript -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/rada.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/pace/pace.min.js') }}

    <!-- Sweet alert -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/sweetalert/sweetalert.min.js') }}

    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/persianDateTimePicker/jalaali.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/persianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.js') }}

    <script src="/vendor/ck/ckeditor.js"></script>

@endsection
@section('scripts_page')
    <script>
        $(document).ready(function () {
            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }
            var route_prefix = "{{ url(config('lfm.prefix')) }}";
            {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}

            $('#lfm1').filemanager('image', {prefix: route_prefix});
            $(document).ready(function(){
                // Define function to open filemanager window
                var lfm1 = function(options, cb) {
                    var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                    window.open(route_prefix + '?type=' + options.type || 'image', 'FileManager', 'width=900,height=600');
                    window.SetUrl = cb;
                };
            });
        });
        CKEDITOR.replace('body',{
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=file',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=file&_token={{csrf_token()}}',
            LinkBrowser:'{{ url(config('lfm.prefix')) }}?type=file',
            LinkUploader:'{{ url(config('lfm.prefix')) }}/upload?type=file&_token={{csrf_token()}}'
        });
        CKEDITOR.config.language = 'fa';
        //CKEDITOR.config.removePlugins = 'font';
        CKEDITOR.config.LinkBrowser='{{ url(config('lfm.prefix')) }}?type=file';
        CKEDITOR.config.LinkUploader='{{ url(config('lfm.prefix')) }}/upload?type=file&_token={{csrf_token()}}';

    </script>
@endsection

