<?php


namespace HR\Http\Controllers\personnelapi;

use HR\ApiModel\Login;

use HR\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FieldTypeController extends Controller
{
    public function __construct()
    {

    }

    public function addFieldType()
    {

        $token =Login::loginApi();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            // CURLOPT_URL => "http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync",
            CURLOPT_URL => config('app.field_type'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n  \"entityName\": \"EducationFieldTypeCode\",\"pageMeta\":{\"currentPage\":1,\"perPage\":10000}}\r\n",
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token",
                "Content-Type: application/json"
            ),
        ));
        $response = curl_exec($curl);
       // die($response);
        curl_close($curl);
        $api_types = (json_decode($response))->data;

        $db_types = DB::table('api_education_field_types')->get();
        if(count($db_types) > 0)
        {
            foreach ($api_types as $api_type)
            {
                $repeat = 0;
                foreach ($db_types as $db_type)
                {
                    if($api_type->name == $db_type->name)
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

                    $data=array('name'=>$api_type->name,"data_id"=>$api_type->id,"itemName"=>$api_type->itemName,"itemNumber"=>$api_type->itemNumber);
                    DB::table('api_education_field_types')->insert($data);
                }

            }
        }
        else
        {
            foreach ($api_types as $api_type)
            {
                $data=array('name'=>$api_type->name,"data_id"=>$api_type->id,"itemName"=>$api_type->itemName,"itemNumber"=>$api_type->itemNumber);
                DB::table('api_education_field_types')->insert($data);
            }


        }

    }

    public static function getFieldType()
    {
        $token =Login::loginApi();

        $curl = curl_init();
      //  $old_url = "http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync";

        curl_setopt_array($curl, array(
            // CURLOPT_URL => "https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync",
            CURLOPT_URL => config('app.field_type'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n  \"entityName\": \"EducationFieldTypeCode\"\r\n,\"pageMeta\":{\"currentPage\":1,\"perPage\":10000}}\r\n",
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token",
                "Content-Type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}