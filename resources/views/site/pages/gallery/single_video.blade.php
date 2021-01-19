@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('custom_css')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
    سامانه منابع انسانی :: {{$video->name}}
@endsection

@section('content')
    <div class="container cd-inner-content">
        <div class="col-12 no-padd no-padd-xs">
            <fieldset class="red-fieldset mt-4 mb-4">
                <legend>ویدیو   </legend>
            </fieldset>
            <div class="row wrap-content">
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 text-right">
                    <div class="clearfix row-videos">
                        <div class="videotag mb-4">
                            {!! $video->video !!}
                        </div>
                        <div class="clearfix wrap-row-news">
                            <h2 class="title-detail-video"><a href="{{route('site.pages.videos.single_page',$video->slug)}}"> </a>{{$video->name}}</h2>
                            <p>
                                {!! $video->body !!}
                            </p>
                            <p class="wrap-date-news"><span class="date-news"><img src="/site/default/img/time.png" alt="" width="16" height="16"> {{$video->created_at}} </span> <span class="view-video"><i class="fa fa-eye" aria-hidden="true"></i> {{$video->visitCount}}</span> </p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12 col-12 left-jobs">
                    <div class="clearfix wrap-rjobs">
                        <div class="title-rjobs title-search2">
                            <fieldset class="red-fieldset mt-0">
                                <legend>ویدیو های مرتبط</legend>
                            </fieldset>
                        </div>
                         @foreach($video->category->videos as $video_1)
                                    @if($video_1->id == $video->id)
                                        @continue
                        @endif
                        <div class="row articles-part mb-3">
                            <div class="col-4 text-right"><img src="{{$video_1->avatar}}" width="100" class="img-fluid"></div>
                            <div class="col-8 text-right p-0">
                                <a href="{{route('site.pages.videos.single_page',$video_1->slug)}}">{{$video_1->name}}</a>
                                <div class="articles-date">{{$video_1->created_at}}</div>
                            </div>
                        </div>
                        <hr>
                        @endforeach()

                    </div>
                    <div class="clearfix wrap-rjobs">
                        <div class="title-rjobs title-search5">
                            <fieldset class="red-fieldset mt-0">
                                <legend>تازه ترین ویدیوها</legend>
                            </fieldset>                                    
                        </div>
                        @foreach(\HR\Videos::all()->sortByDesc('created_at') as $video_1)
                            @if($loop->index == 5)
                                @break
                            @endif
                            @if($video_1->id == $video->id)
                                @continue
                            @endif
                        <div class="row articles-part mb-3">
                            <div class="col-4 text-right"><img src="{{$video_1->avatar}}" width="100" class="img-fluid"></div>
                            <div class="col-8 text-right p-0">
                                <a href="{{route('site.pages.videos.single_page',$video_1->slug)}}">{{$video_1->name}}</a>
                                <div class="articles-date">{{$video_1->created_at}}</div>
                            </div>
                        </div>
                        <hr>
                        @endforeach()                           
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection