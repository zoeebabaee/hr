@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    محتوا
@endsection

@section('header_styles')
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.bootstrap.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.responsive.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.tableTools.min.css') }}

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}

    {{ Html::script('/admin/'.config('app.admin_theme').'/css/plugins/persianDateTimePicker/bootstrap-theme.min.css') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/css/plugins/persianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.css') }}

@endsection
@section('content')
    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>مدیریت محتوا</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        خانه</a>
                </li>
                <li>
                    ایجاد محتوا
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">

                <div class="form-group-lg col-lg-6">

                        <h1><i class='fa fa-user-md'></i>&nbsp;ایجاد محتوا</h1>
                        <hr>

                        {{ Form::open(array('route' => 'contents.store','files' => true)) }}

                    <div class="form-group">
                        {{ Form::submit('ذخیره و بستن', array('class' => 'btn btn-primary','name'=>'saveAndClose')) }}
                        {{ Form::submit('ذخیره', array('class' => 'btn btn-primary','name'=>'save')) }}
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
                          <input id="thumbnail1" class="form-control input-sm" value="{{old('main_image')}}" type="text" name="main_image" style="font:9pt 'courier new';text-align:left;direction:ltr;">
                        </div>
                        <img id="holder1" style="margin-top:15px;max-height:100px;">
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-lg-6">
                        <div class="input-group rtl-input input-sx">
                          <span class="input-group-btn">
                            <a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary">
                              <i class="fa fa-picture-o"></i> تصویر بنر پین
                            </a>
                          </span>
                            <input id="thumbnail2" class="form-control input-sm" type="text" value="{{old('banner_image')}}" name="banner_image" style="font:9pt 'courier new';text-align:left;direction:ltr;">
                        </div>
                        <img id="holder2" style="margin-top:15px;max-height:100px;">
                    </div>
                </div>
                <div class="form-group-lg col-lg-12">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <div class="form-group">
                                {{ Form::label('title', 'عنوان') }}
                                {{ Form::text('title', old('title'), array('class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <div class="form-group">
                                {{ Form::label('alias', 'عنوان مستعار(مورد استفاده در لینک صفحه)') }}
                                {{ Form::text('alias', old('alias'), array('class' => 'form-control')) }}
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            {{ Form::label('body', 'متن') }}
                            <div style="color:red;padding:5px;">جهت جلوگیری از به هم ریختگی متون در سایت،هرگز نام فونت را تغییر ندهید.تغییر اندازه ی فونت مانعی ندارد.</div>
                            {{ Form::textarea('body', old('body'), array('class' => 'form-control')) }}
                        </div>
                </div>
                <div class="form-group-lg col-lg-6">

                    <div class="form-group">
                        {{ Form::label('status', 'وضعیت') }}
                        {{ Form::select('status', [1=>'منتشر شده',2=>'منتشر نشده'],null, array('class' => 'form-control')) }}
                    </div>

                        <div class="form-group">
                            {{ Form::label('comment_enable', 'سیستم نظر سنجی') }}
                            {{ Form::select('comment_enable', ['1'=>'نمایش نظرات پس از تایید مدیر','2'=>'نمایش همه ی نظرات','3'=>'غیر فعال بودن نظرات'],null, array('class' => 'form-control')) }}
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
                            {{ Form::label('external_references', 'منبع') }}
                            {{ Form::text('external_references', old('external_references'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('content_rights', 'کپی رایت') }}
                            {{ Form::text('content_rights', old('content_rights'), array('class' => 'form-control')) }}
                        </div>



                        <div class="form-group">
                            {{ Form::label('tags', 'تگ ها') }}
                            {{ Form::text('tags', old('tags'), array('class' => 'form-control','id'=>'tags')) }}
                        </div>

                        <div class="form-group">

                            {{ Form::label('cat_id', 'مجموعه') }}
                            <select class="form-control" name="cat_id" id="cat_id">

                                @foreach($categories as $category)
                                    <option value="{{ $category['id'] }}">{{ $category['value'] }}</option>
                                @endforeach
                            </select>
                        </div>

                    <div class="form-group">
                        <label class="sr-only" for="exampleInput1">از تاریخ</label>
                        <div class="input-group">
                            <div class="input-group-addon" data-mddatetimepicker="true" data-targetselector="#start_publish" data-trigger="click" data-enabletimepicker="true" data-isgregorian="false">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                            <input type="text" value="{{old('start_publish')}}" class="form-control ltr-input" id="start_publish" name="start_publish" />
                        </div>

                        تا

                        <label class="sr-only" for="exampleInput1">تا تاریخ</label>
                        <div class="input-group">
                            <div class="input-group-addon" data-mddatetimepicker="true" data-targetselector="#end_publish" data-trigger="click" data-enabletimepicker="true" data-isgregorian="false">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </div>
                            <input type="text" value="{{old('end_publish')}}" class="form-control ltr-input" id="end_publish" name="end_publish" />
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    {{ Form::submit('ذخیره و بستن', array('class' => 'btn btn-primary','name'=>'saveAndClose')) }}
                    {{ Form::submit('ذخیره', array('class' => 'btn btn-primary','name'=>'save')) }}
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
    <!-- Custom and plugin javascript -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/rada.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/pace/pace.min.js') }}
    <!-- jQuery UI -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/jquery-ui/jquery-ui.min.js') }}
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
        CKEDITOR.replace('body',{
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=file',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=file&_token='

        });
        CKEDITOR.config.language = 'fa';
        //CKEDITOR.config.removePlugins = 'font';

        var route_prefix = "{{ url(config('lfm.prefix')) }}";
        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
        $('#lfm1').filemanager('image', {prefix: route_prefix});
        $('#lfm2').filemanager('image', {prefix: route_prefix});
        $(document).ready(function(){
            // Define function to open filemanager window
            var lfm1 = function(options, cb) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                window.open(route_prefix + '?type=' + options.type || 'image', 'FileManager', 'width=900,height=600');
                window.SetUrl = cb;
            };
            var lfm2 = function(options, cb) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                window.open(route_prefix + '?type=' + options.type || 'image', 'FileManager', 'width=900,height=600');
                window.SetUrl = cb;
            };
        });

        $( function() {
            var availableTags = [
                {!! '"'.implode('","',$tags).'"'  !!}
            ];
            function split( val ) {
                return val.split( / \s*/ );
            }
            function extractLast( term ) {
                return split( term ).pop();
            }
            $( "#tags" )
            // don't navigate away from the field on tab when selecting an item
                .on( "keydown", function( event ) {
                    if ( event.keyCode === $.ui.keyCode.TAB &&
                        $( this ).autocomplete( "instance" ).menu.active ) {
                        event.preventDefault();
                    }
                })
                .autocomplete({
                    minLength: 0,
                    source: function( request, response ) {
                        // delegate back to autocomplete, but extract the last term
                        response( $.ui.autocomplete.filter(
                            availableTags, extractLast( request.term ) ) );
                    },
                    focus: function() {
                        // prevent value inserted on focus
                        return false;
                    },
                    select: function( event, ui ) {
                        var terms = split( this.value );
                        // remove the current input
                        terms.pop();
                        // add the selected item
                        terms.push( ui.item.value );
                        // add placeholder to get the comma-and-space at the end
                        terms.push( "" );
                        this.value = terms.join( " " );
                        return false;
                    }
                });
        } );

    </script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-menu-item-wrapper{
            font:12pt 'B Nazanin';background: #efefef;

        }
    </style>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@endsection
