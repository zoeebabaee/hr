@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Golrang Human Resource">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
    <meta name="description" content="{{$contents[0]->category->meta_keywords}}">
    <meta name="keywords" content="{{$contents[0]->category->meta_description}}">
    <meta property="og:title" content="{{$contents[0]->category->title}}" />
    <meta property="og:url" content="{{route('site.blog.index')}}" />
    <meta property="og:image" content="{{route('home').$contents[0]->category->image}}" />
    <meta property="og:description" content="{{$contents[0]->category->meta_keywords}}" />
@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: @if($edu)رویدادهای آموزشی @else رویدادها @endif
@endsection

@section('content')
        <div class="container" id="section2">
            <fieldset class="red-fieldset mt-4 mb-4">
                <legend>رویداد های آموزشی</legend>
            </fieldset>
            
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                            @php
                                $i = 0;
                            @endphp
                            @foreach($contents as $content)
                                @php
                                    $i++;
                                @endphp
                                <div class="clearfix row mb-4 rtl">
                                    <div class="col-lg-3 col-md-5 col-12">
                                         <img src="/{{$content->xxl_image}}" alt="" class="{{($i%2)?'fr-img': 'fl-img'}} rounded ml-0 ml-md-3 w-100 mb-3">
                                    </div>
                                    <div class="col-lg-9 col-md-7 col-12">
                                        <div class="clearfix wrap-row-news">
                                        <h5><a class="text-dark" href="{{route('site.events.show',$content->alias)}}">{{$content->title}}</a></h5>
                                        <span class="font-13">{!! strip_tags(HR\myFuncs::limit_words($content->body, 65))  !!} ...</span>
                                    </div>
                                    </div>
                                </div>
                            @endforeach
        
                            <div class="text-center">
                                <ul class="pagination">
                                    {!! $contents->links() !!}
                                </ul>
                            </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-12 left-jobs">
                            <div class="clearfix wrap-rjobs">
                                <fieldset class="red-fieldset mt-1">
                                    <legend>پربازدید ها</legend>
                                </fieldset>                                
                                @php
                                    $route = 'site.events.show';
                                @endphp
                                @include('site.modules.side_top_contents',compact('top_contents','route'))
                            </div>
                            @include('site.modules.archive')
                            @include('site.modules.all_content_tags')
                            
        
                </div>
                </div>
        </div>
        @endsection

        @section('script')
            {{ Html::script('/site/'.config('app.site_theme').'/js/overthrow.min.js') }}
            {{ Html::script('/site/'.config('app.site_theme').'/js/nanoscroller.js') }}
            <script>
                $(function () {

                    $('.nano').nanoScroller({
                        preventPageScrolling: true,
                        alwaysVisible: true,
                        flash: true
                    });
                });
            </script>
@endsection