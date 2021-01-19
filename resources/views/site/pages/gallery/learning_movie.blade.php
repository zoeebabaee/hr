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
        .icon-video{
            position: absolute;
            top: 70px;
            left: 0;
            right: 0px;
            width: 40px;
            margin: 0px auto;
        }
        .video-title{
            height:40px;
            overflow:hidden;
        }
    </style>
@endsection

@section('title')
    سامانه منابع انسانی :: گالری ویدیو
@endsection

@section('content')

<div class="video-page container">
        @foreach($categories as $cat)
            @if($cat->videos->count() == 0 )
                @continue
            @endif
            <fieldset class="red-fieldset mt-4 mb-4">
                <legend>{{$cat->name}}</legend>
            </fieldset>
            <div class="row">
                    @foreach($cat->videos as $video)
                        @if($loop->index == 10)
                            @break
                        @endif
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                            <div class="clearfix text-right card item" onmouseover="$('#PlayIcon{{$loop->index.$cat->id}}').stop().fadeIn();"  onmouseout="$('#PlayIcon{{$loop->index.$cat->id}}').stop().fadeOut()">
                                <div class="thumb" onclick="clicksound.playclip()">
                                    <a href="{{route('site.pages.videos.single_page',$video->slug)}}" style="height:150px;cursor: default;display:block;position:relative;">
                                        <img src="{{$video->avatar}}" width="100%" height="150px" class=" mt-3 mb-4 rounded" alt="" title="">
                                        {{--<span class="time-video">24:36</span>--}}
                                        {{--<span class="group-video">{{$video->category->name}}</span>--}}
                                        <img  style="display:none;cursor: pointer" id="PlayIcon{{$loop->index.$cat->id}}" src="/site/default/img/owl.video.play.png" class="icon-video">
                                    </a>
                                    <a href="{{route('site.pages.videos.single_page',$video->slug)}}"
                                       class="cbp-l-grid-masonry-projects-title mt-4 video-title">{{$video->name}}</a>
                                    <div class="c-view-video font-13 mt-2 mb-3"><span>{{$video->visitCount}} مشاهده</span> . <span>{{$video->created_at}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach()
            </div>
            <fieldset class="mt-5 w-100">
                <legend>
                        <a href="{{route('site.pages.videos.show',$cat->id)}}" class="see-more save send-btn-green d-block">
                            مشاهده همه <i class="fa fa-angle-left"></i>
                        </a>
                </legend>
            </fieldset>   
        @endforeach()
</div>
        @endsection

        @section('script')
            <script>
                $(document).ready(function () {
                    var owl = $('.video-slider');
                    owl.owlCarousel({
                        items: 4,
                        loop: false,
                        margin: 20,
                        nav: true,
                        navText: ["", ""],
                        autoplay: true,
                        responsiveClass: true,
                        responsive: {
                            0: {
                                items: 1,
                                nav: true
                            },
                            600: {
                                items: 3,
                                nav: true
                            },
                            1000: {
                                items: 4,
                                nav: true,
                                loop: false
                            }
                        }
                    });
                })
            </script>
@endsection