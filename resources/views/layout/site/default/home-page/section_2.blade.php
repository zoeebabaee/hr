<div class="section" id="section2">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach($sliders as $slider)
            <li data-target="#myCarousel" data-slide-to="{{$loop->index}}"
                @if($loop->index == 0)class="active"@endif></li>
            @endforeach
        </ol>
        @yield('slider')
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
