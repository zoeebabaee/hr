<?php

namespace HR\Http\Controllers;

use HR\Company;
use HR\Jobs\SendTicketFromAdminAlert;
use HR\Mail\TicketFromAdminAlert;
use HR\Ticket;
use HR\TicketReply;
use HR\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','isAdmin'])->except(['site_show','site_index','site_store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_ids = auth()->user()->company->pluck('id')->toArray();
        $companies = null;
        $tickets = Ticket::Where('id','>=',1);

        if (!auth()->user()->hasRole('برنامه نویس') && !auth()->user()->hasRole('سوپرادمین')) {
            $companies = auth()->user()->company->pluck('name','id')->toArray();
            $tickets = $tickets->WhereIn('company_id', $company_ids);
        }
        else {
            $companies = Company::pluck('name','id')->toArray();
        }

        if(isset($_GET['company_id']) && !empty($_GET['company_id'])){
            $tickets = $tickets->where('company_id',$_GET['company_id']);
        }

        if(isset($_GET['priority']) && !empty($_GET['priority'])){
            $tickets = $tickets->where('priority',$_GET['priority']);
        }

        if(isset($_GET['status']) && !empty($_GET['status'])){
            $tickets = $tickets->where('status',$_GET['status']);
        }

        $tickets = $tickets->orderBy('status')
            ->orderBy('priority')
            ->orderBy('updated_at', 'desc')
            ->paginate(20);


        return view('admin.tickets.index', compact(['tickets','companies']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$job_id = null)
    {
        $user = User::find($id);

        return view('admin.tickets.create', compact(['user','job_id']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "subject" => 'required|string|min:1|max:255',
            "company_id" => 'required|exists:companies,id',
            "body" => 'required|string|min:1|max:50000',
            "priority" => 'required|string|min:1|max:50000',
        ]);

        $ticket = new Ticket();

        $ticket->status = 'answered';
        $ticket->priority = $request['priority'];
        $ticket->subject = $request['subject'];
        $ticket->body = $request['body'];
        $ticket->user_id = $request['user_id'];
        $ticket->job_id = $request['job_id'];
        $ticket->company_id = $request['company_id'];
        $ticket->created_by = auth()->user()->id;
        if ($ticket->save()) {
            if(!empty($ticket->user->email) && is_null($ticket->user->is_email_verified))
            {
                $email = new TicketFromAdminAlert($ticket);
                Mail::to($ticket->user->email)->send($email);
            }

            return redirect(route('tickets.index'))
                ->with('flash_message',
                    'تیکت جدید ایجاد گردید.');
        }
        return redirect()->back()
            ->withErrors(['خطا در ذخیره اطلاعات']);

    }


    public function site_store(Request $request)
    {
        $this->validate($request, [
            "subject" => 'required|string|min:1|max:255',
            "company_id" => 'required|exists:companies,id',
            "body" => 'required|string|min:1|max:50000',
            "priority" => 'required|string|min:1|max:50000',
        ]);

        $ticket = new Ticket();

        $ticket->status = 'user_reply';
        $ticket->priority = $request['priority'];
        $ticket->subject = $request['subject'];
        $ticket->body = $request['body'];
        $ticket->user_id = auth()->user()->id;
        $ticket->company_id = $request['company_id'];
        $ticket->job_id = $request['job_id'];
        $ticket->created_by = auth()->user()->id;
        if ($ticket->save())
            return redirect(route('site.tickets.index'))
                ->with('flash_message',
                    'تیکت جدید ایجاد گردید.');

        return redirect()->back()
            ->withErrors(['خطا در ذخیره اطلاعات']);

    }
    /**
     * Display the specified resource.
     *
     * @param  \HR\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companies = auth()->user()->company->pluck('id')->toArray();
        if (auth()->user()->hasRole('برنامه نویس') || auth()->user()->hasRole('سوپرادمین'))
            $ticket = Ticket::find($id);
        else
            $ticket = Ticket::Where('id', $id)->Wherein('company_id', $companies)->first();

        if (!$ticket)
            return redirect()->back()
                ->withErrors(['دسترسی غیر مجاز']);

        $ticket_replies = TicketReply::where('ticket_id',$id)->orderBy('id','desc')->get();
        return view('admin.tickets.show', compact(['ticket', 'ticket_replies']));
    }

    public function site_show($id){
        $ticket_replies = null;
        $ticket = Ticket::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if($ticket)
            $ticket_replies = TicketReply::where('ticket_id',$id)->orderBy('id','desc')->get();
        else
            abort(404);

        return view('site.tickets.show',compact(['ticket_replies','ticket']));
    }

    public function site_index(){
        $tickets = Ticket::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('site.tickets.index',compact(['tickets']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \HR\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \HR\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \HR\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function close($ticket_id)
    {
        $ticket = Ticket::find($ticket_id);
        $ticket->status = 'closed';
        $ticket->save();
        return $ticket;
    }
    public function site_close($ticket_id)
    {
        $ticket = Ticket::find($ticket_id);
        $ticket->status = 'closed';
        $ticket->save();
        return redirect(route('site.tickets.index'))
            ->with('flash_message',
                'تیکت مورد نظر بسته شد.');
    }

}
