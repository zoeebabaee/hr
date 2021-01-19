<?php

namespace HR\Setting;

use Illuminate\Database\Eloquent\Model;

class FirstContent extends Model
{
    protected $fillable = [
        'title', 'body', 'image', 'link'
    ];
}
