<html>
    <head>
        <title>CallWork</title>
        <link href=Css/style.css rel="stylesheet">
        <link href=Bootstrap/css/bootstrap.min.css rel="stylesheet" />
        <link href=Bootstrap/css/bootstrap-theme.min.css rel="stylesheet"/>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body class="scrollbar">
        <div class="container-fluid">
            <?php include './Template/menusuperior.php'; ?>
            <div class="row">
                <div class="col-md-3">
                    <?php include './Template/menulateral.php'; ?>
                </div>
                <div class="col-md-8">
                    <legend>Chamado Em Processo</legend>
                    <div class="scroll-list-3">
                        <?php foreach ($listaChamados as $row): ?>
                            <div class="list-group list-group-item">
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
                                <hr>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-md-12">
                                                Aberto Por : <?php echo $row['pessoa']; ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php
                                                setlocale(LC_ALL, 'pt-BR');
                                                date_default_timezone_set('America/Sao_Paulo');
                                                echo utf8_encode(strftime('EM : %d/%m/%Y %H:%M', strtotime($row['data_criacao'])));
                                                ?>
                                            </div>
                                            <div class="col-md-6">
                                                Setor : <?php echo $row['setor_nome']; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text-right">
                                        <?php if ($row['tecnico_id'] == 0) : ?>
                                            <a href="PHP/Gerenciador.php?atenderChamado&id=<?php echo $row['chamado_id'];?>" class="btn btn-success">Atender</a>
                                        <?php else: ?>
                                            <div class="form-control alert-warning text-center">Em Atendimento Por: <?php echo $row['tecnico']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <br>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>