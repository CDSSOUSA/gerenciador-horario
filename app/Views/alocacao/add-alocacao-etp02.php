<?php
echo $this->extend('layouts2/default'); ?>
<?= $this->section('content');

$alocacaoSerie = [];
$alocacaoPosicao = [];
$alocacaoDiaSemana = [];

foreach ($alocacao as $data) :
  //$alocacaoSerie[] = $data->id_serie'];
  $alocacaoPosicao[] = $data->position;
  $alocacaoDiaSemana[] = $data->dayWeek;
endforeach;

?>

<div class="col-lg-5">

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
          <input type="text" disabled="true" name="" class="form-control" value="<?= $professor->name . '  -  ' . $professor->amount . ' hora-aula'; ?>">
          <input type="hidden" name="nNome" alue="<?= $professor->name; ?>">
          <input type="text" name="nIdProfessor" value="<?= $professor->id; ?>">
          <span style="color:red" class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nIdAlocacao') : ''; ?></span>

        </div>
      </div>
      <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-3 col-form-label">Dia Semana</label>
        <div class="col-sm-9">
          <?php for ($i = 2; $i <= 6; $i++) :
            if (in_array($i, $alocacaoDiaSemana)) : ?>
              <div class="form-check form-switch">
                <input class="form-check-input flexSwitchCheckCheckedDisabled" name="_nDiaSemana<?= $i; ?>" value="<?= set_checkbox('nDia' . $i); ?>" type="checkbox" role="switch" id="flexSwitchCheckDefault<?= $i; ?>" disabled checked>
                <label class="form-check-label" for="flexSwitchCheckDefault<?= $i; ?>"><?= diaSemanaExtenso($i); ?></label>
              </div>
            <?php else : ?>
              <div class="form-check form-switch">
                <input class="form-check-input" name="nDiaSemana[]" value="<?=$i;?>" type="checkbox" role="switch" id="flexSwitchCheckDefault<?= $i; ?>">
                <label class="form-check-label" for="flexSwitchCheckDefault<?= $i; ?>"><?= diaSemanaExtenso($i); ?></label>
                <span style="color:red" class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nDiaSemana') : ''; ?></span>
              </div>
          <?php endif;
          endfor; ?>
          <span style="color:red" class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nIdAlocacao') : ''; ?></span>

        </div>
      </div>
      <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-3 col-form-label">Posição Aula</label>
        <div class="col-sm-9">
          <?php
          for ($i = 1; $i <= 6; $i++) :
            if (in_array($i, $alocacaoPosicao)) :
          ?>
              <div class="form-check form-switch">
                <input class="form-check-input flexSwitchCheckCheckedDisabled" name="nPosicao<?= $i; ?>" value="<?= set_checkbox('nPosicao' . $i); ?>" type="checkbox" role="switch" id="checboxPosicao<?= $i; ?>" disabled checked>
                <label class="form-check-label" for="checboxPosicao<?= $i; ?>"><?= $i . 'ª AULA'; ?></label>
              </div>
            <?php else : ?>
              <div class="form-check form-switch">
                <input class="form-check-input" name="nPosicao<?= $i; ?>" value="<?= set_checkbox('nPosicao' . $i); ?>" type="checkbox" role="switch" id="checboxPosicao<?= $i; ?>">
                <label class="form-check-label" for="checboxPosicao<?= $i; ?>"><?= $i . 'ª AULA'; ?></label>
              </div>
          <?php endif;
          endfor; ?>
          <span style="color:red" class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nIdAlocacao') : ''; ?></span>

        </div>
      </div>
      <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-3 col-form-label">Série</label>
        <div class="col-sm-9">
          <?php

          foreach ($series as $serie) :

            if (in_array($serie->id, $alocacaoSerie)) :
          ?>
              <div class="form-check form-switch">
                <input class="form-check-input flexSwitchCheckCheckedDisabled" name="nSerie<?= $serie->id; ?>" value="<?= set_checkbox('nSerie' . $serie->id); ?>" type="checkbox" role="switch" id="checboxSerie<?= $serie->id; ?>" disabled checked>
                <label class="form-check-label" for="checboxSerie<?= $serie->id; ?>"><?= $serie->description . ' - ' . $serie->classification . ' - ' . turno($serie->shift); ?></label>
              </div>
            <?php else : ?>
              <div class="form-check form-switch">
                <input class="form-check-input" name="nSerie<?= $serie->id; ?>" value="<?= set_checkbox('nSerie' . $serie->id); ?>" type="checkbox" role="switch" id="checboxSerie<?= $serie->id; ?>">
                <label class="form-check-label" for="checboxSerie<?= $serie->id; ?>"><?= $serie->description . ' - ' . $serie->classification . ' - ' . turno($serie->shift); ?></label>
              </div>

          <?php endif;
          endforeach; ?>
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
<div class="col-lg-5">

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Alocações Realizadas</h5>

      <!-- Default Table -->
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Série</th>
            <th scope="col">Dia semana </th>
            <th scope="col">Posição</th>
            <th scope="col">Situação</th>
            <th scope="col">Ação</th>
          </tr>
        </thead>
        <tbody>
          <?php $contador = 1;
          foreach ($alocacao as $data) : ?>
            <tr>
              <th scope="row"><?= $contador++; ?></th>
            
              <td class="text-center"><?= diaSemanaExtenso($data->dayWeek); ?></td>
              <td class="text-center"><?= $data->position . 'ª'; ?></td>
              <td class="text-center"><?= convertSituation($data->situation); ?></td>
              <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal<?= $data->id; ?>">
                  <i class="bi bi-trash"></i>
                </button>
              </td>

              <div class="modal fade" id="basicModal<?= $data->id; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Excluir Alocação:: <?= $data->id; ?> </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?php
                      $atributos_formulario = array(
                        'role' => 'form',
                        'class' => ''
                      );
                      echo form_open('alocacao/delete', $atributos_formulario);

                      echo form_input('id', $data->id);
                      ?>
                      <p>Confirmar exclusão?</p>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-danger">Confirmar</button>
                    </div>
                  </div>
                </div>
              </div>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <!-- End Default Table Example -->
    </div>
  </div>

</div>


<?= $this->endSection(); ?>