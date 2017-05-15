<html>
    <head>
        <title>CallWork</title>
        <link href=Css/style.css rel="stylesheet">
        <link href=Bootstrap/css/bootstrap.min.css rel="stylesheet" />
        <link href=Bootstrap/css/bootstrap-theme.min.css rel="stylesheet"/>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            function showText() {
                document.getElementById("text1").style.visibility = "hidden";
                document.getElementById("text2").style.visibility = "visible";
            }
            function hideText() {
                document.getElementById("text1").style.visibility = "visible";
                document.getElementById("text2").style.visibility = "hidden";
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
                            Diretor Diego Ramos de Paula
                        </div>
                        <div class="col-lg-3">
                            Em : 19/04/2017 21:30
                        </div>
                    </div>
                    <div class="row h4">
                        <div class="col-lg-3 text-right">
                            Setor :
                        </div>
                        <div class="col-lg-3">
                            Producao
                        </div>
                    </div>
                    <div class="row h4">
                        <div class="col-lg-3 text-right">
                            Prioridade :
                        </div>
                        <div class="col-lg-3">
                            <span class="badge" style="background-color: green">Urgente</span>
                        </div>
                    </div>
                    <div class="row h4">
                        <div class="col-lg-3 text-right">
                            <a onclick="showText();" href="#" class="link-cinza">Detalhes</a>
                        </div>
                    </div>
                    <div class="row h4">
                        <div class="col-lg-12">
                            <div class="list-group list-group-item" id="text2" style="visibility:hidden;">
                                Desconsidera... Viajei... Mas seria colocar a camada na frente da td... ai não seria possivel visualizar... mas alem de não ser funcional... se redimencionar a pagina ia ficar um horror...
                                Cria outra tab pra esses dados numa div e oculta ela...

                                <span><a onclick="hideText();" href="#" class="link-cinza">Fechar</a></span>
                            </div>
                        </div>
                    </div>
                    <div class="row h4">
                        <div class="col-lg-12 text-right">
                            <button type="submit" class="btn btn-info">Transferir</button>
                            <button type="submit" class="btn btn-warning">Esperar</button>
                            <button type="submit" class="btn btn-success">Finalizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div id="text1">
            Quando expandir, eu pretendo que desapareça este texto e abra simultaneamente o texto oculto.<br>
            Este código atual, abre o texto oculto, mas este texto continua.<br>
            <a onclick="showText();" href="#" class="link-cinza">Detalhes</a>
        </div>
        <div id="text2" style="visibility:hidden;">
            Conteúdo oculto deve aparecer sozinho na página.<br>
            Mas atulmente está abrindo junto com o texto acima.
            <span><a onclick="hideText();" href="#" class="link-cinza">Fechar</a></span>
        </div>
</body>
</html>


