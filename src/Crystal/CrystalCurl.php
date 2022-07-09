<?php


class CrystalCurl {

  /**
   * Pulls a JSON string from the specified API URL and returns it.
   *
   * @param string $api_string - JSON string returned from the specified URL
   * @return bool|string
   */
  public static function apiCurl(string $api_string = 'https://api.crystal-d.com/codetest') : string {

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

  /**
   * @TODO - assign a hobby
   * Build up the table and assign a hobby
   *
   * @param string $json
   * @return string
   */
  public static function buildTable(string $json = '') : string {

    $table = '<table>';
    $heads = self::getHeads($json, 'people');
    $table .= self::buildHeader($heads);
    $table .='</table>';

    return $table;
  }

  /**
   * Get headers for the table
   *
   * @param array $heads
   * @return string
   */
  private static function buildHeader(array $heads) : string {

    $header = '<tr>';

    $headings = array_pop($heads);

    foreach ($headings as $head => $key) {
      if (is_array($head)) {
        $key = array_keys($head);
        $header .= '<th>' . $key[0] . '</th>';
        continue;
      }
      $header .= "<th>$head</th>";
      echo $header;
    }

    $header .= '</tr>';
    return $header;
  }

  /**
   * @TODO - add a parameter for people|hobbies tables
   * Get the heads for a particular table
   *
   * @param string $json
   * @return array
   */
  private static function getHeads(string $json) : array {

    $encode = json_decode($json, JSON_OBJECT_AS_ARRAY);
    $heads = [];
    foreach($encode['people'] as $key => $value) {
      $heads[] = $value;
    }

    return $heads;
  }
}
