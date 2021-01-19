<footer class="section footer" id="section6"
        style="background: url(/site/default/img/bg-footer.jpg) no-repeat top center/cover;"
        xmlns="http://www.w3.org/1999/html">
    <div class="container footer-home">
        @if(isset($footer->content))
        <div class="col-md-4 col-sm-4 col-xs-12 col1-footer">
            <h3><span style="width: 50px; height:33px; background: url(/site/default/img/all_icons.png) 53px 70px;display: inline-block "></span>{!! $footer->content->title !!}</h3>
            <p>
                {!! strip_tags(HR\myFuncs::limit_words($footer->content->body,100)) !!} ...
            </p>
            <a href="{{route('site.statics.pages',$footer->content->alias)}}"><i class="fa fa-angle-left"></i> ادامه مطلب</a>
        </div>
        @endif
        <div class="col-md-4 col-sm-4 col-xs-12 col2-footer">
            <div class="part">
                <h3><span style="width: 39px; height: 39px; background: url(/site/default/img/all_icons.png) 105px 40px;display: inline-block "></span>دفتر مرکزی</h3>
                <p>
                    {!! $footer->central_office !!}
                    ***
                </p>
            </div>
            <div class="part">
                <h3><span style="width: 39px; height: 39px; background: url(/site/default/img/all_icons.png) 141px 40px;display: inline-block "></span>تماس با ما</h3>
                {!! $footer->contact_us !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 col3-footer">
            {{--
            <h3 class="wow fadeIn animated">عضویت در خبرنامه</h3>

                <span class="input input--madoka" id="input-131">
                    <input autocomplete="off" class="input__field input__field--madoka" required type="email" name="email" id="input-31" placeholder="example@gmail.com" />
                    <label class="input__label input__label--madoka" for="input-31">
                        <svg class="graphic graphic--madoka" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
                            <path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
                        </svg>
                    </label>
                    <div class="help-block with-errors"></div>
                </span>
                <button   class="btn btn-newsletter" onclick="ajax_load_more()" id="input-132" name="singlebutton">عضویت</button>
--}}

            <div class="links-footer">
                <h3><span style="width: 39px; height: 39px; background: url(/site/default/img/all_icons.png) 67px 39px;display: inline-block "></span>ساعات کاری</h3>
                {!! $footer->work_time !!}
                <br>
            </div>
            <div class="links-footer">
                <h3>لینک های مفید</h3>
                {!! $footer->links !!}
            </div>
            <div class="sn-icons">
                <a target="_blank" style="width: 39px; height: 39px; background: url(/site/default/img/all_icons.png) 99px -1px;display: inline-block " href="https://www.instagram.com/golrang_people/"></a>
                <a target="_blank" style="width: 39px; height: 39px; background: url(/site/default/img/all_icons.png) 47px -1px;display: inline-block " href="https://www.linkedin.com/company-beta/11221296"></a>
                {{--<a href="#"><img src="/site/default/img/hr_fo-teleg.png" alt="Telegram" title="Telegram" width="39" height="39"></a>--}}
            </div>
        </div>


    </div>

    <div class="col-xs-12 copy-right">کپی رایت © {{Carbon::now()->year}}  همه حقوق محفوظ است. طراحی و پیاده سازی توسط <a href="http://golrangsystem.com" target="_blank"> گلرنگ سیستم </a>.</div>
    <script>
        function ajax_load_more(){var Mail=$('#input-31').val();$.ajax({method:"POST",url:"{{route('site.newsletter.post')}}",data:{email:Mail,_token:'{!!csrf_token()!!}'}}).done(function(data){$('#input-131').replaceWith('<p>ایمیل شما با موفقیت ثبت شد</p>');$('#input-132').remove()})}
    </script>
</footer>