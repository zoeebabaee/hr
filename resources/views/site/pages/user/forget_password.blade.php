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
    سامانه منابع انسانی :: تایید شماره موبایل
@endsection

@section('content')
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
                    
                    <div class="container mt-5">
                        <div class="row col-md-12 m-auto">
                            <div class="col-md-5 mt-5 ml-3"><img src="/site/default/Template_2019/img/login-illu.svg"/></div>
                            <section class="col-md-6 content mt-5">
                                    <fieldset class="red-fieldset">
                                        <legend class="text-center">فراموشی رمز عبور</legend>
                                    </fieldset>
                                <form class="form-horizontal people-forms row" action="{{route('user.forget.password.post')}}" method="POST">
                                    {{csrf_field()}}
                                    <section class="content w-100">
                                        <div class="col-md-12">
                                            <div class="people-forms-fields-group">
                                                <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                                <input class="people-forms-fields input__field input__field--minoru form-control" type="text" id="input-13" value="" name="mobile" placeholder="0912xxxxxxx" style="text-align: left;direction:ltr;"/>
                                                <label>شماره همراه</label>
                                            </div>
                                        </div>                                    
                                        <div class="col-md-12">
                                            <div class="people-forms-fields-group">
                                                <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                                <input class="people-forms-fields input__field input__field--minoru form-control" autocomplete="off" name="captcha" type="text" id="input-18"/>
                                                <label> تصویر امنیتی را تایپ کنید</label>
                                            </div>
                                        </div>                                                                                                                    
                                        <div class="col-md-12">
                                            <div class="people-forms-fields-group text-right">
                                                <img class="captcha_login" id="captcha_login_1" src="{{route('site.captcha','login')}}?ver=<?= time()?>">
                                                <img id="refresh-captcha" src="/site/default/Template_2019/img/refresh.svg" onclick="$('#captcha_login_1').attr('src', '{{route('site.captcha','login')}}?ver='+(new Date()).getTime());" style="cursor: pointer">
                                            </div>
                                        </div>                                           
                                        <fieldset class="mt-2 w-100">
                                            <legend>
                                            <input type="submit" name="login" class="save send-btn-green request-jobs" value="ثبت"/>
                                            </legend>
                                        </fieldset>
                                    </section>
                                </form>
                        </section>
                        </div>
                    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#captcha').attr('src', '{{route('site.captcha','forget')}}?ver='+(new Date()).getTime());
            $(".close-error").click(function(){
                $(".bg-error").hide();
                return false;
            });

        });
    </script>
@endsection