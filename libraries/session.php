<?php

namespace GamePlanner\Libraries;

class Session
{
    private static $instance;
    private $state = false;

    public static function instance() {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }

        static::$instance->start();

        return static::$instance;
    }

    private function start() {
        if (!$this->state) {
            $this->state = session_start();
        }

        return $this->state;
    }

    public function __set($name, $value) {
        $_SESSION[$name] = $value;
    }

    public function __get($name) {
        return App::get($_SESSION, $name);
    }

    public function __isset($name) {
        return isset($_SESSION[$name]);
    }

    public function __unset($name) {
        unset($_SESSION[$name]);
    }

    public function destroy() {
        if ($this->state) {
            $this->state = !session_destroy();
            unset($_SESSION);

            return !$this->state;
        }

        return false;
    }
}
