<?php

@include_once '../PHP/Config_1.php';
@session_start();
//POST E GET
if (isset($_POST['filtrar'])) {

    if ($_POST['tecnico_id'] != NULL && $_POST['date'] != NULL) {

        $data = inverteData($_POST['date']) . ' 21:24:43';
        $l = chamadoPorTecnico($_POST['tecnico_id'], $data);
        $_SESSION['tecnico'][0] = $l[0];
        $_SESSION['tecnico'][1] = $l[1];
        $_SESSION['tecnico'][2] = $l[2];
        $_SESSION['tecnico'][3] = $l[3];
        $_SESSION['tecnico'][4] = $data;
        header('location: ../Relatorios.php');
    }else{
        header('location: ../Relatorios.php');
    }
}

if (@$_SESSION['tecnico'] == NULL) {
    $_SESSION['tecnico'][0] = 'Ninguem';
    $_SESSION['tecnico'][1] = 0;
    $_SESSION['tecnico'][2] = 0;
    $_SESSION['tecnico'][3] = 0;
    $_SESSION['tecnico'][4] = dataAtual();
}

//FUNÇÕES

function inverteData($data) {
    if (count(explode("/", $data)) > 1) {
        return implode("-", array_reverse(explode("/", $data)));
    } elseif (count(explode("-", $data)) > 1) {
        return implode("/", array_reverse(explode("-", $data)));
    }
}

function chamadosEmProcesso($listaChamados) {
    $espera = 0;
    $atendendo = 0;
    $aguardando = 0;
    foreach ($listaChamados as $l) {
        if ($l['status_id'] == 1) {
            $aguardando = $aguardando + 1;
        } else if ($l['status_id'] == 2) {
            $atendendo = $atendendo + 1;
        } else {
            $espera = $espera + 1;
        }
    }
    $processo = array($aguardando, $atendendo, $espera);
    return $processo;
}

function chamadosPorPrioridade($listaChamados) {
    $urgente = 0;
    $normal = 0;
    $baixo = 0;
    foreach ($listaChamados as $l) {
        if ($l['prioridade_id'] == 1) {
            $baixo = $baixo + 1;
        } else if ($l['prioridade_id'] == 2) {
            $normal = $normal + 1;
        } else {
            $urgente = $urgente + 1;
        }
    }
    $prioridade = array($baixo, $normal, $urgente);
    return $prioridade;
}

function chamadoPorTecnico($tecnico_id, $data) {
    $con = newConection();
    $atendendo = 0;
    $espera = 0;
    $finalizado = 0;
    $tecnico;

    $listaTecnicos = $con->prepare('CALL listaChamadosPorData(:ppessoa_id)');
    $listaTecnicos->bindValue(':ppessoa_id', $tecnico_id);
    $listaTecnicos->execute();
    foreach ($listaTecnicos as $l) {
        $tecnico = $l['tecnico'];
        if ($l['status_id'] == 2) {
            $atendendo = $atendendo + 1;
        } else if ($l['status_id'] == 3) {
            $espera = $espera + 1;
        } else if ($l['status_id'] == 4) {
            $finalizado = $finalizado + 1;
        }
    }
    if (empty($tecnico)) {
        $buscaTecnico = newConection()->prepare('CALL buscarTecnico(:ppessoa_id)');
        $buscaTecnico->bindValue(':ppessoa_id', $tecnico_id);
        $buscaTecnico->execute();
        $t = $buscaTecnico->fetch();
        $tecnico = $t['pessoa_nome'];
    }
    $tecnicoLista = array($tecnico, $atendendo, $espera, $finalizado);
    return $tecnicoLista;
}
