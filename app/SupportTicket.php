<?php


namespace HR;


use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $fillable = [
        'status', 'priority', 'subject', 'body',
        'user_id', 'company_id','created_by'
    ];

    public function user(){
        return $this->belongsTo('HR\User', 'user_id');
    }

    public function company(){
        return $this->belongsTo('HR\Company', 'company_id');
    }

    public function creator(){
        return $this->belongsTo('HR\User', 'created_by');
    }

    public function replies()
    {
        return $this->hasMany('HR\SupportTicketReply','ticket_id');
    }
     public function getPersianSubjectAttribute()
    {
            switch ($this->subject) {
              case "technical_problem_box":
                $subj = "مشکل فنی در تکمیل رزومه";
                break;
              case "defect_information_box":
                $subj ="افزودن اطلاعات تحصیلی به سامانه";
                break;
              case "suggestions_box":
               $subj ="انتقادات و پیشنهادات";
                break;
                
              case "review_user_resume_box":
                $subj ="مشکل در برقراری ارتباط با شرکت ها";
                break;
              default:
                $subj ="";
            }
            
            return $subj;
    } 
    
}