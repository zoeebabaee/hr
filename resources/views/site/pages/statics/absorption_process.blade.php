@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('custom_css')
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }
    </style>
@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: فرآیند جذب
@endsection

@section('content')
    <div class="cd-main-content cd-inner-content">
        <div class="col-12 top-innerpage" style="background:url('/site/default/img/banner_blog.png') no-repeat top center/cover;">
            <div class="container"><h1 class="wow animated fadeInUp">  فرآیند جذب </h1></div>
        </div>
        <div class="clearfix container inner-content">
            <div class="clearfix wrap-content">
                <div class="clearfix bg-employ">
                    <img src="/site/default/img/Recruitment.jpg" usemap="#image-map" class="img-responsive map" id="image-map">
                    <map name="image-map">
                        <area target="" alt="1" title="فیلتر اولیه" data-toggle="modal" data-target="#modal-cir1" data-original-title="" coords="627,232,64" shape="circle" class="modalcir">
                        <area target="" alt="3" title="مصاحبه تلفنی" data-toggle="modal" data-target="#modal-cir3" data-original-title="" coords="463,396,63" shape="circle" class="modalcir">
                        <area target="" alt="2" title="فیلتر ثانویه" data-toggle="modal" data-target="#modal-cir2" data-original-title="" coords="627,396,64" shape="circle" class="modalcir">
                        <area target="" alt="4" title="مصاحبه حضوری" data-toggle="modal" data-target="#modal-cir4" data-original-title="" coords="462,560,63" shape="circle" class="modalcir">
                        <area target="" alt="5" title="آزمون های شناختی و مهارتی" data-toggle="modal" data-target="#modal-cir6" data-original-title="" coords="464,724,64" shape="circle" class="modalcir">
                        <area target="" alt="6" title="مصاحبه با مدیران سطح یک" data-toggle="modal" data-target="#modal-cir5" data-original-title="" coords="627,724,63" shape="circle" class="modalcir">
                        <area target="" alt="7" title="مصاحبه با مدیر عامل" data-toggle="modal" data-target="#modal-cir7" data-original-title="" coords="627,891,63" shape="circle" class="modalcir">
                        <area target="" alt="8" title="تدارک مقدمات شروع همکاری" data-toggle="modal" data-target="#modal-cir8" data-original-title="" coords="862,962,102" shape="circle" class="modalcir">
                    </map>
                </div>
            </div>
        </div>
    </div>
    <!--model register-->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="loginmodal-container">
                <button type="button" class="close-form" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><img src="/site/default/img/profile_login.png" title="" alt="" width="50"><span> ورود</span></h2><br>
                <form>
                    <input type="text" name="user" placeholder="شماره موبایل" class="form-control">
                    <input type="password" name="pass" placeholder="رمز عبور" class="form-control">
                    <input type="submit" name="login" class="btn login loginmodal-submit" value="ورود">
                </form>
                <div class="login-help">
                    <a href="#"> عضویت </a>  |  <a href="#"> فراموشی رمز عبور </a>
                </div>
            </div>
        </div>
    </div>
    <!--model CIR1-->
    <div class="modal fade" id="modal-cir1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="employ-container">
                <button type="button" class="close-form" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><span> 	فیلتر اولیه</span></h2>
                <p>{!! $boxes[0] !!}</p>
            </div>
        </div>
    </div>
    <!--model CIR2-->
    <div class="modal fade" id="modal-cir2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="employ-container">
                <button type="button" class="close-form" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><span> 	فیلتر ثانویه</span></h2>
                <p>{!! $boxes[1] !!}</p>
            </div>
        </div>
    </div>

    <!--model CIR3-->
    <div class="modal fade" id="modal-cir3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="employ-container">
                <button type="button" class="close-form" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><span>	مصاحبه تلفنی </span></h2>
                <p>{!! $boxes[2] !!}</p>
            </div>
        </div>
    </div>
    <!--model CIR4-->
    <div class="modal fade" id="modal-cir4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="employ-container">
                <button type="button" class="close-form" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><span> 	مصاحبه حضوری </span></h2>
                <p>{!! $boxes[3] !!}</p>
            </div>
        </div>
    </div>
    <!--model CIR5-->
    <div class="modal fade" id="modal-cir6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="employ-container">
                <button type="button" class="close-form" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><span> 		آزمون های شناختی و مهارتی </span></h2>
                <p>{!! $boxes[4] !!}</p>
            </div>
        </div>
    </div>
    <!--model CIR6-->
    <div class="modal fade" id="modal-cir5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="employ-container">
                <button type="button" class="close-form" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><span> 		مصاحبه با مدیران سطح یک </span></h2>
                <p>{!! $boxes[5] !!}</p>
            </div>
        </div>
    </div>

    <!--model CIR7-->
    <div class="modal fade" id="modal-cir7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="employ-container">
                <button type="button" class="close-form" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><span> 	مصاحبه با مدیر عامل </span></h2>
                <p>{!! $boxes[6] !!}</p>
            </div>
        </div>
    </div>

    <!--model CIR8-->
    <div class="modal fade" id="modal-cir8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="employ-container">
                <button type="button" class="close-form" data-dismiss="modal" aria-hidden="true">×</button>
                <h2><span> 	تدارک مقدمات شروع همکاری </span></h2>
                <p>{!! $boxes[7] !!}</p>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript" src="/site/default/js/jquery.rwdImageMaps.min.js"></script>
    <script type="text/javascript" src="/site/default/js/jquery.maphilight.js"></script>
    <script>
        $(window).on('resize', function(){
            $('.map').maphilight();
        });
        $(function() {
            $('.map').maphilight();
            $('#image-map').rwdImageMaps();
        });
    </script>
@endsection