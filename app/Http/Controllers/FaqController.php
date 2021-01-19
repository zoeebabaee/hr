<?php

namespace HR\Http\Controllers;

use HR\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin'])->except('show');
    }
    
    public function index(){
        
        $faqs = Faq::where('id','>=',1)
            ->orderByDesc('created_at')
            ->paginate(10);
        return view ('admin.faqs.index',compact('faqs'));
        
    }
    
    public function create()
    {
        return view ('admin.faqs.create');
    }
    
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'question' => 'required|string|max:1000',
            'answer' => 'required|string|max:10000',
        ]);
        $faq =  Faq::create($request->all());
        return redirect(route('faqs.index'))->with('flash_message','ایتم با موفقیت ایجاد گردید');
    }
    
    public function edit($id)
    {
        
        $faq = Faq::FindOrFail($id);
        return view ('admin.faqs.edit',compact('faq'));
        
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'question' => 'required|string|max:1000',
            'answer' => 'required|string|max:10000',
        ]);
        $faq = Faq::FindOrFail($id);
        $faq->update($request->all());
        return redirect(route('faqs.index'))->with('flash_message','ایتم با موفقیت ویرایش گردید');
    
    }
    
    public function show()
    {
        $faqs = Faq::all();
        return view ('site.pages.faqs',compact('faqs'));
    }

    public function accept($id)
    {
        $comment = Faq::findOrFail($id);
        $comment->approved = 1;
        $comment->save();
        return redirect()->route('faqs.index')
            ->with('flash_message',
                'سوال مورد نظر تایید شد');
    }

    public function reject($id)
    {
        $id = request('id');
        $content = Faq::findOrFail($id);
        $content->approved = 2;
        $content->save();
        $content->reject_text = request('reject_text');
        $content->save();
        return redirect()->route('faqs.index')
            ->with('flash_message',
                'سوال مورد نظر رد شد');
    }
    
    public function destroy(Faq $id)
    {
        $id->delete();
        return redirect(route('faqs.index'))->with('flash_message','ایتم با موفقیت حذف گردید');
    }
}
