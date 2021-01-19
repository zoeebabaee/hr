@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت پیام ها
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}

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
                        نمایش متن پیغام
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
                        متن پیغام
                    </h2>
                    <div class="mail-tools tooltip-demo m-t-md">
                    </div>
                </div>

                <div class="mail-box-header">

                    <h2>
                        مشاهده پیام
                    </h2>
                    <div class="mail-tools tooltip-demo m-t-md">

                        <h3>
                            <span class="font-noraml">موضوع: </span>{{$message->subject}}
                        </h3>
                        <h5>
                            <span class="pull-right font-noraml">{{JDate::createFromCarbon(Carbon::parse($message->created_at))->format('l j F Y , H:i')}}</span>
                            <br>
                            <span class="font-noraml">از طرف: </span>{{$message->sender_user->first_name.' '.$message->sender_user->last_name}}
                        </h5>
                    </div>
                </div>
                <div class="mail-box">


                    <div class="mail-body">
                        <p>
                            {!! $message->body !!}
                        </p>
                    </div>
                    <div class="mail-body text-right tooltip-demo">
                        @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() != 'messages.sent')
                            <a class="btn btn-sm btn-white" href="{{route('messages.reply',$message->id)}}"><i class="fa fa-reply"></i> پاسخ</a>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
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

    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/datapicker/bootstrap-datepicker.js') }}
@endsection