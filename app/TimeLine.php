<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TimeLine extends Model
{
    protected $fillable = [
        'title',
        'icon',
        'body',
        'when',
        'ref',
        'img'
    ];

    public function setWhenAttribute($value)
    {
        $this->attributes['when'] = myDate::createFromFormat('Y/m/d', $value)->carbon->toDateString();
    }
    public function getWhenAttribute($value)
    {
        return myDate::createFromCarbon(Carbon::parse($value))->format('Y/m/d');
    }
}
