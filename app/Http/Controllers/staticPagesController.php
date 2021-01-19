<?php

namespace HR\Http\Controllers;

use HR\Content;
use Illuminate\Http\Request;

class staticPagesController extends Controller
{
    public function index($alias)
    {
        $content = Content::where('alias',$alias);

        if(!$content->count())
            abort(404);
        else {
            $content = $content->first();
            return view('site.pages.statics.index', compact('content'));
        }
    }
}
