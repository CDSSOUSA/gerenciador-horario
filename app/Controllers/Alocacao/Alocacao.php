<?php

namespace App\Controllers\Alocacao;

use App\Models\SerieModel;
use App\Models\ProfessorModel;
use App\Models\AlocacaoModel;
use App\Controllers\BaseController;

class Alocacao extends BaseController
{
    public $erros = '';
    public $professor;
    public $series;
    public $alocacao;

    public function __construct()
    {
        $this->professor = new ProfessorModel();
        $this->series = new SerieModel();
        $this->alocacao = new AlocacaoModel();
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
        );
        return view('alocacao/add-alocacao', $data);
    }

    public function add_etp02()
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
            
            return view('alocacao/add-alocacao-etp02', $data);
        }
    }

    public function delete($idAlocacao)
    {
        $dataProfessor = $this->alocacao->getProfessorIdAlocacao($idAlocacao);

        if ($dataProfessor) {
            $data['title'] = 'Alocar Professor';
            $data['erro'] = '';
            $data['professor'] = $this->professor->find($dataProfessor['id_professor']);
            $data['series'] = $this->series->getSeries();
            $data['alocacao'] = $this->alocacao->getAllAlocacaoProfessor($dataProfessor['id_professor']);
            $this->alocacao->excluir($idAlocacao);
            $data['msgs'] = $this->messageSuccess;
            $data['professores'] = $this->professor->orderBy('nome')->findAll();

            $parser = \Config\Services::renderer();
            //$parser->setData($this->style);
            $parser->setData($data);
            //$parser->setData($this->dataHeader);
            //$parser->setData($this->javascript);            
           

            return view('alocacao/add-alocacao', $data);
        }
        return redirect()->to('/alocacao');
    }
}
