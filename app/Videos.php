<?php

namespace HR;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Videos extends Model
{
    protected $fillable = ['name', 'body', 'video', 'gallery_id', 'avatar', 'slug'];

    public function category()
    {
        return $this->belongsTo('HR\VideoGallery', 'gallery_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return myDate::createFromCarbon(Carbon::parse($value))->format('l j F Y');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}