@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت محتوا
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
                <li class="active">
                    <a><strong>
                            لیست تگ ها</strong></a>
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

                        {{ Form::model($tags, array('route' => array('tags.search'), 'method' => 'GET','class'=>'form-inline')) }}

                        <div class="form-group">

                            {{ Form::label('name', 'نام') }}
                            {{ Form::text('name', old('name'), array('class' => 'form-control')) }}

                        </div>

                        <button class="btn btn-success" type="submit">جستجو</button>

                        {{ Form::close() }}

                    </div>
                </div>
            </div>


            <div class="col-lg-4">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            {{--<th>تصویر</th>--}}
                            <th>
                                @if(isset($_GET['sort_by']) && $_GET['sort_by']=="desc")
                                    <a href="{{route('tags.index',array('order_by'=>'name','sort_by'=>'asc'))}}">
                                        <i class="fa fa-arrow-up" aria-hidden="true"></i>&nbsp;&nbsp;
                                        @endif
                                        @if(isset($_GET['sort_by']) && $_GET['sort_by']=="asc")
                                            <a href="{{route('tags.index',array('order_by'=>'name','sort_by'=>'desc'))}}">
                                                <i class="fa fa-arrow-down" aria-hidden="true"></i>&nbsp;
                                                @endif
                                                @if(!isset($_GET['sort_by']))
                                                    <a href="{{route('tags.index',array('order_by'=>'name','sort_by'=>'desc'))}}">
                                                        <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                                        @endif

                                                        نام
                                                    </a>
                            </th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($tags as $tag)
                            @if($loop->index >= 10)
                                @continue
                            @endif
                            <tr class="gradeX">

                                <td>
                                    <strong>{{$tag->name}}</strong>

                                    @if(intval($tag->contents()->count()+$tag->books()->count())>0)

                                        ({{intval($tag->contents()->count()+$tag->books()->count())}})

                                    @else
                                        <span style="color:red">
                                        (استفاده نشده)
                                        </span>
                                    @endif
                                </td>

                                <td style="white-space: nowrap;width:120px;">

                                    @if($tag->deleted_at==null)
                                        @if(auth()->user()->hasPermissionTo('تگ-ویرایش') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                            <a href="{{ route('tags.edit', $tag->id) }}"
                                               class="btn btn-info btn-sm pull-left" style="margin-right: 3px;"><i
                                                        class="fa fa-edit"></i></a>
                                        @endif
                                    @endif

                                    @if($tag->deleted_at==null)
                                        @if(auth()->user()->hasPermissionTo('تگ-حذف') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                            <a href="javascript:void(0);" cat_id="{{$tag->id}}"
                                               route="{{route('tags.destroy', $tag->id)}}"
                                               class="btn btn-info btn-sm pull-left btn btn-danger btn-sm pull-left confirm_alert"
                                               style="margin-right: 3px;"><i class="fa fa-trash"></i></a>
                                        @endif
                                    @else
                                        @if(auth()->user()->hasPermissionTo('تگ-بازیابی') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                            {!! Form::open(['method' => 'POST', 'route' => ['tags.restore', $tag->id] ]) !!}
                                            {!! Form::button('<i class="fa fa-undo"></i>', ['type'=>'submit','class' => 'btn btn-primary btn-sm']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    @endif

                                </td>

                            </tr>

                        @endforeach

                        </tbody>


                    </table>


                </div>


            </div>
            @if($tags->count() > 10)
                <div class="col-lg-4">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                {{--<th>تصویر</th>--}}
                                <th>
                                    @if(isset($_GET['sort_by']) && $_GET['sort_by']=="desc")
                                        <a href="{{route('tags.index',array('order_by'=>'name','sort_by'=>'asc'))}}">
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>&nbsp;&nbsp;
                                            @endif
                                            @if(isset($_GET['sort_by']) && $_GET['sort_by']=="asc")
                                                <a href="{{route('tags.index',array('order_by'=>'name','sort_by'=>'desc'))}}">
                                                    <i class="fa fa-arrow-down" aria-hidden="true"></i>&nbsp;
                                                    @endif
                                                    @if(!isset($_GET['sort_by']))
                                                        <a href="{{route('tags.index',array('order_by'=>'name','sort_by'=>'desc'))}}">
                                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                                            @endif

                                                            نام
                                                        </a>
                                </th>
                                <th>مدیریت</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($tags as $tag)
                                @if($loop->index >= 20 || $loop->index < 10)
                                    @continue
                                @endif
                                <tr class="gradeX">

                                    <td>
                                        <strong>{{$tag->name}}</strong>

                                        @if(intval($tag->contents()->count()+$tag->books()->count())>0)

                                            ({{intval($tag->contents()->count()+$tag->books()->count())}})

                                        @else
                                            <span style="color:red">
                                        (استفاده نشده)
                                        </span>
                                        @endif
                                    </td>

                                    <td style="white-space: nowrap;width:120px;">

                                        @if($tag->deleted_at==null)
                                            @if(auth()->user()->hasPermissionTo('تگ-ویرایش') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                                <a href="{{ route('tags.edit', $tag->id) }}"
                                                   class="btn btn-info btn-sm pull-left" style="margin-right: 3px;"><i
                                                            class="fa fa-edit"></i></a>
                                            @endif
                                        @endif

                                        @if($tag->deleted_at==null)
                                            @if(auth()->user()->hasPermissionTo('تگ-حذف') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                                <a href="javascript:void(0);" cat_id="{{$tag->id}}"
                                                   route="{{route('tags.destroy', $tag->id)}}"
                                                   class="btn btn-info btn-sm pull-left btn btn-danger btn-sm pull-left confirm_alert"
                                                   style="margin-right: 3px;"><i class="fa fa-trash"></i></a>
                                            @endif
                                        @else
                                            @if(auth()->user()->hasPermissionTo('تگ-بازیابی') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                                {!! Form::open(['method' => 'POST', 'route' => ['tags.restore', $tag->id] ]) !!}
                                                {!! Form::button('<i class="fa fa-undo"></i>', ['type'=>'submit','class' => 'btn btn-primary btn-sm']) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>


                        </table>


                    </div>


                </div>
            @endif
            @if($tags->count() > 20)
                <div class="col-lg-4">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                {{--<th>تصویر</th>--}}
                                <th>
                                    @if(isset($_GET['sort_by']) && $_GET['sort_by']=="desc")
                                        <a href="{{route('tags.index',array('order_by'=>'name','sort_by'=>'asc'))}}">
                                            <i class="fa fa-arrow-up" aria-hidden="true"></i>&nbsp;&nbsp;
                                            @endif
                                            @if(isset($_GET['sort_by']) && $_GET['sort_by']=="asc")
                                                <a href="{{route('tags.index',array('order_by'=>'name','sort_by'=>'desc'))}}">
                                                    <i class="fa fa-arrow-down" aria-hidden="true"></i>&nbsp;
                                                    @endif
                                                    @if(!isset($_GET['sort_by']))
                                                        <a href="{{route('tags.index',array('order_by'=>'name','sort_by'=>'desc'))}}">
                                                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                                                            @endif

                                                            نام
                                                        </a>
                                </th>
                                <th>مدیریت</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($tags as $tag)
                                @if($loop->index < 20 )
                                    @continue
                                @endif
                                <tr class="gradeX">

                                    <td>
                                        <strong>{{$tag->name}}</strong>

                                        @if(intval($tag->contents()->count()+$tag->books()->count())>0)

                                            ({{intval($tag->contents()->count()+$tag->books()->count())}})

                                        @else
                                            <span style="color:red">
                                        (استفاده نشده)
                                        </span>
                                        @endif
                                    </td>

                                    <td style="white-space: nowrap;width:120px;">

                                        @if($tag->deleted_at==null)
                                            @if(auth()->user()->hasPermissionTo('تگ-ویرایش') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                                <a href="{{ route('tags.edit', $tag->id) }}"
                                                   class="btn btn-info btn-sm pull-left" style="margin-right: 3px;"><i
                                                            class="fa fa-edit"></i></a>
                                            @endif
                                        @endif

                                        @if($tag->deleted_at==null)
                                            @if(auth()->user()->hasPermissionTo('تگ-حذف') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                                <a href="javascript:void(0);" cat_id="{{$tag->id}}"
                                                   route="{{route('tags.destroy', $tag->id)}}"
                                                   class="btn btn-info btn-sm pull-left btn btn-danger btn-sm pull-left confirm_alert"
                                                   style="margin-right: 3px;"><i class="fa fa-trash"></i></a>
                                            @endif
                                        @else
                                            @if(auth()->user()->hasPermissionTo('تگ-بازیابی') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                                                {!! Form::open(['method' => 'POST', 'route' => ['tags.restore', $tag->id] ]) !!}
                                                {!! Form::button('<i class="fa fa-undo"></i>', ['type'=>'submit','class' => 'btn btn-primary btn-sm']) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>


                        </table>


                    </div>


                </div>
            @endif
            <div class="clearfix"></div>
            <center>
                {!! $tags->links() !!}
                <div class="clearfix"></div>
                <a href="{{ route('tags.create') }}" class="btn btn-info"><i class="fa fa-newspaper-o"></i>جدید</a>
            </center>
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
                                data: 'tag=' + cat_id + '&_token={{csrf_token()}}',
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

        $(function () {
            var availableTags = [
                {!! '"'.implode('","',$tag_names).'"'  !!}
            ];

            function split(val) {
                return val.split(/ \s*/);
            }

            function extractLast(term) {
                return split(term).pop();
            }

            $("#name")
            // don't navigate away from the field on tab when selecting an item
                .on("keydown", function (event) {
                    if (event.keyCode === $.ui.keyCode.TAB &&
                        $(this).autocomplete("instance").menu.active) {
                        event.preventDefault();
                    }
                })
                .autocomplete({
                    minLength: 0,
                    source: function (request, response) {
                        // delegate back to autocomplete, but extract the last term
                        response($.ui.autocomplete.filter(
                            availableTags, extractLast(request.term)));
                    },
                    focus: function () {
                        // prevent value inserted on focus
                        return false;
                    },
                    select: function (event, ui) {
                        var terms = split(this.value);
                        // remove the current input
                        terms.pop();
                        // add the selected item
                        terms.push(ui.item.value);
                        // add placeholder to get the comma-and-space at the end
                        terms.push("");
                        this.value = terms.join(" ");
                        return false;
                    }
                });
        });

    </script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-menu-item-wrapper {
            font: 12pt 'B Nazanin';
            background: #efefef;

        }
    </style>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

@endsection
