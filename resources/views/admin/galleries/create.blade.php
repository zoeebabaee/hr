@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
گالری
@endsection

@section('header_styles')

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.bootstrap.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.responsive.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.tableTools.min.css') }}

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}

    {{ Html::script('/admin/'.config('app.admin_theme').'/css/plugins/persianDateTimePicker/bootstrap-theme.min.css') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/css/plugins/persianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.css') }}

    {{ Html::style('/admin/'.config('app.admin_theme').'/css/fontawesome-iconpicker.min.css') }}

    {{ Html::script('/admin/'.config('app.admin_theme').'/css/plugins/persianDateTimePicker/bootstrap-theme.min.css') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/css/plugins/persianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.css') }}

@endsection
@section('content')

    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>مدیریت تصاویر گالری</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        خانه</a>
                </li>
                <li>
                    ایجاد آیتم گالری
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">

                <div class="form-group-lg col-lg-12">

                    <h1><i class='fa fa-user-md'></i>&nbsp;ایجاد آیتم گالری</h1>
                    <hr>

                    {{ Form::open(array('route' => 'gallery.store')) }}


                    <div class="form-group">
                        {{ Form::submit('ذخیره', array('class' => 'btn btn-primary')) }}
                        {{ Form::button('انصراف', array('class' => 'btn btn-warning','onclick'=>'history.back()')) }}
                        <div class="clearfix"><p></p><p></p></div>
                    </div>

                    <div class="form-group-lg col-lg-12">
                        <div class="row">

                            <!--############# IMAGE START ############# -->
                            <div class="col-lg-6">
                                <div class="input-group rtl-input input-sx">
                                  <span class="input-group-btn">
                                    <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                      <i class="fa fa-picture-o"></i> تصویر
                                    </a>
                                  </span>
                                    <input id="thumbnail1" class="form-control input-sm" type="text" value="{{old('img')}}" name="img" style="font:9pt 'courier new';text-align:left;direction:ltr;">
                                </div>

                                <img id="holder1" style="margin-top:15px;max-height:100px;" src="{{old('img')?old('img'):'/GolrangSystem-File-Manager/photos/1/default/noimage_news.png'}}">
                                <a class="btn btn-xs btn-danger" href="javascript:void(0)" onclick="$('#holder1').attr('src','/GolrangSystem-File-Manager/photos/1/default/noimage_news.png');$('#thumbnail1').val('');$(this).remove();">X</a>
                            </div>
                            <div class="clearfix"></div>
                            <!--############# IMAGE END  ############# -->
                            <div class="form-group col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('link', 'لینک') }}
                                    <div style="color:red;padding:5px;">http://example.com</div>
                                    {{ Form::text('link', old('link'), array('class' => 'form-control')) }}
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('name', 'عنوان') }}
                                    <div style="color:red;padding:5px;">ترجیحا یک عنوان کوتاه انتخاب کنید</div>
                                    {{ Form::text('name', old('name'), array('class' => 'form-control')) }}
                                </div>
                            </div>

                        </div>
                        <div class="form-group col-lg-12">
                            {{ Form::label('body', 'متن') }}
                            <div style="color:red;padding:5px;">جهت جلوگیری از به هم ریختگی متون در سایت،هرگز نام فونت را تغییر ندهید.تغییر اندازه ی فونت مانعی ندارد.</div>
                            {{ Form::textarea('body',old('body'), array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('cat_id', 'مجموعه') }}
                        <select class="form-control" name="cat_id" id="cat_id">
                            <option value="" >انتخاب کنید</option>
                            @foreach(\HR\GalleryCategory::all() as $cat)
                                <option value="{{ $cat->id }}" {{  ($cat->id==old('cat_id')?'selected':'') }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="clearfix"></div>

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

            <script src="/vendor/ck/ckeditor.js"></script>

        @endsection
        @section('scripts_page')
            <script>
                $(document).ready(function () {
                    if ($("#alert_messages_div")) {
                        setTimeout('$("#alert_messages_div").remove();', 6000);
                    }
                });
            </script>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <style>
                .ui-menu-item-wrapper{
                    font:12pt 'B Nazanin';background: #efefef;

                }
            </style>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            {{ Html::script('/admin/'.config('app.admin_theme').'/js/fontawesome-iconpicker.min.js') }}

            <script>
                $(function() {
                    $('.icp').iconpicker({
                        //title: 'Dropdown with picker',
                        //component:'.btn > i'
                    });
                });


            </script>

            {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/persianDateTimePicker/jalaali.js') }}
            {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/persianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.js') }}

            <script src="/vendor/ck/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('body',{
                    filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
                    filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
                    filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=file',
                    filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=file&_token='

                });
                CKEDITOR.config.language = 'fa';

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

            </script>

@endsection
