<?php

include_once 'Config_1.php';

function adicionarChamado($solicitante, $descricao, $prioridade, $setor, $con) {
    if ($descricao != NULL && $setor != 0) {
        $adiciona = $con->prepare('CALL adicionarChamado(:ppessoa_id, :pdescricao, :psetor_id, :pprioridade_id, :pstatus_id, :pdata_criacao)');
        $adiciona->bindValue(':ppessoa_id', $solicitante);
        $adiciona->bindValue(':pdescricao', $descricao);
        $adiciona->bindValue(':psetor_id', $setor);
        $adiciona->bindValue(':pprioridade_id', $prioridade);
        $adiciona->bindValue(':pstatus_id', 1);
        $adiciona->bindValue(':pdata_criacao', dataAtual());
        $adiciona->execute();
        $_SESSION['mensagem'] = 'Chamado Adicionado Com Sucesso';
        $_SESSION['class'] = 'alert-success';
    } else {
        $_SESSION['mensagem'] = 'Todos Os Campos Devem Ser Preenchidos';
        $_SESSION['class'] = 'alert-danger';
    }
}

function atenderChamado($chamadoId, $tecnicoId) {
    $conecao = newConection();
    $confere = detalhesChamado($chamadoId);
    if ($confere['tecnico_id'] == 0) {
        $atender = $conecao->prepare('CALL atenderChamado(:ptecnicoId, :pdataIniciado, :pstatusId, :pchamadoId)');
        $atender->bindValue(':pchamadoId', $chamadoId);
        $atender->bindValue(':ptecnicoId', $tecnicoId);
        $atender->bindValue(':pdataIniciado', dataAtual());
        $atender->bindValue(':pstatusId', 2);
        $atender->execute();
        detalhesChamado($chamadoId);
    }
}

function trasferirChamado($chamadoId, $tecnicoId) {
    $conecao = newConection();
    //$trasferir = $conecao->prepare('UPDATE `chamados` SET `tecnico_id` = :ptecnicoId WHERE chamado_id = :pchamadoId');
    $transferir = $conecao->prepare('CALL transferirChamado(:pchamadoId, :ptecnicoId)');
    $transferir->bindValue(':ptecnicoId', $tecnicoId);
    $transferir->bindValue(':pchamadoId', $chamadoId);
    $transferir->execute();
}

function finalizarChamado($chamadoId) {
    $conecao = newConection();
    $finalizar = $conecao->prepare('CALL finalizarChamado(:pchamadoId, :pdatafinalizado)');
    $finalizar->bindValue(':pchamadoId', $chamadoId);
    $finalizar->bindValue(':pdatafinalizado', dataAtual());
    $finalizar->execute();
    detalhesChamado($chamadoId);
}

function adicionarChamadoEmEspera($descricao, $chamadoId) {
    $conecao = newConection();
    $esperar = $conecao->prepare('CALL adicionarChamadoEmEspera(:pdescricao, :pchamadoId)');
    $esperar->bindValue(':pdescricao', $descricao);
    $esperar->bindValue(':pchamadoId', $chamadoId);
    $esperar->execute();
    detalhesChamado($chamadoId);
}

function detalhesChamado($chamadoId) {
    $conecao = newConection();
    $busca = $conecao->prepare('CALL chamadoEmAtendimento(:pchamado_id)');
    $busca->bindValue(':pchamado_id', $chamadoId);
    $busca->execute();
    $confere = $busca->fetch();
    $_SESSION['atendimento'] = $confere;
    return $confere;
}

function listarChamados() {
    $conecao = newConection();
    $listaChamados = $conecao->prepare('CALL listaChamados');
    $listaChamados->execute();
    return $listaChamados;
}

function listarPrioridades($con) {
    $listaPrioridades = $con->prepare('CALL listaPrioridades');
    $listaPrioridades->execute();
    return $listaPrioridades;
}

?>