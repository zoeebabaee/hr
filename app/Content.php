<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;

    public function tags()
    {
        return $this->belongsToMany('HR\Tag', 'content_has_tag')
            ->withTimestamps();
    }

    public function groups()
    {
        return $this->belongsToMany('HR\contentGroup',
            'contents_has_groups',
            'content_id', 'group_id')
            ->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo('HR\ContentCategory', 'cat_id');
    }

    public function user()
    {
        return $this->belongsTo('HR\User', 'created_by');
    }

    public static function getContents()
    {
        $parents = Content::all()->toArray();
        $result = array();
        foreach ($parents as $item) {
            $tmp['value'] = $item['title'];
            $tmp['id'] = $item['id'];
            $result[] = $tmp;
        }
        return $result;
    }

    public function getCompany()
    {
        $user = User::find($this->created_by);
        return $user->company();
    }

    public function comments()
    {
        return $this->hasMany('HR\ContentComment');
    }

    public static function content_search($qurey, $cat_id)
    {
        if($cat_id != 10)
            return Content::whereHas('tags', function ($w) use ($qurey) {
            $w->where('name', 'like', '%' . $qurey . '%');
        })->orWhere('title', 'like', "%$qurey%")->where('cat_id', $cat_id)
            ->orWhere('body', 'like', "%$qurey%")->where('cat_id', $cat_id);
        else
            return Content::whereHas('tags', function ($w) use ($qurey) {
                $w->where('name', 'like', '%' . $qurey . '%');
            })->orWhere('title', 'like', "%$qurey%")->where('cat_id', $cat_id)->orWhere('cat_id',14)
                ->orWhere('body', 'like', "%$qurey%")->where('cat_id', $cat_id)->orWhere('cat_id',14);
    }

    public static function content_tag_search($qurey, $cat_id)
    {
        $tag = Tag::where('name',$qurey)->first();
        if($tag)
            return $tag->contents()->where('cat_id', $cat_id);
        return null;
    }

    public static function myContents()
    {
        if(auth()->user()->hasRole('برنامه نویس') || auth()->user()->hasRole('سوپرادمین'))
        {
            return Content::where('id' ,'>=', 1);
        }
        $user_companies = auth()->user()->company;
        $friends = array(auth()->user()->id);
        foreach ($user_companies as $company)
        {
            foreach ($company->users->pluck('id')->toArray() as $item)
                array_push($friends, $item);
        }
        //dd(array_unique($friends));
        return Content::whereIn('created_by',$friends);

    }


    protected $fillable = [
        'title', 'alias', 'body', 'status', 'comment_status', 'start_publish',
        'end_publish', 'cat_id', 'meta_description', 'meta_keywords',
        'external_references', 'content_rights', 'label_active', 'label_text',
        'main_image', 'banner_image','l_image','xl_image','xxl_image'
    ];

    protected $dates = ['deleted_at'];
}
