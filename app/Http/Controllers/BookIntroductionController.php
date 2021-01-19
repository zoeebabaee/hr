<?php

namespace HR\Http\Controllers;

use HR\BookIntroduction;
use HR\myDate;
use HR\Tag;
use Illuminate\Http\Request;

class BookIntroductionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'isSuperAdmin'])->except('site_index','show');
    }

    public function site_index()
    {
        $books = BookIntroduction::where('id','>=',1)->orderByDesc('created_at')->paginate(6);
        $top_books = BookIntroduction::where('id','>=',1)->orderByDesc('created_at')->limit(4)->get();

        return view('site.pages.books.index')->with('books',$books)->with('top_books',$top_books);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = BookIntroduction::where('id','>=',1)->paginate(15);
        return view('admin.books.index')->with('books',$books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all()->pluck('name')->toArray();
        return view('admin.books.create',compact('tags'));
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
                'author' => 'string|required|max:255',
                'book_name' => 'string|required|max:255',
                'publication_name' => 'string|required|max:255',
                'release_date' => 'date_format:Y/m/d|nullable',
                'body' =>  'string|required',
                'img' => 'string|required|max:255',
                'slug' => 'required|string|max:255',
            ]
        );

        $book = BookIntroduction::create($request->all());
        $book->slug = str_replace(' ', '-', $request['slug']);
        if (BookIntroduction::where('slug', $book->slug)->count()-1)
            $book->slug .= '-' . (string)BookIntroduction::where('slug', $book->slug)->count();
        $book->slug = strtolower($book->slug);
        $book->save();

        if ($request['tags'] != '') {
            $book->tags()->detach();
            foreach (explode(' ', $request['tags']) as $item) {
                $tag = Tag::where('name', $item)->first();
                if (!$tag) {
                    $tag = Tag::create(['name' => $item]);
                }
                $book->tags()->attach($tag->id);
            }
        }

        return redirect(route('books.index'))->with('flash_message','ایتم با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BookIntroduction $book)
    {
        $next = BookIntroduction::where('created_at', '>', $book->created_at)->orderBy('created_at', 'asc')->first();
        $prev = BookIntroduction::where('created_at', '<', $book->created_at)->orderBy('created_at', 'desc')->first();
        $top_books = BookIntroduction::where('id','>=',1)->limit(4)->get();
        return view('site.pages.books.show',compact(['book','next','prev','top_books']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::all()->pluck('name')->toArray();
        $book = BookIntroduction::FindOrFail($id );
        return view('admin.books.edit',compact(['book','tags']));
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
        $this->validate(
            $request,[
                'author' => 'string|required|max:255',
                'book_name' => 'string|required|max:255',
                'publication_name' => 'string|required|max:255',
                'release_date' => 'date_format:Y/m/d|nullable',
                'body' =>  'string|required',
                'img' => 'string|required|max:255',
                'slug' => 'required|string|max:255',
            ]
        );
        $book = BookIntroduction::FindOrFail($id );
        
        $book->author = $request['author'];
        $book->book_name = $request['book_name'];
        $book->release_date = $request['release_date'];
        $book->publication_name = $request['publication_name'];
        $book->body = $request['body'];
        $book->img = $request['img'];
        if ($request['slug'] != $book->slug) {
            $book->slug = str_replace(' ', '-', $request['slug']);
            if (BookIntroduction::where('slug', $book->slug)->count()-1)
                $book->slug .= '-' . (string)BookIntroduction::where('slug', $book->slug)->count();
            $book->slug = strtolower($book->slug);
        }
        $book->save();
        if ($request['tags'] != '') {
            $book->tags()->detach();
            foreach (explode(' ', $request['tags']) as $item) {
                $tag = Tag::where('name', $item)->first();
                if (!$tag) {
                    $tag = Tag::create(['name' => $item]);
                }
                $book->tags()->attach($tag->id);
            }
        }
        return redirect(route('books.index'))->with('flash_message','آیتم با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = BookIntroduction::FindOrFail($id );
        $book->delete();

        return redirect(route('books.index'))->with('flash_message','آیتم با موفقیت حذف شد');
    }

}
