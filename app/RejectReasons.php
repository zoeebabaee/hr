<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class RejectReasons extends Model
{
    public function creator()
    {
        return $this->belongsTo('HR\User', 'created_by');
    }
    public function modifier()
    {
        return $this->belongsTo('HR\User', 'modified_by');
    }
}
