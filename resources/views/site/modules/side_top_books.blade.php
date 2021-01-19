<div class="clearfix wrap-rjobs">
    <div class="title-rjobs">
        <h3 class="wow animated fadeIn"> جدیدترین کتاب ها   </h3>
    </div>
    @foreach($top_books as $top_book)
    <div class="col-xs-12 articles-part">
        <img src="{{$top_book->img}}" alt="" width="100" height="80">
        <div>
            <a href="{{route('site.books.show',$top_book->slug)}}">{{$top_book->book_name}}</a>
            <br>
            <p>نویسنده: {{$top_book->author}}</p>
            <a href=""></a>
            <div class="articles-date">{{JDate::createFromCarbon(Carbon::parse($top_book->created_at))->format('l j F Y')}}</div>
        </div>
    </div>
    @endforeach
</div>