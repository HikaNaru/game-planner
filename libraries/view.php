<?php

namespace GamePlanner\Libraries;

class View
{
    private static $instance;
    private $sections;
    private $js;

    const PATH = BASE_PATH . '/views/';

    public function __construct()
    {
        $this->sections = [];
        $this->js = [];
    }

    public static function instance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function js()
    {
        return $this->js;
    }

    private function makePath($path)
    {
        return $path ? static::PATH . $path . '.php' : '';
    }

    public function render($path, $data = [], $isBlock = false)
    {
        $result = '';
        $view = $this->makePath($path);

        extract($data);
        ob_start();
        include($view);
        $content = ob_get_clean();

        $extend = $this->getExtend($content);
        $this->sections = [...$this->sections, ...$this->getSections($content)];

        if (strlen($extend) > 0 || $isBlock) {
            preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $content, $matches);
            if (isset($matches[1])) {
                $this->js[] = trim($matches[1]);
            }
            $content = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $content);
        }

        if (strlen($extend) > 0) {
            ob_start();
            include($extend);
            $extendContent = ob_get_clean();
            $result = $extendContent . PHP_EOL;
        } else {
            $result = $content;
        }

        echo $result;
    }

    private function getExtend(&$content)
    {
        $path = '';
        preg_match('/<extend\b[^>]*>(.*?)<\/extend>/is', $content, $matches);
        if (isset($matches[1])) {
            $path = trim($matches[1]);
        }
        $content = preg_replace('/<extend\b[^>]*>(.*?)<\/extend>/is', '', $content);
        return $this->makePath($path);
    }

    private function getSections(&$content)
    {
        $sections = [];
        preg_match_all('/<section\s(.+?)>(.*?)<\/section>/is', $content, $matches);
        $transposed = App::transpose($matches);
        foreach ($transposed as $data) {
            $sections[] = [
                'sectionName' => trim($data[1]),
                'sectionContent' => trim($data[2])
            ];
        }
        $content = preg_replace('/<section\s(.+?)>(.*?)<\/section>/is', '', $content);
        return $sections;
    }

    public function block($path, $data = [])
    {
        return $this->render($path, $data, true);
    }

    public function section($value)
    {
        foreach ($this->sections as $section) {
            $sectionName = App::get($section, 'sectionName');
            $sectionContent = App::get($section, 'sectionContent');
            if ($sectionName == $value) {
                return $sectionContent;
            }
        }

        return '';
    }

    public function scripts()
    {
        $scripts = '';
        foreach ($this->js as $js) {
            $scripts .= $js;
            $scripts .= PHP_EOL;
        }

        return $scripts;
    }
}
