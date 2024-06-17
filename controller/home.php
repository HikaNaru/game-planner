<?php

namespace GamePlanner\Controller;

use GamePlanner\Libraries\Controller\Base;

class Home extends Base {
    public function index() {
        return view('page', $this->getDefaultData());
    }
}