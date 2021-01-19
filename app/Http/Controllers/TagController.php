<?php

namespace HR\Http\Controllers;

use HR\Content;
use HR\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
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
        $tag_names = Tag::all()->pluck('name')->toArray();
        $tags =Tag::orderBy('id','asc')
            ->paginate(30);
        //dd($tags->items());
        return view('admin.tags.index',compact(['tags','tag_names']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.tags.create');
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
           'name' => 'string|max:80|unique:tags'
        ]);
        Tag::create([
            'name' => $request['name']
        ]);
        return redirect()->route('tags.index')
            ->with('flash_message',
                'تگ  با موفقیت ایجاد گردید');
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
        $tag = Tag::FindOrFail($id);

        return view('admin.tags.edit',compact('tag'));
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
            'name' => 'string|max:80|unique:tags'
        ]);

        $tag = Tag::FindOrFail($id);
        $tag->name = $request['name'];
        $tag->save();

        return redirect()->route('tags.index')
            ->with('flash_message',
                'تگ  با موفقیت ویرایش گردید');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::destroy($id);

        return redirect()->route('tags.index')
            ->with('flash_message',
                'تگ  با موفقیت حذف گردید');
    }

    public function Search()
    {
        $tags =Tag::orderBy('id','asc')
            ->where('name','like','%'.request('name').'%')
            ->paginate(25);
        $tag_names = Tag::all()->pluck('name')->toArray();
        return view('admin.tags.index',compact(['tags','tag_names']));
    }

}
