<?php

require __DIR__ . '/CrystalRender.php';
require __DIR__ . '/CrystalCurl.php';

class CrystalApp {
  public static function run() : void {
    echo CrystalRender::renderPage(CrystalCurl::apiCurl());
  }
}
