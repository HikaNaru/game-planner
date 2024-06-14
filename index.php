<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

define('ENVIRONMENT', 'development');
define('STORAGE_PATH', __DIR__ . '/storage');

error_reporting(E_ALL);

use GamePlanner\Libraries\App;
use GamePlanner\Libraries\Session;
use GamePlanner\Libraries\Routing\Router;
use GamePlanner\Libraries\Routing\Request;
use GamePlanner\Libraries\Routing\Response;

App::run();

Router::get('/', function() {
    $session = Session::instance();
    echo $session->account;
});

Router::get('/asd', function() {
    $session = Session::instance();
    echo $session->account;
});