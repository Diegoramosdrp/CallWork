<?php
include_once '/RelatorioFuncoes.php';
$processo = chamadosEmProcesso($listaChamados);
?>

<div class="box">
    <div class="well">
        <legend>Chamados Em Processo</legend>
        <div class="box-chart">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12">
                        <canvas id="doughnut-chart-processo" width="200" height="100"></canvas>
                        <script>
                            new Chart(document.getElementById("doughnut-chart-processo"), {
                                type: 'pie',
                                data: {
                                    labels: ["Aguardando Inicio", "Em Atendimento", "Em Espera"],
                                    datasets: [
                                        {
                                            backgroundColor: ["green", "yellow", "blue"],
                                            data: [<?php echo $processo[0]; ?>, <?php echo $processo[1]; ?>, <?php echo $processo[2]; ?>]
                                        }
                                    ]
                                },
                                options: {
                                    title: {
                                        display: false,
                                        text: 'Quantidade De Chamados Em Processo'
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