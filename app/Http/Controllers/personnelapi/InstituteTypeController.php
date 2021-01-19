<?php


namespace HR\Http\Controllers\personnelapi;


use HR\ApiModel\Login;
use HR\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InstituteTypeController extends Controller
{

    public function __construct()
    {

    }

    public function addInstituteType()
    {
        $token =Login::loginApi();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            // CURLOPT_URL => "http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync",
            CURLOPT_URL => config('app.institute_type'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"pageMeta\":{\"currentPage\":1,\"perPage\":10000}, \"entityName\":\"InstituteTypeCode\"}\r\n",
            CURLOPT_HTTPHEADER => array(
                "Content-Type:  application/json",
                "Authorization: $token",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $institute_array = (json_decode($response))->data;

        $db_types = DB::table('api_institute_types')->get();
        if(count($db_types)>0)
        {

            foreach ($institute_array as $institute) {
            $repeat = 0;
            foreach ($db_types as $db_type)
            {
                if($institute->name == $db_type->name)
                {
                    /*zoee
                        **we don't update because we don't have any types at first
                    */
                    $repeat=1;
                    break;
                }
                else
                    continue;
            }
            if($repeat ==0 )
            {

                $data = array('name' => $institute->name, "data_id" => $institute->id, "itemName" => $institute->itemName, "itemNumber" => $institute->itemNumber);
                DB::table('api_institute_types')->insert($data);
            }

        }

        }

        else{

            /*    $mysqli->query("INSERT INTO api_institute_types set name='" . $institute->name . "' ,
                itemName='" . $institute->itemName . "' ,
                itemNumber='" . $institute->itemNumber . "' ,
                data_id='" . $institute->id . "'");*/

            foreach ($institute_array as $institute) {

                $data = array('name' => $institute->name, "data_id" => $institute->id, "itemName" => $institute->itemName, "itemNumber" => $institute->itemNumber);
                DB::table('api_institute_types')->insert($data);
            }
        }
    }

    public static function getInstituteType()
    {
        $token =Login::loginApi();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            // CURLOPT_URL => "http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync",
            CURLOPT_URL => config('app.institute_type'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"pageMeta\":{\"currentPage\":1,\"perPage\":10000}, \"entityName\":\"InstituteTypeCode\"}\r\n",
            CURLOPT_HTTPHEADER => array(
                "Content-Type:  application/json",
                "Authorization: $token",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}