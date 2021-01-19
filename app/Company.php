<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'name',
            'home_page_url',
            'logo',
            'body',
            'address',
            'phone',
            'LatLng',
            'gig_company_id'
        ];
    public function users()
    {
        return $this->belongsToMany('HR\User',
            'user_has_companies')
            ->withTimestamps();
    }

    public function jobs()
    {
        return $this->hasMany('HR\Job','company_id');
    }

    public function branches()
    {
        return $this->hasMany('HR\Branch');
    }

    public function tickets()
    {
        return $this->hasMany('HR\Ticket','user_id');
    }
    
    public static function myCompanies()
    {
        
        if(auth()->user()->hasRole('برنامه نویس'))
        {
            return Company::all();
        }
        if(auth()->user()->hasRole('سوپرادمین'))
        {
            return Company::all();
        }
        
        return auth()->user()->company;
        
    }

    public function get_gig_data(){
        $data = null;
        if(intval($this->gig_company_id))
        {
            try {
                $data = json_decode(file_get_contents("http://golrang.com/api/get-companies?company_list=[%22" . $this->gig_company_id . "%22]"), 1);
            }catch (\Exception $exception){
                return null;
            }
            if(!is_null($data) && $data['status'])
                $data = $data['data']['companies'][0];
            $data['logo'] = 'https://golrang.com'.$data['logo'];
        }

        return $data;
    }
}
