<?php $r = 0; ?>
<?php
include './PHP/Gerenciador.php';
garantirAcesso();
if (paginasPermitidas(basename($_SERVER ['PHP_SELF']), $_SESSION['a']['permissao_id'], 1) == 0) {
    manterLogado();
}
?>
<div class="well">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1 align-center">
                <img src="Images/logo.jpg" width="60px" height="50px"/>
            </div>
            <div class="col-md-8">
                USUÁRIO : <?php echo $_SESSION['a']['nome']; ?>
            </div>
            <div class="col-md-3 align-center text-right">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-comment text-right"></span></button>
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
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Mensagens</h4>
            </div>
            <div class="modal-body scroll-list">
                <?php foreach ($listaMensagens as $mensagem): ?>
                    <div class="row">
                        <div class="col-md-1">
                            <a href="PHP/Gerenciador.php?detalhes&id=<?php echo $mensagem['chamado_id']; ?>" class="btn btn-info btn-md"><span class="glyphicon glyphicon-exclamation-sign text-right"></span></a>
                        </div>
                        <div class="col-md-11">
                            <?php $r++; ?>
                            <?php if ($mensagem['status_id'] == 2): ?>
                                <div class="alert alert-info">
                                    O seu chamado solicitado está sendo atendido por <?php echo $mensagem['tecnico']; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($mensagem['status_id'] == 3): ?>
                                <div class="alert alert-warning">
                                    O seu chamado solicitado foi deixado em espera por <?php echo $mensagem['tecnico']; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($mensagem['status_id'] == 4): ?>
                                <div class="alert alert-success">
                                    O seu chamado solicitado foi finalizado por <?php echo $mensagem['tecnico']; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($mensagem['status_id'] == 5): ?>
                                <div class="alert alert-danger">
                                    o técnico <?php echo $mensagem['pessoa']; ?> transferiu um chamado pra você;
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php if ($r == 0): echo 'Sem Mensagens'; ?>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <?php if ($r != 0):?>
                    <a href="PHP/Gerenciador.php?lerMensagem&id=<?php echo $mensagem['pessoa_id']; ?>" class="btn btn-danger btn-md">Limpar</a>
                <?php endif; ?>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>