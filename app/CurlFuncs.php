<?php

namespace HR;


class CurlFuncs
{
   /* public static $token;
    public static $impersonated_token;


    public function __construct()
    {
        self::setToken('people','123!@#Qwe');
    }
    public static function setToken($username , $password)
    {

        $curl = curl_init();
        $header = [
            'Content-Type: application/json'
        ];
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://172.31.0.156:9901/api/Account/Login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER=>$header,
            CURLOPT_POSTFIELDS =>"{\"userName\":\"$username\",\"password\":\"$password\"}",
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        self::$token = 'bearer '.(json_decode($response))->data->token;
        return self::$token;
    }


    public static function getCompanies()
    {
        $token = self::$token;
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
        return $response;
    }

    public static function getOrganizationUnits()
    {
        $token = self::$token;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://172.31.0.156:1020/api/OrganizationUnit/LookupAsync",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"pageMeta\":{\"currentPage\": 1,\"perPage\": 10000}}",
            CURLOPT_HTTPHEADER => array(
                "authorization: $token",
                "Content-Type: application/json"
            ),
        ));


        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public static function getOrganizationPost($organization_id)
    {
        $token = self::$token;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://172.31.0.156:1020/api/OrganizationPost/LookupAsync",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"pageMeta\":{\"currentPage\": 1,\"perPage\": 10000},\"filters\": {\"OrganizationUnitId\": {\"value\": $organization_id,\"matchMode\": \"equals\",\"type\": \"number\"}}}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json-patch+json",
                "Authorization: $token"
            ),
        ));

        $response = curl_exec($curl);


        curl_close($curl);
        return $response;
    }

    public static function getCountries()
    {
        $token = self::$token;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://172.31.0.156:3310/api/Country/LookupAsync",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"pageMeta\":{\"currentPage\": 1,\"perPage\": 2000}}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
die(curl_getinfo($curl, CURLINFO_HTTP_CODE).'***');
        curl_close($curl);
        return $token;
    }

    public static function getProvinces()
    {
        $token = self::$token;
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
            CURLOPT_POSTFIELDS =>"{\"pageMeta\":{\"currentPage\": 1,\"perPage\": 10000},\"filters\":{\"countryId\":{\"value\": 400,\"matchMode\": \"equals\",\"type\": \"number\"}}}\n",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json-patch+json",
                "Authorization:$token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public static function getCities()
    {
        $token = self::$token;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://172.31.0.156:3310/api/City/LookupAsync",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"pageMeta\":{\"currentPage\": 1,\"perPage\": 10000},\"filters\":{\"provinceId\":{\"value\": 464,\"matchMode\":\"equals\",\"type\":\"number\"}}}",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json-patch+json",
                "Authorization: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }




    public static function check()
    {
        return self::$token;
    }


    public static function merites()
    {
        $curl = curl_init();

        $token = self::$token;

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://172.31.0.156:1020/api/OrganizationPostPostMerit/LookupAsync",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"pageMeta\":{\"currentPage\": 1,\"perPage\": 100},\"filters\":{\"OrganizationPostId\":{\"value\": 113770,\"matchMode\":\"equals\",\"type\":\"number\"}}}",
            CURLOPT_HTTPHEADER => array(
                "authorization:$token",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public static function allMerits($post_id)
    {
        $token = self::$token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://172.31.0.156:1020/api/OrganizationPostPostMerit/LookupAsync",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\"pageMeta\":{\"currentPage\": 1,\"perPage\": 100},\"filters\":{\"OrganizationPostId\":{\"value\": $post_id,\"matchMode\":\"equals\",\"type\":\"number\"}}}",
            CURLOPT_HTTPHEADER => array(
                "authorization: $token",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }*/


    
    
}

