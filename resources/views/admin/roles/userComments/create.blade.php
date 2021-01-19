@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    محتوا
@endsection

@section('header_styles')
    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}
@endsection
@section('content')


    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>ارزیابی</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        خانه</a>
                </li>
                <li>
                    ثبت نتیجه ارزیابی
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
                <div class="form-group-lg col-lg-12">

                    <h1><i class='fa fa-user-md'></i>&nbsp;ثبت نتیجه ارزیابی</h1>
                    <hr>

                    {{ Form::open(array('route' => 'UserComment.store','files' => true)) }}
                    {{csrf_field()}}
                    <div class="form-group">
                        {{ Form::submit('ذخیره', array('class' => 'btn btn-primary')) }}
                        {{ Form::button('انصراف', array('class' => 'btn btn-warning','onclick'=>'history.back()')) }}
                        <div class="clearfix"><p></p><p></p></div>
                    </div>

                    <div class="form-group">
                        {{ Form::label('comment', 'نتیجه') }}
                        {{ Form::textarea('comment', old('comment'), array('class' => 'form-control')) }}
                    </div>

                </div>
                <input type="hidden" name="user_id" value = "{{$apply->user->id}}">
                <input type="hidden" name="admin_id" value = "{{auth()->user()->id}}">
                <input type="hidden" name="job_id" value = "{{$apply->job->id}}">

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

    <!-- jQuery UI -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/jquery-ui/jquery-ui.min.js') }}
    <!-- Custom and plugin javascript -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/rada.js') }}


    <script src="//cdn.ckeditor.com/4.7.1/full-all/ckeditor.js"></script>

@endsection
@section('scripts_page')
    <script>
        $(document).ready(function () {
            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }
        });
        CKEDITOR.replace('comment',{
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Files',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Files&_token='

        });
        CKEDITOR.config.language = 'fa';
        CKEDITOR.config.removePlugins = 'font';
    </script>
@endsection
