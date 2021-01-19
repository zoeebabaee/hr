@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت تایم لاین
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}

@endsection
@section('content')

    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>تایم لاین</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        خانه</a>
                </li>
                <li  class="active">
                    <a><strong>
                            لیست آیتم های تایم لاین</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">

        <div class="row">

          <div class="col-lg-12">

                <a href="{{ route('timeLine.create') }}" class="btn btn-info"><i class="fa fa-newspaper-o"></i>
                    &nbsp;&nbsp;
                    جدید</a>

                <br><br>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" >
                        <thead>
                        <tr>
                            <th>آیکن</th>
                            <th>عنوان</th>
                            <th>تاریخ</th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($timeLine as $time_line)


                            <tr class="gradeX">

                                <td>
                                    <i class="fa {{$time_line->icon}}"></i>
                                </td>
                                <td><strong>{{$time_line->title}}</strong></td>

                                <td>
                                    {{$time_line->when}}
                                </td>
                                <td style="white-space: nowrap;width:170px;">

                                        <a href="{{ route('timeLine.edit', $time_line->id) }}" class="btn btn-info btn-sm pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i></a>

                                        <a href="javascript:void(0);" cat_id="{{$time_line->id}}" route="{{route('timeLine.destroy', $time_line->id)}}"  class="btn btn-info btn-sm pull-left btn btn-danger btn-sm pull-left confirm_alert" style="margin-right: 3px;"><i class="fa fa-trash"></i></a>

                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                    {{--{!! $time_line->links() !!}--}}

                </div>

                <a href="{{ route('timeLine.create') }}" class="btn btn-info"><i class="fa fa-newspaper-o"></i>
                    &nbsp;&nbsp;
                    جدید</a>


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