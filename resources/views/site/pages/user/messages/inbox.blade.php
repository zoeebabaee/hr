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
    سامانه منابع انسانی گروه صنعتی گلرنگ :: پروفایل
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
                        حساب کاربری
                    </li>
                    <li><i class="fa fa-angle-left"></i></li>
                    <li class="c-state_active">
                        پیام های دریافت شده
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 top-innerpage"
             style="background:url('/site/default/img/banner.jpg') no-repeat top center/cover;">
            <div class="container"><h1 class="wow animated fadeInUp"> پیام های دریافت شده </h1></div>
        </div>

        <div class="clearfix container inner-content">
            <div class="col-xs-12 wrap-content">
                @include('site.pages.user.side_bar')
                <div class="col-md-9 col-sm-12 col-xs-12 left-jobs no-padd-xs no-padd-l">
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
                    <div class="bg-error" style="text-align: right">
                        <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                        <p style="direction: rtl">از این پس پیام های خود را در بخش مدیریت تیکت ها مشاهده کنید.</p>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>فرستنده</th>
                            <th>عنوان</th>
                            <th>تاریخ دریافت</th>
                            <th>مدیریت</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($messages as $message)
                            <tr>
                                <td>

                                    @if($message->sender_user->company->count())
                                        منابع انسانی {{$message->sender_user->company->first()->name}}
                                    @else
                                        {{$message->sender_user->first_name.' '.$message->sender_user->last_name}}
                                    @endif
                                </td>

                                <td>
                                    {{$message->subject}}
                                </td>

                                <td>
                                    {{JDate::createFromCarbon(Carbon::parse($message->create_at))->format('l j F Y')}}
                                </td>

                                <td style="text-align: center;">
                                    <div style="float: right; margin: 2px;">
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['user.messages.destroy', $message->id] ]) !!}
                                        {!! Form::button('<i class="fa fa-trash"></i>', ['type'=>'submit','class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                    <div style="float: right; margin: 2px;">
                                        <a href="{{route('user.messages.show',$message->id)}}">
                                            <button class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection