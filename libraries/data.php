<?php

namespace GamePlanner\Libraries;

class Data
{
    public const PATH = BASE_PATH . '/data/';

    public static function getNav()
    {
        $json = file_get_contents(static::PATH . 'nav.json');
        return json_decode($json, true);
    }

    public static function getCharacters($game)
    {
        $json = file_get_contents(static::PATH . $game . '/characters.json');
        return json_decode($json, true);
    }

    public static function getMaterials($game)
    {
        $json = file_get_contents(static::PATH . $game . '/materials.json');
        return json_decode($json, true);
    }
}
