<?php

namespace HR\Http\Controllers;

use HR\VideoGallery;
use HR\Videos;
use Illuminate\Http\Request;

class VideoGalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isSuperAdmin'])->except('show','site_index_tut');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function site_index_tut()
    {
        $categories = VideoGallery::where('parent_id',6)
            ->orWhere('id',6)
            ->get();

        return view('site.pages.gallery.learning_movie',compact('categories'));
    }

    public function index()
    {
        $videoGalleries = VideoGallery::orderByDesc('sort_order')
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('admin.videoGalleries.index',compact('videoGalleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videoGalleries.create');
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
        $this->validate($request,[
            'name' => 'string|max:30|unique:gallery_categories',
            'icon' => 'string|max:30',
            'parent_id' => 'nullable|exists:video_galleries,id'
        ]);
        VideoGallery::create($request->all());
        return redirect()->route('video_gallery.index')
            ->with('flash_message',
                'دسته بندی با موفقیت ایجاد گردید');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(VideoGallery::find($id)->videos->count() == 0)
            abort(404);
        $videos = Videos::where('gallery_id',$id)->orderByDesc('sort_order')
            ->orderByDesc('created_at')->get();
        $cat = VideoGallery::find($id);
        return view('site.pages.gallery.video_see_all',compact(['videos','cat']));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $galleryCategories = VideoGallery::FindOrFail($id);

        return view('admin.videoGalleries.edit',compact('galleryCategories'));
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
            'name' => 'string|max:30|unique:gallery_categories',
            'icon' => 'string|max:30',
            'parent_id' => 'nullable|exists:video_galleries,id'
        ]);

        $galleryCategories = VideoGallery::FindOrFail($id);
        $galleryCategories->name = $request['name'];
        $galleryCategories->icon = $request['icon'];
        $galleryCategories->parent_id = $request['parent_id'];
        $galleryCategories->save();

        return redirect()->route('video_gallery.index')
            ->with('flash_message',
                'دسته بندی  با موفقیت ویرایش گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == 6)
        {
            redirect()->route('video_gallery.index')
                ->with('flash_message',
                    'شما نمی توانید این دسته را حذف کنید');
        }
        if(Videos::where('gallery_id' , $id)->count() == 0) {
            VideoGallery::destroy($id);
            return redirect()->route('video_gallery.index')
                ->with('flash_message',
                    'دسته بندی  با موفقیت حذف گردید');
        }

        return redirect()->route('video_gallery.index')
            ->with('flash_message',
                'شما نمی توانید دسته بندی حاوی تصاویر را حذف کنید');

    }
    public function update_sort_order()
    {
        $tmps = explode(',', $_POST['string']);
        foreach ($tmps as $tmp) {
            $tmp1 = explode(':', $tmp);
            $id = $tmp1[0];
            $order = intval($tmp1[1]) * -1;
            if ($order == 0) $order = null;
            $Video = VideoGallery::find($id);
            $Video->sort_order = $order;
            $Video->save();
        }
    }
}
