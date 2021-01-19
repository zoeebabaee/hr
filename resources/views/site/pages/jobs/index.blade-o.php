@php
    if ($_POST) {
   header("Location: " . $_SERVER['REQUEST_URI']);
   exit();
}
@endphp

@extends('layout.site.default.global.main')
@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Golrang Human Resource">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Golrang System">
@endsection

@section('title')
    سامانه منابع انسانی گروه صنعتی گلرنگ :: لیست مشاغل
@endsection

@section('content')

    <style>
        .preloader_back {
            display: block;
            background: #FFF;
            opacity: 0.7;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 8888;
        }

        .preloader_all {
            display: block;
            background: transparent;
            height: 100%;
            position: fixed;
            top: 5%;
            left: 10%;
            width: 100%;
            z-index: 999999;
        }

        #cssload-pgloading {

        }

        #cssload-pgloading:after {
            content: "";
            z-index: -1;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        #cssload-pgloading .cssload-loadingwrap {
            position: absolute;
            top: 45%;
            bottom: 45%;
            left: 25%;
            right: 25%;
        }

        #cssload-pgloading .cssload-bokeh {
            font-size: 97px;
            width: 1em;
            height: 1em;
            position: relative;
            margin: 0 auto;
            list-style: none;
            padding: 0;
            border-radius: 50%;
            -o-border-radius: 50%;
            -ms-border-radius: 50%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
        }

        #cssload-pgloading .cssload-bokeh li {
            position: absolute;
            width: .2em;
            height: .2em;
            border-radius: 50%;
            -o-border-radius: 50%;
            -ms-border-radius: 50%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
        }

        #cssload-pgloading .cssload-bokeh li:nth-child(1) {
            left: 50%;
            top: 0;
            margin: 0 0 0 -.1em;
            background: rgb(0, 193, 118);
            transform-origin: 50% 250%;
            -o-transform-origin: 50% 250%;
            -ms-transform-origin: 50% 250%;
            -webkit-transform-origin: 50% 250%;
            -moz-transform-origin: 50% 250%;
            animation: cssload-rota 1.3s linear infinite,
            cssload-opa 4.22s ease-in-out infinite alternate;
            -o-animation: cssload-rota 1.3s linear infinite,
            cssload-opa 4.22s ease-in-out infinite alternate;
            -ms-animation: cssload-rota 1.3s linear infinite,
            cssload-opa 4.22s ease-in-out infinite alternate;
            -webkit-animation: cssload-rota 1.3s linear infinite,
            cssload-opa 4.22s ease-in-out infinite alternate;
            -moz-animation: cssload-rota 1.3s linear infinite,
            cssload-opa 4.22s ease-in-out infinite alternate;
        }

        #cssload-pgloading .cssload-bokeh li:nth-child(2) {
            top: 10%;
            right: 0;
            margin: -.1em 0 0 0;
            background: rgb(255, 0, 60);
            transform-origin: -150% 50%;
            -o-transform-origin: -150% 50%;
            -ms-transform-origin: -150% 50%;
            -webkit-transform-origin: -150% 50%;
            -moz-transform-origin: -150% 50%;
            animation: cssload-rota 2.14s linear infinite,
            cssload-opa 4.93s ease-in-out infinite alternate;
            -o-animation: cssload-rota 2.14s linear infinite,
            cssload-opa 4.93s ease-in-out infinite alternate;
            -ms-animation: cssload-rota 2.14s linear infinite,
            cssload-opa 4.93s ease-in-out infinite alternate;
            -webkit-animation: cssload-rota 2.14s linear infinite,
            cssload-opa 4.93s ease-in-out infinite alternate;
            -moz-animation: cssload-rota 2.14s linear infinite,
            cssload-opa 4.93s ease-in-out infinite alternate;
        }

        #cssload-pgloading .cssload-bokeh li:nth-child(3) {
            left: 10%;
            bottom: 0;
            margin: 0 0 0 -.1em;
            background: rgb(250, 190, 40);
            transform-origin: 50% -150%;
            -o-transform-origin: 50% -150%;
            -ms-transform-origin: 50% -150%;
            -webkit-transform-origin: 50% -150%;
            -moz-transform-origin: 50% -150%;
            animation: cssload-rota 1.67s linear infinite,
            cssload-opa 5.89s ease-in-out infinite alternate;
            -o-animation: cssload-rota 1.67s linear infinite,
            cssload-opa 5.89s ease-in-out infinite alternate;
            -ms-animation: cssload-rota 1.67s linear infinite,
            cssload-opa 5.89s ease-in-out infinite alternate;
            -webkit-animation: cssload-rota 1.67s linear infinite,
            cssload-opa 5.89s ease-in-out infinite alternate;
            -moz-animation: cssload-rota 1.67s linear infinite,
            cssload-opa 5.89s ease-in-out infinite alternate;
        }

        #cssload-pgloading .cssload-bokeh li:nth-child(4) {
            top: 10%;
            left: 0;
            margin: -.1em 0 0 0;
            background: rgb(136, 193, 0);
            transform-origin: 250% 50%;
            -o-transform-origin: 250% 50%;
            -ms-transform-origin: 250% 50%;
            -webkit-transform-origin: 250% 50%;
            -moz-transform-origin: 250% 50%;
            animation: cssload-rota 1.98s linear infinite,
            cssload-opa 6.04s ease-in-out infinite alternate;
            -o-animation: cssload-rota 1.98s linear infinite,
            cssload-opa 6.04s ease-in-out infinite alternate;
            -ms-animation: cssload-rota 1.98s linear infinite,
            cssload-opa 6.04s ease-in-out infinite alternate;
            -webkit-animation: cssload-rota 1.98s linear infinite,
            cssload-opa 6.04s ease-in-out infinite alternate;
            -moz-animation: cssload-rota 1.98s linear infinite,
            cssload-opa 6.04s ease-in-out infinite alternate;
        }

        @keyframes cssload-rota {
            from {
            }
            to {
                transform: rotate(360deg);
            }
        }

        @-o-keyframes cssload-rota {
            from {
            }
            to {
                -o-transform: rotate(360deg);
            }
        }

        @-ms-keyframes cssload-rota {
            from {
            }
            to {
                -ms-transform: rotate(360deg);
            }
        }

        @-webkit-keyframes cssload-rota {
            from {
            }
            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @-moz-keyframes cssload-rota {
            from {
            }
            to {
                -moz-transform: rotate(360deg);
            }
        }

        @keyframes cssload-opa {
            0% {
            }
            12.0% {
                opacity: 0.80;
            }
            19.5% {
                opacity: 0.88;
            }
            37.2% {
                opacity: 0.64;
            }
            40.5% {
                opacity: 0.52;
            }
            52.7% {
                opacity: 0.69;
            }
            60.2% {
                opacity: 0.60;
            }
            66.6% {
                opacity: 0.52;
            }
            70.0% {
                opacity: 0.63;
            }
            79.9% {
                opacity: 0.60;
            }
            84.2% {
                opacity: 0.75;
            }
            91.0% {
                opacity: 0.87;
            }
        }

        @-o-keyframes cssload-opa {
            0% {
            }
            12.0% {
                opacity: 0.80;
            }
            19.5% {
                opacity: 0.88;
            }
            37.2% {
                opacity: 0.64;
            }
            40.5% {
                opacity: 0.52;
            }
            52.7% {
                opacity: 0.69;
            }
            60.2% {
                opacity: 0.60;
            }
            66.6% {
                opacity: 0.52;
            }
            70.0% {
                opacity: 0.63;
            }
            79.9% {
                opacity: 0.60;
            }
            84.2% {
                opacity: 0.75;
            }
            91.0% {
                opacity: 0.87;
            }
        }

        @-ms-keyframes cssload-opa {
            0% {
            }
            12.0% {
                opacity: 0.80;
            }
            19.5% {
                opacity: 0.88;
            }
            37.2% {
                opacity: 0.64;
            }
            40.5% {
                opacity: 0.52;
            }
            52.7% {
                opacity: 0.69;
            }
            60.2% {
                opacity: 0.60;
            }
            66.6% {
                opacity: 0.52;
            }
            70.0% {
                opacity: 0.63;
            }
            79.9% {
                opacity: 0.60;
            }
            84.2% {
                opacity: 0.75;
            }
            91.0% {
                opacity: 0.87;
            }
        }

        @-webkit-keyframes cssload-opa {
            0% {
            }
            12.0% {
                opacity: 0.80;
            }
            19.5% {
                opacity: 0.88;
            }
            37.2% {
                opacity: 0.64;
            }
            40.5% {
                opacity: 0.52;
            }
            52.7% {
                opacity: 0.69;
            }
            60.2% {
                opacity: 0.60;
            }
            66.6% {
                opacity: 0.52;
            }
            70.0% {
                opacity: 0.63;
            }
            79.9% {
                opacity: 0.60;
            }
            84.2% {
                opacity: 0.75;
            }
            91.0% {
                opacity: 0.87;
            }
        }

        @-moz-keyframes cssload-opa {
            0% {
            }
            12.0% {
                opacity: 0.80;
            }
            19.5% {
                opacity: 0.88;
            }
            37.2% {
                opacity: 0.64;
            }
            40.5% {
                opacity: 0.52;
            }
            52.7% {
                opacity: 0.69;
            }
            60.2% {
                opacity: 0.60;
            }
            66.6% {
                opacity: 0.52;
            }
            70.0% {
                opacity: 0.63;
            }
            79.9% {
                opacity: 0.60;
            }
            84.2% {
                opacity: 0.75;
            }
            91.0% {
                opacity: 0.87;
            }
        }
    </style>


    <div class="cd-main-content cd-inner-content">
        <!-- <div class="col-xs-12 wrapper-breadcrumb">
            <div class="p-breadcrumbs">
                <ul class="page-breadcrumbs">
                    <li>
                        <a href="{{route('home')}}">صفحه اصلی</a>
                    </li>
                    <li><i class="fa fa-angle-left"></i></li>
                    <li class="c-state_active">
                        فرصت های شغلی
                    </li>
                </ul>
            </div>
        </div>  -->

        <div class="clearfix container inner-content">

            <div class="col-xs-12 top-searchjob">
                <div class="pull-right">تعداد <span>{{$job_count}}</span> شغل یافت شد.</div>
                <div class="pull-left">
                    جدیدترین
                    <label class="switch">
                        @if(isset($_GET['sortby']))
                            <input type="checkbox" {{($_GET['sortby']=="newest"?' checked ':'')}} id="sortby"
                                   name="sortby">
                        @else
                            <input type="checkbox" checked id="sortby" name="sortby">
                        @endif
                        <span class="slider round"></span>
                    </label>
                    پربازدیدترین
                </div>
            </div>

            <div class="col-xs-12 wrap-content">
                <div class="col-md-9 col-sm-12 col-xs-12 left-jobs no-padd-xs no-padd-r" style="position:relative;">

                    <div class="preloader_back hidden-sm hidden-xs" style="position:absolute;"></div>
                    <div class="preloader_all hidden-sm hidden-xs" style="position:fixed;">
                        <div id="cssload-pgloading">
                            <div class="cssload-loadingwrap">
                                <ul class="cssload-bokeh">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="custom-search-input">

                        {{ Form::open(array('method'=>'GET' , 'id'=>'search_form','onsubmit'=>'if(document.getElementById("s_query").value==""){return false;}') ) }}
                        <div class="input-group col-md-12">

                            <input type="text" class="form-control input-lg" name="s" id="s_query"
                                   value="{{(old('s')==""?(isset($_GET['s'])?$_GET['s']:''):old('s'))}}"
                                   placeholder="جستجو..." id="textinput"/>
                            <span class="input-group-btn">
                                    <button class="btn btn-info btn-lg" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>

                        </div>
                        {{Form::close()}}
                    </div>
                    <div class="clearfix top-filter">

                        @php
                            $gets=urldecode(parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY));
                            $gets_array=explode('&',$gets);
                            $gets_array=array_filter($gets_array);// remove empty elements
                            foreach($gets_array as $get){
                                $get_arr=explode('=',$get);
                                if(isset($get_arr[1]) && !empty($get_arr[1])){

                                        $my_get=$get_arr[0].'='.$get_arr[1];
                                        $url=str_replace($my_get,'',$gets);
                                        if($get_arr[1]=='list') continue;
                                        if($get_arr[1]=='grid') continue;
                                        if($get_arr[0]=='page') continue;
                                        if($get_arr[1]=='1') $get_arr[1]='مرد';
                                        if($get_arr[1]=='2')  $get_arr[1]='زن';
                                        if($get_arr[1]=='newest') $get_arr[1]='جدیدترین ها';
                                        if($get_arr[1]=='most-visited') $get_arr[1]='پربازدیدترین ها';
                                        if($get_arr[1] != 'جدیدترین ها' && $get_arr[1] != 'پربازدیدترین ها')
                                            echo '<a href="'.route('site.jobs.index').'?'.$url.'" class="show-loading">'.$get_arr[1].' <i class="fa fa-remove pointer-hand"></i></a>';
                                }

                            }
                        @endphp

                        @if(count($gets_array)>0)

                            <a href="{{route('site.jobs.index')}}" class="all-links show-loading">پاک کردن همه</a>
                        @endif

                        <div class="pull-left">
                            @php
                                $gets=str_replace('v=list','',$gets);
                                $gets=str_replace('v=grid','',$gets);
                                $gets=str_replace('&&','',$gets);
                            @endphp

                            <a href="{{route('site.jobs.index','v=list&'.$gets)}}" class="show-loading"><img
                                        src="/site/default/img/hr_list.png" alt=""></a>


                            <a href="{{route('site.jobs.index','v=grid&'.$gets)}}" class="show-loading"><img
                                        src="/site/default/img/hr_grid.png" alt=""></a>

                        </div>
                    </div>

                    @if(request('v')=='list')

                        @foreach($jobs as $job)


                            <div class="clearfix row-searchjob @if($job->status ==3) hired @endif" >


                                <div class="fr-div">
                                    <a @if($job->status ==3)  title="استخدام شد" @else href="{{route('jobs.show',$job->alias)}}" @endif>

                                        <img
                                                src="{{$job->company->get_gig_data()['logo']}}"
                                                alt="{{$job->title}}:{{$job->company->name}}">

                                    </a>
                                    @if($job->status ==3)
                                        <div>
                                            <a class="save-request"><i class="fa fa-check"></i>&nbsp;استخدام شد</a>
                                        </div>
                                    @elseif(Auth::check())
                                        @if($job->apply(Auth::user()->id))
                                            <a href="{{route('jobs.show',$job->alias)}}" class="request-jobs"><i
                                                        class="fa fa-arrow-left"></i> مشاهده</a>
                                        @else
                                            <div>
                                                <a class="save-request"><i class="fa fa-check"></i>&nbsp;ثبت شد</a>
                                            </div>
                                        @endif
                                    @else
                                        <a href="{{route('jobs.show',$job->alias)}}" class="request-jobs"><i
                                                    class="fa fa-arrow-left"></i> مشاهده</a>
                                    @endif
                                </div>
                                <div class="fl-div">
                                    <div class="pull-left">
                                        <a
                                                class="grid-time color{{$job->cooperation_type}}-timejob">
                                            {{$job->cooperation_type_name()}}
                                        </a>
                                        @if(Auth::check())
                                            <a href="javascript:void(0);" onclick="ajax_fav({{$job->id}});">

                                                <img
                                                        src="/site/default/img/{{(in_array(Auth::user()->id,$job->users()->pluck('user_id')->toArray())?'hr_like.png':'hr_dislike.png')}}"
                                                        id="fav_img_{{$job->id}}" alt="favorite">


                                            </a>
                                        @else
                                            <a href="javascript:void(0);"
                                               onclick="alert('برای افزودن به لیست علاقمندی ها ابتدا باید عضو و سپس وارد شوید')">

                                                <img
                                                        src="/site/default/img/hr_dislike.png" id="fav_img_{{$job->id}}"
                                                        alt="favorite">

                                            </a>
                                        @endif

                                    </div>
                                    <a @if($job->status == 3)  title="استخدام شد" @else href="{{route('jobs.show',$job->alias)}}" @endif ><h2>{{$job->title}}</h2></a>
                                    <h4>{{$job->company->name}}</h4>
                                    <h6><i class="fa fa-map-marker"></i>&nbsp;
                                        {{$provincesNames[$job->id]}}
                                    </h6>
                                    <div class="clearfix visible-xs"></div>
                                    <p>

                                    </p>

                                </div>
                            </div>

                        @endforeach

                    @endif
                    
                    
                    
                    
                    
                    @if(request('v')=='grid' || request('v')=="")
                        <div class="row">
                            @foreach($jobs as $job)

                                <div class="col-md-4 col-sm-4 col-ms-6 col-xs-12 @if($job->status ==3) hired @endif">
                                    <div class="clearfix grid-searchjob">
                                        <a @if($job->status == 3)  title="استخدام شد" @else href="{{route('jobs.show',$job->alias)}}" @endif
                                            class="grid-img">
                                            <img src="{{$job->company->get_gig_data()['logo']}}" alt="">
                                        </a>
                                        <div class="clearfix wrapper-grid">
                                            @if(Auth::check())
                                                <a href="javascript:void(0);" class="grid-like"
                                                   onclick="ajax_fav({{$job->id}});">

                                                    <img
                                                            src="/site/default/img/{{(in_array(Auth::user()->id,$job->users()->pluck('user_id')->toArray())?'hr_like.png':'hr_dislike.png')}}"
                                                            id="fav_img_{{$job->id}}" alt="favorite">

                                                </a>
                                            @else
                                                <a href="javascript:void(0);" class="grid-like" data-toggle="modal"
                                                   data-target="#WarningModal">

                                                    <img
                                                            src="/site/default/img/hr_dislike.png"
                                                            id="fav_img_{{$job->id}}" alt="favorite">

                                                </a>
                                            @endif
                                                <a @if($job->status == 3)  title="استخدام شد" @else href="{{route('jobs.show',$job->alias)}}" @endif ><h2>{{$job->title}}</h2></a>
                                            <h4>{{$job->company->name}}</h4>
                                            <h4>{{$job->cooperation_type_name()}}</h4>


                                            <div class="clearfix wrap-grid-btn">
                                                <h6><i class="fa fa-map-marker"></i> {{$provincesNames[$job->id]}} </h6>
                                                @if($job->status ==3)
                                                    <div>
                                                        <a class="save-request"><i class="fa fa-check"></i>&nbsp;استخدام شد</a>
                                                    </div>
                                                @elseif(Auth::check())
                                                    @if($job->apply(Auth::user()->id))
                                                        <a  href="{{route('jobs.show',$job->alias)}}"
                                                           class="request-jobs"><i
                                                                    class="fa fa-arrow-left"></i> مشاهده</a>
                                                    @else
                                                        <div style="float: left">
                                                            <a class="save-request"><i class="fa fa-check"></i>&nbsp;ثبت
                                                                شد </a>
                                                        </div>
                                                    @endif
                                                @else
                                                    <a  href="{{route('jobs.show',$job->alias)}}"  class="request-jobs"><i
                                                                class="fa fa-arrow-left"></i> مشاهده</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>

                    @endif

                    <div class="text-center">

                        <ul class="pagination" style="direction: ltr !important;">
                            {!! $jobs->appends(\Illuminate\Support\Facades\Input::except('page'))->links() !!}
                        </ul>

                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12 no-padd-l no-padd-xs">
                    <div>
                        <div class="panel-heading leftsidebar">
                            <h4 class="panel-title">
                                استان
                            </h4>
                        </div>
                        <div class="panel-body skin-section">
                            <ul class="list">
                                @php
                                    $colors=["red","orange","yellow","blue","darkblue","green"];
                                    $c=0;
                                    $i=0;
                                @endphp
                                @foreach ( array_slice($all_filters['province'], 0, 6) as $title => $count )
                                    <li>
                                        <input
                                                @if(!is_null(request('province')))
                                                {{(in_array($title,request('province'))?' checked ':'')}}
                                                @endif
                                                type="checkbox" value="{{$i}}"
                                                data-filter_name="province[]={{$title}}"
                                                class="input-sidebar"
                                                id="province{{$title.time()}}"
                                        >
                                        <label for="province{{$title.time()}}">{{$title}}</label>
                                        <span>({{intval($count)}})</span>
                                    </li>
                                @endforeach

                            </ul>
                            @if(count($all_filters['province'])>6)
                                <a href="javascript:void(0);" class="more" data-toggle="modal"
                                   data-target="#province-modal"
                                   data-original-title=""><i class="fa fa-plus"></i> بیشتر</a>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="panel-heading leftsidebar">
                            <h4 class="panel-title">
                                نوع همکاری
                            </h4>
                        </div>
                        <div class="panel-body skin-section">

                            <ul class="list">

                                @foreach ( array_slice($all_filters['cooperation_type'], 0, 10) as $title => $count )
                                    <li>
                                        <input
                                                @if(!is_null(request('cooperation_type')))
                                                {{(in_array($title,request('cooperation_type'))?' checked ':'')}}
                                                @endif
                                                type="checkbox"
                                                data-filter_name="cooperation_type[]={{$title}}"
                                                class="input-sidebar  {{HR\Job::cooperation_type_class($title)}}"
                                                id="cooperation_type{{$title}}"
                                        >
                                        <label for="cooperation_type{{$title}}">{{$title}}</label>

                                        <span>({{intval($count)}})</span>

                                    </li>

                                @endforeach

                            </ul>
                        </div>
                    </div>

                    <div>
                        <div class="panel-heading leftsidebar">
                            <h4 class="panel-title">
                                تخصص
                            </h4>
                        </div>
                        <div class="panel-body skin-section">
                            <ul class="list">
                                @foreach ( array_slice($all_filters['department'], 0, 6) as $title => $count )
                                    <li>
                                        <input type="checkbox"
                                               @if(!is_null(request('department')))
                                               {{(in_array($title,request('department'))?' checked ':'')}}
                                               @endif
                                               data-filter_name="department[]={{$title}}"
                                               class="input-sidebar"
                                               id="department{{$title}}"
                                        >
                                        <label for="department{{$title}}">{{$title}}</label>
                                        <span>({{ intval($count) }})</span>
                                    </li>
                                @endforeach
                            </ul>
                            @if(count($all_filters['department'])>6)
                                <a href="javascript:void(0);" class="more" data-toggle="modal"
                                   data-target="#skills-modal"
                                   data-original-title=""><i class="fa fa-plus"></i> بیشتر</a>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="panel-heading leftsidebar">
                            <h4 class="panel-title">
                                صنعت
                            </h4>
                        </div>
                        <div class="panel-body skin-section">
                            <ul class="list">
                                @foreach ( array_slice($all_filters['industry'], 0, 6) as $title => $count )
                                    <li>
                                        <input
                                                @if(!is_null(request('industry')))
                                                {{(in_array($title,request('industry'))?' checked ':'')}}
                                                @endif
                                                type="checkbox" data-filter_name="industry[]={{$title}}"
                                                class="input-sidebar"
                                                id="industry{{$title}}"
                                        >
                                        <label for="industry{{$title}}">{{$title}}</label>

                                        <span>({{intval($count)}})</span>

                                    </li>
                                @endforeach
                            </ul>
                            @if(count($all_filters['industry'])>6)
                                <a href="javascript:void(0);" class="more" data-toggle="modal"
                                   data-target="#industry-modal"
                                   data-original-title=""><i class="fa fa-plus"></i> بیشتر</a>
                            @endif
                        </div>
                    </div>
                    <div class="panel-group" id="accordion">
                        <div class="clearfix panel panel-default">
                            <div class="panel-heading leftsidebar">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseOne">
                                        جنسیت
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body skin-section">

                                    <ul class="list">
                                        @foreach ($all_filters['gender'] as $title => $count )
                                            @php
                                                $gender_title='';
                                                if($title=='1') $gender_title='مرد';
                                                if($title=='2') $gender_title='زن';
                                            @endphp
                                            <li>
                                                <input
                                                        @if(!is_null(request('gender')))
                                                        {{(in_array($title,request('gender'))?' checked ':'')}}
                                                        @endif
                                                        type="checkbox" data-filter_name="gender[]={{$title}}"
                                                        {{(!is_null(request('gender')) && in_array($title,request('gender'))?' checked ':'')}} class="input-sidebar"
                                                        id="gender{{$title}}"
                                                >
                                                <label for="gender{{$title}}">{{$gender_title}}</label>

                                                <span>({{intval($count)}})</span>

                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix panel panel-default">
                            <div class="panel-heading leftsidebar">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseTwo">
                                        شرکت ها
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body skin-section">
                                    <ul class="list">
                                        @foreach ( array_slice($all_filters['company'], 0, 6) as $title => $count )
                                            <li>
                                                <input
                                                        @if(!is_null(request('company')))
                                                        {{(in_array($title,request('company'))?' checked ':'')}}
                                                        @endif
                                                        type="checkbox"
                                                        data-filter_name="company[]={{$title}}"
                                                        class="input-sidebar" id="company{{$title}}">
                                                <label for="company{{$title}}">{{$title}}</label>

                                                <span>({{ intval($count) }})</span>

                                            </li>
                                        @endforeach
                                    </ul>
                                    @if(count($all_filters['company'])>6)
                                        <a href="javascript:void(0);" class="more" data-toggle="modal"
                                           data-target="#company-modal"
                                           data-original-title=""><i class="fa fa-plus"></i> بیشتر</a>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>

        <!--model more-->
        <div class="modal fade" id="province-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="clearfix modal-body">
                        <h4 class="modal-title">استان</h4>
                        <div class="skin-section half-width">
                            <ul class="list">
                                @foreach ( array_slice($all_filters['province'],6,count($all_filters['province'])) as $title => $count )
                                    <li>
                                        <input
                                                @if(!is_null(request('province')))
                                                {{(in_array($title,request('province'))?' checked ':'')}}
                                                @endif
                                                data-filter_name="province[]={{$title}}"
                                                type="checkbox" value="{{$i}}" class="input-sidebar">
                                        <label for="minimal-checkbox-1">{{$title}}</label>

                                        <span>({{intval($count)}})</span>

                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--model more-->
        <div class="modal fade" id="skills-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="clearfix modal-body">
                        <h4 class="modal-title">تخصص</h4>
                        <div class="skin-section half-width">
                            <ul class="list">
                                @foreach ( array_slice($all_filters['department'],6,count($all_filters['department'])) as $title => $count )
                                    <li>
                                        <input
                                                @if(!is_null((request('department'))))
                                                {{(in_array($title,request('department'))?' checked ':'')}}
                                                @endif
                                                type="checkbox" data-filter_name="department[]={{$title}}"
                                                value="{{$i}}" class="input-sidebar">
                                        <span for="">{{$title}}</span>

                                        <span>({{intval($count)}})</span>

                                    </li>
                                @endforeach
                            </ul>
                            {{--<button type="button" class="save">ثبت</button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--model more-->
        <div class="modal fade" id="industry-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="clearfix modal-body">
                        <h4 class="modal-title">صنعت</h4>
                        <div class="skin-section half-width">
                            <ul class="list">
                                @foreach ( array_slice($all_filters['industry'],6,count($all_filters['industry'])) as $title => $count )
                                    <li>
                                        <input
                                                @if(!is_null(request('industry')))
                                                {{(in_array($title,request('industry'))?' checked ':'')}}
                                                @endif
                                                type="checkbox" data-filter_name="industry[]={{$title}}"
                                                value="{{$i}}" class="input-sidebar">
                                        <span for="">{{$title}}</span>

                                        <span>({{intval($count)}})</span>

                                    </li>
                                @endforeach
                            </ul>
                            {{--<button type="button" class="save">ثبت</button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--model more-->
        <div class="modal fade" id="company-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="clearfix modal-body">
                        <h4 class="modal-title">شرکت</h4>
                        <div class="skin-section half-width">
                            <ul class="list">
                                @foreach ( array_slice($all_filters['company'],6,count($all_filters['company'])) as $title => $count )
                                    <li>
                                        <input
                                                @if(!is_null(request('company')))
                                                {{(in_array($title,request('company'))?' checked ':'')}}
                                                @endif
                                                type="checkbox" data-filter_name="company[]={{$title}}"
                                                value="{{$i}}" class="input-sidebar">
                                        <span for="">{{$title}}</span>

                                        <span>({{intval($count)}})</span>

                                    </li>
                                @endforeach
                            </ul>
                            {{--<button type="button" class="save">ثبت</button>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="WarningModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body" style="text-align: center;direction:rtl;border:0;">
                        <h4 class="modal-title"><i class="fa fa-warning" style="color:#FF6D6E;"></i> توجه</h4>
                        <p>

                            برای افزودن به لیست علاقمندی های خود، باید ثبت نام و سپس وارد شوید.</p>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        @endsection

        @section('script')
            {{ Html::script('/admin/'.config('app.admin_theme').'/js/jquery.autocomplete.js') }}
            <script>
                if ($('#textinput')) {

                    $('#textinput').autocomplete({
                        serviceUrl: '{{route('site.jobs.search.by.tags')}}',
                        onSelect: function (suggestion) {
                            this.val = suggestion.value;
                        }
                    });
                }
                @php
                    $gets=urldecode(parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY));

                    $current_url=null;


                @endphp
                $(document).ready(function () {

                    $('#sortby').on("click", function () {

                        var sortby_status = $('#sortby:checked').length > 0;
                        var form = document.createElement('form');
                        form.method = 'GET';
                        //form.action='{{route('site.jobs.index')}}?{!! $current_url !!}';
                        if (sortby_status) {
                                    @php
                                        if(!empty($gets) && $gets!='grid'){

                                            $c=0;
                                                $gets_array=explode('&',$gets);
                                                 if(is_array($gets_array)){
                                                    foreach($gets_array as $get){
                                                        $get_arr=explode('=',$get);
                                                        $c++;
                                                        if(isset($get_arr[0]) && isset($get_arr[1])){
                                                            echo "
                                                            var input_filter_".$c." = document.createElement('input');
                                                            input_filter_".$c.".type = 'hidden';
                                                            input_filter_".$c.".name = '".$get_arr[0]."';
                                                            input_filter_".$c.".value = '".$get_arr[1]."';
                                                            form.appendChild(input_filter_".$c.");
                                                            ";
                                                        }
                                                    }
                                                }
                                        }
                                    @endphp

                            var input_filter = document.createElement('input');
                            input_filter.type = 'text';
                            input_filter.name = 'sortby';
                            input_filter.value = 'newest';
                            form.appendChild(input_filter);
                            document.body.appendChild(form);
                            showLoading();
                            form.submit();

                        } else {

                                    @php
                                        if(!empty($gets) && $gets!='grid'){
                                            $c=0;
                                                $gets_array=explode('&',$gets);
                                                if(is_array($gets_array)){
                                                    foreach($gets_array as $get){
                                                        $get_arr=explode('=',$get);
                                                        $c++;
                                                        if(isset($get_arr[0]) && isset($get_arr[1])){
                                                            echo "
                                                            var input_filter_".$c." = document.createElement('input');
                                                            input_filter_".$c.".type = 'hidden';
                                                            input_filter_".$c.".name = '".$get_arr[0]."';
                                                            input_filter_".$c.".value = '".$get_arr[1]."';
                                                            form.appendChild(input_filter_".$c.");
                                                            ";
                                                        }
                                                    }
                                                }
                                    }
                                    @endphp

                            var input_filter = document.createElement('input');
                            input_filter.type = 'text';
                            input_filter.name = 'sortby';
                            input_filter.value = 'most-visited';
                            form.appendChild(input_filter);
                            document.body.appendChild(form);
                            showLoading();
                            form.submit();
                        }
                    });

                    $('.input-sidebar,.icheck-red').iCheck({
                        checkboxClass: 'icheckbox_flat-red',
                        radioClass: 'iradio_flat-red'
                    });
                    $('.icheck-yellow').iCheck({
                        checkboxClass: 'icheckbox_flat-yellow',
                        radioClass: 'iradio_flat-yellow'
                    });
                    $('.icheck-grey').iCheck({
                        checkboxClass: 'icheckbox_flat-grey',
                        radioClass: 'iradio_flat-grey'
                    });
                    $('.icheck-purple').iCheck({
                        checkboxClass: 'icheckbox_flat-purple',
                        radioClass: 'iradio_flat-purple'
                    });
                    $('.icheck-green').iCheck({
                        checkboxClass: 'icheckbox_flat-green',
                        radioClass: 'iradio_flat-green'
                    });
                    $('.icheck-pink').iCheck({
                        checkboxClass: 'icheckbox_flat-pink',
                        radioClass: 'iradio_flat-pink'
                    });
                    $('.icheck-orange').iCheck({
                        checkboxClass: 'icheckbox_flat-orange',
                        radioClass: 'iradio_flat-orange'
                    });

                    $('.input-sidebar,.icheck-red,.icheck-yellow,.icheck-grey,.icheck-purple,.icheck-green,.icheck-pink,.icheck-orange').on("ifChecked", function () {

                        var __selected = [];
                        $('.input-sidebar:checkbox:checked').each(function () {
                            if ($(this).data('filter_name') != "") {
                                __selected.push($(this).data('filter_name'));
                            }
                        });
                        __selected = jQuery.unique(__selected);

                        __selected = __selected.join('&');
                        //alert(__selected);
                        //return false;
                        var form = document.createElement('form');
                        form.method = 'POST';

                        @if(isset($_GET['s']))
                            form.action = '{{route("site.jobs.index")}}?s={!!  $_GET['s']!!}&' + __selected;
                        @if(isset($_GET['sortby']))
                            form.action = form.action + '&sortby={!! $_GET['sortby'] !!}';
                        @endif
                                @else
                            form.action = '{{route("site.jobs.index")}}?' + __selected;
                        @if(isset($_GET['sortby']))
                            form.action = form.action + '&sortby={!! $_GET['sortby'] !!}';
                                @endif
                                @endif

                        var input_filter = document.createElement('input');
                        input_filter.type = 'hidden';
                        input_filter.name = 'filter';
                        input_filter.value = __selected;

                        var input_token = document.createElement('input');
                        input_token.type = 'hidden';
                        input_token.name = '_token';
                        input_token.value = '{{csrf_token()}}';
                        form.appendChild(input_filter);
                        form.appendChild(input_token);
                        document.body.appendChild(form);
                        showLoading();
                        form.submit();

                        return false;

                    });
                    $('.input-sidebar,.icheck-red,.icheck-yellow,.icheck-grey,.icheck-purple,.icheck-green,.icheck-pink,.icheck-orange').on("ifUnchecked", function () {

                        var __selected = [];
                        $('.input-sidebar:checkbox:checked').each(function () {
                            if ($(this).data('filter_name') != "") {
                                __selected.push($(this).data('filter_name'));
                            }
                        });
                        __selected = jQuery.unique(__selected);
                        __selected = __selected.join('&');
                        //alert(__selected);
                        //return false;
                        var form = document.createElement('form');
                        form.method = 'POST';

                        @if(isset($_GET['s']))
                            form.action = '{{route("site.jobs.index")}}?s={!!  $_GET['s']!!}&' + __selected;
                        @if(isset($_GET['sortby']))
                            form.action = form.action + '&sortby={!! $_GET['sortby'] !!}';
                        @endif
                                @else
                            form.action = '{{route("site.jobs.index")}}?' + __selected;
                        @if(isset($_GET['sortby']))
                            form.action = form.action + '&sortby={!! $_GET['sortby'] !!}';
                                @endif
                                @endif
                        var input_filter = document.createElement('input');
                        input_filter.type = 'hidden';
                        input_filter.name = 'filter';
                        input_filter.value = __selected;

                        var input_token = document.createElement('input');
                        input_token.type = 'hidden';
                        input_token.name = '_token';
                        input_token.value = '{{csrf_token()}}';
                        form.appendChild(input_filter);
                        form.appendChild(input_token);
                        document.body.appendChild(form);
                        showLoading();
                        form.submit();

                        return false;

                    });
                });

                function ajax_fav(id) {

                    $.ajax({
                        type: "POST",
                        url: '{{route('jobs.make.favorite')}}',
                        data: 'id=' + id + '&_token={{csrf_token()}}',
                        success: function (data) {

                            // deleted , added
                            if (data == "added")
                                $('#fav_img_' + id).attr('src', '/site/default/img/hr_like.png?v=1');
                            else if (data == "deleted")
                                $('#fav_img_' + id).attr('src', '/site/default/img/hr_dislike.png?v=2');

                        }
                    });

                }


                var width = $(window).width();
                if (width < 767) {
                    $("#collapseOne").removeClass('in');
                    $("#collapseTwo").removeClass('in');
                }
                else {
                    $("#collapseOne").addClass('in');
                    $("#collapseTwo").addClass('in');
                }

                function showLoading() {
                    $("html, body").animate({scrollTop: 0}, "fast");
                    $('.preloader_all').attr('style', 'position:fixed');
                    $('.preloader_all,.preloader_back').show();
                }

                $(document).on("click", "a.show-loading", function () {
                    $('.preloader_all').attr('style', 'position:fixed');
                    $('.preloader_all,.preloader_back').show();
                });
                $(window).on("load", function (e) {
                    if ($('.preloader_all').is(":visible") !== false) {
                        $('.preloader_all,.preloader_back').fadeOut();
                    }
                });
            </script>
            <style>
                .autocomplete-suggestion {
                    background: #ffffff;
                    text-align: right;
                    direction: rtl;
                    border-left: 1px #888 solid;
                    border-bottom: 1px #888 solid;;
                    border-right: 1px #888 solid;
                    padding: 4px;
                    cursor: pointer;
                }
            </style>
@endsection