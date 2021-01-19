@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    نتایج ارزیابی
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
            <h2>نتایج ارزیابی</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/adpanel">
                        خانه</a>
                </li>
                <li  class="active">
                    <a><strong>
                            لیست نتایج</strong></a>
                </li>

            </ol>
        </div>
    </div>

    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">
        <div class="row">
            <div class="col-lg-12">
                <br><br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>کاربر</th>
                            <th>نتیجه ارزیابی</th>
                            <th>نویسنده نتیجه</th>
                            <th>شغل مربوطه</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->user->first_name. ' ' .$comment->user->last_name}}</td>
                                <td>{!! $comment->comment !!}</td>
                                <td>{{ $comment->admin->first_name. ' ' .$comment->admin->last_name}}</td>
                                <td>{{ $comment->job->title }}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {!! $comments->links() !!}
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
    <!-- Flot -->

    <!-- Custom and plugin javascript -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/rada.js') }}

    <!-- jQuery UI -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/jquery-ui/jquery-ui.min.js') }}

    <!-- Sweet alert -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/sweetalert/sweetalert.min.js') }}


@endsection
@section('scripts_page')

    <script>
        $(document).ready(function () {
            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }
        });
    </script>

@endsection
