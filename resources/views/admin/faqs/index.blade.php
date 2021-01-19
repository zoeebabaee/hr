@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت سوالات متداول
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}

@endsection
@section('content')

    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>سوالات متداول</h2>
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
                @if(auth()->user()->hasPermissionTo('سوالات−متداول-ایجاد') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                    <a href="{{ route('faqs.create') }}" class="btn btn-info"><i class="fa fa-newspaper-o"></i>
                        &nbsp;&nbsp;
                        جدید</a>
                @endif
                <br><br>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>سوال</th>
                            <th>تاریخ ایجاد</th>

                            <th>تایید نهایی</th>

                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($faqs as $faq)


                            <tr class="gradeX">

                                <td>
                                    {{strip_tags($faq->question)}}
                                </td>

                                <td>
                                    {{$faq->created_at}}
                                </td>
                                <td>
                                    @if($faq->approved==1 )
                                        <i class="fa fa-check" style="color:green;"></i>&nbsp;
                                        تایید شده
                                    @endif
                                    @if($faq->approved==0)
                                        <i class="fa fa-clock-o" style="color:orange;"></i>
                                        در انتظار تایید

                                    @endif
                                    @if($faq->approved==2 )
                                        <i class="fa fa-times" style="color:red;"></i>&nbsp;
                                        @if($faq->reject_text!="")
                                            <a href="javascript:void(0);" data-toggle="modal"
                                               data-target="#myModal_reject_text_show"
                                               onclick="$('#reject_text').html('{{$faq->reject_text}}')"><strong>
                                                    @endif
                                                    رد شده
                                                    @if($faq->reject_text!="")
                                                </strong>
                                            </a>
                                        @endif

                                    @endif

                                    @if($faq->approved==1)
                                        @if(auth()->user()->hasPermissionTo('سوالات−متداول-رد') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            {!! Form::button('<i class="fa fa-times"></i> رد شود', ['type'=>'submit','class' =>
                                            'btn btn-outline btn-default btn-xs','style'=>'margin-top:5px;','data-toggle'=>'modal','data-target'=>'#myModal_reject_popup',
                                            'onclick'=>'$("#content_id").val('.$faq->id.');']) !!}
                                        @endif
                                    @endif
                                    @if($faq->approved!=1)
                                        @if(auth()->user()->hasPermissionTo('سوالات−متداول-تایید') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            {!! Form::open(['method' => 'POST', 'route' => ['faqs.accept', $faq->id] ]) !!}
                                            {!! Form::button('<i class="fa fa-check"></i> تایید شود', ['type'=>'submit','class' =>
                                            'btn btn-outline btn-primary btn-xs','style'=>'margin-top:5px;']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                        @if($faq->approved==0)
                                            @if(auth()->user()->hasPermissionTo('سوالات−متداول-رد') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                                {!! Form::button('<i class="fa fa-times"></i> رد شود', ['type'=>'submit','class' =>
                                                'btn btn-outline btn-default btn-xs','style'=>'margin-top:5px;','data-toggle'=>'modal','data-target'=>'#myModal_reject_popup',
                                                'onclick'=>'$("#content_id").val('.$faq->id.');']) !!}
                                            @endif
                                        @endif
                                    @endif
                                </td>
                                <td style="white-space: nowrap;width:170px;">
                                    @if(auth()->user()->hasPermissionTo('سوالات−متداول-ویرایش') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                        <a href="{{ route('faqs.edit', $faq->id) }}"
                                           class="btn btn-info btn-sm pull-left" style="margin-right: 3px;"><i
                                                    class="fa fa-edit"></i></a>
                                    @endif
                                    @if(auth()->user()->hasPermissionTo('سوالات−متداول-حذف') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                        <a href="javascript:void(0);" cat_id="{{$faq->id}}"
                                           route="{{route('faqs.destroy', $faq->id)}}"
                                           class="btn btn-info btn-sm pull-left btn btn-danger btn-sm pull-left confirm_alert"
                                           style="margin-right: 3px;"><i class="fa fa-trash"></i></a>
                                    @endif
                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                    {{--{!! $faq->links() !!}--}}

                </div>
                @if(auth()->user()->hasPermissionTo('سوالات−متداول-ایجاد') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <a href="{{ route('faqs.create') }}" class="btn btn-info"><i class="fa fa-newspaper-o"></i>
                        &nbsp;&nbsp;
                        جدید</a>
                @endif

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
