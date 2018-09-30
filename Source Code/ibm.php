<?php

require_once 'vendor/autoload.php';

$client = new GuzzleHttp\Client([
    'base_uri' => 'https://stream.watsonplatform.net/'
]);

$audio = fopen('1.mp3', 'r');
$resp = $client->request('POST', 'speech-to-text/api/v1/recognize', [
    'auth' => ['8d884840-3095-4d9c-98ec-231ff44168f5', 'tJkpyx15KzKk'],
    'headers' => [
        'Content-Type' => 'audio/mpeg',
    ],
    'body' => $audio
]);
$someJSON=$resp->getBody();

echo '<pre>'.$resp->getBody().'</pre>';
  $someArray = json_decode($someJSON, true);
  print_r($someArray);        // Dump all data of the Array
  echo $someArray[0]["transcript"]; // Access Array data

  // Convert JSON string to Object
  $someObject = json_decode($someJSON);
  print_r($someObject);      // Dump all data of the Object
  echo $someObject[0]->transcript;
?>