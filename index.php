<?php

require_once(__DIR__ . '/vendor/autoload.php');

$app = new My\App\Application(__DIR__ . 'config');
$app->run();
