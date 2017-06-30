<html>
    <head>
        <title>CallWork</title>
        <link href=Css/style.css rel="stylesheet">
        <link href=Bootstrap/css/bootstrap.min.css rel="stylesheet" />
        <script src="Bootstrap/js/jquery.js"></script>
        <link href=Bootstrap/css/bootstrap-theme.min.css rel="stylesheet"/>
        <link href=Bootstrap/css/datepicker.css rel="stylesheet"/>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
        <script src="Bootstrap/js/datepicker.js"></script>
        <script src="Chart/Chart.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <script src="Bootstrap/js/bootstrap-datepicker.fr.min.js" charset="UTF-8"></script>
    </head>
    <body>
        <div class="container-fluid">
            <?php include './Template/menusuperior.php'; ?>
            <div class="row">
                <div class="col-md-3">
                    <?php include './Template/menulateral.php'; ?>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <?php include_once './Relatorios/ChamadosEmProcesso.php'; ?>
                        </div>
                        <div class="col-md-6">
                            <?php include_once './Relatorios/ChamadosPorPrioridade.php'; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include_once './Relatorios/ProdutividadePorTecnico.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>