<?php


namespace HR\Http\Controllers\personnelapi;


use HR\ApiModel\Login;
use HR\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FieldController extends Controller
{
    public function __construct()
    {

    }

    public function addAllFields()
    {
        //$obj_noes = (json_decode(NoeReshte::getNoeReshte()))->data;
        $token =Login::loginApi();
        $api_types = (json_decode(FieldTypeController::getFieldType()))->data;
        $db_fields = DB::table('api_education_fields')->get();
       // die(json_encode($db_fields));

        if(count($db_fields) > 0) {
            foreach ($api_types as $api_type) {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => config('app.fields'),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{\"entityName\":\"EducationFieldCode\",\"parentItemName\":\"EducationFieldTypeCode\",\"parentItemNumber\":$api_type->id,\"pageMeta\":{\"currentPage\":1,\"perPage\":10000}}",
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json-patch+json",
                        "Authorization: $token"
                    ),
                ));

                $reshte = curl_exec($curl);
                curl_close($curl);
                $api_fields = (json_decode($reshte))->data;


                foreach ($api_fields as $api_field) {
                    $repeat = 0;
                    foreach ($db_fields as $db_field) {
                        if ($api_field->id == $db_field->data_id) {
                            /*zoee
                                **we don't update because we don't have any fields at first
                            */
                            $repeat = 1;
                            break;
                        } else
                            continue;
                    }
                    if ($repeat == 0) {
                       /* if (DB::select("select id from  api_education_fields where data_id='" . $api_type->id . "'")[0]->id > 0)
                          die('4444');*/
                        $parent_id = DB::select("select id from api_education_field_types where data_id='" . $api_type->id . "'")[0]->id;
//die(json_encode($parent_id).'++');
                        $data = array('name' => $api_field->name, "data_id" => $api_field->id, "itemName" => $api_field->itemName, "itemNumber" => $api_field->itemNumber, "api_education_field_type_id" => $parent_id);
                        DB::table('api_education_fields')->insert($data);
                    }
                }


            }
        }

        else
        {
            foreach ($api_types as $api_type) {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => config('app.fields'),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{\"entityName\":\"EducationFieldCode\",\"parentItemName\":\"EducationFieldTypeCode\",\"parentItemNumber\":$api_type->id,\"pageMeta\":{\"currentPage\":1,\"perPage\":10000}}",
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json-patch+json",
                        "Authorization: $token"
                    ),
                ));

                $reshte = curl_exec($curl);
                curl_close($curl);
                $api_fields = (json_decode($reshte))->data;


                foreach ($api_fields as $api_field) {


                        $parent_id = DB::select("select id from api_education_field_types where data_id='" . $api_type->id . "'")[0]->id;
//die(json_encode($parent_id).'++');
                        $data = array('name' => $api_field->name, "data_id" => $api_field->id, "itemName" => $api_field->itemName, "itemNumber" => $api_field->itemNumber, "api_education_field_type_id" => $parent_id);
                        DB::table('api_education_fields')->insert($data);
                    }



            }
        }

    }


    public static function getTypeField($type)
    {

        $token =Login::loginApi();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  config('app.fields'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"entityName\":\"EducationFieldCode\",\"parentItemName\":\"EducationFieldTypeCode\",\"parentItemNumber\":$type,\"pageMeta\":{\"currentPage\":1,\"perPage\":10000}}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json-patch+json",
                "Authorization: $token"
            ),
        ));

        $reshte = curl_exec($curl);
        curl_close($curl);

        return $reshte;
    }
}