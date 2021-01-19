<div class="pull-right lable-blog">
    @foreach($content->groups as $group)
        <a href="{{route('site.news.index.in.group',$group->alias)}}">{{$group->name}}</a>
    @endforeach
</div>