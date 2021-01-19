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