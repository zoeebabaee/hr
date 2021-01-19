<?php

namespace HR\Http\Controllers;

use HR\Gallery;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class GalleryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin'])->except('site_index','site_index_load_more');
    }

    public function site_index(){
        $all = Gallery::all()->count();
        $images = Gallery::where('id','>=','1')
            ->where('approved','1')
            ->orderByDesc('sort_order')
            ->orderByDesc('created_at')->limit(8)->get();
        $remains_item = $all - $images->count();

        return view('site.pages.gallery.images',compact(['images','remains_item']));
    }
    public function site_index_load_more(){
        $page  = intval(request('page'));
        $page--;
        $all = Gallery::all()->where('approved','1')->count();
        $take = (($all-$page*8) < 8)?($all-$page*8) : 8 ;
        $skip = $page*8;

        $images = Gallery::where('id','>=','1')
            ->where('approved','1')
            ->orderByDesc('sort_order')
            ->orderByDesc('created_at')->take($take)->skip($skip);
        $str_result = '';
        foreach ($images->get() as $image)
        {
            $str_result.="  <div class=\"cbp-item cat$image->cat_id\">
                            <a class=\"cbp-caption cbp-lightbox\" href=\"$image->img\" data-title=\"$image->name\">
                            <div class=\"cbp-caption-defaultWrap\">
                            <img data-main=\"$image->img\" src=\"$image->l_img\" alt=\"$image->name\">
                            </div>
                            </a>
                            <a href=\"$image->link\" class=\"cbp-singlePage cbp-l-grid-masonry-projects-title\" rel=\"nofollow\">$image->name</a>
                            <p>".strip_tags($image->body,'')."</p>
                            </div>\n";
        }
        $result = ['remain'=> $all - $page*8 - $take , 'data'=>$str_result];
        return $result;
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('admin.galleries.index')->with('gallery',Gallery::where('id','>=',1)
            ->orderByDesc('sort_order')
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
        return view ('admin.galleries.create');
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
            'img' => 'required|string|max:255',
            'link' => 'url|nullable',
            'cat_id' => 'required|exists:gallery_categories,id'
        ]);

        $gallery = new Gallery();

        $filename = \HR\myFuncs::quickRandom(30);
        $img = Image::make('https://people.golrang.com/' . $request['img']);
        $width = $img->width();
        $height = $img->height();
        $width_N = 266;
        $height_N = $height * 266 / $width;
        $img->resize($width_N,$height_N);
        $img->save('cache/' . $filename . '.jpg');
        $gallery->l_img = 'cache/' . $filename . '.jpg';

        $gallery->name = $request['name'];
        $gallery->body = $request['body'];
        $gallery->img = $request['img'];
        $gallery->link = $request['link'];
        $gallery->cat_id = $request['cat_id'];
        $gallery->created_by = auth()->user()->id;
        $gallery->l_img = 'cache/'.$filename.'.jpg';
        $gallery->save();
        return redirect(route('gallery.index'))->with('flash_message','ایتم با موفقیت ایجاد گردید');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = Gallery::FindOrFail($id);
        return view ('admin.galleries.edit',compact('gallery'));
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
            'img' => 'required|string|max:255',
            'link' => 'url|nullable',
            'cat_id' => 'required|exists:gallery_categories,id'
        ]);

        $gallery = Gallery::FindOrFail($id);

        if($gallery->img != $request['img']) {
            $gallery->img = $request['img'];
            File::delete($gallery->l_img);
            $filename = \HR\myFuncs::quickRandom(30);
            $img = Image::make('https://people.golrang.com/' . $gallery->img);
            $width = $img->width();
            $height = $img->height();
            $width_N = 266;
            $height_N = $height * 266 / $width;
            $img->resize($width_N,$height_N);
            $img->save('cache/' . $filename . '.jpg');
            $gallery->l_img = 'cache/' . $filename . '.jpg';
        }

        $gallery->name = $request['name'];
        $gallery->body = $request['body'];
        $gallery->img = $request['img'];
        $gallery->link = $request['link'];
        $gallery->cat_id = $request['cat_id'];
        $gallery->save();

        return redirect(route('gallery.index'))->with('flash_message','ایتم با موفقیت ویرایش گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $id)
    {
        $id->delete();
        return redirect(route('gallery.index'))->with('flash_message','ایتم با موفقیت حذف گردید');
    }

    public function update_sort_order()
    {
        $tmps = explode(',', $_POST['string']);
        foreach ($tmps as $tmp) {
            $tmp1 = explode(':', $tmp);
            $id = $tmp1[0];
            $order = intval($tmp1[1]) * -1;
            if ($order == 0) $order = null;
            $Gallery = Gallery::findOrFail($id);
            $Gallery->sort_order = $order;
            $Gallery->save();
        }
    }

    public function accept($id)
    {
        $item = Gallery::findOrFail($id);
        $item->approved = 1;
        $item->save();
        return redirect()->route('gallery.index')
            ->with('flash_message',
                'تصویر مورد نظر تایید شد');
    }

    public function reject($id)
    {
        $item = Gallery::findOrFail($id);
        $item->approved = 2;
        $item->save();
        return redirect()->route('gallery.index')
            ->with('flash_message',
                'تصویر مورد نظر رد شد');
    }
}
