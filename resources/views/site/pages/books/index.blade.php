@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Golrang Human Resource">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: معرفی کتاب
@endsection

@section('content')
    <div class="cd-main-content cd-inner-content container">
            <fieldset class="red-fieldset mt-4 mb-4">
                <legend>معرفی کتاب</legend>
            </fieldset>        
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @foreach($books  as $book)
                        @if(($loop->index +1) != 3 && ($loop->index +1) != 6)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mt-3">
                                        <div class="col-md-12 card mb-3 pt-3 text-right font-13">
                                            <a href="" class="text-center pb-3 font-weight-bold"><img src="{{$book->img}}" alt="" width="170" height="170" ></a>
                                            <div class="clearfix name-book pb-3">
                                                <a class="n-books text-dark text-center font-14 d-block" href="{{route('site.books.show',$book->slug)}}">{{$book->book_name}}</a>
                                                <hr>
                                                <span class="d-block">نویسنده کتاب<span>{{$book->author}}</span></span>
                                                <span class="d-block">انتشارات<span>{{$book->publication_name}}</span></span>
                                                <span class="d-block publish-date">تاریخ انتشار<span>{{$book->release_date}}</span></span>
                                                <a href="{{route('site.books.show',$book->slug)}}" class="more-books mt-2 d-block"> ادامه مطلب <i class="fa fa-angle-left"></i> </a>
                                            </div>
                                        </div>
                                </div>
                        @endif
                        @endforeach
                    </div>                    
                    <div class="text-center">
                        <ul class="pagination">
                            {!! $books->links() !!}
                        </ul>
                    </div>
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