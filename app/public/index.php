<?php

require_once dirname(__DIR__,2) . '/vendor/autoload.php';

use App\App;
use Bootstrap\Bootstrap;
use Framework\Http\Kernel;
use Framework\Http\Request;
define('BASE_PATH', dirname(__DIR__, 2));

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Bootstrap::start();

$app = new App(
    Request::createFromGlobals(),
    new Kernel(),
);

$app->run();

