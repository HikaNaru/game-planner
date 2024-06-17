<?php

namespace GamePlanner\Libraries\Controller;

abstract class Base
{
    protected $title;
    protected $game;
    protected $nav;

    public function __construct()
    {
        $this->title = 'Game Planner';
        $this->game = 'home';
        $this->nav = '';
    }

    public function getDefaultData()
    {
        return [
            'title' => $this->title,
            'game' => $this->game,
            'nav' => $this->nav
        ];
    }
}
