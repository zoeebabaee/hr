@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مجموعه ها
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
            <h2>مدیریت مجموعه ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        خانه</a>
                </li>
                <li>
                    ویرایش مجموعه
                </li>
                <li  class="active">
                    <a><strong>{{$cat->title}}</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">

                <div class="form-group-lg col-lg-12">
                    @if(isset($cat))
                        <h1><i class='fa fa-user-md'></i>&nbsp;ویرایش مجموعه</h1>
                        <hr>

                        {{ Form::model($cat, ['route' => ['content_categories.update', $cat->id], 'method' => 'PUT','class'=>'form','files' => true]) }}

                        <div class="form-group">
                            {{ Form::submit('ذخیره', array('class' => 'btn btn-primary')) }}
                            {{ Form::button('انصراف', array('class' => 'btn btn-warning','onclick'=>'history.back()')) }}
                            <div class="clearfix"><p></p><p></p></div>
                        </div>

                        <div class="col-lg-6">
                            <div class="input-group rtl-input input-sx">
                          <span class="input-group-btn">
                            <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                              <i class="fa fa-picture-o"></i> تصویر اصلی
                            </a>
                          </span>
                                <input id="thumbnail1" class="form-control input-sm" type="text" value="{{$cat->image}}" name="image" style="font:9pt 'courier new';text-align:left;direction:ltr;">
                            </div>
                            @if($cat->image=="")
                                <img id="holder1" style="margin-top:15px;max-height:100px;" src="/GolrangSystem-File-Manager/photos/1/default/noimage_news.png">
                            @else
                                <img id="holder1" style="margin-top:15px;max-height:100px;" src="{{$cat->image}}">
                            @endif
                            <a class="btn btn-xs btn-danger" href="javascript:void(0)" onclick="$('#holder1').attr('src','/GolrangSystem-File-Manager/photos/1/default/noimage_news.png');$('#thumbnail1').val('');$(this).remove();">X</a>
                        </div>

                    <div class="clearfix"></div>

                        <div class="form-group">
                            {{ Form::label('title', 'عنوان') }}
                            {{ Form::text('title', old('title'), array('class' => 'form-control')) }}
                        </div>


                        <div class="form-group">
                            {{ Form::label('body', 'متن') }}
                            {{ Form::textarea('body', old('body'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('status', 'وضعیت') }}
                            {{ Form::select('status', [1=>'منتشر شده',2=>'منتشر نشده',3=>'حذف شده'],$cat->status, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('layout', 'Layout') }}
                            {{ Form::select('layout', ['News'=>'news','Blog'=>'blog','Events'=>'events'],$cat->layout, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('comment_enable', 'فعال بودن نظرات') }}
                            {{ Form::select('comment_enable', ['0'=>'خیر','1'=>'بله'],$cat->comment_enable, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('meta_keywords', 'کلمات کلیدی') }}
                            {{ Form::textarea('meta_keywords', old('meta_keywords'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('meta_description', 'توضیحات برای سئو') }}
                            {{ Form::textarea('meta_description', old('meta_description'), array('class' => 'form-control')) }}
                        </div>


                        <div class="form-group">

                            {{ Form::label('parent_id', 'مجموعه ریشه') }}

                            <select class="form-control" name="parent_id" id="parent_id">
                                <option value="" >انتخاب کنید</option>
                                <option value="" {{  ($cat->parent_id==''?'selected':'') }}>ریشه</option>
                                @foreach($parents as $parent)
                                    <option value="{{ $parent['id'] }}" {{  ($parent['id']==$cat->parent_id?'selected':'') }}>{{ $parent['value'] }}</option>
                                @endforeach
                            </select>

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

    <script src="//cdn.ckeditor.com/4.7.1/full-all/ckeditor.js"></script>

@endsection
@section('scripts_page')
    <script>
        $(document).ready(function () {
            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }
        });
        CKEDITOR.replace('body',{
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Files',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Files&_token='

        });
        CKEDITOR.config.language = 'fa';
        CKEDITOR.config.removePlugins = 'font';

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

    </script>
@endsection
