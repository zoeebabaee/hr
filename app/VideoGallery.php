<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    protected $fillable = ['name','icon','parent_id'];
    public function videos()
    {
        return $this->hasMany('HR\Videos', 'gallery_id');
    }
    public function children()
    {
        return $this->hasMany('HR\VideoGallery','parent_id','id' );
    }
    public function parent()
    {
        return $this->belongsTo('HR\VideoGallery','parent_id','id' );
    }

}
