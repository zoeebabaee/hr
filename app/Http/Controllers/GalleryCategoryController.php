<?php

namespace HR\Http\Controllers;

use HR\Gallery;
use HR\GalleryCategory;
use Illuminate\Http\Request;

class GalleryCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleryCategories = GalleryCategory::myGalleryCategory()->where('id','>=','1')->
        orderByDesc('sort_order')
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('admin.galleryCategories.index',compact('galleryCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.galleryCategories.create');
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
            'name' => 'string|max:30|unique:gallery_categories'
        ]);
        GalleryCategory::create([
            'name' => $request['name'],
            'created_by' => auth()->user()->id
        ]);
        return redirect()->route('galleryCategory.index')
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
        $galleryCategories = GalleryCategory::FindOrFail($id);

        return view('admin.galleryCategories.edit',compact('galleryCategories'));
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
            'name' => 'string|max:30|unique:gallery_categories'
        ]);

        $galleryCategories = GalleryCategory::FindOrFail($id);
        $galleryCategories->name = $request['name'];
        $galleryCategories->save();

        return redirect()->route('galleryCategory.index')
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
        if(Gallery::where('cat_id' , $id)->count() == 0) {
            GalleryCategory::destroy($id);
            return redirect()->route('galleryCategory.index')
                ->with('flash_message',
                    'دسته بندی  با موفقیت حذف گردید');
        }

        return redirect()->route('galleryCategory.index')
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
            $Vidoe = GalleryCategory::findOrFail($id);
            $Vidoe->sort_order = $order;
            $Vidoe->save();
        }
    }


}
