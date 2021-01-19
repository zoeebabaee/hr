<?php

namespace HR\Http\Controllers;

use HR\Videos;
use Illuminate\Http\Request;

class VideosController extends Controller
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
        return view ('admin.videos.index')->with('video',Videos::where('id','>=',1)->orderByDesc('sort_order')
            ->orderByDesc('created_at')
            ->paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.videos.create');
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
            'name' => 'required|string|max:255',
            'body' => 'required|string|max:5000',
            'video' => 'required|string|max:500',
            'gallery_id' => 'required|exists:video_galleries,id',
            'avatar' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);
        $video =  Videos::create($request->all());
        $video->slug = str_replace(' ', '-', $request['slug']);
        if (Videos::where('slug', $video->slug)->count())
            $video->slug .= '-' . (string)Videos::where('slug', $video->slug)->count();
        $video->slug = strtolower($video->slug);
        $video->save();
        return redirect(route('videos.index'))->with('flash_message','ایتم با موفقیت ایجاد گردید');
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
        $video = Videos::FindOrFail($id);
        return view ('admin.videos.edit',compact('video'));
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
            'name' => 'required|string|max:255',
            'body' => 'required|string|max:5000',
            'video' => 'required|string|max:500',
            'avatar' => 'required|string|max:255',
            'gallery_id' => 'required|exists:video_galleries,id',
            'slug' => 'required|string|max:255',
        ]);
        $video = Videos::FindOrFail($id);
        $video->name = $request['name'];
        $video->body = $request['body'];
        $video->video = $request['video'];
        $video->avatar = $request['avatar'];
        $video->gallery_id = $request['gallery_id'];
        if ($request['slug'] != $video->slug) {
            $video->slug = str_replace(' ', '-', $request['slug']);
            if (BookIntroduction::where('slug', $video->slug)->count()-1)
                $video->slug .= '-' . (string)BookIntroduction::where('slug', $video->slug)->count();
            $video->slug = strtolower($video->slug);
        }
        $video->save();

        return redirect(route('videos.index'))->with('flash_message','ایتم با موفقیت ویرایش گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Videos::find($id)->delete();
        return redirect(route('videos.index'))->with('flash_message','ایتم با موفقیت حذف گردید');
    }

    public function update_sort_order()
    {
        $tmps = explode(',', $_POST['string']);
        foreach ($tmps as $tmp) {
            $tmp1 = explode(':', $tmp);
            $id = $tmp1[0];
            $order = intval($tmp1[1]) * -1;
            if ($order == 0) $order = null;
            $Vidoe = Videos::findOrFail($id);
            $Vidoe->sort_order = $order;
            $Vidoe->save();
        }
    }
}
