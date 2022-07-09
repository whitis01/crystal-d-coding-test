<?php


class CrystalCurl {

  public static function apiCurl(string $api_string = 'https://api.crystal-d.com/codetest') {

    // Open and get the cURL string
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $api_string);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, CURL_IPRESOLVE_V4);

    // curl_exec() executes the started curl session
    $output = curl_exec($curl);


    $decoded = json_decode($output);

    $encoded = json_encode($decoded, JSON_PRETTY_PRINT);
    echo $output;

    // close curl resource to free up system resources
    // (deletes the variable made by curl_init)
    curl_close($curl);
  }
}
