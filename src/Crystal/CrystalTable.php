<?php

class CrystalTable {
  const PEOPLE = 'people';

  const HOBBIES = 'hobbies';

  public static function buildTable($json) : string {

    // Add the head
    $items = self::getItems($json);
    $table = self::buildHeader($items);
    $table .= self::buildBody($json, $items);

    return $table;
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

      // Check if the header is a three letter acronym. This is not overly accurate in future cases.
      $head = strlen($head) === 3 ? strtoupper($head) : ucfirst($head);

      $header .= '<th onclick="sortTable('.$columnNumber.')">'.$head.'</th>';
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
