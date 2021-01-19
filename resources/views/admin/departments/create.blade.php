@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت دپارتمان ها
@endsection

@section('header_styles')
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.bootstrap.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.responsive.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.tableTools.min.css') }}

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}

    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/datapicker/datepicker3.css') }}

@endsection
@section('content')


    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>مدیریت دپارتمان ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        خانه</a>
                </li>
                <li>
                    ایجاد دپارتمان جدید
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">

                <div class="form-group-lg col-lg-6">

                    <h1><i class='fa fa-user-md'></i>&nbsp;ایجاد دپارتمان</h1>
                    <hr>

                    {{ Form::open(array('route' => 'departments.store','files' => true)) }}

                    <div class="form-group">
                        {{ Form::submit('ذخیره', array('class' => 'btn btn-primary')) }}
                        {{ Form::button('انصراف', array('class' => 'btn btn-warning','onclick'=>'history.back()')) }}
                        <div class="clearfix"><p></p><p></p></div>
                    </div>

                    <div class="col-lg-6">
                        <div class="input-group rtl-input input-sx">
                          <span class="input-group-btn">
                            <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                              <i class="fa fa-picture-o"></i> تصویر
                            </a>
                          </span>
                            <input id="thumbnail1" class="form-control input-sm" value="{{old('image')}}" type="text" name="image" style="font:9pt 'courier new';text-align:left;direction:ltr;">
                        </div>
                        <img id="holder1" style="margin-top:15px;max-height:100px;">
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group" style="margin-top:10px;">
                        {{ Form::label('name', 'نام') }}
                        {{ Form::text('name', old('name'), array('class' => 'form-control')) }}
                    </div>

                </div>


                <div class="clearfix"></div>

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

    <script src="//cdn.ckeditor.com/4.7.1/full-all/ckeditor.js"></script>

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
                var lfm1 = function(options, cb) {
                    var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                    window.open(route_prefix + '?type=' + options.type || 'image', 'FileManager', 'width=900,height=600');
                    window.SetUrl = cb;
                };
            });
        });
        CKEDITOR.replace('body',{
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Files',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Files&_token='

        });
        CKEDITOR.config.language = 'fa';
        CKEDITOR.config.removePlugins = 'font';



    </script>
@endsection
