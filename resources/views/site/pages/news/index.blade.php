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
    سامانه منابع انسانی گروه صنعتی گلرنگ :: اخبار
@endsection

@section('content')
      <div class="container cd-main-content cd-inner-content">
            <fieldset class="red-fieldset mt-4 mb-4">
                <legend>اخبار</legend>
            </fieldset>
            <div class="row top-address">
                    @foreach($contents as $content)
                    @php
                        $i++;
                    @endphp
                      <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                        <div class="card p-0 col-md-12">
                            <div class="card-header p-0"><img class="img-fluid" src="{{$content->xxl_image}}" /></div>
                            <div class="card-body"><a href="{{route('site.news.show',$content->alias)}}"class="blog-title-inner font-13 text-dark text-right d-block">{{$content->title}}</a></div> 
                        </div>
                      </div>
                    @endforeach
                    <div class="col-md-12">
                        <hr>
                    </div>                    
                <div class="text-center">
                    <ul class="pagination" style="direction: ltr !important;">
                        {!! $contents->links() !!}
                    </ul>
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