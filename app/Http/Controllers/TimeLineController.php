<?php

namespace HR\Http\Controllers;

use HR\TimeLine;
use Illuminate\Http\Request;
use DB;
use HR\myDate;

class TimeLineController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isSuperAdmin'])->except('site_index_about');
    }

    public function site_index_about()
    {
        $dates = TimeLine::all()->sortByDesc('when')->groupBy(function($item)
        {
            $tmp = myDate::createFromFormat('Y/m/d', $item->when)->format('Y');
            return $tmp;
        });
        $timeLine= $dates->toArray();

        return view('site.pages.about',compact('timeLine'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ref)
    {
        $timeLine = TimeLine::where('ref',$ref)->orderByDesc('when')->get();
        if(!$timeLine->count())
            return view('admin.AboutUsTimeLine.index')->with('timeLine',null);

        return view('admin.AboutUsTimeLine.index',compact('timeLine'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.AboutUsTimeLine.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,[
                'title' => 'string|required|max:255',
                'icon' => 'string|required|max:70',
                'body' => 'string|required|max:5000',
                'when' => 'date_format:Y/m/d',
                'ref' =>  'string|required|max:255',
                'img' =>'string|nullable|max:255'
            ]
        );
        $timeLine = TimeLine::create($request->all());
        return redirect(route('timeLine.index',$timeLine->ref))->with('flash_message','ایتم با موفقیت ایجاد شد');
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
        $timeLine = TimeLine::findOrFail($id);

        return view('admin.AboutUsTimeLine.edit',compact('timeLine'));
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
        $timeLine = TimeLine::findOrFail($id);
        $this->validate(
            $request,
            [
                'title' => 'string|required|max:255',
                'icon' => 'string|required|max:70',
                'body' => 'string|required|max:5000',
                'when' => 'date_format:Y/m/d',
                'ref' =>  'string|required|max:255',
                'img' =>'string|nullable|max:255'
            ]
        );
        $timeLine->title = $request['title'];
        $timeLine->icon = $request['icon'];
        $timeLine->body = $request['body'];
        $timeLine->when = $request['when'];
        $timeLine->ref = $request['ref'];
        $timeLine->img = $request['img'];
        $timeLine->save();
        return redirect(route('timeLine.index',$request['ref']))->with('flash_message','تغییرات شما اعمال گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $timeLine = TimeLine::findOrFail($id);
        $tmp = $timeLine;
        $timeLine->delete();
        return redirect(route('timeLine.index',$tmp->ref))->with('flash_message','آیتم با موفقیت حذف شد');
    }
}
