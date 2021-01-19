@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Golrang Human Resource">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('custom_css')
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/chosen/chosen.css') }}
    {{--@if($errors)
        {{dd($errors)}}
    @endif--}}
    {{ Html::style('/site/'.config('app.site_theme').'/css/dmuploader.css') }}

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }
    </style>

@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: تیکت
@endsection

@section('content')
    <div class="cd-main-content cd-inner-content">

        <div class="col-xs-12 wrapper-breadcrumb">
            <div class="p-breadcrumbs">
                <ul class="page-breadcrumbs">
                    <li>
                        <a href="{{route('home')}}">صفحه اصلی</a>
                    </li>
                    <li><i class="fa fa-angle-left"></i></li>
                    <li class="c-state_active">
                        <a href="{{route('site.tickets.index')}}">
                            مدیریت تیکت ها
                        </a>
                    </li>
                    <li><i class="fa fa-angle-left"></i></li>
                    <li class="c-state_active">
                        مشاهده تیکت
                    </li>
                </ul>
            </div>
        </div>
        @if(Auth::user()->cover=="")
            <div class="col-xs-12 top-innerpage"
                 style="background:url('/site/default/img/banner.jpg') no-repeat top center/cover;">
                @else
                    <div class="col-xs-12 top-innerpage"
                         style="background:url('{{Auth::user()->cover}}') no-repeat top center/cover;">
                        @endif

                        <div class="container"><h1 class="wow animated fadeInUp" style="text-shadow: 0 0 8px #000000;">
                                {{$ticket->subject}} </h1></div>
                    </div>

                    <div class="clearfix container inner-content">
                        <div class="col-xs-12 wrap-content">
                            @include('site.pages.user.side_bar')
                            <div class="col-md-9 col-sm-12 col-xs-12  no-padd-xs no-padd-l" id="scroll-resume">
                                @if (count($errors) > 0)
                                    <div class="bg-error" style="text-align: right">
                                        <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                                        @foreach ($errors->all() as $error)
                                            <p style="direction: rtl">{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                                @if(Session::has('flash_message'))
                                    <div class="bg-error" style="text-align: right">
                                        <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                                        <p style="direction: rtl">{!! session('flash_message') !!}</p>
                                    </div>
                                @endif

                                <div class="clearfix wrapper-tickets" style="margin-top:15px">

                                    @foreach($ticket_replies as $reply)
                                        <div class="@if($reply->user_id == auth()->user()->id) right-tickets @else left-tickets @endif">
                                            <div class="item bg-partners clearfix @if($reply->user_id == auth()->user()->id) grey-tickets @else lightgrey-tickets @endif">
                                                <div class="clearfix wrapper-partners">

                                                    <div class="clearfix nofloat">
                                                        <h4>@if($reply->user_id == auth()->user()->id) {{$reply->user->first_name}} @else {{$ticket->company->name}} @endif</h4>
                                                        <h5 style="color:#17a0f0" class="ltr">
                                                            {{JDate::createFromCarbon(Carbon::parse($reply->created_at))->format('Y/m/d - H:i:s')}}
                                                        </h5>
                                                        <hr class="hr-ticket">

                                                        @if($reply->user_id == auth()->user()->id)<pre>@endif{!! $reply->body !!}@if($reply->user_id == auth()->user()->id)</pre>@endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                    <div class="@if($ticket->user_id == $ticket->created_by) right-tickets @else left-tickets @endif">
                                        <div class="item bg-partners clearfix @if($ticket->user_id == $ticket->created_by) grey-tickets @else lightgrey-tickets @endif">
                                            <div class="clearfix wrapper-partners">

                                                <div class="clearfix nofloat">
                                                    <h4>@if($ticket->user_id == $ticket->created_by) {{$ticket->user->first_name}} @else {{$ticket->company->name}} @endif</h4>
                                                    <h5 style="color:#17a0f0" class="ltr">
                                                        {{JDate::createFromCarbon(Carbon::parse($ticket->created_at))->format('Y/m/d - H:i:s')}}
                                                    </h5>
                                                    <hr class="hr-ticket">
                                                    @if($ticket->user_id == auth()->user()->id)<pre>@endif{!! $ticket->body !!}@if($ticket->user_id == auth()->user()->id)</pre>@endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-xs-12 no-padd no-padd-xs">
                                        <hr>
                                        @if($ticket->status != 'closed')
                                            <a class="btn btn-xs btn-outline btn-danger confirm_close_ticket pull-left" href="{!! route('site.tickets.close',[$ticket->id]) !!}">بستن تیکت</a>
                                        @endif
                                        {{ Form::open(['route' => 'ticket_replies.store','class'=>'left-jobs']) }}
                                        <fieldset>
                                            <h3> ارسال پاسخ</h3>
                                            <div class="form-group">
                                                <label class="col-md-12 control-label" for="body"></label>
                                                <div class="col-md-12">
                                                        <textarea class="form-control rtl" id="body"
                                                                  placeholder="لطفا پیغام خود را ارسال کنید."
                                                                  rows="5"
                                                                  name="body"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2">
                                                    <button type="submit" id="singlebutton" name="singlebutton"
                                                            class="center-btn">ارسال
                                                    </button>
                                                </div>
                                            </div>

                                        </fieldset>
                                        {{ Form::hidden('ticket_id', $ticket->id) }}
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
    </div>

@endsection

@section('script')
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/inputmask.binding.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/jquery.inputmask.bundle.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/phone.js') }}
    {{ Html::script('/site/'.config('app.site_theme').'/js/inputmask/phone-uk.js') }}

    {{ Html::script('/site/'.config('app.site_theme').'/js/dmuploader.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/chosen/chosen.jquery.js') }}

    <script>
        if ($(window).width() < 992) {
            $(document).ready(function () {
                // Handler for .ready() called.
                $('html, body').animate({
                    scrollTop: $('#scroll-resume').offset().top - 20
                }, 'slow');


            });
        }
        $(document).ready(function () {

            $(".close-error").click(function () {
                $(".bg-error").hide();
                return false;
            });
            $(".close-success").click(function () {
                $(".bg-success").hide();
                return false;
            });

        });

    </script>

@endsection