<?php

use App\Models\ProfessorDisciplinaModel;

echo $this->extend('layouts/main');
echo $this->section('content'); ?>
<div class="col-lg-12">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Horizontal Form</h5>
            <?php if ($msgs['alert']) : ?>
                <div class="alert alert-<?= $msgs['alert'] ?> bg-<?= $msgs['alert'] ?> text-light border-0 alert-dismissible fade show" role="alert">
                    <?= $msgs['message']; ?>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
           
            <div class="row mb-12">   
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Disciplina(s)</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = 1; 
                        foreach($professores as $data):?>
                        <tr>
                            <td><?=$contador++;?></td>
                            <td><?=$data['nome'];?></td>
                            <td>
                                <?php 
                                $alocacao = new ProfessorDisciplinaModel();
                                $disciplina = $alocacao->getIdProfessorDisciplina($data['id']);
                                
                             
                                
                                foreach ($disciplina as $item):

                                    $separador = count($disciplina) > 1 && end($disciplina)['descricao'] !=  $item['descricao'] ? ' | ': '';
                                    
                                    echo convertDiscipline($item['descricao']).$separador;
                                endforeach;
                                ?>
                            </td>
                            <td><?=anchor('alocacao/add/'.$data['id'],'Adicionar');?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>            
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>