<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BookIntroduction extends Model
{
    protected $fillable = [
        'author', 'book_name', 'release_date', 'publication_name', 'body', 'img', 'slug'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function setReleaseDateAttribute($value)
    {
        $this->attributes['release_date'] = myDate::createFromFormat('Y/m/d', $value)->carbon->toDateString();
    }
    public function getReleaseDateAttribute($value)
    {
        return myDate::createFromCarbon(Carbon::parse($value))->format('Y/m/d');
    }

    public function tags()
    {
        return $this->belongsToMany('HR\Tag', 'books_has_tags','book_introduction_id','tag_id')
            ->withTimestamps();
    }

    public static function book_search($qurey)
    {
        return BookIntroduction::whereHas('tags', function ($w) use ($qurey) {
            $w->where('name', 'like', '%' . $qurey . '%');
        })->orWhere('book_name', 'like', "%$qurey%")
            ->orWhere('body', 'like', "%$qurey%")
            ->orWhere('author', 'like', "%$qurey%")
            ->orWhere('publication_name', 'like', "%$qurey%");
    }

    public static function book_tag_search($qurey)
    {
        $tag = Tag::where('name',$qurey)->first();
        if($tag)
            return $tag->books();
        return null;
    }
}