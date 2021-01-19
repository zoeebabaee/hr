<?php

namespace HR\ApiModel;

trait Login
{
    public static $token;
    public static  $username='people';
    public static  $password='123!@#Qwe';
    public static function loginApi()
    {

        $username=self::$username;
        $password=self::$password;
        $curl = curl_init();
        $header = [
            'Content-Type: application/json'
        ];
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://gsc-master.gig.services/api/Account/ImpersonatedLogin",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"userName\":\"people\",\"password\":\"123!@#Qwe\",\"companyId\":445,\"branchId\":0}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        self::$token = 'bearer '.(json_decode($response))->data->token;
        return self::$token;
    }
}
