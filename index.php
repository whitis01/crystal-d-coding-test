<?php

require __DIR__ . '/src/Crystal/CrystalCurl.php';
/**
 * @TODO - remove before submitting... maybe
 */
require __DIR__ . '/lib/helpers.php';

$app = new CrystalApp($json);

$app->run();

echo $page;

