<?php

include_once 'Config_1.php';

function adicionarChamado($solicitante, $descricao, $prioridade, $setor, $con) {
    if ($descricao != NULL && $setor != 0) {
        if ($_SESSION['a']['permissao_id'] == 6) {
            $prioridade = 1;
        }
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
        adicionarMensagem($tecnicoId, $confere['pessoa_id'], $confere['chamado_id'], 2, $confere['data_finalizacao']);
        detalhesChamado($chamadoId);
    }
}

function trasferirChamado($chamadoId, $tecnicoId, $pessoaId) {
    $conecao = newConection();
    //$trasferir = $conecao->prepare('UPDATE `chamados` SET `tecnico_id` = :ptecnicoId WHERE chamado_id = :pchamadoId');
    $transferir = $conecao->prepare('CALL transferirChamado(:pchamadoId, :ptecnicoId)');
    $transferir->bindValue(':ptecnicoId', $tecnicoId);
    $transferir->bindValue(':pchamadoId', $chamadoId);
    $transferir->execute();
    adicionarMensagem($pessoaId, $tecnicoId, $chamadoId, 5, dataAtual());
    unset($_SESSION['atendimento']);
    $_SESSION['mensagem'] = 'Chamado Transferido Com Sucesso';
    $_SESSION['class'] = 'alert-success';
}

function finalizarChamado($chamadoId, $tecnicoId) {
    $conecao = newConection();
    $finalizar = $conecao->prepare('CALL finalizarChamado(:pchamadoId, :pdatafinalizado)');
    $finalizar->bindValue(':pchamadoId', $chamadoId);
    $finalizar->bindValue(':pdatafinalizado', dataAtual());
    $finalizar->execute();
    $confere =detalhesChamado($chamadoId);
    adicionarMensagem($tecnicoId, $confere['pessoa_id'], $confere['chamado_id'], 4, $confere['data_finalizacao']);
    $_SESSION['mensagem'] = 'Chamado Finalizado Com Sucesso';
    $_SESSION['class'] = 'alert-success';
}

function adicionarChamadoEmEspera($descricao, $chamadoId, $tecnicoId) {
    $conecao = newConection();
    $esperar = $conecao->prepare('CALL adicionarChamadoEmEspera(:pdescricao, :pchamadoId)');
    $esperar->bindValue(':pdescricao', $descricao);
    $esperar->bindValue(':pchamadoId', $chamadoId);
    $esperar->execute();
    $confere = detalhesChamado($chamadoId);
    adicionarMensagem($tecnicoId, $confere['pessoa_id'], $confere['chamado_id'], 3, dataAtual());
    $_SESSION['mensagem'] = 'Chamado Adicionado Para Espera';
    $_SESSION['class'] = 'alert-success';
}

function detalhesChamado($chamadoId) {
    $conecao = newConection();
    $busca = $conecao->prepare('CALL chamadoEmAtendimento(:pchamado_id)');
    $busca->bindValue(':pchamado_id', $chamadoId);
    $busca->execute();
    $confere = $busca->fetch();
    listaEspera($chamadoId);
    $_SESSION['atendimento'] = $confere;
    return $confere;
}

function adicionarMensagem($tecnicoId,$pessoaId, $chamadoId, $status_id, $data) {
    $conecao = newConection();
    $msg = $conecao->prepare('CALL adicionarMensagem(:pstatus_id, :ptecnico_id, :ppessoa_id, :pdata_movimentacao, :pchamadoId)');
    $msg->bindValue(':pstatus_id', $status_id);
    $msg->bindValue(':ptecnico_id', $tecnicoId);
    $msg->bindValue(':ppessoa_id', $pessoaId);
    $msg->bindValue(':pdata_movimentacao', $data);
    $msg->bindValue(':pchamadoId', $chamadoId);
    $msg->execute();
}

function lerMensagens($pessoaId){
    $conecao = newConection();
    $ler = $conecao->prepare('CALL lerMensagens(:ppessoaid)');
    $ler->bindValue(':ppessoaid',$pessoaId);
    $ler->execute();
}

function listarChamados($id) {
    $conecao = newConection();

    if ($id == TRUE) {
        $listaChamados = $conecao->prepare('CALL listaChamados');
        $listaChamados->execute();
    } else {
        $listaChamados = $conecao->prepare('CALL listaChamadoFinalizado');
        $listaChamados->execute();
    }   
    return $listaChamados;
}

function listarPrioridades($con) {
    $listaPrioridades = $con->prepare('CALL listaPrioridades');
    $listaPrioridades->execute();
    return $listaPrioridades;
}

function listarMensagens($pessoa_id){
    $conecao = newConection();
    $listaMensagens = $conecao->prepare('CALL listarMensagens(:ppessoa_id)');
    $listaMensagens->bindValue(':ppessoa_id',$pessoa_id);
    $listaMensagens->execute();
    return $listaMensagens;
}

function listaEspera($chamadoId){
    $conecao = newConection();
    $espera = $conecao->prepare('CALL listaEspera(:pchamadoId)');
    $espera->bindValue(':pchamadoId',$chamadoId);
    $espera->execute();
    $e = $espera->fetch();
    $_SESSION['esperas'] = $e['descricao'];
}

?>