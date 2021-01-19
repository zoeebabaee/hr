<?php

namespace HR\Http\Controllers\Setting;

use HR\Content;
use HR\Setting\FirstPageFooter;
use Illuminate\Http\Request;
use HR\Http\Controllers\Controller;

class FirstPageFooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        $setting = FirstPageFooter::all()->first();
        $contents = Content::getContents();
        return view('admin.settings.first-page-footer',compact(['setting','contents']));
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
        $footer = FirstPageFooter::all()->first();
        $footer->content_id = $request['post'];
        $footer->central_office = $request['central_office'];
        $footer->contact_us = $request['contact_us'];
        $footer->work_time = $request['work_time'];
        $footer->links = $request['links'];
        $footer->save();
        return redirect()->route('first-page-footer.edit')
            ->with('flash_message',
                'تنظیمات با موفقیت ویرایش شدند');
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
