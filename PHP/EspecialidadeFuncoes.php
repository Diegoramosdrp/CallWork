<?php
include_once 'Config_1.php';
function adicionarEspecialidade($nome, $con) {
    if ($nome != NULL) {
        $nome = ucfirst($nome);
        $busca = $con->prepare('SELECT * FROM `especialidades` WHERE `nome` = :pnome');
        $busca->bindValue('pnome', $nome);
        $busca->execute();
        $validar = $busca->fetch();

        if (strcmp($validar, $nome) != 0) {
            $adiciona = $con->prepare('INSERT INTO `especialidades` (`especialidade_id`,`nome`) VALUES (NULL, :pnome);');
            $adiciona->bindValue(':pnome', $nome);
            $adiciona->execute();
            $_SESSION['mensagem'] = 'Especialidade Adicionado Com Sucesso';
            $_SESSION['class'] = 'alert-success';
        } else {
            $_SESSION['mensagem'] = 'Especialidade Já Cadastrada';
            $_SESSION['class'] = 'alert-danger';
        }
    } else {
        $_SESSION['mensagem'] = 'O Campo Não Pode Ficar Vazio';
        $_SESSION['class'] = 'alert-warning';
    }
}

function excluirEspecialidade($id, $con) {
    $excluir = $con->prepare('DELETE FROM `especialidades` WHERE `especialidades`.`especialidade_id` = :pid');
    $excluir->bindValue(':pid', $id);
    $excluir->execute();
    $_SESSION['mensagem'] = 'Especialidade Excluida';
    $_SESSION['class'] = 'alert-success';
}

function listarEspecialidades($con) {
    $listaEspecialidades = $con->prepare('SELECT * FROM `especialidades`');
    $listaEspecialidades->execute();
    return $listaEspecialidades;
}
