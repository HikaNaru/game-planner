<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

define('ENVIRONMENT', 'development');
define('BASE_PATH', __DIR__);
define('STORAGE_PATH', __DIR__ . '/storage');

error_reporting(E_ALL);

use GamePlanner\Libraries\App;
use GamePlanner\Libraries\View;
use GamePlanner\Libraries\Routing\Router;
use GamePlanner\Libraries\Routing\Request;
use GamePlanner\Libraries\Routing\Response;

App::run();

if (!function_exists('view')) {
    function view()
    {
        $view = View::instance();
        call_user_func_array([$view, 'render'], func_get_args());
    }
}

Router::get('/', function () {
    return view('page');
});
