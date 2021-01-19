<?php

namespace HR;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Throttle extends Model
{
    protected $fillable = [
        'finger_print', 'expire_date'
    ];
}
