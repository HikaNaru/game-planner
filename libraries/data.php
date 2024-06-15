<?php

namespace GamePlanner\Libraries;

class Data
{
    public static function getNav()
    {
        $json = file_get_contents('./data/nav.json');
        return json_decode($json, true);
    }
}
