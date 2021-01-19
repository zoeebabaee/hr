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
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}
    {{ Html::style('/vendor/chosen/chosen.css') }}
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
                <li>
                    ویرایش کاربر
                </li>
                <li  class="active">
                    <a><strong>{{$user->first_name}}</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">

                <div class="form-group-lg col-lg-6">
                    @if(isset($user))

                        <h1><i class='fa fa-user-md'></i>&nbsp;ویرایش کاربر</h1>
                        <hr>

                        {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT','class'=>'form','files' => true]) }}

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
                                <input id="thumbnail1" class="form-control input-sm" type="text" value="{{$user->avatar}}" name="avatar" style="font:9pt 'courier new';text-align:left;direction:ltr;">
                            </div>
                            @if($user->avatar=="")
                                <img id="holder1" style="margin-top:15px;max-height:100px;" src="/GolrangSystem-File-Manager/photos/1/default/noimage_news.png">
                            @else
                                <img id="holder1" style="margin-top:15px;max-height:100px;" src="{{$user->avatar}}">
                            @endif
                            <a class="btn btn-xs btn-danger" href="javascript:void(0)" onclick="$('#holder1').attr('src','/GolrangSystem-File-Manager/photos/1/default/noimage_news.png');$('#thumbnail1').val('');$(this).remove();">X</a>
                        </div>

                    <div class="clearfix"></div>

                        <div class="form-group" style="margin-top:10px;">
                            {{ Form::label('first_name', 'نام') }}
                            {{ Form::text('first_name', $user->first_name, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('last_name', 'نام خانوادگی') }}
                            {{ Form::text('last_name', $user->last_name, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('status', 'فعال') }}
                            {{ Form::select('status', ['0'=>'خیر','1'=>'بله'],$user->status, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('email', 'ایمیل') }}
                            {{ Form::email('email', $user->email, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('mobile', 'موبایل') }}
                            {{ Form::text('mobile', $user->mobile, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            <label class="font-normal">شرکت</label>
                            <div class="input-group">
                                <select  name="company_id[]" multiple id="company_id" data-placeholder="انتخاب کنید" class="form-control chosen">
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}" @if(in_array($company->id,$user->company->pluck('id')->toArray())) selected  @endif >{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <h5><b>اعمال دسترسی ها</b></h5>

                        <div class='form-group'>

                            @foreach ($roles as $role)
                                @if($role->name == 'برنامه نویس' && !auth()->user()->hasRole('برنامه نویس'))
                                    @continue
                                @endif
                                @if($role->name == 'سوپرادمین' && !auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                    @continue
                                @endif
                                <div class="tree_main" id="tree_main_{{$role->id}}">

                                    @if(in_array($role->id,$rolesId))
                                        {{ Form::checkbox('roles[]',  $role->name,null,['id'=>'master_'.$role->id,'checked'=>'1']) }}
                                        {{ Form::label($role->name, ucfirst($role->name),['id'=>'master_title_'.$role->id]) }}
                                    @else
                                        {{ Form::checkbox('roles[]',  $role->name,null,['id'=>'master_'.$role->id]) }}
                                        {{ Form::label($role->name, ucfirst($role->name),['id'=>'master_title_'.$role->id]) }}
                                    @endif

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





                        {{ Form::submit('ذخیره', array('class' => 'btn btn-primary')) }}
                        {{ Form::button('انصراف', array('class' => 'btn btn-warning','onclick'=>'history.back()')) }}

                        {{ Form::close() }}
                    @else
                        {{abort(401)}}
                    @endif
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



            <!-- Sweet alert -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/sweetalert/sweetalert.min.js') }}

    <!-- iCheck -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/iCheck/icheck.min.js') }}
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
    {{ Html::script('/vendor/chosen/chosen.jquery.js') }}

@endsection
@section('scripts_page')
    <script>
        $(document).ready(function () {
            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }
            $(".chosen").chosen({rtl:true});
        });
        //###################### HR TREE CHECKBOX #########################
        function master_checkbox(id){
            if ($('#master_'+id).is(':checked')) {
                $('.case_' + id).prop('checked', true);
                //$("#master_title_" + id).css('color', 'red');
            }else{
                $('.case_' + id).prop('checked', false);
                //$("#master_title_" + id).css('color', 'red');
            }
        }
        function HR_case_click(id){
            if($(".case_"+id).length == $(".case_"+id+":checked").length) {
                $("#master_"+id).prop("checked", true);
                //$("#selectall_title").css('color','white');
            } else {
                $("#master_"+id).prop('checked', false);
                //$("#selectall_title").css('color','red');
            }
        }

        function HR_tree(id){
            var obj=$('#tree_main_'+id);
            var plus=$('#tree_main_plus_'+id);
            var s=plus.html();
            if(s == "+"){
                obj.find('.tree_sub').show();
                plus.html('-');
            }else{
                obj.find('.tree_sub').hide();
                plus.html('+');
            }
        }

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

