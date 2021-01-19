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

    <div class="cd-main-content cd-inner-content">
        <div class="clearfix container inner-content">
            <div class="col-xs-12 wrap-content">
                <div class="col-xs-12 no-padd no-padd-xs video-page">
                    @foreach(\HR\VideoGallery::all()->where('parent_id','<>',6)->where('id','<>',6) as $cat)
                        @if($cat->videos->count() == 0 )
                            @continue
                        @endif
                        <div class="col-xs-12 title-search"
                             style="direction: rtl; margin-top : 30px; margin-bottom: 10px">
                            <h3 class="wow fadeIn  animated"
                                style="visibility: visible; animation-name: fadeIn; display: inline-block;"><i
                                        class="fa {{$cat->icon}}" aria-hidden="true"></i> {{$cat->name}}</h3>
                            <a href="{{route('site.pages.videos.show',$cat->id)}}" class="see-more">
                                مشاهده همه <i class="fa fa-angle-left"></i>
                            </a>
                        </div>

                        <div class="row" style="direction: rtl">
                            @foreach($cat->videos->orderByDesc('sort_order')
                ->orderByDesc('created_at') as $video)
                                @if($loop->index == 4)
                                    @break
                                @endif
                                <div class="item mt-30"
                                     onmouseover="$('#PlayIcon{{$loop->index.$cat->id}}').stop().fadeIn();"
                                     onmouseout="$('#PlayIcon{{$loop->index.$cat->id}}').stop().fadeOut()">
                                    <div class="thumb" onclick="clicksound.playclip()">
                                        <a href="{{route('site.pages.videos.single_page',$video->slug)}}" style="height:150px;cursor: default;
                                          display:block;position:relative;">
                                            <img src="{{$video->avatar}}" width="100%" height="150px"/>
                                            {{--<span class="time-video">24:36</span>--}}
                                            <span class="group-video">{{$video->category->name}}</span>
                                            <img style="display:none;cursor: pointer"
                                                 id="PlayIcon{{$loop->index.$cat->id}}"
                                                 src="/site/default/img/owl.video.play.png" class="icon-video">
                                        </a>
                                        <a href="{{route('site.pages.videos.single_page',$video->slug)}}"
                                           class="cbp-l-grid-masonry-projects-title">{{$video->name}}</a>
                                        <div class="c-view-video"><span>{{$video->visitCount}} مشاهده</span> .
                                            <span>{{$video->created_at}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach()
                        </div>

                    @endforeach()
                </div>
            </div>
        </div>
@endsection

@section('script')
@endsection