<?php

namespace HR\Http\Controllers;

use Carbon\Carbon;
use HR\Company;
use HR\Content;
use HR\ContentCategory;
use HR\ContentComment;
use HR\myFuncs;
use HR\Tag;
use HR\Throttle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use p3ym4n\JDate\JDate;
use PhpParser\Comment;

class ContentController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin'])->except('show_news', 'show_event', 'show_blog','vote');
    }

    public function index()
    {
        $contents = Content::myContents();
        
        # Search in title
        if (request('title') != '') {
            $contents->where('title', 'like', '%' . request('title') . '%');
        }
        
        
        # Category filter cat_id
        if (request('cat_id') != '') {
            $contents->where('cat_id', request('cat_id'));
        }
        
        # status filter
        if (request('status') != '') {
            $contents->where('status', request('status'));
        }
        
        # approval status filter
        if (request('approved') != '') {
            $contents->where('approved', request('approved'));
        }
        
        $contents = $contents
            ->orderby('pin_status', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $categories = ContentCategory::getParents();

        return view('admin.contents.index', compact(['contents', 'categories']));
    }

    public function create()
    {
        $tags = Tag::all()->pluck('name')->toArray();
        $companies = Company::all();
        $parents = ContentCategory::getParents();
        return View::make('admin.contents.create', [
            'categories' => $parents,
            'tags' => $tags,
            'companies' => $companies
        ]);
    }

    public function store(Request $request)
    {

        if ($request['start_publish'] != '') {
            $this->validate($request, [
                "start_publish" => 'nullable|date_format:"Y-m-d H:i:s"'
            ]);
        }

        if ($request['end_publish'] != '') {
            $this->validate($request, [
                "end_publish" => 'nullable|date_format:"Y-m-d H:i:s"',
            ]);
        }

        $this->validate($request, [
            "title" => "required|max:80|string|unique:contents",
            "status" => 'required|integer|max:2|min:1',
            "comment_enable" => 'required|max:1|min:0',
            "cat_id" => "integer",
            "main_image" => "required",
            'alias' => 'required|string',
            'body' => 'required'
        ]);

        $content = new Content();

        $content->main_image = $request['main_image'];

        $filename = \HR\myFuncs::quickRandom(30);
        $img = Image::make('https://people.golrang.com/'.$request['main_image'])->resize(336, 189);
        $img->save('cache/'.$filename.'.jpg');
        $content->xl_image = 'cache/'.$filename.'.jpg';

        $filename = \HR\myFuncs::quickRandom(30);
        $img = Image::make('https://people.golrang.com/'.$request['main_image'])->resize(100, 80);
        $img->save('cache/'.$filename.'.jpg');
        $content->l_image = 'cache/'.$filename.'.jpg';


        $filename = \HR\myFuncs::quickRandom(30);
        $img = Image::make('https://people.golrang.com/'.$request['main_image'])->resize(290, 210);
        $img->save('cache/'.$filename.'.jpg');
        $content->xxl_image = 'cache/'.$filename.'.jpg';


        if (isset($request['banner_image']) && $request['banner_image'] != '')
            $content->banner_image = $request['banner_image'];
        else
            $content->banner_image = '/GolrangSystem-File-Manager/photos/1/default/noimage_pin.png';
        $content->title = $request['title'];
        $content->body = $request['body'];
        $content->status = $request['status'];
        $content->comment_status = $request['comment_enable'];
        $content->meta_keywords = $request['meta_keywords'];
        $content->meta_description = $request['meta_description'];
        $content->alias = str_replace(' ', '-', $request['alias']);
        if (Content::where('alias', $content->alias)->count())
            $content->alias .= '-' . (string)Content::where('alias', $content->alias)->count();
        $content->alias = strtolower($content->alias);
        $content->external_references = $request['external_references'];
        $content->content_rights = $request['content_rights'];
        $content->label_text = '';
        $content->label_active = 0;
        $content->cat_id = $request['cat_id'];
        if ($request['start_publish'] != '')
            $content->start_publish = JDate::createFromFormat('Y-m-d H:i:s', $request['start_publish'])->carbon->toDateTimeString();
        else
            $content->start_publish = null;
        if ($request['end_publish'] != '')
            $content->end_publish = JDate::createFromFormat('Y-m-d H:i:s', $request['end_publish'])->carbon->toDateTimeString();
        else
            $content->end_publish = null;
        $content->created_by = Auth::user()->id;
        $content->modified_by = Auth::user()->id;
        $content->save();

        if ($request['tags'] != '') {
            $content->tags()->detach();
            foreach (explode(' ', $request['tags']) as $item) {
                $tag = Tag::where('name', $item)->first();
                if (!$tag) {
                    $tag = Tag::create(['name' => $item]);
                }
                $content->tags()->attach($tag->id);
            }
        }

        if(isset($request['saveAndClose']) && $request['saveAndClose'] == 'ذخیره و بستن')
            return redirect()->route('contents.index')
                ->with('flash_message',
                    'محتوا  با موفقیت ایجاد گردید');

        return redirect()->back()
            ->with('flash_message',
                'محتوا  با موفقیت ایجاد گردید');


    }

    public function show_news($alias)
    {
        $content = Content::where('alias',$alias)->first();
        $id = $content->id;
        if ($content->category->title != "اخبار")
            abort(404);
        $content->visit_counter++;
        $content->save();
        $cat_id = ContentCategory::where('title', 'اخبار')->first()->id;
        $next = Content::where('cat_id', $cat_id)->where('id', '>', $id)->first();
        $prev = Content::where('cat_id', $cat_id)->where('id', '<', $id)
            ->orderBy('created_at', 'desc')->first();

        $archive_links = DB::table('contents')->where('cat_id', $cat_id)
            ->select(DB::raw('YEAR(created_at) year,' .
                ' MONTH(created_at) month,' .
                ' DAY(created_at) day,' .
                ' COUNT(`id`) post_count'
            ))
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $top_contents = Content::where('status', 1)
            ->where(function ($q) {
                $q->where('start_publish', '<=', Carbon::now()->toDateTimeString())
                    ->orWhere('start_publish', null);
            })->where(function ($q) {
                $q->where('end_publish', '>=', Carbon::now()->toDateTimeString())
                    ->orWhere('end_publish', null);
            })->where('approved', '1')
            ->where('cat_id', $cat_id)->orderBy('created_at', 'desc')->limit(4)->get();
    
    
        if ($content->category->comment_enable) {
            if ($content->comment_status == 1)
                $comments = ContentComment::where('content_id', $content->id)
                    ->where('status', 1)->orderByDesc('created_at')->get();
            elseif ($content->comment_status == 2)
                $comments = ContentComment::where('content_id', $content->id)
                    ->orderByDesc('created_at')->get();
            else
                $comments = null;
            $can_comment = 1;
        } else {
            $can_comment = 0;
        }
        
        
        return view('site.pages.news.show', compact([
            'content', 'next', 'prev', 'archive_links', 'top_contents','can_comment','comments'
        ]));
    }

    public function show_blog($alias)
    {
        
        $content = Content::where('alias',$alias)->first();
        $id = $content->id;
        if ($content->category->title != "وبلاگ")
            abort(404);
        $content->visit_counter++;
        $content->save();

        $cat_id = ContentCategory::where('title', 'وبلاگ')->first()->id;
        $next = Content::where('cat_id', $cat_id)->where('id', '>', $id)->first();
        $prev = Content::where('cat_id', $cat_id)->where('id', '<', $id)
            ->orderBy('created_at', 'desc')->first();
        $archive_links = DB::table('contents')->where('cat_id', $cat_id)
            ->select(DB::raw('YEAR(created_at) year,' .
                ' MONTH(created_at) month,' .
                ' DAY(created_at) day,' .
                ' COUNT(`id`) post_count'
            ))
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $top_contents = Content::where('status', 1)
            ->where(function ($q) {
                $q->where('start_publish', '<=', Carbon::now()->toDateTimeString())
                    ->orWhere('start_publish', null);
            })->where(function ($q) {
                $q->where('end_publish', '>=', Carbon::now()->toDateTimeString())
                    ->orWhere('end_publish', null);
            })->where('approved', '1')
            ->where('cat_id', $cat_id)->orderBy('created_at', 'desc')->limit(4)->get();
        
        if ($content->category->comment_enable) {
            if ($content->comment_status == 1)
                $comments = ContentComment::where('content_id', $content->id)
                    ->where('status', 1)->orderByDesc('created_at')->get();
            elseif ($content->comment_status == 2)
                $comments = ContentComment::where('content_id', $content->id)
                    ->orderByDesc('created_at')->get();
            else
                $comments = null;
            $can_comment = 1;
        } else {
            $can_comment = 0;
        }
        
        return view(
            'site.pages.blog.show',
            compact([
                'content',
                'next',
                'prev',
                'archive_links',
                'top_contents',
                'comments',
                'can_comment'
            ])
        );
    }

    public function show_event($alias)
    {
        $content = Content::where('alias',$alias)->first();
        $id = $content->id;
        if ($content->category->title != "رویدادها" && $content->category->title != "رویدادهای آموزشی")
            abort(404);
        $content->visit_counter++;
        $content->save();

        $next = Content::WhereIn('cat_id',[10,14])->where('created_at', '>', $content->created_at)->first();
        $prev = Content::WhereIn('cat_id',[10,14])->where('created_at', '<', $content->created_at)
            ->orderBy('created_at', 'desc')->first();

        $archive_links = DB::table('contents')->WhereIn('cat_id',[10,14])
            ->select(DB::raw('YEAR(created_at) year,' .
                ' MONTH(created_at) month,' .
                ' DAY(created_at) day,' .
                ' COUNT(`id`) post_count'
            ))
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $top_contents = Content::where('status', 1)
            ->where(function ($q) {
                $q->where('start_publish', '<=', Carbon::now()->toDateTimeString())
                    ->orWhere('start_publish', null);
            })->where(function ($q) {
                $q->where('end_publish', '>=', Carbon::now()->toDateTimeString())
                    ->orWhere('end_publish', null);
            })->where('approved', '1')
            ->where('cat_id', 10)->orWhere('cat_id',14)->orderBy('created_at', 'desc')->limit(4)->get();
    
        $archive_title = 'رویدادها';
        
        if ($content->category->comment_enable) {
            if ($content->comment_status == 1)
                $comments = ContentComment::where('content_id', $content->id)
                    ->where('status', 1)->orderByDesc('created_at')->get();
            elseif ($content->comment_status == 2)
                $comments = ContentComment::where('content_id', $content->id)
                    ->orderByDesc('created_at')->get();
            else
                $comments = null;
            $can_comment = 1;
        } else {
            $can_comment = 0;
        }
        //dd($can_comment);
        $archive_links = DB::table('contents')->whereIn('cat_id',array(10,14))
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

        return view('site.pages.events.show', compact([
            'content', 'next', 'prev', 'archive_links','archive_title', 'top_contents','can_comment','comments','archive_links'
        ]));
    }

    public function edit($id)
    {
        $content = Content::findOrFail($id);
        $categories = ContentCategory::getParents();
        $tags = Tag::all()->pluck('name')->toArray();
        $companies = Company::all();


        return View::make('admin.contents.edit', [
            'categories' => $categories,
            'content' => $content,
            'tags' => $tags,
            'companies' => $companies
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request['start_publish'] != '') {
            $this->validate($request, [
                "start_publish" => 'nullable|date_format:"Y-m-d H:i:s"'
            ]);
        }

        if ($request['end_publish'] != '') {
            $this->validate($request, [
                "end_publish" => 'nullable|date_format:"Y-m-d H:i:s"',
            ]);
        }

        $this->validate($request, [
            "title" => "required|max:80|string",
            "status" => 'required|integer|max:2|min:1',
            "comment_enable" => 'required|max:1|min:0',
            "cat_id" => "integer",
            'alias' => 'required|string|max:255',
            'body' => 'required'
        ]);

        $content = Content::findOrFail($id);

        if($content->main_image != $request['main_image']) {
            $content->main_image = $request['main_image'];
            File::delete($content->l_image);
            File::delete($content->xl_image);
            File::delete($content->xxl_image);
            $filename = \HR\myFuncs::quickRandom(30);
            $img = Image::make('https://people.golrang.com/' . $request['main_image'])->resize(336, 189);
            $img->save('cache/' . $filename . '.jpg');
            $content->xl_image = 'cache/' . $filename . '.jpg';

            $filename = \HR\myFuncs::quickRandom(30);
            $img = Image::make('https://people.golrang.com/' . $request['main_image'])->resize(100, 80);
            $img->save('cache/' . $filename . '.jpg');
            $content->l_image = 'cache/' . $filename . '.jpg';


            $filename = \HR\myFuncs::quickRandom(30);
            $img = Image::make('https://people.golrang.com/' . $request['main_image'])->resize(290, 210);
            $img->save('cache/' . $filename . '.jpg');
            $content->xxl_image = 'cache/' . $filename . '.jpg';
        }
        $content->banner_image = $request['banner_image'];
        $content->title = $request['title'];
        $content->body = $request['body'];
        if ($request['alias'] != $content->alias) {
            $content->alias = str_replace(' ', '-', $request['alias']);
            if (Content::where('alias', $content->alias)->count())
                $content->alias .= '-' . (string)Content::where('alias', $content->alias)->count();
            $content->alias = strtolower($content->alias);
        }
        $content->status = $request['status'];
        $content->comment_status = $request['comment_enable'];
        $content->meta_keywords = $request['meta_keywords'];
        $content->meta_description = $request['meta_description'];
        $content->external_references = $request['external_references'];
        $content->content_rights = $request['content_rights'];
        $content->label_text = '';
        $content->label_active = 0;
        $content->cat_id = $request['cat_id'];
        if ($request['start_publish'] != '')
            $content->start_publish = JDate::createFromFormat('Y-m-d H:i:s', $request['start_publish'])->carbon->toDateTimeString();
        else
            $content->start_publish = null;
        if ($request['end_publish'] != '')
            $content->end_publish = JDate::createFromFormat('Y-m-d H:i:s', $request['end_publish'])->carbon->toDateTimeString();
        else
            $content->end_publish = null;
        $content->modified_by = Auth::user()->id;
        $content->save();

        if ($request['tags'] != '') {
            $content->tags()->detach();
            foreach (explode(' ', $request['tags']) as $item) {
                $tag = Tag::where('name', $item)->first();
                if (!$tag) {
                    $tag = Tag::create(['name' => $item]);
                }
                $content->tags()->attach($tag->id);
            }
        }

        if(isset($request['saveAndClose']) && $request['saveAndClose'] == 'ذخیره و بستن')
            return redirect()->route('contents.index')
                ->with('flash_message',
                    'محتوا  با موفقیت ایجاد گردید');

        return redirect()->back()
            ->with('flash_message',
                'محتوا  با موفقیت ایجاد گردید');
    }

    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        if ($content->category->id == 13)
            return redirect()->route('contents.index')
                ->with('flash_message',
                    'شما نمی توانید صفحه ایستا را حذف کنید');
        $content->delete();
        return redirect()->route('contents.index')
            ->with('flash_message',
                'محتوا به سطل زباله منتقل شد');
    }

    public function pin($id)
    {
        $content = Content::findOrFail($id);
        $cat = $content->category->id;
        DB::table('contents')
            ->where('cat_id', $cat)
            ->where('id', $id)
            ->update(['pin_status' => 1]);

        DB::table('contents')
            ->where('cat_id', $cat)
            ->where('id', '<>', $id)
            ->update(['pin_status' => 0]);

        return redirect()->route('contents.index')
            ->with('flash_message',
                'مطلب مورد نظر پین شد');
    }

    public function unpin($id)
    {
        $content = Content::findOrFail($id);
        $cat = $content->category->id;

        DB::table('contents')
            ->where('cat_id', $cat)
            ->where('id', $id)
            ->update(['pin_status' => 0]);

        return redirect()->route('contents.index')
            ->with('flash_message',
                'پین مطلب حذف شد');
    }

    public function restore($id)
    {
        $content = Content::onlyTrashed()->findOrFail($id);
        $content->restore();
        return redirect()->route('contents.index')
            ->with('flash_message',
                'محتوا با موفقیت بازیابی شد');

    }

    public function accept($id)
    {
        $comment = Content::findOrFail($id);
        $comment->approved = 1;
        $comment->save();
        return redirect()->route('contents.index')
            ->with('flash_message',
                'مطلب مورد نظر تایید شد');
    }

    public function reject($id)
    {
        $id = request('id');
        $content = Content::findOrFail($id);
        $content->approved = 2;
        $content->save();
        $content->reject_text = request('reject_text');
        $content->save();
        return redirect()->route('contents.index')
            ->with('flash_message',
                'مطلب مورد نظر رد شد');
    }
    
    public function vote()
    {
        $this->validate(request(),[
           'id'=>'required|exists:contents,id',
           'value'=>'required|min:0|max:1',
           'fingerprint'=>'required|string',
        ]);
        $id = request('id');
        $value = request('value');
        $finger_print = request('fingerprint');
        
        $content = Content::findOrFail($id);
        $finger_print .= ';'.$id;
        $is_duplicated = Throttle::where('finger_print',$finger_print)->count();
        
        if(!$is_duplicated)
        {
            if($value == 1)
                $content->likes = $content->likes + 1;
            else
                $content->dislikes = $content->dislikes + 1;
            $content->save();
            
            $throttle = new Throttle();
            $throttle->finger_print = $finger_print;
            $throttle->expire_date = Carbon::now()->addMonth(1);
            $throttle->save();
            
            return 'از شرکت شما در این نظرسنجی سپاسگذاریم';
        }
        return 'شما قبلا به این مطلب رای داده اید';
    }

}
