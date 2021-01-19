<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class WorkerList extends Model
{

    protected $fillable = [
        'national_code', 'company_id'
    ];

    public function company()
    {
        return $this->belongsTo('HR\Company', 'company_id');
    }

}
