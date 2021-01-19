<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    */

    'name' => env('APP_NAME', 'HR'),
    'admin_theme' => 'default',
    'site_theme' => 'default',
    'enum_last_degree' => [
        1 => 'دیپلم',
        2 => 'کاردانی',
        3 => 'کارشناسی',
        4 => 'کارشناسی ارشد',
        6 => 'دکترا پیوسته',
        5 => 'دکترا'
    ],
    'enum_shayestegi' => [
        3=>'مزیت محسوب می شود',
        4=>'الزامی است',
    ],
    'enum_degrees' => [
        1=>'دیپلم',
        2=>'کاردانی',
        3=>'کارشناسی',
        4=>'کارشناسی ارشد',
        5=>'دکترا',
        6=>'دکترای پیوسته',
    ],
    'enum_level'=>[
        '1' => 'عالی',
        '2' => 'خوب',
        '3' => 'متوسط',
        '4' => 'ضعیف'
    ],
    'enum_diploma' => [
        128240=>'ریاضی و فیزیک',
        128242=>'علوم انسانی',
        128245=>'فنی و حرفه ای',
        128248=>'هنر',
        128249=>'کار دانش',
        128250=>'علوم تجربی',
    ],
    'enum_diploma_has_tendency' => [
        128245=>'فنی و حرفه ای',
        128249=>'کار دانش'
    ],
    'enum_diploma_not_tendency' => [
        128240=>'ریاضی و فیزیک',
        128242=>'علوم انسانی',
        128248=>'هنر',
        128250=>'علوم تجربی'
    ],
    'enum_institute_structure' => [
	    0=>'فرقی نمی کند',
        1=>'سراسری',
        2=>'آزاد',
        3=>'پیام نور',
        4=>'غیرانتفاعی',
        5=>'علمی-کاربردی',
        6=>'پردیس',
        7=>'خارج از کشور',
        8=>'تربیت معلم',
        9=>'فنی و حرفه ای',
        10=>'کار و دانش',
        11=>'مؤسسات آموزش عالی آزاد',
        12=>'پردیس بین الملل',

    ],
    'enum_course_type'=>[
        1=>'روزانه',
        2=>'شبانه',
        3=>'غیرحضوری/مجازی',
        4=>'نیمه حضوری',
    ],
    'enum_referer' => [
        1 => 'آگهی روزنامه',
        2 => 'تماس اولیه از طرف گلرنگ',
        3 => 'سایت شرکت',
        4 => 'معرفي آشنايان و دوستان',
        5 => 'مراکز کاريابي',
        6 => 'معرفی کارکنان گلرنگ',
        7 => 'سایر',
        8 => 'نمایشگاه کار',
        9 => 'لینکداین',
        10 => 'ایران تلنت'
    ],
    'enum_gender' => [
        1 => 'مرد',
        2 => 'زن',
        3 => 'هر دو'
    ],
    /*
    'enum_exp_needed' =>[
        'بدون نیاز به سابقه کار'=>'بدون نیاز به سابقه کار',
        '1-3 سال سابقه کار مرتبط'=>'1-3 سال سابقه کار مرتبط',
        '3-5 سال سابقه کار مرتبط'=>'3-5 سال سابقه کار مرتبط',
        '5-7 سال سابقه کار مرتبط'=>'5-7 سال سابقه کار مرتبط',
        '7- 10 سال سابقه کار مرتبط'=>'7- 10 سال سابقه کار مرتبط',
        'بیش از 10 سال سابقه کار مرتبط'=>'بیش از 10 سال سابقه کار مرتبط'
    ],
    */
    'enum_exp_needed' =>[
        'بدون نیاز به سابقه کار'=>'بدون نیاز به سابقه کار',
        'حداقل 1 سال'=>'حداقل 1 سال',
        'حداقل 2 سال'=>'حداقل 2 سال',
        'حداقل 3 سال'=>'حداقل 3 سال',
        'حداقل 4 سال'=>'حداقل 4 سال',
        'حداقل 5 سال'=>'حداقل 5 سال',
        'حداقل 6 سال'=>'حداقل 6 سال',
        'حداقل 7 سال'=>'حداقل 7 سال',
        'حداقل 8 سال'=>'حداقل 8 سال',
        'حداقل 9 سال'=>'حداقل 9 سال',
        'حداقل 10 سال'=>'حداقل 10 سال',
        'حداقل 11 سال'=>'حداقل 11 سال',
        'حداقل 12 سال'=>'حداقل 12 سال',
        'حداقل 13 سال'=>'حداقل 13 سال',
        'حداقل 14 سال'=>'حداقل 14 سال',
        'حداقل 15 سال'=>'حداقل 15 سال',
        'حداقل 16 سال'=>'حداقل 16 سال',
        'حداقل 17 سال'=>'حداقل 17 سال',
        'حداقل 18 سال'=>'حداقل 18 سال',
        'حداقل 19 سال'=>'حداقل 19 سال',
        'حداقل 20 سال'=>'حداقل 20 سال'
    ],
    'enum_marital_status' => [
        1 => 'مجرد',
        2 => 'متاهل',
        3 => 'متارکه'
    ],
    'age_range' => [
        '20-25', '25-30', '30-35','35-40','40-90','10-20'
    ],
       'salery_range' => [
        '۱.۵ تا ۲ میلیون تومان',
        '۲ تا ۳ میلیون تومان',
        '۳ تا ۴ میلیون تومان',
        '۴ تا ۵ میلیون تومان',
        '۵ تا ۶ میلیون تومان',
        '۶ تا ۸ میلیون تومان',
        '۸ تا ۱۰ میلیون تومان',
        '۱۰ تا ۱۲ میلیون تومان',
        'بالای ۱۲ میلون تومان',
    ],
    'persian_months' => [
        '01'=>'فروردین',
        '02'=>'اردیبهشت',
        '03'=>'خرداد',
        '04'=>'تیر',
        '05'=>'مرداد',
        '06'=>'شهریور',
        '07'=>'مهر',
        '08'=>'آبان',
        '09'=>'آذر',
        '10'=>'دی',
        '11'=>'بهمن',
        '12'=>'اسفند'
    ],
    'enum_ticket_status'=>[
      'open' => 'باز',
      'answered' => 'پیام ادمین',
      'user_reply' => 'پاسخ کاربر',
      'on_hold' => 'در حال بررسی',
      'in_progress' => 'در حال اقدام',
      'closed' => 'بسته',
    ],
    'enum_family_rel'=>[
        '1' => 'پدر',
        '2' => 'مادر',
        '3' => 'خواهر',
        '4' => 'برادر',
        '5' => 'همسر',
        '6' => 'فرزند',
    ],
    'enum_ticket_status_colors'=>[
        'open' => '#26de81',
        'answered' => '#5cb85c',
        'user_reply' => '#ff8c3f',
        'on_hold' => '#3498db',
        'in_progress' => '#e74c3c',
        'closed' => '#000',
    ],
    'enum_ticket_status_tbl_class'=>[
        'open' => '',
        'answered' => 'label label-success',
        'user_reply' => 'label label-warning',
        'on_hold' => 'label label-info',
        'in_progress' => 'label label-danger',
        'closed' =>'label label-default',
    ],
    'enum_ticket_priority'=>[
        'high' => 'بالا',
        'medium' => 'متوسط',
        'low' => 'کم',
    ],
    'enum_ticket_priority_colors'=>[
        'high' => '#e74c3c',
        'medium' => '#fa8231',
        'low' => '#fed330',
    ],
    'enum_apply_status'=>[
        '0' => 'در انتظار بررسی',
        '1' => 'در حال بررسی',
        '2' => 'تایید شده',
        '3' => 'رد شده',
        '4' => 'رزومه بررسی شد',
        '5' => 'منتظر مصاحبه',
        '6' => 'منتظر نتیجه آزمون',
        '7' => 'منتظر نتیجه ارزیابی',
        '8' => 'منتظر تکمیل اطلاعات',
        '9'=>'در اولویت اول بررسی',
        '10'=>'در اولویت دوم بررسی'
   
    ],
    'chart_back_color'=>[
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(52, 73, 94,0.2)',
        'rgba(241, 196, 15,0.2)',
        'rgba(230, 126, 34,0.2)',
        'rgba(52, 152, 219,0.2)',
        'rgba(149, 165, 166,0.2)',
        'rgba(52, 231, 228,0.2)',
        'rgba(255, 221, 89,0.2)',
    ],

    'chart_border_color'=>[
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(44, 62, 80,1)',
        'rgba(243, 156, 18,1)',
        'rgba(211, 84, 0,1)',
        'rgba(41, 128, 185,1)',
        'rgba(127, 140, 141,1)',
        'rgba(0, 216, 214,1)',
        'rgba(255, 211, 42,1)',
    ],
    
    /*'impersonated_login_old'=>'http://172.31.0.156:9901/api/Account/ImpersonatedLogin',
    'impersonated_login'=>'https://Core-gng.gig.services/api/Account/ImpersonatedLogin',
    'refresh_token_old'=>'http://172.31.0.156:9901/api/Account/RefreshToken',
    'refresh_token'=>'https://Core-gng.gig.services/api/Account/RefreshToken',
    'company_organization_old'=>'http://172.31.0.156:1020/api/OrganizationUnit/LookupAsync',
    'company_organization'=>'https://Gsc-Hr.gig.services/api/OrganizationUnit/LookupAsync',
    'organization_post_old'=>'http://172.31.0.156:1020/api/OrganizationPost/LookupAsync',
    'organization_post'=>'https://Gsc-Hr.gig.services/api/OrganizationPost/LookupAsync',
    'merit_old'=>'http://172.31.0.156:1020/api/OrganizationPostPostMerit/LookupAsync',
    'merit'=>'https://Gsc-Hr.gig.services/api/OrganizationPostPostMerit/LookupAsync',
    'provinces_old'=>'http://172.31.0.156:3310/api/Province/LookupAsync',
    'provinces'=>'https://Gsc-Master.gig.services/api/Province/LookupAsync',
    'cities_old'=>'http://172.31.0.156:3310/api/City/LookupAsync',
    'cities'=>'https://Gsc-Master.gig.services/api/City/LookupAsync',
    'fields_old'=>'http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync',
    'fields'=>'https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync',
    'field_type_old'=>'http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync',
    'field_type'=>'https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync',
    'field_orientation_old'=>'http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync',
    'field_orientation'=>'https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync',
    'institute_type_old'=>'http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync',
    'institute_type'=>'https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync',
    'institute_place_old'=>'http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync',
    'institute_place'=>'https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync',
    'degree_old'=>'http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync',
    'degree'=>'https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync',
    'company_old'=>'http://172.31.0.156:9901/api/gigcompany/LookupAsync',
    'company'=>'https://Core-gng.gig.services/api/gigcompany/LookupAsync',
    'people_applicant_old'=>'http://172.31.0.156:8000/api/Applicant/StartInsertPeopleApplicantAsync',
    'people_applicant'=>'https://gsc-rec.gig.services/api/Applicant/StartInsertPeopleApplicantAsync/',*/
    
    
    'impersonated_login_old'=>'http://172.31.0.156:9901/api/Account/ImpersonatedLogin',
    'impersonated_login'=>'https://Core-gng.gig.services/api/Account/ImpersonatedLogin',
    'refresh_token_old'=>'http://172.31.0.156:9901/api/Account/RefreshToken',
    'refresh_token'=>'https://Core-gng.gig.services/api/Account/RefreshToken',
    'company_organization_old'=>'http://172.31.0.156:1020/api/OrganizationUnit/LookupAsync',
    'company_organization'=>'OrganizationUnit/LookupAsync',
    'organization_post_old'=>'http://172.31.0.156:1020/api/OrganizationPost/LookupAsync',
    'organization_post'=>'OrganizationPost/LookupAsync',
    'merit_old'=>'http://172.31.0.156:1020/api/OrganizationPostPostMerit/LookupAsync',
    'merit'=>'OrganizationPostPostMerit/LookupAsync',
    'provinces_old'=>'http://172.31.0.156:3310/api/Province/LookupAsync',
    'provinces'=>'https://Gsc-Master.gig.services/api/Province/LookupAsync',
    'cities_old'=>'http://172.31.0.156:3310/api/City/LookupAsync',
    'cities'=>'https://Gsc-Master.gig.services/api/City/LookupAsync',
    'fields_old'=>'http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync',
    'fields'=>'https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync',
    'field_type_old'=>'http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync',
    'field_type'=>'https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync',
    'field_orientation_old'=>'http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync',
    'field_orientation'=>'https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync',
    'institute_type_old'=>'http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync',
    'institute_type'=>'https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync',
    'institute_place_old'=>'http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync',
    'institute_place'=>'https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync',
    'degree_old'=>'http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync',
    'degree'=>'https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync',
    'company_old'=>'http://172.31.0.156:9901/api/gigcompany/LookupAsync',
    'company'=>'https://Core-gng.gig.services/api/gigcompany/LookupAsync',
    'people_applicant_old'=>'http://172.31.0.156:8000/api/Applicant/StartInsertPeopleApplicantAsync',
    'people_applicant'=>'Applicant/StartInsertPeopleApplicantAsync/',
    'master_url'=>'PublicItem/GetEnumsAsync',

    
    

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', true),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'https://people.golrang.com'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'Asia/Tehran',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'fa',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'fa',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Settings: "single", "daily", "syslog", "errorlog"
    |
    */

    'log' => env('APP_LOG', 'single'),

    'log_level' => env('APP_LOG_LEVEL', 'debug'),

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */
        Laravel\Tinker\TinkerServiceProvider::class,

        /*
         * Application Service Providers...
         */
        HR\Providers\AppServiceProvider::class,
        HR\Providers\AuthServiceProvider::class,
        // HR\Providers\BroadcastServiceProvider::class,
        HR\Providers\EventServiceProvider::class,
        Unisharp\Laravelfilemanager\LaravelFilemanagerServiceProvider::class,
        HR\Providers\RouteServiceProvider::class,
        Spatie\Permission\PermissionServiceProvider::class,
        Collective\Html\HtmlServiceProvider::class,

        Unisharp\Ckeditor\ServiceProvider::class,

        Intervention\Image\ImageServiceProvider::class,
        Snowfire\Beautymail\BeautymailServiceProvider::class,
        Cviebrock\EloquentSluggable\ServiceProvider::class,
        Greggilbert\Recaptcha\RecaptchaServiceProvider::class,
        LaravelCaptcha\Providers\LaravelCaptchaServiceProvider::class,
        Barryvdh\DomPDF\ServiceProvider::class,
        HR\Providers\myValidators::class,
        Kendu\Mpdf\ServiceProvider::class,
        Barryvdh\Snappy\ServiceProvider::class,
        Pbmedia\LaravelFFMpeg\FFMpegServiceProvider::class,
        Intervention\Image\ImageServiceProvider::class,
        Barryvdh\Debugbar\ServiceProvider::class,
        Way\Generators\GeneratorsServiceProvider::class,
        Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'Form' => Collective\Html\FormFacade::class,
        'Html' => Collective\Html\HtmlFacade::class,
        'Image' => Intervention\Image\Facades\Image::class,
        'JDate' => p3ym4n\JDate\JDate::class,
        'Carbon' => Carbon\Carbon::class,
        'Recaptcha' => Greggilbert\Recaptcha\Facades\Recaptcha::class,
        'PDF' => Barryvdh\Snappy\Facades\SnappyPdf::class,
        'SnappyImage' => Barryvdh\Snappy\Facades\SnappyImage::class,
        'myFuncs' => HR\myFuncs::class,
        'FFMpeg' => Pbmedia\LaravelFFMpeg\FFMpegFacade::class,
        'Debugbar' => Barryvdh\Debugbar\Facade::class,
        'HTMLMin' => HTMLMin\HTMLMin\Facades\HTMLMin::class,
        'curlfunc' => HR\CurlFuncs::class,
        'CurlImpersonated' => HR\CurlImpersonated::class,
    ],

];
