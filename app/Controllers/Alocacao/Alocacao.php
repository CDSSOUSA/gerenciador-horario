<?php

namespace App\Controllers\Alocacao;

use App\Models\SerieModel;
use App\Models\ProfessorModel;
use App\Models\AlocacaoModel;
use App\Models\ProfessorDisciplinaModel;
use App\Controllers\BaseController;

class Alocacao extends BaseController
{
    public $erros = '';
    public $professor;
    public $series;
    public $alocacao;
    public $professorDisciplina;

    public function __construct()
    {
        $this->professor = new ProfessorModel();
        $this->series = new SerieModel();
        $this->alocacao = new AlocacaoModel();
        $this->professorDisciplina = new ProfessorDisciplinaModel();
    }

    public function index()
    {
        $msgs = [
            'message' => '',
            'alert' => ''
        ];
        if (session()->has('erro')) {
            $this->erros = session('erro');
            $msgs = $this->messageErro;
        }
        $data = array(
            'title' => 'Alocar Professor',
            'msgs' => $msgs,
            'erro' => $this->erros,
            'professores' => $this->professor->orderBy('nome')->findAll(),
            'professoresDisciplinas' => $this->professorDisciplina->getAllProfessorDisciplina()
        );
        return view('alocacao/list-professor-alocacao', $data);
    }

    public function add($idProfessor){
        $msgs = [
            'message' => '',
            'alert' => ''
        ];
       
        if (session()->has('erro')) {            
            $this->erros = session('erro');
            $msgs = $this->messageErro;
        }
       
        if(session()->get ('success')){           
            $msgs = $this->messageSuccess;
        }
        session()->destroy();
        
        $data = array(
            'title' => 'Alocar Professor',
            'msgs' => $msgs,
            'erro' => $this->erros,
            'professor' => $this->professor->find($idProfessor),
            'series' => $this->series->getSeries(),
            //'professoresDisciplinas' => $this->professorDisciplina->getAllProfessorDisciplina(),
            'alocacao' => $this->alocacao->getAllAlocacaoProfessor($idProfessor)
        );
        return view('alocacao/add-alocacao-etp02', $data);
    }

    /*public function add_etp02($id)
    {

        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/admin/blog');
        }

        $val = $this->validate(
            [
                'nIdProfessor' => 'required',
            ],
            [
                'nIdProfessor' => [
                    'required' => 'Preenchimento Obrigatório!',

                ],

            ]
        );

        if (!$val) {
            return redirect()->back()->withInput()->with('erro', $this->validator);
            //return redirect()->to('/admin/blog');
        } else {


            $data['msgs'] = [
                'message' => '',
                'alert' => ''
            ];
            $data['title'] = 'Alocar Professor';
            $data['erro'] = '';
            $data['professor'] = $this->professor->find($this->request->getPost('nIdProfessor'));
            $data['series'] = $this->series->getSeries();
            $data['alocacao'] = $this->alocacao->getAllAlocacaoProfessor($this->request->getPost('nIdProfessor'));
            
            return view('alocacao/add-alocacao-etp02/'.$id, $data);
        }
    }*/

    public function add_etp02()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/admin/blog');
        }
        $val = $this->validate(
            [
                'nIdProfessor' => 'required',
                //'nDiaSemana' => 'required'
            ],
            [
                'nIdProfessor' => [
                    'required' => 'Preenchimento Obrigatório!',
                ],
                /*'ndDiaSemana' => [
                    'required' => 'Preenchimento Obrigatório',
                ] */   

            ]
        );
        if (!$val) {
            return redirect()->back()->withInput()->with('erro', $this->validator);
            //return redirect()->to('/admin/blog');
        } 

        $data['diaSemana'] = $this->request->getPost('nDiaSemana[]');
        $data['idProfessor'] = $this->request->getPost('nIdProfessor');
       
        $this->alocacao->salvar($data);
    }

    public function delete()
    {
        $idAlocacao = $this->request->getPost('id');

        $dataProfessor = $this->alocacao->getProfessorIdAlocacao($idAlocacao);

        if ($dataProfessor) {
            $data['title'] = 'Alocar Professor';
            $data['erro'] = '';
            $data['professor'] = $this->professor->find($dataProfessor['id_professor']);
            $data['series'] = $this->series->getSeries();
            $data['alocacao'] = $this->alocacao->getAllAlocacaoProfessor($dataProfessor['id_professor']);
            
            if($this->alocacao->delete($idAlocacao)){
                $data['msgs'] = $this->messageSuccess;
            $data['professores'] = $this->professor->orderBy('nome')->findAll();             
           
            session()->set(['success'=>true]);

            return $this->add($dataProfessor['id_professor']);

            }

            session()->set(['success'=>false]);
            return $this->add($dataProfessor['id_professor']);
            //return redirect()->to("alocacao/add_etp02");

        //return $parser->render('alocacao/add-alocacao-etp02');
        }
        //return redirect()->to('/alocacao');
        //return view('alocacao/add/'.$dataProfessor['id_professor'], $data);
    }
}
