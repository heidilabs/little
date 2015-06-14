<?php

require_once __DIR__.'/../vendor/autoload.php';

use Little\Application;

$app = new Application([
    'debug'      => true,
    'config.file' => __DIR__ . '/config/config.yml',
]);

$app->run();
