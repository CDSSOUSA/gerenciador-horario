<?php

use App\Models\ProfessorDisciplinaModel;

echo $this->extend('layouts2/default');
echo $this->section('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-secondary">

                    <div class="card-header">
                        <h3 class="card-title"><?= $title ?></h3>
                    </div>

                    <?php echo form_open('professor/create') ?>


                    <div class="card-body">
                        <div class="form-group col-6">
                            <label for="inputNanme4" class="form-label">Nome :: </label>
                            <input type="text" name="nNome" class="form-control" id="firstName" placeholder="Nome" value="<?= set_value('nNome') ?>">
                            <span style="color:red" class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nNome') : ''; ?></span>
                        </div>
                        <div class="form-group col-6">
                            <label for="lastName" class="form-label">Quantidade de Aulas ::</label>
                            <input type="number" name="nNumeroAulas" class="form-control" id="lastName" placeholder="" value="<?= set_value('nNumeroAulas') ?>">
                            <span style="color:red" class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nNumeroAulas') : ''; ?></span>

                        </div>
                        <div class="form-group col-6">
                            <label for="exampleColorInput" class="form-label">Cor destaque</label>
                            <input type="color" name="nCorDestaque" class="form-control form-control-color" id="exampleColorInput" value="nCorDestaque" title="Escolha uma cor">
                            <span style="color:red" class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nCorDestaque') : ''; ?></span>

                        </div>
                        <div class="form-group col-6">
                            <label for="exampleColorInput" class="form-label">Disciplinas :: </label>

                            <?php foreach ($disciplinas as $item) : ?>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="nDisciplinas[]" value="<?= $item->id; ?>" <?php echo set_checkbox('nDisciplinas', $item->id); ?> type="checkbox" id="flexSwitchCheckDefault<?= $item->id; ?>">
                                    <label class="form-check-label" for="flexSwitchCheckDefault<?= $item->id; ?>"> <?= $item->description; ?> </label>
                                </div>

                            <?php endforeach ?>
                            <span style="color:red" class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nDisciplinas') : ''; ?></span>

                        </div>    
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="reset" class="btn btn-secondary">Limpar</button>
                            <?= generateButtonRetro('/horario'); ?>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>