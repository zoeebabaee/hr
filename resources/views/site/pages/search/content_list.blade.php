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
    سامانه منابع انسانی گروه صنعتی گلرنگ :: نتایج جستجو
@endsection

@section('content')
    <div class="container cd-inner-content">
        <div class="col-12 no-padd">
            <fieldset class="red-fieldset mt-4 mb-4">
                <legend>نتایج جستجو  </legend>
            </fieldset>
        <div class="clearfix inner-content">
            <div class="clearfix top-searchjob">
                <div class="clearfix">تعداد <span>{{$search_result_counter}}</span> مورد یافت شد.</div>
            </div>
            <div class="clearfix wrap-content">
                @if(Request::route()->getName() == 'site.search.blog.tags' || Request::route()->getName() == 'site.search.events.tags'
               || Request::route()->getName() == 'site.search.news.tags'||Request::route()->getName() == 'site.search.static_pages.tags'
               || Request::route()->getName() == 'site.search.books.tags')
                    <div class="col-9 left-jobs">
                @else
                    <div class="col-12 left-jobs">
                @endif
                    {{--
                    ########################################  News,Blog,Events results list
                    --}}



                    <div class="clearfix title-search">
                            <h3 class="wow fadeIn animated">
                                @if($type=="news")
                                    اخبار
                                @elseif($type=="events")
                                رویدادها
                                @elseif($type=="blog")
                                وبلاگ
                                @elseif($type=="static_pages")
                                    سایر
                                @elseif($type=="book")
                                        کتاب ها
                                @endif

                            </h3>
                        </div>
                    <div class="col-12">
                            <section class="inner-content-result">
                                <ul>
                                    @foreach($content->get() as $con)
                                        <li><i class="fa fa-angle-left bolet-news"></i>
                                        
                                            @if($type=="news")
                                                <a href="{{route('site.news.show',$con->alias)}}">
                                                    {{$con->title}}
                                            @elseif($type=="events")
                                                <a href="{{route('site.events.show',$con->alias)}}">
                                                    {{$con->title}}
                                            @elseif($type=="blog")
                                                <a href="{{route('site.blog.show',$con->alias)}}">
                                                    {{$con->title}}
                                            @elseif($type=="static_pages")
                                                <a href="{{route('site.statics.pages',$con->alias)}}">
                                                    {{$con->title}}
                                            @elseif($type=="book")
                                                <a href="{{route('site.books.show',$con->slug)}}">
                                                    {{$con->book_name}}
                                            @endif


                                            </a><span
                                                    class="date-searchnews">{{JDate::createFromCarbon(Carbon::parse($con->created_at))->format('l j F Y')}}</span></li>
                                    @endforeach
                                </ul>
                            </section>
                        </div>
                </div>
                @if(Request::route()->getName() == 'site.search.blog.tags' || Request::route()->getName() == 'site.search.events.tags'
   || Request::route()->getName() == 'site.search.news.tags'|| Request::route()->getName() == 'site.search.static_pages.tags'
   || Request::route()->getName() == 'site.search.books.tags')
                    <div class="col-xs-3 left-jobs no-padd-xs no-padd">
                        @include('site.modules.all_content_tags')
                    </div>
                @endif

            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        function ajax_fav(id){

            $.ajax({
                type: "POST",
                url: '{{route('jobs.make.favorite')}}',
                data: 'id='+id+'&_token={{csrf_token()}}',
                success: function (data){

                    // deleted , added
                    if(data=="added")
                        $('#fav_img_' + id).attr('src', '/site/default/img/hr_like.png');
                    else if(data=="deleted")
                        $('#fav_img_' + id).attr('src', '/site/default/img/hr_dislike.png');

                }

        });
        }
    </script>
@endsection