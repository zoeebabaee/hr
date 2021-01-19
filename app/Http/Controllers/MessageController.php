<?php

namespace HR\Http\Controllers;

use Carbon\Carbon;
use HR\Job;
use HR\Message;
use HR\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin'])->except(['company_msg']);
    }

    public function inbox()
    {
        $messages =Message::where('receiver',Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('admin.messages.inbox',compact('messages'));
    }

    public function sent()
    {
        $messages =Message::where('sender',Auth::user()->id)->orderBy('created_at','desc')->get();

        return view('admin.messages.sent',compact('messages'));
    }

    public function trash()
    {
        $messages =Message::onlyTrashed()->where(function($q){
            $q->where('sender',Auth::user()->id)
                ->orWhere('receiver',Auth::user()->id);
        })->orderBy('created_at','desc')->get();
        return view('admin.messages.trash',compact('messages'));
    }

    public function compose($id,$ref,$ref_id)
    {
        $user = User::findOrFail($id);
        return view('admin.messages.compose',compact(['user','ref','ref_id']));
    }

    public function reply($id)
    {
        $message = Message::findOrFail($id);
        $messages =Message::all()->where('receiver',Auth::user()->id);
        return view('admin.messages.reply',compact(['messages','message']));
    }

    public function company_msg(Request $request,$job_id)
    {
        $job = Job::Find($job_id);
        $users = $job->company->users->pluck('id')->toArray();
        foreach ($users as $user) {
            $msg = new Message();
            $msg->sender = Auth::user()->id;
            $msg->receiver = $user;
            $msg->subject = $request['subject'];
            $msg->body = str_replace("\n", '<br>', $request['body']);
            $msg->body = str_replace("<br><br>", '<br>', $msg->body);
            $msg->ref = 'job';
            $msg->ref_id = $job_id;
            $msg->save();
        }
        return redirect()->back()
            ->with('flash_message',
                'پیام با موفقیت ارسال شد');
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
        $msg->body = str_replace("\n",'<br>',$request['body']);
        $msg->body = str_replace("<br><br>",'<br>',$msg->body);
        $msg->attachment = $request['attachment'];
        $msg->ref = $request['ref'];
        $msg->ref_id = $request['ref_id'];
        $msg->save();

        return redirect()->route('messages.inbox')
            ->with('flash_message',
                'پیام با موفقیت ارسال شد');
    }

    public function show($id)
    {
        $message = Message::withTrashed()->findOrFail($id);
        $message->read_at = Carbon::now()->toDateTimeString();
        $message->save();
        $messages =Message::all()->where('receiver',Auth::user()->id);
        return view('admin.messages.show',compact(['message','messages']));
    }

    public function destroy($id)
    {
        Message::findOrFail($id)->delete();
        return redirect()->route('messages.inbox')
            ->with('flash_message',
                'پیام با موفقیت حذف شد');
    }

    public function restore($id)
    {
        Message::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('messages.inbox')
            ->with('flash_message',
                'پیام با موفقیت بازیابی شد');
    }
}
