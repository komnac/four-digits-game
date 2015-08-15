<?php

require_once(__DIR__ . '/vendor/autoload.php');

$app = new My\App\Application(__DIR__ . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR . 'config.php');
$app->run();
