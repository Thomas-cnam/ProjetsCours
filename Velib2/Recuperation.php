<?php
header('Content-Type: application/json');

$url = 'https://velib-metropole-opendata.smoove.pro/opendata/Velib_Metropole/station_information.json';

$options = array(
    'http' => array(
        'proxy'   => 'http://192.168.3.2:3128',
        'request_fulluri' => true,
        'method'  => 'GET'

    )
);

$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);

$json = json_decode($response);
if ($json === null && json_last_error() !== JSON_ERROR_NONE) {
    echo '{"error": "Invalid JSON response"}';
} else {
    echo $response;
}
?>