<?php

namespace App\Models;

use CodeIgniter\Model;
use phpDocumentor\Reflection\Types\This;

class SerieModel extends Model
{
    //protected $DBGroup              = 'default';
    protected $table                = 'tb_serie';
    protected $primaryKey           = 'id';   
    //protected $returnType           = 'array';

    public function getSeries(): array{

        $result = $this->findAll();
        
        return !is_null($result) ? $result : [];
    }

    public function getSerie($id_serie): array{

        $result = $this->find($id_serie);
        return $result;

    }
   
}
