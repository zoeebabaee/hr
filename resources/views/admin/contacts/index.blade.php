@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت تماس ها
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}

    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/chosen/chosen.css') }}

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
                            لیست تماس ها</strong></a>
                </li>

            </ol>
        </div>
    </div>


    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">

        <div class="row">

            <div class="col-lg-12">


                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" >
                        <thead>
                        <tr>
                            <th>
                                +/-
                            </th>
                            <th>پیام</th>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>IP</th>

                            <th>زمان</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $contact)

                            <tr class="gradeX" style="{!! $contact->read? 'color: black;' : 'font-weight: bold;color: blue;border-right: 10px solid blue;'!!} font-weight: normal; " >

                                <td style="font-size: 18pt;">
                                    <a  href="javascript:void(0);" route="{{route('contact.read',$contact->id)}}" class="read-this" onclick="$('#comment_{{$contact->id}}').toggle();var dd=$(this).html();if(dd.includes('fa-minus')){$(this).html('<i class=\'fa fa-plus-circle\'></i>');$('#commment_brief_{{$contact->id}}').show();}else{$(this).html('<i class=\'fa fa-minus\'></i>');$('#commment_brief_{{$contact->id}}').hide();}"><i class='fa fa-plus-circle'></i></a>
                                </td>
                                <td>

                                    <div id="commment_brief_{{$contact->id}}" >{{mb_substr($contact->content,0,50)}}...</div>
                                    <div id="comment_{{$contact->id}}" style="display: none;">{{$contact->message}}</div>
                                </td>
                                <td >
                                    {{$contact->name}}
                                </td>
                                <td>
                                    <a  href="mailto:{{$contact->email}}">{{$contact->email}}</a>
                                </td>
                                <td>
                                    {{$contact->IP}}
                                </td>



                                <td class="ltr-input">{{JDate::createFromCarbon(Carbon::parse($contact->created_at))->format('Y/m/d H:i A')}}</td>


                            </tr>

                        @endforeach

                        </tbody>


                    </table>

                    {!! $contacts->links() !!}

                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal_user_info" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">مشخصات کاربر:</h4>
                </div>
                <div class="modal-body">
                    <p>
                        <span id="user_info" style="font-size:15pt;"></span>
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

    <!-- Chosen -->
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/chosen/chosen.jquery.js') }}



@endsection
@section('scripts_page')

    <script>
        $('.read-this').click(function () {
            $(this).parent().parent().css("border-right","0px");
            $(this).parent().parent().css("color","black");
            $(this).parent().parent().css("font-weight","normal");
            $.ajax({
                type: "POST",
                url: $(this).attr('route'),
                data: '_token={{csrf_token()}}',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            });
        });


        $(document).ready(function () {


            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }
            var config = {
                '.chosen-select': {},
                '.chosen-select-deselect': {
                    allow_single_deselect: true
                },
                '.chosen-select-no-single': {
                    disable_search_threshold: 10
                },
                '.chosen-select-no-results': {
                    no_results_text: 'Oops, nothing found!'
                },
                '.chosen-select-width': {
                    width: "95%"
                }
            };
            for (var selector in config) {
                $(selector).chosen(config[selector]);
            }
        });



    </script>

@endsection
