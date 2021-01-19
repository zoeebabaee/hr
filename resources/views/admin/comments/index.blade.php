@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت نظرات
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}

    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/chosen/chosen.css') }}

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
                <li class="active">
                    <a><strong>
                            لیست نظرات</strong></a>
                </li>

            </ol>
        </div>
    </div>


    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">

        <div class="row">

            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>فیلترها</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        {{ Form::model($comments, array('route' => array('comments.search'), 'method' => 'GET','class'=>'form-inline')) }}

                        <div class="form-group">

                            {{ Form::label('title', 'متن نظر') }}
                            {{ Form::text('title', old('title'), array('class' => 'form-control')) }}

                        </div>

                        <div class="form-group">
                            <label class="font-noraml">
                                در </label>
                            <div class="input-group">
                                <select name="post" data-placeholder="انتخاب پست..." class="chosen-select chosen-rtl"
                                        style="width:250px;" tabindex="2">
                                    <option value="">همه</option>
                                    @foreach($contents_array as $post)
                                        <option value="{{$post['id']}}" {{($post['id']==request('post')?' selected ':'')}}>{{$post['value']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('status', 'وضعیت') }}
                            {{ Form::select('status', [''=>'','all'=>'همه',0=>'منتظر تایید ادمین',1=>'تایید شده',2=>'رد شده',3=>'حذف شده'],request('status'), array('class' => 'form-control')) }}
                        </div>

                        <button class="btn btn-success" type="submit">جستجو</button>

                        {{ Form::close() }}

                    </div>
                </div>
            </div>


            <div class="col-lg-12">


                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>
                                +/-
                            </th>
                            <th>نظر</th>
                            <th>پست</th>
                            <th style="white-space: nowrap;">ارسال کننده</th>
                            <th>زمان</th>
                            <th>وضعیت</th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)

                            <tr class="gradeX">
                                <td style="font-size: 18pt;">
                                    <a href="javascript:void(0);"
                                       onclick="$('#comment_{{$comment->id}}').toggle();var dd=$(this).html();if(dd.includes('fa-minus')){$(this).html('<i class=\'fa fa-plus-circle\'></i>');$('#commment_brief_{{$comment->id}}').show();}else{$(this).html('<i class=\'fa fa-minus\'></i>');$('#commment_brief_{{$comment->id}}').hide();}"><i
                                                class='fa fa-plus-circle'></i></a>
                                </td>
                                <td>

                                    <div id="commment_brief_{{$comment->id}}">{{mb_substr($comment->content,0,50)}}...
                                    </div>
                                    <div id="comment_{{$comment->id}}"
                                         style="display: none;">{{$comment->content}}</div>
                                </td>
                                <td><a href="{{ route('contents.edit', $comment->content_id) }}"
                                       target="_blank">{{$comment->title}}</a></td>
                                <td>
                                    {{$comment->first_name.' '.$comment->last_name}}
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_user_info"
                                       onclick="$('#user_info').html('{{'<div style=\"text-align:center;\"><img src=\"'.$comment->avatar.'\" class=\"img-circle\" style=\"width: 180px;padding:1px;border:1px #888 solid;\" /></div><br><br>نام: '.$comment->first_name.'<br>نام خانوادگی: '.$comment->last_name.'<br>موبایل: '.$comment->mobile.'<br>آدرس ایمیل: <a href=\"mailto:'.$comment->email.'\" target=\"_blank\">'.$comment->email.'</a>'}}')"
                                       target="_blank"><i class="fa fa-info-circle"></i></a>
                                </td>
                                <td class="ltr-input">{{JDate::createFromCarbon(Carbon::parse($comment->created_at))->format('Y/m/d H:i A')}}</td>
                                <td>

                                    @if($comment->deleted_at != NULL)
                                        <i class="fa fa-times" style="color:red;"></i>&nbsp;
                                        حذف شده

                                    @else
                                        @if($comment->status==1)
                                            <i class="fa fa-check" style="color:green;"></i>&nbsp;
                                            تایید شده

                                        @endif
                                        @if($comment->status==0)
                                            <i class="fa fa-clock-o" style="color:orange;"></i>&nbsp;
                                            منتظر تایید ادمین
                                        @endif
                                        @if($comment->status==2)
                                            <i class="fa fa-times-circle-o" style="color:red;"></i>&nbsp;
                                            رد شده
                                        @endif
                                    @endif
                                </td>
                                <td style="white-space: nowrap;width:90px;">

                                    @if($comment->deleted_at==null)
                                        @if(auth()->user()->hasPermissionTo('نظرات-حذف') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            <a href="javascript:void(0);" cat_id="{{$comment->id}}"
                                               route="{{route('comments.destroy', $comment->id)}}"
                                               class="btn btn-info btn-sm pull-left btn btn-danger btn-sm pull-left confirm_alert"
                                               style="margin-right: 3px;"><i class="fa fa-trash"></i></a>
                                        @endif
                                    @else
                                        @if(auth()->user()->hasPermissionTo('نظرات-بازیابی') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                            {!! Form::open(['method' => 'POST', 'route' => ['comments.restore', $comment->id] ]) !!}
                                            {!! Form::button('<i class="fa fa-undo"></i>', ['type'=>'submit','class' => 'btn btn-primary btn-sm']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    @endif
                                    @if($comment->deleted_at == null)
                                        @if($comment->status==1)
                                            @if(auth()->user()->hasPermissionTo('نظرات-رد') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                                {!! Form::open(['method' => 'POST', 'route' => ['comments.reject', $comment->id] ]) !!}
                                                {!! Form::button('<i class="fa fa-times"></i>', ['type'=>'submit','class' => 'btn btn-default btn-sm']) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        @else
                                            @if(auth()->user()->hasPermissionTo('نظرات-تایید') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                                {!! Form::open(['method' => 'POST', 'route' => ['comments.accept', $comment->id] ]) !!}
                                                {!! Form::button('<i class="fa fa-check"></i>', ['type'=>'submit','class' => 'btn btn-success btn-sm']) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        @endif
                                    @endif

                                </td>

                            </tr>

                        @endforeach

                        </tbody>


                    </table>

                    {!! $comments->links() !!}

                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal_user_info" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">مشخصات کاربر:</h4>
                </div>
                <div class="modal-body">
                    <p>
                        <span id="user_info" style="font-size:15pt;"></span>
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

    <!-- Chosen -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/chosen/chosen.jquery.js') }}



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
                                data: 'comment=' + cat_id + '&_token={{csrf_token()}}',
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
            var config = {
                '.chosen-select': {},
                '.chosen-select-deselect': {
                    allow_single_deselect: true
                },
                '.chosen-select-no-single': {
                    disable_search_threshold: 10
                },
                '.chosen-select-no-results': {
                    no_results_text: 'Oops, nothing found!'
                },
                '.chosen-select-width': {
                    width: "95%"
                }
            };
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
        });


    </script>

@endsection
