<?php

namespace GamePlanner\Libraries;

class View
{
    private static $instance;
    private $blocks = [];
    private $script;

    public static function instance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function getBlocks()
    {
        return $this->blocks;
    }

    public function script()
    {
        return $this->script;
    }

    public function block($path, $data = [])
    {
        $view = new static();
        $this->blocks[] = $view;
        return $view->render($path, $data, true);
    }

    private function makePath($path, $isBlock = false)
    {
        $defaultPath = BASE_PATH . '/views/';
        if ($isBlock) {
            $defaultPath .= 'block/';
        }

        return $defaultPath . $path . '.php';
    }

    public function render($path, $data = [], $isBlock = false)
    {
        $path = $this->makePath($path, $isBlock);

        extract($data);
        ob_start();
        include($path);
        $content = ob_get_clean();

        if ($isBlock) {
            preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $content, $matches);
            $this->script = trim($matches[1]);
            $content = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $content);
        }

        echo $content;
    }

    private function getScripts(View $view, $scripts = '')
    {
        $scripts .= $view->script();
        foreach ($view->getBlocks() as $block) {
            $scripts .= $this->getScripts($block, $scripts);
        }

        return $scripts;
    }

    public function renderScript()
    {
        $scripts = $this->getScripts($this);
        $scripts .= PHP_EOL;
        return $scripts;
    }
}
