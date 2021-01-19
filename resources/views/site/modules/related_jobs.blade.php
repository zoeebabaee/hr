@if($job->related_jobs()->count())
<div class="row col-md-12">
    <fieldset class="red-fieldset mt-3">
        <legend>فرصت های شغلی مرتبط</legend>
    </fieldset>
    @foreach($job->related_jobs() as $job_related)
    <div class="col-md-3">
        <img src="{{$job_related->company->get_gig_data()['logo']}}" alt="{{$job_related->company->name}}" class="related-job-img">
        <hr class="w-100">
        <div>
            <span class="font-13 d-block text-right"><a class=" text-secondary" href="{{route('jobs.show',$job_related->alias)}}">{{$job_related->title}}</a> </span>
            <span class="font-13 d-block text-right text-dark"> {{$job_related->company->name}}</span>
        </div>
    </div>
    @endforeach

</div>
@endif
