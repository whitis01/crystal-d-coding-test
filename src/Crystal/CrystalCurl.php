<?php


class CrystalCurl {

  CONST PEOPLE = 'people';

  CONST HOBBIES = 'hobbies';

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
   * @TODO - move the HTML wrapper to a separate function and call this from there
   * Build up the table and assign a hobby
   *
   * @param string $json
   * @return string
   */
  public static function renderPage(string $json = '') : string {

    // Open the table and populate it
    $table = '<table>';

    // Add the head
    $heads = self::getHeads($json, self::PEOPLE);
    $table .= self::buildHeader($heads);

    // Close out the table and return
    $table .='</table>';
    return
      '<html>
        <head>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
            crossorigin="anonymous">
          <link rel="stylesheet" href="/resources/css/tables.css">
        </head>
        <body>'.$table.'</body>
       </html>';
  }

  /**
   * Get headers for the table
   *
   * @param array $heads
   * @return string
   */
  private static function buildHeader(array $heads) : string {

    // Build the header and assign a class for CSS
    $header = '<tr class="header">';

    $headings = array_pop($heads);

    foreach ($headings as $head => $key) {
      // Check if the header is the key to an array
      if (is_array($head)) {
        $key = array_keys($head);
        $header .= '<th>' . ucfirst($key[0]) . '</th>';
        // Kick out, we got what we needed this time around
        continue;
      }
      $header .= "<th>".ucfirst($head)."</th>";
    }

    // Close out and return
    $header .= '</tr>';
    return $header;
  }

  /**
   * This gets the heads for a particular table.
   *
   * @param string $json
   * @param string $table
   *
   * @return array
   */
  private static function getHeads(string $json, string $table = self::PEOPLE) : array {

    // Each table needs headers, so get the first record of the data for a specified table and return
    $tables = json_decode($json, JSON_OBJECT_AS_ARRAY);
    $headers = [];
    foreach($tables[$table] as $head) {
      $headers[] = $head;
    }

    return $headers;
  }
}
