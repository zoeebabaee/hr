<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable =[
        'question', 'answer'
    ];
}
