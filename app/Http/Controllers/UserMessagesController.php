<?php

namespace HR\Http\Controllers;

use Illuminate\Http\Request;
use HR\Message;
use HR\Job;
use Auth;
use Carbon\Carbon;

class UserMessagesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('isMobileVerified');
    }

    public function inbox(Request $request)
    {
        $messages =Message::where('receiver',Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('site.pages.user.messages.inbox',compact('messages'));
    }

    public function sent()
    {
        $messages =Message::where('sender',Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('site.pages.user.messages.sent',compact('messages'));
    }

    public function trash()
    {
        $messages =Message::onlyTrashed()->where(function($q){
            $q->where('sender',Auth::user()->id)
                ->orWhere('receiver',Auth::user()->id);
        })->orderBy('created_at','desc')->get();
        return view('site.pages.user.messages.trash',compact('messages'));
        ;
    }


    public function reply($id)
    {
        $message = Message::findOrFail($id);
        $messages =Message::all()->where('receiver',Auth::user()->id);
        return view('site.pages.user.messages.reply',compact(['messages','message']));
    }

    function store(Request $request)
    {

        $this->validate($request,[
            'receiver'=>'integer',
            'subject'=>'string',
        ]);
        $msg = new Message();
        $msg->sender = Auth::user()->id;
        $msg->receiver = $request['receiver'];
        $msg->subject = $request['subject'];
        $msg->body = $request['body1']."<br><br>-------------------------------------------------------<br>". str_replace("\n",'<br>',$request['body2']);
        $msg->body = str_replace("<br><br>",'<br>',$msg->body);
        $msg->ref = 'user_reply';
        $msg->ref_id = Auth::user()->id;
        $msg->save();
        return redirect()->route('user.messages.inbox')
            ->with('flash_message',
                'پیام با موفقیت ارسال شد');
    }

    function compose(Request $request)
    {
        $this->validate($request,[
            'body'=>'string|max:1900',
            'subject'=>'string|max:100',
            'job' => 'exists:jobs,id'
        ]);
        $msg = new Message();
        $msg->sender = Auth::user()->id;
        $msg->receiver = Job::find($request['job'])->company->users->first()->id;
        $msg->subject = $request['subject'];
        $msg->body = $request['body'];
        $msg->save();

        return redirect()->route('user.messages.sent')
            ->with('flash_message',
                'پیام با موفقیت ارسال شد');
    }

    public function show($id)
    {
        $message = Message::withTrashed()->findOrFail($id);
        $message->read_at = Carbon::now()->toDateTimeString();
        $message->save();
        return view('site.pages.user.messages.show',compact(['message']));
    }

    public function destroy($id)
    {
        Message::findOrFail($id)->delete();
        return redirect()->back()
            ->with('flash_message',
                'پیام با موفقیت حذف شد');
    }

    public function restore($id)
    {
        Message::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->back()
            ->with('flash_message',
                'پیام با موفقیت بازیابی شد');
    }

}
