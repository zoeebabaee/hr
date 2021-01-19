@foreach($top_contents as $top_content)
    @if($top_content->id == $content->id)
        @continue
    @endif
   
<div class="row articles-part text-right">
    <div class="col-4">
        <img class="img-fluid w-100" src="/{{$top_content->l_image}}" alt="" width="100" height="80">
    </div>
    <div class="col-8 no-padd-r">
        <a class="font-13 text-dark" href="{{route($route,$top_content->alias)}}">{{$top_content->title}}</a>
    </div>
</div>
<hr>
@endforeach