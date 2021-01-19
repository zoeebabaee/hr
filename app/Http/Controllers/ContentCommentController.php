<?php

namespace HR\Http\Controllers;

use HR\Content;
use HR\ContentComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Comment;

class ContentCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware(['isAdmin'])->except('store');
        $this->middleware('isMobileVerified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $comments = DB::table('content_comments')
            ->join('contents', 'content_comments.content_id', '=', 'contents.id')
            ->join('users', 'content_comments.user_id', '=', 'users.id')
            ->where('contents.deleted_at' , null)
            ->where('content_comments.deleted_at',null)
            ->select(
                'users.first_name'
                ,'users.last_name'
                ,'users.email'
                ,'users.mobile'
                ,'users.avatar'
                , 'content_comments.*'
                , 'contents.title'
                ,DB::raw('contents.id AS content_id'))
            ->orderby('created_at', 'asc')->paginate(25);
        $contents_array = Content::getContents();

        return view('admin.comments.index',compact(['comments','contents_array']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id,Request $request)
    {
        $this->validate($request,[
            'content'=>'string|min:1|max:1979'
        ]);
        $comment = new ContentComment();
        $comment->content_id =explode('/',request()->url())[count(explode('/',request()->url()))-1];
        $comment->user_id = Auth::user()->id;
        $comment->status = 2;
        $comment->content = $request['comment'];
        $comment->save();
        return redirect()->back()->with('flash_message',
            'نظر شما با موفقیت ثبت گردید و پس از تایید نمایش داده خواهد شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = ContentComment::findOrFail($id);
        $comment->delete();
        return redirect()->route('comments.index')
            ->with('flash_message',
                'کامنت به سطل زباله منتقل شد');
    }

    public function accept($id)
    {
        $comment = ContentComment::findOrFail($id);
        $comment->status = 1;
        $comment->save();
        return redirect()->route('comments.index')
            ->with('flash_message',
                'کامنت مورد نظر تایید شد');
    }
    public function reject($id)
    {
        $comment = ContentComment::findOrFail($id);
        $comment->status = 2;
        $comment->save();
        return redirect()->route('comments.index')
            ->with('flash_message',
                'کامنت مورد نظر رد شد');
    }

    public function Search()
    {
        if(request('status')==3)
        {
            $comments = DB::table('content_comments')
                ->join('contents', 'content_comments.content_id', '=', 'contents.id')
                ->join('users', 'content_comments.user_id', '=', 'users.id')
                ->where('content_comments.deleted_at' ,'<>',null);

            if(request('title') !='')
                $comments->where('content_comments.content', 'like', '%'.request('title').'%');

            if(request('post') !='')
                $comments->where('content_comments.content_id', request('post'));

            $comments = $comments->select(
                'users.first_name'
                ,'users.last_name'
                ,'users.avatar'
                ,'users.email'
                ,'users.mobile'
                , 'content_comments.*'
                , 'contents.title'
                ,DB::raw('contents.id AS content_id'))
                ->orderby('created_at', 'desc')->paginate(25);

            $contents_array = Content::getContents();
            return view('admin.comments.index',compact(['comments','contents_array']));
        }
        elseif (request('status')=='')
        {
            $comments = DB::table('content_comments')
                ->join('contents', 'content_comments.content_id', '=', 'contents.id')
                ->join('users', 'content_comments.user_id', '=', 'users.id')
                ->where('contents.deleted_at' , null)
                ->where('content_comments.deleted_at',null);

            if(request('title') !='')
                $comments->where('content_comments.content', 'like', '%'.request('title').'%');

            if(request('post') !='')
                $comments->where('content_comments.content_id', request('post'));

            $comments = $comments->select(
                'users.first_name'
                ,'users.last_name'
                ,'users.avatar'
                ,'users.mobile'
                ,'users.email'
                , 'content_comments.*'
                , 'contents.title'
                ,DB::raw('contents.id AS content_id'))
                ->orderby('created_at', 'desc')->paginate(25);

            $contents_array = Content::getContents();
            return view('admin.comments.index',compact(['comments','contents_array']));
        }
        else{
            $comments = DB::table('content_comments')
                ->join('contents', 'content_comments.content_id', '=', 'contents.id')
                ->join('users', 'content_comments.user_id', '=', 'users.id');

            if(request('title') !='')
                $comments->where('content_comments.content', 'like', '%'.request('title').'%');

            if(request('post') !='')
                $comments->where('content_comments.content_id', request('post'));

            if( request('status') != 'all')
                $comments->where('content_comments.status', request('status'))->where('content_comments.deleted_at',null);;

            $comments = $comments->select(
                'users.first_name'
                ,'users.last_name'
                ,'users.avatar'
                ,'users.email'
                ,'users.mobile'
                , 'content_comments.*'
                , 'contents.title'
                ,DB::raw('contents.id AS content_id'))
                ->orderby('created_at', 'desc')->paginate(25);

            $contents_array = Content::getContents();
            return view('admin.comments.index',compact(['comments','contents_array']));
        }
    }

    public function restore($id){
        $content = ContentComment::onlyTrashed()->findOrFail($id);
        $content->restore();
        return redirect()->route('comments.index')
            ->with('flash_message',
                'کامنت با موفقیت بازگردانی شد');
    }


}
