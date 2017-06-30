<html>
    <head>
        <title>CallWork</title>
        <link href=Css/style.css rel="stylesheet">
        <link href=Bootstrap/css/bootstrap.min.css rel="stylesheet" />
        <script src="Bootstrap/js/jquery.js"></script>
        <link href=Bootstrap/css/bootstrap-theme.min.css rel="stylesheet"/>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <?php include_once './Template/menusuperior.php'; ?>
            <div class="row">
                <div class="col-md-3">
                    <?php include './Template/menulateral.php'; ?>
                </div>
                <div class="col-md-8">
                    <legend>Novo Setor</legend>
                    <form class="form-inline" action="PHP/Gerenciador.php" method="POST">
                        <div class="form-group">
                            <label for="nome" class="control-label">Nome</label>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="nome" type="text" placeholder="Digite Setor" autofocus="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success" name="cadastrarSetor">Enviar</button>
                        </div>
                        <div class="form-group">
                            <?php if (isset($_SESSION['mensagem'])): ?>
                                <div class="<?php echo $_SESSION['class']; ?> form-control">
                                    <?php
                                    echo $_SESSION['mensagem'];
                                    unset($_SESSION['mensagem'])
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                    <hr>
                    <div class="form-horizontal">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group scroll-list">
                                        <table class="table table-striped table-hover well">
                                            <thead>
                                                <tr>
                                                    <th>Setores Cadastrados</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($listaSetores as $row): ?>
                                                    <tr>
                                                        <td><?php echo $row['nome']; ?></td>
                                                        <td class="text-right">
                                                            <a href="PHP/Gerenciador.php?excluirSetor&id=<?php echo $row['setor_id']; ?>" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>    
                                                </tbody>
                                        </table> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>