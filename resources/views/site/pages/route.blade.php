@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Golrang Human Resource">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('custom_css')
    <link rel="stylesheet" href="/site/default/css/simple-line-icons.css">
@endsection

@section('title')
    سامانه منابع انسانی :: تماس با ما
@endsection

@section('content')
    <div class="cd-main-content cd-inner-content">
        <div class="col-xs-12 wrapper-breadcrumb">
            <div class="p-breadcrumbs">
                <ul class="page-breadcrumbs">
                    <li>
                        <a href="{{route('home')}}">صفحه اصلی</a>
                    </li>
                    <li> <i class="fa fa-angle-left"></i> </li>
                    <li class="c-state_active">
                        مسیریابی تا گروه صنعتی گلرنگ
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-xs-12 top-innerpage" style="background:url('/site/default/img/banner_blog.png') no-repeat top center/cover;">
            <div class="container"><h1 class="wow animated fadeInUp">   مسیریابی تا گروه صنعتی گلرنگ  </h1></div>
        </div>
        <div class="clearfix container inner-content">
            <div class="col-xs-12 wrap-content">
                <div class="col-xs-12 left-jobs no-padd-xs no-padd">
                    <h3> » مسیریابی موقعیت کنونی شما تا گروه صنعتی گلرنگ توسط سرویس های گوگل </h3>
                    <p>در صورتی که GPS موبایل یا اجازه ی دسترسی به موقعیت در مرورگر شما فعال نباشد قادر به استفاده از سرویس زیر نخواهید بود.<br>
                        مسیر نمایش داده شده ، نزدیک ترین مسیر به لحاظ زمانی و فاصله است.</p>
                    <br>
                    <div class="col-md-6 c-left-b no-padd-r no-padd-xs" align="center">
                        <div id="main-map">  <div id="gs_panel" style="height: 500px;overflow: auto;"></div></div>
                    </div>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGtJRlg98-PMXO7cgTRqdFffwHxS2pRGQ&callback=initMap&language=fa" type="text/javascript"></script>
                    <div class="col-md-6 c-right-b no-padd" align="center" style="height: 500px;margin-bottom: 15px;" id="gs_route"></div>
                    <script>
                        navigator.geolocation ? navigator.geolocation.getCurrentPosition(function(o) {
                            var e = o.coords.latitude,
                                t = o.coords.longitude,
                                a = new google.maps.LatLng(e, t),
                                n = new google.maps.DirectionsService,
                                i = new google.maps.DirectionsRenderer,
                                g = {
                                    zoom: 15,
                                    center: a,
                                    mapTypeControl: !0,
                                    navigationControlOptions: {
                                        style: google.maps.NavigationControlStyle.SMALL
                                    },
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                };
                            map = new google.maps.Map(document.getElementById("gs_route"), g), i.setMap(map), i.setPanel(document.getElementById("gs_panel"));
                            var r = {
                                    origin: a,
                                    destination: "35.7357926,51.4169058",
                                    durationInTraffic: !0,
                                    travelMode: google.maps.DirectionsTravelMode.DRIVING
                                },
                                s = new google.maps.TrafficLayer;
                            s.setMap(map), n.route(r, function(o, e) {
                                e == google.maps.DirectionsStatus.OK && i.setDirections(o)
                            })
                        }) : alert("سیستم موقعیت یاب شما غیر فعال می باشد.");
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection