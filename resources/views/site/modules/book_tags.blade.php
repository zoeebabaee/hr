@foreach($book->tags as $tag)
<a href="{{route('site.search.tags',$tag->name)}}">
    @if(!preg_match('/^[A-z]+$/',$tag->name ))
    #
    @endif
    {{$tag->name}}
    @if(preg_match('/^[A-z]+$/',$tag->name ))
    #
    @endif
</a>
@endforeach