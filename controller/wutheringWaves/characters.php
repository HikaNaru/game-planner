<?php

namespace GamePlanner\Controller\WutheringWaves;

use GamePlanner\Libraries\App;
use GamePlanner\Libraries\Controller\WutheringWaves;
use GamePlanner\Libraries\Routing\Request;

class Characters extends WutheringWaves
{
    public function index()
    {
        $this->title .= ' - Characters';
        $this->nav = 'characters';
        return view('character-list', $this->getDefaultData());
    }

    public function character(Request $request)
    {
        $params = $request->params;
        $name = App::get($params, 0);
        $this->title .= ' - ' . ucwords($name);
        $this->nav = 'characters';
        return view('character', $this->getDefaultData());
    }
}
