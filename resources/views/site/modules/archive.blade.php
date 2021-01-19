<div class="clearfix wrap-rjobs">
    <fieldset class="red-fieldset mt-3">
        <legend>آرشیو</legend>
    </fieldset>
    
<style>
.articles-part { text-align: right; font-size: 13px; }
.articles-part a{color: #000;}
.archive-item::after{content: ''; display: block; width: 5px; height: 5px; background-color: #f87844; position: absolute; margin-right: -10px; margin-top: -12px; border-radius: 20px;}
</style> 
    
    @foreach($archive_links as $archive_link )
        <div class="col-12 articles-part archive-item">
            <a href="">{{JDate::createFromCarbon(
                                Carbon::create(
                                $archive_link->year,
                                $archive_link->month,
                                $archive_link->day
                                ))->format('F Y')}} ({{$archive_link->post_count}})</a>
        </div>
    @endforeach
</div>