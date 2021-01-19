<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class contentGroup extends Model
{
    public function contents()
    {
        return $this->belongsToMany('HR\Content'
            ,'contents_has_groups',
            'group_id','content_id')
            ->withTimestamps();
    }
}
