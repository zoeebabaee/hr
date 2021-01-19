<div class="section" id="section3" style="background: url(/site/default/img/bg3.jpg) no-repeat top center/cover;">
    <div class="container pd-80">
        <div class="col-xs-12 top-search-box">
            <h2 class="wow animated fadeInUp">جستجوی مشاغل </h2>
            <form class="form-horizontal col-md-10 col-md-pull-1" method="GET" id="search_form"
                  action="{{route('site.jobs.index')}}">
                <fieldset>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input autocomplete="off" id="textinput" name="s" placeholder=" کارشناس مالی  ..."
                                   class="form-control input-md" type="text">
                            <!-- <span class="help-block">help</span>   -->
                        </div>
                    </div>
                    <div class="col-md-12 form-group no-padd-l">
                        <div class="search-field">
                            <label class="fr-label" for="selectbasic2">حوزه</label>
                            <div class="col-md-3 no-padd-xs">
                                <select id="selectbasic2" name="department[]" class="form-control">
                                    <option value="">انتخاب حوزه</option>
                                    @foreach($job_departments as $department)
                                            <option value="{{$department}}">{{$department}}</option>
                                    @endforeach
                                </select>
                                <i class="fa fa-chevron-down searchicon-top"></i>
                            </div>
                        </div>
                        <div class="search-field">
                            <label class="fr-label" for="selectbasic3">شرکت</label>
                            <div class="col-md-3 no-padd-xs">
                                <select id="selectbasic3" name="company[]" class="form-control">
                                    <option value="">انتخاب شرکت</option>
                                    @foreach($job_companies as $company)
                                        <option value="{{$company}}">{{$company}}</option>
                                    @endforeach

                                </select>
                                <i class="fa fa-chevron-down searchicon-top"></i>
                            </div>
                        </div>
                        <div class="search-field">
                            <label class="fr-label" for="selectbasic1">استان</label>
                            <div class="col-md-3 no-padd-xs">
                                <select id="selectbasic1" name="province[]" class="form-control">
                                    <option value="">انتخاب استان</option>
                                    @foreach($job_provinces as $province)
                                        <option value="{{$province}}">{{$province}}</option>
                                    @endforeach

                                </select>
                                <i class="fa fa-chevron-down searchicon-top"></i>
                            </div>
                        </div>
                        <button id="singlebutton" name="singlebutton" class="btn btn-search"><i
                                    class="fa fa-search"></i></button>
                    </div>
                </fieldset>
            </form>
        </div>

        <div class="col-xs-12 no-padd no-padd-xs">

            <div class="jobs-carousel owl-carousel owl-theme">

                @foreach($jobs as $job)

                    <div class="item wrap-search-jobs">
                        <div class="search-jobs-box">
                            <h2><a class="title-jobs-index" href="{{route('jobs.show',$job->alias)}}">{{$job->title}}</a></h2>
                            <img src="{{$job->company->get_gig_data()['logo']}}" alt="{{$job->company->name}}" title="{{$job->company->name}}">
                            <h3>{{$job->company->name}}</h3>
                            <span class="loc-jobs"><i class="fa fa-map-marker"></i>
                                @php
                                    $city_count=\HR\City::all()->count();
                                    $cities = $job->cities->count();
                                    if($cities == $city_count)
                                        echo 'کل کشور';
                                    elseif($cities > 1)
                                        echo 'شهرهای متعدد';
                                    else
                                    {
                                        echo $job->cities->first()->province->name;
                                    }
                                @endphp
                </span>
                            <span class="type-jobs color{{$job->cooperation_type}}-timejob-grid">
                        {{$job->cooperation_type_name()}}
                        </span>
                            <span id="apply_btn_{{$job->id}}">
                            <a href="{{route('jobs.show',$job->alias)}}" class=""><i class="fa fa-arrow-left"></i> درخواست</a>
                </span>


                        </div>
                    </div>
                @endforeach

                @section('scripts_footer')
                <!-- Mainly scripts -->
                    {{ Html::script('/admin/'.config('app.admin_theme').'/js/jquery-2.1.1.js') }}

                @endsection
            </div>
            <a class="more-home" href="{{route('site.jobs.index')}}"> مشاهده موارد بیشتر <i class="fa fa-angle-left"></i></a>


        </div>

    </div>
    <style>
        .autocomplete-suggestion {
            background: #fff;
            text-align: right;
            direction: rtl;
            border-left: 1px #888 solid;
            border-bottom: 1px #888 solid;
            border-right: 1px #888 solid;
            padding: 4px;
            cursor: pointer
        }
    </style>
</div>
