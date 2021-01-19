<div class="col-12 wrap-rjobs no-padd no-padd-xs">
    <fieldset class="red-fieldset mt-3">
        <legend>برچسب ها</legend>
    </fieldset>
    <div class="col-12">
        <div id="main" class="tags-news">
            <div class="nano">
                <div class="nano-content dir-rtl text-right">
                    @foreach(HR\Tag::get_all_sorted() as $tag=>$count)
                        @if($count > 0)
                            <a class="text-dark font-13 text-right" href="{{route('site.search.tags',$tag)}}">
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
