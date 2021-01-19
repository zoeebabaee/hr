<?php

namespace HR\Setting;

use Illuminate\Database\Eloquent\Model;

class FirstPageFooter extends Model
{

    public function content()
    {
        return $this->belongsTo('HR\Content','content_id');
    }

    protected $fillable =[
        'central_office', 'contact_us', 'work_time', 'links', 'content_id'
    ];
}
