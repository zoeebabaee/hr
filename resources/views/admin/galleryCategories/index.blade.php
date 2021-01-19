@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت دسته بنده گالری تصاویر
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}
@endsection
@section('content')
    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>گالری تصاویر</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        خانه</a>
                </li>
                <li class="active">
                    <a><strong>
                            دسته بندی ها</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">

        <div class="row">


            <div class="col-lg-4">
                @if(auth()->user()->hasPermissionTo('گالری-ترتیب') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <a href="javascript:void(0);" onclick="save_sort_order();" class="btn btn-warning"><i
                                class="fa fa-arrows"></i>
                        &nbsp;&nbsp;
                        ذخیره ترتیب ها</a>
                @endif
                @if(auth()->user()->hasPermissionTo('گالری-جدید') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <a href="{{ route('galleryCategory.create') }}" class="btn btn-info"><i
                                class="fa fa-newspaper-o"></i>
                        &nbsp;
                        جدید</a>
                @endif

                <br><br>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            @if(auth()->user()->hasPermissionTo('گالری-ترتیب') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                <th>ترتیب</th>
                            @endif
                            <th>نام</th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($galleryCategories as $galleryCategory)

                            <tr class="gradeX">
                                @if(auth()->user()->hasPermissionTo('گالری-ترتیب') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                    <td><input type="text" name="sort_order[]" job_id="{{$galleryCategory->id}}"
                                               id="sort_order_{{$galleryCategory->id}}"
                                               value="{{($galleryCategory->sort_order*-1)}}"
                                               style="width: 40px;text-align:left;direction:ltr;"></td>
                                @endif
                                <td><strong>{{$galleryCategory->name}}</strong></td>

                                <td style="white-space: nowrap;width:120px;">
                                    @if(auth()->user()->hasPermissionTo('گالری-ویرایش') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                        <a href="{{ route('galleryCategory.edit', $galleryCategory->id) }}"
                                           class="btn btn-info btn-sm pull-left" style="margin-right: 3px;"><i
                                                    class="fa fa-edit"></i></a>
                                    @endif
                                    @if(auth()->user()->hasPermissionTo('گالری-حذف') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                        <a href="javascript:void(0);" cat_id="{{$galleryCategory->id}}"
                                           route="{{route('galleryCategory.destroy', $galleryCategory->id)}}"
                                           class="btn btn-info btn-sm pull-left btn btn-danger btn-sm pull-left confirm_alert"
                                           style="margin-right: 3px;"><i class="fa fa-trash"></i></a>
                                    @endif

                                </td>

                            </tr>

                        @endforeach

                        </tbody>


                    </table>

                    {!! $galleryCategories->links() !!}

                </div>
                @if(auth()->user()->hasPermissionTo('گالری-ترتیب') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <a href="javascript:void(0);" onclick="save_sort_order();" class="btn btn-warning"><i
                                class="fa fa-arrows"></i>
                        &nbsp;&nbsp;
                        ذخیره ترتیب ها</a>
                @endif
                @if(auth()->user()->hasPermissionTo('گالری-جدید') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <a href="{{ route('galleryCategory.create') }}" class="btn btn-info"><i
                                class="fa fa-newspaper-o"></i>
                        &nbsp;
                        جدید</a>
                @endif


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
                        text: "در صورت تایید ، این اطلاعات برای همیشه حذف می شوند\r\n",
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
                                data: 'industry=' + cat_id + '&_token={{csrf_token()}}',
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

        function save_sort_order() {
            var value = [];
            var value_string;
            var inputs = $("input[name='sort_order[]']").map(function () {
                return $(this).attr('id');
            }).get();
            for (var i = 0; i < inputs.length; i++) {
                value[i] = $('#' + inputs[i]).attr('job_id') + ':' + $('#' + inputs[i]).val();
            }
            var value_string = value.join();
            //alert(value_string);
            $.ajax({
                method: "POST",
                url: "{{route('gallery.categories.update.sort_order')}}",
                data: {string: value_string, _token: '{!!csrf_token()!!}'}
            }).done(function (msg) {
                document.location.href = '{{route('galleryCategory.index')}}';
            });
        }
    </script>

@endsection
