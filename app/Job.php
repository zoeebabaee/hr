<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class Job extends Model
{
    use SoftDeletes;
    protected $fillable=[
      'company_id', 'title', 'expire_date', 'approved', 'apply_limit',
        'pin_status', 'department_id', 'created_by', 'modified_by', 'created_at',
        'updated_at', 'deleted_at', 'post_id',
        'general_merites', 'professional_merites', 'cooperation_type',
        'gender', 'province_id', 'city_id', 'jobExp', 'field','api_department_id'
    ];

    protected $attributes = array(
        'apply_limit' => 0,
    );

    public static function job_search($s){
        return Job::where('approved',1)
            ->where('status',1)->
            where('expire_date', '>=',Carbon::now()->toDateTimeString())
            ->whereHas('job_professional_merites', function ($w) use($s){
            $w->where('name', 'like', '%'.$s.'%');
        })->orWhereHas('job_general_merites', function ($w) use($s) {
            $w->where('name', 'like', '%'.$s.'%');
        })->orWhere('title', 'like',  '%'.$s.'%')
            ->orWhere('main_responsibilities', 'like',  '%'.$s.'%')
            ->orWhere('job_other_features', 'like',  '%'.$s.'%')
            ->orWhere('goal_or_mission', 'like',  '%'.$s.'%');
    }

    public function post()
    {
        return $this->belongsTo('HR\JobPost', 'post_id');
    }

    public function organizational_category()
    {
        return $this->belongsTo('HR\JobOrganizationalCategory', 'organizational_category_id');
    }

    public function department()
    {
        return $this->belongsTo('HR\JobDepartment', 'department_id');
    }

    public function job_general_merites()
    {
        return $this->belongsToMany('HR\JobGeneralMerites',
            'job_has_general_merites',
            'job_id', 'general_merites_id')
            ->withPivot('value')
            ->withTimestamps();
    }

    public function job_professional_merites()
    {
        return $this->belongsToMany('HR\JobProfessionalMerites',
            'job_has_professional_merites',
            'job_id', 'professional_merites_id')
            ->withPivot('value')
            ->withTimestamps();
    }

    public function cities()
    {
        return $this->belongsToMany('HR\City',
            'job_has_cities',
            'job_id', 'city_id')
            ->withTimestamps();
    }

    public function company()
    {
        return $this->belongsTo('HR\Company', 'company_id');
    }

    public function industry()
    {
        return $this->belongsTo('HR\Industry', 'industry_id');
    }

    public function city()
    {
        return $this->belongsTo('HR\City', 'city_id');
    }

    public function province()
    {
        return $this->belongsTo('HR\Province', 'province_id');
    }

    public function creator()
    {
        return $this->belongsTo('HR\User', 'created_by');
    }

    public function users()
    {
        return $this->belongsToMany('HR\User',
            'user_favorite_jobs',
            'job_id', 'user_id')
            ->withTimestamps();
    }

    public function applies()
    {
        return $this->hasMany('HR\Apply', 'job_id');
    }

    public function questions()
    {
        return $this->hasMany('HR\JobQuestions', 'job_id');
    }

    public function apply($id)
    {
        if(Apply::all()->where('user_id',$id)->where('job_id',$this->id)->count()==0)
            return 1;
        return 0;
    }

    public function related_jobs()
    {
        $professional_merites_ids = $this->job_professional_merites->pluck('id')->toArray();
        $relatedJobs = Job::whereHas('job_professional_merites', function($q) use ($professional_merites_ids) {
            $q->whereIn('professional_merites_id', $professional_merites_ids);
            })->where('id', '<>',$this->id)
            ->orderBy('created_at')
            ->take(4)
            ->get();
        return $relatedJobs;
    }

    public function cooperation_type_name()
    {
        return ResumeContractType::find($this->cooperation_type)->name;
    }

    public function cooperation_type_color()
    {
        return ResumeContractType::find($this->cooperation_type)->color;
    }

    public static function cooperation_type_class($title)
    {
        return ResumeContractType::where('name',$title)->first()->class;
    }

    public static function active_jobs_count()
    {
        return Job::all()->where('approved',1)->where('status',1)->where('expire_date', '>=',Carbon::now()->toDateTimeString())->count();
    }

    public static function myJobs()
    {
        if(auth()->user()->hasRole('برنامه نویس') || auth()->user()->hasRole('سوپرادمین'))
        {
            return Job::where('id' ,'>=', 1);
        }
        
        $user_companies = auth()->user()->company->pluck('id')->toArray();


        return Job::whereIn('company_id',$user_companies);

    }

    public function ticket_id(){
        $ticket_id = Ticket::where('user_id', auth()->user()->id)
            ->where('job_id',$this->id)
            ->first()->id;
        return ($ticket_id)?$ticket_id:0;
    }

    function archive(){
        $this->expire_date = Carbon::now()->timezone('Asia/Tehran')->addDay(7)->toDateTimeString();
        $this->status = 3;
        $this->save();
    }

    function extend(){
        $this->expire_date = Carbon::now()->timezone('Asia/Tehran')->addDay(10)->toDateTimeString();
        $this->status = 1;
        $this->save();
    }

    function specificExtend($days){

        $this->expire_date = Carbon::now()->timezone('Asia/Tehran')->addDay($days)->toDateTimeString();
        $this->status = 1;
       return $this->save();
    }

    function is_expired(){
        $now = strtotime(Carbon::now()->timezone('Asia/Tehran')->toDateString());
        $expire_date = strtotime(Carbon::createFromFormat('Y-m-d H:i:s',$this->expire_date)->toDateString());

        return $now > $expire_date;
    }

    protected $dates = ['deleted_at'];

}
