<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class MobileConfirm extends Model
{
    protected $fillable=[
        'user_id','token'
    ];
    public function user()
    {
        return $this->belongsTo('HR\User');
    }
}
