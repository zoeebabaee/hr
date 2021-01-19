<?php


namespace HR\Http\Controllers;


use HR\User;
use HR\UserProfile;
use Illuminate\Support\Facades\DB;

class UpdateUserDataController extends Controller
{
    public function index()
    {
        $offset = 0;
        $users = UserProfile::Join('model_has_roles','user_id','model_id')
            ->where('role_id',9)->orWhere('role_id',15)->
            orwhere('role_id',16)->orWhere('role_id',17)->

            get();
            
            //die(json_encode(count($users)));

        foreach ($users as $user)
        {


            if(DB::select('select count(1) as exist from user_BI_data_new where user_id ="'.$user['user_id'].'"')[0]->exist < 1)
            {
                $file_res= file_get_contents('http://172.31.2.18:1459/default/GetResult/?CodeMeli='.$user['national_code']);
                $res = json_decode($file_res)[0];

                if($res->CompanyName != '')
                {
                    var_dump($user['id']);
                    echo "\n";



                    $data=array('user_id'=>$user['user_id'],"company_name"=>$res->CompanyName,"department_name"=>$res->Depname,"post_title"=>$res->TitelJob);
                    DB::table('user_BI_data_new')->insert($data);
                }
                else
                {
                    continue;
                }
            }
            else{
                continue;

            }


        }

    }
}