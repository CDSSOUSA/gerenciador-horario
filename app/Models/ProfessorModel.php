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
public function saveProfessor(array $data)
{
    $professor['nome'] = $data['nome'];
    $professor['qtde_aula'] = $data['qtde_aula'];
    $professor['cor_destaque'] = $data['cor_destaque'];
    $professor['status'] = $data['status'];    

    $this->save($professor);
    
}
   
}
