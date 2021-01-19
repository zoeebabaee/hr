<?php

namespace HR\Http\Controllers;

use HR\OthersSay;
use Illuminate\Http\Request;

class OthersSayController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isSuperAdmin'])->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qoutes = OthersSay::where('id','>=',1)
            ->orderByDesc('created_at')
            ->paginate(10);
        return view ('admin.OthersSay.index',compact('qoutes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.OthersSay.create');
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
            'name' => 'required|string|max:100',
            'post' => 'required|string|max:100',
            'company' => 'required|string|max:100',
            'avatar' => 'required|string|max:200',
            'body' => 'required|string|max:5000',
        ]);
        $qoute =  OthersSay::create($request->all());
        return redirect(route('OthersSay.index'))->with('flash_message','ایتم با موفقیت ایجاد گردید');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Videos $video)
    {
        $video->visitCount = $video->visitCount + 1;
        $video->save();
        return view('site.pages.gallery.single_video',compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $qoute = OthersSay::FindOrFail($id);
        return view ('admin.OthersSay.edit',compact('qoute'));
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
            'name' => 'required|string|max:100',
            'post' => 'required|string|max:100',
            'company' => 'required|string|max:100',
            'avatar' => 'required|string|max:200',
            'body' => 'required|string|max:5000',
        ]);
        $qoute = OthersSay::FindOrFail($id);
        $qoute->name = $request['name'];
        $qoute->post = $request['post'];
        $qoute->company = $request['company'];
        $qoute->avatar = $request['avatar'];
        $qoute->body = $request['body'];
        $qoute->save();

        return redirect(route('OthersSay.index'))->with('flash_message','ایتم با موفقیت ویرایش گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OthersSay $id)
    {
        $id->delete();
        return redirect(route('OthersSay.index'))->with('flash_message','ایتم با موفقیت حذف گردید');
    }

}
