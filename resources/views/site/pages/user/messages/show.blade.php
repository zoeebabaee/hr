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
                        <a href="">صفحه اصلی</a>
                    </li>
                    <li> <i class="fa fa-angle-left"></i> </li>
                    <li class="c-state_active">
                        حساب کاربری
                    </li>
                    <li> <i class="fa fa-angle-left"></i> </li>
                    <li class="c-state_active">
                        لیست درخواست ها
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 top-innerpage" style="background:url('/site/default/img/banner.jpg') no-repeat top center/cover;">
            <div class="container"><h1 class="wow animated fadeInUp"> لیست درخواست ها </h1></div>
        </div>

        <div class="clearfix container inner-content">
            <div class="col-xs-12 wrap-content">
                @include('site.pages.user.side_bar')
                <div class="col-md-9 col-sm-12 col-xs-12 left-jobs no-padd-xs no-padd-l">
                    @if (count($errors) > 0)
                        <div class="bg-error" style="text-align: right">
                            <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                            @foreach ($errors->all() as $error)
                                <p style="direction: rtl" >{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    @if(Session::has('flash_message'))
                        <div class="bg-error" style="text-align: right">
                            <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                            <p style="direction: rtl" >{!! session('flash_message') !!}</p>
                        </div>
                    @endif
                        <div class="bg-error" style="text-align: right">
                            <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                            <p style="direction: rtl">از این پس پیام های خود را در بخش مدیریت تیکت ها مشاهده کنید.</p>
                        </div>
                    <div class="col-lg-12 ">

                        <div class="mail-box-header">
                            <div class="pull-left tooltip-demo">
                                <span class="pull-right font-noraml">{{JDate::createFromCarbon(Carbon::parse($message->created_at))->format('l j F Y , H:i')}}</span>
                            </div>

                            <div class="mail-tools tooltip-demo m-t-md">

                                <h3>
                                    <span class="font-noraml">موضوع: </span>{{$message->subject}}
                                </h3>

                                <h5>

                                    <span class="font-noraml">از طرف: </span>{{$message->sender_user->first_name.' '.$message->sender_user->last_name}}
                                    @if($message->sender_user->company->count())
                                        ({{$message->sender_user->company->first()->name}})
                                    @endif
                                </h5>

                            </div>
                        </div>
                        <hr>
                        <div class="mail-box">


                            <div class="mail-body">
                                <p>
                                    {!! $message->body !!}
                                </p>
                            </div>
                            <hr>
                            <div class="mail-body text-right tooltip-demo">
                                @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() != 'user.messages.sent')
                                    <a class="btn btn-sm btn-white" style="display: inline;" href="{{route('user.messages.reply',$message->id)}}"><i class="fa fa-reply"></i> پاسخ</a>
                                @endif
                                @if($message->deleted_at==null)
                                {!! Form::open(['method' => 'DELETE', 'route' => ['user.messages.destroy', $message->id],'style'=>'display: inline;' ]) !!}
                                {!! Form::button('<i class="fa fa-trash"></i> حذف', ['type'=>'submit','class' => 'btn btn-sm btn-white']) !!}
                                {!! Form::close() !!}

                                @else
                                {!! Form::open(['method' => 'POST', 'route' => ['user.messages.restore', $message->id],'style'=>'display: inline;' ]) !!}
                                {!! Form::button('<i class="fa fa-undo"></i> بازگردانی', ['type'=>'submit','class' => 'btn btn-sm btn-white']) !!}
                                {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection