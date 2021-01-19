@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="description" content="{{$content->meta_keywords}}">
    <meta name="keywords" content="{{$content->meta_description}}">
    <meta property="og:title" content="{{$content->title}}" />
    <meta property="og:url" content="{{route('site.news.show',$content->alias)}}" />
    <meta property="og:image" content="{{route('home').$content->main_image}}" />
    <meta property="og:description" content="{{$content->meta_description}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: {{$content->title}}
@endsection

@section('content')
 <div class="container cd-main-content cd-inner-content">
        <fieldset class="red-fieldset mt-4">
            <legend>{{$content->title}}</legend>
        </fieldset>
        <div class="clearfix container inner-content">
            <div class="row">
                <div class="col-md-9 col-sm-12 col-xs-12 no-padd-r no-padd-xs">
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
                    <div class="clearfix detail-blog text-right font-14">
                        <span class="font-13">{{JDate::createFromCarbon(Carbon::parse($content->created_at))->format('l j F Y')}}</span>
                        <div class="clearfix topbar-news">

                            @include('site.modules.content_group_header',$content)
{{--
                            <div class="pull-left">
                                <a href="mailto:?subject={{$content->title}}&body={{HR\myFuncs::limit_words(strip_tags($content->body), 60)}} ... {{ url()->current()  }}"><img src="/site/default/img/hr_email.png" alt="" width="17" height="16"></a>
                                <a href="#" onclick="window.print();return false;"><img src="/site/default/img/hr_print.png" alt="" width="17" height="16"></a>
                            </div>
                            --}}
                        </div>
                        <img src="{{$content->banner_image}}" width="100%" alt="" class="img-responsive imginner-blog mb-3">
                        {!! $content->body !!}
                        <div class="col-xs-12 no-padd no-padd-xs clearfix wrap-icon">
                            <div class="pull-right tags">
                                @include('site.modules.content_tags',$content)
                            </div>
{{--                        <div class="pull-left ltr-dir">
                               <div class="share-button sharer" style="display: block;">
                                   <button type="button" class="share-btn"><img src="/site/default/img/share.png" alt="" width="17" height="17"></button>
                                   <div class="social top center networks-5 ">

                                       <!-- LinkedIn Share Button -->
                                       <a class="fbtn share linkedin" rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&url={{url()->current()}}&title={{$content->title}}&summary={{HR\myFuncs::limit_words(strip_tags($content->body), 60)}} ... &source=GolrangHr"><i class="fa fa-linkedin"></i></a>

                                       <!-- Telegram Share Button -->
                                       <a class="fbtn share linkedin" rel="nofollow" href="https://telegram.me/share/url?text={{$content->title}}&url={{url()->current()}}"><i class="fa fa-telegram"></i></a>
                                   </div>
                                </div>
                            </div>
--}}                            
                        </div>
                        <div class="clearfix np-page">
{{--
                            @if($next)
                                <div class="pull-right"><a href="{{route('site.events.show',$next->alias)}}"><img src="/site/default/img/arrow-right.png" alt=""> رویداد بعدی </a></div>
                            @endif
                            @if($prev)
                                <div class="pull-left"><a href="{{route('site.events.show',$prev->alias)}}"> رویداد قبلی <img src="/site/default/img/arrow-left.png" alt=""></a></div>
                            @endif
--}}                            
                        </div>
                        @include('site.modules.comments',['comments'=>$comments])
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12 left-jobs no-padd-xs no-padd-l">
                    <div class="clearfix wrap-rjobs">
                        <fieldset class="red-fieldset mt-4">
                            <legend>آخرین مطالب</legend>
                        </fieldset>
                        @php
                            $route = 'site.events.show';
                        @endphp
                        @include('site.modules.side_top_contents',compact('top_contents','route'))
                    </div>
                    <div class="clearfix wrap-rjobs mb-3">
                        <div class="col-xs-12 l-part"><a href="{{route('site.blog.index')}}"><img src="/site/default/Template_2019/img/Group 172.svg" alt="وبلاگ" class="img-responsive" width="100%"></a></div>
                    </div>
                    <div class="clearfix wrap-rjobs">
                        <div class="col-xs-12 l-part"><a href="{{route('site.news.index')}}"><img src="/site/default/Template_2019/img/Group 173.svg" alt="اخبار" class="img-responsive" width="100%"></a></div>
                    </div>
                    @include('site.modules.side_top_jobs')
                    @include('site.modules.archive',compact('archive_title'))
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
$( document ).ready(function() {
	//custom button for homepage
     $( ".share-btn" ).click(function(e) {
     	 $('.networks-5').not($(this).next( ".networks-5" )).each(function(){
         	$(this).removeClass("active");
    	 });
     
            $(this).next( ".networks-5" ).toggleClass( "active" );
    });   
});
</script>
@endsection