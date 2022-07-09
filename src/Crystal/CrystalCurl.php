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
    $table = '<table id="people">';

    // Add the head
    $items = self::getItems($json);
    $table .= self::buildHeader($items);
    $table .= self::buildBody($json, $items);

    // Close out the table and return
    $table .='</table>';
    return
      '<html>
        <head>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
            crossorigin="anonymous">
          <link rel="stylesheet" href="/resources/css/tables.css">
          <script src="/resources/js/switcher.js"></script>
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

    $columnNumber = 0;
    foreach ($headings as $head => $key) {
      // Check if the header is the key to an array
      if (is_array($key)) {
        continue;
      }
      $header .= '<th onclick="sortTable('.$columnNumber.')">'.ucfirst($head).'</th>';
      $columnNumber++;
    }

    // Close out and return
    $header .= '</tr>';
    return $header;
  }

  private static function buildBody(string $json, array $items) : string {

    $body = '<tr class="body-element">';

    foreach ($items as $key => $value) {
      $hobby = 'Liking Broccoli';
      foreach ($value as $criterion) {
        if (is_array($criterion)) {

          $hobby = self::findAHobby($json, $criterion);
          continue;
        }
        if (is_null($criterion)) {
          continue;
        }
        // Check if the header is the key to an array

        $body .= '<td>'.$criterion.'</td>';
      }
      $body .= '<td>'.$hobby.'</td>';
      $body .= '</tr>';
    }


    return $body;
  }

  /**
   * This gets the heads for a particular table.
   *
   * @param string $json
   * @param string $table
   *
   * @return array
   */
  private static function getItems(string $json, string $table = self::PEOPLE) : array {

    // Each table needs headers, so get the first record of the data for a specified table and return
    $tables = json_decode($json, JSON_OBJECT_AS_ARRAY);
    $headers = [];
    foreach($tables[$table] as $head) {
      $headers[] = $head;
    }

    return $headers;
  }

  /**
   * Get the hobby of the individual by the person's interest.
   *
   * @param string $json
   * @param array $interests
   *
   * @return string
   */
  private static function findAHobby(string $json, array $interests) : string {

    $hobbies = self::getItems($json, self::HOBBIES);

    // This is a mess. We could find more hobbies if we save all the hobbies and then use a random number, but for
    // this exercise one will suffice.
    foreach ($interests as $interest) {
      foreach ($hobbies as $hobby => $interestingThings) {
        foreach ($interestingThings as $interestingThing) {
          if ($interestingThing === $interest) {
            return $interest;
          }
        }
      }
    }

    return 'Agorophobia';
  }
}
