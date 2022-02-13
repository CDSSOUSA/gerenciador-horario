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

    /**
     * [Description for getSeries]
     *
     * @return array
     * 
     */
    public function getSeries(): array
    {
        $this->orderBy('descricao');
        $result = $this->findAll();        
        return !is_null($result) ? $result : [];
    }

    /**
     * [Description for getSerie]
     *
     * @param string $id_serie
     * 
     * @return array
     * 
     */
    public function getSerie(string $id_serie): array
    {

        $result = $this->find($id_serie);
        return $result;

    }
   
}
