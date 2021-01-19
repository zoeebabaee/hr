<div class="section" id="section5" style="background: url(/site/default/img/bg-news.jpg) no-repeat top center/cover;">
    <div class="container wrapper-events">
        <h2 class="wow animated fadeInUp">  از زبان همکاران</h2>
          <div class="owl-carousel owl-theme partners">
                @foreach(\HR\OthersSay::all() as $qoute)
                    <div class="item bg-partners clearfix">
             <div class="clearfix wrapper-partners">

                 <div class="clearfix title-partners">
                    <div class="wrap-p" style="background:url(../site/default/img/speech-bubble.png) no-repeat; width:128px;
                    height:128px;float:right;"><img src="{{$qoute->avatar}}" width="114" height="114" alt=""></div>

                    
                     <h4>{{$qoute->name}}</h4>
<!--                 <h4><span id="rateYo"></span></h4>-->

                     <h5>{{$qoute->post}}</h5>
                     <hr class="hr-partenr">
                     <h6>{{$qoute->company}}</h6>
                     <p>
                        {!! strip_tags($qoute->body) !!}
                     </p>
                     </div>
              

                 <i class="fa fa-quote-left"></i>
             </div>
            </div>
                @endforeach
          </div>
    </div>
</div>



