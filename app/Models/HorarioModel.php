<?php

namespace App\Models;

use CodeIgniter\Model;

class HorarioModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'tb_horario';
    protected $primaryKey           = 'id';
    protected $allowedFields = ['id_professor_alocacao', 'dia_semana', 'posicao_aula', 'id_serie', 'id_ano_letivo', 'status'];
    //protected $returnType           = 'object';  

    /**
     * Retorna o horario do professor
     *
     * @param int @diaSemana
     * @param int @idSerie
     * @param int @posicao
     * @return array
     */


    public function getHorarioDiaSemana(int $diaSemana, int $idSerie, int $posicao): array
    {

        /*$result = $this->select('h.id, h.id_professor, p.cor_destaque')
                        ->from('tb_professor p')
                        ->join('tb_horario h', 'p.id = h.id_professor')                        
                        ->where('h.dia_semana', $diaSemana)
                        ->where('h.id_serie', $idSerie)
                        ->where('h.posicao_aula', $posicao)
                        ->get()->getRowArray();
        
        return !is_null($result) ? $result : [];*/

        $result = $this->select('p.nome, h.id_professor_alocacao, p.cor_destaque, d.descricao')
            ->from('tb_horario h')
            ->join('tb_alocacao_professor ap', 'h.id_professor_alocacao = ap.id')
            ->join('tb_professor_disciplina pd', 'ap.id_professor = pd.id')
            ->join('tb_disciplina d', 'pd.id_disciplina = d.id')
            ->join('tb_professor p', 'pd.id_professor = p.id')
            ->where('h.dia_semana', $diaSemana)
            ->where('h.id_serie', $idSerie)
            ->where('h.posicao_aula', $posicao)
            ->get()->getRowArray();            
            return !is_null($result) ? $result : [];
    }

    public function getHorarioPosicao(int $posicao): array
    {

        $result = $this->where('posicao_aula', $posicao)
            ->findAll();

        return !is_null($result) ? $result : [];
    }

    /**
     * Retorna um usuário pelo seu e-mail
     *
     * @param string $email
     * @return array
     */
    public function getByEmail(int $diaSemana): array
    {
        $rq =  $this->where('dia_semana', $diaSemana)->first();

        return !is_null($rq) ? $rq : [];
    }
}
