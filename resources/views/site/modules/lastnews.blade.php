@foreach($news->get() as $new)

<div class="col-md-4 col-sm-4 col-xs-12 wrapper-news-box">
    <a href="{{route('site.news.show',$new->alias)}}"><img width="336" height="189" src="{{$new->xl_image}}"></a>

    <h2>
        <a href="{{route('site.news.show',$new->alias)}}">
            {{$new->title}}
        </a>
    </h2><p>
    {!!  strip_tags(HR\myFuncs::limit_words($new->body, 18))  !!} ...
    
    </p>
<a class="more-txt-news" href="{{route('site.news.show',$new->alias)}}">ادامه مطلب<i class="fa fa-angle-left"></i></a>
    <span class="news-date">{{JDate::createFromCarbon(Carbon::parse($new->created_at))->format('l j F Y')}}</span>
</div>

@endforeach