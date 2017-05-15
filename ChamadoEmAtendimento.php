<html>
    <head>
        <title>CallWork</title>
        <link href=Css/style.css rel="stylesheet">
        <link href=Bootstrap/css/bootstrap.min.css rel="stylesheet" />
        <link href=Bootstrap/css/bootstrap-theme.min.css rel="stylesheet"/>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
        <script>
            function abrirDiv(div) {
                var display = document.getElementById(div).style.display;
                if (display == "none"){
                    if(div == "transferir"){
                        document.getElementById("transferir").style.display = "block";
                        document.getElementById("esperar").style.display = "none";
                        document.getElementById("finalizar").style.display = "none";
                    }
                    else if (div == "esperar"){
                        document.getElementById("transferir").style.display = "none";
                        document.getElementById("esperar").style.display = "block";
                        document.getElementById("finalizar").style.display = "none";
                    }
                    else{
                        document.getElementById("transferir").style.display = "none";
                        document.getElementById("esperar").style.display = "none";
                        document.getElementById("finalizar").style.display = "block";
                    }
                }
            }
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <?php include './Template/menusuperior.php'; ?>
            <div class="row">
                <div class="col-md-3">
                    <?php include './Template/menulateral.php'; ?>
                </div>
                <div class="col-md-8">
                    <legend>Chamado Em Atendimento</legend>    
                    <div class="row h4">
                        <div class="col-lg-3 text-right">
                            Aberto Por :
                        </div>
                        <div class="col-lg-5">
                            <?php echo $_SESSION['atendimento']['pessoa']; ?>
                        </div>
                        <div class="col-lg-3">
                            <?php
                            setlocale(LC_ALL, 'pt-BR');
                            date_default_timezone_set('America/Sao_Paulo');
                            echo utf8_encode(strftime('EM : %d/%m/%Y %H:%M', strtotime($_SESSION['atendimento']['data_criacao'])));
                            ?>
                        </div>
                    </div>
                    <div class="row h4">
                        <div class="col-lg-3 text-right">
                            Setor :
                        </div>
                        <div class="col-lg-3">
                            <?php echo $_SESSION['atendimento']['setor_nome']; ?>
                        </div>
                    </div>
                    <div class="row h4">
                        <div class="col-lg-3 text-right">
                            Prioridade :
                        </div>
                        <div class="col-lg-3">
                            <span class="badge" style="background-color: <?php echo $_SESSION['atendimento']['prioridade_cor']; if ($_SESSION['atendimento']['prioridade_id'] == 2) {echo ';color: black';}?>"><?php echo $_SESSION['atendimento']['prioridade_nome']; ?></span>
                        </div>
                    </div>
                    <div class="row h4">
                        <div class="col-lg-3 text-right">
                            Descrição Do Problema :
                        </div>
                    </div>
                    <div class="row h4">
                        <div class="col-lg-12">
                            <div class="list-group list-group-item">
                                <?php echo $_SESSION['atendimento']['descricao']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row h4">
                        <div class="col-lg-12 text-right">
                            <button type="button" class="btn btn-info" onclick="abrirDiv('transferir')">Transferir</button>
                            <button type="submit" class="btn btn-warning" onclick="abrirDiv('esperar')">Esperar</button>
                            <button type="submit" class="btn btn-success" onclick="abrirDiv('finalizar')">Finalizar</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row" id="transferir" style="display: none">
                        <form class="form-horizontal" action="PHP/Gerenciador.php" method="POST">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <label for="textArea" class="control-label">Transferir Para :</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="form-control">
                                            <option> -- Selecione --</option>
                                            <?php foreach ($listaTecnicos as $row): ?>
                                                <option value="<?php echo $row['pessoa_id']; ?>"><?php echo $row['nome_usuario']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-info">Transferir</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="esperar" style="display: none">
                        <form class="form-horizontal" action="PHP/Gerenciador.php" method="POST">
                            <div class="row">
                                <div class="col-lg-9">
                                    <label for="textArea" class="control-label">Descrição De Espera</label>
                                    <textarea class="form-control" rows="3" name="descricao" style="resize: none" maxlength="500"></textarea>
                                </div>
                            </div>
                            <div class="row h4">
                                <div class="col-lg-9 text-right">
                                    <button type="submit" class="btn btn-warning">Justificar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="finalizar" style="display: none">
                        <form class="form-horizontal" action="PHP/Gerenciador.php" method="POST">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="">
                                        <label for="textArea" class="control-label">Adicionar Auxilio Tecníco</label>
                                        <div class="list-group list-group-item scroll-list-2" id="tecnicos">
                                            <?php foreach ($listaTecnicos2 as $row): ?>
                                                <input type="checkbox" name="check_list[]" value="<?php echo $row['pessoa_id']; ?>"> <?php echo $row['nome_usuario']; ?><br>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row h4">
                                <div class="col-lg-5 text-right">
                                    <button type="submit" class="btn btn-success">Finalizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>