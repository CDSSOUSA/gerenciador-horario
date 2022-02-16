<?php

function toDataBr($data): String
{
    if ($data == null) {
        return '--';
    }
    $data = explode("-", $data);
    return $data[2] . "/" . $data[1] . "/" . $data[0];
}

function toDataMsql($data)
{
    if (!empty($data)) {
        $data = explode("/", $data);
        return $dataAtendimento = $data[2] . "-" . $data[1] . "-" . $data[0];
    }
    return NULL;
}

/**
 * [Description for diaSemanaExtenso]
 *
 * @param int $diaSemana
 * 
 * @return string
 * 
 */
function diaSemanaExtenso(int $diaSemana): string
{

    switch ($diaSemana) {
        case $diaSemana == 2:
            return 'SEGUNDA';
        case $diaSemana == 3:
            return 'TERÇA';
        case $diaSemana == 4:
            return 'QUARTA';
        case $diaSemana == 5:
            return 'QUINTA';
        case $diaSemana == 6:
            return 'SEXTA';
        default:
            return null;
    }
}

function turno($turno): string
{
    if (empty($turno)) {
        return '--';
    }
    return $turno == 'M' ? "MANHÃ" : "TARDE";
}
function convertDiscipline(string $string): string
{
    return mb_substr($string, 0, 3);
}

function describeTeacher(string $nomeCompleto, string $disciplina): string
{
    return word_limiter($nomeCompleto, 1, '') . ' - ' . convertDiscipline($disciplina);
}

function generateButtonRetro(string $adress): string
{
    return anchor($adress, 'Voltar', ['class' => 'btn btn-warning']);
}

/**
 * [Description for convertSituation]
 *
 * @param string $situation
 * 
 * @return string
 * 
 */
function convertSituation(string $situation): string
{
    return $situation == 'L' ? 'LIVRE' : 'OCUPADO';
}
