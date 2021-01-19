<?php

function curl_get_contents($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

$cities = curl_get_contents("http://172.31.2.18:73/Khedmat/GetData");
echo '**';
print_r($cities);
echo '**';


echo phpinfo();
