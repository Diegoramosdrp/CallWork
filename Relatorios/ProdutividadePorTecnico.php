<?php
include_once '/RelatorioFuncoes.php';
?>
<script>
    $(document).ready(function () {
        var date_input = $('input[name="date"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
            format: 'dd/mm/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        date_input.datepicker(options);
    })
</script>
<div class="box">
    <div class="well">
        <div class="row">
            <div class="col-lg-6">
                <legend>Produtividade Individual</legend>
            </div>
            <div class="col-lg-6">
                <form action="Relatorios/RelatorioFuncoes.php" method="post">
                    <div class="form-inline">
                        <select class="form-control col-lg-3" id="permissao" name="tecnico_id" onchange="verificaOpcao(this.value)">
                            <?php foreach ($listaTecnicos as $row): ?>
                                <option value="<?php echo $row['pessoa_id']; ?>"><?php echo $row['pessoa_nome']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            <input class="form-control" id="date" name="date" placeholder="DD-MM-AAAA" type="text"/>
                        </div>
                        <button class="btn btn-success " name="filtrar" type="submit">Filtrar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="box-chart">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-11">
                        <canvas id="bar-chart-tecnico" width="400" height="97"></canvas>
                        <script>
                            new Chart(document.getElementById("bar-chart-tecnico"), {
                                type: 'bar',
                                data: {
                                    labels: ["Finalizado", "Em Atendimento", "Em Espera"],
                                    datasets: [
                                        {
                                            backgroundColor: ["green", "yellow", "blue"],
                                            data: [<?php echo $_SESSION['tecnico'][3] ?>, <?php echo $_SESSION['tecnico'][1]; ?>, <?php echo $_SESSION['tecnico'][2]; ?>]
                                        }
                                    ]
                                },
                                options: {
                                    legend: {display: false},
                                    title: {
                                        display: true,
                                        text: 'Produtividade De <?php echo $_SESSION['tecnico'][0].' - '.$_SESSION['tecnico'][4];
                            if ($_SESSION['tecnico'][3] == 0 && $_SESSION['tecnico'][2] == 0 && $_SESSION['tecnico'][1] == 0) {
                                echo '  (SEM PRODUTIVIDADE)';
                            }
                            ?>'
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>