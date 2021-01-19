@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت مجموعه ها
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}

@endsection
@section('content')
    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>مجموعه ها</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        خانه</a>
                </li>
                <li  class="active">
                    <a><strong>
                           لیست مجموعه ها</strong></a>
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

                        {{ Form::model($cats, array('route' => array('content_categories.search'), 'method' => 'GET','class'=>'form-inline')) }}

                        <div class="form-group">

                            {{ Form::label('title', 'عنوان') }}
                            {{ Form::text('title', old('title'), array('class' => 'form-control')) }}

                        </div>

                        <div class="form-group">

                            {{ Form::label('parent_id', 'والد') }}

                            <select class="form-control" name="parent_id" id="parent_id">

                                    <option value="" >همه</option>

                                @foreach($parents as $parent)
                                    <option value="{{ $parent['id'] }}"  {{($parent['id']==request('parent_id')?' selected ':'')}}>{{ $parent['value'] }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            {{ Form::label('status', 'وضعیت') }}
                            {{ Form::select('status', [''=>'','all'=>'همه',1=>'فعال',2=>'غیرفعال',3=>'حذف شده'],request('status'), array('class' => 'form-control')) }}
                        </div>

                        <button class="btn btn-success" type="submit">جستجو</button>

                        {{ Form::close() }}



                    </div>
                </div>
            </div>


            <div class="col-lg-12">
                <a href="{{ route('content_categories.create') }}" class="btn btn-info"><i class="fa fa-folder-open-o"></i>&nbsp; افزودن مجموعه جدید</a>
                <br><br>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" >
                        <thead>
                        <tr>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>والد</th>
                            <th>وضعیت</th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($cats as $cat)

                            <tr class="gradeX">
                                <td><img src="{{$cat->image}}" style="width: 50px;padding:1px;border:1px #888 solid;" /></td>
                                <td><strong><a href="{{ route('content_categories.edit', $cat->id) }}">{{$cat->title}}</a></strong>

                                    @if($cat->contents()->count()>0)

                                            ({{$cat->contents()->count()}})

                                    @else
                                        (بدون مطلب)
                                    @endif

                                </td>
                                <td>

                                    @if(!empty($cat->parent['title']))
                                        {{$cat->parent['title']}}
                                    @else
                                        <strong>ریشه</strong>
                                    @endif

                                </td>
                                <td>
                                    @if($cat->status==1 && $cat->deleted_at==null)
                                        <i class="fa fa-check" style="color:green;"></i>&nbsp;
فعال

                                    @endif
                                    @if($cat->status==2 && $cat->deleted_at==null)
                                            <i class="fa fa-clock-o" style="color:orange;"></i>&nbsp;
غیرفعال

                                    @endif
                                    @if($cat->deleted_at!=null)
                                            <i class="fa fa-times" style="color:red;"></i>&nbsp;
                                        حذف شده

                                    @endif
                                </td>

                                <td style="white-space: nowrap;width:90px;">

                                    @if($cat->deleted_at==null)
                                   <a href="{{ route('content_categories.edit', $cat->id) }}" class="btn btn-info btn-sm pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i></a>
                                    @endif

                                    @if($cat->deleted_at==null)

                                   <a href="javascript:void(0);" cat_id="{{$cat->id}}" route="{{route('content_categories.destroy', $cat->id)}}"  class="btn btn-info btn-sm pull-left btn btn-danger btn-sm pull-left confirm_alert" style="margin-right: 3px;"><i class="fa fa-trash"></i></a>

                                    @else

                                        {!! Form::open(['method' => 'POST', 'route' => ['content_categories.restore', $cat->id] ]) !!}
                                        {!! Form::button('<i class="fa fa-undo"></i>', ['type'=>'submit','class' => 'btn btn-primary btn-sm']) !!}
                                        {!! Form::close() !!}

                                    @endif


                                </td>
                            </tr>

                        @endforeach

                        </tbody>


                    </table>
                    {!! $cats->links() !!}
                </div>

    <a href="{{ route('content_categories.create') }}" class="btn btn-info"><i class="fa fa-folder-open-o"></i>&nbsp; افزودن مجموعه جدید</a>


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
