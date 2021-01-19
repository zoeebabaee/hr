<div class="header-inside-top"></div>
<div class="container header-inside position-relative">
                <nav class="navbar navbar-expand-lg navbar-light py-3">
                <a class="navbar-brand" href="/">
                    {{ HTML::image('/site/'.config('app.site_theme').'/Template_2019/img/gig-logo.svg') }}
                </a>
              <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div id="navbarContent" class="collapse navbar-collapse">
                <ul class="navbar-nav rtl">
                  <!-- Megamenu-->
                  <li class="nav-item dropdown megamenu"><a id="megamneu" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">خانواده گلرنگ</a>
                    <div aria-labelledby="megamneu" class="dropdown-menu">
                    <div class="row rtl">
                          <div class="col-12">
                            <div class="bg-white p-4 no-padd-xs">
                              <div class="row rtl">
                                <div class="col-md-4 mb-4">
                                  <h6 class="text-right">استخدام</h6>
                                  <ul class="list-unstyled">
                                    <li class="nav-item"><a class="nav-link text-small pb-0" href="{{route('site.jobs.index')}}">فرصت های شغلی</a></li>
                                    <li class="nav-item"><a class="nav-link text-small pb-0" href="{{route('pages.absorption_process')}}">فرآیند جذب</a></li>
                                    <li class="nav-item"><a class="nav-link text-small pb-0" href="{{route('user.resume.1')}}">فرم استخدام </a></li>
                                    <li class="nav-item"><a class="nav-link text-small pb-0" href="{{route('site.statics.pages',HR\Content::find(5)->alias)}}">{{HR\Content::find(5)->title}}</a></li>
                                    <!--
                                    <li class="nav-item"><a class="nav-link text-small pb-0" href="{{route('pages.help')}}">{{'راهنمای سامانه'}}</a></li>
                                    -->
                                  </ul>
                                </div>
                                <div class="col-md-4 mb-4">
                                  <h6 class="text-right">آموزش و توسعه</h6>
                                  <ul class="list-unstyled">
                                    <li class="nav-item"><a class="nav-link text-small pb-0" href="{{route('site.pages.learning_movie')}}">فیلم های آموزشی</a></li>
                                    <li class="nav-item"><a class="nav-link text-small pb-0" href="{{route('site.books.index')}}">معرفی کتاب</a></li>
                                    <li class="nav-item"><a class="nav-link text-small pb-0" href="{{route('site.statics.pages',HR\Content::find(14)->alias)}}">{{HR\Content::find(14)->title}}</a></li>
                                    <li class="nav-item"><a class="nav-link text-small pb-0" href="{{route('site.events.educational.index')}}">رویدادهای آموزشی</a></li>
                                    <li class="nav-item"><a class="nav-link text-small pb-0" href="{{route('site.statics.pages',HR\Content::find(16)->alias)}}">{{HR\Content::find(16)->title}}</a></li>
                                  </ul>
                                </div>
                                <div class="col-md-4 mb-4">
                                  <h6 class="text-right">درباره ما</h6>
                                  <ul class="list-unstyled">
                                    <li class="nav-item"><a class="nav-link text-small pb-0" href="{{route('site.pages.gallery')}}">گالری تصاویر</a></li>
                                    <li class="nav-item"><a class="nav-link text-small pb-0" href="{{route('site.events.index')}}">اخبار و رویداد ها</a></li>
                                    <li class="nav-item"><a class="nav-link text-small pb-0" href="{{route('aboutUs')}}">معرفی شرکت</a></li>
                                    <li class="nav-item"><a class="nav-link text-small pb-0" href="{{route('contact.create')}}">تماس با گلرنگ</a></li>
                                    <li class="nav-item"><a class="nav-link text-small pb-0" href="{{route('pages.faq')}}">  سوالات متداول</a></li>
                                
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                  </li>
                  <li class="nav-item"><a href="{{route('site.jobs.index')}}" class="nav-link">فرصت های شغلی</a></li>
                    @php
                        if(!isset($_SESSION))
                        {
                            session_start();
                        }
                    @endphp
                    @if( isset($_SESSION['admin_login']) && !empty($_SESSION['admin_login']))
                        <li class="nav-item"><a class="nav-link" href="{{route('admin.login.as.return')}}" style="color: red;">بازگشت به ادمین</a></li>
                    @endif      
                  
            
                    @if(Auth::check())
                        @can('پنل ادمین')
<!--                            <li class="nav-item dropdown megamenu-li"><a class="nav-link" href="{{route('adpanel')}}">ادمین</a></li>
-->                            <li class="nav-item dropdown megamenu-li"><a class="nav-link" href="{{route('site.user.profile')}}">پروفایل</a><!--  <img src="{{Auth::user()->avatar}}" alt="" title="" width="17" height="17" class="avatar">--> </li> 
                        @else
                            <li class="nav-item dropdown megamenu-li"><a class="nav-link" href="{{route('logout')}}">خروج</a></li>
                            <a class="user-name-mainpage-header" href="{{route('site.user.profile')}}"> {{Auth::user()->first_name}} <!-- <img src="{{Auth::user()->avatar}}" alt="" title="" width="17" height="17" class="avatar">--> </a> 
                        @endcan
                    @else
                        <a  href="{{route('register')}}"  class="login-link btn btn-default login-register-button"><span> عضویت </span></a><a  href="{{route('login')}}"  class="login-link btn btn-default login-register-button"><span> ورود </span></a>
                    @endif
                </ul>
                 @if(Auth::check())
                        @can('پنل ادمین')
                    
                  <a style="display: block;background: linear-gradient(59deg, rgba(224, 61, 56,1) 10%, rgba(166, 160, 161,1) 100%);padding: 10px;text-align: center;border-radius: 5px; color: white;font-weight: bold;
    line-height: 25px;padding:5px 20px;" href="{{route('adpanel')}}">ادمین</a>

<!--                   <li class="nav-item dropdown megamenu-li"><a class="nav-link"  >ادمین</a></li>
-->                   
                   @endcan
                   @endif
              </div>
                </nav>
    <div class="float-left left-header-inside dir-ltr">{{ HTML::image('/site/'.config('app.site_theme').'/Template_2019/img/inside-search-icon.svg') }}
    <div id="cd-search" class="cd-search">
        <form action="{{route('site.search')}}" method="GET" onsubmit="if(document.getElementById('search_query').value==''){return false;}">
            <input name="query" id="search_query" type="search" placeholder="جستجو کنید..."> 
        </form>
    </div> 
    </div>
</div>
   <div class="header-inside-top header-inside-bottom"></div>