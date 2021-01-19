<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">

                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="{{ Auth::user()->avatar}}" width="60" height="60"/>
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="clear">
                                        <span class="block m-t-xs">
                                            <strong class="font-bold">
                                            {{ Auth::user()->first_name }}
                                            </strong>
                                        </span>
                                        <span class="text-muted text-xs block">
                                            {{Auth::user()->roles()->first()->name}} <b class="caret">
                                            </b>
                                        </span>
                                    </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInLeft m-t-xs">
                        <!--<li>
                            <a href="profile.html">
                                پروفایل</a>
                        </li>
                        <li class="divider">
                        </li>-->
                        <li>
                            <a href="{{route('logout')}}">
                                خروج</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li {!! (Route::currentRouteName()=='adpanel'?' class="active" ':'') !!}>
                <a href="{{route('adpanel')}}">
                    <i class="fa fa-th-large"></i> <span class="nav-label">داشبورد</span></a>
            </li>

            @if(
            auth()->user()->hasPermissionTo('کاربران-مشاهده-لیست')
            || auth()->user()->hasPermissionTo('کاربران-مدیریت-دسترسی-ها')
            || auth()->user()->hasPermissionTo('کاربران-مدیریت-نقش-ها')
            || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس')
            )

                <li {!! (Route::currentRouteName()=='users.index' ||  Route::currentRouteName()=='roles.index' || Route::currentRouteName()=='permissions.index' || Route::currentRouteName()=='users.create' || Route::currentRouteName()=='users.edit' ||  Route::currentRouteName()=='worker-list.index' || Route::currentRouteName()=='worker-list.create' || Route::currentRouteName()=='worker-list.edit'  ?' class="active" ':'') !!}>
                    <a href="#">
                        <i class="fa fa-users">
                        </i>
                        <span class="nav-label">
                                مدیریت کاربران</span>
                        <span class="fa arrow">
                                </span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        @if(auth()->user()->hasPermissionTo('کاربران-مشاهده-لیست') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (
                        Route::currentRouteName()=='users.index' || Route::currentRouteName()=='users.create' || Route::currentRouteName()=='users.edit'

                        ?' class="active" ':'') !!}>
                                <a href="{{Route('users.index')}}">
                                    <i class="fa fa-user"></i>                                    &nbsp;
                                    لیست کاربران
                                </a>
                            </li>
                            @if(auth()->user()->hasPermissionTo('تعدیلی-مشاهده')|| auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                                <li {!! (
                        Route::currentRouteName()=='worker-list.index' || Route::currentRouteName()=='worker-list.create' || Route::currentRouteName()=='worker-list.edit'

                        ?' class="active" ':'') !!}>

                                    <a href="{{Route('worker-list.index')}}">
                                        <i class="fa fa-user"></i>
                                        &nbsp;
                                        همکاران قابل انتقال

                                    </a>
                                </li>
                            @endif
                        @endif

                        @if(auth()->user()->hasRole('برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='roles.index'?' class="active" ':'') !!}>
                                <a href="{{Route('roles.index')}}">
                                    <i class="fa fa-key"></i>
                                    &nbsp;
                                    مدیریت نقش ها

                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->hasRole('برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='permissions.index'?' class="active" ':'') !!}>
                                <a href="{{Route('permissions.index')}}">
                                    <i class="fa fa-lock"></i>
                                    &nbsp;
                                    مدیریت دسترسی ها

                                </a>
                            </li>
                        @endif
                        {{--<li {!! (Route::currentRouteName()=='resumes.index'?' class="active" ':'') !!}>--}}
                        {{--<a href="{{Route('resumes.index')}}">--}}
                        {{--<i class="fa fa-user"></i>--}}
                        {{--&nbsp;--}}
                        {{--مدیریت رزومه ها--}}

                        {{--</a>--}}
                        {{--</li>--}}

                    </ul>
                </li>

            @endif

            @if(
            auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس')
            || auth()->user()->hasPermissionTo('محتوا-مشاهده-لیست')
            || auth()->user()->hasPermissionTo('نظرات-مشاهده')
            || auth()->user()->hasPermissionTo('تگ-مشاهده')
            )
                <li {!! (Route::currentRouteName()=='contents.index' ||  Route::currentRouteName()=='content_categories.index' || Route::currentRouteName()=='comments.index' || Route::currentRouteName()=='tags.index' || Route::currentRouteName()=='contents.create' || Route::currentRouteName()=='contents.edit' ?' class="active" ':'') !!}>
                    <a href="#">
                        <i class="fa fa-files-o">
                        </i>
                        <span class="nav-label">
                                مدیریت محتوا</span>
                        <span class="fa arrow">
                                </span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        @if(auth()->user()->hasPermissionTo('محتوا-مشاهده-لیست') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='contents.index' || Route::currentRouteName()=='contents.create' || Route::currentRouteName()=='contents.edit'?' class="active" ':'') !!}>
                                <a href="{{Route('contents.index')}}">
                                    <i class="fa fa-newspaper-o"></i>
                                    &nbsp;

                                    آخرین مطالب
                                    <span class="label label-danger pull-left">

                                    {{HR\Content::myContents()->count()}}

                            </span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='content_categories.index'?' class="active" ':'') !!}>
                                <a href="{{Route('content_categories.index')}}">
                                    <i class="fa fa-folder-o"></i>
                                    &nbsp;
                                    مجموعه ها
                                    <span class="label label-warning pull-left">

                                    {{HR\ContentCategory::all()->count()}}

                            </span>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->hasPermissionTo('نظرات-مشاهده') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='comments.index'?' class="active" ':'') !!}>
                                <a href="{{Route('comments.index')}}">
                                    <i class="fa fa-comment-o"></i>
                                    &nbsp;
                                    نظرات

                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->hasPermissionTo('تگ-مشاهده') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='tags.index'?' class="active" ':'') !!}>
                                <a href="{{Route('tags.index')}}">
                                    <i class="fa fa-tags"></i>
                                    &nbsp
                                    تگ ها

                                </a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif

            @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                <li {!! (Route::currentRouteName()=='first-content.edit' || Route::currentRouteName()=='absorption-process.edit' || Route::currentRouteName()=='aboutUsText.edit'||  Route::currentRouteName()=='first-page-slider.edit' ||  Route::currentRouteName()=='first-page-footer.edit'?' class="active" ':'' || Route::currentRouteName()=='global-footer.edit'?' class="active" ':'') !!}>
                    <a href="#">
                        <i class="fa fa-paint-brush">
                        </i>
                        <span class="nav-label">
                                تنظیمات سایت</span>
                        <span class="fa arrow">
                                </span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li {!! (Route::currentRouteName()=='first-content.edit'?' class="active" ':'') !!}>
                            <a href="{{Route('first-content.edit')}}">
                                <i class="fa fa-newspaper-o"></i>
                                &nbsp;
                                مطلب ثابت صفحه نخست</a>
                        </li>
                        <li {!! (Route::currentRouteName()=='first-page-slider.edit'?' class="active" ':'') !!}>
                            <a href="{{Route('first-page-slider.edit')}}">
                                <i class="fa fa-file-image-o"></i>&nbsp;
                                اسلایدرهای صفحه نخست
                            </a>
                        </li>
                        <li {!! (Route::currentRouteName()=='first-page-footer.edit'?' class="active" ':'') !!}>
                            <a href="{{Route('first-page-footer.edit')}}">
                                <i class="fa fa-file-text-o"></i>
                                فوتر صفحه نخست
                            </a>
                        </li>
                        <li {!! (Route::currentRouteName()=='global-footer.edit'?' class="active" ':'') !!}>
                            <a href="{{Route('global-footer.edit')}}">
                                <i class="fa fa-file-text-o"></i>
                                فوتر صفحات داخلی
                            </a>
                        </li>
                        <li {!! (Route::currentRouteName()=='aboutUsText.edit'?' class="active" ':'') !!}>
                            <a href="{{Route('aboutUsText.edit')}}">
                                <i class="fa fa-file-text-o"></i>
                                متن درباره ما
                            </a>
                        </li>
                        <li {!! (Route::currentRouteName()=='absorption-process.edit'?' class="active" ':'') !!}>
                            <a href="{{Route('absorption-process.edit')}}">
                                <i class="fa fa-file-text-o"></i>
                                فرآیند جذب
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(auth()->user()->hasPermissionTo('مشاغل-مشاهده') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                <li {!! (Route::currentRouteName()=='jobs.index' || Route::currentRouteName()=='reject_reasons.index' ||  Route::currentRouteName()=='jobs.create' || Route::currentRouteName()=='departments.index'  || Route::currentRouteName()=='industries.index' || Route::currentRouteName()=='departments.index' || Route::currentRouteName()=='departments.create' || Route::currentRouteName()=='departments.edit' || Route::currentRouteName()=='generalMerites.index' || Route::currentRouteName()=='generalMerites.create' || Route::currentRouteName()=='generalMerites.edit' || Route::currentRouteName()=='professionalMerites.index' || Route::currentRouteName()=='professionalMerites.create' || Route::currentRouteName()=='professionalMerites.edit' || Route::currentRouteName()=='jobPosts.index' || Route::currentRouteName()=='jobPosts.create' || Route::currentRouteName()=='jobPosts.edit'            || Route::currentRouteName()=='organizationalCategories.index' || Route::currentRouteName()=='organizationalCategories.create' || Route::currentRouteName()=='organizationalCategories.edit'?' class="active" ':'') !!}>
                    <a href="#">
                        <i class="fa fa-briefcase">
                        </i>
                        <span class="nav-label">
                                مدیریت مشاغل</span>
                        <span class="fa arrow">
                                </span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        @if(auth()->user()->hasPermissionTo('مشاغل-مشاهده') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='jobs.index'?' class="active" ':'') !!}>
                                <a href="{{Route('jobs.index')}}">
                                    <i class="fa fa-list"></i>
                                    &nbsp;
                                    لیست مشاغل
                                    <span class="label label-danger pull-left">

                                    {{HR\Job::myJobs()->count()}}

                            </span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='departments.index'?' class="active" ':'') !!}>
                                <a href="{{Route('departments.index')}}">
                                    <i class="fa fa-newspaper-o"></i>
                                    &nbsp;
                                    حوزه ها
                                    <span class="label label-success pull-left">

                                    {{HR\JobDepartment::all()->count()}}

                            </span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='industries.index'?' class="active" ':'') !!}>
                                <a href="{{Route('industries.index')}}">
                                    <i class="fa fa-newspaper-o"></i>
                                    &nbsp;
                                    صنعت

                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='generalMerites.index'?' class="active" ':'') !!}>
                                <a href="{{Route('generalMerites.index')}}">
                                    <i class="fa fa-newspaper-o"></i>
                                    &nbsp;
                                    شایستگی های عمومی</a>
                            </li>
                        @endif

                        @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='professionalMerites.index'?' class="active" ':'') !!}>
                                <a href="{{Route('professionalMerites.index')}}">
                                    <i class="fa fa-newspaper-o"></i>
                                    &nbsp;
                                    شایستگی های تخصصی</a>
                            </li>
                        @endif

                        @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='jobPosts.index'?' class="active" ':'') !!}>
                                <a href="{{Route('jobPosts.index')}}">
                                    <i class="fa fa-newspaper-o"></i>
                                    &nbsp;
                                    سمت ها (پست)
                                    <span class="label label-success pull-left">

                                    {{HR\JobPost::all()->count()}}

                            </span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='organizationalCategories.index'?' class="active" ':'') !!}>
                                <a href="{{Route('organizationalCategories.index')}}">
                                    <i class="fa fa-newspaper-o"></i>
                                    &nbsp;
                                    رده های سازمانی
                                    <span class="label label-success pull-left">

                                    {{HR\JobOrganizationalCategory::all()->count()}}

                            </span>
                                </a>
                            </li>

                            <li {!!(Route::currentRouteName()=='reject_reasons.index'?' class="active" ':'') !!}>
                                <a href="{{Route('reject_reasons.index')}}">
                                    <i class="fa fa-times"></i>&nbsp;
                                    دلایل رد
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif
            @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                <li {!! (Route::currentRouteName()=='books.index'?' class="active" ':'') !!}>
                    <a href="{{route('books.index')}}">
                        <i class="fa fa-book"></i><span class="nav-label">معرفی کتاب</span></a>
                </li>
            @endif

            @if( auth()->user()->hasPermissionTo('سوالات−متداول-مشاهده') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                <li {!! (Route::currentRouteName()=='faqs.index'?' class="active" ':'') !!}>
                    <a href="{{route('faqs.index')}}">
                        <i class="fa fa-question"></i>
                        <span class="nav-label">سوالات متداول</span>
                    </a>
                </li>
            @endif


            @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                <li {!! (Route::currentRouteName()=='companies.index'?' class="active" ':'') !!}>
                    <a href="{{route('companies.index')}}">
                        <i class="fa fa-industry"></i>
                        <span class="nav-label">
                        شرکت ها
                        </span>
                        {{--<span class="label label-default pull-left"></span>--}}
                    </a>
                </li>
            @endif

            @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                <li {!! (Route::currentRouteName()=='OthersSay.index'?' class="active" ':'') !!}>
                    <a href="{{route('OthersSay.index')}}">
                        <i class="fa fa-users"></i>
                        <span class="nav-label">
                        از زبان همکاران
                        </span>
                        {{--<span class="label label-default pull-left"></span>--}}
                    </a>
                </li>
            @endif

            @if(auth()->user()->hasPermissionTo('گالری-مشاهده') || auth()->user()->hasPermissionTo('تصاویر-مشاهده') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                <li {!! (Route::currentRouteName()=='galleryCategory.index' || Route::currentRouteName()=='galleryCategory.create' || Route::currentRouteName()=='galleryCategory.edit' ||  Route::currentRouteName()=='gallery.index' ||  Route::currentRouteName()=='gallery.create'             ||  Route::currentRouteName()=='gallery.edit')?' class="active" ':'' !!}>
                    <a href="#">
                        <i class="fa fa-file-image-o">
                        </i>
                        <span class="nav-label">
                                گالری تصاویر</span>
                        <span class="fa arrow">
                                </span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        @if( auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! Route::currentRouteName()=='galleryCategory.index' || Route::currentRouteName()=='galleryCategory.create'
                        || Route::currentRouteName()=='galleryCategory.edit'?' class="active" ':'' !!}>
                                <a href="{{route('galleryCategory.index')}}">
                                    <i class="fa fa-file-image-o"></i>

                                    دسته بندی گالری تصاویر
                                    {{--<span class="label label-default pull-left"></span>--}}
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->hasPermissionTo('تصاویر-مشاهده') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                            <li {!! (Route::currentRouteName()=='gallery.index' ||  Route::currentRouteName()=='gallery.create'
             ||  Route::currentRouteName()=='gallery.edit'?' class="active" ':'') !!}>
                                <a href="{{route('gallery.index')}}">
                                    <i class="fa fa-picture-o"></i>
                                    مدیریت تصاویر
                                    {{--<span class="label label-default pull-left"></span>--}}
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                <li {!! (Route::currentRouteName()=='video_gallery.index' || Route::currentRouteName()=='video_gallery.create' ||             Route::currentRouteName()=='video_gallery.edit' ||  Route::currentRouteName()=='videos.index' ||  Route::currentRouteName()=='videos.create'             ||  Route::currentRouteName()=='videos.edit')?' class="active" ':'' !!}>
                    <a href="#">
                        <i class="fa fa-file-video-o">
                        </i>
                        <span class="nav-label">
                                گالری ویدیو</span>
                        <span class="fa arrow">
                                </span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li {!! Route::currentRouteName()=='video_gallery.index' || Route::currentRouteName()=='video_gallery.create'
                        || Route::currentRouteName()=='video_gallery.edit'?' class="active" ':'' !!}>
                            <a href="{{route('video_gallery.index')}}">
                                <i class="fa fa-file-video-o"></i>

                                دسته بندی
                            </a>
                        </li>
                        <li {!! (Route::currentRouteName()=='videos.index' ||  Route::currentRouteName()=='videos.create'
             ||  Route::currentRouteName()=='videos.edit'?' class="active" ':'') !!}>
                            <a href="{{route('videos.index')}}">
                                <i class="fa fa-video-camera"></i>
                                مدیریت ویدیوها
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                <li>
                    <a href="{{route('timeLine.index','about')}}">
                        <i class="fa fa-calendar"></i>
                        <span class="nav-label">
                        تایم لاین
                        </span>
                    </a>
                </li>
            @endif

            {{--<li>--}}
                {{--<a href="{{route('messages.inbox')}}">--}}
                    {{--<i class="fa fa-envelope"></i>--}}
                    {{--<span class="nav-label">--}}
                    {{--پیام های من--}}
                    {{--</span>--}}
                    {{--<span class="label label-warning pull-left">{{ auth()->user()->received_messages()->where('read_at',null)->count()?auth()->user()->received_messages()->where('read_at',null)->count():'' }}</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            @if(auth()->user()->hasPermissionTo('تیکت-مشاهده') || auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
            <li>
                <a href="{{route('tickets.index')}}">
                    <i class="fa fa-envelope"></i>
                    <span class="nav-label">
                   مدیریت تیکت ها
                    </span>
                </a>
            </li>
            @endif
            @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                <li>
                    <a href="{{route('contact.index')}}">
                        <i style="-ms-transform:rotateY(180deg);
                                        -webkit-transform: rotateY(180deg);
                                        transform: rotateY(180deg);" class="fa fa-volume-control-phone "></i>
                        <span class="nav-label">
                        تماس با ما           </span>
                        <span class="label label-default pull-left"></span>
                    </a>
                </li>
            @endif
            <li class="landing_link">
                <a target="_blank" href="{{route('home')}}">
                    <i class="fa fa-star">
                    </i>
                    <span class="nav-label">
                                مشاهده سایت</span>
                </a>
            </li>
            
            @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))

                <li>
                    <a href="#">
                        <i class="fa fa-briefcase">
                        </i>
                        <span class="nav-label">
                                پشتیبانی کاربران</span>
                        <span class="fa arrow">
                                </span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='technical.tickets.show' ?' class="active" ':'') !!}>
                                <a href="{{Route('technical.tickets.show')}}">
                                    <i class="fa fa-list"></i>
                                    &nbsp;
                                    مشکلات فنی
                                    <span class="label label-danger pull-left">

                                    {{HR\SupportTicket::where('subject','technical_problem_box')->where('status',0)->count()}}

                            </span>
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='admin.tickets.show' ?' class="active" ':'') !!}>
                                <a href="{{Route('technical.tickets.show')}}">
                                    <i class="fa fa-newspaper-o"></i>
                                    &nbsp;
                                    عدم پاسخ
                                    <span class="label label-success pull-left">

                                    {{HR\SupportTicket::where('subject','review_user_resume_box')->count()}}


                            </span>
                                </a>
                            </li>
                        @endif 
                        
                        @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='defect.tickets.show' ?' class="active" ':'') !!}>
                                <a href="{{Route('defect.tickets.show')}}">
                                    <i class="fa fa-newspaper-o"></i>
                                    &nbsp;
                                   نقص در اطلاعات دانشگاهها یا رشته ها
                                    <span class="label label-success pull-left">

                                    {{HR\SupportTicket::where('subject','defect_information_box')->count()}}


                            </span>
                                </a>
                            </li>
                        @endif
                        
                        @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                            <li {!! (Route::currentRouteName()=='suggestion.tickets.show' ?' class="active" ':'') !!}>
                                <a href="{{Route('suggestion.tickets.show')}}">
                                    <i class="fa fa-newspaper-o"></i>
                                    &nbsp;
                                انتقادات و پیشنهادات
                                    <span class="label label-success pull-left">

                                    {{HR\SupportTicket::where('subject','suggestions_box')->count()}}


                            </span>
                                </a>
                            </li>
                        @endif



                    </ul>
                </li>
            @endif
            
            
                        @if(auth()->user()->hasAnyRole('سوپرادمین|برنامه نویس'))
                <li>
                    <a href="{{route('users.blacklist')}}">
                        <i style="-ms-transform:rotateY(180deg);
                                        -webkit-transform: rotateY(180deg);
                                        transform: rotateY(180deg);" class="fa fa-ban "></i>
                        <span class="nav-label">
                          بلک لیست           </span>
                        <span class="label label-default pull-left"></span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</nav>
