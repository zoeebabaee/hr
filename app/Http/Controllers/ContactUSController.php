<?php

namespace HR\Http\Controllers;

use Illuminate\Http\Request;
use HR\ContactUS;
class ContactUSController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin'])->except('store','create');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = ContactUS::where('id','>=',1)->orderByDesc('created_at')->paginate(50);

        return view('admin.contacts.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('site.pages.contact');
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
            'Contact_captcha' =>'check_captcha:contact|string|max:10',
            'email' => 'nullable|email',
            'name' => 'nullable|string|max:90',
            'message' => 'required|string|max:1870',
        ]);

        $contact = new ContactUS();
        $contact->email = $request['email'];
        $contact->name = $request['name'];
        $contact->message = $request['message'];
        $contact->IP = \Illuminate\Support\Facades\Request::ip();
        $contact->save();
        return redirect()->back()->with('flash_message','پیام شما با موفقیت ارسال شد');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //
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
        //
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

    public function read($id){
        $item = ContactUS::find($id);
        if($item->read == 0) {
            $item->read = 1;
            $item->save();
        }
        return $item;
    }
}
