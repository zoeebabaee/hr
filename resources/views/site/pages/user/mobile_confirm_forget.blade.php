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
    سامانه منابع انسانی گروه صنعتی گلرنگ :: تایید شماره موبایل
@endsection

@section('content')
    <div class="cd-main-content cd-inner-content">
        <div class="col-xs-12 wrapper-breadcrumb">
            <div class="p-breadcrumbs">
                <ul class="page-breadcrumbs">
                    <li>
                        <a href="{{route('home')}}"> اصلی</a>
                    </li>
                    <li> <i class="fa fa-angle-left"></i> </li>
                    <li class="c-state_active">
                        فراموشی رمز عبور
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 top-innerpage" style="background:url('/site/default/img/banner_blog.png') no-repeat top center/cover;">
            <div class="container"><h1 class="wow animated fadeInUp"> تایید شماره موبایل </h1></div>
        </div>
        <div class="clearfix container inner-content">
            <div class="col-xs-12 wrap-content">
                <div class="col-xs-12 left-jobs no-padd-xs no-padd">
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
                    <div class="col-md-12 col-md-pull-3 text-center mt-5">
                        {{--<h3 class="inner-title1"> تایید شماره موبایل</h3>--}}
                        <fieldset class="red-fieldset">
                            <legend class="text-center "> تایید شماره موبایل</legend>
                        </fieldset>
                        <form action="{{route('user.forget.confirm.mobile.post',$mobile)}}" method="POST">
                            {{csrf_field()}}
                        <section class="content text-center">
                            <div class="col-md-6 col-10 m-auto">
                                <div class="people-forms-fields-group">
                                    <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg"></div>
                                    <input class="people-forms-fields input__field input__field--minoru form-control" autocomplete="off" name="code" type="text" id="input-10">
                                    <label> کد ارسالی</label>
                                </div>
                            </div>

                        </section>
                        <input type="hidden" name="mobile" value="{{$user->mobile}}">
                        <div class="row mt-4">
                            <div class="col-md-12 text-center">
                                <input type="submit" name="login" class="request-jobs login-btn m-atu col-8 col-md-3 m-auto" value="تایید">
                            </div>
                            <fieldset class="sec-1-fieldset m-0 mt-4 mb-2">
                                <legend class="font-13"></legend>
                            </fieldset>
                            <div class="col-md-12 text-center">
                                <input type="submit" name="resend" class="request-jobs register-btn d-block text-center pt-1 col-8 col-md-3 m-auto" value="ارسال دوباره">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $(".close-error").click(function(){
                $(".bg-error").hide();
                return false;
            });

        });
    </script>
@endsection