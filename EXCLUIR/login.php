<html>
    <head>
        <title>CallWork</title>
        <link href=Css/style.css rel="stylesheet">
        <link href=Bootstrap/css/bootstrap.min.css rel="stylesheet" />
        <link href=Bootstrap/css/bootstrap-theme.min.css rel="stylesheet"/>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <?php include './Template/menusuperior.php'; ?>
            <div class="row">
                <div class="col-md-3">
                    <?php include './Template/menulateral.php'; ?>
                </div>
                <div class="col-md-8">
                    <div class="alert alert-dismissible alert-warning">
                        <h4>Atenção!</h4>
                        <p>Nenhum Usuário Inativo Encontrado</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

function logar($nomeUsuario, $senha, $con) {
    if (!empty($nomeUsuario) && !empty($senha)) {
        $logar = $con->prepare('SELECT * FROM `logins` WHERE `nome_usuario` LIKE :pnomeUsuario AND `senha` LIKE MD5(:psenha);');
        $logar->bindValue(':pnomeUsuario', $nomeUsuario);
        $logar->bindValue(':psenha', $senha);
        $logar->execute();
        $busca = $logar->fetch();
        if ($busca['nome_usuario'] != NULL) {
            $_SESSION['a'] = $busca;
            if ($busca['primeiro_acesso'] == 0) {
                formularioLogin($nomeUsuario, $senha);
                $_SESSION['mensagem'] = 'Cadastre Uma Senha Para Acessar';
                $_SESSION['class'] = 'form-control alert-danger';
                $_SESSION['primeiro_acesso'] = 1;
                return 1;
            } else {
                unset($_SESSION['formulario']);
                unset($_SESSION['primeiro_acesso']);
            }
        } else {
            $_SESSION['mensagem'] = 'Login Invalido';
            $_SESSION['class'] = 'form-control alert-danger';
            return 1;
        }
    } else {
        $_SESSION['mensagem'] = 'Campos Vazios';
        $_SESSION['class'] = 'form-control alert-danger';
        return 1;
    }
}