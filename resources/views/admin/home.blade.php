@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    پنل ادمین
@endsection

@section('content')

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-left">تا این لحظه</span>
                        <h5>اعضا</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="no-margins">
                                    {{number_format($users_count)}}
                                </h1>
                                <div class="stat-percent font-bold text-danger">
                                </div>
                                <small>
                                    تا این لحظه
                                </small>
                            </div>
                            <div class="col-md-6">
                                <h1 class="no-margins">
                                    {{number_format($users_count_today)}}
                                </h1>

                                <small>
                                    امروز
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                                    <span class="label label-success pull-left">
                                    تا این لحظه</span>
                        <h5>
                            رزومه ها</h5>
                    </div>
                    <div class="ibox-content">

                        <h1 class="no-margins">
                            {{number_format($resumes_count)}}
                        </h1>

                        <div class="stat-percent font-bold text-success">

                        </div>
                        <small>
                            رزومه ثبت شده است
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-info pull-left">
                            همین حالا
                        </span>
                        <h5>
                            آگهی ها</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">
                            {{number_format($jobs_count)}}
                        </h1>

                        <small>
                            آگهی فعال از {{$all_jobs_count}} آگهی
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-danger pull-left">تا امروز</span>
                        <h5>
                            تعداد اپلای ها
                        </h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-4">
                                <h1 class="no-margins">
                                    {{number_format($applies_count)}}
                                </h1>
                                <div class="stat-percent font-bold text-danger">

                                </div>
                                <small>
                                    اپلای کرده اند
                                </small>
                            </div>
                            <div class="col-md-4">
                                <h1 class="no-margins">
                                    {{ number_format(\HR\Apply::where('status', 0)->count() + \HR\Apply::where('status', 1)->count() )}}
                              </h1>
                                <div class="stat-percent font-bold text-danger">

                                </div>
                                <small>
                                    در انتظار بررسی
                                </small>
                            </div>
                            <div class="col-md-4">
                                <h1 class="no-margins">
                                    {{number_format($applies_accept_count)}}
                                </h1>
                                <div class="stat-percent font-bold text-danger">

                                </div>
                                <small>
                                    تایید شده
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="widget style1 yellow-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-files-o fa-3x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> محتوا در انتظار بررسی </span>
                            <h2 class="font-bold"><a
                                        href="/adpanel/contents?approved=0">{{$contents_not_accept_count}}</a>
                            </h2>
                            <br>
                            <span> مطلب </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="widget style1 navy-bg">
                    <div class="row ">
                        <div class="col-xs-4 ">
                            <i class="fa fa-briefcase fa-3x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> آگهی در انتظار بررسی </span>
                            <h2 class="font-bold"><a
                                        href="/adpanel/jobs/search?approved=0"> {{$Jobs_not_accept_count}} </a>
                            </h2>
                            <br>
                            <span> آگهی </span>
                        </div>
                    </div>
                </div>
            </div>
            @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                <div class="col-lg-3">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-xs-4">
                                <i style="-ms-transform:rotateY(180deg);
                                        -webkit-transform: rotateY(180deg);
                                        transform: rotateY(180deg);"
                                   class="fa fa-volume-control-phone fa-3x"></i>
                            </div>
                            <div class="col-xs-8 text-right">
                                <span> پیام ها در انتظار بررسی </span>
                                <h2 class="font-bold"><a
                                            href="/adpanel/contact-us">{{\HR\ContactUS::where('read',0)->count()}}</a>
                                </h2>
                                <br>
                                از <strong>{{\HR\ContactUS::all()->count()}}</strong>
                                <span> پیام </span>

                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-lg-3">
                <div class="widget style1 black-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i style="color: #fff;" class="fa fa-picture-o fa-3x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span style="color: #fff;"> تصاویر در انتظار بررسی </span>
                            <h2 style="color: #fff;" class="font-bold">{{$images_not_accept_count}}</h2>
                            <br>
                            <span style="color: #fff;"> تصویر </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>گزارش فعالیت شرکت ها</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <a href="/adpanel/users/export-companies-activity" class="btn btn-primary">گزارش آگهی های فعال</a>
                        <a href="/adpanel/users/export-companies-activity-all" class="btn btn-primary">گزارش همه ی آگهی ها</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>آمار ثبت نام کاربران در روز های هفته طی سه ماه اخیر</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <canvas id="users" class="flot-chart-content">
                        </canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>درصد رزومه های بررسی شده شرکت ها</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <canvas id="company_applies" class="flot-chart-content">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>تعداد آگهی های فعال شرکت ها</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <canvas id="company_jobs" class="flot-chart-content">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>برترین شرکت های هفته</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="col-md-4" style="border-left: 1px solid #e7eaec;">
                            <h5>سهم جذب از بین {{$all_users_this_week}} کاربر</h5>
                            <ul class="stat-list m-t-lg">
                                @foreach($users_companies->slice(0,3) as $item)
                                    <li>
                                        <h5 class="no-margins ">{{number_format($item->user_count)}} کاربر</h5>
                                        <small>
                                            {{$item->company_name}}</small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar"
                                                 style="width: {!! intval($item->user_count/$all_users_this_week*100) !!}%;">
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4" style="border-left: 1px solid #e7eaec;">
                            <h5>بررسی درخواست ها</h5>
                            <ul class="stat-list m-t-lg">
                                @foreach($best_companies_in_apply_answered as $item)
                                    <li>
                                        <h5 class="no-margins">
                                            {{$item->name}} - {{number_format((float)$item->answered_percent,2)}}%
                                        </h5>
                                        <small>
                                            {{number_format($item->applies_count - $company_applies_no_answer[$item->name])}} درخواست
                                            بررسی
                                            شده
                                            از {{number_format($item->applies_count)}}

                                        </small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar" style="width: {{$item->answered_percent}}%;">
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5>تیکت های پاسخ داده شده</h5>
                            <ul class="stat-list m-t-lg">
                                @foreach($tickets_company as $item)
                                    <li>
                                        <h5 class="no-margins">{{$item['name']}} {{intval($item['average'])}}%</h5>
                                        <small>
                                            {{intval($item['all_tickets'] * $item['average'] / 100)}} تیکت
                                            از {{$item['all_tickets']}} تیکت پاسخ داده شده
                                        </small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar" style="width: {!!  intval($item['average'])!!}%;">
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if($users_inputs_companies->count())
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>کاربران ورودی از صفحات شرکت ها(امروز)</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <canvas id="input_users" class="flot-chart-content">
                            </canvas>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>برترین روش های آشنایی با سایت</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <canvas id="users_referer" class="flot-chart-content">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>وضعیت درخواست ها</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <canvas id="applies_state" class="flot-chart-content">
                        </canvas>
                    </div>
                </div>
            </div>
                        <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>وضعیت تیکت ها</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <canvas id="tickets_state" class="flot-chart-content">
                        </canvas>
                    </div>
                </div>
            </div>

<!-- comment by zoee            <div class="col-lg-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>وضعیت تکمیل فرم ها</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <canvas id="user_forms" class="flot-chart-content">
                        </canvas>
                    </div>
                </div>
            </div>
-->        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>کاربران در صنعت های مختلف</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <canvas height="600" id="resume_industries" class="flot-chart-content">
                        </canvas>
                    </div>
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

    <!-- Sparkline -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/sparkline/jquery.sparkline.min.js') }}
    <!-- Sparkline demo data  -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/demo/sparkline-demo.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/toastr/toastr.min.js') }}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

    <script>
        $(document).ready(function () {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: 'slideDown',
                positionClass: 'toast-bottom-left',
                timeOut: 10000
            };
            toastr.success('منابع انسانی گروه صنعتی گلرنگ', 'به پنل مدیریت خوش آمدید');
        });
    </script>

@endsection

@section('scripts_page')

    <script>
        var ctx = document.getElementById("users");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنجشنبه", "جمعه"],
                datasets: [{
                    data: [@foreach($chart_user_in_week_days as $item) {!! $item->user_count !!}, @endforeach],
                    @php $i=0; @endphp
                    backgroundColor: [
                        @foreach($company_applies as $item)@php $index[$i] = random_int(0,12); @endphp '{!! config('app.chart_back_color')[$index[$i++]] !!}', @endforeach
                    ],
                    @php $i=0; @endphp
                    borderColor: [
                        @foreach($company_applies as $item) '{!! config('app.chart_border_color')[$index[$i++]] !!}',  @endforeach
                    ],
                    borderWidth: 1
                }]

            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]

                }
            }
        });

        var ctx = document.getElementById("company_jobs");
        var data = {
            labels: [@foreach($chart_Company_jobs as $item) "{!! $item->name !!}", @endforeach],
            datasets: [{
                data: [@foreach($chart_Company_jobs as $item) {!! $item->job_count !!}, @endforeach],
                @php $i=0; @endphp
                backgroundColor: [
                    @foreach($company_applies as $item)@php $index[$i] = random_int(0,12); @endphp '{!! config('app.chart_back_color')[$index[$i++]] !!}', @endforeach
                ],
                @php $i=0; @endphp
                borderColor: [
                    @foreach($company_applies as $item) '{!! config('app.chart_border_color')[$index[$i++]] !!}',  @endforeach
                ],
            }]
        }
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                "hover": {
                    "animationDuration": 2
                },
                "animation": {
                    "duration": 1,
                    "onComplete": function () {
                        var chartInstance = this.chart,
                            ctx = chartInstance.ctx;

                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function (dataset, i) {
                            var meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function (bar, index) {
                                var data = dataset.data[index];
                                ctx.fillText(data, bar._model.x, bar._model.y - 5);
                            });
                        });
                    }
                },
                legend: {
                    "display": false
                },
                tooltips: {
                    "enabled": false
                },
                scales: {
                    yAxes: [{
                        display: true,
                        gridLines: {
                            display: true
                        },
                        ticks: {
                            max: Math.max(...data.datasets[0].data) + 10,
                            display: true,
                            beginAtZero: true,
                            autoSkip: true
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            beginAtZero: true,
                            autoSkip: false
                        }

                    }]
                }
            }
        });

        var ctx = document.getElementById("company_applies");
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: [@foreach($company_applies as $item) "{!! $item->name !!}", @endforeach],
                datasets: [{

                    data: [@foreach($company_applies as $item) {!! number_format((float)$item->answered_percent, 2) !!}, @endforeach],
                    @php $i=0; @endphp
                    backgroundColor: [
                        @foreach($company_applies as $item)@php $index[$i] = random_int(0,12); @endphp '{!! config('app.chart_back_color')[$index[$i++]] !!}', @endforeach
                    ],
                    @php $i=0; @endphp
                    borderColor: [
                        @foreach($company_applies as $item) '{!! config('app.chart_border_color')[$index[$i++]] !!}',  @endforeach
                    ],
                    borderWidth: 1
                }]

            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            autoSkip: false
                        }

                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false
                        }
                    }]
                }
            }
        });

        var ctx = document.getElementById("tickets_state");
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [@foreach($tickets_state as $key=>$item) {{--@if(!$item) @continue @endif--}} "{!! config('app.enum_ticket_status')[$key].' '.number_format((float)($item / $all_tickets * 100),2).'%' !!}", @endforeach],
                datasets: [{

                    data: [@foreach($tickets_state as $key=>$item) {{--@if(!$item) @continue @endif--}} {!! $item !!}, @endforeach],

                    backgroundColor: [
                        @foreach($tickets_state as $key=>$item) {{--@if(!$item) @continue @endif--}} "{!! config('app.enum_ticket_status_colors')[$key] !!}", @endforeach
                    ],

                    borderWidth: 1
                }]

            },
            options: {}
        });

        var ctx = document.getElementById("applies_state");
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [@foreach($applies_state as $key=>$item) {{--@if(!$item[0]) @continue @endif --}}"{!! $key.' '.number_format((float)($item[0] / $all_applies * 100),2).'%' !!}", @endforeach],
                datasets: [{

                    data: [@foreach($applies_state as $key=>$item) {{--@if(!$item[0]) @continue @endif --}} {!! $item[0] !!}, @endforeach],

                    backgroundColor: [
                        @foreach($applies_state as $item) {{--@if(!$item[0]) @continue @endif --}} @php $index = random_int(0,12); @endphp '{!! $item[1] !!}', @endforeach
                    ],

                    borderWidth: 1
                }]

            },
            options: {}
        });

                @if($users_inputs_companies->count())
        var ctx = document.getElementById("input_users");
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [@foreach($users_inputs_companies as $item) {{--@if(!$item[0]) @continue @endif --}}"{!! $item->company_name !!}", @endforeach],
                datasets: [{

                    data: [@foreach($users_inputs_companies as $item) {{--@if(!$item[0]) @continue @endif --}} {!! $item->user_count !!}, @endforeach],

                    backgroundColor: [
                        @foreach($users_inputs_companies as $item) {{--@if(!$item[0]) @continue @endif --}}  '{!! config('app.chart_back_color')[random_int(0, 12)] !!}', @endforeach
                    ],

                    borderWidth: 1
                }]

            },
            options: {}
        });
                @endif

        var ctx = document.getElementById("users_referer");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [@foreach($users_referer as $item) "{!! config('app.enum_referer')[$item->referer ] !!}", @endforeach],
                datasets: [{

                    data: [@foreach($users_referer as $item) {!! number_format((float)($item->user_count/$total_users_have_referer*100),2) !!}, @endforeach],
                    @php $i=0; $index = array(); @endphp
                    backgroundColor: [
                        @foreach($users_referer as $item)@php $index[$i] = random_int(0,12); @endphp '{!! config('app.chart_back_color')[$index[$i++]] !!}', @endforeach
                    ],
                    @php $i=0; @endphp
                    borderColor: [
                        @foreach($users_referer as $item) '{!! config('app.chart_border_color')[$index[$i++]] !!}',  @endforeach
                    ],
                    borderWidth: 1
                }]

            },
            options: {
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem, data) {
                            return tooltipItem.yLabel + '%';
                        },
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            autoSkip: false,
                            callback: function (value, index, values) {
                                return '%' + value;
                            }
                        }

                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false,

                        }
                    }]
                }
            }
        });

        var ctx = document.getElementById("resume_industries");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [@foreach($resume_industries as $item) "{!! $item->name .' '. number_format((float)($item->count/$total_users_have_referer*100),2)!!}%", @endforeach],
                datasets: [{

                    data: [@foreach($resume_industries as $item) {!! $item->count !!}, @endforeach],
                    @php $i=0; $index = array(); @endphp
                    backgroundColor: [
                        @foreach($resume_industries as $item)@php $index[$i] = random_int(0,12); @endphp '{!! config('app.chart_back_color')[$index[$i++]] !!}', @endforeach
                    ],
                    @php $i=0; @endphp
                    borderColor: [
                        @foreach($resume_industries as $item) '{!! config('app.chart_border_color')[$index[$i++]] !!}',  @endforeach
                    ],
                    borderWidth: 1
                }]

            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            autoSkip: false,
                        }

                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false,

                        }
                    }]
                }
            }
        });

        var ctx = document.getElementById("user_forms");
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [@foreach($user_forms as $key=>$item) '{!! $key !!}', @endforeach],
                datasets: [{

                    data: [@foreach($user_forms as $key=>$item)  {!! $item !!}, @endforeach],

                    backgroundColor: [
                        @foreach($user_forms as $item) @php $index = random_int(0,12); @endphp '{!! config('app.chart_back_color')[$index] !!}', @endforeach
                    ],

                    borderWidth: 1
                }]

            },
            options: {}
        });
    </script>

@endsection