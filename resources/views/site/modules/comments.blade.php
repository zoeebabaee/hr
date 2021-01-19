@if($can_comment)
<style>
    .form-control:disabled, .form-control[readonly] {
    background-color: #ffffff;
    opacity: 1;
    border: 1px solid #e5e5e5;
    border-radius: 4px;
    width: 100%;
}
</style>
    <div class="clearfix"></div>
<div class="clearfix wrap-rjobs">
            <fieldset class="red-fieldset mt-7 ">
                <legend>ارسال نظر</legend>
            </fieldset>    
    <div class="col-xs-12 comments-form">
        <div class="row">
            @if(Auth::check())
                <form action="{{route('site.blog.post.comment',$content->id)}}" method="POST" class="w-100">
                    {{csrf_field()}}
                    <div class="col-md-12 wrap-comment">
                        <label class="col-md-12 control-label">نظر شما</label>
                        <div class="col-md-12">
                            <textarea class="contact-txt form-control" maxlength="1979" name="comment" type="text" ></textarea>
                        </div>
                    </div>
                <fieldset class="mt-5 w-100">
                    <legend>
                        <input type="submit" value="ثبت نظر"  class="btn btn-comment save send-btn-green">
                    </legend>
                </fieldset>                      
                </form>
            @else
                <div class="col-md-8 m-auto wrap-comment">
                    <label class="col-md-12 control-label text-right">نظر شما</label>
                    <div class="col-md-12">
                        <textarea class="contact-txt form-control" maxlength="500" name="" type="text" disabled >جهت ارسال نظر باید در سایت عضو شوید</textarea>
                    </div>
                </div>
                <fieldset class="mt-5 w-100">
                    <legend>
                        <input type="submit" value="ثبت نظر" class="btn btn-commen save send-btn-green"  disabled>
                    </legend>
                </fieldset>                
            @endif
        </div>
    </div>
</div>
<div class="clearfix wrap-comments">
    @if(!is_null($comments))
        @foreach($comments as $comment)
        <div class="comments">
            <img src="{{$comment->user->avatar}}" alt="" width="60" height="60" class="fr-img">
            <div class="c-mar">
            <h2>{{$comment->user->first_name.' '.$comment->user->last_name}}</h2>
            <h3>{{$comment->content}}</h3>
            <h4>{{JDate::createFromCarbon(Carbon::parse($content->created_at))->format('l j F Y')}}</h4>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endif