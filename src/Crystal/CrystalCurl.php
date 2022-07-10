<?php


class CrystalCurl
{
  /**
   * Pulls a JSON string from the specified API URL and returns it.
   *
   * @param string $api_string - JSON string returned from the specified URL
   * @return bool|string
   */
  public static function apiCurl(string $api_string = 'https://api.crystal-d.com/codetest'): string
  {

    // Open and get the cURL string
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $api_string);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, CURL_IPRESOLVE_V4);

    // curl_exec() executes the started curl session
    $output = curl_exec($curl);

    // close curl resource to free up system resources
    // (deletes the variable made by curl_init)
    curl_close($curl);

    return $output;
  }
}
