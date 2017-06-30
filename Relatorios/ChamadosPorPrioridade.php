<?php
include_once '/RelatorioFuncoes.php';
$prioridade = chamadosPorPrioridade($listaChamados2);
?>

<div class="box">
    <div class="well">
        <legend>Chamados Por Prioridade</legend>
        <div class="box-chart">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <canvas id="doughnut-chart-prioridade" width="200" height="100"></canvas>
                        <script>
                            new Chart(document.getElementById("doughnut-chart-prioridade"), {
                                type: 'pie',
                                data: {
                                    labels: ["Baixo", "Normal", "Urgente"],
                                    datasets: [
                                        {
                                            backgroundColor: ["green", "yellow", "red"],
                                            data: [<?php echo $prioridade[0]; ?>, <?php echo $prioridade[1]; ?>, <?php echo $prioridade[2]; ?>]
                                        }
                                    ]
                                },
                                options: {
                                    title: {
                                        display: false,
                                        text: 'Quantidade De Chamados Por Prioridade'
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