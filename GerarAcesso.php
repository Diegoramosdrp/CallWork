<html>
    <head>
        <title>CallWork</title>
        <link href=Css/style.css rel="stylesheet">
        <link href=Bootstrap/css/bootstrap.min.css rel="stylesheet" />
        <script src="Bootstrap/js/jquery.js"></script>
        <link href=Bootstrap/css/bootstrap-theme.min.css rel="stylesheet"/>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
        <script>
            function verificaOpcao(valor) {
                if (valor != 4) {
                    document.getElementById("especialidade").className = "list-group list-group-item scroll-list-2 disabled-select disabled";
                } else if (valor == 4) {
                    document.getElementById("especialidade").className = "list-group list-group-item scroll-list-2";
                }
            }
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <?php include './Template/menusuperior.php'; ?>
            <div class="row">
                <div class="col-md-3">
                    <?php include 'Template/menulateral.php'; ?>
                </div>
                <div class="col-md-8">
                    <form class="form-horizontal" action="PHP/Gerenciador.php"method="POST">
                        <fieldset>
                            <legend>Novo Acesso</legend>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <label for="textArea" class="control-label">Nome De Usuário</label>
                                    <input class="form-control" id="nomeUsuario" type="text" name="nomeUsuario" value="<?php echo @$_SESSION['formulario']['nomeUsuario']; ?>">
                                </div>                                
                                <div class="col-lg-5">
                                    <label for="textArea" class="control-label">Nome Completo</label>
                                    <input class="form-control" id="nomePessoa" type="text" name="nomePessoa" value="<?php echo @$_SESSION['formulario']['nomePessoa']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <label for="textArea" class="control-label">Senha</label>
                                    <input class="form-control" id="senha" type="password" name="senha">
                                </div>                                
                                <div class="col-lg-5">
                                    <label for="textArea" class="control-label">Repita Senha</label>
                                    <input class="form-control" id="senhaConferencia" type="password" name="senhaConferencia">
                                </div>                                
                            </div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <label for="textArea" class="control-label">Cargo</label>
                                    <input class="form-control" id="cargo" type="text" name="cargo" value="<?php echo @$_SESSION['formulario']['cargo']; ?>">
                                </div>                                
                                <div class="col-lg-5">
                                    <label for="textArea" class="control-label">Setor</label>
                                    <select class="form-control" id="setor" name="setor">
                                        <option> -- Selecione --</option>
                                        <?php foreach ($listaSetores as $row): ?>
                                            <option value="<?php echo $row['setor_id']; ?>" <?php if (@$_SESSION['formulario']['setor'] == $row['setor_id']) { echo 'selected = "selected"';}?>><?php echo $row['nome']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>                                
                            </div>
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <label for="textArea" class="control-label">Permissão</label>
                                    <select class="form-control" id="permissao" name="permissao" onchange="verificaOpcao(this.value)">
                                        <option> -- Selecione --</option>
                                        <?php foreach ($listaPermissoes as $row): ?>
                                            <?php if($row['permissao_id'] != 5 && $_SESSION['a']['permissao_id'] == 4):?>
                                            <option value="<?php echo $row['permissao_id']; ?>" <?php if (@$_SESSION['formulario']['permissao'] == $row['permissao_id']) { echo 'selected = "selected"';}?>><?php echo $row['nome']; ?></option>
                                            <?php elseif($_SESSION['a']['permissao_id'] == 5):?>
                                            <option value="<?php echo $row['permissao_id']; ?>" <?php if (@$_SESSION['formulario']['permissao'] == $row['permissao_id']) { echo 'selected = "selected"';}?>><?php echo $row['nome']; ?></option>
                                            <?php endif;?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-lg-5">
                                    <label for="textArea" class="control-label">Especialidade</label>
                                    <div class="list-group list-group-item scroll-list-2 disabled-select disabled" id="especialidade">
                                        <?php foreach ($listaEspecialidades as $row): ?>
                                            <input type="checkbox" name="check_list[]" value="<?php echo $row['especialidade_id']; ?>"> <?php echo $row['nome']; ?><br>
                                        <?php endforeach; ?>
                                        <?php if(@$_SESSION['formulario']['permissao'] == 4):?>
                                            <script type="text/javascript"> verificaOpcao(4);</script>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 text-right">
                                    <button type="submit" class="btn btn-success" name="adicionarAcesso">Enviar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    <div class="row">
                        <div class="col-md-10">
                            <?php if (isset($_SESSION['mensagem'])): ?>
                                <div class="<?php echo $_SESSION['class']; ?> form-control">
                                    <?php
                                    echo $_SESSION['mensagem'];
                                    unset($_SESSION['mensagem'])
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>