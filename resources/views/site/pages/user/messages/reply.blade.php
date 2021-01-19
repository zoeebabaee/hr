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
                    <div class="col-lg-9 ">

        <div class="mail-box-header">
            <div class="mail-tools tooltip-demo m-t-md">
                <h3>
                    <span class="font-noraml">موضوع: </span>{{$message->subject}}
                </h3>
                <h5>
                    <span class="pull-right font-noraml">{{JDate::createFromCarbon(Carbon::parse($message->created_at))->format('l j F Y , H:i')}}</span>
                    <br>
                    <span class="font-noraml">از طرف: </span>{{$message->sender_user->first_name.' '.$message->sender_user->last_name}}
                    <br>
                    <span class="font-noraml">به: </span>{{$message->sender_user->first_name.' '.$message->sender_user->last_name}} @if($message->sender_user->company->count()) {{' ('.$message->sender_user->company->first()->name.')' }} @endif
                </h5>
            </div>
        </div>

        <div class="mail-box">

            {{ Form::open(array('route' => 'user.messages.store')) }}

            <div class="mail-body">

                <input type="hidden" name="receiver" value="{{$message->sender_user->id}}" />
                <input type="hidden" name="subject" value="{{$message->subject}}" />


            </div>

            <div class="mail-text">

                        <textarea name="body1" id="body1" class="form-control" style="height:300px; text-align: right; direction: rtl"></textarea>
                <textarea name="body2" id="body2" class="form-control" style="height:300px; text-align: right; direction: rtl" readonly='readonly'>
از: {{$message->sender_user->first_name.' '.$message->sender_user->last_name}} {{"\n"}}
به: {{$message->receiver_user->first_name.' '.$message->receiver_user->last_name}} {{"\n"}}
موضوع: {{$message->subject}} {{"\n"}}
تاریخ:{{JDate::createFromCarbon(Carbon::parse($message->created_at))->format('Y/m/d ساعت H:i A')}}
{{"\n"}}
{!!  str_replace('<br>',"\n",$message->body)  !!} {{"\n"}}
                        </textarea>
                <br>

                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="mail-body text-left tooltip-demo">
                {{ Form::submit('ارسال', array('class' => 'btn btn-primary')) }}
                <a href="{{route('user.messages.inbox')}}" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Discard email"><i class="fa fa-times"></i> انصراف</a>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            {{Form::close()}}
        </div>

    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection