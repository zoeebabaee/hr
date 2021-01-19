<?php


namespace HR\Http\Controllers\personnelapi;


use HR\ApiModel\Login;
use HR\Company;
use HR\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Compound;

class CompanyController extends Controller
{
    public function __construct()
    {

    }

    public function addCompanies()
    {
        $token =Login::loginApi();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://172.31.0.156:9901/api/gigcompany/LookupAsync",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"pageMeta\": {\"currentPage\": 1,\"perPage\": 50000}}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token",
                "Content-Type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $api_companies = (json_decode($response))->data;

        $db_companies = Company::get();
$i = 0;
        foreach($api_companies as $api_company)
        {
            $i++;
            $repeat = 0;
            foreach ($db_companies as $db_company)
            {
                $company_name_from_db = $db_company['name'] ;
                $one = preg_replace('~\s+~u', '', $company_name_from_db);
                $one1 = str_replace('شرکت', '', $one);
                $two = str_replace('گروه', '', $one1);

                $company_name_from_api = $api_company->name;
                $three = preg_replace('~\s+~u', '', $company_name_from_api);
                $three1 = str_replace('شرکت', '', $three);
                $foure = str_replace('گروه', '', $three1);

                similar_text($two , $foure ,$percentage);
                if($percentage > 90) {
                    $repeat = 1;
                    $old_company = Company::where('id', $db_company['id'])->first();
                    $old_company->data_id = $api_company->id;
                    $old_company->save();
                }

                else
                     continue;

            }
            if($repeat == 0)
            {
                $check = Company::where('data_id',$api_company->id)->first()->id;
                if($check > 0)
                    break;
                var_dump("$i name =>".$api_company->name);
                $company_obj = new Company();
                $company_obj->name = $api_company->name;
                $company_obj->data_id = $api_company->id;
                $company_obj->save();
                //insert
            }
        }

    }
    
    public function addMasterId()
    {
        $token =Login::loginApi();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://172.31.0.156:9901/api/gigcompany/LookupAsync",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"pageMeta\": {\"currentPage\": 1,\"perPage\": 50000}}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token",
                "Content-Type: application/json"
            ),
        ));
        $response = curl_exec($curl); 
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        die(json_encode($response));
        $api_companies = (json_decode($response))->data;

        $db_companies = Company::where('data_id','>',0)->get();
$i = 0;
        foreach($api_companies as $api_company)
        {
        
            foreach ($db_companies as $db_company)
            {
                if($db_company['data_id']>0 &&($api_company->masterDataId > 0) &&($db_company['data_id'] == $api_company->id))
                {
                    $old_company = Company::where('data_id', $api_company->id)->first();
                    $old_company->master_id = $api_company->masterDataId;
                    $old_company->save();
                }
                
            }
            
        }
    }
}