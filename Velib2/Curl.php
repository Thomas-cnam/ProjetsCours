<?php


$url1 = 'https://velib-metropole-opendata.smoove.pro/opendata/Velib_Metropole/station_information.json';
$url2 = 'https://velib-metropole-opendata.smoove.pro/opendata/Velib_Metropole/station_status.json';

$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, $url1);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch1, CURLOPT_PROXY, '192.168.3.2:3128');
$data1 = curl_exec($ch1);
curl_close($ch1);

$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, $url2);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_PROXY, '192.168.3.2:3128');
$data2 = curl_exec($ch2);
curl_close($ch2);

$stations_information = json_decode($data1, true); // true pour retourner un tableau associatif
$station_status = json_decode($data2, true);

// on combine les deux tableaux en une seule réponse JSON
$response = json_encode(array(
    'data' => array(
        'stations_information' => $stations_information,
        'station_status' => $station_status
    )
));




?>