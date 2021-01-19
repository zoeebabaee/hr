@extends('layout.site.default.global.main')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Golrang Human Resource">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('custom_css')
    {{ Html::style('/admin/'.config('app.admin_theme').'/css/plugins/chosen/chosen.css') }}
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    {{--@if($errorss)
        {{dd($errorss)}}
    @endif--}}
    {{ Html::style('/site/'.config('app.site_theme').'/css/dmuploader.css') }}


@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: میز کار من
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
                        ثبت نام در کارگاه آموزشی-تبلیغاتی در دانشکده مدیریت دانشکده تهران
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 top-innerpage" style="background:url('/site/default/img/banner.jpg') no-repeat top center/cover;">
            <div class="container"><h1 class="wow animated fadeInUp" style="text-shadow: 0 0 8px #000000;"> ثبت نام در کارگاه آموزشی-تبلیغاتی </h1></div>
        </div>
        <div class="clearfix container inner-content">
            <div class="col-xs-12 wrap-content" style="background: url('/site/default/img/mouse.jpg') no-repeat right bottom;" class="col-xs-12 wrap-content pull-left">
                <div class="col-md-7 col-sm-12 col-xs-12 left-jobs no-padd-xs no-padd-l pull-left" id="scroll-resume" >
                    @if(Session::has('flash_message'))
                        <div class="bg-error" style="text-align: right">
                            <a href="" class="close-error"><i class="fa fa-remove"></i></a>
                            <p style="direction: rtl" >{!! session('flash_message') !!}</p>
                        </div>
                    @endif
                        <h3> اطلاعات فردی</h3>
                        <h4>مشخصات عمومی</h4>
                        {{ Form::open(array('method'=>'POST','route' => 'uniForm.store', 'files'=>true)) }}
                        {{csrf_field()}}
                        <div class="moshkasatfard">
                            <div class="col-md-9 no-padd no-padd-xs" >
                                <div class="row">

                                    <div class="col-md-6 no-padd no-padd-xs">
                                        <label class="col-md-12 control-label">نام <span class="star">*</span></label>
                                        <div class="col-md-12">
                                            <input  type="text" name="first_name" value="{{old('first_name')}}" class="form-control" />
                                            @if($errors->has('first_name'))
                                            <p class="help-block">{{$errors->first('first_name')}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 no-padd no-padd-xs">
                                        <label class="col-md-12 control-label">نام خانوادگی <span class="star">*</span></label>
                                        <div class="col-md-12">
                                            <input  type="text" name="last_name" value="{{old('last_name')}}" class="form-control" />
                                            @if($errors->has('first_name'))
                                                <p class="help-block">{{$errors->first('last_name')}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 no-padd no-padd-xs">
                                        <label class="col-md-12 control-label">شماره دانشجویی <span class="star">*</span></label>
                                        <div class="col-md-12">
                                            <input  type="text" name="student_id" value="{{old('student_id')}}" class="form-control" />
                                            @if($errors->has('student_id'))
                                                <p class="help-block">{{$errors->first('student_id')}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 no-padd no-padd-xs">
                                        <label class="col-md-12 control-label">شماره همراه <span class="star">*</span></label>
                                        <div class="col-md-12">
                                            <input  type="text" name="mobile" value="{{old('mobile')}}" class="form-control" />
                                            @if($errors->has('mobile'))
                                                <p class="help-block">{{$errors->first('mobile')}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 no-padd no-padd-xs">
                                        <label class="col-md-12 control-label">ایمیل <span class="star">*</span></label>
                                        <div class="col-md-12">
                                            <input  type="text" name="email" value="{{old('email')}}" class="form-control" />
                                            @if($errors->has('email'))
                                                <p class="help-block">{{$errors->first('email')}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 no-padd no-padd-xs">
                                        <label class="col-md-12 control-label">بارگذاری رزومه </label>
                                        <div class="col-md-12">
                                            <div id="drag-and-drop-zone" class="uploader">
                                                <div class="browser">
                                                    <span id="cv_label">رزومه خود را آپلود کنید.</span>
                                                    <label>
                                                        <span><i class="fa fa-download"></i></span>
                                                        <input type="file" accept="application/pdf" value="{{old('cv')}}" id="cv" name="cv" onchange=" document.getElementById('cv_label').innerHTML = this.value;"  title="کلیک کنید و فایل مورد نظر را انتخاب کنید">
                                                        @if($errors->has('cv'))
                                                            <p class="help-block">{{$errors->first('cv')}}</p>
                                                        @endif
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 no-padd no-padd-xs">
                                        <label class="col-md-12 control-label" >علاقه مندی های شغلی <span class="star">*</span></label>
                                        <div class="col-xs-12">

                                            <select name="interests[]" data-placeholder="انتخاب کنید"  class="chosen-select form-control" multiple >
                                                @foreach($industries as $industry)
                                                    <option @if(old('interests') && in_array($industry->name,old('interests'))) selected="selected" @endif value="{{$industry->name}}"> {{$industry->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('interests'))
                                                <p class="help-block">{{$errors->first('interests')}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 no-padd no-padd-xs">
                                        <label class="col-md-12 control-label">میخواهید در کارگاه ثبت نام کنید؟ <span class="star">*</span></label>
                                        <div class="col-md-12">
                                            <input data-toggle="toggle" name="wantRegister" data-on="بله" data-off="خیر" type="checkbox">
                                            @if($errors->has('wantRegister'))
                                                <p class="help-block">{{$errors->first('wantRegister')}}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12 no-padd no-padd-xs">
                                        <label class="col-md-12 control-label">کد امنیتی <span class="star">*</span></label>
                                        <div class="col-md-6">
                                            <input  type="text" name="uni_captcha" value="{{old('uni_captcha')}}" class="form-control" >
                                            @if($errors->has('uni_captcha'))
                                                <p class="help-block">{{$errors->first('uni_captcha')}}</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <img id="captcha_uni" style="display: inline-block !important;" src="{{route('site.captcha','uni_captcha')}}">
                                            <img id="refresh-captcha"  src="/site/default/img/refresh.png" onclick="$('#captcha_uni').attr('src', '{{route('site.captcha','uni_captcha')}}?ver='+(new Date()).getTime());" style="cursor: pointer;display: inline-block !important;">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 no-padd no-padd-xs">
                            <input type="submit" class="save" title="ثبت اطلاعات" value="ثبت اطلاعات">
                        </div>
                        {{Form::close()}}
                </div>
            </div>
        </div>

@endsection

@section('script')

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    {{ Html::script('/site/'.config('app.site_theme').'/js/dmuploader.js') }}
    {{ Html::script('/admin/'.config('app.admin_theme').'/js/plugins/chosen/chosen.jquery.js') }}

    <script>
        if ($(window).width() < 992) {
            $(document).ready(function () {
                // Handler for .ready() called.
                $('html, body').animate({
                    scrollTop: $('#scroll-resume').offset().top -20
                }, 'slow');
            });
        }
        $(document).ready(function(){
            $(".close-error").click(function(){
                $(".bg-error").hide();
                return false;
            });

        });
        $(".chosen-select").chosen({
            rtl: true
        });
    </script>

@endsection