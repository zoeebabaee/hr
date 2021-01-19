<?php


namespace HR\Http\Controllers\personnelapi;


use HR\ApiModel\Login;
use HR\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FieldOrientationController extends Controller
{
    public function __construct()
    {

    }


    public function addOrientation()
    {
        $old_url_orientation = "http://172.31.0.156:3310/api/PublicItem/GetEnumsAsync";
        $token =Login::loginApi();
        $api_types = (json_decode(FieldTypeController::getFieldType()))->data;

        foreach ($api_types as $api_type) {
            $fields = (json_decode(FieldController::getTypeField($api_type->id)))->data;

            foreach ($fields as $field) {

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    // CURLOPT_URL => "https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync",
                    CURLOPT_URL => config('app.field_orientation'),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS =>"{\"entityName\":\"EducationTendencyCode\",\"parentItemName\":\"EducationFieldCode\",\"parentItemNumber\":$field->id}",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: $token",
                        "Content-Type: application/json"
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);

                $orientations = (json_decode($response))->data;

                $db_orientations = DB::table('api_education_orientations')->get();

                if(count($db_orientations) > 0)
                {
                    foreach ($orientations as $orientation) {
                        $repeat = 0;
                        foreach ($db_orientations as $db_orientation) {
                            if ($orientation->id == $db_orientation->data_id) {
                                /*zoee
                                    **we don't update because we don't have any fields at first
                                */
                                $repeat = 1;
                                break;
                            } else
                                continue;
                        }
                        if ($repeat == 0) {
                            /*if (DB::select("select id from  api_education_orientations where data_id='" . $orientation->id . "'")[0]->id > 0)
                                break;*/
                            $parent_id = DB::select("select id from api_education_fields where data_id='" . $field->id . "'")[0]->id;
//die(json_encode($parent_id).'++');
                            $data = array('name' => $orientation->name, "data_id" => $orientation->id, "itemName" => $orientation->itemName, "itemNumber" => $orientation->itemNumber, "api_education_field_id" => $parent_id);
                            DB::table('api_education_orientations')->insert($data);
                        }
                    }
                }
                else
                {
                    foreach ($orientations as $orientation)
                    {
                        $parent_id = DB::select("select id from api_education_fields where data_id='" . $field->id . "'")[0]->id;
//die(json_encode($parent_id).'++');
                        $data = array('name' => $orientation->name, "data_id" => $orientation->id, "itemName" => $orientation->itemName, "itemNumber" => $orientation->itemNumber, "api_education_field_id" => $parent_id);
                        DB::table('api_education_orientations')->insert($data);
                    }
                }


            }
        }
    }
}