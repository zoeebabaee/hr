<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobOrganizationalCategory extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];

    public function jobs()
    {
        return $this->hasMany('HR\Job');
    }

    protected $dates = ['deleted_at'];
}
