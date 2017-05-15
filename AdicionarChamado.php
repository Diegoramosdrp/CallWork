<html>
    <head>
        <title>CallWork</title>
        <link href=Css/style.css rel="stylesheet">
        <link href=Bootstrap/css/bootstrap.min.css rel="stylesheet" />
        <link href=Bootstrap/css/bootstrap-theme.min.css rel="stylesheet"/>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
        <script src="Bootstrap/js/jquery.js"></script>
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
                            <legend class="">Novo Chamado</legend>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <label for="textArea" class="control-label">Descrição</label>
                                    <textarea class="form-control" rows="3" name="descricao" style="resize: vertical" maxlength="500"></textarea>
                                </div>                                
                            </div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="form-group">    
                                        <div class="col-lg-1">
                                            <label for="select" class="control-label">Setor</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <select class="form-control" id="select" name="setor">
                                                <option> -- Selecione --</option>
                                                <?php foreach ($listaSetores as $row): ?>
                                                    <option value="<?php echo $row['setor_id']; ?>"><?php echo $row['nome']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-1">
                                            <label for="select" class="control-label">Prioridade</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <select class="form-control" id="select" name="prioridade" <?php if($_SESSION['a']['permissao_id'] == 6){echo 'disabled=""';} ?>>
                                                <?php foreach ($listaPrioridades as $row): ?>
                                                    <option value="<?php echo $row['prioridade_id']; ?>"><?php echo $row['nome']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 text-right">
                                            <button type="submit" class="btn btn-success" name="adicionarChamado">Enviar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <?php if (isset($_SESSION['mensagem'])): ?>
                        <div class="<?php echo $_SESSION['class']; ?> form-control">
                            <?php
                            echo $_SESSION['mensagem'];
                            unset($_SESSION['mensagem'])
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </body>
</html>