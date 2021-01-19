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
@if(Request::route()->getName() == 'site.search.tags')
سامانه منابع انسانی گروه صنعتی گلرنگ :: {{$query}}
@endif
@endsection

@section('content')
<div class="container cd-main-content cd-inner-content">
        <fieldset class="red-fieldset mt-4">
            <legend>نتایج جستجو</legend>
        </fieldset>
        <div class="row wrap-content">
            @if(Request::route()->getName() == 'site.search.tags')
            <div class="col-md-9 col-sm-12 col-12 left-jobs">
                <div class="col-12 top-searchjob no-padd no-padd-xs">
                    <div class="text-right rtl">تعداد <span>{{$search_result_counter}}</span> مورد یافت شد.</div>
                </div>
                @else
                <div class="col-12 left-jobs">
                    @endif
                    @if(isset($jobs) && $jobs->count())
                    <div class="col-xs-12 title-rjobs no-padd no-padd-xs">
                        <fieldset class="red-fieldset">
                            <legend>فرصت های شغلی</legend>
                            @if($jobs->count()>4)
                            <a href="">
                                <legend class="more-left-btn">مشاهده بیشتر</legend>
                            </a>
                            @endif
                        </fieldset>
                    </div>

                    <div class="row">

                        @foreach($jobs->limit(4)->get() as $job)

                        <div class="col-md-3 col-sm-4 col-ms-6 col-12">
                            <div class="clearfix grid-searchjob card col-12 job-item"  @if($job->status == 3) style="opacity: 0.5" @endif>
                                <a href="" class="grid-img text-center">
                                    <img class="img-fluid" src="{{$job->company->get_gig_data()['logo']}}" alt="">
                                </a>
                                <div class="clearfix wrapper-grid">
                                    @if(Auth::check())
                                    <a href="javascript:void(0);" class="grid-like"
                                       onclick="ajax_fav({{$job->id}});">

                                        <img class="img-fluid"
                                             src="/site/default/img/{{(in_array(Auth::user()->id,$job->users()->pluck('user_id')->toArray())?'hr_like.png':'hr_dislike.png')}}"
                                             id="fav_img_{{$job->id}}" alt="favorite">

                                    </a>
                                    @else
                                    <a href="javascript:void(0);" class="grid-like" data-toggle="modal"
                                       data-target="#WarningModal">

                                        <img class="img-fluid"
                                             src="/site/default/img/hr_like.png"
                                             id="fav_img_{{$job->id}}" alt="favorite">

                                    </a>
                                    @endif

                                    <a href="{{route('jobs.show',$job->persian_alias)}}" class="text-right text-dark"><h6>{{$job->title}}</h6></a>
                                    <h6 class="job-item-company text-right font-13">{{$job->company->name}}</h6>

                                    <!--
                                    <a class="grid-time color{{$job->cooperation_type}}-timejob-grid">
                                        {{$job->cooperation_type_name()}}
                                    </a>
                                    -->
                                    <div class="clearfix wrap-grid-btn">
                                        <div class="job-item-location text-right">
                                            <img class="ml-1" src="/site/default/Template_2019/img/placeholder_o.svg">
                                            <span class="font-13">
                                                @php
    
                                                $cities = $job->cities;
                                                $result = array();
                                                foreach ($cities as $city)
                                                {
                                                $result[$city->province->name] = 1;
                                                }
                                                $result = array_keys($result);
                                                if(count($result) == \HR\Province::all()->count())
                                                echo 'کل کشور';
                                                elseif(count($result) > 1 && count($result) < \HR\Province::all()->count() )
                                                echo 'شهرهای متعدد';
                                                else
                                                {
                                                echo $result[0];
                                                }
    
                                                @endphp                                        
                                                </span>
                                        </div>
                                        
                                        @if(Auth::check())
                                        @if($job->apply(Auth::user()->id))
                                        <!-- <a href="{{route('jobs.show',$job->alias)}}" class="request-jobs"><i
                                                class="fa fa-arrow-left"></i> درخواست</a>-->
                                        @else
                                        <a class="request-jobs">ثبت شده</a>
                                        @endif
                                        @else
                                        <a href="{{route('jobs.show',$job->alias)}}" class="request-jobs"><i
                                                class="fa fa-arrow-left"></i> درخواست</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>

                    @endif
                    @if($news->count())

                    <div class="col-12 title-search no-padd no-padd-xs">
                        <fieldset class="red-fieldset">
                            <legend>اخبار</legend>
                        <a href="{{route('site.search.news',['query'=>$query])}}">
                            @if($news->count()>5)
                            <legend class="more-left-btn">مشاهده بیشتر</legend>
                            @endif
                        </a>
                        </fieldset>                            
                    </div>
                    <div class="col-12 no-padd no-padd-xs">
                        <section class="inner-content-result text-right">
                            <ul>
                                @foreach($news->limit(5)->get() as $new)
                                <li class="text-right"><a class="job-item-company text-right font-13"
                                        href="{{route('site.news.show',$new->alias)}}">
                                    {{$new->title}}
                                </a><span
                                        class="date-searchnews float-left">{{JDate::createFromCarbon(Carbon::parse($new->created_at))->format('l j F Y')}}</span>
                                </li>
                                @endforeach
                            </ul>
                        </section>
                    </div>

                    @endif

                    @if($books->count())

                    <div class="col-12 title-search no-padd no-padd-xs">
                        <fieldset class="red-fieldset mt-7">
                            <legend>کتاب</legend>
                        <a href="{{route('site.search.books',['query'=>$query])}}">
                            @if($books->count()>5)
                            <legend class="more-left-btn">مشاهده بیشتر</legend>
                            @endif
                        </a>
                        </fieldset>
                    </div>
                    <div class="col-12 no-padd no-padd-xs">
                        <section class="inner-content-result">
                            <ul>
                                @foreach($books->limit(5)->get() as $book)
                                <li class="text-right list-group-item border-0"><a class="job-item-company text-right font-13"
                                        href="{{route('site.books.show',$book->slug)}}">
                                    {{$book->book_name}}
                                </a><span
                                        class="date-searchnews float-left">{{JDate::createFromCarbon(Carbon::parse($book->created_at))->format('l j F Y')}}</span>
                                </li>
                                @endforeach
                            </ul>
                        </section>
                    </div>

                    @endif

                    @if($blog->count())

                    <div class="col-12 title-search no-padd no-padd-xs">
                        <fieldset class="red-fieldset mt-7">
                            <legend>وبلاگ</legend>
                        <a href="{{route('site.search.blog',['query'=>$query])}}">
                            @if($blog->count()>5)
                            <legend class="more-left-btn">مشاهده بیشتر</legend>
                            @endif
                        </a>
                        </fieldset>
                    </div>
                    <div class="col-12 no-padd no-padd-xs">
                        <section class="inner-content-result">
                            <ul>
                                @foreach($blog->limit(5)->get() as $blog)
                                <li class="text-right list-group-item border-0"><a class="job-item-company text-right font-13"
                                        href="{{route('site.blog.show',$blog->alias)}}">
                                    {{$blog->title}}
                                </a><span
                                        class="date-searchnews float-left">{{JDate::createFromCarbon(Carbon::parse($blog->created_at))->format('l j F Y')}}</span>
                                </li>
                                @endforeach
                            </ul>
                        </section>
                    </div>

                    @endif
                    @if(isset($static_pages) &&  $static_pages->count())

                    <div class="col-12 title-search no-padd no-padd-xs">
                        <fieldset class="red-fieldset mt-7">
                            <legend>سایر</legend>
                            <a href="{{route('site.search.static_pages',['query'=>$query])}}">
                                @if($static_pages->count()>5)
                                <legend class="more-left-btn">مشاهده بیشتر</legend>
                                @endif
                            </a>
                        </fieldset>
                    </div>
                    <div class="col-12 no-padd no-padd-xs">
                        <section class="inner-content-result">
                            <ul>
                                @foreach($static_pages->limit(5)->get() as $static_page)
                                <li class="text-right list-group-item border-0"><a class="job-item-company text-right font-13"
                                        href="{{route('site.statics.pages',$static_page->alias)}}">
                                    {{$static_page->title}}
                                </a><span
                                        class="date-searchnews float-left">{{JDate::createFromCarbon(Carbon::parse($static_page->created_at))->format('l j F Y')}}</span>
                                </li>
                                @endforeach
                            </ul>
                        </section>
                    </div>

                    @endif
                    @if($events->count())

                    <div class="col-12 title-search no-padd no-padd-xs">
                        <fieldset class="red-fieldset mt-7">
                            <legend>رویدادها</legend>
                            <a href="{{route('site.search.events',['query'=>$query])}}">
                                @if($events->count()>5)
                                <legend class="more-left-btn">مشاهده بیشتر</legend>
                                @endif
                            </a>
                        </fieldset>
                    </div>
                    <div class="col-12 no-padd no-padd-xs">
                        <section class="inner-content-result">
                            <ul>
                                @foreach($events->limit(5)->get() as $event)
                                <li class="text-right list-group-item border-0"><a class="job-item-company text-right font-13"
                                        href="{{route('site.events.show',$event->alias)}}">
                                    {{$event->title}}
                                </a><span
                                        class="date-searchnews float-left">{{JDate::createFromCarbon(Carbon::parse($event->created_at))->format('l j F Y')}}</span>
                                </li>
                                @endforeach
                            </ul>
                        </section>
                    </div>

                    @endif

                </div>
                @if(Request::route()->getName() == 'site.search.tags')
                <div class="col-md-3 col-sm-12 col-12 left-jobs">
                    @include('site.modules.all_content_tags')
                </div>
                @endif
            </div>
        </div>
    @endsection

    @section('script')
    <script>
        function ajax_fav(id) {

            $.ajax({
                type: "POST",
                url: '{{route('jobs.make.favorite')}}',
                data: 'id=' + id + '&_token={{csrf_token()}}',
                success: function (data) {

                // deleted , added
                if (data == "added")
                    $('#fav_img_' + id).attr('src', '/site/default/img/hr_like.png');
                else if (data == "deleted")
                    $('#fav_img_' + id).attr('src', '/site/default/img/hr_dislike.png');

            }
        });

        }
    </script>

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