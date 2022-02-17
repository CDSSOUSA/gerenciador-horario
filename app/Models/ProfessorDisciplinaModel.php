<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfessorDisciplinaModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'tb_professor_disciplina';
    protected $primaryKey           = 'id';
    //protected $returnType           = 'array';
    protected $allowedFields = ['id_professor', 'id_disciplina', 'id_serie'];


    public function getAllProfessorDisciplina(): array
    {
        return $this->select('p.nome, d.descricao,'.$this->table.'.id,'.$this->table.'.id_professor')
        ->join('tb_professor p','p.id ='.$this->table.'.id_professor')
        ->join('tb_disciplina d','d.id ='. $this->table.'.id_disciplina')
        ->orderBy('p.nome')
        ->findAll();
    }
    public function getIdProfessorDisciplina(int $idProfessor): array{
        return $this->select('d.descricao,'.$this->table.'.id,'.$this->table.'.id_professor')
        ->join('tb_disciplina d','d.id ='. $this->table.'.id_disciplina') 
        ->where($this->table.'.id_professor', $idProfessor)       
        ->findAll();
    }
}
