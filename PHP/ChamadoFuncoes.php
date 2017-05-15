<?php

include_once 'Config_1.php';

function adicionarChamado($solicitante, $descricao, $prioridade, $setor, $con) {
    if ($descricao != NULL && $setor != 0) {
        date_default_timezone_set('America/Sao_Paulo');
        $data_criacao = date('Y-m-d H:i:s');
        $adiciona = $con->prepare('INSERT INTO `chamados` (`chamado_id`, `pessoa_id`, `descricao`, `setor_id`, `prioridade_id`, `status_id`, `data_criacao`) VALUES(NULL, :ppessoa_id, :pdescricao, :psetor_id, :pprioridade_id, :pstatus_id, :pdata_criacao);');
        $adiciona->bindValue(':ppessoa_id', $solicitante);
        $adiciona->bindValue(':pdescricao', $descricao);
        $adiciona->bindValue(':psetor_id', $setor);
        $adiciona->bindValue(':pprioridade_id', $prioridade);
        $adiciona->bindValue(':pstatus_id', 1);
        $adiciona->bindValue(':pdata_criacao', $data_criacao);
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
    $confere = chamadoEmAtendimento($chamadoId);
    if ($confere['tecnico_id'] == 0) {
        date_default_timezone_set('America/Sao_Paulo');
        $data_iniciado = date('Y-m-d H:i:s');
        $atender = $conecao->prepare('UPDATE `chamados` SET `tecnico_id` = :ptecnicoId, `data_iniciado` = :pdataIniciado WHERE chamado_id = :pchamadoId');
        $atender->bindValue(':pchamadoId', $chamadoId);
        $atender->bindValue(':ptecnicoId', $tecnicoId);
        $atender->bindValue(':pdataIniciado', $data_iniciado);
        $atender->execute();
    }
}

function chamadoEmAtendimento($chamadoId) {
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