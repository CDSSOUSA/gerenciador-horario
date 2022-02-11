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
    public function index()
    {
        $msg = [
            'message'=>'',
            'alert'=>''
        ];
        $data = array(
            'title'=>'Cadastrar Horário',
            //'blogAtual' => $this->blog->find($id),
            //'blogs' => $this->blog->blogRecents($id),
            //'horarioSegunda' => $this->horarioSegunda->getHorarioDiaSemana(2,1),
            'msgs' => $msg,
            'series' => $this->series->getSeries()
            //'erro' => $this->erros
        );
        return view('horario/horario', $data);
    }

    public function addProfissionalHorario($id_serie, $dia_semana, $posicao)
    {
        $msg = [
            'message'=>'',
            'alert'=>''
        ];
        if(session()->has('erro')){
			$this->erros = session('erro');
			$msg = [
				'message' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-diamond-fill" viewBox="0 0 16 16">
                <path d="M9.05.435c-.58-.58-1.52-.58-2.1 0L.436 6.95c-.58.58-.58 1.519 0 2.098l6.516 6.516c.58.58 1.519.58 2.098 0l6.516-6.516c.58-.58.58-1.519 0-2.098L9.05.435zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </svg> Ops! Erro(s) no preenchimento!',
				'alert'=>'danger'
			];
		}

        $data = array(
            'title'=>'Adicionar Profissional ao Horário',            
            'msgs' => $msg,
            'diaSemana' => $dia_semana,
            'idSerie' => $this->series->getSerie($id_serie),
            'posicao' => $posicao,
            'professores' => $this->alocacaoProfessor->getAlocacaoProfessor($dia_semana, $posicao,$id_serie),
            'msgs' => $msg,
			'erro' => $this->erros

            //'series' => $this->series->getSeries()
            //'erro' => $this->erros
        );
        return view('horario/add-profissional-horario', $data);

    }

    public function add()
    {
        if($this->request->getMethod() !== 'post'){
			return redirect()->to('/admin/blog');
		}

        $val = $this->validate(
            [
                'nProfessor' => 'required',        	
		    ],
		    [
                'nProfessor' => [
				    'required' => 'O campo PROFESSOR tem preenchimento obrigatório!',
				],
            ]
	);

        if(!$val){
            return redirect()->back()->withInput()->with('erro', $this->validator);
            //return redirect()->to('/admin/blog');
        }
        else{

            $idAlocacao = $this->request->getPost('nProfessor');            
            $dado = $this->alocacaoProfessor->find($idAlocacao);      
            $horario['id_professor'] = $dado['id_professor']; 
            $horario['nome'] = word_limiter($this->professor->getNomeProfessor($dado['id_professor'])->nome, 1,'');
            $horario['dia_semana'] = $this->request->getPost('ndiaSemana');
            $horario['posicao_aula'] = $this->request->getPost('nPosicao');
            $horario['id_serie'] = $this->request->getPost('nSerie');
            $horario['id_ano_letivo'] = 1;
            $horario['status'] = 'A';

            $alocacao['id'] = $idAlocacao;
            $alocacao['id_professor'] = $dado['id_professor'];
            $alocacao['nome'] = $dado['nome'];
            $alocacao['dia_semana'] = $dado['dia_semana'];
            $alocacao['posicao_aula'] = $dado['posicao_aula'];
            $alocacao['id_serie'] = $dado['id_serie'];
            $alocacao['status'] = $dado['status'];
            $alocacao['situacao'] = 'O';
            
            if($this->horario->save($horario)){

                $this->alocacaoProfessor->save($alocacao);

                $data['msgs']= [
                    'message'=>'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                    <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                  </svg> Parabéns! Horário adicionado com sucesso!',
                    'alert'=>'success'
                ];
                $data['title']= 'Cadastrar Horário';
                $data['erro'] = '';
                $data['series'] = $this->series->getSeries();            
                
                return view('horario/horario', $data);
                
            }
        }
    }

}