<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function contents()
    {
        return $this->belongsToMany('HR\Content','content_has_tag')
            ->withTimestamps();
    }
    public function books()
    {
        return $this->belongsToMany('HR\BookIntroduction','books_has_tags','tag_id','book_introduction_id')
            ->withTimestamps();
    }

    public static function get_book_tags_sorted()
    {
        $result = array();
        foreach (Tag::where('id','>=',1)->whereHas('books',function ($w){
            $w->where('id','>=', 1);
        })->limit(100)->get() as $tag)
            $result[$tag->name] =  $tag->books()->count() + $tag->contents()->count();
        arsort($result);
        return $result;
    }
    public static function get_all_sorted()
    {
        $result = array();
        foreach (Tag::where('id','>=',1)->limit(100)->get() as $tag)
            $result[$tag->name] =  $tag->contents()->count() + $tag->books()->count();
        arsort($result);
        return $result;
    }

    protected $fillable = [
        'name'
    ];
}
