@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    کاربران
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
            <h2>کاربران سیستم</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        خانه</a>
                </li>
                <li  class="active">
                    <a><strong>افزودن کاربر جدید</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">

                <div class="form-group-lg col-lg-6">

                    <h1><i class='fa fa-user-plus'></i> افزودن کاربر جدید</h1>
                    <hr>

                   {{ Form::open(array('route' => 'users.store','files' => true)) }}

                    <div class="form-group">
                        {{ Form::submit('ذخیره', array('class' => 'btn btn-primary')) }}
                        {{ Form::button('انصراف', array('class' => 'btn btn-warning','onclick'=>'history.back()')) }}
                        <div class="clearfix"><p></p><p></p></div>
                    </div>

                    <div class="col-lg-6">
                        <div class="input-group rtl-input input-sx">
                          <span class="input-group-btn">
                            <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                              <i class="fa fa-picture-o"></i> تصویر
                            </a>
                          </span>
                            <input id="thumbnail1" class="form-control input-sm" value="{{old('avatar')}}" type="text" name="avatar" style="font:9pt 'courier new';text-align:left;direction:ltr;">
                        </div>
                        <img id="holder1" style="margin-top:15px;max-height:100px;">
                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group" style="margin-top:10px;">
                        {{ Form::label('first_name', 'نام') }}
                        {{ Form::text('first_name', old('first_name'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('last_name', 'نام خانوادگی') }}
                        {{ Form::text('last_name', old('last_name'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('status', 'فعال') }}
                        {{ Form::select('status', ['0'=>'خیر','1'=>'بله'],old('status'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('email', 'ایمیل') }}
                        {{ Form::email('email', old('email'), array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('mobile', 'موبایل') }}
                        {{ Form::text('mobile', old('mobile'), array('class' => 'form-control')) }}
                    </div>

                    <h5><b>اعمال دسترسی ها</b></h5>

                    <div class='form-group'>

                        @foreach ($roles as $role)
                            @if($role->name == 'برنامه نویس' && !auth()->user()->hasRole('برنامه نویس'))
                                @continue
                            @endif
                            <div class="tree_main" id="tree_main_{{$role->id}}">

                                {{ Form::checkbox('roles[]',  $role->name,null,['id'=>'master_'.$role->id,'onclick'=>'master_checkbox('.$role->id.')']) }}
                                {{ Form::label($role->name, ucfirst($role->name),['id'=>'master_title_'.$role->id]) }}

                            </div>
                            <div class="clearfix"></div>

                        @endforeach

                        <style>
                            .tree_main_plus{
                                cursor:pointer;
                                float:right;
                                margin-left:10px;font-weight:bold;
                            }
                            .tree_main{float:right;display:block;}
                            .tree_sub{position: relative;margin-right:5px;display:none;}
                        </style>

                    </div>

                    <div class="form-group">
                        {{ Form::label('password', 'رمز عبور') }}<br>
                        {{ Form::password('password', array('class' => 'form-control ltr-input')) }}

                    </div>

                    <div class="form-group">
                        {{ Form::label('password', 'تکرار رمز عبور') }}<br>
                        {{ Form::password('password_confirmation', array('class' => 'form-control ltr-input')) }}

                    </div>

                    {{--
                    <div class="form-group">
                        <label class="font-normal">
                            شرکت </label>
                        <div class="input-group">
                            <select name="company_id" data-placeholder="انتخاب شرکت..." class="chosen-select chosen-rtl" style="width:250px;" tabindex="2">

                                @foreach($companies as $company)
                                    <option value="{{$company->id}}" >{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    --}}

                    {{ Form::submit('ذخیره', array('class' => 'btn btn-primary')) }}
                    {{ Form::button('انصراف', array('class' => 'btn btn-warning','onclick'=>'history.back()')) }}

                    {{ Form::close() }}

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
                            var user_id = $_this.attr('user_id');
                            $.ajax({

                                type: "DELETE",
                                url: $_this.attr('route'),
                                data: 'user=' + user_id + '&_token={{csrf_token()}}',
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
        var route_prefix = "{{ url(config('lfm.prefix')) }}";
        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
        $('#lfm1').filemanager('image', {prefix: route_prefix});
        $(document).ready(function(){
            var lfm1 = function(options, cb) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                window.open(route_prefix + '?type=' + options.type || 'image', 'FileManager', 'width=900,height=600');
                window.SetUrl = cb;
            };
        });

    </script>

@endsection
