<?php
namespace HR\ViewComposers;

use Carbon\Carbon;
use HR\Content;
use HR\ContentCategory;

class LatestBlogContents{
    public static function index()
    {
        #get id of news category
        $CategoryId = ContentCategory::where('title','وبلاگ')->first()->id;
        //dd($CategoryId);

        #get all contents in news category
        $contents = Content::where('cat_id',$CategoryId);
        //dd($contents);

        #check start_publish_date
        $contents->where(function($q) {
            $q->where('start_publish','<=',Carbon::now()->toDateTimeString())
                ->orWhere('start_publish', null);
        });
        //dd($contents);

        #check for end_publish_date
        $contents->where(function($q) {
            $q->where('end_publish','>=',Carbon::now()->toDateTimeString())
                ->orWhere('end_publish', null);
        });
        //dd($contents);
        #check for approved or not
        $contents->where('approved','1');
        //dd($contents);

        #check for status
        $contents->where('status','1');
        //dd($contents);

        #limit latest 3
        $contents->limit(3)->orderby('pin_status', 'desc')
            ->orderBy('created_at','desc');
        //dd($contents);

        return $contents;
    }
}
