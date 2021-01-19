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
                    اسلایدر صفحه نخست
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">

                {{ Form::model(null, ['route' => ['first-page-slider.update'], 'method' => 'PUT','class'=>'form','files' => true]) }}
                @php
                $c=1;
                @endphp

                @foreach($settings as $setting)

                <div id="area_{{$setting->id}}" style="background: #efefef;padding:10px;border:1px #666 dashed;margin:3px;">
                    <span onclick="$('#slider_{{$setting->id}}').slideToggle();" style="cursor: pointer;">
                        <h3>اسلاید
                            <strong>{{$c}}</strong>
                            {!! ($setting->status==1?'&nbsp;<span style="color:red;">(فعال)</span>':'') !!}
                        </h3>
                    </span>
                    <input type="hidden" value="{{$setting->id}}" name="slide[{{$c}}][id]" />

                <div id="slider_{{$setting->id}}" style="padding-bottom:20px;{{($setting->status==0?'display:none;':'')}}">

                    <div class="form-group-lg col-lg-8">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group rtl-input input-sx">
                              <span class="input-group-btn">
                                <a id="lfm_{{$setting->id}}" data-input="thumbnail_{{$setting->id}}" data-preview="holder_{{$setting->id}}" class="btn btn-primary">
                                  <i class="fa fa-picture-o"></i> تصویر
                                </a>
                              </span>
                                        <input id="thumbnail_{{$setting->id}}" class="form-control input-sm" type="text" value="{{$setting->image}}" name="slide[{{$c}}][image]" style="font:9pt 'courier new';text-align:left;direction:ltr;">
                                    </div>
                                    @if($setting->image=="")
                                        <img id="holder_{{$setting->id}}" style="margin-top:15px;max-height:100px;" src="/GolrangSystem-File-Manager/photos/1/default/noimage_news.png">
                                    @else
                                        <img id="holder_{{$setting->id}}" style="margin-top:15px;max-height:100px;" src="{{$setting->image}}">
                                    @endif
                                    <a class="btn btn-xs btn-danger" href="javascript:void(0)" onclick="$('#holder_{{$setting->id}}').attr('src','/GolrangSystem-File-Manager/photos/1/default/noimage_news.png');$('#thumbnail_{{$setting->id}}').val('');$(this).remove();">X</a>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="form-group">
                                {{ Form::label('title', 'عنوان') }}
                                {{ Form::text('slide['.$c.'][title]',$setting->title, array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('body', 'متن') }}
                                {{ Form::textarea('slide['.$c.'][body]', $setting->body, array('class' => 'form-control','id'=>'body_'.$setting->id)) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('link', 'لینک') }}
                                {{ Form::text('slide['.$c.'][link]', $setting->link, array('class' => 'form-control ltr-input')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('status', 'وضعیت') }}
                                {{ Form::select('slide['.$c.'][status]', ['1'=>'فعال','0'=>'غیرفعال'],$setting->status, array('class' => 'form-control')) }}
                            </div>

                    </div>
                    <div class="clearfix"></div>
                </div>
                    @php
                        $c++;
                    @endphp
                    <div class="clearfix"></div>

                </div>
                    <div class="clearfix"></div>


                @endforeach

                {{ Form::submit('ذخیره', array('class' => 'btn btn-primary')) }}
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

    <!-- jQuery UI -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/jquery-ui/jquery-ui.min.js') }}

    <!-- Custom and plugin javascript -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/rada.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/pace/pace.min.js') }}

    <!-- Sweet alert -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/sweetalert/sweetalert.min.js') }}

    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/persianDateTimePicker/jalaali.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/persianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.js') }}

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
$(document).ready(function(){
            @foreach($settings as $setting)
            $('#lfm_{{$setting->id}}').filemanager('image', {prefix: route_prefix});
            //
                // Define function to open filemanager window
                var lfm_{{$setting->id}} = function(options, cb) {
                    var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                    window.open(route_prefix + '?type=' + options.type || 'image', 'FileManager', 'width=900,height=600');
                    window.SetUrl = cb;
                };
            //
            @endforeach
            });
        });
        @foreach($settings as $setting)
        CKEDITOR.replace('body_{{$setting->id}}',{
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Files',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Files&_token='
        });
        @endforeach
       CKEDITOR.config.language = 'fa';

    </script>
@endsection

