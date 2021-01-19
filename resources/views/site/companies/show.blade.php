<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>سامانه منابع انسانی گروه صنعتی گلرنگ‌::{{$company->name}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="www.golrangsystem.com">
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:description " content=""/>

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="icon" href="/favicon.ico?v=<?= filemtime('favicon.ico') ?>" type="image/png">

    <link rel="stylesheet" href="/site/companies/css/bootstrap.css?v=1">
    <link rel="stylesheet" type="text/css" href="/site/companies/css/fontawesome-all.css?v=1"/>
    <link href="/site/companies/css/owl.carousel.min.css?v=1" rel="stylesheet">
    <link href="/site/companies/css/owl.theme.default.min.css?v=1" rel="stylesheet">
    <link rel="stylesheet" href="/site/companies/css/company.css?v=3">
    <script src="/site/companies/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<section class="container">
    <div class="clearfix inner-white row-height">
        <div class="col-md-9 col-sm-8 col-xs-12 no-padd-xs no-padd">
            <div class="bd-login">
                <div class="clearfix pull-right title-header">
                    <h3 class="wow animated fadeIn">فرصت های همکاری با<span> {{$data['title']}}   </span>
                    </h3>
                </div>
                <div class="clearfix pull-left">
                    <div class="clearfix">
                        <div class="top-link">

                            @if(Auth::check())
                                <a href="{{route('logout')}}" class="btn login"> خروج  <i class="fa fa-sign-out"></i></a>
                                @can('پنل ادمین')
                                    <a href="{{route('adpanel')}}" class="btn login">ادمین <i class="fa fa-gears"></i></a>
                                @endcan
                                <a class="btn login" href="{{route('site.user.profile')}}">
                                    <strong>{{Auth::user()->first_name}}</strong>
                                    <img src="{{Auth::user()->avatar}}" alt="" title="" width="17" height="17" class="avatar">
                                </a>
                            @else
                                <a href="{{route('login')}}" class="btn login">ورود</a>
                                <a href="{{route('register')}}" class="btn login">عضویت</a>
                            @endif
                            {{--<a class="cd-search-trigger" href="#cd-search"><span></span></a>--}}
                        </div>
                    </div>
                    <div class="top-phone">
                        <div id="cd-search" class="cd-search">
                            <form action="" method="GET">
                                <input name="query" id="search_query" placeholder="جستجو در سایت ..." type="search"
                                       autocomplete="off">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 wrapper-content4 no-padd-xs no-padd">
                <!-- <h3 class="wow animated fadeIn">فرصت های  همکاری  با فروشگاه های زنجیره ای افق کورش</h3>  -->
                <div class="clearfix">
                    @foreach($jobs as $job)
                        <div class="col-md-4 col-sm-6 col-ms-6 col-xs-12">
                            <div class="clearfix grid-searchjob">
                                <a href="{{route('jobs.show',$job->persian_alias)}}" class="grid-img">
                                    <img src="{!! $data['logo'] !!}" alt="" title="" width="100%"
                                         class="img-responsive">
                                </a>
                                <div class="clearfix wrapper-grid">

                                    <a href="{{route('jobs.show',$job->persian_alias)}}"><h2>{{$job->title}}</h2></a>
                                    <h4>{{$job->company->name}}</h4>
                                    <h4 class=" color{{$job->cooperation_type}}-timejob-grid">
                                        {{$job->cooperation_type_name()}}
                                    </h4>
                                    <div class="clearfix wrap-grid-btn">
                                        <h6><i class="fa fa-map-marker"></i>
                                            @php

                                                $cities = $job->cities;
                                                $result = array();
                                                foreach ($cities as $city)
                                                {
                                                $result[$city->province->name] = 1;
                                                }
                                                $result = array_keys($result);
                                                if(count($result) == \HR\Province::all()->count())
                                                echo 'کل کشور';
                                                elseif(count($result) > 1 && count($result) < \HR\Province::all()->count() )
                                                echo 'شهرهای متعدد';
                                                else
                                                {
                                                echo $result[0];
                                                }

                                            @endphp
                                        </h6>
                                        <a href="{{route('site.company.job',$job->persian_alias)}}" class="request-jobs"><i
                                                    class="fa fa-arrow-left"></i> مشاهده</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if($jobs->count() == 0)
                            <h3  style="direction: rtl;text-align: center;padding-top: 100px"><img src="/site/companies/img/warning.png" alt=""> در حال حاضر هیچ آگهی فعالی برای این شرکت وجود ندارد.</h3>
                    @endif

                    <div class="clearfix"></div>
                    <div class="text-center">

                        <ul class="pagination" style="direction: ltr !important;">
                            {!! $jobs->fragment('Jobs')->links() !!}
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12 no-padd no-padd-xs item-text">
            <div class="clearfix row1-content bg-orange">
                <a href="#" class="logo-company"><img src="{{$data['logo']}}" alt="" title="" width="100%"
                                                      class="img-responsive"></a>
                <h1 class="wow animated fadeIn">{{$data['title']}}</h1>
                <ul class="clearfix sn-icons">
                    @if(!empty($data['telegram']))
                        <li><a href="https://t.me/{!! $data['telegram'] !!}" target="_blank" data-toggle="tooltip"
                               title="Telegram"><i
                                        class="fab fa-telegram"></i></a></li>
                    @endif
                    @if(!empty($data['linkedin']))
                        <li><a href="https://www.linkedin.com/{!! $data['linkedin'] !!}" target="_blank"
                               data-toggle="tooltip"
                               title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                    @endif
                    @if(!empty($data['instagram']))
                        <li><a href="https://instagram.com/{!! $data['instagram'] !!}" target="_blank"
                               data-toggle="tooltip"
                               title="Instagram"><i class="fab fa-instagram"></i></a></li>
                    @endif
                </ul>
                <hr>
                <div class="more">
                    <p>{!! $data['introduction'] !!}</p>
                </div>
                <div class="clearfix">
                    @if(!empty($data['tel']))
                        <a href="tel:{!! myFuncs::nums_to_en(str_replace('-', '', $data['tel'])) !!}"
                           class="btn-orange">تماس
                            با شرکت </a>
                    @endif
                    @if(!empty($data['email']))
                        <a href="mailto:{!! $data['email'] !!}" class="btn-orange">ایمیل</a>
                    @endif
                    @if(!empty($data['web']))
                        <a href="http://{!! $data['web'] !!}" target="_blank" class="btn-orange">وبسایت شرکت</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>
<section class="container">
    <div class="col-xs-12 bg-white">
        <h2 class="wow animated fadeIn gig-btn"><a target="_blank" href="/jobs"><img src="/site/companies/img/gig.png"
                                                                                     alt="" title=""
                                                                                     class="frimg"><span>اطلاع از سایر فرصت های شغلی گروه صنعتی گلرنگ   </span></a>
        </h2>
    </div>
</section>
@if($images)
    <section class="container wrapper-content3">
        <div class="col-xs-12 bg-grey">
            <h3>گالری تصاویر</h3>
            <div class="owl-carousel owl-theme gallery">
                @foreach($images as $image)
                    <div class="item" data-toggle="modal" data-target="#myModal">
                        <a href="#"
                           onclick="showGalleryModal('{!! $image->url !!}','');"><img
                                    src="{!! $image->url !!}" alt="" title="" class="img-responsive"></a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
<section class="container">
    <div class="wrapper-content2 clearfix">
        <div class="col-md-6 col-sm-6 col-xs-12 row2-col1">
            <?php foreach ($company_detail_right as $key=>$item): ?>
            <h2>{!! $key !!}</h2>
            <p>
                {!! $item !!}
            </p>
            <?php endforeach; ?>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 row2-col1">
            <?php foreach ($company_detail_left as $key=>$item): ?>
            <h2>{!! $key !!}</h2>
            <p>
                {!! $item !!}
            </p>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<a class="cd-top cd-fade-out" href="#"></a>
<footer class="container">
    <div class="footer clearfix">
        <p> کپی رایت © 2018 سامانه منابع انسانی گلرنگ همه حقوق محفوظ است. طراحی و پیاده سازی توسط <a class="link-white"
                                                                                                     href="http://golrangsystem.com"
                                                                                                     target="_blank">گلرنگ
                سیستم</a></p>
    </div>
</footer>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="pull-left" id="modal_title"></div>
                <button class="btn-sm close" type="button" data-dismiss="modal"><img src="/site/companies/img/close.png"
                                                                                     alt="" title=""></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
<script src="/site/companies/js/vendor/jquery-1.12.0.min.js"></script>
<script src="/site/companies/js/bootstrap.min.js"></script>
<script src="/site/companies/js/owl.carousel.min.js"></script>
<script src="/site/companies/js/main.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $('.gallery').owlCarousel({
        items: 4,
        stagePadding: 20,
        lazyLoad: true,
        loop: false,
        margin: 30,
        animateOut: 'fadeOut',
        autoplay: true,
        nav: true,
        navText: ["", ""],
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            480: {
                items: 2,
                nav: true
            },
            768: {
                items: 3,
                nav: true
            },
            1000: {
                items: 4,
                nav: true,
                loop: false
            }
        }
    });

    function showGalleryModal(img, title) {
        $('.modal-body').html('<img src=\'' + img + '\' class=\'img-responsive\' style=\'width:100%\' alt=\'' + title + '\'>');
        $('#modal_title').html(title);
    }

    /* back to top*/
    jQuery(document).ready(function ($) {
        var offset = 300,
            offset_opacity = 1200,
            scroll_top_duration = 700,
            $back_to_top = $('.cd-top');
        $(window).scroll(function () {
            ($(this).scrollTop() > offset) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
            if ($(this).scrollTop() > offset_opacity) {
                $back_to_top.addClass('cd-fade-out');
            }
        });
        $back_to_top.on('click', function (event) {
            event.preventDefault();
            $('body,html').animate({
                    scrollTop: 0,
                }, scroll_top_duration
            );
        });
    });

</script>
<script type="text/javascript">
    var showChar = 300;
    var ellipsestext = "...";
    var moretext = "بیشتر";
    var lesstext = "کمتر";
    $('.more').each(function () {
        var content = $(this).html();
        var textcontent = $(this).text();

        if (textcontent.length > showChar) {

            var c = textcontent.substr(0, showChar);
            //var h = content.substr(showChar-1, content.length - showChar);

            var html = '<div class="clearfix"><div>' + c + '</div>' + '<div class="moreelipses">' + ellipsestext + '</div></div><div class="morecontent">' + content + '</div>';

            $(this).html(html);
            $(this).after('<a href="" class="morelink">' + ' <i class="fa fa-angle-left"></i> ' + moretext + '</a>');
        }

    });

    $(".morelink").click(function () {
        if ($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(' <i class="fa fa-angle-left"></i> ' + moretext);
            $(this).prev().children('.morecontent').slideToggle(500, function () {
                $(this).prev().slideToggle(500);
            });

        } else {
            $(this).addClass("less");
            $(this).html(' <i class="fa fa-angle-left"></i> ' + lesstext);
            $(this).prev().children('.clearfix').slideToggle(500, function () {
                $(this).next().slideToggle(500);
            });
        }
        //$(this).prev().children().fadeToggle();
        //$(this).parent().prev().prev().fadeToggle(500);
        //$(this).parent().prev().delay(600).fadeToggle(500);

        return false;
    });
</script>

</body>
</html>
