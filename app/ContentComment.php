<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentComment extends Model
{
    use SoftDeletes;

    public function post()
    {
        return $this->belongsTo('HR\Content','content_id');
    }

    public function user()
    {
        return $this->belongsTo('HR\User');
    }


    protected $fillable =[
        'content','user_id','content_id'
    ];
    protected $dates = ['deleted_at'];
}
