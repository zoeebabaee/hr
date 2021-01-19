<?php


namespace HR\Http\Controllers\personnelapi;


use HR\ApiModel\Login;
use HR\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InstitutePlaceController extends Controller
{
    public function __construct()
    {

    }

    public function addInstitutePlace()
    {
        $ins_types = (json_decode(InstituteTypeController::getInstituteType()))->data;
        $token =Login::loginApi();
       // die(json_encode($ins_types));

        foreach ($ins_types as $ins_type)
        {
            $id = $ins_type->id;
            $curl = curl_init();


            curl_setopt_array($curl, array(
                //CURLOPT_URL => "https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync",
                CURLOPT_URL => config('app.institute_place'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS =>"{\"pageMeta\":{\"currentPage\":1,\"perPage\":100000}, \"entityName\":\"InstituteCode\",\"parentItemName\": \"InstituteTypeCode\",\"parentItemNumber\": $id}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type:  application/json",
                    "Authorization: $token",
                    "Content-Type: application/json"
                ),
            ));


            $response_places = curl_exec($curl);
            $place_array =(json_decode($response_places))->data;

            $db_places = DB::table('api_institute_places')->get();
            if(count($db_places)>0)
            {

                foreach ($place_array as $place) {
                    $repeat = 0;
                    foreach ($db_places as $db_place)
                    {
                        if($place->id == $db_place->data_id)
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

                        $parent_id = DB::select("select id from api_institute_types where data_id='" . $ins_type->id . "'")[0]->id;
//die(json_encode($parent_id).'++');
                        $data = array('name' => $place->name, "data_id" => $place->id, "itemName" => $place->itemName, "itemNumber" => $place->itemNumber, "api_institute_type_id" => $parent_id);
                        DB::table('api_institute_places')->insert($data);
                    }

                }

            }

            else {


                foreach ($place_array as $place) {


                    $parent_id = DB::select("select id from api_institute_types where data_id='" . $ins_type->id . "'")[0]->id;
//die(json_encode($parent_id).'++');
                    $data = array('name' => $place->name, "data_id" => $place->id, "itemName" => $place->itemName, "itemNumber" => $place->itemNumber, "api_institute_type_id" => $parent_id);
                    DB::table('api_institute_places')->insert($data);

                }
            }
        }

    }
    
    public function check_additional_institute()
    {
        
         $ins_types = (json_decode(InstituteTypeController::getInstituteType()))->data;
        $token =Login::loginApi();
            $curl = curl_init();


            curl_setopt_array($curl, array(
               // CURLOPT_URL => "https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync",
                CURLOPT_URL => "https://Gsc-Master.gig.services/api/PublicItem/GetEnumsAsync",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS =>"{\"pageMeta\":{\"currentPage\":1,\"perPage\":10000}, \"entityName\":\"InstituteCode\",\"parentItemName\": \"InstituteTypeCode\",\"parentItemNumber\": 7}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type:  application/json",
                    "Authorization: $token",
                    "Content-Type: application/json"
                ),
            ));


            $response_places = curl_exec($curl);
            $place_array =(json_decode($response_places))->data;

            $db_places = DB::table('api_institute_places')->where('api_institute_type_id',6)->get();
            if(count($db_places)>0)
            {

                foreach($db_places as $db_place) {
                    $repeat = 0;
                    $add = "";

                    foreach($place_array as $place) 
                    {
                        if($place->id == $db_place->data_id)
                        {
                            /*zoee
                                **we don't update because we don't have any types at first
                            */
                            $add = "";
                            $repeat=1;
                            break;
                        }
                        else{
                            
                            $add =$db_place->name;
                            continue;
                            
                            
                        }
                    }
                    if(strlen($add) > 3  )
                    {

                        echo $add."<br/>";
                    }

                }

            }
    }

}