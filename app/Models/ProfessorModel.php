<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfessorModel extends Model
{
    
    protected $table                = 'tb_professor';
    protected $primaryKey           = 'id'; 
    //protected $returnType           = 'array';
    protected $allowedFields = ['nome','qtde_aula','cor_destaque','status'];
  

    public function getNomeProfessor($id_professor): object{
        return $result = $this->where('id', $id_professor)                               
                              ->get()->getRow();
}
   
}
