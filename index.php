<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

define('ENVIRONMENT', 'development');
define('BASE_PATH', __DIR__);
define('STORAGE_PATH', __DIR__ . '/storage');
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST']);

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

Router::get('/', 'Home@index');

Router::get('/wuthering-waves/characters', 'WutheringWaves\\Characters@index');
Router::get('/wuthering-waves/characters/(\w+)', 'WutheringWaves\\Characters@character');
Router::get('/wuthering-waves/inventory', 'WutheringWaves\\Inventory@index');
Router::get('/wuthering-waves/plan', 'WutheringWaves\\Plan@index');
