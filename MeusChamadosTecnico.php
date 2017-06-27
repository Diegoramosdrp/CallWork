<html>
    <head>
        <title>CallWork</title>
        <link href=Css/style.css rel="stylesheet">
        <link href=Bootstrap/css/bootstrap.min.css rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href=Bootstrap/css/bootstrap-theme.min.css rel="stylesheet"/>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    </head>
    <body class="scrollbar">
        <div class="container-fluid">
            <?php include './Template/menusuperior.php'; ?>
            <div class="row">
                <div class="col-md-3">
                    <?php include './Template/menulateral.php'; ?>
                </div>
                <div class="col-md-8">
                    <legend>Meus Chamados</legend>
                    <div class="">
                        <a href="./PHP/Gerenciador.php?filtrar&id=1" class="btn btn-warning btn-xs">Em processo</a>
                        <a href="./PHP/Gerenciador.php?filtrar&id=2" class="btn btn-warning btn-xs">Encerrado</a>
                    </div>  
                    <div class="scroll-list-3">
                        <br>
                        <?php foreach ($listaChamadosFinalizado as $row): ?>
                            <?php if ($row['tecnico_id'] == $_SESSION['a']['pessoa_id']): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <?php echo $row['descricao']; ?>
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <span class="badge" style="background-color: <?php
                                                echo $row['prioridade_cor'];
                                                if ($row['prioridade_id'] == 2) {
                                                    echo ';color: black';
                                                }
                                                ?>"><?php echo $row['prioridade_nome']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Aberto Por : <?php echo $row['pessoa']; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <?php
                                                        setlocale(LC_ALL, 'pt-BR');
                                                        date_default_timezone_set('America/Sao_Paulo');
                                                        echo utf8_encode(strftime('Em : %d/%m/%Y %H:%M', strtotime($row['data_criacao'])));
                                                        ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                        Setor : <?php echo $row['setor_nome']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 form-inline text-right">
                                                <?php if ($row['status_id'] == 2) : ?>
                                                    <div class="form-control alert-warning text-center">Atendendo</div>
                                                <?php elseif ($row['status_id'] == 3): ?>
                                                    <span class="glyphicon glyphicon-comment text-right" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $row['esperas']?>"></span>&nbsp;
                                                    <div class="form-control alert-info text-center">Em Espera</div>
                                                <?php elseif ($row['status_id'] == 4): ?>
                                                    <div class="form-control alert-success text-center">Finalizado</div>
                                                <?php endif; ?> 
                                                <a href="PHP/Gerenciador.php?detalhes&id=<?php echo $row['chamado_id']; ?>" class="btn btn-success">Detalhes</a>
                                            </div>
                                            <div class="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>