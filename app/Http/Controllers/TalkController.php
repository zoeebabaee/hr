<?php

namespace HR\Http\Controllers;

use HR\myDate;
use HR\myFuncs;
use HR\Talk;
use HR\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TalkController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
        ini_set('memory_limit', '-1');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $chat_session = myFuncs::quickRandom(30);
        $user = User::find(auth()->user()->id);
        $user->chat_session = $chat_session;
        $user->save();

        if ($id == null)
            $talks = Talk::where('to', null)->get();
        else
            $talks = Talk::where('from', $id)->where('to', auth()->user()->id)->get()
                ->merge(Talk::where('to', $id)->where('from', auth()->user()->id)->get());
        $talks = $talks->sortBy('id');
        $talks = $talks->slice(0, 100);

        #seen messages
        $talks_ids_array = $talks->where('from', '!=', auth()->user()->id)->pluck('id')->toArray();
        Talk::whereIn('id', $talks_ids_array)
            ->update(['seen' => 1]);


        $users = User::role('سوپرادمین')->get()
            ->merge((User::role('برنامه نویس')->get()))
            ->merge((User::permission('پنل ادمین')->get()));

        $users_ids = array_unique($users->pluck('id')->toArray());
        $users_ids_sorted = DB::select('SELECT DISTINCT(users.id) FROM`users`,`talks` WHERE((users.id = talks.from OR users.id = talks.to)AND(talks.from = ' . auth()->user()->id . ' OR talks.to = ' . auth()->user()->id . ')) ORDER BY talks.id asc');


        $tmp1 = array();
        $tmp = array();
        foreach ($users_ids_sorted as $item) {
           /* $tmp[$item->id] = $users->where('id', $item->id)->first();
            $tmp1[] = $item->id;*/
            
            if($users->where('id', $item->id)->first() != null)
            {

                $tmp[$item->id] = $users->where('id', $item->id)->first();
                $tmp1[] = $item->id;
            }
            else
                continue;
        }
        $top_users = $tmp;

        $users_ids = array_diff($users_ids, $tmp1);

        $tmp = array();
        foreach ($users_ids as $item) {
            $tmp[$item] = $users->where('id', $item)->first();
        }
        $another_users = $tmp;

        $chat_with = is_null($id) ? null : User::findOrFail($id);
        if ($id == null)
            $chat_with = 'گفتگو عمومی';
        else
            $chat_with = $chat_with->first_name . ' ' . $chat_with->last_name;

        $unread_messages_list = DB::table('talks')
            ->select('id', 'from', 'to', 'seen', DB::raw('count(id) as message_count'))
            ->where('to', auth()->user()->id)
            ->where('seen', 0)
            ->groupBy('from')
            ->pluck('message_count', 'from')->toArray();

        return view('site.talks.index', compact(['talks', 'top_users', 'another_users', 'id', 'chat_with', 'unread_messages_list', 'chat_session']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($to = null, Request $request)
    {
        $this->validate($request, [
            'message' => 'required|string|min:1'
        ]);

        Talk::send(auth()->user()->id, $to, $request['message'], 'txt');

        return 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  \HR\Talk $talk
     * @return \Illuminate\Http\Response
     */
    public function show(Talk $talk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \HR\Talk $talk
     * @return \Illuminate\Http\Response
     */
    public function edit(Talk $talk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \HR\Talk $talk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Talk $talk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \HR\Talk $talk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Talk $talk)
    {
        //
    }

    public function refresh($msg_id, $chat_id = null)
    {
        $user = User::find(auth()->user()->id);

        if (!isset($_GET['chat_session']) || $_GET['chat_session'] != $user->chat_session)
            return 'invalid_chat_session';


        if ($chat_id == null)
            $talks = Talk::where('to', null)->get();
        else
            $talks = Talk::where('from', $chat_id)->where('to', auth()->user()->id)->get()
                ->merge(
                    Talk::where('to', $chat_id)->where('from', auth()->user()->id)->get()
                );

        #seen messages
        $talks_ids_array = $talks->where('from', '!=', auth()->user()->id)->pluck('id')->toArray();
        Talk::whereIn('id', $talks_ids_array)
            ->update(['seen' => 1]);

        $result = array();
        $result['messages'] = array();
        $result['seen_status'] = $talks->pluck('seen', 'id')->toArray();
        $talks = $talks->where('id', '>', $msg_id);
        foreach ($talks as $talk) {
            $tmp = array();
            $tmp['id'] = $talk->id;
            $tmp['name'] = $talk->sender->first_name . ' ' . $talk->sender->last_name;
            $tmp['avatar'] = $talk->sender->avatar;
            $tmp['date'] = myDate::createFromCarbon(Carbon::parse($talk->created_at))->format('l j F , H:i');
            $tmp['msg'] = str_replace("\n", "<br>", $talk->msg);
            if (auth()->user()->id == $talk->from)
                $tmp['dir'] = 'left';
            else
                $tmp['dir'] = 'right';
            $result['messages'][] = $tmp;
        }

        $result['unread_messages'] = DB::table('talks')
            ->select('id', 'from', 'to', 'seen', DB::raw('count(id) as message_count'))
            ->where('to', auth()->user()->id)
            ->where('seen', 0)
            ->groupBy('from')
            ->pluck('message_count', 'from')->toArray();


        $unread_messages_created_at = DB::table('talks')
            ->select('id', 'from', 'to', 'seen', DB::raw('UNIX_TIMESTAMP(max(created_at)) as max'))
            ->where('to', auth()->user()->id)
            ->groupBy('from')
            ->pluck('max', 'from')->toArray();
        $result['unread_messages_created_at'] = array();
        foreach ($unread_messages_created_at as $key => $item) {
            $result['unread_messages_created_at'][$key] = $item;
        }

        return $result;
    }

}
