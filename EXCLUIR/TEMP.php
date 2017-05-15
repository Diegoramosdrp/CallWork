function adicionarPessoa($nomePessoa, $cargo, $setorId, $con) {
    if ($_POST['nomePessoa'] != NULL && $_POST['cargo'] != NULL && $_POST['setor'] != NULL && $_POST['nomeUsuario'] != NULL && $_POST['senha'] != NULL && $_POST['senhaConferencia'] != NULL && $_POST['permissao'] != NULL) {
        if ($_POST['check_list'] != NULL || $_POST['permissao'] != 4) {
            if (strcmp($_POST['senha'], $_POST['senhaConferencia']) == 0) {
                $busca = $con->prepare('SELECT * FROM `logins` WHERE `nome_usuario` = :pnome_usuario');
                $busca->bindValue('pnome_usuario', $_POST['nomeUsuario']);
                $busca->execute();
                $validar = $busca->fetch();
                if (strcmp($validar, $_POST['nomeUsuario']) != 0) {
                    $adiciona = $con->prepare('INSERT INTO `pessoas` (`pessoas_id`,`nome`,`cargo`,`setor_id`) VALUES(NULL, :pnome, :pcargo, :psetor);');
                    $adiciona->bindValue(':pnome', $nomePessoa);
                    $adiciona->bindValue(':pcargo', $cargo);
                    $adiciona->bindValue(':psetor', $setorId);
                    $adiciona->execute();
                    $_SESSION['mensagem'] = 'Acesso Adicionado Com Sucesso';
                    $_SESSION['class'] = 'alert-success';
                    return $id = $con->lastInsertId();
                } else {
                    $_SESSION['mensagem'] = 'Já Existe Um Usuário Cadastrado Com Esse Nome';
                    $_SESSION['class'] = 'alert-danger';
                }
            } else {
                $_SESSION['mensagem'] = 'As Senhas Não Conferem';
                $_SESSION['class'] = 'alert-danger';
            }
        } else {
            $_SESSION['mensagem'] = 'Deve Ser Indicada As Especialidades Do Tecnico';
            $_SESSION['class'] = 'alert-danger';
        }
    } else {
        $_SESSION['mensagem'] = 'Os Campos Não Pode Ficar Vazio';
        $_SESSION['class'] = 'alert-warning';
    }
}

function adicionarAcesso($nomeUsuario, $senha, $senhaConferencia, $permissaoId, $pessoaID, $con) {
    $adiciona = $con->prepare('INSERT INTO `logins` (`login_id`, `nome_usuario`, `senha`, `permissao_id`, `primeiro_acesso`, `pessoa_id`) VALUES(NULL, :pnome_usuario, MD5(:psenha), :ppermissao_id, :pprimeiro_acesso, :ppessoa_id)');
    $adiciona->bindValue(':pnome_usuario', $nomeUsuario);
    $adiciona->bindValue(':psenha', $senha);
    $adiciona->bindValue(':ppermissao_id', $permissaoId);
    $adiciona->bindValue(':pprimeiro_acesso', 0);
    $adiciona->bindValue(':ppessoa_id', $pessoaID);
    $adiciona->execute();
    return $id = $con->lastInsertId();
}

function adicionarListaEspecialidade($tecnicoID, $listaEspecialidade, $con) {
    foreach ($listaEspecialidade as $l) {
        $adiciona = $con->prepare('INSERT INTO `especialidades_tecnicos` (`login_id`,`especialidade_id`) VALUES(:plogin_id, :pespecialidade_id);');
        $adiciona->bindValue(':plogin_id', $tecnicoID);
        $adiciona->bindValue(':pespecialidade_id', $l);
        $adiciona->execute();
    }
}