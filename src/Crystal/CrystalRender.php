<?php

require __DIR__ . '/CrystalTable.php';

class CrystalRender {
  /**
   * Build up the table and assign a hobby
   *
   * @param string $json
   *
   * @return string $string
   */
  public static function renderPage(string $json = '') : string {
    return
      '<html lang="en">
        <head>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
          crossorigin="anonymous">
          <link rel="stylesheet" href="/src/resources/css/tables.css">
          <script src="/src/resources/js/switcher.js"></script>
          <title>Crystal D Code Test</title>
        </head>
        <h1>Click A Header To Sort Alpha-Numerically</h1>
        <body>
          <table id="people">' .CrystalTable::buildTable($json).'</table>
        </body>
      </html>';
  }

}