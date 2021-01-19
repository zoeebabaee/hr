@extends('layout.admin.'.config('app.admin_theme').'.main')

@section('title')
    مدیریت تیکتها
@endsection

@section('header_styles')

    <!-- Sweet Alert -->
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/sweetalert/sweetalert.css') }}

@endsection

@section('content')

    <div class="col-xs-12 wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>مدیریت تیکت ها
                <small style="color: darkred;"> {{$ticket->company->name}}</small>
            </h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/adpanel">
                        خانه</a>
                </li>
                <li>
                    <a href="{{route('tickets.index')}}">لیست تیکت ها</a>
                </li>

                <li class="active">
                    <strong><a>{{ $ticket->subject }}</a></strong>
                </li>

            </ol>
        </div>
    </div>
    <div class="col-xs-12 wrapper wrapper-content animated fadeInLeft white-bg">

        <div class="row">
            <div class="col-lg-12">
                <div class="small-chat-box">
                    <div class="content">

                        @foreach($ticket_replies as $reply)
                            <div class="@if($ticket->user_id == $reply->user_id) left @else right @endif">
                                <div class="author-name" @if($ticket->user_id == $reply->user_id) title="{{ $reply->user->mobile }}" @endif>
                                    <img class="message-avatar" src="{{ $reply->user->avatar }}" @if($ticket->user_id == $reply->user_id) title="{{ $reply->user->mobile }}" @endif>
                                    {{$reply->user->first_name.' '.$reply->user->last_name}}
                                    <small class="chat-date">
                                        {{JDate::createFromCarbon(Carbon::parse($reply->created_at))->format('Y-m-d H:i:s')}}
                                    </small>
                                </div>
                                <div class="chat-message @if($ticket->user_id != $reply->user_id) active @endif">
                                    {!! $reply->body !!}
                                </div>
                            </div>
                        @endforeach

                        <div class="@if($ticket->user_id == $ticket->created_by) left @else right @endif">
                            <div class="author-name">
                                <img class="message-avatar" src="{{$ticket->creator->avatar}}" alt="">
                                {{$ticket->creator->first_name.' '.$ticket->creator->last_name}}
                                <small class="chat-date">
                                    {{JDate::createFromCarbon(Carbon::parse($ticket->created_at))->format('Y-m-d H:i:s')}}
                                </small>
                            </div>
                            <div class="chat-message @if($ticket->user_id != $ticket->created_by) active @endif">
                                {!! $ticket->body !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                {{ Form::open(array('route' => 'ticket_replies.store')) }}

                {{ Form::label('body', 'پاسخ') }}
                <p style="color:red;padding:5px;width: 100%">
                    جهت جلوگیری از به هم ریختگی متون در سایت،هرگز نام فونت را تغییر ندهید.تغییر اندازه ی فونت مانعی ندارد.
                </p>
                {{ Form::textarea('body', old('body'), array('class' => 'form-control')) }}
                <div class="clearfix"></div>
                <br>
                {{ Form::hidden('ticket_id', $ticket->id) }}
                {{ Form::select('status',[
                'answered' => 'پیام ادمین',
                'on_hold' => 'در حال بررسی',
                'in_progress' => 'در حال اقدام',
                'closed' => 'بسته',
                ], old('status')?old('status'):'answered', ['class'=>'form-control'] ) }}
                <div class="clearfix" style="margin-bottom: 15px"></div>
                {{ Form::submit('ارسال', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
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

    <script src="/vendor/ck/ckeditor.js"></script>


@endsection
@section('scripts_page')

    <script>
        $(document).ready(function () {
            if ($("#alert_messages_div")) {
                setTimeout('$("#alert_messages_div").remove();', 6000);
            }


        });

        CKEDITOR.replace('body', {
            filebrowserImageBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=Images',
            filebrowserImageUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=Images&_token=',
            filebrowserBrowseUrl: '{{ url(config('lfm.prefix')) }}?type=file',
            filebrowserUploadUrl: '{{ url(config('lfm.prefix')) }}/upload?type=file&_token='
        });
        CKEDITOR.config.language = 'fa';

    </script>

@endsection