@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت گالری
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}

@endsection
@section('content')

    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>گالری</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        خانه</a>
                </li>
                <li class="active">
                    <a><strong>
                            لیست آیتم های گالری</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">

        <div class="row">

            <div class="col-lg-12">
                @if(auth()->user()->hasPermissionTo('تصاویر-ترتیب') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <a href="javascript:void(0);" onclick="save_sort_order();" class="btn btn-warning"><i
                                class="fa fa-arrows"></i>
                        &nbsp;&nbsp;
                        ذخیره ترتیب ها</a>
                @endif
                @if(auth()->user()->hasPermissionTo('تصاویر-جدید') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <a href="{{ route('gallery.create') }}" class="btn btn-info"><i class="fa fa-newspaper-o"></i>
                        &nbsp;&nbsp;
                        جدید</a>
                @endif
                <br><br>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            @if(auth()->user()->hasPermissionTo('تصاویر-ترتیب') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                <th>ترتیب</th>
                            @endif
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>تاریخ</th>
                            <th>تایید نهایی</th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($gallery as $item)


                            <tr class="gradeX">
                                @if(auth()->user()->hasPermissionTo('تصاویر-ترتیب') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                <td><input type="text" name="sort_order[]" job_id="{{$item->id}}"
                                           id="sort_order_{{$item->id}}" value="{{($item->sort_order*-1)}}"
                                           style="width: 40px;text-align:left;direction:ltr;"></td>
                                @endif
                                <td>
                                    <img src="/{{$item->l_img}}" alt="{{$item->name}}"
                                         style="width: 50px;padding:1px;border:1px #888 solid;"/></td>
                                </td>
                                <td><strong>{{$item->name}} </strong>
                                </td>

                                <td>
                                    {{$item->created_at}}
                                </td>

                                <td>
                                    @if($item->approved==1 && $item->deleted_at==null)
                                        <i class="fa fa-check" style="color:green;"></i>&nbsp;
                                        تایید شده
                                    @endif
                                    @if($item->approved==0 && $item->deleted_at==null)
                                        <i class="fa fa-clock-o" style="color:orange;"></i>&nbsp;
                                        در انتظار تایید

                                    @endif
                                    @if($item->approved==2 && $item->deleted_at==null)
                                        <i class="fa fa-times-circle-o" style="color:red;"></i>&nbsp;
                                        رد شده
                                    @endif

                                    @if($item->approved==1)
                                        @if(auth()->user()->hasPermissionTo('تصاویر-رد') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            {!! Form::open(['method' => 'POST', 'route' => ['gallery.reject', $item->id] ]) !!}
                                            {!! Form::button('<i class="fa fa-times"></i> رد شود', ['type'=>'submit','class' => 'btn btn-outline btn-default btn-xs']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    @elseif($item->approved==0)
                                        @if(auth()->user()->hasPermissionTo('تصاویر-تایید') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            {!! Form::open(['method' => 'POST', 'route' => ['gallery.accept', $item->id] ]) !!}
                                            {!! Form::button('<i class="fa fa-check"></i> تایید شود', ['type'=>'submit','class' => 'btn btn-outline btn-primary btn-xs']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                        @if(auth()->user()->hasPermissionTo('تصاویر-رد') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            {!! Form::open(['method' => 'POST', 'route' => ['gallery.reject', $item->id] ]) !!}
                                            {!! Form::button('<i class="fa fa-times"></i> رد شود', ['type'=>'submit','class' => 'btn btn-outline btn-default btn-xs']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    @else
                                        @if(auth()->user()->hasPermissionTo('تصاویر-تایید') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            {!! Form::open(['method' => 'POST', 'route' => ['gallery.accept', $item->id] ]) !!}
                                            {!! Form::button('<i class="fa fa-check"></i> تایید شود', ['type'=>'submit','class' => 'btn btn-outline btn-primary btn-xs']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    @endif
                                </td>

                                <td style="white-space: nowrap;width:170px;">
                                    @if(auth()->user()->hasPermissionTo('تصاویر-ویرایش') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                        <a href="{{ route('gallery.edit', $item->id) }}"
                                           class="btn btn-info btn-sm pull-left" style="margin-right: 3px;"><i
                                                    class="fa fa-edit"></i></a>
                                    @endif

                                    @if(auth()->user()->hasPermissionTo('تصاویر-حذف') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                        <a href="javascript:void(0);" cat_id="{{$item->id}}"
                                           route="{{route('gallery.destroy', $item->id)}}"
                                           class="btn btn-info btn-sm pull-left btn btn-danger btn-sm pull-left confirm_alert"
                                           style="margin-right: 3px;"><i class="fa fa-trash"></i></a>
                                    @endif
                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                    {!! $gallery->links() !!}

                </div>

                @if(auth()->user()->hasPermissionTo('تصاویر-ترتیب') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <a href="javascript:void(0);" onclick="save_sort_order();" class="btn btn-warning"><i
                                class="fa fa-arrows"></i>
                        &nbsp;&nbsp;
                        ذخیره ترتیب ها</a>
                @endif
                @if(auth()->user()->hasPermissionTo('تصاویر-جدید') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <a href="{{ route('gallery.create') }}" class="btn btn-info"><i class="fa fa-newspaper-o"></i>
                        &nbsp;&nbsp;
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
                url: "{{route('galleries.update.sort_order')}}",
                data: {string: value_string, _token: '{!!csrf_token()!!}'}
            }).done(function (msg) {
                document.location.href = '{{route('gallery.index')}}';
            });
        }

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
