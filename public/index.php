<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
use vendor\autoload;

new autoload();
$app = new \libs\App();
$app->run();