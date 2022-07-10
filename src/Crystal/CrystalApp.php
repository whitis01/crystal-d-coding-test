<?php

require __DIR__ . '/src/Crystal/CrystalCurl';
require __DIR__ . '/src/Crystal/CrystalTable';
require __DIR__ . '/src/Crystal/CrystalRender';

class CrystalApp {

  private $page;

  public function __construct__() {
    $this->page = CrystalRender::renderPage(CrystalCurl::apiCurl());
  }

  public function run() : void {
    echo $this->page;
  }
}
