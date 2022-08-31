<?php

use App\Models\ProfessorDisciplinaModel;

echo $this->extend('layouts2/default');
echo $this->section('content'); ?>

<div class="row">
    <div class="col-12">
        <span id="msgAlertSuccess"></span>
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title"><?= $title; ?> </h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap table-striped">
                    <thead>
                        <tr>
                            <th colspan="4">
                                <h4>Nome:: <?= $dataTeacher->name; ?></h4>
                            </th>
                            <th><?= anchor('#', '<i class="icons fas fa-book"></i> Nova disciplina', ['onclick' => 'addTeacherDiscipline(' . $dataTeacher->id . ')', 'data-bs-toggle' => 'modal', 'class' => 'btn btn-dark']); ?>
                            </th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Cor destaque</th>
                            <th>Disciplina(s)</th>
                            <th>Qtde aulas</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = 1;
                        foreach ($teacDisc as $data) : ?>
                            <tr>
                                <td><?= $contador++; ?></td>
                                <td>
                                    <div style="background-color:<?= $data->color; ?>; color:transparent">.</div>
                                </td>
                                <td><?= $data->description; ?></td>
                                <td><?= $data->amount; ?></td>

                                <td>
                                    <!-- Button trigger modal -->

                                    <?= anchor('#', '<i class="icons fas fa-pen"></i> Editar', ['onclick' => 'editTeacherDiscipline(' . $data->id . ')', 'data-bs-toggle' => 'modal', 'class' => 'btn btn-dark']); ?>
                                    <?= anchor('#', '<i class="icons fas fa-trash"></i> Excluir', ['onclick' => 'delTeacherDiscipline(' . $data->id . ')', 'data-bs-toggle' => 'modal', 'class' => 'btn btn-dark']); ?>
                                    <?= anchor('alocacao/add/' . $data->id, 'Adicionar'); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <?=generateButtonRetro('/professor/list');?>
        </div>
    </div>
</div>

<!-- Modal add-->
<div class="modal fade" id="addTeacherDisciplineModal" tabindex="-1" role="dialog" aria-labelledby="addTeacherDisciplineModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="addTeacherDisciplineModal">Adicionar Professor/Disciplina</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="msgAlertError"></span>
                <?php echo form_open('teacDisc/create', ['id' => 'addTeacherDisciplineForm']);
                //echo form_hidden('id', $teacDisc->id);
                //echo form_hidden('_method', "put");
                //echo form_hidden('id_teacher', $teacDisc->id_teacher);

                echo csrf_field()
                ?>


                <div class="form-group col-6">
                    <input id="id" name="id_teacher">

                </div>
                <div class="form-group col-6">
                    <label for="exampleColorInput" class="form-label">Disciplinas :: </label>

                    <?php
                    $myDiscipline = [];

                    foreach ($teacDisc as $a) {
                        $myDiscipline[] = $a->id_discipline;
                    }


                    foreach ($disciplines as $item) :
                        if (!in_array($item->id, $myDiscipline)) : ?>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="nDisciplinas[]" value="<?= $item->id; ?>" <?php echo set_checkbox('nDisciplinas', $item->id); ?> type="checkbox" id="flexSwitchCheckDefault<?= $item->id; ?>">
                                <label class="form-check-label" for="flexSwitchCheckDefault<?= $item->id; ?>"> <?= $item->description; ?> </label>
                            </div>

                    <?php endif;

                    endforeach ?>
                    <span style="color:red" class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nDisciplinas') : ''; ?></span>


                </div>

                <div class="form-group col-6">
                    <label for="lastName" class="form-label">Quantidade de Aulas ::</label>
                    <input type="number" name="nNumeroAulas" class="form-control" id="lastName" placeholder="" value="<?= set_value('nNumeroAulas') ?>">
                    <span class="error invalid-feedback" id="fieldlertError"></span>


                </div>
                <div class="form-group col-3">
                    <label for="exampleColorInput" class="form-label">Cor destaque</label>
                    <input type="color" name="nCorDestaque" class="form-control form-control-color" id="exampleColorInput" value="nCorDestaque" title="Escolha uma cor">
                    <span style="color:red" class="font-italic font-weight-bold"><?php echo $erro !== '' ? $erro->getError('nCorDestaque') : ''; ?></span>

                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                </form>
            </div>

        </div>
    </div>
</div>
<!-- Modal edit-->
<div class="modal fade" id="editTeacherDisciplineModal" tabindex="-1" role="dialog" aria-labelledby="editTeacherDisciplineModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title" id="editTeacherDisciplineModalLabel">Editar Professor/Disciplina</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="msgAlertError"></span>
                <?php echo form_open('teacDisc/update', ['id' => 'editTeacherDiscipline']);
                //echo form_hidden('id', $teacDisc->id);
                //echo form_hidden('_method', "put");
                //echo form_hidden('id_teacher', $teacDisc->id_teacher);
                echo csrf_field()
                ?>


                <div class="form-group col-6">
                    <input type="text" id="idEdit" name="id">
                    <label for="inputNanme4" class="form-label">Nome :: </label>
                    <input type="text" id="nameEdit" class="form-control" id="firstName" placeholder="Nome" value="<?php //$nameTeacher 
                                                                                                                    ?>" disabled>
                    <span style="color:red" class="font-italic font-weight-bold"><?php //echo $erro !== '' ? $erro->getError('nNome') : ''; 
                                                                                    ?></span>
                </div>
                <div class="form-group col-6">
                    <label for="exampleColorInput" class="form-label">Disciplina :: </label>

                    <input type="text" id="id_discipline" disabled class="form-control" id="exampleColorInput" value="<?php //$discipline;
                                                                                                                        ?>">
                    <span style="color:red" class="font-italic font-weight-bold"><?php //echo $erro !== '' ? $erro->getError('nDisciplina') : ''; 
                                                                                    ?></span>

                </div>

                <div class="form-group col-6">
                    <label for="lastName" class="form-label">Quantidade de Aulas ::</label>
                    <input type="number" id="numeroAulas" name="nNumeroAulas" class="form-control" id="lastName" placeholder="" value="<?php //set_value('nNumeroAulas', $teacDisc->amount) 
                                                                                                                                        ?>">
                    <span class="error invalid-feedback" id="fieldlertError"></span>

                </div>
                <div class="form-group col-3">
                    <label for="exampleColorInput" class="form-label">Cor destaque</label>
                    <input type="color" id="corDestaque" name="nCorDestaque" class="form-control form-control-color" id="exampleColorInput" value="<?php //set_value('nCorDestaque',$teacDisc->color);
                                                                                                                                                    ?>" title="Escolha uma cor">
                    <span style="color:red" class="font-italic font-weight-bold"><?php //echo $erro !== '' ? $erro->getError('nCorDestaque') : ''; 
                                                                                    ?></span>

                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal delete -->
<div class="modal fade" id="deleteTeacherDisciplineModal" tabindex="-1" role="dialog" aria-labelledby="deleteTeacherDisciplineModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="deleteTeacherDisciplineModalLabel">Excluir Professor/disciplina</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php echo form_open('teacDisc/del', ['id' => 'deleteTeacherDisciplineForm']);
                //echo form_hidden('id', $teacDisc->id);
                //echo form_hidden('_method', "put");
                //echo form_hidden('id_teacher', $teacDisc->id_teacher);
                echo csrf_field()
                ?>


                <div class="form-group col-6">
                    <input type="text" id="idDelete" name="id">
                    <p>Desejar realmente excluir?</p>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <?= generateButtonRetro('/horario'); ?>

                </form>
            </div>


        </div>
    </div>
</div>
<?= $this->endSection(); ?>