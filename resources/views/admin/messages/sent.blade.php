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
                            پیام های ارسالی</strong></a>
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

                            <form method="post" action="#" class="pull-left mail-search">
                                <div class="input-group">
                                    <input type="text" class="form-control input-sm" name="search" placeholder=" جستجو ایمیل">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            جستجو
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <h2>
                                صندوق ارسال (
                                {{$messages->where('read_at',null)->count()}}
                                )
                            </h2>
                            <div class="mail-tools tooltip-demo m-t-md">

                            </div>
                        </div>
                        <div class="mail-box">



                            <table class="table table-hover table-mail">
                                <tbody>
                                @foreach($messages as $message)
                                    <tr class="{{($message->read_at==null?'unread':'read')}}">
                                        <td class="check-mail">
                                            <input type="checkbox" class="i-checks">
                                        </td>
                                        <td class="mail-contact"><a href="#">{{$message->sender_user->first_name.' '.$message->sender_user->last_name}}</a></td>
                                        <td class="mail-subject"><a href="{{route('messages.show',$message->id)}}">{{$message->subject}}</a></td>
                                        @if(isset($message->attachment) && !empty($message->attachment))
                                            <td class=""><i class="fa fa-paperclip"></i></td>
                                        @endif
                                        <td class="text-right mail-date">
                                            {{JDate::createFromCarbon(Carbon::parse($message->created_at))->format('l j F , H:i')}}

                                            <a href="javascript:void(0);" cat_id="{{$message->id}}" route="{{route('messages.destroy', $message->id)}}"  class="btn btn-info btn-sm pull-left btn btn-danger btn-sm pull-left confirm_alert" style="margin-right: 3px;"><i class="fa fa-trash"></i></a>
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

    <script>
        $(document).ready(function () {
            $('.confirm_alert').click(function () {
                var $_this = $(this);
                swal({
                        title: "مطمئنید؟",
                        text: "این پیغام حذف خواهد شد",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "بله ، حذف شود",
                        cancelButtonText: "خیر ، منصرف شدم",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            var cat_id = $_this.attr('cat_id');
                            $.ajax({

                                type: "DELETE",
                                url: $_this.attr('route'),
                                data: 'message=' + cat_id + '&_token={{csrf_token()}}',
                                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                                complete: function (data) {
                                    swal("حذف شد", "اطلاعات مورد نظر شما حذف شدند", "success");
                                    setTimeout('location.reload();', 1500);
                                }
                            });
                        } else {
                            swal("منصرف شدم", "اطلاعات شما حذف نشدند", "error");
                        }
                    });
            });
        });
    </script>

@endsection