<?php


namespace HR\Http\Controllers;


use HR\User;
use HR\UserProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class UpdateUserEmailController extends Controller
{
    public function index()
    {
        $offset = 0;
        $users = UserProfile::Join('model_has_roles','user_id','model_id')
            ->where('role_id',9)->orWhere('role_id',15)->orWhere('role_id',16)->get();

        foreach ($users as $user)
        {
            $file_res= file_get_contents('http://172.31.2.18:1459/default/GetResult/?CodeMeli='.$user['national_code']);
            if(!empty(json_decode($file_res)[0]))
            {
                $res = json_decode($file_res)[0];

                if(empty($res->Email)|| ($res->Email == "NULL")||(strpos($res->Email, '>') !== false)||(strpos($res->Email, '@') == false))
                {
                    echo "\n".$res->Email;
                    $user_data = User::where('id',$user['user_id'])->first();
                    Storage::append('mail_master_data.txt', "\n".$user_data->first_name.' '.$user_data->last_name.' '.$user['national_code'].' => '.$res->Email );

                }

            }
        }
   /*         $file_res= file_get_contents('http://172.31.2.18:1459/default/GetResult/?CodeMeli='.$user['national_code']);
            //die($user['national_code'].'***');
            $res = json_decode($file_res)[0];
            
            
            $affected = DB::table('users')
                ->where('id', $user['user_id'])
                ->update(array('email' => $res->Email));
                
                if($affected > 0)
                    echo $user['user_id']. "\n";


        }*/

    }
}