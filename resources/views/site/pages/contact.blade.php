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
    سامانه منابع انسانی گروه صنعتی گلرنگ :: تماس با ما
@endsection

@section('content')
     <div class="container cd-inner-content">
            <fieldset class="red-fieldset mt-4 mb-4">
                <legend>تماس با ما </legend>
            </fieldset>
            @if (count($errors) > 0)
                <div class="bg-error" style="text-align: right">
                    <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                    @foreach ($errors->all() as $error)
                        <p style="direction: rtl" >{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            @if(Session::has('flash_message'))
                <div class="bg-error" style="text-align: right">
                    <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                    <p style="direction: rtl" >{!! session('flash_message') !!}</p>
                </div>
            @endif
            <div class="clearfix inner-content">
                <div class="row">
                <form class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12" method="POST" action="{{route('contact.store')}}" align="center">
                    {{csrf_field()}}
                    <section class="clearfix content">
                        <p class="dir-rtl text-right font-13 m-0">با ما در ارتباط باشید</p>
                        <div class="people-forms row">
                            <div class="col-md-12">
                                <div class="people-forms-fields-group">
                                    <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                    <input name="email" class="people-forms-fields input__field input__field--minoru form-control" type="email" id="input-13"  />
                                    <label>ایمیل</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="people-forms-fields-group">
                                    <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                    <input  name="name" class="people-forms-fields input__field input__field--minoru form-control" type="text" id="input-14" />
                                    <label>نام و نام خانوادگی</label>
                                </div>
                            </div>        
                            <div class="col-md-12">
                                <div class="people-forms-fields-group">
                                    <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                    <textarea  class="people-forms-fields input__field input__field--minoru comment-contact p-3" type="text" name="message" id="input-16" placeholder="پیغام"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="people-forms-fields-group">
                                    <div class="row">
                                        <img id="captcha_Contact" src="{{route('site.captcha','Contact')}}?ver=<?= time()?>" alt="" title="" class="pr-3">
                                        <img class="p-2 pull-right" id="refresh-captcha" src="/site/default/Template_2019/img/reload.svg" onclick="$('#captcha_Contact').attr('src', '{{route('site.captcha','contact')}}?ver='+(new Date()).getTime());" style="cursor: pointer" alt="" title="">
                                    </div>
                                </div>
                            </div>  
                            <div class="col-md-12">
                                <div class="people-forms-fields-group">
                                    <div class="fields-required"><img src="/site/default/Template_2019/img/Group 166.svg" /></div>
                                    <input class="people-forms-fields input__field input__field--minoru form-control" name="Contact_captcha" type="text" id="input-18" />        
                                    <label>تصویر امنیتی</label>
                                </div>
                            </div>        
                            <fieldset class="mt-3 w-100">
                                <legend>
                                    <input type="submit" name="login" class="center-btn save send-btn-green" value="ارسال">
                                </legend>
                            </fieldset>
                        </div>
                    </section>
                </form>
                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div id="map-contact" class="mt-3"></div>
                    <div class="address-contact">
                        <div class="text-right mt-5">
                            <div class="mt-2"><span class="text-red font-weight-bold">آدرس دفتر مرکزی :</span> تهران، خیابان ولیعصر، ضلع شمالی پارک ساعی، خیابان ساعی یکم، پلاک ۱۵</div>
                            <div class="mt-2"><span class="text-red font-weight-bold">تلفن : </span><a class="text-dark" href="tel:42661000"> 42661000</a></div>
                            <div class="mt-2"><span class="text-red font-weight-bold">فکس :</span><a class="text-dark" href="tel:42661111">42661111 </a></div>
                            <div class="mt-2"><a class="text-dark" href="https://golrang.com/contents/all-companies"><span class="text-red font-weight-bold">ارتباط با سایر شرکت های زیر مجموعه گروه صنعتی گلرنگ </span></a></div>

                        </div>
                        <fieldset class="red-fieldset mt-4">
                            <legend>آدرس شبکه‌های اجتماعی</legend>
                        </fieldset>         
                        <div class="text-right">
                            <a href="https://www.instagram.com/golrang.group/"  target="_blank"><img src="/site/default/Template_2019/img/insta_social_icon.svg" alt="golrang_people" title="golrang_people" width="50"></a>
                            <a href="https://www.linkedin.com/company/golrang/?viewAsMember=true"  target="_blank"><img src="/site/default/Template_2019/img/linkdin_social_icon.svg.svg" alt="golrang_people" title="golrang_people" width="50"></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 d-xl-block d-lg-none d-md-none d-sm-none d-none">
                    <img src="/site/default/Template_2019/img/contacthr.svg" alt="" title="">
                </div>
            </div>
            </div>
    </div>
@endsection

@section('script')
    <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
    <link href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" rel="stylesheet"/>
    <script type="text/javascript">
        // Where you want to render the map.
        var element = document.getElementById('map-contact');

        // Height has to be set. You can do this in CSS too.
        element.style = 'height:150px;';

        // Create Leaflet map on map element.
        var map = L.map(element);

        // Add OSM tile leayer to the Leaflet map.
        L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Target's GPS coordinates.
        var target = L.latLng(35.737759, 51.410440);

        // Set map's center to target with zoom 14.
        map.setView(target, 15);

        // Place a marker on the same location.
        L.marker(target).addTo(map);
    </script>
@endsection