<?php


namespace HR\Http\Controllers\personnelapi;


use HR\ApiModel\Login;
use HR\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LanguagesController extends Controller
{
/*    public function update_lang()
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
            CURLOPT_POSTFIELDS =>"{ \"pageMeta\": {\"currentPage\": 1,\"perPage\": 100},\"entityName\": \"LanguageCode\"}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token",
                "Content-Type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $responses = json_decode($response)->data;


        foreach ($responses as $res)
        {
            DB::table('languagesmap')
                ->where('title', $res->name)
                ->update(['data_id' => $res->id]);
        }

    }*/
    
        public function update_lang()
    {
        $token = Login::loginApi();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{ \"pageMeta\": {\"currentPage\": 1,\"perPage\": 100},\"entityName\": \"LanguageCode\"}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token",
                "Content-Type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $responses = json_decode($response)->data;
        $db_languages = DB::table('languagesmap')->get();




        foreach ($responses as $res) {
            $repeat = 0;

            foreach ($db_languages as $db_language) {
                if($db_language->data_id == $res->id)
                {
                    $repeat = 1;
                    break;
                }
                else
                    continue;

            }

            if($repeat == 1)
            {
                DB::table('languagesmap')
                    ->where('title', $res->name)
                    ->update(['data_id' => $res->id]);
            }
            else
            {
                $data = array('title' => $res->name, "data_id" => $res->id);
                DB::table('languagesmap')->insert($data);
            }
        }
    }


}