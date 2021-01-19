<?php


namespace HR\Http\Controllers\personnelapi;


use HR\ApiModel\Login;
use HR\Degree;
use Illuminate\Support\Facades\DB;

class DegreeController
{
    public function addDegree()
    {
        $token =Login::loginApi();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"entityName\": \"EducationDegreeCode\",\"pageMeta\":{\"currentPage\": 1,\"perPage\": 10000}}\r\n",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json-patch+json",
                "Authorization: $token"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $api_degrees = (json_decode($response))->data;


        $db_degrees = DB::table('degrees')->get();
        $duplicat_dregree=[];
        foreach ($db_degrees as $db_degree) {

            foreach ($api_degrees as $api_degree) {

                if($db_degree->name == $api_degree->name)
                {
                    $old_degree = Degree::where('id',$db_degree->id)->first();
                    $old_degree->data_id = $api_degree->id;
                    $old_degree->save();

                    $duplicat_dregree[]=$api_degree->id;

                    break;

                }

            }


        }

        foreach ($api_degrees as $api_degree) {

            if(!in_array($api_degree->id,$duplicat_dregree))
            {
                $time =date("Y-m-d 00:00:00");
                $degree_obj = new Degree();
                $degree_obj->data_id = $api_degree->id;
                $degree_obj->name = $api_degree->name;
                $degree_obj->save();
                //DB::insert('insert into degrees (name,data_id,created_at,updated_at) values(?)',[$api_degree->name,$api_degree->id,$time,$time]);
            }


            /*         $mysqli->query("INSERT INTO degrees set name='" . $degree->name . "' , api_degree_id='" . $degree->id . "'
                 , created_at='" . date("Y-m-d 00:00:00")  . "'
                 , updated_at='" . date("Y-m-d 00:00:00") . "'
                 ");*/
        }
    }
}