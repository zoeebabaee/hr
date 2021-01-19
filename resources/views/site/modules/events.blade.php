        @php
            $event=$events->get()->toArray();
        @endphp
        @if(count($event))
            @foreach($contents as $content)
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="wrap-event wow fadeIn animated" data-wow-delay="0.4s">
                    <div>
                        <div class="wrap-event-box">
                            <img src="/{{$content->xxl_image}}" alt="" width="290px" height="210px" class="{{($i%2)?'fr-img': 'fl-img'}}">
                            <h3>{{$content->title}}</h3>
                            <a class="event-more" href="{{route('site.events.show',$content->alias)}}">مشاهده</a>
                        </div>
                    </div>
                    <div class="bg-opacity"></div>
                </div>
            </div>
            @endforeach
        @endif