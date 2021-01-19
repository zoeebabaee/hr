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
            text-align: center;
            padding: 8px;
        }
    </style>

@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: لیست علاقمندی ها
@endsection

@section('content')
    <div class="cd-main-content cd-inner-content">
        <div class="col-xs-12 wrapper-breadcrumb">
            <div class="p-breadcrumbs">
                <ul class="page-breadcrumbs">
                    <li>
                        <a href="{{route('home')}}">صفحه اصلی</a>
                    </li>
                    <li> <i class="fa fa-angle-left"></i> </li>
                    <li class="c-state_active">
                        حساب کاربری
                    </li>
                    <li> <i class="fa fa-angle-left"></i> </li>
                    <li class="c-state_active">
                        لیست علاقمندی ها
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 top-innerpage" style="background:url('/site/default/img/banner.jpg') no-repeat top center/cover;">
            <div class="container"><h1 class="wow animated fadeInUp"> لیست علاقمندی ها</h1></div>
        </div>

        <div class="clearfix container inner-content">
            <div class="col-xs-12 wrap-content">
                @include('site.pages.user.side_bar')

                <div class="col-md-12 text-center mt-3 col-sm-12 col-xs-12 left-jobs no-padd-xs no-padd-l" id="scroll-resume">
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
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>شرکت</th>
                            <th>عنوان شغل</th>
                            <th>وضعیت آگهی</th>
                            <th>تاریخ انقضای آگهی</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jobs as $job)
                        <tr>
                            <td><a title="{{$job->company->name}}"><img src="{{$job->company->get_gig_data()['logo']}}" alt="{{$job->company->name}}" class="company-logo w-25"></a></td>
                            <td><a href="{{route('jobs.show',$job->alias)}}" title="{{$job->title}}">{{$job->title}}</a></td>
                            <td>{{$job->status == 1 ? "فعال": "خاتمه یافته"}}</td>
                            <td>{{JDate::createFromCarbon(Carbon::parse($job->expire_date))->format('l j F Y')}}</td>
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
<script>   
        if ($(window).width() < 992) {
        $(document).ready(function () {
            // Handler for .ready() called.
            $('html, body').animate({
                scrollTop: $('#scroll-resume').offset().top -20
            }, 'slow');
        });
        }
</script>
@endsection