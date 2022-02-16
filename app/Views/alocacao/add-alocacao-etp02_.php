<?php

echo $this->extend('layouts/default'); ?>
<?= $this->section('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo anchor('/alocacao', '<button type="button" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
</svg>
              </button>');
                        echo ' ' . $title; ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div>
    </div>

    <div class="row g-5">

        <div class="col-md-7 col-lg-8">
            <div class=" border-left-<?= $msgs['alert'] ?> alert alert-show alert-<?= $msgs['alert'] ?>">
                <strong><?= $msgs['message']; ?></strong>
            </div>

            <?php echo form_open('horario/add', ['class' => 'needs-validation']) ?>
            <div class="row g-3">
                <div class="col-md-5">
                    <label for="country" class="form-label">Professor(a):</label>
                    <input type="text" disabled="true" name="" class="form-control" value="<?= $professor['nome'] . '  -  ' . $professor['qtde_aula'] . ' hora-aula'; ?>">
                    <input type="hidden" name="nNome" alue="<?= $professor['nome']; ?>">
                    <input type="text" name="nIdProfessor" value="<?= $professor['id']; ?>">
                </div>

                <div class="col-sm-6">
                    <label for="firstName" class="form-label">Dia Semana:</label>                    
                    <?php for ($i = 2; $i <= 6; $i++): ?>  
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="nDiaSemana<?=$i;?>" value="<?=set_checkbox('nDia'.$i);?>" type="checkbox" role="switch" id="flexSwitchCheckDefault<?=$i;?>">
                            <label class="form-check-label" for="flexSwitchCheckDefault<?=$i;?>"><?=diaSemanaExtenso($i);?></label>
                        </div>
                    <?php endfor; ?>   
                </div>

                <div class="col-sm-6">
                    <label for="lastName" class="form-label">Posição da Aula:</label>
                    <?php for ($i = 1; $i <= 6; $i++): ?>  
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="nPosicao<?=$i;?>" value="<?=set_checkbox('nPosicao'.$i);?>" type="checkbox" role="switch" id="checboxPosicao<?=$i;?>">
                            <label class="form-check-label" for="checboxPosicao<?=$i;?>"><?=$i.'ª';?></label>
                        </div>
                    <?php endfor; ?> 
                </div>

                <div class="col-md-3">
                    <label for="zip" class="form-label">Série:</label>
                    <?php 
                     //dd($series);
                    foreach ($series AS $serie): ?>  
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="nSerie<?=$serie['id'];?>" value="<?=set_checkbox('nSerie'.$serie['id']);?>" type="checkbox" role="switch" id="checboxSerie<?=$serie['id'];?>">
                            <label class="form-check-label" for="checboxSerie<?=$serie['id'];?>"><?=$serie['descricao'].' - '. $serie['classificacao']. ' - '.turno($serie['turno']);?></label>
                        </div>
                    <?php endforeach; ?> 

                </div>
            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Salvar para continuar</button>
            </form>
        </div>
    </div>

</main>
<?= $this->endSection(); ?>