@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Golrang Human Resource">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('custom_css')
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
            padding: 8px;
        }
    </style>

@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: مدیریت تیکت ها
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
                        مدیریت تیکت ها
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 top-innerpage"
             style="background:url('/site/default/img/banner.jpg') no-repeat top center/cover;">
            <div class="container"><h1 class="wow animated fadeInUp"> تیکت ها </h1></div>
        </div>

        <div class="clearfix container inner-content">
            <div class="col-xs-12 wrap-content">
                @include('site.pages.user.side_bar')
                <div class="col-md-12 mt-3 text-center col-sm-12 col-xs-12 left-jobs no-padd-xs no-padd-l pr-0">
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

                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>شرکت</th>
                            <th>موضوع</th>
                            <th>وضعیت</th>
                            <th>آخرین تاریخ به روز رسانی</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($tickets as $ticket)

                            <tr>
                                {{--Company--}}
                                <td>
                                    <a href="{{route('site.tickets.show',$ticket->id)}}">
                                        {{$ticket->company->name}}
                                    </a>
                                </td>

                                {{--Subject--}}
                                <td>
                                    <a href="{{route('site.tickets.show',$ticket->id)}}">
                                        {{$ticket->subject}}
                                    </a>
                                </td>
                                {{--Status--}}
                                <td>
                                    <a style="display: inline-block;width: 100px;font-size:12px"
                                       class="{!! config('app.enum_ticket_status_tbl_class')[$ticket->status] !!}"
                                       href="{!!  route('site.tickets.show',$ticket->id)!!}">
                                        @if($ticket->status == 'closed')
                                            <i class="fa fa-lock"></i>
                                        @endif
                                        {{ config('app.enum_ticket_status')[$ticket->status] }}
                                    </a>
                                </td>
                                {{--Updated_at--}}
                                <td style="direction: ltr;text-align: right">
                                    <a href="{{route('site.tickets.show',$ticket->id)}}">
                                        {{JDate::createFromCarbon(Carbon::parse($ticket->updated_at))->format('Y/m/d - H:i')}}
                                    </a>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>

                    </table>
                    <div class="text-center">

                        <ul class="pagination" style="direction: ltr !important;">
                            {!! $tickets->appends(\Illuminate\Support\Facades\Input::except('page'))->links() !!}
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection