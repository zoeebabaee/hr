<?php

namespace HR\Http\Controllers;

use Carbon\Carbon;
use HR\ContentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
//use Image;
use p3ym4n\JDate\JDate;
use Session;
use HR\Content;
use Illuminate\Support\Facades\DB;
use HR\contentGroup;

class ContentCategoryController extends Controller
{
    public function __construct()
    {

        $this->middleware(
            [
                'auth'
                , 'isSuperAdmin'
            ])
            ->except(
            'site_Events'
            ,'site_Events_get'
            ,'site_Blog'
            ,'site_News'
                ,'show_news_in_group'
        );
        //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    public function index()
    {
        //Get all users and pass it to the view
        $cats = ContentCategory::where('id','>=',1)
        ->orderby('created_at', 'asc')->paginate(25);
        $parents=ContentCategory::getParents();
        return view('admin.content-categories.index',compact(['cats','parents']));
    }

    public function site_Events()
    {
        if(ContentCategory::where('title','رویدادها')->first()->status == 2)
            return null;
    
        if(\Request::route()->getName() == 'site.events.educational.index') {
            $CategoryId = array(14);
            $edu = 1;
        }
        else {
            $CategoryId = array(10, 14);
            $edu = 0;
        }
        
        $contents = Content::whereIn('cat_id',$CategoryId)->orderByDesc('created_at');
    
        
        $contents = $contents->where(function($q) {
            $q->where('start_publish','<=',Carbon::now()->toDateTimeString())
                ->orWhere('start_publish', null);
        });
        
    
        
        $contents->where(function($q) {
            $q->where('end_publish','>=',Carbon::now()->toDateTimeString())
                ->orWhere('end_publish', null);
        });
        
        $contents = $contents->where('approved','1');

        $contents = $contents->where('status','1');
    
        $top_contents = $contents->orderBy('visit_counter','desc')->limit(4)->get();
    
        $contents = $contents->where('pin_status','0');
 
        $contents = $contents->limit('created_at','desc')->paginate(5);
    
        $archive_title = 'رویدادها';
        
        $pinned_content = Content::where('pin_status',1)
            ->whereIn('cat_id',$CategoryId)->first();
        $archive_links = DB::table('contents')->whereIn('cat_id',$CategoryId)
            ->select(DB::raw('YEAR(created_at) year,'.
                ' MONTH(created_at) month,'.
                ' DAY(created_at) day,'.
                ' COUNT(`id`) post_count'
            ))
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
        return view(
            'site.pages.events.index',
            compact(
                [
                    'contents',
                    'archive_links',
                    'top_contents',
                    'edu',
                    'archive_title'
                ]
            )
        );
    }
    
    public function site_Blog()
    {
        #get id of news category
        $CategoryId = ContentCategory::where('title','وبلاگ')->first()->id;
        //dd($CategoryId);

        #get all contents in news category
        $contents = Content::where('cat_id',$CategoryId)->orderByDesc('created_at');;
        //dd($contents);

        #check start_publish_date
        $contents = $contents->where(function($q) {
            $q->where('start_publish','<=',Carbon::now()->toDateTimeString())
                ->orWhere('start_publish', null);
        });
        //dd($contents);

        #check for end_publish_date
        $contents = $contents->where(function($q) {
            $q->where('end_publish','>=',Carbon::now()->toDateTimeString())
                ->orWhere('end_publish', null);
        });
        //dd($contents);
        #check for approved or not
        $contents = $contents->where('approved','1');
        //dd($contents);

        #check for status
        $contents = $contents->where('status','1');
        //dd($contents);

        #limit latest 3
        $contents = $contents->orderby('pin_status', 'desc')
            ->orderBy('created_at','desc')->paginate(11);
        //dd($contents);
        return view('site.pages.blog.index',compact('contents'));
    }

    public function site_News()
    {
        if(ContentCategory::where('title','اخبار')->first()->status == 2)
            return null;
    
        #get id of news category
        $CategoryId = ContentCategory::where('title','اخبار')->first()->id;
        //dd($CategoryId);
    
        #get all contents in news category
        $contents = Content::where('cat_id',$CategoryId)->orderByDesc('created_at');
        //dd($contents);
    
        #check start_publish_date
        $contents = $contents->where(function($q) {
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
        $contents = $contents->where('approved','1');
        //dd($contents);
    
        #check for status
        $contents = $contents->where('status','1');
    
        $top_contents = $contents->orderBy('visit_counter','desc')->limit(4)->get();
    
        $contents = $contents->where('pin_status','0');
        //dd($contents);
    
        #limit latest 3
        $contents = $contents->orderBy('created_at','desc')->paginate(5);
    
        $pinned_content = Content::where('pin_status',1)
            ->where('cat_id',$CategoryId)->first();
        $archive_links = DB::table('contents')->where('cat_id',$CategoryId)
            ->select(DB::raw('YEAR(created_at) year,'.
                ' MONTH(created_at) month,'.
                ' DAY(created_at) day,'.
                ' COUNT(`id`) post_count'
            ))
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
    
        $archive_title = 'اخبار';
        
        return view(
            'site.pages.news.index',
            compact(
                [
                    'contents',
                    'pinned_content',
                    'archive_links',
                    'top_contents',
                    'archive_title'
                ]
            )
        );
    }

    public function show_news_in_group($group)
    {
        if(ContentCategory::where('title','اخبار')->first()->status == 2)
            return null;

        #get id of news category
        $CategoryId = ContentCategory::where('title','اخبار')->first()->id;
        //dd($CategoryId);

        #get all contents in news category
        $group = contentGroup::where('alias',$group)->first();

        $contents = $group->contents()->where('cat_id',$CategoryId);
        //dd($contents);

        #check start_publish_date
        $contents = $contents->where(function($q) {
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
        $contents = $contents->where('approved','1');
        //dd($contents);

        #check for status
        $contents = $contents->where('status','1');

        $top_contents = $contents->orderBy('visit_counter','desc')->limit(4)->get();

        $contents = $contents->where('pin_status','0');
        //dd($contents);

        #limit latest 3
        $contents = $contents->orderBy('created_at','desc')->paginate(5);

        $pinned_content = Content::where('pin_status',1)
            ->where('cat_id',$CategoryId)->first();
        $archive_links = DB::table('contents')->where('cat_id',$CategoryId)
            ->select(DB::raw('YEAR(created_at) year,'.
                ' MONTH(created_at) month,'.
                ' DAY(created_at) day,'.
                ' COUNT(`id`) post_count'
            ))
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
        return view(
            'site.pages.news.index',
            compact(
                [
                    'contents',
                    'pinned_content',
                    'archive_links',
                    'top_contents',
                    'group'
                ]
            )
        );
    }

    public function create()
    {
        $parents=ContentCategory::getParents();
        return View::make('admin.content-categories.create', ['parents' => $parents]);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|max:80|string',
            'body'=>'nullable',
            'status' => 'required|integer|max:2|min:1',
            'layout' => 'required|string|max:20',
            'comment_enable' => 'boolean',
            'parent_id' => 'nullable|integer',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords' => 'nullable|string|max:1000',
        ]);

        $cat = new ContentCategory();
        $cat->title = $request['title'];
        $cat->alias = str_replace(' ','-',$request['title']);
        $cat->body = $request['body'];
        $cat->status = $request['status'];
        $cat->layout = $request['layout'];
        $cat->comment_enable = $request['comment_enable'];
        $cat->parent_id = $request['parent_id'];
        $cat->image = $request['image'];
        $cat->created_by = Auth::user()->id;
        $cat->modified_by = Auth::user()->id;
        $cat->meta_description = $request['comment_enable'];
        $cat->meta_keywords = $request['comment_enable'];
        $cat->save();

        return redirect()->route('content_categories.index')
            ->with('flash_message',
                'دسته بندی با موفقیت ایجاد گردید');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        if($id == 1)
            return redirect()->route('content_categories.index')
                ->with('flash_message',
                    'نمی توانید دسته بندی های اصلی را ویرایش کنید');
        $parents=ContentCategory::getParents();
        $cat = ContentCategory::findOrFail($id); //Get user with specified id
        return view('admin.content-categories.edit', compact(['cat','parents'])); //pass user and roles data to view
    }

    public function update(Request $request, $id)
    {
        if($id == 1)
            return redirect()->route('content_categories.index')
                ->with('flash_message',
                    'نمی توانید دسته بندی های اصلی را ویرایش کنید');
        $this->validate(request(), [
            'title' => 'required|max:80|string',
            'body'=>'nullable',
            'status' => 'required|integer|max:3|min:1',
            'layout' => 'required|string|max:20',
            'comment_enable' => 'boolean',
            'parent_id' => 'nullable|integer',
            'meta_description' => 'string|max:300',
            'meta_keywords' => 'string|max:1000',
        ]);
        $cat= ContentCategory::findOrFail($id);
        $cat->title = request('title');
        $cat->alias = str_replace(' ','-',$request['title']);
        $cat->body = request('body');
        $cat->status = request('status');
        $cat->layout = request('layout');
        $cat->comment_enable = request('comment_enable');
        $cat->parent_id = request('parent_id');
        $cat->image = request('image');
        $cat->modified_by = Auth::user()->id;
        $cat->meta_description = request('meta_description');
        $cat->meta_keywords = request('meta_keywords');
        $cat->save();

        /*if ($request->hasFile('image')) {
            if (!File::exists(public_path('images/cats/' . $cat->id . '/'))) {
                File::makeDirectory(public_path('images/cats/' . $cat->id . '/'));
            }
            $files = File::allFiles(public_path('images/cats/' . $cat->id . '/'));
            foreach ($files as $file) {
                File::delete($file);
            }
            $image = $request->file('image');
            $filename = Auth::user()->id . md5(Auth::user()->id . Auth::user()->first_name . Auth::user()->mobile . 'AlirezaBarzin');
            $location = public_path('images/cats/' . $cat->id . '/' . $filename . '.' . $image->getClientOriginalExtension());
            Image::make($image)->save($location);
        }*/

        return redirect()->route('content_categories.index')
            ->with('flash_message',
                'دسته بندی با موفقیت ایجاد گردید');
    }

    public function destroy($id)
    {
        /**
         * Check For Protected Categories
         */
        if($id == 1)
            return redirect()->route('content_categories.index')
                ->with('flash_message',
                    'نمی توانید دسته بندی های اصلی را حذف کنید');

        $cat = ContentCategory::findOrFail($id);

        /**
         * Check For Parent Categories
         */
        if($cat->child()->count())
        {
            return redirect()->route('content_categories.index')
                ->with('flash_message',
                    'نمی توانید دسته بندی ریشه را حذف کنید');
        }

        /**
         * Check If Have Content
         */
        if($cat->contents()->count())
        {
            DB::table('contents')
                ->where('cat_id', $cat->id)
                ->update(['cat_id' => 1]);
        }

        $cat->delete();
            return redirect()->route('content_categories.index')
                ->with('flash_message',
                    'دسته بندی به سطل زباله منتقل شد');
    }

    public function restore($id){

        $cat = ContentCategory::onlyTrashed()->findOrFail($id);
        $cat->restore();
        return redirect()->route('content_categories.index')
            ->with('flash_message',
                'دسته بندی با موفقیت بازیابی شد');

    }

    public function Search(){

        if(request('status')==3)
        {
            $cats = ContentCategory::onlyTrashed()->where('id','>','0');
            if(request('title') !='')
                $cats->where('title', 'like', '%'.request('title').'%');

            if(request('parent_id') !='')
                $cats->where('parent_id', request('parent_id'));

            $parents=ContentCategory::getParents();
            $cats = $cats->orderby('created_at', 'asc')->paginate(25);
            return view('admin.content-categories.index',compact(['cats','parents']));
        }
        elseif (request('status')=='')
        {
            $cats = ContentCategory::where('id','>','0');
            if(request('title') !='')
                $cats->where('title', 'like', '%'.request('title').'%');

            if(request('parent_id') !='')
                $cats->where('parent_id', request('parent_id'));

            $parents=ContentCategory::getParents();
            $cats = $cats->orderby('created_at', 'desc')->paginate(25);
            return view('admin.content-categories.index',compact(['cats','parents']));
        }
        else{
            $cats = ContentCategory::withTrashed()->where('id','>','0');
            $parents=ContentCategory::getParents();

            if(request('title') !='')
                $cats->where('title', 'like', '%'.request('title').'%');

            if(request('parent_id') !='')
                $cats->where('parent_id', request('parent_id'));

            if( request('status') != 'all')
                $cats->where('status', request('status'))->where('deleted_at',null);

            $cats = $cats->orderby('created_at', 'desc')->paginate(25);
            return view('admin.content-categories.index',compact(['cats','parents']));
        }
    }
}
