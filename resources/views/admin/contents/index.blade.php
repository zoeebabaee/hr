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
                            لیست محتوا</strong></a>
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

                        {{ Form::model($contents, array('route' => array('contents.index'), 'method' => 'GET','class'=>'form-inline')) }}

                        <div class="form-group">

                            {{ Form::label('title', 'عنوان') }}
                            {{ Form::text('title', old('title'), array('class' => 'form-control')) }}

                        </div>

                        <div class="form-group">

                            {{ Form::label('cat_id', 'مجموعه') }}

                            <select class="form-control" name="cat_id" id="cat_id">

                                <option value="">همه</option>

                                @foreach($categories as $category)
                                    <option value="{{ $category['id'] }}" {{($category['id']==request('cat_id')?' selected ':'')}}>{{ $category['value'] }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            {{ Form::label('status', 'وضعیت') }}
                            {{ Form::select('status', [''=>'همه',1=>'منتشر شده',2=>'منتشر نشده'],request('status'), array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('approved', 'تایید نهایی') }}
                            {{ Form::select('approved', [''=>'همه',1=>'تایید شده',0=>'منتظر تایید',2=>'رد شده'],request('approved'), array('class' => 'form-control')) }}
                        </div>

                        <button class="btn btn-success" type="submit">جستجو</button>

                        {{ Form::close() }}

                    </div>
                </div>
            </div>


            <div class="col-lg-12">
                @if(auth()->user()->hasPermissionTo('محتوا-ایجاد') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <a href="{{ route('contents.create') }}" class="btn btn-info"><i class="fa fa-newspaper-o"></i>
                        &nbsp;
                        محتوای جدید</a>
                    <br><br>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>تصویر</th>
                            <th>نویسنده</th>
                            <th>عنوان</th>
                            <th>عنوان مستعار</th>
                            <th>مجموعه</th>
                            <th>وضعیت</th>
                            <th>تایید نهایی</th>
                            @if(auth()->user()->hasPermissionTo('نظرات-مشاهده') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                <th>نظرات</th>
                            @endif
                            <th>آغازانتشار</th>
                            <th>پایان انتشار</th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($contents as $content)

                            <tr class="gradeX">
                                <td><img src="/{{$content->l_image}}"
                                         style="width: 50px;padding:1px;border:1px #888 solid;"/></td>
                                <td title="{{($content->user->company)?$content->user->company->pluck('name')->implode(', '):''}}">{{$content->user->first_name.' '.$content->user->last_name}}</td>
                                <td>
                                    <strong>
                                        @if(auth()->user()->hasPermissionTo('محتوا-ویرایش') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            <a href="{{ route('contents.edit', $content->id) }}">
                                                @endif
                                                {{$content->title}}
                                                @if($content->cat_id==11)(<i class="fa fa-thumbs-up" aria-hidden="true"></i> {{$content->likes}} | <i class="fa fa-thumbs-down" aria-hidden="true"></i> {{$content->dislikes}})@endif
                                                @if(auth()->user()->hasPermissionTo('محتوا-ویرایش') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            </a>
                                        @endif
                                    </strong>
                                </td>
                                <td>{{$content->alias}}</td>
                                <td>

                                    @if(!empty($content->category['title']))
                                        {{ $content->category['title'] }}
                                    @else
                                        <strong>ریشه</strong>
                                    @endif

                                </td>
                                <td>
                                    @if($content->status==1 && $content->deleted_at==null)
                                        <i class="fa fa-check" style="color:green;"></i>&nbsp;
                                        منتشر شده

                                    @endif
                                    @if($content->status==2 && $content->deleted_at==null)
                                        <i class="fa fa-clock-o" style="color:orange;"></i>&nbsp;
                                        منتشر نشده

                                    @endif
                                    @if($content->deleted_at!=null)
                                        <i class="fa fa-times" style="color:red;"></i>&nbsp;
                                        حذف شده

                                    @endif
                                </td>
                                <td>
                                    @if($content->approved==1 && $content->deleted_at==null)
                                        <i class="fa fa-check" style="color:green;"></i>&nbsp;
                                        تایید شده
                                    @endif
                                    @if($content->approved==0 && $content->deleted_at==null)
                                        <i class="fa fa-clock-o" style="color:orange;"></i>
                                        در انتظار تایید

                                    @endif
                                    @if($content->approved==2 && $content->deleted_at==null)
                                        <i class="fa fa-times" style="color:red;"></i>&nbsp;
                                        @if($content->reject_text!="")
                                            <a href="javascript:void(0);" data-toggle="modal"
                                               data-target="#myModal_reject_text_show"
                                               onclick="$('#reject_text').html('{{$content->reject_text}}')"><strong>
                                                    @endif
                                                    رد شده
                                                    @if($content->reject_text!="")
                                                </strong>
                                            </a>
                                        @endif

                                    @endif

                                    @if($content->approved==1)
                                        @if(auth()->user()->hasPermissionTo('محتوا-رد') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            {!! Form::button('<i class="fa fa-times"></i> رد شود', ['type'=>'submit','class' => 'btn btn-outline btn-default btn-xs','style'=>'margin-top:5px;','data-toggle'=>'modal','data-target'=>'#myModal_reject_popup','onclick'=>'$("#content_id").val('.$content->id.');']) !!}
                                        @endif
                                    @endif
                                    @if($content->approved!=1)
                                        @if(auth()->user()->hasPermissionTo('محتوا-تایید') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            {!! Form::open(['method' => 'POST', 'route' => ['contents.accept', $content->id] ]) !!}
                                            {!! Form::button('<i class="fa fa-check"></i> تایید شود', ['type'=>'submit','class' => 'btn btn-outline btn-primary btn-xs','style'=>'margin-top:5px;']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                        @if($content->approved==0)
                                            @if(auth()->user()->hasPermissionTo('محتوا-رد') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                                {!! Form::button('<i class="fa fa-times"></i> رد شود', ['type'=>'submit','class' => 'btn btn-outline btn-default btn-xs','style'=>'margin-top:5px;','data-toggle'=>'modal','data-target'=>'#myModal_reject_popup','onclick'=>'$("#content_id").val('.$content->id.');']) !!}
                                            @endif
                                        @endif
                                    @endif
                                </td>
                                @if(auth()->user()->hasPermissionTo('نظرات-مشاهده') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                    <td>
                                        @if(intval($content->comments()->count())>0)
                                            <a href="{{route('comments.index',$content->id)}}" target="_blank"
                                               style="text-decoration: underline;">

                                                {{intval($content->comments()->count())}}نظر
                                                <br>
                                                {{intval($content->comments()->where('status','<>',1)->count())}} تایید
                                                نشده
                                            </a>
                                        @else
                                            ندارد
                                        @endif

                                    </td>
                                @endif
                                <td>
                                    @if($content->start_publish!="")
                                        {{JDate::createFromCarbon(Carbon::parse($content->start_publish))->format('Y/m/d')}}
                                    @endif
                                </td>
                                <td>
                                    @if($content->end_publish!="")
                                        {{JDate::createFromCarbon(Carbon::parse($content->end_publish))->format('Y/m/d')}}
                                    @endif
                                </td>
                                <td style="white-space: nowrap;width:120px;">
                                    @if($content->deleted_at==null)
                                        @if(auth()->user()->hasPermissionTo('محتوا-ویرایش') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            <a href="{{ route('contents.edit', $content->id) }}"
                                               class="btn btn-warning btn-outline btn-xs" style="margin-right: 3px;"> ویرایش</a>
                                        @endif
                                    @endif

                                    @if($content->category->id == 9)
                                        <a href="/news/{{$content->alias}}" class="btn btn-info btn-xs btn-outline" target="_blank">پیش نمایش</a>
                                    @elseif($content->category->id == 10 || $content->category->id == 14)
                                        <a href="/events/{{$content->alias}}" class="btn btn-info btn-xs btn-outline" target="_blank">پیش نمایش</a>
                                    @elseif($content->category->id == 11)
                                        <a href="/blog/{{$content->alias}}" class="btn btn-info btn-xs btn-outline" target="_blank">پیش نمایش</a>
                                    @endif

                                    @if($content->deleted_at==null)
                                        @if(auth()->user()->hasPermissionTo('محتوا-حذف') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            <a href="javascript:void(0);" cat_id="{{$content->id}}"
                                               route="{{route('contents.destroy', $content->id)}}"
                                               class="btn btn-danger btn-outline btn-xs confirm_alert"
                                               style="margin-right: 3px;"> حذف
                                            </a>
                                        @endif
                                    @else
                                        @if(auth()->user()->hasPermissionTo('محتوا-بازیابی') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                            {!! Form::open(['method' => 'POST', 'route' => ['contents.restore', $content->id],'class'=>'form-btn' ]) !!}
                                            {!! Form::button('<i class="fa fa-undo"></i>', ['type'=>'submit','class' => 'btn btn-primary btn-sm ']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    @endif
                                    @if(auth()->user()->hasPermissionTo('محتوا-پین') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                        @if($content->deleted_at == null)
                                            @if($content->pin_status==1)
                                                {!! Form::open(['method' => 'POST', 'route' => ['contents.unpin', $content->id],'class'=>'form-btn']) !!}
                                                {!! Form::button('حذف پین', ['type'=>'submit','class' => 'btn btn-success btn-xs btn-outline ']) !!}
                                                {!! Form::close() !!}
                                            @else
                                                {!! Form::open(['method' => 'POST', 'route' => ['contents.pin', $content->id],'class'=>'form-btn' ]) !!}
                                                {!! Form::button('پین', ['type'=>'submit','class' => 'btn btn-default btn-xs   btn-outline']) !!}
                                                {!! Form::close() !!}
                                            @endif
                                        @endif
                                    @endif

                                </td>
                            </tr>
                        @endforeach

                        </tbody>


                    </table>

                    {!! $contents->appends(\Illuminate\Support\Facades\Input::except('page'))->links() !!}
                </div>


                @if(auth()->user()->hasPermissionTo('محتوا-ایجاد') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <a href="{{ route('contents.create') }}" class="btn btn-info"><i class="fa fa-newspaper-o"></i>&nbsp;
                        محتوای جدید
                    </a>
                @endif


            </div>
        </div>
    </div>


    <!-- Modal -->
    <div id="myModal_reject_popup" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            {!! Form::open(['method' => 'POST', 'route' => ['contents.reject',0]]) !!}
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
