<?php

require __DIR__ . '/src/Crystal/CrystalCurl.php';

$json = CrystalCurl::apiCurl();

//echo $json;

$page = CrystalCurl::renderPage($json);


echo $page;

