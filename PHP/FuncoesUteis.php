<?php

include_once 'Config_1.php';

function formularioAcesso($nomeUsuario, $nomePessoa, $cargo, $setor, $permissao) {
    $formulario = array(
        'nomeUsuario' => $nomeUsuario,
        'nomePessoa' => $nomePessoa,
        'cargo' => $cargo,
        'setor' => $setor,
        'permissao' => $permissao);
    $_SESSION['formulario'] = $formulario;
}

function formularioLogin($nomeUsuario, $senha) {
    $formulario = array(
        'nomeUsuario' => $nomeUsuario,
        'senha' => $senha);
    $_SESSION['formulario'] = $formulario;
}

function dataAtual() {
    date_default_timezone_set('America/Sao_Paulo');
    return date('Y-m-d H:i:s');
}

function recarregarPagina() {
    $conecao = newConection();
    $recarregar = $conecao->prepare('SELECT * FROM `chamados`');
    $recarregar->execute();
    return $recarregar->rowCount();
}

?>