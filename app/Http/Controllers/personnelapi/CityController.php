<?php


namespace HR\Http\Controllers\personnelapi;


use HR\ApiModel\Login;
use HR\City;
use HR\Http\Controllers\Controller;
use HR\Province;

class CityController extends Controller
{

    public function __construct()
    {

    }
    public function provinceCity($province_id)
    {
        $token =Login::loginApi();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            // CURLOPT_URL => "http://172.31.0.156:3310/api/City/LookupAsync",
            CURLOPT_URL => config('app.cities'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"pageMeta\":{\"currentPage\": 1,\"perPage\": 10000},\"filters\":{\"provinceId\":{\"value\": $province_id,\"matchMode\":\"equals\",\"type\":\"number\"}}}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json-patch+json",
                "Authorization: $token"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        return $response;

    }

    //update cities for one province
    public function addCity($province_id)
    {
        $cities = $this->provinceCity($province_id);
        $api_cities = (json_decode($cities))->data;
        $db_cities = City::get();

        foreach ($api_cities as $api_city)
        {
            $repeat = 0;
            foreach ($db_cities as $db_city)
            {
                $db_name = str_replace('شهر', '', $db_city['name']);
                $db_name = str_replace('جدید', '', $db_name);
                $db_name = str_replace('شهرک', '', $db_name);

                $city_name = str_replace('شهر', '', $api_city->name);
                $city_name = str_replace('جدید', '', $city_name);
                $city_name = str_replace('شهرک', '', $city_name);

                similar_text($db_name, $city_name, $percentage);



                //die($percentage.'***');
                if ($percentage >= 90)
                {
                    $repeat = 1;
                    //update
                    $old_city = City::find($db_city['id']);
                    $old_city->data_id = $db_city->id;
                    $old_city->province_data_id = $province_id;
                    $old_city->save();
                    break;
                }
            }
            if($repeat == 0)
            {
                $province_parent = Province::where('province_data_id',$province_id)->first()->id;
                $city_obj = new City();
                $city_obj->name = $api_city->name;
                $city_obj->province_data_id = $province_id;
                $city_obj->data_id = $api_city->id;
                $city_obj->province_id = $province_parent;
                //TODO api_datas
                $city_obj->save();
            }
        }
    }

    //update cities for all province
    public function addAllCity()
    {
        $token =Login::loginApi();

        for($i=457;$i<=487;$i++) {


            $curl = curl_init();

            curl_setopt_array($curl, array(
                // CURLOPT_URL => "http://172.31.0.156:3310/api/City/LookupAsync",
                CURLOPT_URL => config('app.cities'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS =>"{\"pageMeta\":{\"currentPage\": 1,\"perPage\": 10000},\"filters\":{\"provinceId\":{\"value\": $i,\"matchMode\":\"equals\",\"type\":\"number\"}}}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json-patch+json",
                    "Authorization: $token"
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
           // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $api_cities = (json_decode($response))->data;

            $db_cities = City::where('province_data_id','<',457)->get();


             foreach ($api_cities as $api_city){
                 $repeat = 0;

                foreach ($db_cities as $db_city) {

                    similar_text($api_city->name, $db_city['name'], $percentage);

                    $db_name = str_replace('شهر', '', $db_city['name']);
                    $db_name = str_replace('جدید', '', $db_name);
                    $db_name = str_replace('شهرک', '', $db_name);

                    $city_name = str_replace('شهر', '', $api_city->name);
                    $city_name = str_replace('جدید', '', $city_name);
                    $city_name = str_replace('شهرک', '', $city_name);

                    similar_text($db_name, $city_name, $percentage);



                    //die($percentage.'***');
                    if ($percentage >= 90)
                    {


                        $repeat = 1;

                        $city_obj                   = City::find($db_city->id);
                        $city_obj->name             = $api_city->name;
                        $city_obj->province_data_id = $i;
                        $city_obj->data_id     = $api_city->id;
                        //TODO api_datas
                        $city_obj->save();
                        break;
                    }
                    else
                        continue;

                }
                 if($repeat == 0)
                 {
                     $check = City::where('data_id',$api_city->id)->first()->id;
                     if($check > 0)
                         break;
                     var_dump("name =>".$api_city->name);
                     /*$city_obj = new City();
                     $city_obj->name = $api_city->name;
                     $city_obj->data_province_id = $i;
                     $city_obj->data_city_id = $api_city->id;
                     //TODO api_datas
                     $city_obj->save();*/
                 }

            }

        }
    }
}