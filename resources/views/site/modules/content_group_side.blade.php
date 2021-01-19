@php
$colors= ['orange-cat','red-cat','green-cat','blue-cat','violet-cat','pink-cat','lightblue-cat']
@endphp

<div class="col-xs-12 wrap-links no-padd">
    @for($i = 0; $i < HR\contentGroup::all()->count(); $i++)
        <a href="{{route('site.news.index.in.group',HR\contentGroup::all()->toArray()[$i]['alias'])}}" class="{{$colors[$i%7]}}">{{HR\contentGroup::all()->toArray()[$i]['name']}}</a>
    @endfor
</div>