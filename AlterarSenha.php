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
                    <form class="form-horizontal" action="PHP/Gerenciador.php" method="POST">
                        <fieldset>
                            <legend>Alterar Senha</legend>
                            <div>
                                <input class="form-control" type="hidden" name='loginId' value="<?php echo @$_SESSION['a']['login_id'] ?>"/>
                                <input class="form-control" type="hidden" name='flag' value="1"/>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <label for="textArea" class="control-label">Senha Atual</label>
                                    <input class="form-control" name="senha" type="password" autofocus="">
                                </div>                                
                            </div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <label for="textArea" class="control-label">Nova Senha</label>
                                    <input class="form-control" name="novaSenha" type="password">
                                </div>                                
                            </div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <label for="textArea" class="control-label">Repita Nova Senha</label>
                                    <input class="form-control" name="senhaConfere" type="password">
                                </div>                                
                            </div>
                            <div class="form-group">
                                <div class="col-lg-5 text-right">
                                    <button type="submit" class="btn btn-success" name="alterarSenha">Alterar</button>
                                </div>
                            </div>
                        </fieldset>
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
    </body>
</html>