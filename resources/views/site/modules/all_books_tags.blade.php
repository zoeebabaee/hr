<div class="col-xs-12 wrap-rjobs no-padd no-padd-xs">
    <div class="title-rjobs">
        <h3 class="wow animated fadeIn">برچسب ها </h3>
    </div>
    <div class="col-12 no-padd no-padd-xs">
        <div id="main" class="tags-news">
            <div class="nano">
                <div class="nano-content">
                    @foreach(HR\Tag::get_book_tags_sorted() as $tag=>$count)
                        @if($count > 0)
                            <a href="{{route('site.search.tags',$tag)}}">
                                @if(!preg_match('/^[A-z]+$/',$tag ))
                                    #
                                @endif
                                {{$tag}} ({{$count}})
                                @if(preg_match('/^[A-z]+$/',$tag ))
                                    #
                                @endif
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

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
