<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class ResumeContractType extends Model
{
    public function resumes()
    {
        return $this->belongsToMany('HR\Resume',
            'resume_has_contract_type',
            'contract_type_id','resume_id')
            ->withTimestamps();
    }
}
