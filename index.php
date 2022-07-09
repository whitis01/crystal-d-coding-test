<?php

require __DIR__ . '/src/Crystal/CrystalCurl.php';
/**
 * @TODO - remove before submitting... maybe
 */
require __DIR__ . '/lib/helpers.php';

$json = CrystalCurl::apiCurl();

//echo $json;

$page = CrystalCurl::renderPage($json);


echo $page;

