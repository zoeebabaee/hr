<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class OthersSay extends Model
{
    protected $fillable = [
      'name',
      'post',
      'company',
      'avatar',
      'body',
    ];
}
