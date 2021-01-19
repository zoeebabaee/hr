<?php

namespace HR\Http\Controllers;

use HR\BookIntroduction;
use HR\Content;
use HR\Job;
use Illuminate\Http\Request;
use HR\ContentCategory;
use HR\JobGeneralMerites;
use HR\JobProfessionalMerites;
use Illuminate\Support\Facades\DB;

class SearchHoleSiteController extends Controller
{
    public function Search_all(){
        $query = request('query');
        $news_cat_id = ContentCategory::where('title','اخبار')->first()->id;
        $blog_cat_id = ContentCategory::where('title','وبلاگ')->first()->id;
        $events_cat_id = ContentCategory::where('title','رویدادها')->first()->id;
        $static_pages_cat_id = ContentCategory::where('title','صفحات ایستا')->first()->id;

        $news = Content::content_search($query,$news_cat_id);
        $blog = Content::content_search($query,$blog_cat_id);
        $events = Content::content_search($query,$events_cat_id);
        $static_pages = Content::content_search($query,$static_pages_cat_id);
        $jobs = Job::job_search($query);

        $provincesNames = array();
        foreach ($jobs as $job)
        {

            $cities = $job->cities;
            $result = array();
            foreach ($cities as $city)
            {
                $result[$city->province->name] = 1;
            }
            $result = array_keys($result);
            if(count($result)>3)
                $result = array_slice($result,0,3);
            $result = implode($result,' ،');
            if(count($cities) > 3)
                $result.=' ...';
            $provincesNames[$job->id] = $result;
        }

        $books = BookIntroduction::book_search($query);

        $search_result_counter = $news->count() + $blog->count() + $events->count() + $static_pages->count() + $jobs->count() + $books->count();


        return view( 'site.pages.search.index',
            compact(
                [
                    'search_result_counter',
                    'jobs',
                    'news',
                    'blog',
                    'events',
                    'static_pages',
                    'books',
                    'query'
                ]
            )
        );
    }
    public function Search_books(){
        $query = request('query');
        $content = BookIntroduction::book_search($query);
        $type = 'book';
        $search_result_counter = $content->count();
        return view( 'site.pages.search.content_list',compact(['search_result_counter','content','query','type']));
    }
    public function Search_blog(){
        $query = request('query');
        $blog_cat_id = ContentCategory::where('title','وبلاگ')->first()->id;
        $content = Content::content_search($query,$blog_cat_id);
        $type = 'blog';
        $search_result_counter = $content->count();
        return view( 'site.pages.search.content_list',compact(['search_result_counter','content','query','type']));
    }
    public function Search_event(){
        $query = request('query');
        $events_cat_id = ContentCategory::where('title','رویدادها')->first()->id;
        $content = Content::content_search($query,$events_cat_id);
        $type = 'events';
        $search_result_counter = $content->count();
        return view( 'site.pages.search.content_list',compact(['search_result_counter','content','query','type']));
    }
    public function Search_news(){
        $query = request('query');
        $news_cat_id = ContentCategory::where('title','اخبار')->first()->id;
        $content = Content::content_search($query,$news_cat_id);
        $type = 'news';
        $search_result_counter = $content->count();
        return view( 'site.pages.search.content_list',compact(['search_result_counter','content','query','type']));
    }
    public function Search_static_pages(){
        $query = request('query');
        $static_pages_cat_id = ContentCategory::where('title','صفحات ایستا')->first()->id;
        $content = Content::content_search($query,$static_pages_cat_id);
        $type = 'static_pages';
        $search_result_counter = $content->count();
        return view( 'site.pages.search.content_list',compact(['search_result_counter','content','query','type']));
    }

    public function Search_tags($query){
        $news_cat_id = ContentCategory::where('title','اخبار')->first()->id;
        $blog_cat_id = ContentCategory::where('title','وبلاگ')->first()->id;
        $events_cat_id = ContentCategory::where('title','رویدادها')->first()->id;

        $news = Content::content_tag_search($query,$news_cat_id);
        $blog = Content::content_tag_search($query,$blog_cat_id);
        $events = Content::content_tag_search($query,$events_cat_id);
        $books = BookIntroduction::book_tag_search($query);

        $search_result_counter = $news->count() + $blog->count() + $events->count() + $books->count();

        $jobs = null;
        $static_pages = null;

        return view( 'site.pages.search.index',
            compact(
                [
                    'search_result_counter',
                    'jobs',
                    'news',
                    'blog',
                    'events',
                    'static_pages',
                    'books',
                    'query'
                ]
            )
        );
    }
    public function Search_book_tags(){
        $query = request('query');
        $content = BookIntroduction::book_tag_search($query);
        $type = 'book';
        $search_result_counter = $content->count();
        return view( 'site.pages.search.content_list',compact(['search_result_counter','content','query','type']));
    }

    public function Search_blog_tags($query){

        $blog_cat_id = ContentCategory::where('title','وبلاگ')->first()->id;
        $content = Content::content_tag_search($query,$blog_cat_id);
        $type = 'blog';
        $search_result_counter = $content->count();
        return view( 'site.pages.search.content_list',compact(['search_result_counter','content','query','type']));
    }
    public function Search_event_tags($query){
        $events_cat_id = ContentCategory::where('title','رویدادها')->first()->id;
        $content = Content::content_tag_search($query,$events_cat_id);
        $type = 'events';
        $search_result_counter = $content->count();
        return view( 'site.pages.search.content_list',compact(['search_result_counter','content','query','type']));
    }
    public function Search_news_tags($query){

        $news_cat_id = ContentCategory::where('title','اخبار')->first()->id;
        $content = Content::content_tag_search($query,$news_cat_id);
        $type = 'news';
        $search_result_counter = $content->count();
        return view( 'site.pages.search.content_list',compact(['search_result_counter','content','query','type']));
    }
    public function Search_static_pages_tags($query){

        $static_pages_cat_id = ContentCategory::where('title','صفحات ایستا')->first()->id;
        $content = Content::content_tag_search($query,$static_pages_cat_id);
        $type = 'static_pages';
        $search_result_counter = $content->count();
        return view( 'site.pages.search.content_list',compact(['search_result_counter','content','query','type']));
    }
    public function JobTagAutoComplete()
    {
        $query = request('query');

        $general_merites_ids = DB::table('job_has_general_merites')->where('id','>=',1)
            ->pluck('general_merites_id')->unique()->toArray();

        $general_professional_ids = DB::table('job_has_professional_merites')->where('id','>=',1)
            ->pluck('professional_merites_id')->unique()->toArray();

        $result1 = JobGeneralMerites::where('name','like','%'.$query.'%')
            ->whereIn('id',$general_merites_ids)
            ->get()->pluck('name')->toArray();

        $result2 = JobProfessionalMerites::where('name','like','%'.$query.'%')
            ->whereIn('id',$general_professional_ids)
            ->get()->pluck('name')->toArray();

        $result3 = Job::where('title','like','%'.$query.'%')
            ->get()->pluck('title')->toArray();
        $results = array();
        foreach ($result1 as $result)
            $results[($result)] = 1;

        foreach ($result2 as $result)
            $results[($result)] = 1;

        foreach ($result3 as $result)
            $results[($result)] = 1;

        $results = array_slice($results,0,10);

        $str_tmp = '{"suggestions":[';
        foreach ($results as $result=>$tmp)
            $str_tmp .= "{ \"value\" : \"$result\"}, ";
        return rtrim($str_tmp,', ') .']}';
    }


}