<?php

namespace App\Controllers\Horario;

use App\Models\SerieModel;
use App\Models\HorarioModel;
use App\Controllers\BaseController;
use App\Models\AlocacaoModel;
use App\Models\ProfessorModel;

class Horario extends BaseController
{
    public $horarioSegunda;
    public $series;
    public $alocacaoProfessor;
    public $horario;
    public $professor;
    public $erros = '';

    public function __construct()
    {
        $this->horarioSegunda = new HorarioModel();
        $this->series = new SerieModel();
        $this->alocacaoProfessor = new AlocacaoModel();
        $this->professor = new ProfessorModel();
        $this->horario = new HorarioModel();

        helper('url');
        helper('text');
    }

    /**
     * [Description for index]
     *
     * @return string
     * 
     */
    public function index(): string
    {
        $msg = [
            'message' => '',
            'alert' => ''
        ];
        $data = array(
            'title' => 'Cadastrar Horário',
            //'blogAtual' => $this->blog->find($id),
            //'blogs' => $this->blog->blogRecents($id),
            //'horarioSegunda' => $this->horarioSegunda->getHorarioDiaSemana(2,1),
            'msgs' => $msg,
            'series' => $this->series->getSeries()
            //'erro' => $this->erros
        );
        return view('horario/horario', $data);
    }

    public function addProfissionalHorario(int $id_serie, int $dia_semana, int $posicao): string
    {
        $msg = [
            'message' => '',
            'alert' => ''
        ];
        if (session()->has('erro')) {
            $this->erros = session('erro');
            $msg = $this->messageErro;
        }

        $data = array(
            'title' => 'Adicionar Profissional ao Horário',
            'msgs' => $msg,
            'diaSemana' => $dia_semana,
            'idSerie' => $this->series->getSerie($id_serie),
            'posicao' => $posicao,
            'professores' => $this->alocacaoProfessor->getAlocacaoProfessor($id_serie, $dia_semana, $posicao),
            'msgs' => $msg,
            'erro' => $this->erros

            //'series' => $this->series->getSeries()
            //'erro' => $this->erros
        );
        return view('horario/add-profissional-horario', $data);
    }

    public function add()
    {
       
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/admin/blog');
        }

        $val = $this->validate(
            [
                'nIdAlocacao' => 'required',
            ],
            [
                'nIdAlocacao' => [
                    'required' => 'O campo PROFESSOR tem preenchimento obrigatório!',
                ],
            ]
        );     

        if (!$val) {
            return redirect()->back()->withInput()->with('erro', $this->validator);            
        }

        $idAlocacao = $this->request->getPost('nProfessor');
        //$dado = $this->alocacaoProfessor->find($idAlocacao);
        $horario['id_professor_alocacao'] = $this->request->getPost('nIdAlocacao');
        //$horario['nome'] = word_limiter($this->professor->getNomeProfessor($dado['id_professor'])->nome, 1, '');
        $horario['dia_semana'] = $this->request->getPost('ndiaSemana');
        $horario['posicao_aula'] = $this->request->getPost('nPosicao');
        $horario['id_serie'] = $this->request->getPost('nSerie');
        $horario['id_ano_letivo'] = 1;
        $horario['status'] = 'A';
       
        /* BUSCAR DADOS DA ALOCAÇÃO PARA MODIFICAR */
        $dadoAlocacao = $this->alocacaoProfessor->find($this->request->getPost('nIdAlocacao'));
        $alocacao['id'] = $dadoAlocacao['id'];
        $alocacao['id_professor'] = $dadoAlocacao['id_professor'];        
        $alocacao['dia_semana'] = $dadoAlocacao['dia_semana'];
        $alocacao['posicao_aula'] = $dadoAlocacao['posicao_aula'];        
        $alocacao['status'] = $dadoAlocacao['status'];
        $alocacao['situacao'] = 'O';

        if ($this->horario->save($horario)) {

            $this->alocacaoProfessor->save($alocacao);

            $data['msgs'] = $this->messageSuccess;
            $data['title'] = 'Cadastrar Horário';
            $data['erro'] = '';
            $data['series'] = $this->series->getSeries();

            return view('horario/horario', $data);
        }           
    }
}
