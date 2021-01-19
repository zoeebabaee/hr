<?php

namespace HR\Http\Controllers;

use HR\Apply;
use HR\UserComment;
use Illuminate\Http\Request;

class UserCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user)
    {
        $comments = UserComment::where('user_id',$user)->paginate(10);

        return view('admin.userComments.index',compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($apply_id)
    {
        $apply = Apply::find($apply_id);
        return view('admin.userComments.create',compact('apply'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($_POST);

        #Validate Inputs
        $this->validate($request,[
           'comment' => 'required|string|max:5000',
           'user_id' => 'required|integer|exists:users,id',
           'admin_id' => 'required|integer|exists:users,id',
           'job_id' => 'required|integer|exists:jobs,id'
        ]);

        #save Data
        UserComment::create($request->all());

        #redirect Back
        return redirect(route('applies.index',$request['job_id']))->with('flash_message','نتیجه ارزیابی با موفقیت درج شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  \HR\UserComment  $userComment
     * @return \Illuminate\Http\Response
     */
    public function show(UserComment $userComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \HR\UserComment  $userComment
     * @return \Illuminate\Http\Response
     */
    public function edit(UserComment $userComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \HR\UserComment  $userComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserComment $userComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \HR\UserComment  $userComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserComment $userComment)
    {
        //
    }
}
