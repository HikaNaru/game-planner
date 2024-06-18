<?php

namespace GamePlanner\Controller\WutheringWaves;

use GamePlanner\Libraries\App;
use GamePlanner\Libraries\Controller\WutheringWaves;
use GamePlanner\Libraries\Data;

class Inventory extends WutheringWaves
{
    public function index()
    {
        $this->title .= ' - Characters';
        $this->nav = 'inventory';

        $materials = [];
        $materialsData = Data::getMaterials($this->game);
        foreach ($materialsData as $key => $mat) {
            if ($key === 'shellCredit') {
                $materials[] = $mat;
                continue;
            }
            if ($key === 'common' || $key === 'forgery') {
                foreach ($mat as $m) {
                    foreach ($m as $d) {
                        $materials[] = $d;
                    }
                }
                continue;
            }

            foreach ($mat as $m) {
                $materials[] = $m;
            }
        }
        
        $data = [...$this->getDefaultData(), ...['materials' => $materials]];
        return view('inventory', $data);
    }
}
