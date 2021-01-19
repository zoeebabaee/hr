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
        .chosen-container {
            width: 100% !important;
        }
    </style>
    {{ Html::style('/site/'.config('app.site_theme').'/css/chosen.css') }}
@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: شغل
@endsection

@section('content')
    <div class="container">

        <div class="error-place">
            @if (count($errors) > 0)
                <div class="bg-error" style="text-align: right">
                    <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                    @foreach ($errors->all() as $error)
                        <p style="direction: rtl">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            @if(Session::has('flash_message'))
                <div class="bg-success" style="text-align: right;padding:8px;">
                    <a href="" class="close-success" style="float:right"><i class="fa fa-remove"></i></a>
                    <p style="direction: rtl">{!! session('flash_message') !!}</p>
                </div>
            @endif
        </div>

        <div class="row text-right">
            <div class="col-lg-3 col-md-6 pt-4 font-14 text-red font-weight-bold">{{$job->title}}</div>
            <div class="col-lg-2 col-md-6 pt-4 font-14"><img src=""><a
                        class="title-timejob color{{$job->cooperation_type}}-timejob">{{$job->cooperation_type_name()}}</a>
            </div>
            <div class="col-lg-4 col-md-6 pt-4 font-14">
                <span>مهلت تا :</span><span>{{JDate::createFromCarbon(Carbon::parse($job->expire_date))->format('l j F Y')}}</span>
            </div>
            <div class="col-lg-3 col-md-6 text-left">
                @if(Auth::check())
                    @if(Auth::user()->profile && \HR\myFuncs::check_blacklist(Auth::user()->profile->national_code))
                        <input type="button"
                               class="request-job-btn search-input-btn w-100 position-relative mt-3 text-light font-13"
                               onclick="$('#myModal_login_btn').remove();$('#modal_message_title').html('پیغام');$('#modal_message_body').html('<center>دسترسی شما جهت ارسال درخواست همکاری محدود شده است. جهت کسب اطلاعات بیشتر می‌توانید با واحد منابع انسانی گروه صنعتی گلرنگ تماس بگیرید.</center>');"
                               data-toggle="modal" data-target="#myModal" value="درخواست همکاری">
                    @else
                        @if($job->apply(Auth::user()->id))
                            <a
                                    @if($job->questions->count() || count($cities_for_apply)>1) onclick="$('#questionsModal').modal('show')"
                                    @else onclick="$('#apply_form').submit();"
                                    @endif  class="request-job-btn search-input-btn w-100 position-relative mt-3  text-light">درخواست
                                همکاری
                            </a>
                        @else
                            <a class="save-re"> <i class="fa fa-check"></i>&nbsp; ثبت شد</a>
                        @endif
                    @endif
                @else
                    <a class="request-job-btn search-input-btn w-100 position-relative mt-3 text-light font-13"
                       onclick="$('#modal_message_title').html('پیغام');$('#modal_message_body').html('برای ارسال درخواست برای یک شغل باید وارد سایت شوید');"
                       data-toggle="modal" data-target="#myModal">درخواست همکاری</a>
                @endif
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-5">
                        <div class="row right-jobs text-right font-13">
                            @if(isset($job->field) && !is_null($job->field) && !empty($job->field))
                                <div class="col-12">
                                    <span class="font-weight-bold">رشته تحصیلی</span>
                                    <span>{{$job->field}}</span>
                                </div>
                            @endif
                            <div class="col-12">
                                <span class="font-weight-bold"> مدرک تحصیلی</span>
                                <span>{{config('app.enum_last_degree')[$job->min_education]}}</span>
                            </div>
                            <div class="col-12">
                                <span class="font-weight-bold">صنعت</span>
                                <span>{{$job->industry->name}}</span>
                            </div>
                            <div class="col-12">
                                <span class="font-weight-bold">جنسیت</span>
                                <span>
                                    @if($job->gender == 1)
                                        {{'مرد'}}
                                    @elseif($job->gender == 2)
                                        {{'زن'}}
                                    @else
                                        {{'فرقی نمی کند'}}
                                    @endif
                                </span>
                            </div>
                            @if(isset($job->jobExp) && !is_null($job->jobExp) && !empty($job->jobExp))
                                <div class="col-12">
                                    <span class="font-weight-bold">سابقه کار</span>
                                    <span>{{$job->jobExp}}</span>
                                </div>
                            @endif
                            <div class="col-12">
                                <span class="font-weight-bold">گروه شغلی</span>
                                <span>{{$job->department->name}}</span>
                            </div>
                            <div class="col-12">
                                <span class="font-weight-bold">استان/استانها</span>
                                @foreach($cities as $city)
                                    <a href="/jobs?province[]={{$city}}" class="city-job"><span>{{$city}} </span></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 text-right font-13">
                        <div class="col-12 m-0 p-0">
                            <span class="font-weight-bold">عنوان شغل :</span>
                            <span>{{$job->title}}</span>
                        </div>
                        <div class="col-12 m-0 p-0">
                            @if(isset($job->goal_or_mission) && !empty($job->goal_or_mission))
                                <span class="font-weight-bold">هدف / ماموریت شغل :</span>
                            @endif
                            <span>{!! $job->goal_or_mission !!}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="w-100">
                    </div>
                    <div class="col-md-12 text-right">
                        @if(isset($job->main_responsibilities) && !empty($job->main_responsibilities))
                            <span class="font-weight-bold">مسئولیتهای اصلی :</span>
                            <span class="red-bolet">{!!  $job->main_responsibilities !!}</span>
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="row mt-3">
                            <div class="col-12">
                                @if(isset($job->job_general_merites) && !empty($job->job_general_merites))
                                    <table class="table table-striped job-details-page dir-rtl text-right  w-100 font-13">
                                        <thead>
                                        <tr>
                                            <th class="text-dark">سطح نیاز</th>
                                            <th class="text-red">شایستگی های عمومی</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($job->job_general_merites as $general)
                                            <tr>
                                                <td style="width:15%">
                                                    @if($general->pivot->value <= 3)
                                                        <img src="/site/default/Template_2019/img/Group 176.svg">
                                                    @elseif($general->pivot->value == 4)
                                                        <img src="/site/default/Template_2019/img/Group 175.svg">
                                                    @endif
                                                </td>
                                                <td style="width:60%">
                                                    {{$general->name}}
                                                </td>

                                                <td>
                                                    @if($general->pivot->value <= 3)
                                                        مزیت محسوب می شود
                                                    @elseif($general->pivot->value == 4)
                                                        الزامی است
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <div class="col-12">
                                @if(isset($job->job_professional_merites) && !empty($job->job_professional_merites))
                                    <table class="table table-striped job-details-page dir-rtl text-right w-100 font-13">
                                        <thead>
                                        <tr>
                                            <th class="text-dark">سطح نیاز</th>
                                            <th class="text-red">شایستگی های تخصصی</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($job->job_professional_merites as $general)
                                            <tr>
                                                <td style="width:15%">
                                                    @if($general->pivot->value <= 3)
                                                        <img src="/site/default/Template_2019/img/Group 176.svg">
                                                    @elseif($general->pivot->value == 4)
                                                        <img src="/site/default/Template_2019/img/Group 175.svg">
                                                    @endif
                                                </td>
                                                <td style="width:60%">
                                                    {{$general->name}}
                                                </td>
                                                <td>
                                                    @if($general->pivot->value <= 3)
                                                        مزیت محسوب می شود
                                                    @elseif($general->pivot->value == 4)
                                                        الزامی است
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                                @if(isset($job->job_other_features) && !empty($job->job_other_features))
                            </div>
                            <div class="col-12">
                            <span class="text-red font-13 font-weight-bold">
                                سایر ویژگی های شغل
                            </span>
                                <hr class="w-100 border-dark m-0 mt-2">
                                <span class="font-13 mt-3 d-block text-right">
                            {!!  $job->job_other_features !!}
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @include('site.modules.related_jobs')
                </div>
            </div>
            <div class="col-md-4">
                <div class="box-shadow clearfix">
                    <div class="col-md-12 text-center">
                        <img src="{{$gig_data['logo']}}" alt="" class="img-fluid w-50">
                    </div>
                    <span class="text-center d-block font-14 font-weight-bold mt-1 mb-4 w-100">{{$gig_data['title']}}</span>
                    <div class="owl-carousel topslider owl-theme dir-ltr">
                        @foreach($images as $img)
                            <div class="item"><a><img src="{{$img->url}}" alt="" class="img-fluid"></a></div>
                        @endforeach
                    </div>
                    <div class="text-center mt-3 mb-3 left-sidebar-jobpage-btn">
                        <a class="o-btn p-2 pr-3 pl-3" href="/company/{{$job->company->id}}/{{$gig_data['url']}}">همه
                            مشاغل شرکت</a>
                        @if($job->ticket_id())
                            <a class="o-btn p-2 pr-3 pl-3" href="{{route('site.tickets.show', $job->ticket_id())}}">ارتباط
                                با شرکت</a>
                        @else
                            <a class="o-btn p-2 pr-3 pl-3" href="" data-toggle="modal" data-target="#contact-modal"
                               data-original-title="">ارتباط با شرکت</a>
                        @endif
                    </div>
                    <div id="map"></div>
                    <a class="w-100 d-block text-dark font-13 text-right mt-5" href="tel:982142661000"><img
                                src="/site/default/Template_2019/img/phone-call%20(1).svg"/> {{$gig_data['tel']}}</a>
                    <span class="font-13 text-right w-100 d-block mt-3"><img
                                src="/site/default/Template_2019/img/placeholder (3).svg"/> دفتر مرکزی  :  {{$gig_data['address']}}</span>
                    <button type="button" class="share-btn d-none"><img src="/site/default/img/share.png" alt=""
                                                                        width="17" height="17"></button>
                    <div class="social-icon ">
                        <a class="fbtn share linkedin" rel="nofollow"
                           href="https://www.linkedin.com/shareArticle?mini=true&url={{url()->current()}}&title={{$job->title}}&summary={{HR\myFuncs::limit_words(strip_tags($job->goal_or_mission), 60)}} ... &source=GolrangHr"></a>
                        <a class="fbtn share linkedin" rel="nofollow"
                           href="https://telegram.me/share/url?text={{$job->title}}&url={{url()->current()}}"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--model contact-->
    <div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="loginmodal-container">
                    <button type="button" class="close-form" data-dismiss="modal" aria-hidden="true">×</button>
                        @if(Auth::check())
                        <div class="modal-body">
                            <h3><span>&nbsp;{{Auth::user()->first_name}} </span> عزیز لطفا جهت ارتباط با
                                شرکت {{$gig_data['title']}} پیغام بگذارید.</h3><br>
                            {!! Form::open(['method' => 'POST', 'route' => ['tickets.site_store'] ]) !!}
                            {{csrf_field()}}
                            <div class="form-group">
                                <select class="form-control" name="priority">
                                    <option value="" selected="selected" disabled>اهمیت</option>
                                    <option value="high">بالا</option>
                                    <option value="medium">متوسط</option>
                                    <option value="low">کم</option>
                                </select> 
<!--                                <i class="fa fa-chevron-down dd-icon"></i>
-->                            </div>
                            <input type="text" name="subject" class="contact-txt form-control" placeholder="موضوع">
                            <input type="hidden" name="company_id" value="{{$job->company->id}}">
        
                            <textarea class="form-control contact-txt" name="body" rows="5" id="body"
                                      placeholder="پیغام"></textarea>
                            <input type="hidden" value="{{$job->id}}" name="job_id">
                            <input type="submit" name="submit" class="btn login loginmodal-submit" value="ارسال">
        
                            {!! Form::close() !!}
                        @else
                            <h3>برای ارسال پیام لطفا وارد وب سایت شوید</h3>
        
                            <br>
                            <a href="{{route('login')}}" target="_blank" class="request-jobs">ورود به وب سایت</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
         style="display: none;">
        <div class="modal-dialog">
            <div class="loginmodal-container">
                <button type="button" class="close-form" data-dismiss="modal" aria-hidden="true">×</button>
                <div id="modal_message_body" style="text-align:right;direction:rtl;font-size: 14px;">
                    <h3>TITLE</h3>

                </div>
                <a id="myModal_login_btn" href="javascript:void(0);//{{route('login')}}"
                   onclick="$('#myModal').modal('toggle');$('#login-modal').modal('toggle');"
                   class="btn login loginmodal-submit" style="width:50px;color:white;">ورود</a>
            </div>
        </div>
    </div>
    <div id="questionsModal" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-right rtl">سوالات کار فرما</h4>
                </div>
                {!! Form::open(['method' => 'POST', 'route' => ['applies.store'], 'id' => 'apply_form' ]) !!}
                <input type="hidden" value="{{$job->id}}" name="job_id">
                <div class="modal-body">
                    @if($job->questions->count())
                        @foreach($job->questions as $question)
                            <div class="form-group">
                                <label style="float: right;direction: rtl"
                                       for="answer_{{$question->id}}">{{$question->question}}</label>
                                <textarea rows="4"
                                          oninvalid="this.setCustomValidity('پاسخ به سوال اجباری می باشد.')"
                                          oninput="setCustomValidity('')"
                                          maxlength="10000" style="direction: rtl;text-align: right"
                                          class="form-control"
                                          required
                                          name="answer[{{$question->id}}]" id="answer_{{$question->id}}"></textarea>
                            </div>
                        @endforeach
                    @endif
                    @if(count($cities_for_apply)>1)
                        <div class="clearfix">
                            <label class="col-12 control-label font-13 text-right rtl">شهرهایی که میتوانید در آنها
                                فعالیت کنید را از لیست زیر انتخاب فرمایید:<span
                                        class="star">*</span></label>
                            <div class="col-12">
                                <select data-validation="required" name="cities[]" id="pc"
                                        data-placeholder="یک گزینه انتخاب کنید"
                                        class="form-control chosen" multiple>
                                    @foreach($cities_for_apply as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="request-jobs position-relative text-light font-13">درخواست همکاری</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{ Html::script('/site/'.config('app.site_theme').'/js/chosen.jquery.js?v=2') }}
    <script>
        $(document).ready(function () {
            $('.chosen').chosen({
                placeholder_text_single: 'انتخاب کنید',
                rtl: true
            });
        });
        $('#questionsModal').on('show.bs.modal', function (e) {
            $('.chosen').chosen({
                placeholder_text_single: 'انتخاب کنید',
                rtl: true
            });
        });
    </script>
    <script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script>
    <link href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css" rel="stylesheet"/>
    <script type="text/javascript">
        // Where you want to render the map.
        var element = document.getElementById('map');

        // Height has to be set. You can do this in CSS too.
        element.style = 'width:320px;height:175px;top: 20px;';

        // Create Leaflet map on map element.
        var map = L.map(element);

        // Add OSM tile leayer to the Leaflet map.
        L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://osm.org/copyright"></a> '
        }).addTo(map);

        // Target's GPS coordinates.
        var target = L.latLng({!! $job->company->LatLng !!});

        // Set map's center to target with zoom 14.
        map.setView(target, 16);

        // Place a marker on the same location.
        L.marker(target).addTo(map);
    </script>


    {{--<script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGtJRlg98-PMXO7cgTRqdFffwHxS2pRGQ&callback=initMap&language=fa"></script>--}}
    <script type="text/javascript">
        /*google.maps.event.addDomListener(window, 'load', init);

        function init() {
            var mapOptions = {
                zoom: 16,
                center: new google.maps.LatLng({!! $job->company->LatLng !!}),
                styles: []
            };
            var mapElement = document.getElementById('map');
            var map = new google.maps.Map(mapElement, mapOptions);
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng({!! $job->company->LatLng !!}),
                map: map,
                title: '{!! $gig_data['title'] !!}'
            });
        }*/

        (function () {
            // trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
            if (!String.prototype.trim) {
                (function () {
                    // Make sure we trim BOM and NBSP
                    var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
                    String.prototype.trim = function () {
                        return this.replace(rtrim, '');
                    };
                })();
            }

            [].slice.call(document.querySelectorAll('input.input__field')).forEach(function (inputEl) {
                // in case the input is already filled..
                if (inputEl.value.trim() !== '') {
                    classie.add(inputEl.parentNode, 'input--filled');
                }

                // events:
                inputEl.addEventListener('focus', onInputFocus);
                inputEl.addEventListener('blur', onInputBlur);
            });

            function onInputFocus(ev) {
                classie.add(ev.target.parentNode, 'input--filled');
            }

            function onInputBlur(ev) {
                if (ev.target.value.trim() === '') {
                    classie.remove(ev.target.parentNode, 'input--filled');
                }
            }
        })();
    </script>
    <script src="/site/companies/js/bootstrap.min.js"></script>
    <script src="/site/companies/js/owl.carousel.min.js"></script>
    <script>

        function apply_ajax(job_id) {
            $('#apply_btn_' + job_id).html('<i class="fa fa-spinner"></i>');

            $.ajax({
                method: "POST",
                url: "{{route('applies.store')}}",
                data: {job_id: job_id, _token: '{!!csrf_token()!!}'}
            }).done(function (msg) {
                $('#apply_btn_' + job_id).html('<i class="fa fa-check"></i>&nbsp;ثبت شد');
            });
        }

        $(document).ready(function () {

            $(".share-btn").click(function (e) {
                $('.networks-5').not($(this).next(".networks-5")).each(function () {
                    $(this).removeClass("active");
                });
                $(this).next(".networks-5").toggleClass("active");
            });
        });

        $(".close-success").click(function () {
            $(".bg-success").hide();
            return false;
        });
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            navText: ["", ""],
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })

        /*$('.topslider').owlCarousel({
            items: 1,
            loop: true,
            margin: 0,
            nav: true,
            navText: ["", ""],
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
        });*/
    </script>
@endsection