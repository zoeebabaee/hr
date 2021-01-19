<?php

namespace HR\Setting;

use Illuminate\Database\Eloquent\Model;

class FirstPageSlider extends Model
{
    protected $fillable = [
        'title', 'body', 'image', 'link','status'
    ];
}
