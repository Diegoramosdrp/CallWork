<?php include 'PHP/Gerenciador.php'; 
if (isset($_SESSION['a'])) {
    if ($_SESSION['a']['primeiro_acesso'] != 0) {
         manterLogado();    
    }
}
?>
<html>
    <head>
        <title>CallWork</title>
        <link href=Css/style.css rel="stylesheet">
        <link href=Bootstrap/css/bootstrap.min.css rel="stylesheet" />
        <link href=Bootstrap/css/bootstrap-theme.min.css rel="stylesheet"/>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="Absolute-Center-align is-Responsive-align">
                    <div class="col-sm-12 col-md-offset-1">
                        <form action="PHP/Gerenciador.php" method="POST">
                            <div class="form-group input-group text-center col-lg-12">
                                <div id="logo-container well"><img src="Images/logo.jpg" width="140px" height="120px"/></div>
                                <br>
                            </div>
                            <div class="">
                                <input class="form-control" type="hidden" name='loginId' placeholder="Nome De Usuario" value="<?php echo @$_SESSION['a']['login_id'] ?>"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input class="form-control" <?php if (isset($_SESSION['primeiro_acesso'])){ echo 'readonly=""';} else{echo 'autofocus=""';}?> type="text" name='nomeUsuario' placeholder="Nome De Usuario" value="<?php echo @$_SESSION['formulario']['nomeUsuario'] ?>"/>          
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input class="form-control" <?php if (isset($_SESSION['primeiro_acesso'])){ echo 'readonly=""';}?> type="password" name='senha' placeholder="Senha" value="<?php echo @$_SESSION['formulario']['senha'] ?>"/>     
                            </div>
                            <?php if (isset($_SESSION['primeiro_acesso'])): ?>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input class="form-control" type="password" name='novaSenha' placeholder="Nova Senha"/>     
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input class="form-control" type="password" name='senhaConfere' placeholder="Repita Nova Senha"/>     
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success" name="alterarSenha">Alterar</button>
                                </div>
                            <?php else:?>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success" name="logar">Entrar</button>
                                </div>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['mensagem'])): ?>
                                <div class="<?php echo $_SESSION['class']; ?> ">
                                    <?php
                                    echo $_SESSION['mensagem'];
                                    unset($_SESSION['mensagem']);
                                    ?>
                                </div>
                            <?php endif; ?>
                        </form>        
                    </div>
                </div>    
            </div>
        </div>
    </body>
</html>