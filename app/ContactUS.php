<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUS extends Model
{
    use SoftDeletes;
    //
    protected $dates = ['deleted_at'];
}
