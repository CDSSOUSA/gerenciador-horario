<?php

namespace App\Models;

use CodeIgniter\Model;

class AlocacaoModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'tb_alocacao_professor';
    protected $primaryKey           = 'id';    
    protected $allowedFields = ['id_professor','nome','dia_semana','posicao_aula','id_serie','status','situacao'];
    //protected $returnType           = 'array';


    public function getAlocacaoProfessor(int $diaSemana, int $posicao, int $id_serie ){

        return $result = $this->where('dia_semana', $diaSemana)
                        ->where('status', 'A')
                        ->where('posicao_aula', $posicao)
                        ->where('id_serie', $id_serie)
                        ->where('situacao', 'L')
                        ->findAll();

        //return !is_null($result) ? $result : [];
    }

    public function atualizarHorario($id_professor, $dia_semana, $posicao_aula, $id_serie)
    {     
        $result = $this->where('id_professor', $id_professor)
             ->where('dia_semana', $dia_semana)
             ->where('posicao_aula', $posicao_aula)
             ->where('id_serie', $id_serie)
             ->set('situacao',0)
             ->update();

             if($result){
                return true;
             } else {
                 return false;
             }
        
        
    }

  
    
}