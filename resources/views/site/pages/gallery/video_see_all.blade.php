@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
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
    سامانه منابع انسانی :: گالری ویدیو
@endsection

@section('content')
<div class="video-page container">
        <fieldset class="red-fieldset mt-4 mb-4">
            <legend>{{$cat->name}}</legend>
        </fieldset>
        <div class="row">
            @foreach($videos as $video)
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                    <div class="clearfix text-right card item" onmouseover="$('#PlayIcon{{$loop->index}}').stop().fadeIn();"  onmouseout="$('#PlayIcon{{$loop->index}}').stop().fadeOut()">
                        <div class="thumb" onclick ="clicksound.playclip()" >
                            <a href="{{route('site.pages.videos.single_page',$video->slug)}}" style="height:150px;cursor: default; display:block;position:relative;">
                                <img src="{{$video->avatar}}" width="100%" height="150px" alt="" title="">
                                {{--<span class="time-video">24:36</span>--}}
                                <img style="display:none;cursor: pointer" id="PlayIcon{{$loop->index}}" src="/site/default/img/owl.video.play.png" class="icon-video">
                            </a>
                            <a href="{{route('site.pages.videos.single_page',$video->slug)}}" class="cbp-l-grid-masonry-projects-title  mt-4 video-title">{{$video->name}}</a>
                            {{--<span class="video-company">گلرنگ سیستم</span>--}}
                            <div class="c-view-video font-13 mt-2 mb-3"><span>{{$video->visitCount}} مشاهده</span> . <span>{{$video->created_at}}</span>
                        </div>
    
                        </div>
                    </div>
                </div>
                @if($loop->index % 4 == 3)
                    <div class="clearfix"></div>
                @endif
            @endforeach()
        </div>

@endsection

@section('script')


@endsection