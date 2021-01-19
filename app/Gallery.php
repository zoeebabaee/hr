<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Gallery extends Model
{
    protected $fillable = ['name','body','img','link','cat_id'];

    public function category()
    {
        return $this->belongsTo('HR\GalleryCategory', 'cat_id');
    }
    public function getCreatedAtAttribute($value)
    {
        return myDate::createFromCarbon(Carbon::parse($value))->format('Y/m/d');
    }

    public static function myGallery()
    {
        if(auth()->user()->hasRole('برنامه نویس') || auth()->user()->hasRole('سوپرادمین'))
        {
            return Gallery::where('id' ,'>=', 1);
        }
        $user_companies = auth()->user()->company;
        $friends = array(auth()->user()->id);
        foreach ($user_companies as $company)
        {
            foreach ($company->users->pluck('id')->toArray() as $item)
                array_push($friends, $item);
        }
        //dd(array_unique($friends));
        return Gallery::whereIn('created_by',$friends);

    }

}
