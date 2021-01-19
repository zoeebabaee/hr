@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="{{$content->meta_keywords}}">
    <meta name="keywords" content="{{$content->meta_description}}">
    <meta property="og:title" content="{{$content->title}}" />
    <meta property="og:url" content="{{route('site.news.show',$content->id)}}" />
    <meta property="og:image" content="{{route('home').$content->main_image}}" />
    <meta property="og:description" content="{{$content->meta_description}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('custom_css')
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
    سامانه منابع انسانی :: {{$content->title}}
@endsection

@section('content')
    <div class="container cd-inner-content">
        <div class="col-12 no-padd">
            <!--<fieldset class="red-fieldset mt-4 mb-4">-->
            <!--    <legend>مدیریت عملکرد</legend>-->
            <!--</fieldset>-->

        @if( $content->banner_image != '')
        <div class="col-xs-12 top-innerpage" style="background:url('{{$content->banner_image}}') no-repeat top center/cover;">
            <div class="container"><h1 class="wow animated fadeInUp">  {{$content->title}}  </h1></div>
        </div>
        @endif()
        <div class="clearfix inner-content">
            <div class="col-xs-12 wrap-content">
                <div class="col-xs-12 left-jobs no-padd-xs no-padd innerpage-video">
                    <img src="{{$content->main_image}}" alt="" width="100%" class="img-responsive img-page img-mobile mb-3 mt-3">

                    {!! $content->body !!}

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')

@endsection