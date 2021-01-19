@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    ایجاد شرکت جدید
@endsection

@section('header_styles')
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.bootstrap.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.responsive.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.tableTools.min.css') }}
    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}

    {{ Html::script('/admin/'.config('app.admin_theme').'/css/plugins/persianDateTimePicker/bootstrap-theme.min.css') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/css/plugins/persianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.css') }}

    {{ Html::style('/vendor/chosen/chosen.css') }}

    <style>
        .tag_word {
            padding: 8px;
            border: 1px #999 solid;
            border-radius: 3px;
            margin: 2px;
            width: auto;
            position: relative;
            background: #ffffff;
            float: right;
            color: #000000;
        }
    </style>
    <script>
        function tag_delete(id, v) {

            var vvv = $('#job_general_merites').val();
            var vv = vvv.replace(v, "");
            $('#job_general_merites').val(vv);
            $('#tag_' + id).remove();
        }

        function tag_delete2(id, v) {
            var vvv = $('#job_professional_merites').val();
            var vv = vvv.replace(v, "");
            $('#job_professional_merites').val(vv);
            $('#tag2_' + id).remove();
        }
    </script>


@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>شرکت ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="index-2.html">
                        خانه</a>
                </li>
                <li class="active">
                    <a><strong>افزودن شرکت جدید</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">

                <h1><i class="fa fa-industry" aria-hidden="true"></i> افزودن شرکت </h1>
                <hr>

                {{ Form::open(array('route' => 'companies.store')) }}

                <div class="form-group">
                    {{ Form::submit('ذخیره', array('class' => 'btn btn-primary')) }}
                    {{ Form::button('انصراف', array('class' => 'btn btn-warning','onclick'=>'history.back()')) }}
                    <div class="clearfix"><p></p>
                        <p></p></div>
                </div>

                <div class="clearfix"></div>

                <div class="form-group">
                    {{ Form::label('name', 'نام شرکت')}}
                    {{ Form::text('name', old('name'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group col-lg-12">
                    <label for="gig_company_id">انتخاب از بین لیست شرکت های گروه صنعتی گلرنگ</label>
                    <select name="gig_company_id" id="admins" data-placeholder="انتخاب کنید"
                            class="form-control chosen">
                        @foreach($gig_all_companies as $item)
                            <option @if(old('gig_company_id') && old('gig_company_id') == $item['id'] ) selected
                                    @endif value="{{$item['id']}}">{{$item['title']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-lg-12">
                    <label for="admins">ادمین های شرکت</label>
                    <select name="admins[]" multiple id="admins" data-placeholder="انتخاب کنید"
                            class="form-control chosen">
                        @foreach($users as $user)
                            <option @if(old('admins') && in_array($user->id,old('admins'))) selected
                                    @endif value="{{$user->id}}">{{$user->first_name.' '.$user->last_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="clearfix"></div>

                <div class="form-group">
                    <div class="col-lg-6">

                        <div class="input-group rtl-input input-sx">
                                  <span class="input-group-btn">
                                    <a id="lfm1" data-input="thumbnail3" data-preview="holder2" class="btn btn-primary">
                                      <i class="fa fa-picture-o"></i>انتخاب عکس
                                    </a>
                                  </span>
                            <input id="thumbnail3" class="form-control input-sm" type="text" value="" name=""
                                   style="font:9pt 'courier new';text-align:left;direction:ltr;">
                        </div>

                        <img id="holder2" style="margin-top:15px;max-height:100px;margin-bottom:5px;"
                             src="/GolrangSystem-File-Manager/photos/1/default/noimage_news.png">
                        <br>
                        <a class="btn btn-xs btn-danger" href="javascript:void(0)"
                           onclick="$('#holder2').attr('src','/GolrangSystem-File-Manager/photos/1/default/noimage_news.png');$('#thumbnail3').val('');">X</a>
                        <a class="btn btn-xs btn-success" href="javascript:void(0);" onclick="ajax_save_job_image();"><i
                                    class="fa fa-save"></i></a>

                        <div id="selected_images_div" style="padding:5px;margin:5px;border:1px #888 dotted;"></div>

                    </div>
                </div>

                <div class="form-group-lg col-lg-6">


                    <div id="map" style="height:300px;"></div>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvbyP2uW25ObbnMrIYKYdbQZml2GdWqgY&callback=initMap"
                            type="text/javascript"></script>
                    <script>
                        google.maps.event.addDomListener(window, 'load', init);

                        function init() {
                            var mapOptions = {
                                zoom: 16,
                                center: new google.maps.LatLng(35.735789, 51.416606),
                                styles: []
                            };
                            var mapElement = document.getElementById('map');
                            var map = new google.maps.Map(mapElement, mapOptions);
                            var markers = [];
                            google.maps.event.addListener(map, 'click', function (event) {
                                $('#LatLng').val(event.latLng.lat() + ',' + event.latLng.lng());
                                var marker = new google.maps.Marker({
                                    position: new google.maps.LatLng(event.latLng.lat(), event.latLng.lng()),
                                    map: map,
                                    title: 'اینجا را انتخاب کرده اید'
                                });
                                removeMarkers();
                                markers.push(marker);
                            });

                            function removeMarkers() {
                                for (i = 0; i < markers.length; i++) {
                                    markers[i].setMap(null);
                                }
                            }
                        }
                    </script>


                    {{ Form::label('LatLng', 'Lat-Lng')}}
                    {{ Form::text('LatLng', old('LatLng'), array('class' => 'form-control ltr-input')) }}
                </div>

                <div class="clearfix"></div>

                <br><br>
                <textarea id="selected_images_field" name="images" style="display: none;"></textarea>
                <div class="form-group">
                    {{ Form::submit('ذخیره', array('class' => 'btn btn-primary')) }}
                    {{ Form::button('انصراف', array('class' => 'btn btn-warning','onclick'=>'history.back()')) }}
                    <div class="clearfix"><p></p>
                        <p></p></div>
                </div>
                {{ Form::close() }}

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

            <!-- Chosen -->
            {{ Html::script('/vendor/chosen/chosen.jquery.js') }}
            <script src="/vendor/ck/ckeditor.js"></script>
            @endsection

            @section('scripts_page')

                <script>
                    $(document).ready(function () {
                        $(".chosen").chosen({rtl: true});

                    });
                    var cc = 0;

                    function ajax_save_job_image() {

                        if ($('#selected_images_clearfix')) {
                            $('#selected_images_clearfix').remove();
                        }
                        var selected_image = $('#thumbnail3').val();
                        var current_selected_images = $('#selected_images_field').val();
                        if (selected_image != "") {

                            current_selected_images = current_selected_images + ',' + selected_image;

                            $('#selected_images_field').val(current_selected_images);
                            cc++;
                            $('#selected_images_div').append('' +
                                '<div id="selected_image_' + cc + '" style="margin:2px;float:right;">' +
                                '<img src="' + selected_image + '" style="width:150px;margin:2px;"/>' +
                                '<br>' +
                                '<a href="javascript:void(0);" onclick="selected_image_delete(\'selected_image_' + cc + '\',\'' + selected_image + '\')">' +
                                'حذف' +
                                '</a>' +
                                '</div>' +
                                '');

                            $('#selected_images_div').append('<div id="selected_images_clearfix" class="clearfix"></div>');
                            $('#holder2').attr('src', '/GolrangSystem-File-Manager/photos/1/default/noimage_news.png');
                            $('#thumbnail3').val('');

                        } else {
                            $('#selected_images_div').append('<div id="selected_images_clearfix" class="clearfix"></div>');
                        }
                    }

                    function selected_image_delete(id, image_path) {
                        var ss = window.confirm('از حذف این تصویر مطمئن هستید؟');
                        if (ss) {
                            $('#' + id).remove();
                            var current_selected_images = $('#selected_images_field').val();
                            current_selected_images = current_selected_images.replace(image_path, '');
                            $('#selected_images_field').val(current_selected_images);
                        }
                    }

                    var route_prefix = "{{ url(config('lfm.prefix')) }}";
                    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
                    $('#lfm1').filemanager('image', {prefix: route_prefix});
                    $('#lfm').filemanager('image', {prefix: route_prefix});
                    $(document).ready(function () {

                        // Define function to open filemanager window
                        var lfm1 = function (options, cb) {
                            var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                            window.open(route_prefix + '?type=' + options.type || 'image', 'FileManager', 'width=900,height=600');
                            window.SetUrl = cb;
                        };
                        var lfm = function (options, cb) {
                            var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                            window.open(route_prefix + '?type=' + options.type || 'image', 'FileManager', 'width=900,height=600');
                            window.SetUrl = cb;
                        };
                    });

                    $(document).ready(function () {
                        if ($("#alert_messages_div")) {
                            setTimeout('$("#alert_messages_div").remove();', 6000);
                        }
                    });
                    CKEDITOR.replace('body', {
                        filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
                        filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images=',
                        filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=file',
                        filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=file='

                    });
                    $('#selected_images_field').val('');
                    CKEDITOR.config.language = 'fa';


                </script>

                <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
                <style>
                    .ui-menu-item-wrapper {
                        font: 12pt 'B Nazanin';
                        background: #efefef;

                    }
                </style>
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

@endsection
