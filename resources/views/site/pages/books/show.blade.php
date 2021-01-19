@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: {{$book->book_name}}
@endsection

@section('content')
    <div class="cd-main-content cd-inner-content container">
        <fieldset class="red-fieldset mt-4">
            <legend>{{$book->book_name}}</legend>
        </fieldset>
        <div class="clearfix container inner-content">
            <div class="col-xs-12 wrap-content">
                <div class="col-md-12 col-sm-12 col-xs-12 no-padd-r no-padd-xs dir-rtl text-right">
                    <div class="clearfix detail-blog">
                        {{--
                        <div class="clearfix topbar-news">
                            <div class="pull-left">
                                <a href="mailto:?subject={{$book->title}}&body={{HR\myFuncs::limit_words(strip_tags($book->body), 60)}} ... {{ url()->current()  }}"><img src="/site/default/img/hr_email.png" alt="" width="17" height="16"></a>
                                <a href="#" onclick="window.print();return false;"><img src="/site/default/img/hr_print.png" alt="" width="17" height="16"></a>
                            </div>
                        </div>--}}


                        {!! $book->body !!}
                        <div class="col-xs-12 no-padd no-padd-xs wrap-icon">
                            <div class="pull-right tags">
                                @include('site.modules.book_tags',$book)
                            </div>
                        {{--
                            <div class="pull-left text-right">
                               <div class="share-button sharer" style="display: block;">
                                <button type="button" class="share-btn"><img src="/site/default/img/share.png" alt="" width="17" height="17"></button>
                                   <div class="social top center networks-5 ">

                                       <!-- LinkedIn Share Button -->
                                       <a class="fbtn share linkedin" rel="nofollow" href="https://www.linkedin.com/shareArticle?mini=true&url={{url()->current()}}&title={{$book->title}}&summary={{HR\myFuncs::limit_words(strip_tags($book->body), 60)}} ... &source=GolrangHr"><i class="fa fa-linkedin"></i></a>

                                       <!-- Telegram Share Button -->
                                       <a class="fbtn share linkedin" rel="nofollow" href="https://telegram.me/share/url?text={{$book->title}}&url={{url()->current()}}"><i class="fa fa-telegram"></i></a>
                                   </div>
                                </div>
                            </div>
                        --}}                            
                        </div>
                        {{--
                        <div class="clearfix np-page">
                            @if($next)
                                <div class="pull-right"><a href="{{route('site.books.show',$next->slug)}}"><img src="/site/default/img/arrow-right.png" alt=""> کتاب بعدی </a></div>
                            @endif
                            @if($prev)
                                <div class="pull-left"><a href="{{route('site.books.show',$prev->slug)}}"> کتاب قبلی <img src="/site/default/img/arrow-left.png" alt=""></a></div>
                            @endif
                        </div>
                        --}}
                    </div>
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