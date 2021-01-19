<?php

namespace HR\Http\Controllers;

use Carbon\Carbon;

use HR\Ticket;
use HR\TicketReply;
use Illuminate\Support\Facades\DB;
use HR\myFuncs;
use p3ym4n\JDate\JDate;







class ReportTicketController extends Controller
{

    public function __construct()
    {
        
    }
    public function index()
    {
        $ticket_has_answers = DB::select('
        select * from tickets
        join ticket_replies on tickets.id = ticket_id
/*        where created_by not in (select model_id from model_has_roles) 
*/        ORDER BY `ticket_replies`.`created_at` ASC

        
        ');
        
        foreach($ticket_has_answers as $ticket_has_answer)
        {
            var_dump($ticket_has_answer->ticket_id);
           /* if($ticket_has_answer->ticket_id == 262)
            var_dump(DB::select('
        select * from ticket_replies
        where ticket_id = 262
        '));
        else continue;*/
        }
    }
    
    public function dd()
    {
        $tickets = DB::select('
        select tickets.*,companies.name as company_name,jobs.title as job_name from tickets 
        /*left join model_has_roles on model_id = created_by
        join roles on roles.id = role_id*/
        join jobs on jobs.id= job_id
        join companies on companies.id = tickets.company_id
        where tickets.created_by is not null
        
        
        ');
        
        
        $line_counter = 1;
        $body = array();
        $header = [
            'ردیف',
            'شرکت',
            'آگهی',
            'وضعیت',
            'موضوع',
            'نوع کاربر',
            'تاریخ',
            'تیکت',

            
      
        ];
           for($i=0;$i<6;$i++)
            {
                array_push(
                    $header,' '
                    ,'نوع کاربر'
                    ,'تاریخ'
                    ,'تیکت');
            }
        
        foreach($tickets as $ticket)
        {
            $role = DB::select('
        select roles.name from model_has_roles 
        join roles on roles.id = role_id
        where model_id = '.$ticket->created_by.'
        
        ');
        
        if(count($role) < 1)
            $userrole = 'کاربر';
        else
            $userrole = $role[0]->name ;
            
        
            switch ($ticket->status) {
              case "user_reply":
                $status = "پاسخ کاربر";
                break;
              case "open":
                $status = "باز";
                break;
              case "on_hold":
                $status = "در انتظار";
                break;
              case "answered":
                $status = "پاسخ داده شده";
                break;
              case "closed":
                $status = "بسته شده";
                break; 
                
              case "in_progress":
                $status = "در جریان";
                break;    
                
              default:
                echo "";
            }
            
           /* switch ($ticket->status) {
              case "user_reply":
                $status = "پاسخ کاربر";
                break;
              case "open":
                $status = "باز";
                break;
              case "on_hold":
                $status = "در انتظار";
                break;
              case "answered":
                $status = "پاسخ داده شده";
                break;
              case "closed":
                $status = "بسته شده";
                break; 
                
              case "in_progress":
                $status = "در جریان";
                break;    
                
              default:
                echo "";
            }*/
             $ticket_replies = DB::select('
                select * from ticket_replies where ticket_id = '.$ticket->id.'
                ORDER BY `ticket_replies`.`created_at` ASC
        
            ');
            
     
        
        $body = [
                $line_counter++,
                $ticket->company_name,
                $ticket->job_name,
                $status,
                $ticket->subject,
                $userrole,
                JDate::createFromCarbon(Carbon::parse($ticket->created_at))->format('Y/m/d - H:i:s'),
                // $ticket->created_at,
                strip_tags($ticket->body),
                
            ];
            
            
           // die(json_encode($ticket_replies));

        if(count($ticket_replies)>1)
        {
            foreach ($ticket_replies as $ticket_reply) {
                
                     $role = DB::select('
                            select roles.name from model_has_roles 
                            join roles on roles.id = role_id
                            where model_id = '.$ticket_reply->user_id.'
                            
                            ');
                            
                            if(count($role) < 1)
                                $userrole = 'کاربر';
                            else
                                $userrole =  $role[0]->name ;
                
                array_push($body,'',$userrole,
                JDate::createFromCarbon(Carbon::parse($ticket_reply->created_at))->format('Y/m/d - H:i:s'),strip_tags($ticket_reply->body));
                }
                

        

        }
        else if(count($ticket_replies) == 1)
        {
            $role = DB::select('
                            select roles.name from model_has_roles 
                            join roles on roles.id = role_id
                            where model_id = '.$ticket_replies[0]->user_id.'
                            
                            ');
                            
                            if(count($role) < 1)
                                $userrole = 'کاربر';
                            else
                                $userrole =  $role[0]->name ;
            array_push($body,'',$userrole,JDate::createFromCarbon(Carbon::parse($ticket_replies[0]->created_at))->format('Y/m/d - H:i:s'),strip_tags($ticket_replies[0]->body));
        }
        else
            array_push($body,'','','','');

        $res[] = $body;
 
        }

        myFuncs::export_to_csv($header, $res, 'tickets');

    }
    
}