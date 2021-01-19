<?php
namespace HR\ViewComposers;

use Carbon\Carbon;
use HR\Content;
use HR\ContentCategory;

class Events{
    public static function index()
    {
        #get id of news category
        $Category = ContentCategory::where('title','رویدادها')->first();
        //dd($CategoryId);

        #get all contents in news category
        $contents = $Category->contents();
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
