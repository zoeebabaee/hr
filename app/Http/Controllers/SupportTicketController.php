<?php


namespace HR\Http\Controllers;


use HR\Company;
use HR\SupportTicket;
use HR\User;
use HR\SupportTicketReply;
use http\Env\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use HR\Mail\SupportTicketAlert;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;



class SupportTicketController extends Controller
{
    
        public function __construct()
    {
        $this->middleware(['auth', 'isSuperAdmin']);
    }

    public function index()
    {
        die(json_encode(SupportTicket::get()));
    }

    public function storeTicket()
    {
        $input = Input::all();
        

       if(strtolower($input['captcha']) != strtolower(session()->get('support_ticket_captcha'))){
            return
                'کد امنیتی اشتباه است';
        }
        $new_ticket = new SupportTicket();
        $new_ticket->email      = $input['email'];
        $new_ticket->subject= $input['ticket_type'];
        $new_ticket->company_id = $input['company_name'];
        $new_ticket->user_id = Auth::user()->id;
        $new_ticket->created_by = Auth::user()->id;
        $new_ticket->body    = $input['detail'];
        $new_ticket->status    = 'open';
        $new_ticket->save();
        $id = DB::getPdo()->lastInsertId();
        
        //todo
        // $creator_detail = User::where('id',108738)->first();
         $full_name = Auth::user()->first_name.' '.Auth::user()->last_name;
         
        $user = User::where('id',Auth::user()->id)->first();
        //$user = User::where('id',108)->first();
        $email = new SupportTicketAlert($new_ticket,$user);
        Mail::to($new_ticket->email)->send($email);
        
        if($input['ticket_type'] != 'technical_problem_box')
        {
            $superadmin = User::where('id',34)->first();
            $superadmin_email = new SupportTicketAlert($new_ticket,$superadmin);
            Mail::to($superadmin->email)->send($superadmin_email);
        }
        else
        {
            $superadmin = User::where('id', 108738)->first();
            $superadmin_email = new SupportTicketAlert($new_ticket,$superadmin);
            Mail::to($superadmin->email)->send($superadmin_email);
        }
        die($id);


    }  
    public function storeTicketReply()
    {
        $input = Input::all();
        $new_ticket = new SupportTicketReply();
        $new_ticket->ticket_id= $input['ticket_id'];
        $new_ticket->user_id = Auth::user()->id;
        $new_ticket->body    = strip_tags($input['body']);
        $new_ticket->save();
        
        
        $ticket = SupportTicket::where('id',$input['ticket_id'])->first();
        $ticket->status    = 'closed';
        $ticket->save();
        
        $user = User::where('id',$ticket->user_id)->first();
        $email = new SupportTicketAlert($ticket,$user);
        Mail::to($ticket->email)->send($email);

         return redirect()->back()
                ->with('flash_message',
                    'پاسخ تیکت ارسال گردید.');


    }

    public function adminTickets()
    {
        $type = 'technical_problem_box';
        if (auth()->user()->hasRole('برنامه نویس')||  auth()->user()->hasRole('سوپرادمین')) {
            $tickets = SupportTicket::where('subject', 'not like', $type)->get();
            $companies = Company::pluck('name','id')->toArray();

        }


        else if (auth()->user()->hasRole('ادمین'))
        {
            $companies = auth()->user()->company;
            $admin_tickets = SupportTicket::where('subject', 'not like', $type);
            $tickets = $admin_tickets->WhereIn('company_id', $companies)->get();

        }
        return view('admin.supportTicket.index', compact('tickets','companies'));


    }

    public function technicalTickets()
    {
        $type = 'technical_problem_box';
        $tickets = SupportTicket::where('subject','like',$type)->get();
        $companies = auth()->user()->company->pluck('id')->toArray();

       // die(json_encode($tickets));
        return view('admin.supportTicket.index', compact('tickets','companies'));
    }
    
    public function defectTickets()
    {
        $type = 'defect_information_box';
        $tickets = SupportTicket::where('subject','like',$type)->get();
        $companies = auth()->user()->company->pluck('id')->toArray();

        //die(json_encode($tickets));
        return view('admin.supportTicket.index', compact('tickets','companies'));
    } 
    
    public function suggestionTickets()
    {
        $type = 'suggestions_box';
        $tickets = SupportTicket::where('subject','like',$type)->get();
        $companies = auth()->user()->company->pluck('id')->toArray();

        //die(json_encode($tickets));
        return view('admin.supportTicket.index', compact('tickets','companies'));
    }
    
    public function show($id)
    {
        if (auth()->user()->hasRole('سوپرادمین'))
        {
            $ticket = SupportTicket::where('id',$id)->first();
      
            $reply = SupportTicketReply::where('ticket_id',$id)->get();
            //die(json_encode($reply));
           // die(json_encode($ticket));
            return view('admin.supportTicket.show', compact(['ticket', 'reply']));

        }
    }

}