<?php include './PHP/AcessoFuncoes.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="container">
            <h3>Popover Example</h3>
            <a href="#" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">Toggle popover</a>
        </div>

        <script>
            $(document).ready(function () {
                $('[data-toggle="popover"]').popover();
            });
        </script>



        <?php
        $paginas = array(
        'AdicionarChamado.php' => array(1,2,3,6), array('teste'),
        'AdicionarEspecialidade.php' => array(4,5), array('aaoaoa'),
        'AdicionarSetor.php' => array(4,5),
        'AlterarSenha.php' => array(1,2,3,4,5,6),
        'ChamadoEmProcesso.php' => array(5,6),
        'DetalhesChamado.php' => array(1,2,3,4,5,6),
        'ExcluirUsuariosInativos.php' => array(5),
        'GerarAcesso.php' => array(4,5),
        'MeusChamadosSolicitante.php' => array(1,2,3,6),
        'MeusChamadosTecnico.php' => array(4)
        );
        
        foreach ($paginas as $p => $pp){
            echo $p.' ';
            foreach ($pp as $pa){
                echo $pa.' ';
            }
            echo '<br>';
        }
        
        foreach ($paginas as list ($e)){
            echo $e;
        }
        ?>
    </body>
</html>
