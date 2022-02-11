<?php

 echo $this->extend('layouts/default'); ?>
<?= $this->section('content');?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?=$title;?></h1>
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
            <div class=" border-left-<?=$msgs['alert']?> alert alert-show alert-<?=$msgs['alert']?>">
                <strong><?=$msgs['message'];?></strong>
            </div>

            <?php echo form_open('alocacao/add_etp02',['class'=>'needs-validation'])?>
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="country" class="form-label">Professor(a):</label>
                    <select class="form-select" id="country" name="nProfessor">
                        <option value="">Selecione ...</option>
                        <?php              
                
                foreach($professores as $professor):?>
                        <option value="<?=$professor['id']?>"><?=$professor['nome']?></option>
                        <?php endforeach?>
                    </select>

                    <div class="">
                        <span style="color:red"
                            class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nProfessor'):'';?></span>

                    </div>
                </div>
            </div>

            <hr class="my-4">

            <button class="w-100 btn btn-primary btn-lg" type="submit">Avançar para continuar</button>
            </form>
        </div>
    </div>

</main>
<?= $this->endSection();?>