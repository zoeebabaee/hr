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

    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/chosen/chosen.css') }}

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
                    فرآیند جذب
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">

                {{ Form::model(null, ['route' => ['absorption-process.update'], 'method' => 'PUT','class'=>'form','files' => true]) }}

                <div class="form-group">
                    {{ Form::label('central_office', 'فیلتر اولیه') }}
                    {{ Form::textarea('boxes[0]',$var['0'], array('class' => 'form-control','id'=>'body1')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('contact_us', 'فیلتر ثانویه') }}
                    {{ Form::textarea('boxes[1]',$var['1'], array('class' => 'form-control','id'=>'body2')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('work_time', 'مصاحبه تلفنی') }}
                    {{ Form::textarea('boxes[2]',$var['2'], array('class' => 'form-control ltr-input','id'=>'body3')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('links', 'ارزیابی') }}
                    {{ Form::textarea('boxes[3]',$var['3'], array('class' => 'form-control ltr-input','id'=>'body4')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('links', 'انجام آزمون های شناختی و مهارتی') }}
                    {{ Form::textarea('boxes[4]',$var['4'], array('class' => 'form-control ltr-input','id'=>'body6')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('links', 'مصاحبه با معاونت') }}
                    {{ Form::textarea('boxes[5]',$var['5'], array('class' => 'form-control ltr-input','id'=>'body5')) }}
                </div>


                <div class="form-group">
                    {{ Form::label('links', 'مصاحبه با مدیرعامل') }}
                    {{ Form::textarea('boxes[6]',$var['6'], array('class' => 'form-control ltr-input','id'=>'body7')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('links', 'تدارک مقدمات شروع همکاری') }}
                    {{ Form::textarea('boxes[7]',$var['7'], array('class' => 'form-control ltr-input','id'=>'body8')) }}
                </div>

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

    <!-- Chosen -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/chosen/chosen.jquery.js') }}

    <script src="//cdn.ckeditor.com/4.7.1/full-all/ckeditor.js"></script>

@endsection
@section('scripts_page')
    <script>
        $(document).ready(function () {
            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }
            var config = {
                '.chosen-select': {},
                '.chosen-select-deselect': {
                    allow_single_deselect: true
                },
                '.chosen-select-no-single': {
                    disable_search_threshold: 10
                },
                '.chosen-select-no-results': {
                    no_results_text: 'Oops, nothing found!'
                },
                '.chosen-select-width': {
                    width: "95%"
                }
            };
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
        });

        CKEDITOR.replace('body1',{
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Files',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Files&_token='
        });
        CKEDITOR.replace('body2',{
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Files',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Files&_token='
        });
        CKEDITOR.replace('body3',{
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Files',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Files&_token='
        });
        CKEDITOR.replace('body4',{
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Files',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Files&_token='
        });
        CKEDITOR.replace('body5',{
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Files',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Files&_token='
        });
        CKEDITOR.replace('body6',{
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Files',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Files&_token='
        });
        CKEDITOR.replace('body7',{
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Files',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Files&_token='
        });
        CKEDITOR.replace('body8',{
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Files',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Files&_token='
        });

        CKEDITOR.config.language = 'fa';



    </script>
@endsection

