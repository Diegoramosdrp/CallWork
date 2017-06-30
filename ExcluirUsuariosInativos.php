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
            <?php include './Template/menusuperior.php'; ?>
            <div class="row">
                <div class="col-md-3">
                    <?php include './Template/menulateral.php'; ?>
                </div>
                <div class="col-md-8">
                    <legend>Excluir Usuários Inativos</legend>
                    <div>
                        <label>
                            <input type="checkbox"> Marcar Todos <br>
                        </label>
                    </div>
                    <div class="scroll-list">
                        <div class="list-group list-group-item">
                            <div class="row">
                                <div class="col-md-1">
                                    <label>
                                        <input type="checkbox" class="align-margin">
                                    </label>
                                </div>
                                <div class="col-md-11">
                                    <div class="row">
                                        <div class="col-md-12">
                                            Diego Ramos
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            Setor : Administração
                                        </div>
                                        <div class="col-md-6 text-right">
                                            Ultimo Acesso Em: 29/03/1990 23:10
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <div class="col-lg-12 text-right">
                        <button type="submit" class="btn btn-success">Excluir Selecionados</button>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="alert alert-dismissible alert-warning">
                        <p>Nenhum Usuário Inativo Encontrado</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>