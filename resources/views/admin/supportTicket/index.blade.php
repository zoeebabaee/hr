@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت تیکتها
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}
    {{ Html::style('/vendor/chosen/chosen.css') }}
@endsection
@section('content')

    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>مدیریت تیکت ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/adpanel">
                        خانه</a>
                </li>
                <li class="active">
                    <a><strong>
                            لیست تیکت ها</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">

        <div class="row">
            <div class="col-lg-12">
                <!-- <div class="ibox float-e-margins ">
                   <div class="ibox-title">
                        <h5>فیلترها</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="background: #EEEEEE">

                        {{ Form::model($users, array('method' => 'GET')) }}

                        <div class="form-group col-lg-4">
                            <label for="company_id">شرکت</label>
                            <select name="company_id" id="company_id" class="form-control chosen">
                                <option value="" selected>انتخاب کنید</option>
                                @foreach($companies as $id=>$company)
                                    <option value="{{$company->id}}" {{($_GET['company_id'] && $_GET['company_id'] ==$id?' selected ':'')}}>{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-4">
                            <div class="form-group">
                                {{ Form::label('priority', 'اهمیت') }}
                                {{ Form::select('priority',array_merge([''=>'انتخاب کنید'],config('app.enum_ticket_priority')), old('priority'), ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="form-group col-lg-4">
                            <div class="form-group">
                                {{ Form::label('status', 'وضعیت') }}
                                {{ Form::select('status',array_merge([''=>'انتخاب کنید'],config('app.enum_ticket_status')), old('status'), ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <button class="btn btn-primary pull-left" type="submit">اعمال فیلترهای جستجو</button>
                        @if(isset($_GET['company_id']))
                            <a href="{{route('tickets.index')}}" style="margin-left: 2px" class="btn btn-danger pull-right">حذف فیلتر ها</a>
                        @endif
                        <div class="clearfix"></div>
                        {{ Form::close() }}

                    </div>-->
                </div>
            </div>

            <div class="col-lg-12">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>
                                شماره تیکت
                            </th>
                            <th>
                                ایمیل
                            </th>
                            <th>
                                توضیحات
                            </th>
                            <th>
                                تاریخ
                            </th>
                            <th>
                               وضعیت
                            </th>
                            <th>
                                مدیریت
                            </th>


                        </tr>
                        </thead>
                        <tbody>

                        @foreach($tickets as $ticket)

                            <tr class="gradeX">
                                <td>
                                    {{ $ticket->id  }}
                                </td>
                                <td>
                                    {{ $ticket->email }}
                                </td>
                                <td>
                                    {{$ticket->details}}
                                </td>
                                <td style="direction: ltr !important; text-align: right !important;">
                                    {{JDate::createFromCarbon(Carbon::parse($ticket->created_at))->format('Y-m-d H:i:s')}}
                                </td>
                                
                                <td>
                                   {{  ($ticket->status == 0 ? "بررسی نشده":
                                    "پاسخ داده شده"
                                  ) }}
                                    


                                </td>
                                <td>
                                    <a href="{{route('support.tickets.show',[$ticket->id])}}" class="btn btn-xs btn-outline btn-primary">مشاهده</a>
                                    @if($ticket->status != 'closed')
                                        <a class="btn btn-xs btn-outline btn-danger confirm_close_ticket">بستن</a>
<!--                                         route="{!! route('tickets.close',[$ticket->id]) !!}"
-->                                    @endif
                                </td>


                            </tr>

                        @endforeach

                        </tbody>

                    </table>


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
    {{ Html::script('/vendor/chosen/chosen.jquery.js') }}

    <script>
        $(document).ready(function () {
            $(".chosen").chosen({rtl: true});

            $('.confirm_close_ticket').click(function () {
                var $_this = $(this);
                swal({
                        title: "مطمئنید؟",
                        text: "در صورت تایید این تیکت بسته خواهد شد.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "بله ، بسته شود",
                        cancelButtonText: "خیر ، منصرف شدم",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: "POST",
                                url: $_this.attr('route'),
                                data: '_token={{csrf_token()}}',
                                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                                complete: function (data) {
                                    swal("بسته شد", "تیکت مورد نظر شما بسته شد", "success");
                                    setTimeout('location.reload();', 1500);
                                }
                            });
                        } else {
                            swal("منصرف شدم", "تیکت مورد نظر بسته نشد", "error");
                        }
                    });
            });
            
            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }
        });

    </script>

@endsection
