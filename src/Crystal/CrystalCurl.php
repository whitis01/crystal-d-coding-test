<?php


class CrystalCurl {

  public static function apiCurl(string $api_string = 'https://api.crystal-d.com/codetest') {
    // create & initialize a curl session
    $curl = curl_init();

    // set our url with curl_setopt()
    curl_setopt($curl, CURLOPT_URL, $api_string);

    // return the transfer as a string, also with setopt()
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    // curl_exec() executes the started curl session
    // $output contains the output string
    $output = curl_exec($curl);

    $decoded = json_decode($output);
    var_dump($decoded);

    $encoded = json_encode($decoded, JSON_PRETTY_PRINT);
    echo $encoded;


    echo $output;
    // close curl resource to free up system resources
    // (deletes the variable made by curl_init)
    curl_close($curl);
  }
}
