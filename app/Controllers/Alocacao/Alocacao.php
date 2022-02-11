<?php

namespace App\Controllers\Alocacao;

use App\Models\SerieModel;
use App\Models\ProfessorModel;
use App\Controllers\BaseController;

class Alocacao extends BaseController
{
    public $erros = '';
    public $professor;
    public $series;

    public function __construct()
    {
        $this->professor = new ProfessorModel();
        $this->series = new SerieModel();
    }

    public function index()
    {
        $msgs = [
            'message'=>'',
            'alert'=>''
        ];
        if(session()->has('erro')){
			$this->erros = session('erro');
			$msgs = [
				'message'=>'<i class="fas fa-exclamation-triangle"></i> Ops! Erro(s) no preenchimento!',
				'alert'=>'danger'
			];
		}
        $data = array(
            'title'=>'Alocar Professor',            
            'msgs' => $msgs,      
			'erro' => $this->erros,
            'professores' => $this->professor->orderBy('nome')->findAll(),
        );       
        return view('alocacao/add-alocacao', $data);
    }

    public function add_etp02()
    {

        if ($this->request->getMethod() !== 'post') 
        {
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
                $data['professor'] = $this->professor->find($this->request->getPost('nProfessor'));
                $data['series'] = $this->series->findAll();            

                return view('alocacao/add-alocacao-etp02', $data);
                
            
        }

    }
}
