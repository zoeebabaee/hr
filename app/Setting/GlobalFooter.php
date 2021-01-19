<?php

namespace HR\Setting;

use Illuminate\Database\Eloquent\Model;

class GlobalFooter extends Model
{
    public function content()
    {
        return $this->belongsTo('HR\Content','content_id');
    }

    protected $fillable =[
        'central_office', 'contact_us', 'links', 'content_id'
    ];
}
