<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPost extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','data_id','department_id','data_serial_number'];

    public function jobs()
    {
        return $this->hasMany('HR\Job','post_id','id');
    }

    protected $dates = ['deleted_at'];
}
