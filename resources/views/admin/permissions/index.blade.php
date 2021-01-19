@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت نقش ها
@endsection

@section('header_styles')

    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.bootstrap.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.responsive.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/dataTables/dataTables.tableTools.min.css') }}

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}

@endsection
@section('content')
    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>مدیریت نقش ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('home')}}">
                        خانه</a>
                </li>
                <li  class="active">
                    <a><strong>
                            لیست دسترسی ها</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">

                <h1><i class="fa fa-key"></i>&nbsp;دسترسی های موجود
                </h1>

                <a href="{{ route('permissions.create') }}" class="btn btn-success">افزودن دسترسی جدید</a>
                <br><br>
                <div class="table-responsive col-lg-4">
                    <table class="table table-bordered table-striped">

                        <thead>
                        <tr>
                            <th>دسترسی ها</th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permissions[0] as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info btn-sm pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i></a>

                                    <a href="javascript:void(0);" permission_id="{{$permission->id}}" route="{{route('permissions.destroy', $permission->id)}}"  class="btn btn-info btn-sm btn btn-danger btn-sm pull-left confirm_alert" style="margin-right: 3px;"><i class="fa fa-trash"></i></a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="table-responsive col-lg-4">
                    <table class="table table-bordered table-striped">

                        <thead>
                        <tr>
                            <th>دسترسی ها</th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permissions[1] as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info btn-sm pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i></a>

                                    <a href="javascript:void(0);" permission_id="{{$permission->id}}" route="{{route('permissions.destroy', $permission->id)}}"  class="btn btn-info btn-sm btn btn-danger btn-sm pull-left confirm_alert" style="margin-right: 3px;"><i class="fa fa-trash"></i></a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="table-responsive col-lg-4">
                    <table class="table table-bordered table-striped">

                        <thead>
                        <tr>
                            <th>دسترسی ها</th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permissions[2] as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info btn-sm pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i></a>

                                    <a href="javascript:void(0);" permission_id="{{$permission->id}}" route="{{route('permissions.destroy', $permission->id)}}"  class="btn btn-info btn-sm btn btn-danger btn-sm pull-left confirm_alert" style="margin-right: 3px;"><i class="fa fa-trash"></i></a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="clearfix"></div>
                <a href="{{ route('permissions.create') }}" class="btn btn-success">افزودن دسترسی جدید</a>

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


@endsection
@section('scripts_page')

    <script>
        $(document).ready(function () {

            $('.confirm_alert').click(function () {
                var $_this = $(this);
                swal({
                        title: "مطمئنید؟",
                        text: "در صورت تایید ، این اطلاعات برای همیشه حذف می شوند",
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
                            var role_id = $_this.attr('role_id');
                            $.ajax({

                                type: "DELETE",
                                url: $_this.attr('route'),
                                data: 'role=' + role_id + '&_token={{csrf_token()}}',
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
