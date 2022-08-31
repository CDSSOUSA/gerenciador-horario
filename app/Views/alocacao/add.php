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

<section class="content">
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-6">
        <?php if ($msgs['alert']) : ?>
          <div class="alert alert-<?= $msgs['alert'] ?> bg-<?= $msgs['alert'] ?> text-light border-0 alert-dismissible fade show" role="alert">
            <?= $msgs['message']; ?>
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>

            </button>
          </div>
        <?php endif; ?>
        <div class="card card-secondary">

          <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
          </div>

          <?php echo form_open('alocacao/create', ['class' => '']) ?>



          <div class="card-body">
            <div class="form-group col-12">
              <label for="inputEmail3" class="col-form-label">Professor :: </label>

              <input type="text" disabled="true" name="" class="form-control" value="<?= $professor->name . '  -  ' . $professor->amount . ' hora-aula'; ?>">
              <input type="hidden" name="nNome" alue="<?= $professor->name; ?>">
              <input type="text" name="nIdProfessor" value="<?= $professor->id; ?>">
              <span style="color:red" class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nIdAlocacao') : ''; ?></span>


            </div>
            <div class="row">
              <div class="form-group col-6">
                <label for="inputEmail3" class="col-form-label">Dia Semana :: </label>
                <?php for ($i = 2; $i <= 6; $i++) : ?>

                  <div class="form-check form-switch">
                    <input class="form-check-input" name="nDayWeek[]" value="<?= $i; ?>" <?= set_checkbox('nDayWeek', $i); ?> type="checkbox" role="switch" id="flexSwitchCheckDefault<?= $i; ?>">
                    <label class="form-check-label" for="flexSwitchCheckDefault<?= $i; ?>"><?= diaSemanaExtenso($i); ?></label>

                  </div>

                <?php endfor; ?>
                <span class="invalid-feedback"><?php echo $erro !== '' ? $erro->getError('nDayWeek') : ''; ?></span>


              </div>
              <div class="form-group col-6">
                <label for="inputEmail3" class="col-form-label">Posição Aula :: </label>

                <?php
                for ($i = 1; $i <= 6; $i++) : ?>

                  <div class="form-check form-switch">
                    <input class="form-check-input" name="nPosition[]" value="<?= $i; ?>" <?= set_checkbox('nPosition', $i); ?> type="checkbox" role="switch" id="checboxPosicao<?= $i; ?>">
                    <label class="form-check-label" for="checboxPosicao<?= $i; ?>"><?= $i . 'ª AULA'; ?></label>
                  </div>
                <?php
                endfor; ?>
                <span class="invalid-feedback"><?php echo $erro !== '' ? $erro->getError('nPosition') : ''; ?></span>
              </div>
            </div>


            <div class="form-group col-6">
              <label for="exampleColorInput" class="form-label">Disciplinas :: </label>


              <?php foreach ($teacDisc as $item) : ?>
                <div class="form-check form-switch">
                  <input class="form-check-input" name="nDisciplines[]" value="<?= $item->id; ?>" <?php echo set_checkbox('nDisciplines', $item->id); ?> type="checkbox" id="flexSwitchCheckDefault<?= $item->id; ?>">
                  <label class="form-check-label" for="flexSwitchCheckDefault<?= $item->id; ?>"> <?= $item->description; ?> </label>
                </div>

              <?php endforeach ?>
              <span class="invalid-feedback"><?php echo $erro !== '' ? $erro->getError('nDisciplines') : ''; ?></span>

            </div>

          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="reset" class="btn btn-secondary">Limpar</button>
            <?= generateButtonRetro('/professor/list'); ?>

          </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-secondary">

          <div class="card-header">
            <h5 class="card-title">Alocações Realizadas</h5>
          </div>


          <div class="card-body">

            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Dia semana </th>
                  <th scope="col">Disciplina </th>
                  <th scope="col">Posição</th>
                  <th scope="col">Situação</th>
                  <th scope="col">Ação</th>
                </tr>
              </thead>
              <tbody>
                <?php $contador = 1;
                foreach ($alocacao as $data) : ?>
                  <tr>
                    <th class="align-middle" scope="row"><?= $contador++; ?></th>

                    <td class="align-middle text-center"><?= diaSemanaExtenso($data->dayWeek); ?></td>
                    <td class="align-middle text-center">
                      <div class="text-white" style="background-color:<?= ($data->color); ?>"><?= ($data->abbreviation); ?></div>
                    </td>
                    <td class="align-middle text-center"><?= $data->position . 'ª'; ?></td>
                    <td class="align-middle text-center">
                      <?= convertSituation($data->situation); ?>
                      <?php
                      if ($data->situation === 'O') {
                        $schedule = $scheduleModel->getScheduleByIdAllocation($data->id);
                        echo '<span style="display:block" class="badge bg-secondary">'.$schedule->id_series.'ª Série</span>';
                        
                      }
                      ?>
                    </td>
                    <td class="align-middle text-center">
                      <?php if ($data->situation === 'L') : ?>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#basicModal<?= $data->id; ?>">
                          <i class="icons fas fa-trash"></i>
                        </button>
                      <?php else : ?>
                        <button type="button" class="btn btn-danger disabled">
                          <i class="icons fas fa-trash"></i>
                        <?php endif; ?>
                    </td>

                    <div class="modal fade" id="basicModal<?= $data->id; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Excluir Alocação:: <?= $data->id; ?> </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close"></button>
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
    </div>
  </div>
</section>

<?= $this->endSection(); ?>