@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Golrang Human Resource">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('custom_css')
    
   <style>
   #main {
  margin: 50px 0;
}

#main #faq .card {
  margin-bottom: 30px;
  border: 0;
}

#main #faq .card .card-header {
  border: 0;
  -webkit-box-shadow: 0 0 20px 0 rgba(213, 213, 213, 0.5);
          box-shadow: 0 0 20px 0 rgba(213, 213, 213, 0.5);
  border-radius: 2px;
  padding: 0;
}

#main #faq .card .card-header .btn-header-link {
  color: #fff;
  display: block;
  text-align: left;
  color: #222;
  padding: 20px;
}

#main #faq .card .card-header .btn-header-link:after {

  font-weight: 900;
  float: right;
}

#main #faq .card .card-header .btn-header-link.collapsed {
  background: #C0C0C0;
  color: #fff;
}

#main #faq .card .card-header .btn-header-link.collapsed:after {
}

#main #faq .card .collapsing {
/*  background: #FFE472;
*/  line-height: 30px;
}

#main #faq .card .collapse {
  border: 0;
}

#main #faq .card .collapse.show {
/*  background: #FFE472;
*/  line-height: 30px;
  color: #222;
}</style>
    
    <link rel="stylesheet" href="/site/default/css/simple-line-icons.css">
    
    
@endsection

@section('title')
    سامانه منابع انسانی :: سوالات متداول
@endsection

@section('content')

        <div class="cd-main-content cd-inner-content" style="min-height: auto">
            <div class="clearfix wrapper-breadcrumb">
                <div class="p-breadcrumbs">
                    <ul class="page-breadcrumbs">
                        <li>
                            <a href="index.html">صفحه اصلی</a>
                        </li>
                        <li><i class="fa fa-angle-left"></i></li>
                        <li class="c-state_active">
                            سوالات متداول
                        </li>
                    </ul>
                </div>
            </div>
            <div class="top-innerpage"
                 style="background:url('/site/default/img/banner.jpg') no-repeat top center/cover;">
                <div class="container"><h1 class="wow animated fadeInUp"> سوالات متداول </h1></div>
            </div>
            <div class="clearfix container inner-content">
                <div class="col-xs-12 wrap-content">
                    <div class="col-md-12 col-sm-12 col-xs-12 left-jobs no-padd-xs no-padd-l">

<div id="main">
  <div class="container">
<div class="accordion" id="faq">
                                @foreach($faqs as $faq)

                    <div class="card" >
                        <div class="card-header" id="faqhead{{$faq->id}}">
                            <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq{{$faq->id}}"
                            aria-expanded="true" aria-controls="faq{{$faq->id}}">{{strip_tags($faq->question)}}</a>
                        </div>

                        <div id="faq{{$faq->id}}" class="collapse" aria-labelledby="faqhead{{$faq->id}}" data-parent="#faq">
                            <div class="card-body">
                                                                            {!! $faq->answer !!}

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
    </div>
  </div>

                    </div>
                </div>
                
                
  </div>
  @endsection