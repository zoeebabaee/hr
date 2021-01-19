<div class="clearfix wrap-rjobs">
    <fieldset class="red-fieldset mt-4">
        <legend>فرصت های شغلی</legend>
    </fieldset>    
    @foreach($jobs->limit(4)->get() as $job)
        <div class="col-xs-12 r-part text-right d-flex">
            <img src="{{$job->company->get_gig_data()['logo']}}" alt="" width="55" height="40" class="ml-1">
            <div>
                <span><a href="{{route('jobs.show',$job->alias)}}" class="text-danger">{{$job->title}}</a> </span><br>
                <span class="text-dark">{{$job->company->name}}</span>
            </div>
        </div>
        <hr>
    @endforeach
</div>