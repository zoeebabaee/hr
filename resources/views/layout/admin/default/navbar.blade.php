

        <nav class="navbar navbar-static-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#">
                    <i class="fa fa-bars">
                    </i>
                </a>
                {{--
                <form role="search" class="navbar-form-custom" action="">
                    <div class="form-group">
                        <input type="text" placeholder="جستجو" class="form-control" name="top-search" id="top-search">
                    </div>
                </form>
                --}}
            </div>

                <ul class="nav navbar-top-links navbar-left">
                    @if($unread_messages)
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="fa">
                            <i class="fa fa-bell"></i>  <span class="label label-danger">{{$unread_messages}}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            @if($unread_messages)
                                <li>
                                    <a href="/adpanel/talks">
                                        <div>
                                            <i class="fa fa-comments fa-fw"></i> شما {{$unread_messages}} پیغام گفتگو دارید
                                            {{--<span class="pull-left text-muted small">4 دقیقه پیش</span>--}}
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                            @endif
                            {{--<li>--}}
                                {{--<a href="profile.html">--}}
                                    {{--<div>--}}
                                        {{--<i class="fa fa-twitter fa-fw"></i>۱۲ تیکت در انتظار پاسخ--}}
                                        {{--<span class="pull-left text-muted small">12 دقیقه پیش</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        </ul>
                    </li>
                @endif
                <li>
                   @if(!Auth::user()->email || !Auth::user()->profile)
                    <div class="alert alert-danger">
                    <strong>هشدار:</strong>
                ادمین محترم لطفا اطلاعات پروفایل خود را کامل کنید(ترجیحا ایمیل شرکتی یا ایمیل و کدملی ...) در غیر اینصورت اطلاعیه انقضای آگهی برایتان ارسال نخواهد شد.
                    </div>
                @endif  
                </li>
               
                
                <li >
                    <a style="color:#2e2e2e !important;" href="{{route('talks')}}">
                        <i style="color:#2e2e2e !important;" class="fa fa-comments"></i>
                        گفتگو
                    </a>
                </li>

                <li>
                    <a target="_blank" href="{{route('home')}}">مشاهده سایت</a>
                </li>

                <li>
                                <span class="m-r-sm text-muted welcome-message">
                                    @if(Auth::user()->first_name)
                               خوش آمدید
       <strong> {{Auth::user()->first_name}}</strong>
                                        عزیز

                                    @endif
                                </span>
                </li>

                {{--<li class="dropdown">--}}
                    {{--<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">--}}
                        {{--<i class="fa fa-envelope">--}}
                        {{--</i>--}}
                        {{--<!--<span class="label label-warning">16</span>-->--}}
                    {{--</a>--}}

                {{--</li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">--}}
                        {{--<i class="fa fa-bell"></i>--}}
                        {{--<span class="label label-primary">1</span>--}}
                    {{--</a>--}}

                   {{-- <ul class="dropdown-menu dropdown-alerts">--}}
                        {{--<li>--}}
                            {{--<a href="#">--}}
                                {{--<div>--}}
                                    {{--<i class="fa fa-envelope fa-fw">--}}
                                    {{--</i>--}}
                                    {{--شما 1 پیغام دارید--}}
                                    {{--<span class="pull-left text-muted small">--}}
                                                {{--5 دقیقه پیش</span>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="divider">--}}
                        {{--</li>--}}
                    {{--</ul>--}}

                {{--</li>--}}
                <li>
                    <a href="{{route('logout')}}">
                        <i class="fa fa-sign-out">
                        </i>
                        خروج
                    </a>
                </li>
                {{--
                <li>
                    <a class="left-sidebar-toggle">
                        <i class="fa fa-tasks">
                        </i>
                    </a>
                </li>
                --}}
            </ul>
        </nav>
