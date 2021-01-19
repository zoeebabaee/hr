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
                            پیام های حذف شده</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">

        <div class="row">

            <div class="wrapper wrapper-content">
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
                                حذف شده ها
                            </h2>
                            <div class="mail-tools tooltip-demo m-t-md">
                                {{--
                                <div class="btn-group pull-left">
                                    <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>
                                    <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>

                                </div>

                                <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> تازه کردن</button>
                                <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as read"><i class="fa fa-eye"></i> </button>

                                <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="حذف انتخاب شده ها"><i class="fa fa-trash-o"></i> </button>--}}

                            </div>
                        </div>
                        <div class="mail-box">



                            <table class="table table-hover table-mail">
                                <tbody>

                                @foreach($messages as $message)

                                    <tr class="{{($message->read_at==null?'unread':'read')}}">
                                        {{--<td class="check-mail">
                                            <input type="checkbox" class="i-checks">
                                        </td>--}}
                                        <td class="mail-contact"><a href="#">{{$message->sender_user->first_name.' '.$message->sender_user->last_name}}</a></td>
                                        <td class="mail-subject"><a href="{{route('messages.show',$message->id)}}">{{$message->subject}}</a></td>
                                        @if(isset($message->attachment) && !empty($message->attachment))
                                            <td class=""><i class="fa fa-paperclip"></i></td>
                                        @endif
                                        <td class="text-right mail-date">
                                            {{JDate::createFromCarbon(Carbon::parse($message->created_at))->format('l j F , H:i')}}
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <span style="float:left">
                                            {!! Form::open(['method' => 'POST', 'route' => ['messages.restore', $message->id] ]) !!}
                                            {!! Form::button('<i class="fa fa-undo"></i>', ['type'=>'submit','class' => 'btn btn-primary btn-sm']) !!}
                                            {!! Form::close() !!}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                        </div>
                    </div>
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

    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/datapicker/bootstrap-datepicker.js') }}
@endsection