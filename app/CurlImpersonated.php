<?php


namespace HR;


class CurlImpersonated
{
    public static $impersonated_token;


    public function __construct()
    {
    }

    public static function impersonatedLogin($company_id)
    {
        $curl = curl_init();
        $url = config('app.impersonated_login');
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"userName\":\"people\",\"password\":\"123!@#Qwe\",\"companyId\":$company_id,\"branchId\": $company_id}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
       // die(curl_getinfo($curl,CURLINFO_HTTP_CODE).'****'.$company_id);

        curl_close($curl);
        self::$impersonated_token = 'bearer '.(json_decode($response))->data->token;
        return self::$impersonated_token;
    }

    public static function refreshToken($old_token)
    {
        $curl = curl_init();
        $old_token = str_replace('bearer ','',$old_token);
        $url = config('app.refresh_token');

        $header = [
            'Content-Type: application/json'
        ];
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            //CURLOPT_HEADER  => true,  // we want headers
            //CURLOPT_NOBODY  => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER =>$header,
            CURLOPT_POSTFIELDS =>"{\"refreshTokenValue\":1,\"token\":\"$old_token\"}"

        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);


        curl_close($curl);
        self::$impersonated_token = (json_decode($response))->data->token;
        return self::$impersonated_token;
    }

    public static function companyOrganization($token,$baseurl)
    {
        $curl = curl_init();
        $url = $baseurl['gng_hr_baseurl'].config('app.company_organization');
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"pageMeta\":{\"currentPage\":1,\"perPage\":10000}}",
            CURLOPT_HTTPHEADER => array(
                "authorization: $token",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //die('status=>'.$httpcode);
        curl_close($curl);
        if($httpcode == 500)
        {
            return '500';
        }
        if($httpcode !=200 )
        {
            $token = self::refreshToken($token);
            return self::companyOrganization('bearer '.self::$impersonated_token,$baseurl);
        }
        else
            return $response;
    }

    public static function organizationPost($token , $unit_id,$baseurl)
    {
        $curl = curl_init();
        $url = $baseurl['gng_hr_baseurl'].config('app.organization_post');


        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"pageMeta\":{\"currentPage\":1,\"perPage\":10000},\"filters\":{\"OrganizationUnitSerialNumber\":{\"value\":$unit_id,\"matchMode\":\"equals\",\"type\":\"number\"}}}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token",
                "Content-Type: application/json"
            ),
        ));


        $response = curl_exec($curl);

        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($httpcode !=200 )
        {
            $token = self::refreshToken($token);
            return self::organizationPost('bearer '.self::$impersonated_token,$unit_id,$baseurl);


        }
        else
            return $response;
    }

    public static function merites($token , $post_id,$baseurl)
    {
        $curl = curl_init();
        $url = $baseurl['gng_hr_baseurl'].config('app.merit');

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"pageMeta\":{\"currentPage\":1,\"perPage\":100},\"filters\":{\"serialnumber\":{\"value\":$post_id,\"matchMode\":\"equals\",\"type\": \"number\"}}} ",
/*            CURLOPT_POSTFIELDS =>"{\"pageMeta\":{\"currentPage\":1,\"perPage\":10},\"filters\":{\"serialnumber\":{\"value\":47058,\"matchMode\":\"equals\",\"type\": \"number\"}}} ",
*/            CURLOPT_HTTPHEADER => array(
                "authorization:$token",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if($httpcode !=200 )
        {
            $token = self::refreshToken($token);
            return self::merites('bearer '.self::$impersonated_token,$post_id,$baseurl);


        }
        else
        {      
            curl_close($curl);
            return $response;
        }

    }
    
    public static function gender($token,$baseurl)
    {

        $curl = curl_init();
        $url = $baseurl['gng_master_baseurl'].config('app.master_url');

        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{"entityName": "GenderCode","pageMeta":{"currentPage": 1,"perPage": 10000}}
        ',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            "Authorization:$token"
          ),
        ));
        
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if($httpcode !=200 )
        {
            $token = self::refreshToken($token);
            return self::gender('bearer '.self::$impersonated_token,$url);


        }
        else
        {      
            curl_close($curl);
            return $response;
        }

    }
    
    
    public static function relation($token,$baseurl)
    {

        $curl = curl_init();
        $url = $baseurl['gng_master_baseurl'].config('app.master_url');

        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{"entityName": "RelationCode","pageMeta":{"currentPage": 1,"perPage": 10000}}
        ',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json-patch+json',
            "Authorization:$token"
          ),
        ));
        
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if($httpcode !=200 )
        {
            $token = self::refreshToken($token);
            return self::gender('bearer '.self::$impersonated_token,$url);


        }
        else
        {      
            curl_close($curl);
            return $response;
        }

    }






}