<?php

namespace App\Controllers\Professor;

use App\Models\ProfessorModel;
use App\Controllers\BaseController;

class Professor extends BaseController
{
    public $erros = '';
    public $professor;

    public function __construct()
    {
        $this->professor = new ProfessorModel();
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
            'title' => 'Adicionar Professor',
            'msgs' => $msgs,
            'erro' => $this->erros

            //'series' => $this->series->getSeries()
            //'erro' => $this->erros
        );
        //session()->set('dado',$data);
        return view('professor/add-professor', $data);
    }

    public function add()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/admin/blog');
        }

        $val = $this->validate(
            [
                'nNome' => 'required|min_length[3]',
                'nNumeroAulas' => 'required',
                'nCorDestaque' => 'required',
            ],
            [
                'nNome' => [
                    'required' => 'O campo NOME tem preenchimento obrigatório!',
                    'min_length' => 'Mínimo permitido 3 caracteres!'
                ],
                'nNumeroAulas' => [
                    'required' => 'O campo QUANTIDADE AULAS tem preenchimento obrigatório!',
                ],
                'nCorDestaque' => [
                    'required' => 'O campo COR DESTAQUE tem preenchimento obrigatório!',
                ],
            ]
        );

        if (!$val) {
            return redirect()->back()->withInput()->with('erro', $this->validator);
            //return redirect()->to('/admin/blog');
        } else {

            $professor['nome'] = mb_strtoupper($this->request->getPost('nNome'));
            $professor['qtde_aula'] = $this->request->getPost('nNumeroAulas');
            $professor['cor_destaque'] = $this->request->getPost('nCorDestaque');
            $professor['status'] = 'A';

            if ($this->professor->save($professor)) {

                $data['msgs'] = [
                    'message' => '<i class="fas fa-exclamation-triangle"></i> Parabéns! Professor adicionado com sucesso!',
                    'alert' => 'success'
                ];
                $data['title'] = 'Cadastrar Professor';
                $data['erro'] = '';
                //$data['series'] = $this->series->getSeries();            

                //return view('professor/add-professor', $data);
                session()->remove('dado');
                session()->set('dado', $data);
                return redirect()->to('/professor');
            }
        }
    }
}
