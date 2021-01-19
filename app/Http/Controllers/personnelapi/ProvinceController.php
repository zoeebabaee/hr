<?php


namespace HR\Http\Controllers\personnelapi;


use HR\ApiModel\Login;
use HR\Http\Controllers\Controller;
use HR\Province;
use Illuminate\Support\Facades\Storage;

class ProvinceController extends Controller
{
    use Login;


    public function __construct()
    {
     
    }

    public function getProvince()
    {
        $token =Login::loginApi();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://172.31.0.156:3310/api/Province/LookupAsync",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"pageMeta\":{\"currentPage\": 1,\"perPage\": 10000},\"filters\":{\"countryId\":{\"value\": 400,\"matchMode\": \"equals\",\"type\": \"number\"}}}\n",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json-patch+json",
                "Authorization:$token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function addProvince()
    {
        $api_provinces = json_decode($this->getProvince())->data;
        $db_provinces = Province::get();

        foreach ($api_provinces as $api_province)
        {
            $repeat = 0;
            foreach ($db_provinces as $db_province)
            {

                $province_name = preg_replace('(021)', '', $api_province->name);
               // $province_name = str_replace('ي', 'ی', $province_name);

                similar_text($province_name, $db_province['name'], $percentage);

                if($repeat == 0) {
                    if (($percentage > 80) || ($db_province['data_id']==$api_province->id)) {
                        $repeat = 1;

                        //update
                        $old_province = Province::find($db_province['id']);
                        $old_province->data_id = $api_province->id;
                        $old_province->save();
                        break;

                    }

               /*     if(Province::where('name','like',$db_province['name'])->first()->id>0){
                            $repeat = 1;

                            //update
                            $old_province = Province::find($db_province['id']);
                            $old_province->data_id = $api_province->id;
                            $old_province->save();
                            break;

                        }*/

                }

                else
                    break;
            }

            if($repeat == 0)
            {


                var_dump('name =>'. $api_province->name);

                //Province::create(['name' => $api_province->name,'data_id'=> $api_province->id]);

                /*$province_obj = new Province();
                $province_obj->name = $api_province->name;
                $province_obj->data_id = $api_province->id;
                //TODO api_datas
                $province_obj->save();*/
            }


        }
    }

}