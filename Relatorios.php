<html>
    <head>
        <title>CallWork</title>
        <link href=Css/style.css rel="stylesheet">
        <link href=Bootstrap/css/bootstrap.min.css rel="stylesheet" />
        <link href=Bootstrap/css/bootstrap-theme.min.css rel="stylesheet"/>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
        <script src="JS/Chart.min.js"></script>  
    </head>
    <body>
        <div class="container-fluid">
            <?php include './Template/menusuperior.php'; ?>
            <div class="row">
                <div class="col-md-3">
                    <?php include './Template/menulateral.php'; ?>
                    <?php include './PHP/Gerenciador.php'; ?>
                </div>
                <div class="col-md-8">
                    <div class="box">
                        <h2>Gráfico Donut</h2>
                        <div class="box-chart">
                            <canvas id="GraficoDonut" style="width:100%;"></canvas>
                            <script type="text/javascript">
                                var options = {
                                    responsive: true
                                };
                                var data = [
                                    {
                                        value: 10,
                                        color: "#F7464A",
                                        highlight: "#FF5A5E",
                                        label: "Vermelho"
                                    },
                                    {
                                        value: 3,
                                        color: "#46BFBD",
                                        highlight: "#5AD3D1",
                                        label: "Azul"
                                    },
                                    {
                                        value: 15,
                                        color: "#FDB45C",
                                        highlight: "#FFC870",
                                        label: "Amarelo"
                                    }
                                ]
                                window.onload = function () {

                                    var ctx = document.getElementById("GraficoDonut").getContext("2d");
                                    var PizzaChart = new Chart(ctx).Doughnut(data, options);
                                }
                            </script>           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>