<?php

namespace HR\Http\Controllers;

use HR\JobPost;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isSuperAdmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobPosts =JobPost::orderBy('id','asc')
            ->paginate(25);
        return view('admin.jobPosts.index',compact('jobPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobPosts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'string|max:80|unique:job_posts'
        ]);
        jobPost::create([
            'name' => $request['name'],
        ]);
        return redirect()->route('jobPosts.index')
            ->with('flash_message',
                'سمت با موفقیت ایجاد گردید');
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
        $jobPost = jobPost::FindOrFail($id);
        return view('admin.jobPosts.edit',compact('jobPost'));
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
        $this->validate($request,[
            'name' => 'string|max:80|unique:job_posts'
        ]);

        $jobPosts = jobPost::FindOrFail($id);
        $jobPosts->name = $request['name'];
        $jobPosts->save();

        return redirect()->route('jobPosts.index')
            ->with('flash_message',
                'سمت  با موفقیت ویرایش گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        jobPost::destroy($id);

        return redirect()->route('jobPosts.index')
            ->with('flash_message',
                'سمت  با موفقیت حذف گردید');
    }

    public function restore($id){
        $dep = jobPost::onlyTrashed()->findOrFail($id);
        $dep->restore();
        return redirect()->route('jobPosts.index')
            ->with('flash_message',
                'سمت با موفقیت بازیابی شد');
    }

    public function Search()
    {
        if(request('status') == 'all')
            $jobPosts=jobPost::withTrashed()->where('id','>','0')
                ->orderBy('id','asc');

        elseif (request('status') == '0')
            $jobPosts=jobPost::onlyTrashed()->where('id','>','0')
                ->orderBy('id','asc');

        else
            $jobPosts=jobPost::orderBy('id','asc');

        if(request('name')!='')
            $jobPosts->where('name','like','%'.request('name').'%');
        $jobPosts = $jobPosts->paginate(25);
        return view('admin.jobPosts.index',compact('jobPosts'));
    }
}
