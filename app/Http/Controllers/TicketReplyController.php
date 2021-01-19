<?php

namespace HR\Http\Controllers;

use HR\Jobs\SendTicketFromAdminAlert;
use HR\Mail\TicketFromAdminAlert;
use HR\Ticket;
use HR\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class TicketReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','isAdmin'])->except(['store']);
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "ticket_id" => 'required|exists:tickets,id',
            "body" => 'nullable|string|min:1|max:50000',
            "status" => 'sometimes|required|string|max:25'
        ]);


        $ticket = Ticket::find($request['ticket_id']);

        if(isset($request['status']))
            $ticket->status = $request['status'];
        else {
            $ticket->status = 'user_reply';
            if($ticket->user_id != auth()->user()->id)
                abort(404);
        }

        $ticket->save();

        if(isset($request['body']) && !empty($request['body'])) {
            $ticket_reply = new TicketReply();
            $ticket_reply->ticket_id = $request['ticket_id'];
            $ticket_reply->body = $request['body'];
            $ticket_reply->user_id = auth()->user()->id;
            $ticket_reply->save();
            if(!empty($ticket->user->email) && is_null($ticket->user->is_email_verified))
            {
                $email = new TicketFromAdminAlert($ticket);
                Mail::to($ticket->user->email)->send($email);
            }
            return redirect()->back()
                ->with('flash_message',
                    'پاسخ تیکت ارسال گردید.');
        }

        return redirect(route('tickets.index'))
            ->with('flash_message',
                'وضعیت تیکت با موفقیت تغییر کرد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \HR\TicketReply  $ticketReply
     * @return \Illuminate\Http\Response
     */
    public function show(TicketReply $ticketReply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \HR\TicketReply  $ticketReply
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketReply $ticketReply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \HR\TicketReply  $ticketReply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketReply $ticketReply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \HR\TicketReply  $ticketReply
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketReply $ticketReply)
    {
        //
    }
}
