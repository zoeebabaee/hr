@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت پیام ها
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}

    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/summernote/summernote.css') }}

@endsection
@section('content')
    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>محتوا</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        خانه</a>
                </li>
                <li  class="active">
                    <a><strong>
                            ارسال پیام ها
                        </strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">

        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content mailbox-content">
                        <div class="file-manager">
                            <div class="space-25"></div>
                            <h5>فولدرها</h5>

                            @include('admin.messages.folders')

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 animated fadeInRight">

                <div class="mail-box-header">

                    <h2>
                        نوشتن پیام
                    </h2>
                    <div class="mail-tools tooltip-demo m-t-md">
                        {{--
                        <div class="btn-group pull-left">
                            <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>
                            <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>

                        </div>

                        <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> تازه کردن</button>
                        <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as read"><i class="fa fa-eye"></i> </button>
                         --}}
                    </div>
                </div>

                <div class="mail-box-header">

                    <h2>
                        نوشتن پیام
                    </h2>
                    <div class="mail-tools tooltip-demo m-t-md">


                        <h3>
                            <span class="font-noraml">موضوع: </span> {{$message->subject}}
                        </h3>
                        <h5>
                            <span class="pull-right font-noraml">{{JDate::createFromCarbon(Carbon::parse($message->created_at))->format('l j F Y , H:i')}}</span>
                            <br>
                            <span class="font-noraml">از طرف: </span>{{Auth::user()->first_name.' '.Auth::user()->last_name}}
                        </h5>
                    </div>
                </div>

                <div class="mail-box">

                    {{ Form::open(array('route' => 'messages.store','files' => true)) }}

                    <div class="mail-body">

                            <div class="form-group"><label class="col-sm-2 control-label">به:</label>

                                <div class="col-sm-10"><input type="text" disabled class="form-control" value="{{$message->reciver_user->first_name.' '.$message->sender_user->last_name.' ('.$message->sender_user->mobile.')'}}">
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">موضوع:</label>

                                <div class="col-sm-10"><input name="subject" id="subject" disabled type="text" class="form-control" value="{{$message->subject}}"></div>
                            </div>


                    </div>

                    <div class="mail-text">

                        <textarea name="body" id="body" class="form-control" style="height:300px;">
پاسخ را اینجا بنوسید...
                            {{"\n"}}
                            ----------------------------------------------------------------
                            {{"\n"}}
                            از: {{$message->receiver_user->first_name.' '.$message->sender_user->last_name}} {{"\n"}}
                            به: {{$message->sender_user->first_name.' '.$message->sender_user->last_name}} {{"\n"}}
                            موضوع: {{$message->subject}} {{"\n"}}
                            تاریخ:
                            {{JDate::createFromCarbon(Carbon::parse($message->created_at))->format('Y/m/d ساعت H:i A')}}

                            {{"\n"}}
                            {{$message->body}} {{"\n"}}
                        </textarea>
                        <br>

                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="mail-body text-left tooltip-demo">

                        {{ Form::submit('ارسال', array('class' => 'btn btn-primary')) }}

                        <a href="{{route('messages.inbox')}}" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> انصراف</a>

                    <div class="clearfix"></div>

                </div>

                    <div class="clearfix"></div>
                    <input type="hidden" name="receiver" disabled  value="{{$message->sender_user->id}}" />
                    <input type="hidden" name="subject" disabled  value="{{$message->subject}}" />

                    {{Form::close()}}
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

    <!--### Jalali Popup Calendar.MMKIA ###-->
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/jalali.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/calendar.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/calendar-setup.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/lang/calendar-fa.js') }}
@endsection
@section('scripts_page')
    <!-- SUMMERNOTE -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/summernote/summernote.min.js') }}
    <script>
        $(document).ready(function(){

            $('.summernote').summernote();
            $('.note-toolbar .note-image, .note-toolbar .note-help, .note-toolbar .note-video .dropdown-menu li:first, .note-toolbar .note-line-height').remove();

            var route_prefix = "{{ url(config('lfm.prefix')) }}";
            {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
            $('#lfm1').filemanager('file', {prefix: route_prefix});
            $(document).ready(function(){
                // Define function to open filemanager window
                var lfm1 = function(options, cb) {
                    var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                    window.open(route_prefix + '?type=' + options.type || 'image', 'FileManager', 'width=900,height=600');
                    window.SetUrl = cb;
                };
            });

        });
    </script>
@endsection