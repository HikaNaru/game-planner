<?php

namespace GamePlanner\Libraries\Routing;

class Router
{
    public static function get($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            return;
        }

        static::on($route, $callback);
    }

    public static function post($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
            return;
        }

        static::on($route, $callback);
    }

    public static function on($regex, $cb)
    {
        $params = $_SERVER['REQUEST_URI'];
        $params = (stripos($params, "/") !== 0) ? "/" . $params : $params;
        $regex = str_replace('/', '\/', $regex);
        $isMatch = preg_match('/^' . ($regex) . '$/', $params, $matches, PREG_OFFSET_CAPTURE);
        
        if ($isMatch) {
            array_shift($matches);
            $params = array_map(function ($param) {
                return $param[0];
            }, $matches);

            if (is_callable($cb)) {
                $cb(new Request($params), new Response());
            } else {
                list($className, $methodName) = explode('@', $cb, 2);
                $className = "GamePlanner\Controller\\{$className}";
                $controller = new $className();
                return call_user_func_array([$controller, $methodName], [new Request($params), new Response()]);
            }
        }
    }
}
