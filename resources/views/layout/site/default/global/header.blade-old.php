<header @if(Request::route()->getName() == 'home') class ="cd-main-header" @else class="cd-main-header cd-main-relative" @endif>
    <style>
        
@media (max-width: 991px) {
    .login-register-button {
        background: none !important;
        border: none !important;
        border-bottom: 1px solid #3a3f40 !important;
    }
    .login-register-button:hover {
        color: #fff !important;

    }

}
    </style>
    {{--<!-- Piwik -->--}}
    {{--<script type="text/javascript">--}}
        {{--var _paq=_paq||[];_paq.push(["setDocumentTitle",document.domain+"/"+document.title]);_paq.push(["setCookieDomain","*.people.golrang.com"]);_paq.push(["setDomains",["*.people.golrang.com"]]);_paq.push(['trackPageView']);_paq.push(['enableLinkTracking']);(function(){var u="//my.golrangseo.com/piwik/";_paq.push(['setTrackerUrl',u+'piwik.php']);_paq.push(['setSiteId','8']);var d=document,g=d.createElement('script'),s=d.getElementsByTagName('script')[0];g.type='text/javascript';g.async=!0;g.defer=!0;g.src=u+'piwik.js';s.parentNode.insertBefore(g,s)})()--}}
    {{--</script>--}}
    {{--<noscript><p><img src="//my.golrangseo.com/piwik/piwik.php?idsite=8&rec=1" style="border:0;" alt="" /></p></noscript>--}}
    {{--<!-- End Piwik Code -->--}}
    <a class="cd-logo" href="{{route('home')}}"><img src="/site/default/img/logo.png?v=2" alt="لوگو"></a>
    <nav class="cd-nav">
        <ul id="cd-primary-nav" class="cd-primary-nav is-fixed">
            <li class="hidden-lg hidden-md visible-sm visible-xs">
                @if(Auth::check())
                    <a href="{{route('logout')}}"> خروج  <i class="fa fa-sign-out"></i></a>
                    @can('پنل ادمین')
                    <a href="{{route('adpanel')}}">ادمین <i class="fa fa-gears"></i></a>
                    @endcan
                    <a href="{{route('site.user.profile')}}">
                        <strong>{{Auth::user()->first_name}}</strong>
                        <img src="{{Auth::user()->avatar}}" alt="" title="" width="17" height="17" class="avatar">
                    </a>
                @else
                    <a  href="{{route('register')}}"  class="login-link btn btn-default login-register-button"><span> عضویت </span></a><a  href="{{route('login')}}"  class="login-link btn btn-default login-register-button"><span> ورود </span></a>
                @endif
            </li>
            <li><a href="{{route('home')}}" >صفحه نخست</a></li>
            <li class="seprator hidden-md hidden-sm hidden-xs"></li>
            <li class="has-children">
                <a href="#">خانواده گلرنگ</a>
                <ul class="cd-secondary-nav is-hidden">
                    <li class="go-back"><a href="#">خانواده گلرنگ</a></li>
                    <li class="see-all"></li>
                    <li class="has-children">
                        <a href="" class="t-menu">استخدام</a>
                        <ul class="is-hidden">
                            <li class="go-back"><a href="#">استخدام</a></li>
                            <li><a href="{{route('site.jobs.index')}}">فرصت های شغلی</a></li>
                            <li><a href="{{route('pages.absorption_process')}}">فرآیند جذب</a></li>
                            <li><a href="{{route('user.resume.1')}}">تکمیل فرم</a></li>
                            <li><a href="{{route('site.statics.pages',HR\Content::find(5)->alias)}}">{{HR\Content::find(5)->title}}</a></li>
                            <li><a href="{{route('site.statics.pages',HR\Content::find(18)->alias)}}">{{HR\Content::find(18)->title}}</a></li>
                            <li><a href="{{route('pages.help')}}">{{'راهنمای سامانه'}}</a></li>
                        </ul>
                    </li>
                    <li class="has-children">
                        <a href="#" class="t-menu">زندگی در گلرنگ</a>
                        <ul class="is-hidden">
                            <li class="go-back"><a href="#">زندگی در گلرنگ</a></li>

                            <li class="has-children" style="cursor: pointer;">
                                <a>محیط کاری</a>
                                <ul class="is-hidden" >
                                    <li class="go-back" style="cursor: pointer;"><a >بازگشت</a></li>
                                    <li><a href="{{route('site.pages.gallery')}}">گالری تصاویر</a></li>
                                    {{--<li><a href="{{route('site.pages.videos')}}">گالری ویدیو</a></li>--}}
                                </ul>
                            </li>

                            <li><a href="{{route('site.statics.pages',HR\Content::find(7)->alias)}}">{{HR\Content::find(7)->title}}</a></li>
                            <li><a href="{{route('site.statics.pages',HR\Content::find(8)->alias)}}">{{HR\Content::find(8)->title}}</a></li>

                        </ul>
                    </li>
                    <li class="has-children">
                        <a href="#" class="t-menu">آموزش و توسعه</a>
                        <ul class="is-hidden">
                            <li class="go-back"><a href="#">آموزش و توسعه</a></li>
                            <li><a href="{{route('site.pages.learning_movie')}}">فیلم های آموزشی</a></li>
                            <li><a href="{{route('site.books.index')}}">معرفی کتاب</a></li>

                            {{--<li><a href="{{route('site.statics.pages',HR\Content::find(13)->alias)}}">{{HR\Content::find(13)->title}}</a></li>--}}
                            <li><a href="{{route('site.statics.pages',HR\Content::find(14)->alias)}}">{{HR\Content::find(14)->title}}</a></li>
                            <li><a href="{{route('site.events.educational.index')}}">رویدادهای آموزشی</a></li>
                            <li><a href="{{route('site.statics.pages',HR\Content::find(16)->alias)}}">{{HR\Content::find(16)->title}}</a></li>
                            {{--<li><a href="{{route('site.statics.pages',HR\Content::find(17)->alias)}}">{{HR\Content::find(17)->title}}</a></li>--}}
                        </ul>
                    </li>
                    <li class="hidden-xs hidden-sm">
                        <a href="{{route('site.jobs.index')}}">
                            <img src="/site/default/img/img2.jpg" alt="Product Image" height="auto" width="100%">
                        </a>
                        <a href="{{route('site.jobs.index')}}" class="situation">فرصت های شغلی</a>
                    </li>


                </ul>
            </li>
            <li class="seprator hidden-md hidden-sm hidden-xs"></li>
            <li class="has-children">
                <a href="#">اخبار و رویداد</a>
                <ul class="cd-nav-gallery is-hidden center-div">
                    <li class="go-back"><a href="#0">اخبار و رویداد</a></li>
                    <li class="see-all"></li>
                    <li>
                        <a class="cd-nav-item" href="{{route('site.news.index')}}">
                            <img src="{{HR\ContentCategory::find(9)->image}}" alt="اخبار">
                            <h3>اخبار </h3>
                        </a>
                    </li>
                    <li>
                        <a class="cd-nav-item" href="{{route('site.events.index')}}">
                            <img src="{{HR\ContentCategory::find(10)->image}}" alt="رویدادها">
                            <h3>رویدادها</h3>
                        </a>
                    </li>
                    <li>
                        <a class="cd-nav-item" href="{{route('site.blog.index')}}">
                            <img src="{{HR\ContentCategory::find(11)->image}}" alt="وبلاگ">
                            <h3>وبلاگ</h3>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="seprator hidden-md hidden-sm hidden-xs"></li>
            <li class="has-children">
                <a href="">معرفی شرکت</a>
                <ul class="cd-nav-icons is-hidden">
                    <li class="go-back"><a href="#0">معرفی شرکت</a></li>
                    <li class="see-all"></li>
                    <li>
                        <a class="cd-nav-item item-1" href="{{route('aboutUs')}}">
                            <h3>درباره ما</h3>
                        </a>
                    </li>

                    <li>
                        <a class="cd-nav-item item-2" href="{{route('contact.create')}}">
                            <h3>تماس با گلرنگ</h3>
                        </a>
                    </li>

                    {{--<li>--}}
                        {{--<a class="cd-nav-item item-3" href="{{route('uniForm.store')}}">--}}
                            {{--<h3>ثبت نام همایش</h3>--}}
                        {{--</a>--}}
                    {{--</li>--}}

                </ul>
            </li>
            {{--<li class="seprator hidden-md hidden-sm hidden-xs"></li>--}}
            {{--<li><a href="{{route('uniForm.store')}}" >ثبت نام نمایشگاه</a></li>--}}
            @php
                if(!isset($_SESSION))
                {
                    session_start();
                }
            @endphp
            @if( isset($_SESSION['admin_login']) && !empty($_SESSION['admin_login']))
                <li><a href="{{route('admin.login.as.return')}}" style="color: red;">بازگشت به ادمین</a></li>
            @endif
        </ul>
    </nav>
    <ul class="cd-header-buttons">
        <li><a class="cd-nav-trigger" href="#cd-primary-nav"><span></span></a></li>
        <li><a class="cd-search-trigger" href="#cd-search"><span></span></a></li>
    </ul>
    <div class="hidden-xs hidden-sm social-networks-menu">
        <a href="https://www.instagram.com/golrang_people/" target="_blank" rel="nofollow"><span style="width: 17px; height:17px; background: url(/site/default/img/all_icons.png) -96px 61px;display: inline-block "></span></a>
        {{--<a href="#"><img src="/site/{{config('app.site_theme')}}/img/hr_telegram.png" alt="" title="" width="17" height="17"></a>--}}
        <a href="https://www.linkedin.com/in/golrang-people-718430127/" target="_blank" rel="nofollow"><span style="width: 17px; height:17px; background: url(/site/default/img/all_icons.png) -67px 61px;display: inline-block "></span></a>
        <span> |
            @if(Auth::check())
                @can('پنل ادمین')
                    <a href="{{route('adpanel')}}">ادمین <i class="fa fa-gears"></i></a>
                    <a href="{{route('site.user.profile')}}"> پروفایل
                        <img src="{{Auth::user()->avatar}}" alt="" title="" width="17" height="17" class="avatar">
                    </a>
                @else
                    <a href="{{route('logout')}}"> خروج  <i class="fa fa-sign-out"></i></a><a href="{{route('site.user.profile')}}"> {{Auth::user()->first_name}} <img src="{{Auth::user()->avatar}}" alt="" title="" width="17" height="17" class="avatar"> </a>
                @endcan
            @else
                <a  href="{{route('register')}}"  class="login-link btn btn-default login-register-button"><span> عضویت </span></a><a  href="{{route('login')}}"  class="login-link btn btn-default login-register-button"><span> ورود </span></a>
            @endif
        </span>

    </div>
</header>