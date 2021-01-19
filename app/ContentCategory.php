<?php

namespace HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentCategory extends Model
{
    use SoftDeletes;

    public function parent()
    {
        return $this->belongsTo('HR\ContentCategory');
    }

    public function child()
    {
        return $this->hasMany('HR\ContentCategory', 'parent_id');
    }

    public function contents()
    {
        return $this->hasMany('HR\Content', 'cat_id');
    }

    public static function getParents()
    {
        $parents = ContentCategory::all()->toArray();
        $result = array();
        foreach ($parents as $item)
        {
            $tmp['value']=$item['title'];
            $tmp['id']=$item['id'];
            $result[] = $tmp;
        }
        return $result;
    }

    protected $fillable =[
        'title','alias','body','status','layout','comment_enable','parent_id',
        'created_by','modified_by','meta_description','meta_keywords'
    ];
    protected $dates = ['deleted_at'];
}
