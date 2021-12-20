<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

new \vendor\autoload();
$app = new \app\core\App();
$app->run();