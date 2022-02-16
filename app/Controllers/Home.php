<?php

namespace App\Controllers;

use App\Controllers\Horario\Horario as HorarioController;

class Home extends BaseController
{
    public function index()
    {
        //return view('main/content');

        $n = new HorarioController();
        return $n->index();

    }

    
}
