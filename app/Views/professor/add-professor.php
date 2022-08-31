<?php
 echo $this->extend('layouts/default'); ?>
<?= $this->section('content');?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $title;?></h1>
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
            <?php 
            if(session()->has('dado')){ ?>
                <div class=" border-left-<?=session()->dado['msgs']['alert'];?> alert alert-show alert-<?=session()->dado['msgs']['alert'];?>">
                <strong><?=session()->dado['msgs']['message'];?></strong>
                
            </div>
            <?php 
           
            }
            session()->remove('dado'); 
            
            ?>
                 <div class=" border-left-<?=$msgs['alert']?> alert alert-show alert-<?=$msgs['alert']?>">
                <strong><?=$msgs['message'];?></strong>
            </div>
            

            <?php echo form_open('professor/create',['class'=>'needs-validation'])?>
            <div class="row g-3">

                <div class="col-sm-12">
                    <label for="firstName" class="form-label">Nome:</label>
                    <input type="text" name="nNome" class="form-control" id="firstName" placeholder="Nome" value="<?= set_value('nNome') ?>">
                    <div class="">
                        <span style="color:red" class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nNome'):'';?></span>

                    </div>
                </div>
              
                <div class="col-sm-6">
                    <label for="lastName" class="form-label">Quantidade de Aulas:</label>
                    <input type="number" name="nNumeroAulas" class="form-control" id="lastName" placeholder="" value="<?= set_value('nNumeroAulas') ?>">
                    <span style="color:red" class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nNumeroAulas'):'';?></span>
                    
                </div>

                <div class="col-sm-6">
                    <label for="exampleColorInput" class="form-label">Cor destaque</label>
                    <input type="color" name="nCorDestaque" class="form-control form-control-color" id="exampleColorInput" value="nCorDestaque"
                        title="Escolha uma cor">
                        <span style="color:red" class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nCorDestaque'):'';?></span>
                </div>
            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Salvar para continuar</button>
            </form>
        </div>
    </div>

</main>
<?= $this->endSection();?>