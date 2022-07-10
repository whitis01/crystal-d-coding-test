<?php

require __DIR__ . '/src/Crystal/CrystalTable.php';

class CrystalRender {
  /**
   * @TODO - move html into php/html combo file... figure it out.
   * Build up the table and assign a hobby
   *
   * @param string $json
   * @return $string
   */
  public static function renderPage(string $json = '') : string {
    return
      '<html>
        <head>
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
          crossorigin="anonymous">
          <link rel="stylesheet" href="/src/resources/css/tables.css">
          <script src="/src/resources/js/switcher.js"></script>
        </head>
        <body>
          <table id="people">'.CrystalTable::buildTable($json).'</table>
        </body>
      </html>';
  }

}