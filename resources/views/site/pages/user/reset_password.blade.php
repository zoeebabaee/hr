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
    سامانه منابع انسانی گروه صنعتی گلرنگ :: پروفایل
@endsection

@section('content')
                @include('site.pages.user.side_bar')
                <div class="container" id="scroll-resume">
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
                    <fieldset class="red-fieldset mt-7">
                        <legend>تغییر گذرواژه</legend>
                    </fieldset>
                    <form action="{{route('site.user.profile.reset.password.post')}}" method="POST">
                        {{csrf_field()}}
                        <div class="row col-md-12 m-auto">
                        <div class="reset-pass-illus col-md-6"><img src="/site/default/Template_2019/img/reset-password.svg"/></div>
                        <section class="content col-md-6 mt-7">
                                <div class="people-forms-fields-group">
                                    <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                    <input class="people-forms-fields input__field input__field--minoru form-control" value="{{old('password')}}" type="password" name="password" id="input-16"/>
                                    <label>رمز عبور جدید را وارد کنید</label>
                                </div>
                                <div class="people-forms-fields-group">
                                    <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                    <input class="people-forms-fields input__field input__field--minoru form-control" value="{{old('password_confirmation')}}" type="password" name="password_confirmation" id="input-17"/>
                                    <label>رمز عبور جدید را مجددا وارد کنید</label>
                                </div>                                
                        </section>

                        <fieldset class="mt-5 w-100">
                            <legend>
                                <input type="submit" name="login" class="request-jobs save send-btn-green" value="تایید">                                
                            </legend>
                        </fieldset>                        
                        </div>                        
                    </form>
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