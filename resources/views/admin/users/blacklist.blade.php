@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    کاربران
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/jalalicalendar/skins/calendar-system.css') }}
    {{ Html::style('/site/'.config('app.site_theme').'/css/chosen.css') }}
    <!-- Sweet Alert -->
@endsection
@section('content')
    <div class="clearfix wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>کاربران بلک لیست</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        خانه</a>
                </li>
                <li class="active">
                    <a><strong>
                کاربران بلک لیست</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">


            <div class="col-lg-12">

             
                @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                    <a href="{{ route('users.export_blacklist') }}" class="btn btn-success"><i
                                class="fa fa-file-excel-o"></i>خروجی بلک لیست</a>
                @endif

                <br><br>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>موبایل</th>
                            <th>ایمیل</th>
                            <th>تاریخ ثبت نام</th>
                            <th>آخرین ورود</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                           
            <td>{{$user->first_name}}  </td>
            <td> {{$user->last_name}}</td>
            <td> {{$user->mobile}}</td>
            <td>{{$user->email}}</td>
            <td class="ltr-input"><i class="fa fa-calendar-o"></i>
                {{JDate::createFromCarbon(Carbon::parse($user->created_at)->timezone('Asia/Tehran'))->format('Y/m/d')}}
            </td>
            <td class="ltr-input"><i class="fa fa-calendar-o"></i>
                {{JDate::createFromCarbon(Carbon::parse($user->last_login)->timezone('Asia/Tehran'))->format('Y/m/d')}}
            </td>
         
        </tr>
    @endforeach
    </tbody>


</table>
</div>
{{--@if(auth()->user()->hasPermissionTo('کاربران-افزودن-کاربر-جدید') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))--}}
                {{--<a href="{{ route('users.create') }}" users class="btn btn-info"><i class="fa fa-user-plus"></i>&nbsp;--}}
                {{--افزودن--}}
                {{--کاربر</a>--}}
                {{--@endif--}}
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
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/sweetalert/sweetalert.min.js') }}

    <!-- Custom and plugin javascript -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/rada.js') }}
    <!-- jQuery UI -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/jquery-ui/jquery-ui.min.js') }}


    <!--### Jalali Popup Calendar.MMKIA ###-->
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/jalali.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/calendar.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/calendar-setup.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/jalalicalendar/lang/calendar-fa.js') }}

    {{ Html::script('/site/'.config('app.site_theme').'/js/chosen.jquery.js') }}


@endsection
@section('scripts_page')

    <script>
    



    </script>

@endsection
