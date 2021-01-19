<?php

namespace HR;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use HasRoles;

    public function company()
    {
        return $this->belongsToMany('HR\Company',
            'user_has_companies')
            ->withTimestamps();
    }

    public function ResumeWorkExperience()
    {
        return $this->belongsTo('HR\ResumeWorkExperience');
    }

    public static function related_jobs($user)
    {
        $departments = array();

        if($user->resume->departments)
            $departments = $user->resume->departments->pluck('id')->toArray();

        $now = Carbon::now()->timezone('Asia/Tehran')->toDateTimeString();

        $jobs = Job::where('approved', 1)->where('status', 1)
            ->where('expire_date', '>=', $now)
            ->whereIn('department_id', $departments)->get();

        return $jobs;

    }

    public function owner()
    {
        return $this->belongsToMany('HR\Company',
            'company_has_users','user_id','company_id')
            ->withTimestamps();
    }

    public function smses()
    {
        return $this->hasMany('HR\SMS');
    }

    public function received_messages()
    {
        return $this->hasMany('HR\Message','receiver');
    }

    public function jobs()
    {
        return $this->belongsToMany('HR\Job',
            'user_favorite_jobs',
            'user_id','job_id')
            ->withTimestamps();
    }

    public function jobs_created()
    {

    }

    public function profile()
    {
        return $this->hasOne('HR\UserProfile','user_id');
    }

    public function resume()
    {
        return $this->hasOne('HR\Resume','user_id');
    }

    public function applies()
    {
        return $this->hasMany('HR\Apply','user_id');
    }

    public function tickets()
    {
        return $this->hasMany('HR\Ticket','user_id');
    }
    
     public function supporttickets()
    {
        return $this->hasMany('HR\SupportTicket','user_id');
    }

    public function getAvatarAttribute($value)
    {
        if(!is_null($value) && !empty($value) &&  Storage::disk('uploads')->exists($value))
            return $value;
        else
            return '/golrangsystem-file-manager/photos/1/default/noimage_profile.png';

    }

    public function userComments()
    {
        return $this->hasMany('HR\UserComment','user_id');
    }

    public function mobile_confirm()
    {
        return $this->hasOne('HR\MobileConfirm','user_id');
    }

    public function referrer_company(){
        return $this->belongsTo('HR\Company','referrer_company_id');
    }

    public static function myUsers()
    {

        if(auth()->user()->hasAnyRole('برنامه نویس|سوپرادمین'))
        {
            return User::where('id', '>=', 1);
        }

        $companies = auth()->user()->company->pluck('id')->toArray();


        $users =  User::where(function ($query) use ($companies){
            $query->Where('users.created_at','<',Carbon::now()->timezone('Asia/Tehran')->subMonth(2)->toDateTimeString())
            ->orWhereHas('owner', function ($q) use ($companies){
                $q->whereIn('company_has_users.company_id', $companies);
            });
        });

        return $users;
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'mobile','password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = ['deleted_at'];

}
