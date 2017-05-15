<?php

function adicionarSetor($nome, $con) {
    if ($nome != NULL) {
        $nome = ucfirst($nome);
        $busca = $con->prepare('SELECT * FROM `setores` WHERE `nome` = :pnome');
        $busca->bindValue('pnome', $nome);
        $busca->execute();
        $validar = $busca->fetch();

        if (strcmp($validar, $nome) != 0) {
            $adiciona = $con->prepare('INSERT INTO `setores` (`setor_id`,`nome`) VALUES (NULL, :pnome);');
            $adiciona->bindValue(':pnome', $nome);
            $adiciona->execute();
            $_SESSION['mensagem'] = 'Setor Adicionado Com Sucesso';
            $_SESSION['class'] = 'alert-success';
        } else {
            $_SESSION['mensagem'] = 'Setor Já Cadastrado';
            $_SESSION['class'] = 'alert-danger';
        }
    } else {
        $_SESSION['mensagem'] = 'O Campo Não Pode Ficar Vazio';
        $_SESSION['class'] = 'alert-warning';
    }
}

function excluirSetor($id, $con) {
    $excluir = $con->prepare('DELETE FROM `setores` WHERE `setores`.`setor_id` = :pid');
    $excluir->bindValue(':pid', $id);
    $excluir->execute();
    $_SESSION['mensagem'] = 'Setor Excluido';
    $_SESSION['class'] = 'alert-success';
}

function listarSetores($con) {
    $listaSetores = $con->prepare('SELECT * FROM `setores`');
    $listaSetores->execute();
    return $listaSetores;
}
