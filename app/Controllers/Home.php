<?php

namespace App\Controllers;

use App\Controllers\Horario\Horario as HorarioController;

class Home extends BaseController
{
    public function index()
    {
        $n = new HorarioController();
        return $n->index();
    }
}
