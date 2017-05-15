<?php include './PHP/Gerenciador.php'; ?>
<div class="well">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1 align-center">
                <a href="index.php"><img src="Images/logo.jpg" width="60px" height="50px"/></a>
            </div>
            <div class="col-md-8">
                USUÁRIO : <?php echo $_SESSION['a']['nome']; ?>
            </div>
            <div class="col-md-3 align-center text-right">
                <div class="row">
                    <div class="col-md-12">
                        <a href="./PHP/Gerenciador.php?deslogar" class="">Sair</a><br>
                        <?php
                        setlocale(LC_ALL, 'pt-BR');
                        date_default_timezone_set('America/Sao_Paulo');
                        echo utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>