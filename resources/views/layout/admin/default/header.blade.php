<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
    @yield('title')
</title>
{{ Html::style('/admin/'.config('app.admin_theme').'/css/bootstrap.min.css?v=1') }}
{{ Html::style('/admin/'.config('app.admin_theme').'/css/bootstrap.rtl.min.css?v=1') }}
{{ Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?v=1') }}
<!-- Morris -->
{{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/morris/morris-0.4.3.min.css?v=1') }}
<!-- Gritter -->
{{ Html::style('/admin/'.config('app.admin_theme').'/js/plugins/gritter/jquery.gritter.css?v=1') }}
{{ Html::style('/admin/'.config('app.admin_theme').'/css/animate.css?v=1') }}
{{ Html::style('/admin/'.config('app.admin_theme').'/css/style.rtl.css?v=5') }}
{{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/toastr/toastr.min.css') }}
@yield('header_styles')