<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.ico?v=<?= filemtime('favicon.ico') ?>" type="image/png">

    @include('layout.admin.'.config('app.admin_theme').'.header')
        @yield('top_scripts_page')
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <!--
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112435217-3"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-112435217-3');
            </script>
        -->
    </head>
    <body class="pace-done">
        @include('layout.admin.'.config('app.admin_theme').'.menu_sidebar')
        <div id="page-wrapper" class="gray-bg">



            <div class="row border-bottom">
                @include('layout.admin.'.config('app.admin_theme').'.navbar')

                @if(Session::has('flash_message'))
                    <div class="container" id="alert_messages_div">
                        <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        @include ('errors.list')
                    </div>
                </div>

                @yield('content')
            </div>
            @include('layout.admin.'.config('app.admin_theme').'.footer')
        </div>


        @yield('scripts_footer')
        @yield('scripts_page')



    </body>
</html>
