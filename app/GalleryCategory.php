<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    protected $fillable = ['name','created_by'];

    public function images()
    {
        return $this->hasMany('HR\Gallery', 'cat_id');
    }

    public static function myGalleryCategory()
    {
        if(auth()->user()->hasRole('برنامه نویس') || auth()->user()->hasRole('سوپرادمین'))
        {
            return GalleryCategory::where('id' ,'>=', 1);
        }
        $user_companies = auth()->user()->company;
        $friends = array(auth()->user()->id);
        foreach ($user_companies as $company)
        {
            foreach ($company->users->pluck('id')->toArray() as $item)
                array_push($friends, $item);
        }
        //dd(array_unique($friends));
        return GalleryCategory::whereIn('created_by',$friends);

    }
}
