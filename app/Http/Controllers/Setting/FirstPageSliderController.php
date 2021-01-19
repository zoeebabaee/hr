<?php

namespace HR\Http\Controllers\Setting;

use HR\Setting\FirstPageSlider;
use Illuminate\Http\Request;
use HR\Http\Controllers\Controller;

class FirstPageSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
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
    public function edit()
    {
        $settings = FirstPageSlider::all();
        return view('admin.settings.first-page-slider',compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        for($i = 1; $i < 11; $i++)
        {
            $slide = FirstPageSlider::FindOrFail($i);
            $slide->title = $request['slide'][$i]['title'];
            $slide->image = $request['slide'][$i]['image'];
            $slide->body = $request['slide'][$i]['body'];
            $slide->link = $request['slide'][$i]['link'];
            $slide->status = $request['slide'][$i]['status'];
            $slide->save();
        }
        return redirect()->route('first-page-slider.edit')
            ->with('flash_message',
                'تغییرات اسلاید ها ذخیره گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
