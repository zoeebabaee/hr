@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    لیست درخواست ها
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}

@endsection
@section('content')

    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>لیست درخواست های «{{ $user->first_name.' '.$user->last_name }}»</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        خانه</a>
                </li>
                <li class="active">
                    <a><strong>
                            لیست سوالات</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">

        <div class="row">

            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>کد درخواست</th>
                            <th>شغل درخواستی</th>
                            <th>شرکت</th>
                            <th>تاریخ آخرین بررسی</th>
                            <th>وضعیت درخواست</th>
                            <th> دلیل رد رزومه</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $app_status = config('app.enum_apply_status');
                            
                        @endphp
                        @foreach($applies as $apply)
                            <tr class="gradeX">
                                <td>{{$apply->id}}</td>
                                <td><a target="_blank" href="/jobs/{{$apply->job->alias}}">{{$apply->job->title}}</a> </td>
                                <td>{{$apply->job->company->name}}</td>
                                <td>{{JDate::createFromCarbon(Carbon::parse($apply->updated_at))->format('Y/m/d')}}</td>
                                <td>{{$app_status[$apply->status]}} @if($apply->deleted_at) <span style="color: red">(حذف شده توسط کاربر)</span> @endif</td>
                                <td>{{$apply->reason->reason}} @if($apply->reject_description) - {{$apply->reject_description}} @endif</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--{!! $faq->links() !!}--}}
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="myModal_reject_popup" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            {!! Form::open(['method' => 'POST', 'route' => ['faqs.reject',0]]) !!}
            <input type="hidden" name="id" id="content_id" value=""/>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">دلیل رد شدن را درج فرمایید:</h4>
                </div>
                <div class="modal-body">
                    <p>
                        <textarea name="reject_text" class="form-control" style="height: 150px;"></textarea>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">انجام</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal_reject_text_show" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">دلیل رد شدن:</h4>
                </div>
                <div class="modal-body">
                    <p>
                        <span id="reject_text"></span>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
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
@section('scripts_page')

    <script>
        $(document).ready(function () {

            $('.confirm_alert').click(function () {
                var $_this = $(this);
                swal({
                        title: "مطمئنید؟",
                        text: "در صورت تایید ، این اطلاعات برای همیشه حذف می شوند\r\nبا حذف مجموعه والد، زیرمجموعه های آن ها نیز حذف می شوند",
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
                                data: 'cat=' + cat_id + '&_token={{csrf_token()}}',
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
            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }
        });

    </script>

@endsection
