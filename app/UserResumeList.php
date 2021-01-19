<?php


namespace HR;


use Illuminate\Database\Eloquent\Model;

class UserResumeList extends Model
{

    protected $fillable=[
        'user_id','file_name','created_at',
        'updated_at'
       
    ];
}