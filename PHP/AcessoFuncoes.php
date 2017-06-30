<?php

function logar($nomeUsuario, $senha, $con) {
    if (!empty($nomeUsuario) && !empty($senha)) {
        $logar = $con->prepare('SELECT `logins`.*, `pessoas`.`nome` FROM `logins` INNER JOIN `pessoas` ON `logins`.`pessoa_id` = `pessoas`.`pessoas_id` WHERE `nome_usuario` LIKE :pnomeUsuario AND `senha` LIKE MD5(:psenha);');
        $logar->bindValue(':pnomeUsuario', $nomeUsuario);
        $logar->bindValue(':psenha', $senha);
        $logar->execute();
        $busca = $logar->fetch();
        if ($busca['nome_usuario'] != NULL) {
            $_SESSION['a'] = $busca;
            if ($busca['primeiro_acesso'] == 0) {
                formularioLogin($nomeUsuario, $senha);
                $_SESSION['mensagem'] = 'Cadastre Uma Senha Para Acessar';
                $_SESSION['class'] = 'alert alert-dismissible alert-danger';
                $_SESSION['primeiro_acesso'] = 1;
                return 1;
            } else {
                unset($_SESSION['formulario']);
                unset($_SESSION['primeiro_acesso']);
            }
            $ultimoacesso = $con->prepare('UPDATE `logins` SET `data_ultimo_acesso` = :pdataultimoacesso WHERE `logins`.`login_id` = :ploginId');
            $ultimoacesso->bindValue(':pdataultimoacesso', dataAtual());
            $ultimoacesso->bindValue(':ploginId', $busca['login_id']);
            $ultimoacesso->execute();
        } else {
            $_SESSION['mensagem'] = 'Login Invalido';
            $_SESSION['class'] = 'alert alert-dismissible alert-danger';
            return 1;
        }
    } else {
        $_SESSION['mensagem'] = 'Campos Vazios';
        $_SESSION['class'] = 'alert alert-dismissible alert-danger';
        return 1;
    }
}

function deslogar() {
    session_destroy();
}

function alterarSenha($loginId, $nomeUsuario, $senha, $novaSenha, $senhaConfere, $con) {
    if (!empty($loginId) && !empty($senha) && !empty($novaSenha) && !empty($senhaConfere)) {
        if (strcmp(md5($senha), $_SESSION['a']['senha']) == 0) {
            if (strcmp($senha, $novaSenha) != 0) {
                if (strcmp($novaSenha, $senhaConfere) == 0) {
                    $alterar = $con->prepare('UPDATE `logins` SET `senha` = MD5(:psenha), `primeiro_acesso` = :pprimeiro_acesso WHERE `logins`.`login_id` = :ploginId');
                    $alterar->bindValue(':psenha', $novaSenha);
                    $alterar->bindValue(':ploginId', $loginId);
                    $alterar->bindValue(':pprimeiro_acesso', 1);
                    $alterar->execute();
                    unset($_SESSION['formulario']);
                    unset($_SESSION['primeiro_acesso']);
                    $_SESSION['mensagem'] = 'Alterada Com Sucesso';
                    $_SESSION['class'] = ' alert alert-dismissible alert-success';
                    logar($nomeUsuario, $novaSenha, $con);
                } else {
                    $_SESSION['mensagem'] = 'Senhas Não Conferem';
                    $_SESSION['class'] = ' alert alert-dismissible alert-danger';
                    return 1;
                }
            } else {
                $_SESSION['mensagem'] = 'A Nova Senha Não Pode Ser Igual A Atual';
                $_SESSION['class'] = 'alert alert-dismissible alert-danger';
                return 1;
            }
        } else {
            $_SESSION['mensagem'] = 'Senha Atual Incorreta';
            $_SESSION['class'] = 'alert alert-dismissible alert-danger';
            return 1;
        }
    } else {
        $_SESSION['mensagem'] = 'Preencha Todos Os Campos';
        $_SESSION['class'] = 'alert alert-dismissible alert-danger';
        return 1;
    }
}

function gerarAcesso($nomeUsuario, $nomePessoa, $senha, $senhaConferencia, $cargo, $setorId, $permissaoId, $listaEspecialidade, $con) {
    $lista = array();
    foreach ($listaEspecialidade as $row) {
        $lista[] = $row;
    }

    if (!empty($nomeUsuario) && !empty($nomePessoa) && !empty($senha) && !empty($senhaConferencia) && !empty($cargo) && $setorId != 0 && $permissaoId != 0) {
        if (strcmp($senha, $senhaConferencia) == 0) {
            if ($_POST['check_list'] != NULL || $permissaoId != 4) {
                if (strcmp(buscarUsuario($nomeUsuario, $con), $nomeUsuario)) {
                    //Adicionar Pessoa Ao Banco De Dados
                    $adicionaPessoa = $con->prepare('INSERT INTO `pessoas` (`pessoas_id`,`nome`,`cargo`,`setor_id`) VALUES(NULL, :pnome, :pcargo, :psetor);');
                    $adicionaPessoa->bindValue(':pnome', $nomePessoa);
                    $adicionaPessoa->bindValue(':pcargo', $cargo);
                    $adicionaPessoa->bindValue(':psetor', $setorId);
                    $adicionaPessoa->execute();
                    $idPessoa = $con->lastInsertId();

                    //Adicionar Login Ao Banco De Dados
                    $adicionaLogin = $con->prepare('INSERT INTO `logins` (`login_id`, `nome_usuario`, `senha`, `permissao_id`, `primeiro_acesso`, `pessoa_id`) VALUES(NULL, :pnome_usuario, MD5(:psenha), :ppermissao_id, :pprimeiro_acesso, :ppessoa_id)');
                    $adicionaLogin->bindValue(':pnome_usuario', $nomeUsuario);
                    $adicionaLogin->bindValue(':psenha', $senha);
                    $adicionaLogin->bindValue(':ppermissao_id', $permissaoId);
                    $adicionaLogin->bindValue(':pprimeiro_acesso', 0);
                    $adicionaLogin->bindValue(':ppessoa_id', $idPessoa);
                    $adicionaLogin->execute();
                    $idLogin = $con->lastInsertId();

                    //Adicionar Especialidades Do Tecnico
                    if ($idLogin != NULL && $permissaoId == 4) {
                        foreach ($lista as $l) {
                            $adicionaEspecialidadeTecnico = $con->prepare('INSERT INTO `especialidades_tecnicos` (`login_id`,`especialidade_id`) VALUES(:plogin_id, :pespecialidade_id);');
                            $adicionaEspecialidadeTecnico->bindValue(':plogin_id', $idLogin);
                            $adicionaEspecialidadeTecnico->bindValue(':pespecialidade_id', $l);
                            $adicionaEspecialidadeTecnico->execute();
                        }
                    }
                    $_SESSION['mensagem'] = 'Acesso Adicionado Com Sucesso';
                    $_SESSION['class'] = 'alert-success';
                    unset($_SESSION['formulario']);
                } else {
                    $_SESSION['mensagem'] = 'Usuário Já Existe';
                    $_SESSION['class'] = 'alert-danger';
                }
            } else {
                $_SESSION['mensagem'] = 'Deve Ser Indicada As Especialidades Do Tecnico';
                $_SESSION['class'] = 'alert-danger';
            }
        } else {
            $_SESSION['mensagem'] = 'As Senhas Não Conferem';
            $_SESSION['class'] = 'alert-danger';
        }
    } else {
        $_SESSION['mensagem'] = 'Todos Os Campos São Obrigatorio';
        $_SESSION['class'] = 'alert-danger';
    }
}

function buscarUsuario($nomeUsuario, $con) {
    $busca = $con->prepare('SELECT * FROM `logins` WHERE `nome_usuario` = :pnome_usuario');
    $busca->bindValue('pnome_usuario', $nomeUsuario);
    $busca->execute();
    $validar = $busca->fetch();
    return $validar;
}

function listarTecnicos(){
    $con = newConection();
    $listaTecnicos = $con->prepare('CALL listaTecnicos');
    $listaTecnicos->execute();
    return $listaTecnicos;
}

function listarPermissoes() {
    $con = newConection();
    $listaPermissoes = $con->prepare('SELECT * FROM `permissoes`');
    $listaPermissoes->execute();
    return $listaPermissoes;
}

function paginasPermitidas($pagina, $permissao_id, $id){
    $paginas = array(
        'AdicionarChamado.php' => array('Adicionar Chamado',1,2,3,6),
        'AdicionarEspecialidade.php' => array('Adicionar Especialidade',4,5),
        'AdicionarSetor.php' => array('Adicionar Setor',4,5),
        'AlterarSenha.php' => array('Alterar Senha',1,2,3,4,5,6),
        'ChamadoEmProcesso.php' => array('Chamado Em Processo',4,5),
        'DetalhesChamado.php' => array('Detalhes Chamado',1,2,3,4,5,6),
        'ExcluirUsuariosInativos.php' => array('Excluir Usuarios Inativos',7),
        'GerarAcesso.php' => array('Gerar Acesso',4,5),
        'MeusChamadosSolicitante.php' => array('Meus Chamados',1,2,3,6),
        'MeusChamadosTecnico.php' => array('Meus Chamados',4),
        'Relatorios.php' => array('Relatórios',1,2,3,4,5,6),
        );
    if ($id == 0) {
        return $paginas;
    }
    
    foreach ($paginas as $rotulo => $permissao){
        if ($pagina == $rotulo) {
            foreach ($permissao as $p){
                if ($p == $permissao_id) {
                    return 1;
                }
            }
        }
    }
    return 0;
}

function garantirAcesso(){
    if (!isset($_SESSION['a'])) {
        header('location:./Index.php');
    }
}

function manterLogado(){
    if (isset($_SESSION['a'])) {
        if ($_SESSION['a']['permissao_id'] < 4 || $_SESSION['a']['permissao_id'] == 6) {
            header('location:./AdicionarChamado.php');
        }else{
            header('location:./ChamadoEmProcesso.php');
        }
    }
}

function tempoAtingido($dataAcesso){
    if ($dataAcesso < dataAtual()) {
        
    }
}

function paginaInicial(){
    if ($_SESSION['a']['permissao_id'] < 4 || $_SESSION['a']['permissao_id'] == 6) {
        header('location:../AdicionarChamado.php');
    }else{
        header('location:../ChamadoEmProcesso.php');
    }
}

?>
