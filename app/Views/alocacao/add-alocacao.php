<?php
echo $this->extend('layouts/main');
echo $this->section('content'); ?>
<div class="col-lg-6">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Horizontal Form</h5>
            <?php if ($msgs['alert']) : ?>
                <div class="alert alert-<?= $msgs['alert'] ?> bg-<?= $msgs['alert'] ?> text-light border-0 alert-dismissible fade show" role="alert">
                    <?= $msgs['message']; ?>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Horizontal Form -->
            <?php echo form_open('alocacao/add_etp02', ['class' => '']) ?>

            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-3 col-form-label">Professor</label>
                <div class="col-sm-9">
                    <select id="inputState" class="form-select" name="nIdProfessor">
                        <option value="">Selecione ...</option>
                        <?php

foreach($professores as $professor):?>
    <option value="<?=$professor['id']?>"><?=$professor['nome']?></option>
    <?php endforeach?>
                    </select>
                    <span style="color:red" class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nIdAlocacao') : ''; ?></span>

                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <button type="reset" class="btn btn-secondary">Limpar</button>              
            </div>
            </form><!-- End Horizontal Form -->

        </div>
    </div>
</div>
<?= $this->endSection(); ?>