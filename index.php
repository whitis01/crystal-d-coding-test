<?php

require __DIR__ . '/src/Crystal/CrystalCurl.php';

$json = CrystalCurl::apiCurl();

//echo $json;

echo CrystalCurl::buildTable($json);


