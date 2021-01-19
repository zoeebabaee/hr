@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت رزومه ها
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/chosen/chosen.css') }}
    {{ Html::style('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css') }}

@endsection
@section('content')
    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>محتوا</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('home')}}">
                        خانه</a>
                </li>
                <li  class="active">
                    <a><strong>
                            لیست رزومه ها</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">

        <div class="row">



            <div class="col-lg-12">

                <div class="table-responsive">
                    <table id="tblResume" class="table table-striped table-bordered table-hover" >
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>کاربر</th>
                            <th>تاریخ</th>
                            <th>بروزرسانی</th>
                            <th>استان/شهر</th>
                            <th>معرف</th>
                            <th>روش آشنایی</th>
                            <th>حقوق درخواستی(ریال)</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($resumes as $resume)
                            <tr class="gradeX">

                                <td>
                                    {{$resume->id}}
                                </td>
                                <td>

                                    <a href="{{route('resumes.show',$resume->id)}}" target="_blank">
                                        <i class="fa fa-user"></i>&nbsp;
                                        {{$resume->user->first_name}}&nbsp;{{$resume->user->last_name}}
                                    </a>
                                </td>
                                <td><i class="fa fa-calendar-o"></i>&nbsp;{{JDate::createFromCarbon(Carbon::parse($resume->created_at))->format('Y/m/d,H:i')}}</td>
                                <td><i class="fa fa-calendar"></i>&nbsp;{{JDate::createFromCarbon(Carbon::parse($resume->updated_at))->format('Y/m/d,H:i')}}</td>
                                <td><i class="fa fa-map-marker"></i>&nbsp;{{$resume->user->profile->province->name}} /  {{$resume->user->profile->city->name}} </td>
                                <td>
                                    @if(isset($resume->introducer))
                                        {{$resume->introducer->name}}
                                    @endif
                                </td>
                                <td>
                                    <i class="fa fa-eye"></i>&nbsp;
                                    @if($resume->referer==1)
                                        خبرنامه

                                    @elseif($resume->referer==2)
وب سایت

                                    @elseif($resume->referer==3)
از طریق معرف

                                    @elseif($resume->referer==4)
آژانس کاریابی

                                    @elseif($resume->referer==5)
معرف شاغل در شرکت

                                    @elseif($resume->referer==6)
تماس از سمت گلرنگ
                                    @else
                                        {{$resume->other}}
                                    @endif

                                </td>
                                <td>
                                @if(isset($resume->questions->requested_salary))
                                    {{number_format($resume->questions->requested_salary)}}
                                @endif
                                </td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                    {{--
                    {!! $resumes->links() !!}
                    --}}

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

    {{ Html::script('https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js') }}

    <script>
        $(document).ready(function() {
            $('#tblResume').DataTable({
                "ordering": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Persian.json"
                }
            });
        } );
    </script>
@endsection
