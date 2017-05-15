<?php

include_once 'FuncoesUteis.php';
include_once 'SetorFuncoes.php';
include_once 'EspecialidadeFuncoes.php';
include_once 'ChamadoFuncoes.php';
include_once 'AcessoFuncoes.php';
include 'Config.php';
session_start();
//------------------------------------------------------------------------------------------------------------------------------
// -- FUNÇÕES LOGIN -- 
//Logar
if (isset($_POST['logar'])) {
    $idLogin = logar($_POST['nomeUsuario'], $_POST['senha'], $conecao);
    if ($idLogin == 1) {
        header('location:../Index.php');
    } else {
        header('location:../Index3.php');
    }
}

if (isset($_GET['deslogar'])) {
    deslogar();
    header('location:../Index.php');
}

if (isset($_POST['alterarSenha'])) {
    formularioLogin($_POST['nomeUsuario'], $_POST['senha']);
    $idAltSenha = alterarSenha($_POST['loginId'], $_SESSION['a']['nome_usuario'], $_POST['senha'], $_POST['novaSenha'], $_POST['senhaConfere'], $conecao);
    if ($_POST['flag'] != NULL) {
        header('location:../AlterarSenha.php');
    } else {
        if ($idAltSenha == 1) {
            header('location:../Index.php');
        } else {            
            header('location:../Index3.php');
        }
    }
}

//------------------------------------------------------------------------------------------------------------------------------
// -- FUNÇÕES SETOR -- 
//Adicionar Setor
if (isset($_POST['cadastrarSetor'])) {
    adicionarSetor($_POST['nome'], $conecao);
    header('location:../AdicionarSetor.php');
}

//Excluir Setor
if (isset($_GET['excluirSetor'])) {
    excluirSetor($id = $_GET['id'], $conecao);
    header('location:../AdicionarSetor.php');
}

//------------------------------------------------------------------------------------------------------------------------------
// -- FUNÇÕES ESPECIALIDADE --
//Adicionar Especialidade
if (isset($_POST['cadastrarEspecialidade'])) {
    adicionarEspecialidade($_POST['nome'], $conecao);
    header('location:../AdicionarEspecialidade.php');
}

//Excluir Setor
if (isset($_GET['excluirEspecialidade'])) {
    excluirEspecialidade($id = $_GET['id'], $conecao);
    header('location:../AdicionarEspecialidade.php');
}

//------------------------------------------------------------------------------------------------------------------------------
// -- FUNÇÕES CHAMADO --
//Adicionar Chamado
if (isset($_POST['adicionarChamado'])) {
    adicionarChamado($_SESSION['a']['pessoa_id'], $_POST['descricao'], $_POST['prioridade'], $_POST['setor'], $conecao);
    header('location:../AdicionarChamado.php');
}

if (isset($_GET['atenderChamado'])) {
    atenderChamado($id = $_GET['id'], $_SESSION['a']['pessoa_id']);
    header('location:../ChamadoEmAtendimento.php');
}

//------------------------------------------------------------------------------------------------------------------------------
// -- FUNÇÕES ACESSO --
//Adicionar Acesso
if (isset($_POST['adicionarAcesso'])) {
    $acesso = $_POST['nomeUsuario'];
    formularioAcesso($_POST['nomeUsuario'], $_POST['nomePessoa'], $_POST['cargo'], $_POST['setor'], $_POST['permissao']);
    gerarAcesso($_POST['nomeUsuario'], $_POST['nomePessoa'], $_POST['senha'], $_POST['senhaConferencia'], $_POST['cargo'], $_POST['setor'], $_POST['permissao'], $_POST['check_list'], $conecao);
    header('location:../GerarAcesso.php');
}

//------------------------------------------------------------------------------------------------------------------------------
// -- LISTAS -- 

//Listar Chamados
$listaChamados = listarChamados($conecao);

//Listar Setores
$listaSetores = listarSetores($conecao);

//Listar Especialidades
$listaEspecialidades = listarEspecialidades($conecao);

//Listar Prioridades
$listaPrioridades = listarPrioridades($conecao);

//Listar Permissões
$listaPermissoes = listarPermissoes();

//Listar Tecnicos
$listaTecnicos = listarTecnicos();
$listaTecnicos2 = listarTecnicos();

?>