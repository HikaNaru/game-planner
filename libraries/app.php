<?php

namespace GamePlanner\Libraries;

class App
{
    public static function run()
    {
        $whoops = new \Whoops\Run();
        if (ENVIRONMENT !== 'production') {
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
        } else {
            $whoops->pushHandler(function ($e) {

            });
        }
        $whoops->register();

        (new Storage())->haveSaveData();
    }

    public static function get($data, string $key, $default = '')
    {
        $keys = explode('.', trim($key, "\n\r\t\v\."), 2);

        if (is_array($data)) {
            if (count($keys) > 1) {
                return isset($data[$keys[0]]) ? static::get($data[$keys[0]], $keys[1], $default) : $default;
            } else {
                return isset($data[$keys[0]]) ? $data[$keys[0]] : $default;
            }
        }

        if (is_object($data)) {
            if (count($keys) > 1) {
                return property_exists($data, $keys[0]) ? static::get($data->{$keys[0]}, $keys[1], $default) : $default;
            } else {
                return property_exists($data, $keys[0]) ? $data->{$keys[0]} : $default;
            }
        }

        return $default;
    }

    public static function image($path) {
        return './media/img/' . $path;
    }

    public static function dd(...$args)
    {
        foreach ($args as $arg) {
            echo '<pre>';
            print_r($arg);
            echo '</pre>';
        }

        die;
    }
}
