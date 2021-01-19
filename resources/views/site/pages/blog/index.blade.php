@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="{{$contents[1]->category->meta_keywords}}">
    <meta name="keywords" content="{{$contents[1]->category->meta_description}}">
    <meta property="og:title" content="{{$contents[1]->category->title}}" />
    <meta property="og:url" content="{{route('site.blog.index')}}" />
    <meta property="og:image" content="{{route('home').$contents[1]->category->image}}" />
    <meta property="og:description" content="{{$contents[1]->category->meta_keywords}}" />
    <meta name="description" content="Golrang Human Resource">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: وبلاگ
@endsection

@section('content')
    <div class="container cd-inner-content">
        <fieldset class="red-fieldset mt-4 mb-4">
            <legend>وبلاگ</legend>
        </fieldset>
            <div class="row top-address">
                    @foreach($contents as $content)
                    @php
                        $i++;
                    @endphp
                      <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                        <div class="card p-0 col-md-12">
                            <div class="card-header p-0"><img class="img-fluid" src="{{$content->xxl_image}}" /></div>
                            <div class="card-body"><a href="{{route('site.blog.show',$content->alias)}}"class="blog-title-inner font-13 text-dark text-right d-block">{{$content->title}}</a></div> 
                        </div>
                      </div>
                    @endforeach
                <div class="text-center">
                    <ul class="pagination" style="direction: ltr !important;">
                        {!! $contents->links() !!}
                    </ul>
                </div>
            </div>
    </div>        
@endsection

@section('script')
    <script>
function is_persian(s) {
    if (s == null)
        return false;
    var PersianOrASCII = /[آ-ی]|([a-zA-Z])/;
    if ((m = s.match(PersianOrASCII)) !== null) {
        if (m[1]) {
            return false;
        } else {
            return true;
        }
    } else {
        return true;
    }
}


$('.wrap-blog h2').each(function() {
  var temp = $(this).html();
  if (temp && !is_persian(temp)) {
    $(this).css("text-align", "left");
    $(this).css("direction", "ltr");
  }
});

$('.wrap-blog p').each(function() {
  var temp = $(this).html();
  if (temp && !is_persian(temp)) {
    $(this).css("text-align", "left");
    $(this).css("direction", "ltr");
  }
});
    </script>
@endsection