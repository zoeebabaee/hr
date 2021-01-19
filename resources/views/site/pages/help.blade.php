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
    سامانه منابع انسانی :: راهنما
@endsection

@section('content')
   <div class="container cd-inner-content">
        <div class="col-12 no-padd">
            <fieldset class="red-fieldset mt-4 mb-4">
                    <legend>مراحل ورود و ثبت رزومه و درخواست همکاری </legend>
            </fieldset>
            <div class="clearfix container inner-content">
                    <div class="clearfix left-jobs">
                        <section class="row row1 clearfix">
                                <div id="aparat-ajax" class="loading-back">
                                    <img style="cursor: pointer" class="img-responsive w-100" src="/site/default/img/hr.png" alt="">
                                </div>
    
                                <p class="mt-3 text-right">کار کردن در محیطی که علاوه بر امنیت، شکوفایی و بالندگی را برای شما به همراه داشته باشد،
                                    می‌تواند رویای هر کارمندی در شغل مورد علاقه‌اش باشد. یافتن شغل جدید، تغییری بزرگ در
                                    زندگی شما است.</p>
                        </section>
                        <section class="row2 clearfix">
                            <div class="row mt-3">
                                <div class="col-md-6 order-1 text-right">
                                    <h2><span>1</span> ورود و ثبت نام </h2>
                                    <div class="yellow-line"></div>
                                    <p>میتوانید از از آیکون آدمک بالا سمت چپ سایت برای ورود یا عضویت اقدام کنید. برای عضویت
                                        با وارد کردن مشخصات فردی و شماره همراه خود در کمتر از یک دقیقه فرآیند عضویت شما
                                        انجام می شود . بعد از آن پیامکی جهت تائید به شماره همراه شما ارسال میگردد و با تائید
                                        کد ارسالی عضویت شما در سایت تکمیل میگردد.</p>
                                </div>
                                <div class="col-md-6">
                                    <img src="/site/default/img/hh1.png" alt=" ورود و ثبت نام" title=" ورود و ثبت نام"
                                         class="img-responsive" width="100%">
                                </div>
                            </div>
                        </section>
                        <section class="row3 clearfix">
                            <div class="row mt-3">
                                <div class="col-md-6 text-right">
                                    <h2><span>2</span> تکمیل و ارسال رزومه </h2>
                                    <div class="yellow-line"></div>
                                    <p>بعد از ورود به سایت نام شما در بالا نمایش داده میشود، با کلیک بر روی آن میتوانید وارد
                                        قسمت اطلاعات فردی خود شوید.<br>
                                        <span>رزومه من</span> شامل پنج مرحله می باشد که توجه داشته باشید جهت تکمیل رزومه خود
                                        بهتر است همه این مراحل را بادقت پرکنید. بررسی و ارزیابی کارفرمایان برای شغل درخواستی
                                        شما ، منوط به کامل بودن مشخصات فردی درست و اطلاعات دقیق از جانب شما میباشد. موارد
                                        قسمت ستاره دار الزامی میباشد.
                                        <br>
                                        <span>لیست درخواست ها</span> فرصت های شغلی پذیرفته شده شما می باشد. رزومه شما پس از
                                        درخواست برای شرکت‌های گروه صنعتی گلرنگ ارسال میشود و وضعیتش را از ستون وضعیت درخواست
                                        پیگیری کنید. ستون پیام برای اطلاع رسانی شما، جهت بررسی نواقص رزومه میباشد. به عنوان
                                        مثال چنانچه قسمتی را کامل توضیح نداده باشید کارفرما با پیامی در این قسمت به شما
                                        اطلاع میدهد.
                                        <br>
                                        <span> پیام های من</span> راه ارتباطی شما با سامانه منابع انسانی گروه صنعتی گلرنگ
                                        میباشد. دسته بندی دریافت و ارسال پیام های شما در این قسمت وجود دارد. <br>
                                        <span>لیست علاقه مندی</span> فرصت های شغلی است که شما پسندیده اید را نمایش میدهد.
                                        پسندیدن یک فرصت شغلی به منزله درخواست همکاری از جانب شما نیست. شما با کلیک بر روی
                                        آیکون قلب بدون توجه به رزومه خود میتوانید آن را به این لیست اضافه کنید.
                                        <br>
                                        میزان تکمیل رزومه شما در باکس پایین نمایش داده شده است. تکمیل کردن همه موارد الزامی
                                        و اختیاری رزومه شما معیار ارزیابی شماست. بررسی شایستگیهای عمومی و تخصصی با تکمیل
                                        کامل رزومه خودتان میتواند فرصت های شغلی مرتبط تری به شما پیشنهاد دهد.</p>
                                </div>
                                <div class="col-md-6">
                                    <img src="/site/default/img/hh2.png" alt="تکمیل و ارسال رزومه"
                                         title="تکمیل و ارسال رزومه" class="img-responsive" width="100%">
                                </div>
                            </div>
                        </section>
                        <section class="row4 clearfix">
                            <div class="row mt-3">
                                <div class="col-md-6 order-1 text-right">
                                    <h2><span>3</span> فرصت های شغلی </h2>
                                    <div class="yellow-line"></div>
                                    <p>لیست مشاغل فعال را میتوانید از منو خانواده گلرنگ، قسمت استخدام، موقعیت های شغلی
                                        ببینید. <br>
                                        با استفاده از جستجوی مشاغل به دنبال فرصت‌های شغلی بگردید. با فیلتر کردن نوع همکاری،
                                        تخصص، صنعت و شرکتهای آگهی دهنده. در نتیجه جستجو شامل میتوانید فرصتهای شغلی مناسب تری
                                        بیابید.</p>
                                </div>
                                <div class="col-md-6">
                                    <img src="/site/default/img/hh3.png" alt=" فرصت های شغلی" title=" فرصت های شغلی"
                                         class="img-responsive" width="100%">
                                </div>
                            </div>
                        </section>
                        <section class="row5 clearfix">
                            <div class="row mt-3">
                                <div class="col-md-6 text-right">
                                    <h2><span>4</span>درخواست همکاری </h2>
                                    <div class="yellow-line"></div>
                                    <p>
                                        هر فرصت شغلی صفحه مخصوص به خود را دارد. در این صفحه نیازمندیهای کارفرما که شامل مدرک
                                        تحصیلی، هدف شغلی ، مسئولیتهای اصلی، شایستگی های عمومی و موقعیتهای استانی را مشاهده
                                        کنید. بر اساس این معیارها شغل موردنظر خود را ارزیابی و در صورت رضایتمندی دکمه
                                        درخواست همکاری را انتخاب کنید.<br>
                                        اینکار به منزله پذیرفتن این شغل توسط کارفرما برای شما نیست، شما با این درخواست به
                                        کارفرما اطلاع میدهید که برای موقعیت شغلی مورد نظر آمادگی کامل دارید و رزومه شما جهت
                                        ارزیابی و مصاحبه در اختیار کارفرما قرار میگیرد.
                                    </p>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <img src="/site/default/img/hh4.png" alt="درخواست همکاری " title="درخواست همکاری "
                                         class="img-responsive" width="100%">
                                </div>
                            </div>
                        </section>
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        var aparat_loaded = false;
        $('#aparat-ajax').click(function () {
            if(!aparat_loaded)
            {
                $.get( "{{route('pages.help.video')}}", function( data ) {
                    $('#aparat-ajax').html(data);
                    aparat_loaded = true;
                });
            }
        });
    </script>

@endsection