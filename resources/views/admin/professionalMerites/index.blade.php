@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت شایستگی های تخصصی
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}
    <link media="all" type="text/css" rel="stylesheet" href="https://people.golrang.com/vendor/chosen/chosen.css">
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
                <li  class="active">
                    <a><strong>
                            لیست شایستگی های تخصصی</strong></a>
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

                        {{ Form::model($professionalMerites, array('route' => array('professionalMerites.search'), 'method' => 'GET','class'=>'form-inline')) }}

                        <div class="form-group">

                            {{ Form::label('name', 'نام') }}
                            {{ Form::text('name', old('name'), array('class' => 'form-control')) }}

                        </div>

                        <div class="form-group">
                            {{ Form::label('status', 'وضعیت') }}
                            {{ Form::select('status', [''=>'','all'=>'همه',0=>'حذف شده'],request('status'), array('class' => 'form-control')) }}
                        </div>


                        <button class="btn btn-success" type="submit">جستجو</button>

                        {{ Form::close() }}

                    </div>
                </div>
            </div>


            <div class="col-lg-12">

                <a href="{{ route('professionalMerites.create') }}" class="btn btn-info"><i class="fa fa-newspaper-o"></i>
                    &nbsp;
                    جدید</a>
                <a href="{{ route('professionalMerites.export') }}" class="btn btn-info" style="background-color: green"><i class="fa fa-newspaper-o"></i>
                    &nbsp;
                    Export</a>
                <br><br>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" style="margin-bottom: 300px">
                        <thead>
                        <tr>
                            <th>نام</th>
                            <th>جایگزینی</th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($professionalMerites as $professionalMerite)

                            <tr class="gradeX">

                                <td>
                                    <input
                                            type="checkbox"
                                            name="deleteds[]"
                                            value="{{$professionalMerite->id}}"
                                            class="checkbox"
                                            style="display: inline"
                                    />
                                    <strong>{{$professionalMerite->name}}
                                        <?php// echo $professionalMerite->jobs; ?>
                                        @if($professionalMerite->jobs->count())
                                            <span style="color: red;">(استفاده شده)</span>
                                        @endif

                                        {{--
                                        @if(isset($professionalMerite))
                                            @php
                                            var_dump($professionalMerite);
                                            exit;
                                            @endphp
                                        @endif
                                        --}}
                                    </strong>
                                </td>
                                <?php// dd($ptrs); ?>
                                <td>
                                    <?php
                                        $arr = array('' => 'انتخاب کنید');
	                                    $ptrs = $arr + $ptrs;
                                     ?>
                                    {!! Form::open(['method' => 'POST', 'route' => ['professionalMerites.replace', $professionalMerite->id] ]) !!}
                                    {{  Form::select('with'/*, array_merge(['' => 'انتخاب کنید'], */, $ptrs ,null, array('class' => 'form-control chosen','required')) }}
                                    {!! Form::button('جایگزین شود', ['type'=>'submit','class' => 'btn btn-primary btn-sm']) !!}
                                    {!! Form::close() !!}
                                </td>

                                <td style="white-space: nowrap;width:120px;">

                                    @if($professionalMerite->deleted_at==null)
                                        <a href="{{ route('professionalMerites.edit', $professionalMerite->id) }}" class="btn btn-info btn-sm pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i></a>
                                    @endif

                                    @if($professionalMerite->deleted_at==null)

                                        <a href="javascript:void(0);" cat_id="{{$professionalMerite->id}}" route="{{route('professionalMerites.destroy', $professionalMerite->id)}}"  class="btn btn-info btn-sm pull-left btn btn-danger btn-sm pull-left confirm_alert" style="margin-right: 3px;"><i class="fa fa-trash"></i></a>

                                    @else

                                        {!! Form::open(['method' => 'POST', 'route' => ['professionalMerites.restore', $professionalMerite->id] ]) !!}
                                        {!! Form::button('<i class="fa fa-undo"></i>', ['type'=>'submit','class' => 'btn btn-primary btn-sm']) !!}
                                        {!! Form::close() !!}

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                        </tbody>


                    </table>

                    {!! $professionalMerites->appends(\Illuminate\Support\Facades\Input::except('page'))->links() !!}

                </div>

                <a href="{{ route('professionalMerites.create') }}" class="btn btn-info"><i class="fa fa-newspaper-o"></i>
                    &nbsp;
                    جدید</a>
                <a href="{{ route('professionalMerites.export') }}" class="btn btn-info" style="background-color: green"><i class="fa fa-newspaper-o"></i>
                    &nbsp;
                    Export</a>

                {{--
                <input href="javascript:void(0)" id="selectall" type="checkbox" class="btn btn-default">انتخاب همه
                --}}
                {!! Form::open(['method' => 'POST','id'=>'batchDeleteForm','route' => ['professionalMerites.batchdelete', $professionalMerite->id] ]) !!}
                <input type="hidden" name="batchDelete" id="batchDelete" value="" />
                {!! Form::close() !!}
                <a href="javascript:batchAll();" class="btn btn-danger" style="background-color: red">
                    <i class="fa fa-eraser-o"></i>
                    حذف دسته جمعی
                </a>
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
    <script src="https://people.golrang.com/vendor/chosen/chosen.jquery.js"></script>
    <script>
        $(document).ready(function () {
            $(".chosen").chosen({rtl:true});
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
                                data: 'professionalMerite=' + cat_id + '&_token={{csrf_token()}}',
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

        function batchAll(){
            let ids = '';
            let ids_counts =0 ;
            $('.checkbox').each(function(i, obj) {
                let checked = $( this ).prop('checked');
                if(checked){
                    //console.log($( this ).val());
                    ids+=$( this ).val()+',';
                    ids_counts++;
                }
            });
            $('#batchDelete').val(ids);
            if(ids_counts>0){
                let cc = window.confirm('از حذف '+ids_counts+' مطمئن هستید؟');
                if(cc){
                    $('#batchDeleteForm').submit();
                }else{
                    $('#batchDelete').val('');
                }
            }
        }

    </script>

@endsection
