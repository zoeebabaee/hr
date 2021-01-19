@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    تنظیمات
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
            <h2>تنظیمات سیستم</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/adpanel">
                        خانه</a>
                </li>
                <li class="active">
   مطلب ثابت صفحه نخست
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">

                <div class="form-group-lg col-lg-8">
                    @if(isset($setting))
                        {{ Form::model($setting, ['route' => ['first-content.update'], 'method' => 'PUT','class'=>'form','files' => true]) }}

                        <div class="col-lg-6">
                            <div class="form-group">
                            <div class="input-group rtl-input input-sx">
                          <span class="input-group-btn">
                            <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                              <i class="fa fa-picture-o"></i> تصویر
                            </a>
                          </span>
                                <input id="thumbnail1" class="form-control input-sm" type="text" value="{{$setting->image}}" name="image" style="font:9pt 'courier new';text-align:left;direction:ltr;">
                            </div>
                            @if($setting->image=="")
                                <img id="holder1" style="margin-top:15px;max-height:100px;" src="/GolrangSystem-File-Manager/photos/1/default/noimage_news.png">
                            @else
                                <img id="holder1" style="margin-top:15px;max-height:100px;" src="{{$setting->image}}">
                            @endif
                            <a class="btn btn-xs btn-danger" href="javascript:void(0)" onclick="$('#holder1').attr('src','/GolrangSystem-File-Manager/photos/1/default/noimage_news.png');$('#thumbnail1').val('');$(this).remove();">X</a>
                            </div>
                        </div>

                    <div class="clearfix"></div>

                        <div class="form-group">
                            {{ Form::label('title', 'عنوان') }}
                            {{ Form::text('title',$setting->title, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('body', 'متن') }}
                            {{ Form::textarea('body', $setting->body, array('class' => 'form-control','id'=>'body')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('link', 'لینک') }}
                            {{ Form::text('link', $setting->link, array('class' => 'form-control ltr-input')) }}
                        </div>

                        {{ Form::submit('ذخیره', array('class' => 'btn btn-primary')) }}
                        {{ Form::button('انصراف', array('class' => 'btn btn-warning','onclick'=>'history.back()')) }}

                        {{ Form::close() }}
                    @else
                        {{abort(401)}}
                    @endif
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
            LinkBrowser:'{{ url(config('lfm.prefix')) }}?type=Files',
            LinkUploader:'{{ url(config('lfm.prefix')) }}/upload?type=Files&_token={{csrf_token()}}'
        });
        CKEDITOR.config.language = 'fa';
        CKEDITOR.config.removePlugins = 'font';
        CKEDITOR.config.LinkBrowser='{{ url(config('lfm.prefix')) }}?type=Files';
        CKEDITOR.config.LinkUploader='{{ url(config('lfm.prefix')) }}/upload?type=Files&_token={{csrf_token()}}';

    </script>
@endsection

