<?php

namespace HR\Http\Controllers\Setting;

use Illuminate\Http\Request;
use HR\Http\Controllers\Controller;
use HR\Setting\GlobalFooter;
use HR\Content;
class GlobalFooterController extends Controller
{
    public function edit()
    {
        $setting = GlobalFooter::all()->first();
        $contents = Content::getContents();
        return view('admin.settings.global-footer',compact(['setting','contents']));
    }
    public function update(Request $request)
    {
        $footer = GlobalFooter::all()->first();
        $footer->content_id = $request['post'];
        $footer->central_office = $request['central_office'];
        $footer->contact_us = $request['contact_us'];
        $footer->links = $request['links'];
        $footer->save();
        return redirect()->route('global-footer.edit')
            ->with('flash_message',
                'تنظیمات با موفقیت ویرایش شدند');
    }
}
